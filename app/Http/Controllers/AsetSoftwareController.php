<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AsetSoftware;
use App\Models\Unit;

class AsetSoftwareController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('aset-software.aset-software', [
            "title" => "Data Aset Software",
            "data" => AsetSoftware::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('aset-software.tambah-aset-software', [
            "title" => "Tambah Aset Software",
            "data" => AsetSoftware::all(),
            "data_unit" => Unit::all(),
            "th" => ['2020', '2021', '2022', '2023', '2024'],
            "last_urut" => AsetSoftware::orderBy('nomor_urut', 'DESC')->first()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $aset_software)
    {
        $validatedData = $aset_software->validate([
            'nomor_urut' => 'required',
            'slug_aset' => 'required',
            'nomor_inventaris' => 'required',
            'bulan' => 'required',
            'tahun' => 'required',
            'nama_aplikasi' => 'required',
            'unit_pengguna' => '',
            'jenis_aplikasi' => '',
            'keterangan' => ''
        ]);

        $validatedData['nomor_urut'] = ltrim($validatedData['nomor_urut'], '0');
        $slug = str_replace('/', '-', $validatedData['nomor_inventaris']);
        $validatedData['slug_aset'] = $slug;

        AsetSoftware::create($validatedData);
        return redirect('/aset-software')->with('pesan_berhasil', 'Data Aset Software Berhasil Ditambah!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(AsetSoftware $aset_software)
    {
        // dd($aset_software);
        return view('aset-software.edit-aset-software', [
            "title" => "Edit Aset Software",
            "data" => $aset_software,
            "data_unit" => Unit::all(),
            "th" => ['2020', '2021', '2022', '2023', '2024'],
            "last_urut" => AsetSoftware::orderBy('nomor_urut', 'DESC')->first()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AsetSoftware $aset_software)
    {
        $validatedData = $request->validate([
            'nomor_urut' => 'required',
            'slug_aset' => 'required',
            'nomor_inventaris' => 'required',
            'bulan' => 'required',
            'tahun' => 'required',
            'nama_aplikasi' => 'required',
            'unit_pengguna' => '',
            'jenis_aplikasi' => '',
            'keterangan' => ''
        ]);

        AsetSoftware::where('id', $aset_software->id)->update($validatedData);
        return redirect('/aset-software')->with('pesan_berhasil', 'Data Aset Software Berhasil Diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($aset_software)
    {
        AsetSoftware::destroy($aset_software);
        return redirect('/aset-software')->with('pesan_berhasil', 'Data Aset Software Berhasil Dihapus!');
    }

    public function getNomorasetsoftware()
    {
        // $urut = Aset::max('nomor_urut')
        // $asets = Aset::first(); // Mengambil data terbaru
        $urut = AsetSoftware::max('nomor_urut') + 1;
        return response()->json(['nomor_urut' => $urut]);
    }
}
