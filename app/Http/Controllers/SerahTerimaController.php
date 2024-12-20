<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SerahTerima;
use App\Models\Unit;
use App\Models\LokasiAset;
use App\Exports\SerahTerimaExport;
use Maatwebsite\Excel\Facades\Excel;
use Dompdf\Dompdf;
use Dompdf\Options;

class SerahTerimaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('serah-terima.index', [
            "title" => "Serah Terima",
            "data" => SerahTerima::all(),
            "data_unit" => Unit::all(),
            "data_lokasi" => LokasiAset::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function serahterimaexport()
    {
        return Excel::download(new SerahTerimaExport, 'tes.xlsx');
    }

    public function exportToPdfbast()
    {
        // Ambil data berdasarkan ID nomor 1
        $data = SerahTerima::where('nomor', 1)->first();

        if (!$data) {
            abort(404, "Data tidak ditemukan.");
        }

        // Kirimkan data ke view
        $pdfView = view('pdf.bast-download', compact('data'))->render();

        // Konfigurasi DomPDF
        $options = new \Dompdf\Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $options->set('isRemoteEnabled', true);
        $dompdf = new \Dompdf\Dompdf($options);
        $dompdf->loadHtml($pdfView);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Kirim PDF ke browser
        return $dompdf->stream('BAST_PT_Persero_Batam.pdf', ['Attachment' => true]);
    }

}
