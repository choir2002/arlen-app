<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pembelian;
use App\Models\Produk;
use App\Models\Supplier;
use Illuminate\Http\Request;

class PembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produk = Produk::all();
        $supplier = Supplier::all();

        return view('pembelians.index', [
            'produks' => $produk,
            'suppliers' => $supplier,
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
        $validatedData = $request->validate([
            'date' => 'required',
            'name_supplier' => 'required',
            'name_product' => 'required',
            'category' => 'required',
            'unit' => 'required',
            'qty' => 'required',
            'unit_price' => 'required',
            'selling_price' => 'required',
            'total' => 'required',

            'total_stok' => 'required',
            'total_semua' => 'required',
        ]);
    
        Pembelian::create($validatedData);
        
        $existingPurchase = Produk::where([
            'name_product' => $validatedData['name_product'],
            'category' => $validatedData['category'],
            'unit' => $validatedData['unit'],
        ])->first();
    
        if ($existingPurchase) {
            $existingPurchase->update([
                'qty' => $validatedData['total_stok'],
                'unit_price' => $validatedData['unit_price'],
                'selling_price' => $validatedData['selling_price'],
                'total' => $validatedData['total_semua'],
            ]);
        }
    
        return redirect('/pembelian')->with('success', 'Pembelian Berhasil');
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
