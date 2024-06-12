<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DetailPenjualan;
use App\Models\Penjualan;
use Illuminate\Http\Request;

class LaporanPenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Lpenjualan = Penjualan::all();
        return view('laporans.penjualan', ['Lpenjualans' => $Lpenjualan]);
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
    public function edit($id)
    {
        $penjualan = Penjualan::findOrFail($id);
        // $detail_penjualan = DetailPenjualan::where('sale_id', $id)->get()->toArray();
        $detail_penjualan = DetailPenjualan::where('sale_id', $id)->get(); // Menggunakan get() untuk mendapatkan semua detail penjualan terkait
        return view('penjualans.detail', ['penjualans' => $penjualan, 'detail_penjualans' => $detail_penjualan]);
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
