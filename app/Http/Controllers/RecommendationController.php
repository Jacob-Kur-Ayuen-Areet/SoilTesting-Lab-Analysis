<?php

namespace App\Http\Controllers;

use App\Jobs\GenerateAiRecommendationJob;
use App\Models\Recommendation;
use App\Http\Controllers\Controller;
use App\Models\FarmerRequest;
use App\Services\GeminiAIService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class RecommendationController extends Controller
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

        $results = Recommendation::with('farmerRequest.farmer');

        if (!empty($query)) {
            $results->where(function($q) use ($query) {
                $q->where('notes', 'LIKE', '%' . $query . '%')
                  ->orWhereHas('farmerRequest.farmer', function($fq) use ($query) {
                      $fq->where('farmer_name', 'LIKE', '%' . $query . '%');
                  });
            });
        }

        $data['Recommendations'] = $results->paginate(10)->withQueryString();
        return view('request.recommendations_index', $data);
    }
    public function search(Request $request)
    {
        $query = $request->input('search');

        $data['farmers'] = Recommendation::whereHas('farmerRequest', function ($q) use ($query) {
            $q->where('laboratory_number', 'LIKE', '%' . $query . '%');
        })->orWhereHas('farmerSampleRecRequest', function ($q) use ($query) {
            $q->where('contact_phone', 'LIKE', '%' . $query . '%')->orWhere('farmer_name', 'LIKE', '%' . $query . '%');
        })
            ->paginate(10);

        return  view('farmer.view', $data);
    }
    public function show($id)
    {
        $data['recommendation'] = Recommendation::with('farmerRequest.farmer', 'farmerRequest.farm')->findOrFail($id);
        return view('request.recommendation_detail', $data);
    }
    public function create($id)
    {
        // Attempt to retrieve the farmer's sample information by request ID

        $farmer_sample_information = FarmerRequest::with('farmerSampleRecRequest')
            ->with('farmer')
            ->with('farm')
            ->findOrFail($id);

        // Check if the data was successfully retrieved
        if (!$farmer_sample_information) {
            // Optionally, add a flash message to notify the user that the request was not found
            session()->flash('error', 'Request Not Found!');

            // Redirect to a previous page or a specific route, as appropriate
            return redirect()->back();
        }

        // Data is available, pass it to the view
        return view('request.recommendation', [
            'farmer_sample_information' => $farmer_sample_information,
            'farmer_request' => $farmer_sample_information
        ]);
    }
    public function upload(Request $request)
    {
        $validatedData = $request->validate([
            'request_id' => 'required|integer',
            // 'sample_id' => 'required|integer',
            // 'user_id' => 'required|integer',
            // Add validation rules for other fields
        ]);
        $RecommendationIsExisting = Recommendation::where('request_id', $request->request_id)->first();
        // $data['notes'] =  isempty($request->approved) ;
        $data['partner_id'] =  $request->partner_id == null ? 1 : 2;
        $data['request_id'] =  $request->request_id;
        // $data['sample_id'] =  $request->sample_id;

        if ($request->hasFile('file')) {
            $recommendationFile = $request->file('file');
            $f = getFileMetaData($recommendationFile);
            if ($f['ext'] == 'pdf') {
                $f['name'] = $request->request_id . '.' . $f['ext'];
                $f['path'] = $recommendationFile->storeAs(getUploadPath('recommendationfiles'), $f['name']);
                $data['file_path'] =  $f['path'];
                if ($RecommendationIsExisting) {
                    $Recommendation = Recommendation::where('request_id', $request->request_id)->update($data);
                } else {
                    $Recommendation = Recommendation::create($data);
                }
                return response()->json($Recommendation, 200);
            } else {
                return response()->json('error', 201);
            }
        } else {
            return response()->json('error', 201);
        }
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'request_id' => 'required|integer',
            // 'sample_id' => 'required|integer',
            // 'user_id' => 'required|integer',
            // Add validation rules for other fields
        ]);

        // $data['notes'] =  isempty($request->approved) ;
        $data['partner_id'] =  $request->partner_id == null ? 1 : 2;
        $data['sample_id'] =  $request->sample_id;
        $data['approved'] =  $request->approved == null ?  'N' : $request->approved;
        $data['notes'] =  $request->notes == null ?  'N' : $request->approved;
        $data['request_id'] =  $request->request_id;
        if ($request->hasFile('file')) {
            $recommendationFile = $request->file('file');
            $f = getFileMetaData($recommendationFile);
            $f['name'] = 'file.' . $f['ext'];
            $f['path'] = $recommendationFile->storeAs(getUploadPath('recommendationfiles'), $f['name']);
            $data['file_path'] = 'storage/' . $f['path'];
        }


        $Recommendation = Recommendation::create($data);
        return response()->json($Recommendation, 200);
    }

    public function update(Request $request)
    {

        $validatedData = $request->validate([
            'request_id' => 'required|integer',
            // 'sample_id' => 'required|integer',
            // 'user_id' => 'required|integer',
            // Add validation rules for other fields
        ]);
        $RecommendationIsExisting = Recommendation::where('request_id', $request->request_id)->where('sample_id', $request->sample_id)->first();

        // $data['notes'] =  isempty($request->approved) ;
        $data['partner_id'] =  $request->partner_id == null ? 1 : 2;
        $data['approved'] =  $request->approved == null ?  'N' : $request->approved;
        $data['notes'] =  $request->notes;
        $data['request_id'] =  $request->request_id;
        $data['sample_id'] =  $request->sample_id;
        if ($RecommendationIsExisting) {
            $Recommendation = Recommendation::where('request_id', $request->request_id)->where('sample_id', $request->sample_id)->update($data);
        } else {
            $Recommendation = Recommendation::create($data);
        }
        return back();
    }

    public function downloadFile($id)
    {
        $Recommendation = Recommendation::findOrFail($id);

        // 1. Download uploaded physical file if it exists
        if ($Recommendation->file_path !== null && Storage::exists($Recommendation->file_path)) {
            $filePath = storage_path('app/' . $Recommendation->file_path);
            return response()->download($filePath);
        }

        // 2. Fallback to generating a PDF of the AI Recommendation if approved
        if ($Recommendation->ai_status === 'approved' && !empty($Recommendation->ai_text)) {
            $html = view('request.partials.reco_pdf', ['ai_text' => $Recommendation->ai_text])->render();
            
            $dompdf = new \Dompdf\Dompdf();
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();

            return \Response::make($dompdf->output(), 200, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'attachment; filename="AI_Recommendation.pdf"',
            ]);
        }

        return back()->with('error', 'File not found or AI recommendation not yet approved.');
    }
    // ─── AI: Generate recommendation (async via queue) ───────────────────────
    public function generateAiRecommendation(Request $request, $id)
    {
        $rec = Recommendation::find($id);
        if (!$rec) {
            $rec = Recommendation::firstOrCreate(
                ['request_id' => $id],
                ['partner_id' => 1, 'approved' => 'N']
            );
        }

        // Mark as processing immediately so the UI can show progress
        $rec->update(['ai_status' => 'processing', 'ai_text' => null]);

        // Dispatch to queue — avoids browser timeout on slow/overloaded API
        GenerateAiRecommendationJob::dispatch($rec->reco_id);

        return response()->json(['status' => 'processing', 'message' => 'AI generation started. Please wait…']);
    }

    // ─── AI: Poll status ──────────────────────────────────────────────────────
    public function statusAiRecommendation(Request $request, $id)
    {
        $rec = Recommendation::find($id);
        if (!$rec) {
            $rec = Recommendation::where('request_id', $id)->first();
        }
        if (!$rec) {
            return response()->json(['status' => 'none', 'text' => '']);
        }

        return response()->json([
            'status' => $rec->ai_status ?? 'none',
            'text'   => $rec->ai_text ?? '',
        ]);
    }

    // ─── AI: Approve recommendation (optionally save edited text) ─────────────
    public function approveAiRecommendation(Request $request, $id)
    {
        $rec = Recommendation::find($id);
        if (!$rec) {
            $rec = Recommendation::where('request_id', $id)->firstOrFail();
        }
        $rec->update([
            'ai_text'   => $request->input('ai_text', $rec->ai_text),
            'ai_status' => 'approved',
            'approved'  => 'Y',
        ]);

        return response()->json(['status' => 'approved']);
    }

    // ─── AI: Reject recommendation ────────────────────────────────────────────
    public function rejectAiRecommendation(Request $request, $id)
    {
        $rec = Recommendation::find($id);
        if (!$rec) {
            $rec = Recommendation::where('request_id', $id)->firstOrFail();
        }
        $rec->update([
            'ai_text'   => null,
            'ai_status' => 'rejected',
        ]);

        return response()->json(['status' => 'rejected']);
    }

    public function destroy($id)
    {
        $Recommendation = Recommendation::findOrFail($id);
        $Recommendation->delete();

        return response()->json(null, 204);
    }
}
