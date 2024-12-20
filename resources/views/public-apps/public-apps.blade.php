@extends('layout.main')
@section('container')
    <div class="pagetitle">
        <h1 class="mb-3">PUBLIC APPS</h1>

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
                                    <a href="/public-apps/create">
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


                                    <table class="table table-striped datatable">
                                        <thead>
                                            <tr>
                                                <th scope="col">No.</th>
                                                <th scope="col">Domain</th>
                                                <th scope="col">Directory</th>
                                                <th scope="col">IP Server</th>
                                                <th scope="col">Port</th>
                                                <th scope="col">Jenis Server</th>
                                                <th scope="col">Kategori</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $dataa)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $dataa->domain }}</td>
                                                    <td>{{ $dataa->directory }}</td>
                                                    <td>{{ $dataa->ip_server }}</td>
                                                    <td>{{ $dataa->port }}</td>
                                                    <td>{{ $dataa->jenis_server }}</td>
                                                    <td>{{ $dataa->kategori }}</td>
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
                                                                            Scan QRCODE to direct Link</h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body text-center">
                                                                        {{ QrCode::size(300)->generate($dataa->domain) }}
                                                                        <h3 class="mt-2 fw-bold">
                                                                            {{ $dataa->domain }}</h3>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Tutup</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <a href="/public-apps/{{ $dataa->id }}/edit"><span
                                                                class="badge bg-secondary border-0 d-inline"><i
                                                                    class="bi bi-pencil-square"></i></span></a>
                                                        <form action="/public-apps/{{ $dataa->id }}" method="post"
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
    @endsection
