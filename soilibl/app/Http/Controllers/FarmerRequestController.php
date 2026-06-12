<?php

namespace App\Http\Controllers;

use App\Models\FarmerRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SampleResultsApproved;
use App\Models\Farmer;
use App\Models\SoilSample;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Helper;

class FarmerRequestController extends Controller
{
    public function index()
    {
        $farmerRequests = FarmerRequest::with('farmer')->with('farm');

        if (Auth::user()->role_id == 2) {
            $data['farmerRequests'] = $farmerRequests->whereHas('farmer', function ($q) {
                $q->where('user_id',  Auth::user()->id);
            })->paginate(10);
        } else {
            $data['farmerRequests'] = $farmerRequests->paginate(10);
        }

        return view('request.sample_requests', $data);
    }


    public function search(Request $request)
    {

        $query = $request->search;
        $data['search'] = $request->search;
        $data['farmerRequests'] = FarmerRequest::where('contact_phone', 'LIKE', '%' . $query . '%')
            ->orWhereHas('farmerRequestSamples', function ($q) use ($query) {
                $q->where('laboratory_number', 'LIKE', '%' . $query . '%');
            });

        if (Auth::user()->role_id == 2) {
            $data['farmerRequests'] = $data['farmerRequests']->whereHas('farmer', function ($q) {
                $q->where('user_id',  Auth::user()->id);
            });
            $data['farmerRequests'] = $data['farmerRequests']->orWhereHas('farmer', function ($q) use ($query) {
                $q->where('farmer_name', 'LIKE', '%' . $query . '%')->orwhere('contact_phone', 'LIKE', '%' . $query . '%');
            })
                ->paginate(10);
        } else {
            $data['farmerRequests'] = $data['farmerRequests']->orWhereHas('farmer', function ($q) use ($query) {
                $q->where('farmer_name', 'LIKE', '%' . $query . '%')->orwhere('contact_phone', 'LIKE', '%' . $query . '%');
            })->paginate(10);
        }





        return view('request.sample_requests', $data);
    }
    public function add_farmer_request()
    {
        
        if (Auth::user()->role_id == 2) {
        $data['farmer_information'] = null;
        $data['farmer_request'] = null;
        if (Auth::user()->id !== "") {
            $data['farmer_information'] = Farmer::where('user_id', Auth::user()->id)->with('user')->with('country')->with('province')->with('city')->with('district')->with('farm')->first();
            return view('request.soiljobs', $data);
        } else {
            return back();
        }}else{
            $data['farmers'] = Farmer::with('user')->paginate(10);
            return view('request.add_request', $data);
        }

      
    }

    public function farmerRequestSoilsamples($id)
    {
        $farmerRequests = FarmerRequest::where('request_id', $id)->with('farmerRequestSamples.plot')->paginate(10);

        // return view('request.soiljob');
        return response()->json($farmerRequests);
    }
    public function show($id)
    {
        $farmerRequest = FarmerRequest::findOrFail($id);
        return response()->json($farmerRequest);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            // 'farmer_name' => 'required',
            // 'user_id' => 'required|integer',
            // Add validation rules for other critical fields
        ]);

        $requestInformation['farmer_id'] = $request->farmer_id;
        $requestInformation['farm_id'] = $request->farm_id;
        $requestInformation['receipt_number'] = $request->receipt_number;
        $requestInformation['postal_address'] = $request->postal_address;
        $requestInformation['contact_phone'] = $request->contact_phone;
        $requestInformation['number_of_samples'] = $request->number_of_samples;
        $requestInformation['earliest_date_of_collection'] = $request->earliest_date_of_collection;
        $requestInformation['farm_name'] = $request->farm_name;
        $requestInformation['date_received'] = $request->date_received;
        $requestInformation['date_sampled'] = $request->date_sampled;
        $requestInformation['ica_locality'] = $request->ica_locality;
        $requestInformation['email'] = $request->email;
        $requestInformation['advisor_name'] = $request->advisor_name;
        $requestInformation['approved'] = $request->approved;
        $requestInformation['average_sub_samples_taken'] = $request->average_sub_samples_taken;

        $farmerRequestId = FarmerRequest::create($requestInformation);
        // dd()
        return redirect(route('farmer_requests.create', $farmerRequestId->request_id));
        // Additional logic for sending email to the farmer
        // $farmerEmail = $farmerRequest->email;
        // Mail::to($farmerEmail)->send(new SampleResultsApproved());

        // return response()->json($farmerRequestId, 201);
    }

    public function saveSoilSample(Request $request)

    {
        $validatedData = $request->validate([
            'request_id' => 'required',
            // 'user_id' => 'required|integer',
            // Add validation rules for other critical fields
        ]);

        $sampleInformation['request_id'] = $request->request_id;
        $sampleInformation['laboratory_number'] = $request->laboratory_number !== null ? $request->laboratory_number  : generate_lab_number();
        $sampleInformation['plot_id'] = $request->plot_id;
        $sampleInformation['sample_reference'] = $request->sample_reference;
        $sampleInformation['type_of_previous_crop'] = $request->type_of_previous_crop;
        $sampleInformation['date_of_ploughing'] = $request->date_of_ploughing;
        $sampleInformation['date_planted'] = $request->date_planted;
        $sampleInformation['previous_crop_yield'] = $request->previous_crop_yield;
        $sampleInformation['crop'] = $request->crop;
        $sampleInformation['crop_to_be_irrigated'] = $request->crop_to_be_irrigated;
        $sampleInformation['planting_date'] = $request->planting_date;
        $sampleInformation['plant_pop_per_ha'] = $request->plant_pop_per_ha;
        $sampleInformation['yield_target_kg_per_ha'] = $request->yield_target_kg_per_ha;
        $sampleInformation['land_size'] = $request->land_size;
        $sampleInformation['manure_to_be_used'] = $request->manure_to_be_used;
        $sampleInformation['fertilizer_to_be_used'] = $request->fertilizer_to_be_used;
        $sampleInformation['lat'] = $request->lat;
        $sampleInformation['long'] = $request->long;
        // dd($request->laboratory_number);
        // $farmerRequest = SoilSample::where('request_id',)->where('laboratory_number',)->update($sampleInformation);
        $farmerRequest = SoilSample::create($sampleInformation);
        return back();
        // dd($farmerRequest->laboratory_number);


    }

    // for not logged in user
    public function verifyfarmer($id = "")
    {
        $data['farmer_information'] = null;
        $data['farmer_request'] = null;
        if ($id !== "") {
            $data['farmer_information'] = Farmer::where('user_id', $id)->with('user')->with('country')->with('province')->with('city')->with('district')->with('farm')->first();
        } else {
            return back();
        }

        return view('request.soiljobs', $data);
    }

    //for logged in user
    public function create($id = "")
    {
        $userId = Auth::id();
        $data['farmer_information'] = null;
        $data['farmer_request'] = null;
        if ($id == "") {
            $data['farmer_information'] = Farmer::where('user_id', 1)->with('user')->with('country')->with('province')->with('city')->with('district')->with('farm')->first();
        } else {
            $data['farmer_request'] = FarmerRequest::where('request_id', $id)->with('farmer.user', 'farmer.country', 'farmer.province', 'farmer.city', 'farmer.district')->with('farm')->first();
        }
        // dd($data);
        $data['soil_samples'] = SoilSample::where('request_id', $id)->get();
        // dd($data['farmer_iinformation']);
        // $data['farmer_name'] = 'take taku';
        return view('request.soiljobs', $data);
    }

    public function update(Request $request, $id)
    {


        $validatedData = $request->validate([
            // 'farmer_name' => 'required',
            // 'user_id' => 'required|integer',
            // Add validation rules for other critical fields
        ]);

        // $requestInformation['farmer_id'] = $request->farmer_id;
        // $requestInformation['farm_id'] = $request->farm_id;
        $requestInformation['receipt_number'] = $request->receipt_number;
        // $requestInformation['postal_address'] = $request->postal_address; 
        // $requestInformation['contact_phone'] = $request->contact_phone; 
        $requestInformation['number_of_samples'] = $request->number_of_samples;
        $requestInformation['earliest_date_of_collection'] = $request->earliest_date_of_collection;
        // $requestInformation['farm_name'] = $request->farm_name; 
        $requestInformation['date_received'] = $request->date_received;
        // $requestInformation['date_sampled'] = $request->date_sampled; 
        // $requestInformation['ica_locality'] = $request->ica_locality; 
        // $requestInformation['email'] = $request->email;
        $requestInformation['advisor_name'] = $request->advisor_name;
        $requestInformation['approved'] = $request->approved;
        // $requestInformation['average_sub_samples_taken'] = $request->average_sub_samples_taken; 

        $farmerRequestId = FarmerRequest::findOrFail($id)->update($requestInformation);
        // dd()
        return back(); //redirect(route('farmer_requests.create',$id));

    }

    public function destroy($id)
    {
        $farmerRequest = FarmerRequest::findOrFail($id);
        $farmerRequest->delete();

        return response()->json(null, 204);
    }
}
