@extends('layout.main')
@section('container')
<div class="pagetitle">
      <h1 class="mb-4">Tambah Unit</h1>

    <section class="section dashboard">
      <div class="row">
        <div class="col-md-6">

        <div class="card">
          <div class="card-body">

            <!-- Multi Columns Form -->
            <form action="/unit" method="post" class="row g-3 mt-4">
              @csrf
              <div class="col-md-12">
                <label for="nama_unit" class="form-label">Nama Unit</label>
                <input type="text" class="form-control @error('nama_unit') is-invalid @enderror" id="nama_unit" name="nama_unit" value="{{ old('nama_unit') }}" autofocus>
                @error('nama_unit')
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