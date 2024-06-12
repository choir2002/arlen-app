<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Unit;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produk = Produk::all();
        $kategori = Kategori::all();
        $unit = Unit::all();

        return view('produks.index', [
            'produks' => $produk,
            'kategoris' => $kategori,
            'units' => $unit
        ]);
    }
    public function produkExport(Request $request){
        $data = Produk::all();
    
        // Periksa apakah parameter 'export' tersedia dalam permintaan dan nilainya adalah 'pdf'
        if($request->has('export') && $request->get('export') == 'pdf'){
            // Load view 'pdf.struk' dengan data yang diberikan
            $pdf = PDF::loadView('pdf.struk', ['data' => $data]);
            
            // Download file PDF dengan nama 'struk.pdf'
            return $pdf->download('struk.pdf');
        }
    
        // Jika permintaan tidak untuk ekspor PDF, kembalikan tampilan produks.index dengan data produk
        return view('produks.index', compact('data','request'));
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
        // Mengatur nilai default jika tidak diisi
        $request->merge([
            'qty' => $request->input('qty', 0),
            'unit_price' => $request->input('unit_price', 0),
            'total' => $request->input('total', 0),
            'selling_price' => $request->input('selling_price', 0),
        ]);
    
        // Validasi data
        $validatedData = $request->validate([
            'name_product' => 'required',
            'category' => 'required',
            'unit' => 'required',
            'qty' => 'required|numeric|min:0',
            'unit_price' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
        ]);
    
        // Simpan data produk
        Produk::create($validatedData);
    
        // Redirect dengan pesan sukses
        return redirect('/produk')->with('success', 'Data Produk Berhasil Ditambahkan');
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
    public function edit(Produk $produk)
    {
        $kategoris = Kategori::all();
        $units = Unit::all();
    
        return view('produks.edit', [
            'produk' => $produk,
            'kategoris' => $kategoris,
            'units' => $units
        ]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produk $produk)
    {
        $validatedData = $request->validate([
            'name_product' => 'required',
            'category' => 'required',
            'unit' => 'required',
        ]);

        // Perbarui data pada database
        $produk->update($validatedData);
    
        return redirect('/produk')->with('success', 'Data Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produk $produk)
    {
        Produk::destroy($produk->id);
        return redirect('/produk')->with('success', 'Data Produk Berhasil Dihapus');
    }
}
