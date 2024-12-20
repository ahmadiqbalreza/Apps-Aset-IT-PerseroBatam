<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PublicAPPS;

class PublicAppsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('public-apps.public-apps', [
            "title" => "Public APPS",
            "data" => PublicAPPS::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Responsse
     */
    public function create()
    {
        return view('public-apps.tambah-public-apps', [
            "title" => "Tambah Public APPS",
            "data" => PublicAPPS::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $public_apps)
    {
        $validatedData = $public_apps->validate([
            'domain' => 'required',
            'directory' => 'required',
            'ip_server' => 'required',
            'port' => 'required',
            'jenis_server' => 'required',
            'kategori' => 'required'
        ]);

        PublicAPPS::create($validatedData);
        return redirect('/public-apps')->with('pesan_berhasil', 'Data Public APPS Berhasil Ditambah!');
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
    public function edit(PublicAPPS $public_app)
    {
        // dd($public_app);
        return view('public-apps.edit-public-apps', [
            "title" => "Edit Public APPS",
            "data" => $public_app
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PublicAPPS $public_app)
    {
        $validatedData = $request->validate([
            'domain' => 'required',
            'directory' => 'required',
            'ip_server' => 'required',
            'port' => 'required',
            'jenis_server' => 'required',
            'kategori' => 'required'
        ]);

        PublicAPPS::where('id', $public_app->id)->update($validatedData);
        return redirect('/public-apps')->with('pesan_berhasil', 'Data Aset Public APPS Berhasil Diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($public_apps)
    {
        PublicAPPS::destroy($public_apps);
        return redirect('/public-apps')->with('pesan_berhasil', 'Data Public APPS Berhasil Dihapus!');
    }
}
