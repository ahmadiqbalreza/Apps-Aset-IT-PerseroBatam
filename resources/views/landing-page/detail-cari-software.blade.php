@extends('landing-page.layout.main')

@section('cont')
    {{-- Section Detail Pencarian --}}
    <section id="detail-cari" class="pricing">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Detail Aset</h2>
            </div>

            <div class="row justify-content-center">

                <div class="col-md mt-lg-0" data-aos="fade-up" data-aos-delay="200">
                    @foreach ($data as $dataa)
                        @php
                            $tahunsaatini = now()->year; // Mendapatkan tahun saat ini
                        @endphp
                        @if ($dataa->updated_at->year >= $tahunsaatini)
                            <div class="box featured">
                            @else
                                <div class="box reds">
                        @endif
                        <div class="row text-center">
                            <div class="fw-bold">
                                {{ QrCode::size(100)->generate($dataa->slug_aset) }}
                                <p class="mt-2">
                                    {{ $dataa->nomor_inventaris }}
                                    <br>
                                    {{ $dataa->jenis->nama_jenis }} - {{ $dataa->lokasi->nama_lokasi }}
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <label for="inputText" class="col-sm-3 col-form-label fw-bold">Pengguna</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="{{ $dataa->pengguna }}" disabled>
                            </div>
                        </div>
                        <div class="row">
                            <label for="inputText" class="col-sm-3 col-form-label fw-bold">Status</label>
                            <div class="col-sm-9">
                                @if ($dataa->status != 'Rusak')
                                    <input type="text" class="form-control bg-success text-white"
                                        value="{{ $dataa->status }}" disabled>
                                @else
                                    <input type="text" class="form-control bg-danger text-white"
                                        value="{{ $dataa->status }}" disabled>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <label for="inputText" class="col-sm-3 col-form-label fw-bold">Unit</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="{!! $dataa->unit ? $dataa->unit->nama_unit : '<strong>Data unit dihapus</strong>' !!}" disabled>
                            </div>
                        </div>
                        <div class="row">
                            <label for="inputText" class="col-sm-3 col-form-label fw-bold">Lokasi</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="{!! $dataa->lokasi ? $dataa->lokasi->nama_lokasi : '<strong>Data lokasi dihapus</strong>' !!}" disabled>
                            </div>
                        </div>
                        <div class="row">
                            <label for="inputText" class="col-sm-3 col-form-label fw-bold">Jenis
                                Aset</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="{!! $dataa->jenis ? $dataa->jenis->nama_jenis : '<strong>Data jenis dihapus</strong>' !!}" disabled>
                            </div>
                        </div>
                        <div class="row">
                            <label for="inputText" class="col-sm-3 col-form-label fw-bold">Tahun</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="{{ $dataa->tahun }}" disabled>
                            </div>
                        </div>
                        <div class="row">
                            <label for="inputText" class="col-sm-3 col-form-label fw-bold">Merek</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="{{ $dataa->merek }}" disabled>
                            </div>
                        </div>
                        <div class="row">
                            <label for="inputText" class="col-sm-3 col-form-label fw-bold">Processor</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="{{ $dataa->processor }}" disabled>
                            </div>
                        </div>
                        <div class="row">
                            <label for="inputText" class="col-sm-3 col-form-label fw-bold">RAM</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="{{ $dataa->ram }}" disabled>
                            </div>
                        </div>
                        <div class="row">
                            <label for="inputText" class="col-sm-3 col-form-label fw-bold">HDD</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="{{ $dataa->hdd }}" disabled>
                            </div>
                        </div>

                        <div class="row">
                            <label for="inputText" class="col-sm-3 col-form-label fw-bold">Tanggal
                                Update</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="{{ $dataa->updated_at }}" disabled>
                            </div>
                        </div>


                        {{-- <input type="hidden" id="nomor_urut" name="nomor_urut" value="{{ $dataa->nomor_urut }}">
                        <input type="hidden" id="slug_aset" name="slug_aset" value="{{ $dataa->slug_aset }}">
                        <input type="hidden" id="nomor_inventaris" name="nomor_inventaris"
                            value="{{ $dataa->nomor_inventaris }}">
                        <input type="hidden" id="bulan" name="bulan" value="{{ $dataa->bulan }}">
                        <input type="hidden" id="tahun" name="tahun" value="{{ $dataa->tahun }}">
                        <input type="hidden" id="jenis_id" name="jenis_id" value="{{ $dataa->jenis_id }}">
                        <input type="hidden" id="merek" name="merek" value="{{ $dataa->merek }}">
                        <input type="hidden" id="processor" name="processor" value="{{ $dataa->processor }}">
                        <input type="hidden" id="ram" name="ram" value="{{ $dataa->ram }}">
                        <input type="hidden" id="hdd" name="hdd" value="{{ $dataa->hdd }}">
                        <input type="hidden" id="pengguna" name="pengguna" value="{{ $dataa->pengguna }}">
                        <input type="hidden" id="unit_id" name="unit_id" value="{{ $dataa->unit_id }}">
                        <input type="hidden" id="lokasi_id" name="lokasi_id" value="{{ $dataa->lokasi_id }}">
                        <input type="hidden" id="status" name="status" value="{{ $dataa->status }}"> --}}
                    @endforeach
                </div>
            </div>

        </div>

        </div>
    </section>
@endsection
