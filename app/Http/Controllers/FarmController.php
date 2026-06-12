<?php

namespace App\Http\Controllers;

use App\Models\Farm;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class FarmController extends Controller
{
    public function index()
    {
        $farms = Farm::paginate(10);
        return response()->json($farms);
    }

    public function show($id)
    {
        $farm = Farm::findOrFail($id);
        return view('farmer.farm_show', compact('farm'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'farm_name' => 'required|string',
            'farmer_id' => 'required|integer',
            // Add validation rules for other fields
        ]);

        $farm = Farm::create($request->all());
        return back();
    }
    public function create()
    {
        return view('farmer_requests.create');
    }

    public function update(Request $request, $id)
    {
        $farm = Farm::findOrFail($id);

        $validatedData = $request->validate([
            'farm_id' => 'required|integer',
            'user_id' => 'required|integer',
            'farm_name' => 'required|string',
            'farmer_id' => 'required|integer',
            // Add validation rules for other fields
        ]);

        $farm->update($validatedData);

        return response()->json($farm, 200);
    }

    public function destroy($id)
    {
        $farm = Farm::findOrFail($id);
        $farm->delete();

        return response()->json(null, 204);
    }
}

