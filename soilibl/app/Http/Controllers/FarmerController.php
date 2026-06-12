<?php

namespace App\Http\Controllers;

use App\Models\Farmer;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class FarmerController extends Controller
{
    public function index()
    {
        // $farmers = Farmer::paginate(10);
       
        if (Auth::user()->role_id == 2) {
            $data['farmer'] = Farmer::with('farm')->where('user_id', Auth::user()->id)->first();
            return view('farmer.viewmore', $data);
        }else{
            $data['farmers'] = Farmer::paginate(10);
            return view('farmer.view', $data);
        }

    }

    public function show($id)
    {
        $data['farmer'] = Farmer::with('farm')->findOrFail($id);
        // $data['farm'] = $data['farmer']->farm()->paginate(10);
        // dd($data);
        return view('farmer.viewmore', $data);
        // return response()->json($farmer);
    }
    public function search(Request $request)
    {
        $query = $request->search;
        $data['search'] = $request->search;
        $data['farmers'] = Farmer::where('contact_phone', 'LIKE', '%' . $query . '%')
            ->orwhere('farmer_name', 'LIKE', '%' . $query . '%')->paginate(10);
        // ->orWhereHas('user', function ($query) use ($query) {
        //     $query->where('name', 'LIKE', '%' . $query . '%');
        // })->paginate(10);
        // dd($data);
        return view('farmer.view', $data);
    }
    public function create()
    {
        return view('farmer.add');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'farmer_name' => 'required|string|max:255',
            'phone' => 'required|numeric|min:10|unique:users',
            'email' => 'required|string|email|max:225|unique:users',
        ]);
        // return Validator::make($data, [
        //     'name' => ['required', 'string', 'max:255'],
        //     'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        //     'password' => ['required', 'string', 'min:8', 'confirmed'],
        // ]);
        $user = User::create([
            'name' => $request->farmer_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'role_id' => 2,
            'password' => Hash::make($request->password ?? 'Test123'),
        ]);
        if ($user) {
            $data = $request->all();
            $data['user_id'] = $user->id;
            $data['surname'] = $request->last_name;
            $data['contact_phone'] = $request->phone;
            $farmer = Farmer::create($data);
        }
        return back();
    }

    public function update(Request $request, $id)
    {
        $farmer = Farmer::findOrFail($id);

        $validatedData = $request->validate([
            'farmer_id' => 'required|integer',
            'user_id' => 'required|integer',
            // Add validation rules for other fields
        ]);

        $farmer->update($validatedData);

        return response()->json($farmer, 200);
    }

    public function destroy($id)
    {
        $farmer = Farmer::findOrFail($id);
        $farmer->delete();

        return response()->json(null, 204);
    }
}
