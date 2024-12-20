<?php

namespace App\Http\Controllers;

use App\Models\Aset;
use App\Models\AsetSoftware;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        return view('landing-page.dashboard');
    }

    // Fungsi untuk pencarian di publik
    public function cari_publik()
    {
        // Periksa apakah ada inputan pencarian
        $cari_data = request('cari_data');
        if (!empty($cari_data)) {
            $data1 = Aset::select('pengguna', 'bulan', 'nomor_urut', 'unit_id', 'lokasi_id', 'jenis_id', 'tahun', 'merek', 'processor', 'ram', 'hdd', 'status', 'updated_at', 'slug_aset', 'nomor_inventaris', 'created_at', 'image')
                ->where('slug_aset', 'like', '%' . $cari_data . '%')
                ->orWhere('nomor_inventaris', 'like', '%' . $cari_data . '%')
                ->get();

            $data2 = AsetSoftware::select('nomor_urut', 'slug_aset',  'nomor_inventaris', 'bulan', 'tahun', 'nama_aplikasi', 'unit_pengguna', 'jenis_aplikasi', 'keterangan', 'updated_at', 'created_at')
                ->where('slug_aset', 'like', '%' . $cari_data . '%')
                ->orWhere('nomor_inventaris', 'like', '%' . $cari_data . '%')
                ->get();

            // Gabungkan hasil pencarian dari kedua model
            $data = $data1->union($data2)->all();

            if (count($data) != 0) {
                return view('landing-page.detail-cari', [
                    "title" => "Cari Aset",
                    "data" => $data,
                ]);
            }
        }

        // Jika tidak ada inputan atau tidak ditemukan data
        return view('landing-page.tidak-ditemukan', [
            "title" => "Cari Aset",
        ]);
    }

    public function detail_cari()
    {
        return view('landing-page.detail-cari');
    }

    public function tiket()
    {
         return view('landing-page.tiket', [
            "title" => "Cari Aset",
            // "data" => $data,
        ]);
    }

    public function getdataaset($nomorAset)
    {
        // $nomorAsets = $nomorAset->input('nomorAsett');
        // dd($nomorAset);
        // Contoh logika untuk mendapatkan data berdasarkan nomor aset
        $data = Aset::where('slug_aset', $nomorAset)->get();

        if ($data->isEmpty()) {
            // Data tidak ditemukan, beri respons sesuai kebutuhan
            return view('landing-page.tidak-ditemukan', [
                "title" => "Cari Aset",
                "data" => $data,
            ]);
        }

        // Data ditemukan, kirim data ke view
        return view('landing-page.tiket', [
            "title" => "Cari Aset",
            "data" => $data,
        ]);
    }
}
