<?php

namespace App\Http\Controllers;

use App\Models\FarmerRequest;
use App\Models\SoilSample;
use App\Models\SoilSampleResult;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class SoilSampleResultController extends Controller
{
    public function index()
    {
        $soilSampleResults = SoilSampleResult::paginate(10);
        return response()->json($soilSampleResults);
    }
    public function search(Request $request)
    {
        $query = $request->input('search');

        $data['farmers'] = SoilSampleResult::whereHas('soilSample', function ($q) use ($query) {
                $q->where('laboratory_number', 'LIKE', '%' . $query . '%');
            })->orWhereHas('farmerRequest', function ($q) use ($query) {
                $q->where('contact_phone', 'LIKE', '%' . $query . '%')
                ->orWhere('farmer_name', 'LIKE', '%' . $query . '%');})
            ->paginate(10);

        return  view('farmer.view',$data);
    }
    public function show($id)
    {
        $soilSampleResult = SoilSampleResult::findOrFail($id);
        return response()->json($soilSampleResult);
    }
    public function create($id)
    {
        $data['farmer_sample_information'] = SoilSample::where('sample_id',$id)->with('farmerRequest','farmerRequest.farmerSampleRecRequest','farmerRequest.farmer','farmerRequest.farm')->with('soilSampleResult')->select('request_id', 'sample_id','laboratory_number', 'plot_id', 'sample_reference')->first();

        return view('request.soil_results',$data);
    }

    public function store(Request $request, $id)
    {

        // dd($request->all());
        $validatedData = $request->validate([
            'request_id' => 'required|integer',
            'sample_id' => 'required|integer',
            'laboratory_number' => 'required',
            // Add validation rules for other fields
        ]);
        
        $result['request_id'] = $request->request_id;
        $result['sample_id'] = $request->sample_id;
        $result['laboratory_number'] = $request->laboratory_number;
        $result['lab_user_id'] = $request->lab_user_id;
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
        $result['approved'] = $request->approved;
        $result['approved_by_user_id'] = $request->approved_by_user_id;
        $checkresults =  SoilSampleResult::where('laboratory_number',$request->laboratory_number)->where('sample_id',$request->sample_id)->first();
        if($checkresults){
            $soilSampleResult = SoilSampleResult::find($checkresults->result_id)->update($result);
        }else{
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
            // Add validation rules for other fields
        ]);
        $result['lab_user_id'] = $request->lab_user_id;
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

    public function generatePdf($id)
{
    // Get the HTML content from the view
    $data['name'] = "taku";
    // $data['farmer_sample_information'] = SoilSample::where('sample_id',$id)->with('farmerRequest','farmerRequest.farmerSampleRecRequest','farmerRequest.farmer','farmerRequest.farm')->with('soilSampleResult')->select('request_id', 'sample_id','laboratory_number', 'plot_id', 'sample_reference')->first();
    $data['farmer_sample_information'] =  FarmerRequest::where('request_id', $id)->with('farmerRequestSamples')->with('soilSampleResult')->with('farmer')->with('farm')->first();
// dd($data['farmer_sample_information']);
    $html = View::make('request.partials.pdf',$data)->render();
    
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
