<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Farmer;
use App\Models\SoilSample;
use App\Models\SoilSampleResult;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $monthlyData = [];
        $selectedYear = $request->input('year', Carbon::now()->year);

        // Get data for the 12 months of the selected year
        for ($i = 1; $i <= 12; $i++) {
            $date = Carbon::create($selectedYear, $i, 1);
            $monthStart = $date->copy()->startOfMonth();
            $monthEnd = $date->copy()->endOfMonth();

            $farmersCount = Farmer::whereBetween('created_at', [$monthStart, $monthEnd])->count();
            $samplesCount = SoilSample::whereBetween('created_at', [$monthStart, $monthEnd])->count();
            $analyzedCount = SoilSampleResult::whereBetween('created_at', [$monthStart, $monthEnd])->count();

            $monthlyData[] = [
                'month' => $date->format('M'), // using short month names for better chart fitting
                'returningFarmers' => $farmersCount,
                'totalSamples' => $samplesCount,
                'analyzedSamples' => $analyzedCount
            ];
        }

        // Years for the filter dropdown
        $years = range(Carbon::now()->year, 2020);

        return view('dashboard', compact('monthlyData', 'selectedYear', 'years'));
    }
}
