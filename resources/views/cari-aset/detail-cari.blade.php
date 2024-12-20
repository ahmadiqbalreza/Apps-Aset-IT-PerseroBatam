@extends('layout.main')
@section('container')
    <div class="pagetitle">
        <h1 class="mb-3">Data Aset Hardware</h1>

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
                                        @php
                                            $tahunsaatini = now()->year; // Mendapatkan tahun saat ini
                                        @endphp
                                        @if ($dataa->updated_at->year >= $tahunsaatini)
                                            <span class="badge bg-success" id="status_updated">Sudah di Update |
                                                {{ $dataa->updated_at->format('d M Y') }}</span>
                                        @else
                                            <span class="badge bg-danger" id="status_updated">Belum di Update |
                                                {{ $dataa->updated_at->format('d M Y') }}</span>
                                        @endif
                                        <div class="m-4 d-inline fw-bold">
                                            {{ QrCode::size(60)->generate($dataa->slug_aset) }}
                                            {{ $dataa->nomor_inventaris }}
                                        </div>
                                        <div class="card-body">
                                            <form action="/updateaset/{{ $dataa->id }}" method="post"
                                                class="row g-3 mt-4">
                                                @method('PUT')
                                                @csrf
                                                <div class="row mb-2">
                                                    <label for="inputText"
                                                        class="col-sm-3 col-form-label fw-bold">Pengguna</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control"
                                                            value="{{ $dataa->pengguna }}" disabled>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <label for="inputText"
                                                        class="col-sm-3 col-form-label fw-bold">Unit</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control"
                                                            value="{!! $dataa->unit ? $dataa->unit->nama_unit : '<strong>Data unit dihapus</strong>' !!}" disabled>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <label for="inputText"
                                                        class="col-sm-3 col-form-label fw-bold">Lokasi</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control"
                                                            value="{!! $dataa->lokasi ? $dataa->lokasi->nama_lokasi : '<strong>Data lokasi dihapus</strong>' !!}" disabled>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <label for="inputText" class="col-sm-3 col-form-label fw-bold">Jenis
                                                        Aset</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control"
                                                            value="{!! $dataa->jenis ? $dataa->jenis->nama_jenis : '<strong>Data jenis dihapus</strong>' !!}" disabled>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <label for="inputText"
                                                        class="col-sm-3 col-form-label fw-bold">Tahun</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control"
                                                            value="{{ $dataa->tahun }}" disabled>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <label for="inputText"
                                                        class="col-sm-3 col-form-label fw-bold">Merek</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control"
                                                            value="{{ $dataa->merek }}" disabled>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <label for="inputText"
                                                        class="col-sm-3 col-form-label fw-bold">Processor</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control"
                                                            value="{{ $dataa->processor }}" disabled>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <label for="inputText"
                                                        class="col-sm-3 col-form-label fw-bold">RAM</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control"
                                                            value="{{ $dataa->ram }}" disabled>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <label for="inputText"
                                                        class="col-sm-3 col-form-label fw-bold">HDD</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control"
                                                            value="{{ $dataa->hdd }}" disabled>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <label for="inputText"
                                                        class="col-sm-3 col-form-label fw-bold">Status</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control"
                                                            value="{{ $dataa->status }}" disabled>
                                                    </div>
                                                </div>

                                                <div class="row mb-2">
                                                    <label for="inputText" class="col-sm-3 col-form-label fw-bold">Gambar
                                                        Fisik</label>
                                                    <div class="col-sm-9">
                                                        <!-- Link to open modal -->
                                                        <a href="#" data-bs-toggle="modal"
                                                            data-bs-target="#imageModal">Lihat Gambar</a>
                                                    </div>
                                                </div>
                                                <!-- Modal -->
                                                <div class="modal fade" id="imageModal" tabindex="-1"
                                                    aria-labelledby="imageModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="imageModalLabel">Gambar Aset
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body text-center">
                                                                <!-- Tampilkan gambar berdasarkan nomor inventaris -->
                                                                <img src="{{ asset($dataa->image) }}" alt="Gambar Aset"
                                                                    class="img-fluid">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Tutup</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row mb-2">
                                                    <label for="inputText" class="col-sm-3 col-form-label fw-bold">Tanggal
                                                        Update</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control"
                                                            value="{{ $dataa->updated_at }}" disabled>
                                                    </div>
                                                </div>


                                                <input type="hidden" id="nomor_urut" name="nomor_urut"
                                                    value="{{ $dataa->nomor_urut }}">
                                                <input type="hidden" id="slug_aset" name="slug_aset"
                                                    value="{{ $dataa->slug_aset }}">
                                                <input type="hidden" id="nomor_inventaris" name="nomor_inventaris"
                                                    value="{{ $dataa->nomor_inventaris }}">
                                                <input type="hidden" id="bulan" name="bulan"
                                                    value="{{ $dataa->bulan }}">
                                                <input type="hidden" id="tahun" name="tahun"
                                                    value="{{ $dataa->tahun }}">
                                                <input type="hidden" id="jenis_id" name="jenis_id"
                                                    value="{{ $dataa->jenis_id }}">
                                                <input type="hidden" id="merek" name="merek"
                                                    value="{{ $dataa->merek }}">
                                                <input type="hidden" id="processor" name="processor"
                                                    value="{{ $dataa->processor }}">
                                                <input type="hidden" id="ram" name="ram"
                                                    value="{{ $dataa->ram }}">
                                                <input type="hidden" id="hdd" name="hdd"
                                                    value="{{ $dataa->hdd }}">
                                                <input type="hidden" id="pengguna" name="pengguna"
                                                    value="{{ $dataa->pengguna }}">
                                                <input type="hidden" id="unit_id" name="unit_id"
                                                    value="{{ $dataa->unit_id }}">
                                                <input type="hidden" id="lokasi_id" name="lokasi_id"
                                                    value="{{ $dataa->lokasi_id }}">
                                                <input type="hidden" id="status" name="status"
                                                    value="{{ $dataa->status }}">

                                                @php
                                                    $tahunsaatini = now()->year; // Mendapatkan tahun saat ini
                                                @endphp
                                                @if ($dataa->updated_at->year >= $tahunsaatini)
                                                    <div class="text-center mb-3">
                                                        <button type="submit" class="btn btn-secondary"
                                                            disabled>Updated</button>
                                                    </div>
                                                @else
                                                    <div class="text-center mb-3">
                                                        <button type="submit" class="btn btn-primary">Update</button>
                                                    </div>
                                                @endif

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
