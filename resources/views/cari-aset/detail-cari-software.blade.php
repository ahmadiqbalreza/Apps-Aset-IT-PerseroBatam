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
                        <div class="col-lg-6">
                            <div class="card recent-sales overflow-auto">
                                <div class="card">
                                    @foreach ($data as $dataa)
                                        <div class="m-4 d-inline fw-bold">
                                            {{ QrCode::size(60)->generate($dataa->slug_aset) }}
                                            {{ $dataa->nomor_inventaris }}
                                        </div>
                                        <div class="card-body">
                                            <form>
                                                <div class="row mb-2">
                                                    <label for="inputText" class="col-sm-3 col-form-label fw-bold">Nama
                                                        Aplikasi</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control"
                                                            value="{{ $dataa->nama_aplikasi }}" disabled>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <label for="inputText" class="col-sm-3 col-form-label fw-bold">Jenis
                                                        Aplikasi</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control"
                                                            value="{{ $dataa->jenis_aplikasi }}" disabled>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <label for="inputText" class="col-sm-3 col-form-label fw-bold">Unit
                                                        Pengguna</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control"
                                                            value="{{ $dataa->unit_pengguna }}" disabled>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <label for="inputText"
                                                        class="col-sm-3 col-form-label fw-bold">Keterangan</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control"
                                                            value="{{ $dataa->keterangan }}" disabled>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <label for="inputText" class="col-sm-3 col-form-label fw-bold">Tanggal
                                                        Update</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control"
                                                            value="{{ $dataa->upddated_at }}" disabled>
                                                    </div>
                                                </div>
                                            </form><!-- End General Form Elements -->
                                        </div>
                                    @endforeach
                                </div>

                            </div>
                        </div><!-- End Recent Sales -->

                    </div>
                </div><!-- End Left side columns -->


            </div>


        </section>
    @endsection
