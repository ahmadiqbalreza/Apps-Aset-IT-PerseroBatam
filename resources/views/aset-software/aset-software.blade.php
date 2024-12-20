@extends('layout.main')
@section('container')
    <div class="pagetitle">
        <h1 class="mb-3">Data Aset Software</h1>

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
                                    <a href="/aset-software/create">
                                        <button type="button" class="btn btn-primary mb-4 mt-4">
                                            <i class="bi bi-plus-circle"></i>
                                        </button>
                                    </a>

                                    {{-- <a href="{{ route('export.excel') }}">
                                        <button type="button" class="btn btn-primary mb-4 mt-4">
                                            <i class="bi bi-download"></i>
                                        </button>
                                    </a> --}}

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
                                                <th scope="col">No. Inventaris</th>
                                                <th scope="col">Nama Aplikasi</th>
                                                <th scope="col">Tahun</th>
                                                <th scope="col">Pengguna</th>
                                                <th scope="col">Jenis Aplikasi</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $dataa)
                                                <tr>
                                                    <td>
                                                        <a href="#" type="button" data-bs-toggle="modal"
                                                            data-bs-target="#modal-detail-aset-software{{ $dataa->id }}">
                                                            {{ $dataa->nomor_inventaris }}
                                                        </a>
                                                        <div class="modal fade"
                                                            id="modal-detail-aset-software{{ $dataa->id }}"
                                                            tabindex="-1" aria-labelledby="modal-detail-aset-softwareLabel"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-scrollable">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title"
                                                                            id="modal-detail-aset-softwareLabel">
                                                                            Detail Aset Software</h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="card">
                                                                            <div class="m-4 d-inline fw-bold">
                                                                                {{ QrCode::size(60)->generate($dataa->nomor_inventaris) }}
                                                                                {{ $dataa->nomor_inventaris }}
                                                                            </div>
                                                                            <div class="card-body">
                                                                                <form>
                                                                                    <div class="row mb-2">
                                                                                        <label for="inputText"
                                                                                            class="col-sm-5 col-form-label fw-bold">Nama
                                                                                            Aplikasi</label>
                                                                                        <div class="col-sm-7">
                                                                                            <input type="text"
                                                                                                class="form-control"
                                                                                                value="{{ $dataa->nama_aplikasi }}"
                                                                                                disabled>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row mb-2">
                                                                                        <label for="inputText"
                                                                                            class="col-sm-5 col-form-label fw-bold">Pengguna</label>
                                                                                        <div class="col-sm-7">
                                                                                            <input type="text"
                                                                                                class="form-control"
                                                                                                value="{{ $dataa->unit_pengguna }}"
                                                                                                disabled>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row mb-2">
                                                                                        <label for="inputText"
                                                                                            class="col-sm-5 col-form-label fw-bold">Jenis
                                                                                            Aplikasi</label>
                                                                                        <div class="col-sm-7">
                                                                                            <input type="text"
                                                                                                class="form-control"
                                                                                                value="{{ $dataa->jenis_aplikasi }}"
                                                                                                disabled>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row mb-2">
                                                                                        <label for="inputText"
                                                                                            class="col-sm-5 col-form-label fw-bold">Keterangan</label>
                                                                                        <div class="col-sm-7">
                                                                                            <input type="text"
                                                                                                class="form-control"
                                                                                                value="{{ $dataa->keterangan }}"
                                                                                                disabled>
                                                                                        </div>
                                                                                    </div>
                                                                                </form><!-- End General Form Elements -->
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
                                                    <td>{{ $dataa->nama_aplikasi }}</td>
                                                    <td>{{ $dataa->tahun }}</td>
                                                    <td>{{ $dataa->unit_pengguna }}</td>
                                                    <td>{{ $dataa->jenis_aplikasi }}</td>
                                                    <td>
                                                        <a href="#" type="button" data-bs-toggle="modal"
                                                            data-bs-target="#modal-generate{{ $dataa->id }}">
                                                            <span class="badge bg-info border-0 d-inline"><i
                                                                    class="bi bi-upc-scan text-dark"></i></span>
                                                        </a>
                                                        <div class="modal fade" id="modal-generate{{ $dataa->id }}"
                                                            tabindex="-1" aria-labelledby="modal-generateLabel"
                                                            aria-hidden="true">
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
                                                                        {{ QrCode::size(300)->generate($dataa->nomor_inventaris) }}
                                                                        <h5 class="mt-3 fw-bold">
                                                                            {{ $dataa->nomor_inventaris }}</h3>
                                                                            <h3 class="mt-2 fw-bold">
                                                                                {{ $dataa->nama_aplikasi }}</h3>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Tutup</button>
                                                                        <button type="button"
                                                                            class="btn btn-primary">Cetak</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <a href="/aset-software/{{ $dataa->id }}/edit"><span
                                                                class="badge bg-secondary border-0 d-inline"><i
                                                                    class="bi bi-pencil-square"></i></span></a>
                                                        <form action="/aset-software/{{ $dataa->id }}" method="post"
                                                            class="d-inline">
                                                            @method('delete')
                                                            @csrf
                                                            <button class="badge bg-danger border-0"
                                                                onclick="return confirm('Anda Yakin Ingin Menghapus Data Aset?')"><span
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
    @endsection
