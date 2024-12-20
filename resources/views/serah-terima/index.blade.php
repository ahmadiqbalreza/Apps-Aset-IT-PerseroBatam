@extends('layout.main')
@section('container')
    <div class="pagetitle">
        <h1 class="mb-3">Serah Terima</h1>

        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg">
                    <div class="row">
                        <!-- Recent Sales -->
                        <div class="col-12">
                            <div class="card recent-sales overflow-auto">
                                <div class="card-body">

                                    <button type="button" class="btn btn-info mb-4 mt-4" data-bs-toggle="modal"
                                        data-bs-target="#modal-add-serah-terima">Buat Serah Terima
                                    </button>

                                    <a href="/export-serahterima">
                                        <button type="button" class="btn btn-info mb-4 mt-4">Tes Download
                                        </button>
                                    </a>
                                    <a href="/export-to-pdf-bast">
                                        <button type="button" class="btn btn-info mb-4 mt-4">Tes Download PDF
                                        </button>
                                    </a>

                                    @if (session()->has('pesan_berhasil'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            {{ session('pesan_berhasil') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @endif


                                    <table class="table table-borderless datatable">
                                        <thead>
                                            <tr>
                                                <th scope="col">No. BAST</th>
                                                <th scope="col">Asal</th>
                                                <th scope="col">Tujuan</th>
                                                <th scope="col">Yang Menyerahkan</th>
                                                <th scope="col">Yang Menerima</th>
                                                <th scope="col">Tanggal</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $dataa)
                                                <tr>
                                                    <td>
                                                        {{ $dataa->nomor_bast }}
                                                    </td>
                                                    <td>
                                                        {{ $dataa->asal_aset }}
                                                    </td>
                                                    <td>
                                                        {{ $dataa->tujuan_aset }}
                                                    </td>
                                                    <td>
                                                        {{ $dataa->yang_menyerahkan }}
                                                    </td>
                                                    <td>
                                                        {{ $dataa->yang_menerima }}
                                                    </td>
                                                    <td>
                                                        {{ $dataa->tanggal_bast }}
                                                    </td>
                                                    {{-- Kolom Aksi --}}
                                                    <td>
                                                        <a href="#" type="button" data-bs-toggle="modal"
                                                            data-bs-target="#modal-generate{{ $dataa->nomor }}">
                                                            <span class="badge bg-info border-0 d-inline"><i
                                                                    class="bi bi-upc-scan text-dark"></i></span>
                                                        </a>
                                                        <div class="modal fade" id="modal-generate{{ $dataa->nomor }}"
                                                            tabindex="-1" aria-labelledby="modal-generateLabel"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="modal-generateLabel">
                                                                            Detail BAST</h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body text-center">
                                                                        <h3 class="mt-2 fw-bold">
                                                                            {{ $dataa->domain }}</h3>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <a href="/export-to-pdf-bast" type="button"
                                                                            class="btn btn-primary">Cetak PDF</a>
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Tutup</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <a href="/serah-terima/{{ $dataa->nomor }}/edit"><span
                                                                class="badge bg-secondary border-0 d-inline"><i
                                                                    class="bi bi-pencil-square"></i></span></a>
                                                        <form action="/serah-terima/{{ $dataa->nomor }}" method="post"
                                                            class="d-inline">
                                                            @method('delete')
                                                            @csrf
                                                            <button class="badge bg-danger border-0"
                                                                onclick="return confirm('Anda Yakin Ingin Menghapus Data Public APPS ?')"><span
                                                                    class="badge bg-danger"><i
                                                                        class="bi bi-trash"></i></span>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>

                            </div>
                        </div><!-- End Recent Sales -->

                    </div>
                </div><!-- End Left side columns -->



            </div>


        </section>

        {{-- Modal Buat Serah Terima --}}
        <div class="modal fade" id="modal-add-serah-terima" tabindex="-1" aria-labelledby="modal-add-serah-terimaLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-add-serah-terimaLabel">Buat Serah Terima</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="/aset" method="post" class="row g-3">
                            @csrf
                            <div class="col-md-12">
                                <label for="nama-barang-serahterima" class="form-label">Nomor BAST</label>
                                <input type="text"
                                    class="form-control @error('nama-barang-serahterima') is-invalid @enderror"
                                    id="nama-barang-serahterima" name="nama-barang-serahterima"
                                    value="{{ old('nama-barang-serahterima') }}">
                                @error('nama-barang-serahterima')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label for="tanggal-bast" class="form-label">Tanggal BAST</label>
                                <input type="date" class="form-control @error('tanggal-bast') is-invalid @enderror"
                                    id="tanggal-bast" name="tanggal-bast" value="{{ old('tanggal-bast') }}">
                                @error('tanggal-bast')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label for="asal-aset" class="form-label">Asal Aset</label>
                                <select class="form-select @error('asal-aset') is-invalid @enderror" id="asal-aset"
                                    name="asal-aset">
                                    <option value="">-- Pilih Asal Aset --</option>
                                    <option value="hibah" {{ old('asal-aset') == 'hibah' ? 'selected' : '' }}>Hibah
                                    </option>
                                    <option value="pembelian" {{ old('asal-aset') == 'pembelian' ? 'selected' : '' }}>
                                        Pembelian</option>
                                    <option value="donasi" {{ old('asal-aset') == 'donasi' ? 'selected' : '' }}>Donasi
                                    </option>
                                    <option value="lainnya" {{ old('asal-aset') == 'lainnya' ? 'selected' : '' }}>Lainnya
                                    </option>
                                </select>
                                @error('asal-aset')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label for="tujuan-aset" class="form-label">Tujuan Aset</label>
                                <select class="form-select @error('tujuan-aset') is-invalid @enderror" id="tujuan-aset"
                                    name="tujuan-aset">
                                    <option value="">-- Pilih Tujuan Aset --</option>
                                    <option value="hibah" {{ old('tujuan-aset') == 'hibah' ? 'selected' : '' }}>Hibah
                                    </option>
                                    <option value="pembelian" {{ old('tujuan-aset') == 'pembelian' ? 'selected' : '' }}>
                                        Pembelian</option>
                                    <option value="donasi" {{ old('tujuan-aset') == 'donasi' ? 'selected' : '' }}>Donasi
                                    </option>
                                    <option value="lainnya" {{ old('tujuan-aset') == 'lainnya' ? 'selected' : '' }}>
                                        Lainnya
                                    </option>
                                </select>
                                @error('tujuan-aset')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label for="nomor-inventaris" class="form-label">Nomor Inventaris</label>
                                <select class="form-control" id="nomor-inventaris" name="nomor-inventaris">
                                    <option value="">-- Pilih Nomor Inventaris --</option>
                                    <option value="INV-001">INV-001</option>
                                    <option value="INV-002">INV-002</option>
                                    <option value="INV-003">INV-003</option>
                                    <option value="INV-004">INV-004</option>
                                </select>
                            </div>



                            <div class="col-md-12">
                                <label for="nomor-inventaris-serahterima" class="form-label">Nomor Inventaris</label>
                                <input type="text"
                                    class="form-control @error('nomor-inventaris-serahterima') is-invalid @enderror"
                                    id="nomor-inventaris-serahterima" name="nomor-inventaris-serahterima"
                                    value="{{ old('nomor-inventaris-serahterima') }}">
                                @error('nomor-inventaris-serahterima')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label for="nama-barang-serahterima" class="form-label">Nama Barang</label>
                                <input type="text"
                                    class="form-control @error('nama-barang-serahterima') is-invalid @enderror"
                                    id="nama-barang-serahterima" name="nama-barang-serahterima"
                                    value="{{ old('nama-barang-serahterima') }}">
                                @error('nama-barang-serahterima')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label for="jumlah-serahterima" class="form-label">Jumlah</label>
                                <input type="number"
                                    class="form-control @error('jumlah-serahterima') is-invalid @enderror"
                                    id="jumlah-serahterima" name="jumlah-serahterima"
                                    value="{{ old('jumlah-serahterima') }}">
                                @error('jumlah-serahterima')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label for="tgl-serahterima" class="form-label">Tanggal</label>
                                <input type="date" class="form-control @error('tgl-serahterima') is-invalid @enderror"
                                    id="tgl-serahterima" name="tgl-serahterima" value="{{ old('tgl-serahterima') }}">
                                @error('tgl-serahterima')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="c<div class="col-md-12">
                                <label for="unit_id" class="form-label">Unit</label>
                                <select id="unit_id" name="unit_id"
                                    class="form-select @error('unit_id') is-invalid @enderror"
                                    @error('unit_id') autofocus @enderror>
                                    <option selected disabled>Pilih Unit</option>
                                    @foreach ($data_unit as $unit)
                                        @if (old('unit_id') != $unit->id)
                                            <option value="{{ $unit->id }}">{{ $unit->nama_unit }}
                                            </option>
                                        @else
                                            <option value="{{ $unit->id }}" selected>{{ $unit->nama_unit }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('unit_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label for="asal-serahterima" class="form-label">Asal</label>
                                <select id="asal-serahterima" name="asal-serahterima"
                                    class="form-select @error('asal-serahterima') is-invalid @enderror"
                                    @error('asal-serahterima') autofocus @enderror>
                                    <option selected disabled>Pilih Lokasi</option>
                                    <option value="Aset Baru">Aset Baru</option>
                                    @foreach ($data_lokasi as $lksi)
                                        @if (old('asal-serahterima') != $lksi->nama_lokasi)
                                            <option value="{{ $lksi->nama_lokasi }}">{{ $lksi->nama_lokasi }}
                                            </option>
                                        @else
                                            <option value="{{ $lksi->nama_lokasi }}" selected>{{ $lksi->nama_lokasi }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('asal-serahterima')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label for="tujuan-serahterima" class="form-label">Tujuan</label>
                                <select id="tujuan-serahterima" name="tujuan-serahterima"
                                    class="form-select @error('tujuan-serahterima') is-invalid @enderror"
                                    @error('tujuan-serahterima') autofocus @enderror>
                                    <option selected disabled>Pilih Lokasi</option>
                                    @foreach ($data_lokasi as $lksi)
                                        @if (old('tujuan-serahterima') != $lksi->nama_lokasi)
                                            <option value="{{ $lksi->nama_lokasi }}">{{ $lksi->nama_lokasi }}
                                            </option>
                                        @else
                                            <option value="{{ $lksi->nama_lokasi }}" selected>{{ $lksi->nama_lokasi }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('tujuan-serahterima')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label for="yang-menyerahkan-serahterima" class="form-label">Nama Yang
                                    Menyerahkan</label>
                                <input type="text"
                                    class="form-control @error('yang-menyerahkan-serahterima') is-invalid @enderror"
                                    id="yang-menyerahkan-serahterima" name="yang-menyerahkan-serahterima"
                                    value="{{ old('yang-menyerahkan-serahterima') }}">
                                @error('yang-menyerahkan-serahterima')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label for="yang-menerima-serahterima" class="form-label">Nama Yang
                                    Menerima</label>
                                <input type="text"
                                    class="form-control @error('yang-menerima-serahterima') is-invalid @enderror"
                                    id="yang-menerima-serahterima" name="yang-menerima-serahterima"
                                    value="{{ old('yang-menerima-serahterima') }}">
                                @error('yang-menerima-serahterima')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label for="yang-mengetahui-serahterima" class="form-label">Nama Yang
                                    Mengetahui</label>
                                <input type="text"
                                    class="form-control @error('yang-mengetahui-serahterima') is-invalid @enderror"
                                    id="yang-mengetahui-serahterima" name="yang-mengetahui-serahterima"
                                    value="{{ old('yang-mengetahui-serahterima') }}">
                                @error('yang-mengetahui-serahterima')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </form>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Buat</button>
                    </div>
                </div>
            </div>
        </div>
    @endsection
