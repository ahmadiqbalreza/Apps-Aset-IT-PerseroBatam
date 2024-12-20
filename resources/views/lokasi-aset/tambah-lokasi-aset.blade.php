@extends('layout.main')
@section('container')
<div class="pagetitle">
      <h1 class="mb-4">Tambah Lokasi Aset</h1>

    <section class="section dashboard">
      <div class="row">
        <div class="col-md-6">

        <div class="card">
          <div class="card-body">

            <!-- Multi Columns Form -->
            <form action="/lokasi-aset" method="post" class="row g-3 mt-4">
              @csrf
              <div class="col-md-12">
                <label for="nama_lokasi" class="form-label">Lokasi Aset</label>
                <input type="text" class="form-control @error('nama_lokasi') is-invalid @enderror" id="nama_lokasi" name="nama_lokasi" value="{{ old('nama_lokasi') }}" autofocus>
                @error('nama_lokasi')
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