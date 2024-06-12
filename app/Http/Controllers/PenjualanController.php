<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DetailPenjualan;
use App\Models\Penjualan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mendapatkan sale_id berikutnya dari database
        $nextSaleId = Penjualan::max('id') + 1;
    
        $produk = Produk::all();
        $detail_penjualan = DetailPenjualan::all();
    
        return view('penjualans.index', [
            'produks' => $produk,
            'detail_penjualans' => $detail_penjualan,
            'nextSaleId' => $nextSaleId, // Kirimkan nilai nextSaleId ke view
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
        // Validasi data
        $validatedData = $request->validate([
            'no_sale' => 'required',
            'date' => 'required',
            'name_cashier' => 'required',
            'discount' => 'required',
            'cash' => 'required',
            'return' => 'required',
            'subtotal' => 'required',
            'total_payment' => 'required',
        ]);
    
        // Simpan data penjualan
        Penjualan::create($validatedData);
    
        // Fetch detail penjualan data
        $detailPenjualan = DetailPenjualan::where('sale_id', $validatedData['no_sale'])->get();
    
        if ($request->has('export') && $request->get('export') == 'pdf') {
            // Load view 'pdf.struk' dengan data yang diberikan
            $pdf = PDF::loadView('pdf.struk', [
                'data' => $validatedData,
                'details' => $detailPenjualan
            ]);
    
            // Download file PDF dengan nama 'struk.pdf'
            return $pdf->stream('struk.pdf');
        }
    
        // Return some response or redirect after saving
        return redirect()->back()->with('success', 'Penjualan berhasil disimpan.');
    }
    
    
        
    public function addItem(Request $request)
    {
        try {
            // Validasi data yang diterima dari request
            $validatedData = $request->validate([
                'sale_id' => 'required',
                'productName' => 'required',
                'qty' => 'required',
                'unitPrice' => 'required',
                'totalHargaItem' => 'required',
            ]);
        
            // Simpan data ke dalam database detail penjualan
            DetailPenjualan::create([
                'sale_id' => $validatedData['sale_id'],
                'name_product' => $validatedData['productName'],
                'qty' => $validatedData['qty'],
                'unit_price' => $validatedData['unitPrice'],
                'total' => $validatedData['totalHargaItem']
            ]);

            // Kirim respons jika berhasil
            return response()->json(['message' => 'Data berhasil disimpan'], 200);
        } catch (\Exception $e) {
            // Tangani kesalahan dan kirim respons yang sesuai
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    
    public function updateProduk(Request $request)
    {
        // Validasi request jika diperlukan
        $request->validate([
            'idProduk' => 'required',
            'totalStok' => 'required|numeric',
        ]);

        // Perbarui data di tabel produk
        $product = Produk::find($request->idProduk);
        if (!$product) {
            return response()->json(['error' => 'Produk tidak ditemukan'], 404);
        }

        $product->qty = $request->totalStok;
        $product->save();

        return response()->json(['success' => true]);
    }
    
    
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
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
    
    public function hapus($id)
    {
        // Lakukan proses penghapusan berdasarkan id yang diterima
        DetailPenjualan::destroy($id);
    
        // Redirect pengguna ke halaman yang sesuai
        return redirect('/penjualan')->with('success', 'Data Penjualan Berhasil Dihapus');
    }
}
