<?php

namespace App\Http\Controllers;

use App\Jobs\GenerateAiSoilAnalysisJob;
use App\Models\FarmerRequest;
use App\Models\SoilSample;
use App\Models\SoilSampleResult;
use App\Services\GeminiAIService;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;


class SoilSampleResultController extends Controller
{
    public function index(Request $request)
    {
        // If it's a farmer, redirect them to their latest request
        if (Auth::check() && Auth::user()->role_id == 2) {
            $latestRequest = FarmerRequest::whereHas('farmer', function ($q) {
                $q->where('user_id', Auth::user()->id);
            })->orderBy('request_id', 'desc')->first();

            if ($latestRequest) {
                return redirect()->route('farmer_requests.create', $latestRequest->request_id);
            } else {
                return redirect()->route('farmer_requests.index')->with('info', 'You have no requests yet.');
            }
        }

        $query = $request->input('search');
        $data['search'] = $query;

        $results = SoilSampleResult::with('farmerRequest.farmer');

        if (!empty($query)) {
            $results->where(function($q) use ($query) {
                $q->where('laboratory_number', 'LIKE', '%' . $query . '%')
                  ->orWhere('colour', 'LIKE', '%' . $query . '%')
                  ->orWhere('texture', 'LIKE', '%' . $query . '%')
                  ->orWhereHas('farmerRequest.farmer', function($fq) use ($query) {
                      $fq->where('farmer_name', 'LIKE', '%' . $query . '%');
                  });
            });
        }

        $data['soil_samples'] = $results->paginate(10)->withQueryString();

        return view('request.soiljobsmore', $data);
    }
    public function search(Request $request)
    {
        return $this->index($request);
    }
    public function show($id)
    {
        $data['soil_sample'] = SoilSampleResult::with('farmerRequest.farmer', 'farmerRequest.farm')->findOrFail($id);
        return view('request.soil_analysis_detail', $data);
    }
    public function create($id)
    {
        $data['farmer_sample_information'] = SoilSample::where('sample_id', $id)->with('farmerRequest', 'farmerRequest.farmerSampleRecRequest', 'farmerRequest.farmer', 'farmerRequest.farm')->with('soilSampleResult')->select('request_id', 'sample_id', 'laboratory_number', 'plot_id', 'sample_reference')->first();

        return view('request.soil_results', $data);
    }

    public function store(Request $request, $id)
    {

        // dd($request->all());
        $validatedData = $request->validate([
            'request_id' => 'required|integer',
            'sample_id' => 'required|integer',
            'laboratory_number' => 'required',
            'ph_cacl2' => 'nullable|numeric',
            'percentage_sand' => 'nullable|numeric',
            'percentage_silt' => 'nullable|numeric',
            'percentage_clay' => 'nullable|numeric',
            'min_initial_n' => 'nullable|numeric',
            'p2o5_ppm' => 'nullable|numeric',
            'k' => 'nullable|numeric',
            'mg' => 'nullable|numeric',
            'ca' => 'nullable|numeric',
            'zn' => 'nullable|numeric',
            'cu' => 'nullable|numeric',
            'mn' => 'nullable|numeric',
            'fe' => 'nullable|numeric',
        ]);

        $result['request_id'] = $request->request_id;
        $result['sample_id'] = $request->sample_id;
        $result['laboratory_number'] = $request->laboratory_number;
        $result['lab_user_id'] = $request->lab_user_id;
        $result['texturemethod'] = $request->texturemethod;
        $result['phosphorousmethods'] = $request->phosphorousmethods;
        $result['micronutrientsmethods'] = $request->micronutrientsmethods;
        $result['exchangeablemethods'] = $request->exchangeablemethods;
        $result['phmethod'] = $request->phmethod;
        $result['dilutionratio'] = $request->dilutionratio;
        $result['ph_cacl2'] = $request->ph_cacl2;
        $result['colour'] = $request->colour;
        $result['texture'] = $request->texture;
        $result['percentage_sand'] = $request->percentage_sand;
        $result['percentage_silt'] = $request->percentage_silt;
        $result['percentage_clay'] = $request->percentage_clay;
        $result['min_initial_n'] = $request->min_initial_n;
        $result['p2o5_ppm'] = $request->p2o5_ppm;
        $result['k'] = $request->k;
        $result['mg'] = $request->mg;
        $result['ca'] = $request->ca;
        $result['zn'] = $request->zn;
        $result['cu'] = $request->cu;
        $result['mn'] = $request->mn;
        $result['fe'] = $request->fe;
        $result['approved'] = $request->approved;
        $result['approved_by_user_id'] = $request->approved_by_user_id;
        $checkresults =  SoilSampleResult::where('laboratory_number', $request->laboratory_number)->where('sample_id', $request->sample_id)->first();
        if ($checkresults) {
            $soilSampleResult = SoilSampleResult::find($checkresults->result_id)->update($result);
        } else {
            $soilSampleResult = SoilSampleResult::create($result);
        }
        return back();
        // return response()->json($soilSampleResult, 201);
    }

    public function update(Request $request, $id)
    {
        $soilSampleResult = SoilSampleResult::findOrFail($id);

        $validatedData = $request->validate([
            'id' => 'required|integer',
            'ph_cacl2' => 'nullable|numeric',
            'percentage_sand' => 'nullable|numeric',
            'percentage_silt' => 'nullable|numeric',
            'percentage_clay' => 'nullable|numeric',
            'min_initial_n' => 'nullable|numeric',
            'p2o5_ppm' => 'nullable|numeric',
            'k' => 'nullable|numeric',
            'mg' => 'nullable|numeric',
            'ca' => 'nullable|numeric',
            'zn' => 'nullable|numeric',
            'cu' => 'nullable|numeric',
            'mn' => 'nullable|numeric',
            'fe' => 'nullable|numeric',
        ]);
        $result['lab_user_id'] = $request->lab_user_id;
        $result['texturemethod'] = $request->texturemethod;
        $result['phosphorousmethods'] = $request->phosphorousmethods;
        $result['micronutrientsmethods'] = $request->micronutrientsmethods;
        $result['exchangeablemethods'] = $request->exchangeablemethods;
        $result['phmethod'] = $request->phmethod;
        $result['dilutionratio'] = $request->dilutionratio;
        $result['ph_cacl2'] = $request->ph_cacl2;
        $result['colour'] = $request->colour;
        $result['texture'] = $request->texture;
        $result['percentage_sand'] = $request->percentage_sand;
        $result['percentage_silt'] = $request->percentage_silt;
        $result['percentage_clay'] = $request->percentage_clay;
        $result['min_initial_n'] = $request->min_initial_n;
        $result['p2o5_ppm'] = $request->p2o5_ppm;
        $result['k'] = $request->k;
        $result['mg'] = $request->mg;
        $result['ca'] = $request->ca;
        $result['zn'] = $request->zn;
        $result['cu'] = $request->cu;
        $result['mn'] = $request->mn;
        $result['fe'] = $request->fe;
        $result['approved'] = $request->approved;
        $result['approved_by_user_id'] = $request->approved_by_user_id;
        $soilSampleResult->find($id)->update($result);

        return response()->json($soilSampleResult, 200);
    }

    public function destroy($id)
    {
        $soilSampleResult = SoilSampleResult::findOrFail($id);
        $soilSampleResult->delete();

        return response()->json(null, 204);
    }

    // ─── AI: Generate soil analysis interpretation (async via queue) ────────────────
    public function generateAiAnalysis(Request $request, $id)
    {
        $result = SoilSampleResult::findOrFail($id);

        // Mark as processing immediately so the UI shows a spinner
        $result->update(['ai_analysis_status' => 'processing', 'ai_analysis' => null]);

        // Dispatch to queue — avoids browser timeout on slow/overloaded API
        GenerateAiSoilAnalysisJob::dispatch($result->result_id);

        return response()->json(['status' => 'processing', 'message' => 'AI analysis started. Please wait…']);
    }

    // ─── AI: Poll status for soil analysis ─────────────────────────────────────
    public function statusAiAnalysis(Request $request, $id)
    {
        $result = SoilSampleResult::find($id);
        if (!$result) {
            return response()->json(['status' => 'none', 'text' => '']);
        }
        return response()->json([
            'status' => $result->ai_analysis_status ?? 'none',
            'text'   => $result->ai_analysis ?? '',
        ]);
    }

    // ─── AI: Approve AI analysis (also saves any edited text) ─────────────────
    public function approveAiAnalysis(Request $request, $id)
    {
        $result = SoilSampleResult::findOrFail($id);
        $result->update([
            'ai_analysis'        => $request->input('ai_analysis', $result->ai_analysis),
            'ai_analysis_status' => 'approved',
            'approved'           => 'Y',
            'approved_by_user_id'=> Auth::id(),
        ]);

        return response()->json(['status' => 'approved']);
    }

    // ─── AI: Reject AI analysis ────────────────────────────────────────────────
    public function rejectAiAnalysis(Request $request, $id)
    {
        $result = SoilSampleResult::findOrFail($id);
        $result->update([
            'ai_analysis'        => null,
            'ai_analysis_status' => 'rejected',
        ]);

        return response()->json(['status' => 'rejected']);
    }

    public function generatePdf($id)
    {

        // Get the HTML content from the view
        $data['name'] = "taku";
        // $data['farmer_sample_information'] = SoilSample::where('sample_id',$id)->with('farmerRequest','farmerRequest.farmerSampleRecRequest','farmerRequest.farmer','farmerRequest.farm')->with('soilSampleResult')->select('request_id', 'sample_id','laboratory_number', 'plot_id', 'sample_reference')->first();
        $data['farmer_sample_information'] =  FarmerRequest::where('request_id', $id)->with('farmerRequestSamples')->with('soilSampleResult')->with('farmer')->with('farm')->first();
        if (!$data['farmer_sample_information']) {
            abort(404, 'Farmer request not found.');
        }
        $html = View::make('request.partials.pdf', $data)->render();

        $dompdf = new Dompdf();
        $dompdf->setPaper('A4', 'landscape');
        // Create a new Dompdf instance


        // Load the HTML content into Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Set PDF options, e.g., orientation, size, etc.
        // $dompdf->setPaper('A4', 'landscape');

        // Render the PDF
        $dompdf->render();

        return Response::make($dompdf->output(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="generated.pdf"',
        ]);
        // Save the PDF to a file or display it in the browser (download)
        // $outputFile = public_path('generated.pdf'); // Output file path
        // file_put_contents($outputFile, $dompdf->output());

        // return "PDF generated successfully!";
    }
}
