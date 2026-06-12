<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class PartnerController extends Controller
{
    public function index()
    {
        $Partners = Partner::paginate(10);
        return response()->json($Partners);
    }

    public function show($id)
    {
        $Partner = Partner::findOrFail($id);
        return response()->json($Partner);
    }
    public function create()
    {
        return view('farmer_requests.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'Partner_id' => 'required|integer',
            'user_id' => 'required|integer',
            'farm_id' => 'required|integer',
            // Add validation rules for other fields
        ]);

        $Partner = Partner::create($validatedData);
        return response()->json($Partner, 201);
    }

    public function update(Request $request, $id)
    {
        $Partner = Partner::findOrFail($id);

        $validatedData = $request->validate([
            'Partner_id' => 'required|integer',
            'user_id' => 'required|integer',
            'farm_id' => 'required|integer',
            // Add validation rules for other fields
        ]);

        $Partner->update($validatedData);

        return response()->json($Partner, 200);
    }

    public function destroy($id)
    {
        $Partner = Partner::findOrFail($id);
        $Partner->delete();

        return response()->json(null, 204);
    }
}
