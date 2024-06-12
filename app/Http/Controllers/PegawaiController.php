<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $pegawai = User::where('is_admin',false)->get(); 
        return view('pegawais.index', ['pegawai' => $pegawai]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pegawais.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'gender' => 'required',
            'position' => 'required',
            'is_cashier' => 'required',
        ]);
    
        User::create($validatedData);
    
        return redirect('/pegawai')->with('success', 'Data Pegawai Berhasil Ditambahkan');
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
    public function edit(User $pegawai)
    {
        return view('pegawais.edit',[
            'pegawai' => $pegawai
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $pegawai)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'position' => 'required',
            'gender' => 'required',
            'is_cashier' => 'required',
        ]);

        // Perbarui data pada database
        $pegawai->update($validatedData);
    
        return redirect('/pegawai')->with('success', 'Data Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $pegawai)
    {
        User::destroy($pegawai->id);
        return redirect('/pegawai')->with('success', 'Data Pegawai Berhasil Dihapus');
    } 
}
