<?php

namespace App\Http\Controllers;

use App\Models\FarmerRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SampleResultsApproved;
use App\Models\Farmer;
use App\Models\SoilSample;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
        $startDate = $request->start_date;
        $endDate = $request->end_date;

        $data['search'] = $query;
        $data['start_date'] = $startDate;
        $data['end_date'] = $endDate;

        $farmerRequests = FarmerRequest::with('farmer', 'farm');

        // Apply role-based scoping FIRST
        if (Auth::user()->role_id == 2) {
            $farmerRequests->whereHas('farmer', function ($q) {
                $q->where('user_id', Auth::user()->id);
            });
        }

        // Apply text search
        if (!empty($query)) {
            $farmerRequests->where(function($q) use ($query) {
                $q->where('contact_phone', 'LIKE', '%' . $query . '%')
                  ->orWhere('receipt_number', 'LIKE', '%' . $query . '%')
                  ->orWhereHas('farmerRequestSamples', function ($sq) use ($query) {
                      $sq->where('laboratory_number', 'LIKE', '%' . $query . '%');
                  })
                  ->orWhereHas('farmer', function ($fq) use ($query) {
                      $fq->where('farmer_name', 'LIKE', '%' . $query . '%');
                  });
            });
        }

        // Apply date range
        if (!empty($startDate) && !empty($endDate)) {
            $farmerRequests->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
        } elseif (!empty($startDate)) {
            $farmerRequests->where('created_at', '>=', $startDate . ' 00:00:00');
        } elseif (!empty($endDate)) {
            $farmerRequests->where('created_at', '<=', $endDate . ' 23:59:59');
        }

        $data['farmerRequests'] = $farmerRequests->paginate(10)->withQueryString();
        
        return view('request.sample_requests', $data);
    }
    public function add_farmer_request()
    {
        if (Auth::user()->role_id == 2) {
            $data['farmer_information'] = null;
            $data['farmer_request']     = null;
            $data['soil_samples']       = collect();

            if (Auth::user()->id !== "") {
                $data['farmer_information'] = Farmer::where('user_id', Auth::user()->id)
                    ->with('user', 'country', 'province', 'city', 'district', 'farm')
                    ->first();
                return view('request.soiljobs', $data);
            } else {
                return back();
            }
        } else {
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
            'farmer_id' => 'required|integer',
            'farm_id' => 'required|integer',
            'contact_phone' => 'required|string',
            // make number_of_samples optional for approval
            'number_of_samples' => 'sometimes|integer',
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
        $request->validate([
            'request_id' => 'required|integer',
            'plot_id'    => 'required|integer',
            'crop'       => 'nullable|string',
            'land_size'  => 'nullable|numeric',
        ]);

        $labNumber = $request->laboratory_number ?: ('LAB-' . strtoupper(uniqid()));

        $sampleData = [
            'plot_id'                => $request->plot_id,
            'sample_reference'       => $request->sample_reference,
            'type_of_previous_crop'  => $request->type_of_previous_crop,
            'date_of_ploughing'      => $request->date_of_ploughing,
            'date_planted'           => $request->date_planted,
            'previous_crop_yield'    => $request->previous_crop_yield,
            'crop'                   => $request->crop,
            'crop_to_be_irrigated'   => $request->crop_to_be_irrigated,
            'planting_date'          => $request->planting_date,
            'plant_pop_per_ha'       => $request->plant_pop_per_ha,
            'yield_target_kg_per_ha' => $request->yield_target_kg_per_ha,
            'land_size'              => $request->land_size,
            'manure_to_be_used'      => $request->manure_to_be_used,
            'fertilizer_to_be_used'  => $request->fertilizer_to_be_used,
            'lat'                    => $request->lat,
            'long'                   => $request->long,
        ];

        // Update existing sample if lab number already exists for this request,
        // otherwise create a new one — prevents duplicate key errors on edit.
        SoilSample::updateOrCreate(
            [
                'request_id'       => $request->request_id,
                'laboratory_number' => $labNumber,
            ],
            $sampleData
        );

        return redirect()->route('farmer_requests.create', ['id' => $request->request_id]);
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
        $data['farmer_information'] = null;
        $data['farmer_request']     = null;
        $data['soil_samples']       = collect();

        if (!empty($id)) {
            // Load the farmer request and its soil samples
            $data['farmer_request'] = FarmerRequest::where('request_id', $id)
                ->with('farmer.user', 'farmer.country', 'farmer.province', 'farmer.city', 'farmer.district')
                ->with('farmerSampleRecRequest')
                ->with('farm')
                ->first();

            $data['soil_samples'] = SoilSample::where('request_id', $id)->get();
        } else {
            // No request ID – show the blank farmer info
            $data['farmer_information'] = Farmer::where('user_id', Auth::id())
                ->with('user', 'country', 'province', 'city', 'district', 'farm')
                ->first();
        }

        return view('request.soiljobs', $data);
    }

    public function update(Request $request, $id)
    {


        $validatedData = $request->validate([
            'number_of_samples' => 'nullable|integer',
            'receipt_number' => 'nullable|string',
            'advisor_name' => 'nullable|string',
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

    public function destroySoilSample($id)
    {
        $soilSample = SoilSample::where('sample_id', $id)->firstOrFail();
        $soilSample->delete();

        return back()->with('success', 'Sample deleted successfully.');
    }
}
