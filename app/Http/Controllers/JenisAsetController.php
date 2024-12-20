<?php

namespace App\Http\Controllers;

use App\Models\JenisAset;
use App\Http\Requests\StoreJenisAsetRequest;
use App\Http\Requests\UpdateJenisAsetRequest;

class JenisAsetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('jenis-aset.jenis-aset', [
            "title" => "Jenis Aset",
            "data" => JenisAset::paginate(35)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('jenis-aset.tambah-jenis-aset', [
            "title" => "Tambah Jenis Aset",
            "data" => JenisAset::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreJenisAsetRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreJenisAsetRequest $jenis_aset)
    {
        $validatedData = $jenis_aset->validate([
            'nama_jenis' => 'required',
            'kode_jenis' => 'required'
        ]);
        JenisAset::create($validatedData);
        return redirect('/jenis-aset')->with('pesan_berhasil', 'Data Jenis Aset Berhasil Ditambah!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JenisAset  $jenisAset
     * @return \Illuminate\Http\Response
     */
    public function show(JenisAset $jenisAset)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JenisAset  $jenisAset
     * @return \Illuminate\Http\Response
     */
    public function edit(JenisAset $jenisAset)
    {
        return view('jenis-aset.edit-jenis-aset', [
            "title" => "Edit Jenis Aset",
            "data" => $jenisAset
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateJenisAsetRequest  $request
     * @param  \App\Models\JenisAset  $jenisAset
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateJenisAsetRequest $request, JenisAset $jenisAset)
    {
        $validatedData = $request->validate([
            'kode_jenis' => 'required',
            'nama_jenis' => 'required'
        ]);

        JenisAset::where('id', $jenisAset->id)->update($validatedData);
        return redirect('/jenis-aset')->with('pesan_berhasil', 'Data Jenis Aset Berhasil Diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JenisAset  $jenisAset
     * @return \Illuminate\Http\Response
     */
    public function destroy(JenisAset $jenisAset)
    {
        JenisAset::destroy($jenisAset->id);
        return redirect('/jenis-aset')->with('pesan_berhasil', 'Data Jenis Aset Berhasil Dihapus!');
    }
}
