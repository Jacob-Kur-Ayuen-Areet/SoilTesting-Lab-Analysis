<?php

namespace App\Http\Controllers;

use App\Models\Recommendation;
use App\Http\Controllers\Controller;
use App\Models\FarmerRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use function PHPUnit\Framework\isEmpty;

class RecommendationController extends Controller
{
    public function index()
    {
        $Recommendations = Recommendation::paginate(10);
        return response()->json($Recommendations);
    }
    public function search(Request $request)
    {
        $query = $request->input('search');

        $data['farmers'] = Recommendation::whereHas('farmerRequest', function ($q) use ($query) {
                $q->where('laboratory_number', 'LIKE', '%' . $query . '%');
            })->orWhereHas('farmerSampleRecRequest', function ($q) use ($query) {
                $q->where('contact_phone', 'LIKE', '%' . $query . '%')->orWhere('farmer_name', 'LIKE', '%' . $query . '%');})
            ->paginate(10);

        return  view('farmer.view',$data);
    }
    public function show($id)
    {
        $Recommendation = Recommendation::findOrFail($id);
        return response()->json($Recommendation);
    }
    public function create($id)
    {

        $data['farmer_sample_information'] = FarmerRequest::where('request_id', $id)->with('farmerSampleRecRequest')->with('farmer')->with('farm')->first();
      

        return view('request.soil_results_recommendation', $data);
    }
    public function upload(Request $request)
    {
        $validatedData = $request->validate([
            'request_id' => 'required|integer',
            'sample_id' => 'required|integer',
            // 'user_id' => 'required|integer',
            // Add validation rules for other fields
        ]);
        $RecommendationIsExisting = Recommendation::where('request_id', $request->request_id)->first();
        // $data['notes'] =  isempty($request->approved) ;
        $data['partner_id'] =  $request->partner_id == null ? 1 : 2;
        $data['request_id'] =  $request->request_id;
        $data['sample_id'] =  $request->sample_id;
        
        if ($request->hasFile('file')) {
            $recommendationFile = $request->file('file');
            $f = getFileMetaData($recommendationFile);
            if ($f['ext'] == 'pdf') {
                $f['name'] = $request->sample_id . '.' . $f['ext'];
                $f['path'] = $recommendationFile->storeAs(getUploadPath('recommendationfiles'), $f['name']);
                $data['file_path'] =  $f['path'];
                if ($RecommendationIsExisting) {
                    $Recommendation = Recommendation::where('request_id', $request->request_id)->where('sample_id', $request->sample_id)->update($data);
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
            'sample_id' => 'required|integer',
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
            'sample_id' => 'required|integer',
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
        $filePath = storage_path('/'.'app/'.$Recommendation->file_path);
       

        if (!Storage::exists($Recommendation->file_path)) {
            return back();
        }

        return response()->download($filePath);
    }
    public function destroy($id)
    {
        $Recommendation = Recommendation::findOrFail($id);
        $Recommendation->delete();

        return response()->json(null, 204);
    }
}
