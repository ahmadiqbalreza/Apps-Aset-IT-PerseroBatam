<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\Aset;
use App\Models\JenisAset;
use App\Models\Unit;
use App\Models\LokasiAset;
use App\Models\AsetSoftware;
use App\Models\PublicAPPS;
use App\Http\Requests\StoreAsetRequest;
use App\Http\Requests\UpdateAsetRequest;
use App\Exports\AsetExport;
use App\Exports\JenisExport;
use App\Exports\LokasiExport;
use App\Imports\AsetImport;
use Dompdf\Dompdf;
use Dompdf\Options;

class AsetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        // dd(request('cari_data'));
        return view('data-aset.data-aset', [
            "title" => "Data Aset",
            "data" => Aset::orderBy('nomor_urut', 'ASC')->get(),
            "data_jenis" => JenisAset::all(),
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
        $bulanList = [
            ['value' => 'I', 'label' => 'Januari'],
            ['value' => 'II', 'label' => 'Februari'],
            ['value' => 'III', 'label' => 'Maret'],
            ['value' => 'IV', 'label' => 'April'],
            ['value' => 'V', 'label' => 'Mei'],
            ['value' => 'VI', 'label' => 'Juni'],
            ['value' => 'VII', 'label' => 'Juli'],
            ['value' => 'VIII', 'label' => 'Agustus'],
            ['value' => 'IX', 'label' => 'September'],
            ['value' => 'X', 'label' => 'Oktober'],
            ['value' => 'XI', 'label' => 'November'],
            ['value' => 'XII', 'label' => 'Desember'],
        ];

        // $last_urut = Aset::orderBy('nomor_urut', 'ASC')->get()->last();

        // if ($last_urut && property_exists($last_urut, 'nomor_urut')) {
        //     $nomorUrut = sprintf('%04d', $last_urut->nomor_urut + 1);
        // } else {
        //     $nomorUrut = '0001';
        // }

        return view('data-aset.tambah-aset', [
            "title" => "Tambah Aset",
            "data" => Aset::all(),
            "data_jenis" => JenisAset::all(),
            "data_unit" => Unit::all(),
            "data_lokasi" => LokasiAset::all(),
            "bln" => $bulanList,
             "th" => range(2005, 2025),
            "last_urut" => Aset::orderBy('nomor_urut', 'DESC')->first()
        ]);

        // $ss = Aset::orderBy('nomor_urut', 'DESC')->first();
        // dd($ss);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAsetRequest  $request
     * @return \Illuminate\Http\Response
     */
public function store(StoreAsetRequest $aset)
{
    // Validasi data
    $validatedData = request()->validate([
        'kategori_aset' => 'required',
        'nomor_urut' => 'required',
        'slug_aset' => 'required',
        'nomor_inventaris' => 'required',
        'bulan' => 'required',
        'tahun' => 'required',
        'jenis_id' => 'required',
        'merek' => 'required',
        'processor' => '',
        'ram' => '',
        'hdd' => '',
        'pengguna' => 'required',
        'unit_id' => 'required',
        'lokasi_id' => 'required',
        'status' => 'required',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Cek apakah nomor_urut sudah ada
    $duplicate = Aset::where('nomor_urut', $validatedData['nomor_urut'])->first();

   if ($duplicate) {
        // Jika duplikat ditemukan, kembali ke halaman form dengan pesan error
        return redirect('/aset')->with('pesan_gagal', 'Gagal disimpan ke database karena data DUPLIKAT!');
    }

    // Proses image jika ada
    if (isset($validatedData['image'])) {
        // Gantilah time() dengan nomor_inventaris, dan pastikan mengganti karakter '/' dengan '-'
        $imageName = str_replace('/', '-', $validatedData['nomor_inventaris']).'.'.$validatedData['image']->extension();

        // Dapatkan path gambar sementara
        $imagePath = $validatedData['image']->getRealPath();

        // Dapatkan tipe gambar berdasarkan ekstensi
        $extension = $validatedData['image']->extension();

        if ($extension == 'jpeg' || $extension == 'jpg') {
            $img = imagecreatefromjpeg($imagePath);
            imagejpeg($img, public_path('images_aset/'.$imageName), 75);
            imagedestroy($img);
        } elseif ($extension == 'png') {
            $img = imagecreatefrompng($imagePath);
            imagepng($img, public_path('images_aset/'.$imageName), 6);
            imagedestroy($img);
        } elseif ($extension == 'gif') {
            $img = imagecreatefromgif($imagePath);
            imagegif($img, public_path('images_aset/'.$imageName));
            imagedestroy($img);
        }

        // Simpan path gambar ke database
        $validatedData['image'] = 'images_aset/'.$imageName;
    } else {
        $validatedData['image'] = '-';
    }

    // Proses nomor urut dan slug
    $validatedData['nomor_urut'] = ltrim($validatedData['nomor_urut'], '0');
    $slug = str_replace('/', '-', $validatedData['nomor_inventaris']);
    $validatedData['slug_aset'] = $slug;

    // Simpan data aset ke database
    Aset::create($validatedData);

    // Redirect dengan pesan sukses
    return redirect('/aset')->with('pesan_berhasil', 'Data Aset Berhasil Ditambah!');
}


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Aset  $aset
     * @return \Illuminate\Http\Response
     */
    public function show(Aset $aset)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Aset  $aset
     * @return \Illuminate\Http\Response
     */
    public function edit(Aset $aset)
    {
        $bulanList = [
            ['value' => 'I', 'label' => 'Januari'],
            ['value' => 'II', 'label' => 'Februari'],
            ['value' => 'III', 'label' => 'Maret'],
            ['value' => 'IV', 'label' => 'April'],
            ['value' => 'V', 'label' => 'Mei'],
            ['value' => 'VI', 'label' => 'Juni'],
            ['value' => 'VII', 'label' => 'Juli'],
            ['value' => 'VIII', 'label' => 'Agustus'],
            ['value' => 'IX', 'label' => 'September'],
            ['value' => 'X', 'label' => 'Oktober'],
            ['value' => 'XI', 'label' => 'November'],
            ['value' => 'XII', 'label' => 'Desember'],
        ];

        return view('data-aset.edit-aset', [
            // "title" => "Tambah Aset",
            // "data" => $aset,
            // "data_jenis" => JenisAset::all(),
            // "data_lokasi" => LokasiAset::all(),
            // "data_unit" => Unit::all(),
            // "th" => ['2020', '2021', '2022', '2023', '2024']

            "title" => "Edit Aset",
            "data" => $aset,
            "data_jenis" => JenisAset::all(),
            "data_unit" => Unit::all(),
            "data_lokasi" => LokasiAset::all(),
            "bln" => $bulanList,
             "th" => range(2005, 2024),
            "last_urut" => Aset::orderBy('nomor_urut', 'DESC')->first()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAsetRequest  $request
     * @param  \App\Models\Aset  $aset
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAsetRequest $request, Aset $aset)
    {
        $validatedData = $request->validate([
                'kategori_aset' => 'required',
                'nomor_urut' => 'required',
                'slug_aset' => 'required',
                'nomor_inventaris' => 'required',
                'bulan' => 'required',
                'tahun' => 'required',
                'jenis_id' => 'required',
                'merek' => 'required',
                'processor' => '',
                'ram' => '',
                'hdd' => '',
                'pengguna' => 'required',
                'unit_id' => 'required',
                'lokasi_id' => 'required',
                'status' => 'required',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if (isset($validatedData['image'])) {
            // Gantilah time() dengan nomor_inventaris, dan pastikan mengganti karakter '/' dengan '-'
            $imageName = str_replace('/', '-', $validatedData['nomor_inventaris']).'.'.$validatedData['image']->extension();

            // Dapatkan path gambar sementara
            $imagePath = $validatedData['image']->getRealPath();

            // Dapatkan tipe gambar berdasarkan ekstensi
            $extension = $validatedData['image']->extension();

            if ($extension == 'jpeg' || $extension == 'jpg') {
                // Buat resource gambar dari file JPEG
                $img = imagecreatefromjpeg($imagePath);

                // Kompres gambar JPEG dan simpan ke path baru dengan kualitas 75%
                imagejpeg($img, public_path('images_aset/'.$imageName), 75);

                // Bebaskan resource memori
                imagedestroy($img);
            } elseif ($extension == 'png') {
                // Buat resource gambar dari file PNG
                $img = imagecreatefrompng($imagePath);

                // Kompres gambar PNG dan simpan ke path baru (nilai 0 - 9 untuk kompresi PNG)
                imagepng($img, public_path('images_aset/'.$imageName), 6);

                // Bebaskan resource memori
                imagedestroy($img);
            } elseif ($extension == 'gif') {
                // Buat resource gambar dari file GIF
                $img = imagecreatefromgif($imagePath);

                // Simpan file GIF tanpa perubahan kompresi (GIF tidak memiliki opsi kualitas seperti JPEG/PNG)
                imagegif($img, public_path('images_aset/'.$imageName));

                // Bebaskan resource memori
                imagedestroy($img);
            }

            // Simpan path gambar ke database
            $validatedData['image'] = 'images_aset/'.$imageName;
            } else {
            // Jika tidak ada gambar, simpan "-" ke dalam database
            $validatedData['image'] = '-';
            }

        $slug = str_replace('/', '-', $validatedData['nomor_inventaris']);
        $validatedData['slug_aset'] = $slug;

        Aset::where('nomor_urut', $aset->nomor_urut)->update($validatedData);
        if ($aset->update($validatedData)) {
            return redirect('/aset')->with('pesan_berhasil', 'Data Aset Berhasil Diupdate!');
        } else {
            return redirect()->back()->with('pesan_gagal', 'Gagal mengupdate data aset.');
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Aset  $aset
     * @return \Illuminate\Http\Response
     */
    public function destroy(Aset $aset)
    {
        Aset::destroy($aset->nomor_urut);
        return redirect('/aset')->with('pesan_berhasil', 'Data Aset Berhasil Dihapus!');
    }

    // Fungsi Halaman Dashboard
    public function dashboard()
    {
        $count_jenis = DB::table('jenis_asets')
            ->leftJoin('asets', 'asets.jenis_id', '=', 'jenis_asets.id')
            ->select('jenis_asets.nama_jenis', DB::raw('COUNT(asets.nomor_urut) AS total_data'))
            ->groupBy('jenis_asets.nama_jenis')
            ->get();

        $count_lokasi = DB::table('lokasi_asets')
            ->leftJoin('asets', 'asets.lokasi_id', '=', 'lokasi_asets.id')
            ->select('lokasi_asets.nama_lokasi', DB::raw('COUNT(asets.nomor_urut) AS total_data'))
            ->groupBy('lokasi_asets.nama_lokasi')
            ->get();

        $count_kode_jenis = DB::table('jenis_asets')
            ->leftJoin('asets', 'jenis_asets.id', '=', 'asets.jenis_id')
            ->select('asets.tahun', DB::raw('COUNT(asets.jenis_id) AS total_data'))
            ->whereNotNull('asets.tahun')
            ->groupBy('asets.tahun')
            ->orderBy('asets.tahun')
            ->get();
            
        $count_unit = DB::table('units')
            ->leftJoin('asets', 'units.id', '=', 'asets.unit_id')
            ->select('units.nama_unit', DB::raw('COUNT(asets.unit_id) AS total_data'))
            ->groupBy('units.nama_unit')
            ->get();

        $count_kritikal = DB::table('asets')
            ->where('kategori_aset', 'Kritikal')
            ->count();  

        $count_non_kritikal = DB::table('asets')
            ->where('kategori_aset', 'Non-Kritikal')
            ->count();

        $data_count_tabel = DB::table('lokasi_asets')
        ->leftJoin('asets', 'asets.lokasi_id', '=', 'lokasi_asets.id')
        ->select('lokasi_asets.nama_lokasi', 'asets.tahun', DB::raw('COUNT(asets.nomor_urut) AS total_data'))
        ->groupBy('lokasi_asets.nama_lokasi', 'asets.tahun') // Tambahkan grouping untuk tahun dan lokasi
        ->get();

        $count_kritikal_public_apps = DB::table('public_apps')
            ->where('kategori', 'Kritikal')
            ->count();
        $count_non_kritikal_public_apps = DB::table('public_apps')
            ->where('kategori', 'Non-Kritikal')
            ->count();
        $count_production_public_apps = DB::table('public_apps')
            ->where('jenis_server', 'Production')
            ->count();
        $count_development_public_apps = DB::table('public_apps')
            ->where('jenis_server', 'Development')
            ->count();
        $count_public_apps = DB::table('public_apps')->count();

        return view('dashboard', [
            "title" => "Dashboard",
            'data_count' => $count_jenis,
            'data_count_lokasi' => $count_lokasi,
            'data_count_kode_jenis' => $count_kode_jenis,
            'data_count_unit' => $count_unit,
            'data_count_kritikal' => $count_kritikal,
            'data_count_non_kritikal' => $count_non_kritikal,
            'data_count_kritikal_public_apps' => $count_kritikal_public_apps,
            'data_count_non_kritikal_public_apps' => $count_non_kritikal_public_apps,
            'data_count_production_public_apps' => $count_production_public_apps,
            'data_count_development_public_apps' => $count_development_public_apps,
            'data_count_public_apps' => $count_public_apps,
            "datanonkritikalaset" => Aset::where('kategori_aset', 'Non-Kritikal')->orderBy('kategori_aset')->get(),
            "datakritikalaset" => Aset::where('kategori_aset', 'Kritikal')->orderBy('kategori_aset')->get(),
            "datanonkritikalpublicapp" => PublicAPPS::where('kategori', 'Non-Kritikal')->orderBy('ip_server')->get(),
            "datakritikalpublicapp" => PublicAPPS::where('kategori', 'Kritikal')->orderBy('ip_server')->get(),
            "datapublicapps" => PublicAPPS::all(),
            "data_jenis" => JenisAset::all(),
            "data_lokasi" => LokasiAset::all(),
            'data_tabel' => $data_count_tabel,
        ]);
        // dd($count_kode_jenis);
    }

    public function generateBarcode()
    {
        return view('data-aset.generate-barcode', [
            "title" => "Barcode Aset",
            "data" => Aset::all(),
        ]);
    }


    // Fungsi untuk export-import ke excel
    public function exportToExcelAllAset()
    {
        // return Excel::download(new AsetExport, 'Aset.xlsx');
        $fields = ['nomor_urut', 'slug_aset', 'nomor_inventaris', 'bulan', 'tahun', 'jenis_id', 'merek', 'processor', 'ram', 'hdd', 'pengguna', 'unit_id', 'lokasi_id', 'status']; // field yang ingin diekspor
        return Excel::download(new AsetExport($fields), 'Aset IT Persero.xlsx');
    }
    
   public function exportToExcelJenisAset($jenisId)
    {
        {
        $fields = ['nomor_urut', 'slug_aset', 'nomor_inventaris', 'bulan', 'tahun', 'jenis_id', 'merek', 'processor', 'ram', 'hdd', 'pengguna', 'unit_id', 'lokasi_id', 'status'];

        // Filter data berdasarkan jenis_id
        $data = Aset::where('jenis_id', $jenisId)->get($fields);

        \Log::info("Data fetched: ", $data->toArray()); // Log data yang diambil

        if ($data->isEmpty()) {
            return redirect()->back()->with('pesan_gagal', 'Tidak ada data untuk Jenis ini.');
        }

        return Excel::download(new JenisExport($data, $fields), 'Aset_IT_Persero.xlsx');
        }
    }   

    public function exportToExcelLokasiAset($lokasiId)
    {
        {
        $fields = ['nomor_urut', 'slug_aset', 'nomor_inventaris', 'bulan', 'tahun', 'jenis_id', 'merek', 'processor', 'ram', 'hdd', 'pengguna', 'unit_id', 'lokasi_id', 'status'];

        // Filter data berdasarkan jenis_id
        $data = Aset::where('lokasi_id', $lokasiId)->get($fields);

        \Log::info("Data fetched: ", $data->toArray()); // Log data yang diambil

        if ($data->isEmpty()) {
            return redirect()->back()->with('pesan_gagal', 'Tidak ada data untuk Lokasi ini.');
        }

        return Excel::download(new LokasiExport($data, $fields), 'Aset_IT_Persero.xlsx');
        }
    }   


    public function showImportForm()
    {
        return view('data-aset.import-form', [
            "title" => "Barcode Aset",
            "data" => Aset::all(),
        ]);
    }

    public function importFromExcel(Request $request)
    {
        Excel::import(new AsetImport, $request->file('file'));

        return redirect()->back()->with('success', 'Data imported successfully!');
    }

    // Fungsi untuk pencarian 
    public function cari()
    {
    $data1 = Aset::select(
        'pengguna', 'bulan', 'nomor_urut', 'unit_id', 'lokasi_id', 'jenis_id',
        'tahun', 'merek', 'processor', 'ram', 'hdd', 'status', 'updated_at', 
        'slug_aset', 'nomor_inventaris', 'created_at', 'image' 
    )
    ->where('slug_aset', 'like', '%' . request('cari_data') . '%')
    ->orWhere('nomor_inventaris', 'like', '%' . request('cari_data') . '%')
    ->orWhere('nomor_urut', 'like', '%' . request('cari_data') . '%')
    ->orWhere('pengguna', 'like', '%' . request('cari_data') . '%')
    ->orWhere('tahun', 'like', '%' . request('cari_data') . '%')
    ->orWhere('status', 'like', '%' . request('cari_data') . '%')
    ->get();

    $data2 = AsetSoftware::select(
        'nomor_urut', 'slug_aset', 'nomor_inventaris', 'bulan', 'tahun', 
        'nama_aplikasi', 'unit_pengguna', 'jenis_aplikasi', 'keterangan', 
        'updated_at', 'created_at'
    )
    ->where('slug_aset', 'like', '%' . request('cari_data') . '%')
    ->orWhere('nomor_inventaris', 'like', '%' . request('cari_data') . '%')
    ->get();

    // Gabungkan hasil pencarian dari kedua model
    $data = $data1->union($data2)->all();

    if (count($data1) > 0) {
        return view('cari-aset.detail-cari', [
            "title" => "Cari Aset",
            "data" => $data,
        ]);
    } else {
        return view('cari-aset.detail-cari-software', [
            "title" => "Cari Aset",
            "data" => $data,
        ]);
    }
    }

    public function updateaset(UpdateAsetRequest $request, Aset $aset)
    {
        $validatedData = $request->validate([
            'nomor_urut' => 'required',
            'slug_aset' => 'required',
            'nomor_inventaris' => 'required',
            'bulan' => 'required',
            'tahun' => 'required',
            'jenis_id' => 'required',
            'merek' => '',
            'processor' => '',
            'ram' => '',
            'hdd' => '',
            'pengguna' => 'required',
            'unit_id' => 'required',
            'lokasi_id' => 'required',
            'status' => 'required',
        ]);
        $slug = str_replace('/', '-', $validatedData['nomor_inventaris']);
        $validatedData['slug_aset'] = $slug;

        Aset::where('id', $aset->id)->update($validatedData);
        return redirect('/aset')->with('pesan_berhasil', 'Data Aset Berhasil Diupdate!');
    }

    public function getNomoraset()
    {
        // $urut = Aset::max('nomor_urut')
        // $asets = Aset::first(); // Mengambil data terbaru
        $urut = Aset::max('nomor_urut') + 1;
        return response()->json(['nomor_urut' => $urut]);
    }

    public function exportToPdf($sortir)
    {
        // Ambil data dan urutkan berdasarkan kriteria yang dipilih
        $data = Aset::orderBy($sortir, 'asc')->get();

        // Kelompokkan data berdasarkan kriteria sortir
        $groupedData = $data->groupBy($sortir);

        // Kirimkan data ke view
        $pdfView = view('pdf.data-aset-download', compact('groupedData', 'sortir'))->render();

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
        return $dompdf->stream('Aset IT PT Persero Batam.pdf', ['Attachment' => true]);
    }





    public function tespdf()
    {
        // instantiate and use the dompdf class
        $dompdf = new Dompdf();
        $dompdf->loadHtml('hello world');

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'potrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream();

        // Setelah PDF ditampilkan, Anda bisa menambahkan JavaScript untuk mencetak secara otomatis
        echo '<script type="text/javascript">window.print();</script>';
    }
}
