<?php

namespace App\Http\Controllers;

use App\Models\LokasiAset;
use App\Http\Requests\StoreLokasiAsetRequest;
use App\Http\Requests\UpdateLokasiAsetRequest;

class LokasiAsetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('lokasi-aset.lokasi-aset', [
            "title" => "Lokasi Aset",
            "data" => LokasiAset::paginate(35)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('lokasi-aset.tambah-lokasi-aset', [
            "title" => "Tambah Lokasi Aset",
            "data" => LokasiAset::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreLokasiAsetRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLokasiAsetRequest $lokasi_aset)
    {
        $validatedData = $lokasi_aset->validate([
            'nama_lokasi' => 'required'
        ]);
        LokasiAset::create($validatedData);
        return redirect('/lokasi-aset')->with('pesan_berhasil', 'Data Lokasi Aset Berhasil Ditambah!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LokasiAset  $lokasiAset
     * @return \Illuminate\Http\Response
     */
    public function show(LokasiAset $lokasiAset)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LokasiAset  $lokasiAset
     * @return \Illuminate\Http\Response
     */
    public function edit(LokasiAset $lokasiAset)
    {
        return view('lokasi-aset.edit-lokasi-aset', [
            "title" => "Edit Lokasi Aset",
            "data" => $lokasiAset
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLokasiAsetRequest  $request
     * @param  \App\Models\LokasiAset  $lokasiAset
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLokasiAsetRequest $request, LokasiAset $lokasiAset)
    {
        $validatedData = $request->validate([
            'nama_lokasi' => 'required'
        ]);

        LokasiAset::where('id', $lokasiAset->id)->update($validatedData);
        return redirect('/lokasi-aset')->with('pesan_berhasil', 'Data Lokasi Aset Berhasil Diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LokasiAset  $lokasiAset
     * @return \Illuminate\Http\Response
     */
    public function destroy(LokasiAset $lokasiAset)
    {
        LokasiAset::destroy($lokasiAset->id);
        return redirect('/lokasi-aset')->with('pesan_berhasil', 'Data Lokasi Aset Berhasil Dihapus!');
    }
}
