@extends('layout.main')
@section('container')
    <div class="pagetitle">
        <h1 class="mb-3">Data Aset</h1>

        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg">
                    <div class="row">
                        <!-- Recent Sales -->
                        <div class="col-12">
                            <div class="card recent-sales overflow-auto">
                                <div class="card-body">
                                    {{-- <li class="card-title"><a href="index.html">Tambah</a></li> --}}
                                    <a href="/aset/create">
                                        <button type="button" class="btn btn-primary mb-4 mt-4">
                                            <i class="bi bi-plus-circle"></i>
                                        </button>
                                    </a>

                                    {{-- <a href="{{ route('exportallaset.excel') }}">
                                        <button type="button" class="btn btn-primary mb-4 mt-4">
                                            <i class="bi bi-download"></i>
                                        </button></a> --}}
                                    {{-- <a href="{{ route('import.form') }}">
                                        <button type="button" class="btn btn-primary mb-4 mt-4">
                                            <i class="bi bi-upload"></i>
                                        </button>
                                    </a> --}}

                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary mb-4 mt-4 dropdown-toggle"
                                            data-bs-toggle="dropdown" aria-expanded="false"> Excel
                                            <i class="bi bi-download"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="{{ route('exportallaset.excel') }}">Semua</a>
                                            </li>
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                            <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#ModalJenis"
                                                    href="#">Jenis</a></li>
                                            <li><a class="dropdown-item" data-bs-toggle="modal"
                                                    data-bs-target="#ModalLokasi" href="#">Lokasi</a></li>
                                            <li><a class="dropdown-item" href="#">Tahun</a></li>
                                            <li><a class="dropdown-item" href="#">Kritikal</a></li>
                                            <li><a class="dropdown-item" href="#">Non Kritikal</a></li>
                                        </ul>
                                    </div>

                                    <button type="button" class="btn btn-primary mb-4 mt-4" data-bs-toggle="modal"
                                        data-bs-target="#ModalPDF"> PDF
                                        <i class="bi bi-download"></i>
                                    </button>

                                    {{-- Modal Jenis --}}
                                    <div class="modal fade" id="ModalJenis" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Download Berdasarkan Jenis</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>

                                                <div class="modal-body d-flex justify-content-center align-items-center">
                                                    <div class="col-md-5">
                                                        <select class="form-select fw-bold" id="pilihjenis" required>
                                                            @foreach ($data_jenis as $jns)
                                                                <option value="{{ $jns->id }}"
                                                                    data-kode="{{ $jns->kode_jenis }}">
                                                                    {{ $jns->nama_jenis }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary"
                                                        id="downloadBtn">Download</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Modal Lokasi --}}
                                    <div class="modal fade" id="ModalLokasi" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Download Berdasarkan Lokasi</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>

                                                <div class="modal-body d-flex justify-content-center align-items-center">
                                                    <div class="col-md-5">
                                                        <select class="form-select fw-bold" id="pilihlokasi" required>
                                                            @foreach ($data_lokasi as $lokasi)
                                                                <option value="{{ $lokasi->id }}">
                                                                    {{ $lokasi->nama_lokasi }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary"
                                                        id="downloadBtnlokasi">Download</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <script>
                                        document.getElementById('downloadBtn').addEventListener('click', function() {
                                            // Ambil nilai jenis dari dropdown
                                            const jenisId = document.getElementById('pilihjenis').value;

                                            // Buat URL untuk mengunduh data berdasarkan jenis
                                            const downloadUrl = `/export-to-excel-jenis/${jenisId}`;

                                            // Redirect ke URL untuk mengunduh
                                            window.location.href = downloadUrl;

                                            // Tutup modal setelah mengklik download
                                            $('#ModalJenis').modal('hide');
                                        });
                                    </script>

                                    <script>
                                        document.getElementById('downloadBtnlokasi').addEventListener('click', function() {
                                            // Ambil nilai jenis dari dropdown
                                            const lokasiId = document.getElementById('pilihlokasi').value;

                                            // Buat URL untuk mengunduh data berdasarkan jenis
                                            const downloadUrl = `/export-to-excel-lokasi/${lokasiId}`;

                                            // Redirect ke URL untuk mengunduh
                                            window.location.href = downloadUrl;

                                            // Tutup modal setelah mengklik download
                                            $('#ModalLokasi').modal('hide');
                                        });
                                    </script>

                                    {{-- Modal PDF --}}
                                    <div class="modal fade" id="ModalPDF" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Sortir Berdasarkan </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>

                                                <div class="modal-body d-flex justify-content-center align-items-center">
                                                    <div class="col-md-5">
                                                        <select class="form-select fw-bold" id="pilihsortir" required>
                                                            <option value="tahun">Tahun</option>
                                                            <option value="jenis_id">Jenis</option>
                                                            <option value="unit_id">Unit</option>
                                                            <option value="lokasi_id">Lokasi</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary"
                                                        id="downloadBtnpdf">Download</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <script>
                                        document.getElementById('downloadBtnpdf').addEventListener('click', function() {
                                            // Ambil nilai jenis dari dropdown
                                            const pdfid = document.getElementById('pilihsortir').value;

                                            // Buat URL untuk mengunduh data PDF berdasarkan jenis
                                            const downloadUrl = `/export-to-pdf/${pdfid}`;

                                            // Redirect ke URL untuk mengunduh PDF
                                            window.location.href = downloadUrl;

                                            // Tutup modal setelah mengklik download
                                            $('#ModalPDF').modal('hide');
                                        });
                                    </script>




                                    {{-- <script>
                                        document.addEventListener('DOMContentLoaded', function() {
                                            const downloadBtn = document.getElementById('downloadBtn');
                                            const pilihjenis = document.getElementById('pilihjenis');

                                            downloadBtn.addEventListener('click', function() {
                                                const jenisId = pilihjenis.value; // Ambil ID jenis yang dipilih
                                                const url = `/exportjenisaset-excel/${jenisId}`; // Sesuaikan dengan rute Anda
                                                window.location.href = url; // Arahkan pengguna ke URL untuk unduh
                                            });
                                        });
                                    </script> --}}
                                    {{-- End Modal Jenis --}}


                                    {{-- <a href="/aset/scan">
                                        <button type="button" class="btn btn-info mb-4 mt-4">
                                            <i class="bi bi-qr-code-scan"></i> Scan Barcode
                                        </button>
                                    </a> --}}

                                    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/instascan/1.0.0/instascan.min.js"></script> --}}
                                    {{-- <script src="https://cdn.rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script> --}}
                                    <script src="https://cdn.jsdelivr.net/gh/schmich/instascan-builds@master/instascan.min.js"></script>
                                    {{-- <script type="text/javascript" src="{{ asset('js/instascan.min.js') }}"></script> --}}
                                    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/instascan/1.0.0/index.js"></script> --}}
                                    {{-- <script src="http://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script> --}}


                                    <button type="button" class="btn btn-info mb-4 mt-4" data-bs-toggle="modal"
                                        data-bs-target="#modal-scan-camera">
                                        <i class="bi bi-qr-code-scan"></i> Scan
                                    </button>


                                    @if (session()->has('pesan_berhasil'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            {{ session('pesan_berhasil') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @elseif (session()->has('pesan_gagal'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            {{ session('pesan_gagal') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @endif


                                    <!-- Table with data table -->
                                    <table class="table table-striped datatable">
                                        <thead>
                                            <tr>
                                                <th scope="col">No. Inventaris</th>
                                                <th scope="col">Tahun</th>
                                                <th scope="col">Jenis</th>
                                                <th scope="col">Merek</th>
                                                <th scope="col">Unit</th>
                                                <th scope="col">Lokasi</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $dataa)
                                                <tr>
                                                    <td>
                                                        <a href="#" type="button" data-bs-toggle="modal"
                                                            data-bs-target="#modal-detail-aset{{ $dataa->nomor_urut }}">
                                                            {{ $dataa->nomor_inventaris }}
                                                        </a>
                                                        <div class="modal fade"
                                                            id="modal-detail-aset{{ $dataa->nomor_urut }}" tabindex="-1"
                                                            aria-labelledby="modal-detail-asetLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-scrollable">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title"
                                                                            id="modal-detail-asetLabel">
                                                                            Detail Aset </h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="card">
                                                                            @php
                                                                                $tahunsaatini = now()->year; // Mendapatkan tahun saat ini
                                                                            @endphp
                                                                            @if ($dataa->updated_at->year >= $tahunsaatini)
                                                                                <span class="badge bg-success"
                                                                                    id="status_updated">Sudah di
                                                                                    Update |
                                                                                    {{ $dataa->updated_at->format('d M Y') }}</span>
                                                                            @else
                                                                                <span class="badge bg-danger"
                                                                                    id="status_updated">Belum di
                                                                                    Update |
                                                                                    {{ $dataa->updated_at->format('d M Y') }}</span>
                                                                            @endif
                                                                            <div class="m-4 d-inline fw-bold">
                                                                                {{ QrCode::size(60)->generate($dataa->nomor_inventaris) }}
                                                                                {{ $dataa->nomor_inventaris }}
                                                                            </div>
                                                                            <div class="card-body">
                                                                                <form
                                                                                    action="/updateaset/{{ $dataa->id }}"
                                                                                    method="post" class="row g-3 mt-4">
                                                                                    @method('PUT')
                                                                                    @csrf
                                                                                    <div class="row mb-2">
                                                                                        <label for="inputText"
                                                                                            class="col-sm-5 col-form-label fw-bold">Pengguna</label>
                                                                                        <div class="col-sm-7">
                                                                                            <input type="text"
                                                                                                class="form-control"
                                                                                                value="{{ $dataa->pengguna }}"
                                                                                                disabled>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row mb-2">
                                                                                        <label for="inputText"
                                                                                            class="col-sm-5 col-form-label fw-bold">Unit</label>
                                                                                        <div class="col-sm-7">
                                                                                            <input type="text"
                                                                                                class="form-control"
                                                                                                value="{!! $dataa->unit ? $dataa->unit->nama_unit : '<strong>Data unit dihapus</strong>' !!}"
                                                                                                disabled>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row mb-2">
                                                                                        <label for="inputText"
                                                                                            class="col-sm-5 col-form-label fw-bold">Lokasi</label>
                                                                                        <div class="col-sm-7">
                                                                                            <input type="text"
                                                                                                class="form-control"
                                                                                                value="{!! $dataa->lokasi ? $dataa->lokasi->nama_lokasi : '<strong>Data lokasi dihapus</strong>' !!}"
                                                                                                disabled>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row mb-2">
                                                                                        <label for="inputText"
                                                                                            class="col-sm-5 col-form-label fw-bold">Jenis
                                                                                            Aset</label>
                                                                                        <div class="col-sm-7">
                                                                                            <input type="text"
                                                                                                class="form-control"
                                                                                                value="{!! $dataa->jenis ? $dataa->jenis->nama_jenis : '<strong>Data jenis dihapus</strong>' !!}"
                                                                                                disabled>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row mb-2">
                                                                                        <label for="inputText"
                                                                                            class="col-sm-5 col-form-label fw-bold">Tahun</label>
                                                                                        <div class="col-sm-7">
                                                                                            <input type="text"
                                                                                                class="form-control"
                                                                                                value="{{ $dataa->tahun }}"
                                                                                                disabled>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row mb-2">
                                                                                        <label for="inputText"
                                                                                            class="col-sm-5 col-form-label fw-bold">Merek</label>
                                                                                        <div class="col-sm-7">
                                                                                            <input type="text"
                                                                                                class="form-control"
                                                                                                value="{{ $dataa->merek }}"
                                                                                                disabled>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row mb-2">
                                                                                        <label for="inputText"
                                                                                            class="col-sm-5 col-form-label fw-bold">Processor</label>
                                                                                        <div class="col-sm-7">
                                                                                            <input type="text"
                                                                                                class="form-control"
                                                                                                value="{{ $dataa->processor }}"
                                                                                                disabled>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row mb-2">
                                                                                        <label for="inputText"
                                                                                            class="col-sm-5 col-form-label fw-bold">RAM</label>
                                                                                        <div class="col-sm-7">
                                                                                            <input type="text"
                                                                                                class="form-control"
                                                                                                value="{{ $dataa->ram }}"
                                                                                                disabled>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row mb-2">
                                                                                        <label for="inputText"
                                                                                            class="col-sm-5 col-form-label fw-bold">HDD</label>
                                                                                        <div class="col-sm-7">
                                                                                            <input type="text"
                                                                                                class="form-control"
                                                                                                value="{{ $dataa->hdd }}"
                                                                                                disabled>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row mb-2">
                                                                                        <label for="inputText"
                                                                                            class="col-sm-5 col-form-label fw-bold">Status</label>
                                                                                        <div class="col-sm-7">
                                                                                            <input type="text"
                                                                                                class="form-control"
                                                                                                value="{{ $dataa->status }}"
                                                                                                disabled>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="row mb-2">
                                                                                        <label for="inputText"
                                                                                            class="col-sm-5 col-form-label fw-bold">Tanggal
                                                                                            Update</label>
                                                                                        <div class="col-sm-7">
                                                                                            <input type="text"
                                                                                                class="form-control"
                                                                                                value="{{ $dataa->updated_at }}"
                                                                                                disabled>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="row mb-2">
                                                                                        <label for="inputText"
                                                                                            class="col-sm-5 col-form-label fw-bold">Gambar
                                                                                            Fisik</label>
                                                                                        <img src="{{ asset($dataa->image) }}"
                                                                                            alt="Gambar Aset"
                                                                                            class="img-fluid">
                                                                                    </div>


                                                                                    <input type="hidden" id="nomor_urut"
                                                                                        name="nomor_urut"
                                                                                        value="{{ $dataa->nomor_urut }}">
                                                                                    <input type="hidden" id="slug_aset"
                                                                                        name="slug_aset"
                                                                                        value="{{ $dataa->slug_aset }}">
                                                                                    <input type="hidden"
                                                                                        id="nomor_inventaris"
                                                                                        name="nomor_inventaris"
                                                                                        value="{{ $dataa->nomor_inventaris }}">
                                                                                    <input type="hidden" id="bulan"
                                                                                        name="bulan"
                                                                                        value="{{ $dataa->bulan }}">
                                                                                    <input type="hidden" id="tahun"
                                                                                        name="tahun"
                                                                                        value="{{ $dataa->tahun }}">
                                                                                    <input type="hidden" id="jenis_id"
                                                                                        name="jenis_id"
                                                                                        value="{{ $dataa->jenis_id }}">
                                                                                    <input type="hidden" id="merek"
                                                                                        name="merek"
                                                                                        value="{{ $dataa->merek }}">
                                                                                    <input type="hidden" id="processor"
                                                                                        name="processor"
                                                                                        value="{{ $dataa->processor }}">
                                                                                    <input type="hidden" id="ram"
                                                                                        name="ram"
                                                                                        value="{{ $dataa->ram }}">
                                                                                    <input type="hidden" id="hdd"
                                                                                        name="hdd"
                                                                                        value="{{ $dataa->hdd }}">
                                                                                    <input type="hidden" id="pengguna"
                                                                                        name="pengguna"
                                                                                        value="{{ $dataa->pengguna }}">
                                                                                    <input type="hidden" id="unit_id"
                                                                                        name="unit_id"
                                                                                        value="{{ $dataa->unit_id }}">
                                                                                    <input type="hidden" id="lokasi_id"
                                                                                        name="lokasi_id"
                                                                                        value="{{ $dataa->lokasi_id }}">
                                                                                    <input type="hidden" id="status"
                                                                                        name="status"
                                                                                        value="{{ $dataa->status }}">

                                                                                    @php
                                                                                        $tahunsaatini = now()->year; // Mendapatkan tahun saat ini
                                                                                    @endphp
                                                                                    @if ($dataa->updated_at->year >= $tahunsaatini)
                                                                                        <div class="text-center mb-3">
                                                                                            <button type="submit"
                                                                                                class="btn btn-secondary"
                                                                                                disabled>Updated</button>
                                                                                        </div>
                                                                                    @else
                                                                                        <div class="text-center mb-3">
                                                                                            <button type="submit"
                                                                                                class="btn btn-primary">Update</button>
                                                                                        </div>
                                                                                    @endif

                                                                                </form>
                                                                                <!-- End General Form Elements -->
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Tutup</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                    </td>
                                                    <td>{{ $dataa->tahun }}</td>
                                                    <td>{!! $dataa->jenis ? $dataa->jenis->nama_jenis : '<strong>Master Data jenis dihapus</strong>' !!}</td>
                                                    <td class="text-truncate" style="max-width: 150px;">
                                                        {{ $dataa->merek }}
                                                    </td>
                                                    <td>{!! $dataa->unit ? $dataa->unit->nama_unit : '<strong>Master Data unit dihapus</strong>' !!}</td>
                                                    <td>{!! $dataa->lokasi ? $dataa->lokasi->nama_lokasi : '<strong>Master Data lokasi dihapus</strong>' !!}</td>

                                                    {{-- Kolom Aksi --}}
                                                    <td class="d-flex align-items-center d-inline">
                                                        <a href="#" type="button" data-bs-toggle="modal"
                                                            data-bs-target="#modal-generate{{ $dataa->nomor_urut }}">
                                                            <span class="badge bg-info border-0 d-inline"><i
                                                                    class="bi bi-upc-scan text-dark"></i></span>
                                                        </a>
                                                        <a href="/aset/{{ $dataa->nomor_urut }}/edit"><span
                                                                class="badge bg-secondary border-0 d-inline"><i
                                                                    class="bi bi-pencil-square"></i></span></a>
                                                        <form action="/aset/{{ $dataa->nomor_urut }}" method="post"
                                                            class="d-inline">
                                                            @method('delete')
                                                            @csrf
                                                            <button class="badge bg-danger border-0"
                                                                onclick="return confirm('Anda Yakin Ingin Menghapus Data Aset?')"><span
                                                                    class="badge bg-danger"><i
                                                                        class="bi bi-trash"></i></span>
                                                            </button>
                                                        </form>
                                                        {{-- <div class="modal fade"
                                                            id="modal-generate{{ $dataa->nomor_urut }}" tabindex="-1"
                                                            aria-labelledby="modal-generateLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="modal-generateLabel">
                                                                            Cetak Barcode</h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body text-center">
                                                                        {{ QrCode::size(300)->generate($dataa->slug_aset) }}
                                                                        <h5 class="mt-3 fw-bold">
                                                                            {{ $dataa->nomor_inventaris }}</h3>
                                                                            <h3 class="mt-2 fw-bold">
                                                                                {!! $dataa->jenis ? $dataa->jenis->nama_jenis : '<strong> Master Data jenis dihapus</strong>' !!}</h3>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button"
                                                                            class="btn btn-primary">Cetak</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div> --}}

                                                        <div class="modal fade"
                                                            id="modal-generate{{ $dataa->nomor_urut }}" tabindex="-1"
                                                            aria-labelledby="modal-generateLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="modal-generateLabel">
                                                                            Cetak Barcode</h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body text-center"
                                                                        id="printableArea{{ $dataa->nomor_urut }}">
                                                                        <!-- Flexbox container untuk menempatkan QR code dan teks di sebelahnya -->
                                                                        <div class="print-content"
                                                                            style="display: flex; align-items: center;">
                                                                            <!-- QR Code ukuran 100 untuk mencocokkan dengan ukuran kertas -->
                                                                            <div class="qr-code">
                                                                                {{ QrCode::size(100)->generate($dataa->slug_aset) }}
                                                                            </div>
                                                                            <!-- Teks di sebelah QR Code -->
                                                                            <div class="text-content"
                                                                                style="margin-left: 15px;">
                                                                                <h5 class="fw-bold">
                                                                                    {{ $dataa->nomor_inventaris }}
                                                                                </h5>
                                                                                <h6 class="fw-bold">
                                                                                    {!! $dataa->jenis ? $dataa->jenis->nama_jenis : '<strong> Master Data jenis dihapus</strong>' !!}
                                                                                </h6>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-primary"
                                                                            onclick="printDiv('printableArea{{ $dataa->nomor_urut }}')">Cetak</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <style>
                                                            @media print {
                                                                @page {
                                                                    size: 5cm 2cm;
                                                                    margin: 0;
                                                                }

                                                                body {
                                                                    margin: 0;
                                                                    padding: 0;
                                                                }

                                                                .print-content {
                                                                    width: 100%;
                                                                    height: 100%;
                                                                    display: flex;
                                                                    justify-content: center;
                                                                    align-items: center;
                                                                }

                                                                .qr-code,
                                                                .text-content {
                                                                    text-align: center;
                                                                }
                                                            }
                                                        </style>

                                                        <!-- JavaScript untuk mencetak hanya area tertentu -->
                                                        <script>
                                                            function printDiv(divName) {
                                                                var printContents = document.getElementById(divName).innerHTML;
                                                                var originalContents = document.body.innerHTML;

                                                                document.body.innerHTML = "<html><head><title>Cetak Barcode</title></head><body>" + printContents +
                                                                    "</body></html>";
                                                                window.print();
                                                                document.body.innerHTML = originalContents;
                                                            }
                                                        </script>


                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <!-- End Table with data table -->


                                    {{-- <nav aria-label="Page navigation example">
                                        <ul class="pagination">
                                            @if ($data->onFirstPage())
                                                <li class="page-item disabled" aria-disabled="true">
                                                    <span class="page-link">Previous</span>
                                                </li>
                                            @else
                                                <li class="page-item">
                                                    <a class="page-link" href="{{ $data->previousPageUrl() }}"
                                                        rel="prev">Previous</a>
                                                </li>
                                            @endif

                                            @foreach ($data->links()->elements as $element)
                                                @if (is_string($element))
                                                    <li class="page-item disabled" aria-disabled="true">
                                                        <span class="page-link">{{ $element }}</span>
                                                    </li>
                                                @elseif (is_array($element))
                                                    @foreach ($element as $page => $url)
                                                        @if ($page == $data->currentPage())
                                                            <li class="page-item active" aria-current="page">
                                                                <span class="page-link">{{ $page }}</span>
                                                            </li>
                                                        @else
                                                            <li class="page-item">
                                                                <a class="page-link"
                                                                    href="{{ $url }}">{{ $page }}</a>
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @endforeach

                                            @if ($data->hasMorePages())
                                                <li class="page-item">
                                                    <a class="page-link" href="{{ $data->nextPageUrl() }}"
                                                        rel="next">Next</a>
                                                </li>
                                            @else
                                                <li class="page-item disabled" aria-disabled="true">
                                                    <span class="page-link">Next</span>
                                                </li>
                                            @endif
                                        </ul>
                                    </nav> --}}


                                </div>

                            </div>
                        </div><!-- End Recent Sales -->

                    </div>
                </div><!-- End Left side columns -->


            </div>


        </section>
    @endsection
