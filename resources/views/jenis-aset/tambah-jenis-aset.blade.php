@extends('layout.main')
@section('container')
<div class="pagetitle">
      <h1 class="mb-4">Tambah Jenis Aset</h1>

    <section class="section dashboard">
      <div class="row">
        <div class="col-md-6">

        <div class="card">
          <div class="card-body">

            <!-- Multi Columns Form -->
            <form action="/jenis-aset" method="post" class="row g-3 mt-4">
              @csrf
              <div class="col-md-12">
                <label for="nama_jenis" class="form-label">Nama Jenis</label>
                <input type="text" class="form-control @error('nama_jenis') is-invalid @enderror" id="nama_jenis" name="nama_jenis" value="{{ old('nama_jenis') }}" autofocus>
                @error('nama_jenis')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
              <div class="col-md-12">
                <label for="kode_jenis" class="form-label">Kode Jenis</label>
                <input type="text" class="form-control @error('kode_jenis') is-invalid @enderror" id="kode_jenis" name="kode_jenis" value="{{ old('kode_jenis') }}" autofocus>
                @error('kode_jenis')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
              <div class="text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form><!-- End Multi Columns Form -->

          </div>
        </div>
        </div>
      </div>
    </section>
@endsection