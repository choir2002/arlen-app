<?php

namespace App\Http\Controllers;

use App\Charts\BestSellingProductChart;
use App\Http\Controllers\Controller;
use App\Models\Pembelian;
use App\Models\Penjualan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use ArielMejiaDev\LarapexCharts\LarapexChart; // Import LarapexChart


class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(BestSellingProductChart $chart)
    {
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        
        // Menghitung total penjualan pada bulan ini
        $totalJual = Penjualan::whereMonth('date', $currentMonth)
                              ->whereYear('date', $currentYear)
                              ->sum('total_payment');

        // Menghitung total pembelian pada bulan ini
        $totalBeli = Pembelian::whereMonth('date', $currentMonth)
                              ->whereYear('date', $currentYear)
                              ->sum('total');
                              
        $totalBarang = Penjualan::whereMonth('date', $currentMonth)
        ->whereYear('date', $currentYear)
        ->with('details') // Memuat relasi details
        ->get()
        ->sum(function($penjualan) {
            return $penjualan->details->sum('qty');
        });

        return view('dashboard', [
            'totalJual' => $totalJual,
            'totalBeli' => $totalBeli,
            'totalBarang' => $totalBarang,
            'chart' => $chart->build()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
