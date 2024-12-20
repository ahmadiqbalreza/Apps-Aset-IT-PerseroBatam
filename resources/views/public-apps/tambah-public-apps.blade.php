@extends('layout.main')
@section('container')
    <div class="pagetitle">
        <h1 class="mb-4">Tambah Data Public APPS</h1>

        <section class="section dashboard">
            <div class="row">
                <div class="col-md-6">

                    <div class="card">
                        <div class="card-body">

                            <!-- Multi Columns Form -->
                            <form action="/public-apps" method="post" class="row g-3 mt-2">
                                @csrf
                                <input type="hidden" class="form-control @error('slug_aset') is-invalid @enderror"
                                    id="slug_aset" name="slug_aset" value="{{ old('slug') }}">

                                <div class="col-md-12">
                                    <label for="domain" class="form-label">Domain</label>
                                    <input type="text" class="form-control @error('domain') is-invalid @enderror"
                                        id="domain" name="domain" value="{{ old('domain') }}">
                                </div>

                                <div class="col-md-12">
                                    <label for="directory" class="form-label">Directory</label>
                                    <input type="text" class="form-control @error('directory') is-invalid @enderror"
                                        id="directory" name="directory" value="{{ old('directory') }}">
                                </div>

                                <div class="col-md-12">
                                    <label for="ip_server" class="form-label">IP Server</label>
                                    <input type="text" class="form-control @error('ip_server') is-invalid @enderror"
                                        id="ip_server" name="ip_server" value="{{ old('ip_server') }}">
                                </div>

                                <div class="col-md-12">
                                    <label for="port" class="form-label">Port</label>
                                    <input type="number" class="form-control @error('port') is-invalid @enderror"
                                        id="port" name="port" value="{{ old('port') }}">
                                </div>

                                <div class="col-md-12">
                                    <label for="jenis_server" class="form-label">Jenis Server</label>
                                    <select id="jenis_server" name="jenis_server"
                                        class="form-select @error('jenis_server') is-invalid @enderror"
                                        @error('jenis_server') autofocus @enderror>
                                        <option selected disabled>Pilih Jenis Server</option>
                                        <option value="Development">Development</option>
                                        <option value="Production">Production</option>
                                    </select>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="kategori" class="form-label">Kategori</label>
                                    <select id="kategori" name="kategori"
                                        class="form-select @error('kategori') is-invalid @enderror"
                                        @error('kategori') autofocus @enderror>
                                        <option selected disabled>Pilih Kategori Server</option>
                                        <option value="Kritikal">Kritikal</option>
                                        <option value="Non-Kritikal">Non-Kritikal</option>
                                    </select>
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
