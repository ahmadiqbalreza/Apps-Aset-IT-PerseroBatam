@extends('layout.main')
@section('container')
    <div class="pagetitle">
        <h1 class="mb-3">Jenis Aset</h1>

        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg">
                    <div class="row">
                        <!-- Recent Sales -->
                        <div class="col-sm-6">
                            <div class="card recent-sales overflow-auto">
                                <div class="card-body">
                                    {{-- <li class="card-title"><a href="index.html">Tambah</a></li> --}}
                                    <a href="/jenis-aset/create"><button type="button" class="btn btn-info mb-4 mt-4"><i
                                                class="bi bi-plus-circle"></i></button></a>

                                    @if (session()->has('pesan_berhasil'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            {{ session('pesan_berhasil') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @endif


                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">No.</th>
                                                <th scope="col">Nama Aset</th>
                                                <th scope="col">Kode Aset</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $dataa)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $dataa->nama_jenis }}</td>
                                                    <td>{{ $dataa->kode_jenis }}</td>
                                                    <td>
                                                        <a href="/jenis-aset/{{ $dataa->nomor_urut }}/edit"><span
                                                                class="badge bg-secondary border-0 d-inline"><i
                                                                    class="bi bi-pencil-square"></i></span></a>
                                                        {{-- <form action="/jenis-aset/{{ $dataa->id }}" method="post"
                                                            class="d-inline">
                                                            @method('delete')
                                                            @csrf
                                                            <button class="badge bg-danger border-0"
                                                                onclick="return confirm('Anda Yakin Ingin Menghapus Jenis Data Aset?')"><span
                                                                    class="badge bg-danger"><i
                                                                        class="bi bi-trash"></i></span>
                                                            </button>
                                                        </form> --}}
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
