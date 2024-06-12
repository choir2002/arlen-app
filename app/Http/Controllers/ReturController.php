<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\Retur;
use Illuminate\Http\Request;

class ReturController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $retur = Retur::all();
        $produk = Produk::all();
        return view('returs.index', ['returs' => $retur],['produks' => $produk]);
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
        // Validasi data
        $validatedData = $request->validate([
            'date' => 'required',
            'name_product' => 'required',
            'category' => 'required',
            'unit' => 'required',
            'stock' => 'required|numeric|min:0',
            'unit_price' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0',
            'qty' => 'required|numeric|min:0',
            'information' => 'required',
            'total_stock' => 'required',
        ]);
    
        // Simpan data produk
        Retur::create($validatedData);
        $existingPurchase = Produk::where([
            'name_product' => $validatedData['name_product'],
            'category' => $validatedData['category'],
            'unit' => $validatedData['unit'],
        ])->first();
    
        if ($existingPurchase) {
            $existingPurchase->update([
                'qty' => $validatedData['total_stock'],
            ]);
        }
        // Redirect dengan pesan sukses
        return redirect('/retur')->with('success', 'Data Retur Berhasil Ditambahkan');
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
