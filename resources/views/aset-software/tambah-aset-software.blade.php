@extends('layout.main')
@section('container')
    <div class="pagetitle">
        <h1 class="mb-4">Tambah Data Aset Software</h1>

        <section class="section dashboard">
            <div class="row">
                <div class="col-md-6">

                    <div class="card">
                        <div class="card-body">

                            <!-- Multi Columns Form -->
                            <form action="/aset-software" method="post" class="row g-3 mt-4">
                                @csrf
                                <input type="hidden" class="form-control @error('slug_aset') is-invalid @enderror"
                                    id="slug_aset" name="slug_aset" value="{{ old('slug') }}">

                                <div class="col-md-12">
                                    <label for="nomor_urut" class="form-label">Nomor Urut</label>
                                    <input type="number" class="form-control @error('nomor_urut') is-invalid @enderror"
                                        id="nomor_urut" name="nomor_urut" value="{{ old('nomor_urut') }}"
                                        onchange="generateNomorInventaris()">
                                </div>

                                <div class="col-md-12">
                                    <label for="tahun" class="form-label">Bulan & Tahun</label>
                                    <div class="input-group mb-2">
                                        <select id="bulan" name="bulan"
                                            class="form-select col-6 @error('bulan') is-invalid @enderror"
                                            @error('bulan') autofocus @enderror onchange="generateNomorInventaris()">
                                            <option selected disabled>Pilih Bulan</option>
                                            @php
                                                $bulanList = [['value' => 'I', 'label' => 'Januari'], ['value' => 'II', 'label' => 'Februari'], ['value' => 'III', 'label' => 'Maret'], ['value' => 'IV', 'label' => 'April'], ['value' => 'V', 'label' => 'Mei'], ['value' => 'VI', 'label' => 'Juni'], ['value' => 'VII', 'label' => 'Juli'], ['value' => 'VIII', 'label' => 'Agustus'], ['value' => 'IX', 'label' => 'September'], ['value' => 'X', 'label' => 'Oktober'], ['value' => 'XI', 'label' => 'November'], ['value' => 'XII', 'label' => 'Desember']];
                                                $oldValue = old('bulan');
                                            @endphp
                                            @foreach ($bulanList as $bulanItem)
                                                <option value="{{ $bulanItem['value'] }}"
                                                    @if ($oldValue == $bulanItem['value']) selected @endif>
                                                    {{ $bulanItem['label'] }}</option>
                                            @endforeach
                                        </select>

                                        <span class="input-group-text">|</span>
                                        <select id="tahun" name="tahun"
                                            class="form-select col-6  @error('tahun') is-invalid @enderror"
                                            @error('tahun') autofocus @enderror onchange="generateNomorInventaris()">
                                            <option selected disabled>Pilih Tahun</option>
                                            @foreach ($th as $thn)
                                                @if (old('tahun') === $thn)
                                                    <option value="{{ $thn }}" selected>{{ $thn }}
                                                    </option>
                                                @else
                                                    <option value="{{ $thn }}">{{ $thn }}</option>
                                                @endif
                                            @endforeach
                                        </select>

                                        @error('bulan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        @error('tahun')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <label for="nomor_inventaris" class="form-label">Nomor Inventaris</label>
                                    <input type="text"
                                        class="form-control @error('nomor_inventaris') is-invalid @enderror"
                                        id="nomor_inventaris" name="nomor_inventaris" value="{{ old('nomor_inventaris') }}"
                                        @error('nomor_inventaris') autofocus @enderror readonly>
                                    @error('nomor_inventaris')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                    {{-- <button type="button" class="btn btn-sm btn-info mb-2 mt-2" id="generate"
                                        name="generate">Generate</button>
                                    <button type="button" class="btn btn-sm btn-info mb-2 mt-2" id="generate_terkini"
                                        name="generate_terkini">Generate Terkini</button> --}}
                                </div>

                                <script>
                                    function generateNomorInventaris() {
                                        let nomorurut = document.getElementById('nomor_urut').value;
                                        let nomor = nomorurut.padStart(4, '0');


                                        let bulan = document.getElementById('bulan').value;
                                        let tahun = document.getElementById('tahun').value;
                                        let nomorInventaris = nomor + '/' + 'APPS' + '/' + bulan + '/' + tahun;
                                        let slug_aset = nomor + '-' + 'APPS' + '-' + bulan + '-' + tahun;
                                        document.getElementById('nomor_inventaris').value = nomorInventaris;
                                        document.getElementById('slug_aset').value = slug_aset;
                                    }
                                </script>

                                <div class="col-md-12">
                                    <label for="nama_aplikasi" class="form-label">Nama Aplikasi</label>
                                    <input type="text" class="form-control @error('nama_aplikasi') is-invalid @enderror"
                                        id="nama_aplikasi" name="nama_aplikasi" value="{{ old('nama_aplikasi') }}"
                                        @error('nama_aplikasi') autofocus @enderror>
                                    @error('nama_aplikasi')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-12">
                                    <label for="jenis_aplikasi" class="form-label">Jenis Aplikasi</label>
                                    <select id="jenis_aplikasi" name="jenis_aplikasi"
                                        class="form-select @error('jenis_aplikasi') is-invalid @enderror"
                                        @error('jenis_aplikasi') autofocus @enderror>
                                        <option selected disabled>Pilih Unit</option>
                                        <option value="Website">Website</option>
                                        <option value="Desktop">Desktop</option>
                                    </select>
                                </div>

                                <div class="col-md-12">
                                    <label for="unit_pengguna" class="form-label">Pengguna Aplikasi</label>
                                    <input type="text" class="form-control @error('unit_pengguna') is-invalid @enderror"
                                        id="unit_pengguna" name="unit_pengguna" value="{{ old('unit_pengguna') }}"
                                        @error('unit_pengguna') autofocus @enderror>
                                    @error('unit_pengguna')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-12">
                                    <label for="keterangan" class="form-label">Keterangan</label>
                                    <input type="text" class="form-control @error('keterangan') is-invalid @enderror"
                                        id="keterangan" name="keterangan" value="{{ old('keterangan') }}"
                                        @error('keterangan') autofocus @enderror>
                                    @error('keterangan')
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

        {{-- GET DATA nomor urut --}}
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>
            $(document).ready(function() {
                // Ajax request untuk mendapatkan data nomor aset terbaru
                $.ajax({
                    url: "{{ route('nomorasetsoftware') }}",
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        // Memasukkan nomor aset terbaru ke dalam input dengan id 'nomor_urut'
                        $('#nomor_urut').val(response.nomor_urut);
                        console.log(response);
                    }
                });
            });
        </script>

        {{-- <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Mendapatkan elemen-elemen HTML yang dibutuhkan
                var nomorInventarisInput = document.getElementById('nomor_inventaris');
                var slugAset = document.getElementById('slug_aset');
                var nomorUrutInput = document.getElementById('nomor_urut');

                // Menambahkan event listener pada field nomor inventaris
                nomorInventarisInput.addEventListener('input', function() {
                    // Mendapatkan nilai dari field nomor inventaris
                    var nomorInventarisValue = nomorInventarisInput.value;

                    // Mengambil 4 karakter pertama dari nomor inventaris (jika lebih dari 4 karakter)
                    var nomorUrutValue = nomorInventarisValue.substring(0, 4);

                    // Memasukkan nilai ke dalam field nomor urut
                    nomorUrutInput.value = nomorUrutValue;

                    slugAset.value = nomorInventarisValue;
                });
            });


            document.addEventListener('DOMContentLoaded', function() {
                // Mendapatkan elemen-elemen HTML yang dibutuhkan
                var nomorInventarisInput = document.getElementById('nomor_inventaris');
                var slugAset = document.getElementById('slug_aset');
                var nomorUrutInput = document.getElementById('nomor_urut');
                var bulanSelect = document.getElementById('bulan');
                var tahunSelect = document.getElementById('tahun');
                var generateButton = document.getElementById('generate');
                var generateTerkiniButton = document.getElementById('generate_terkini');

                // Menambahkan event listener pada tombol "Generate"
                generateButton.addEventListener('click', function() {
                    generateNomorInventaris(
                        false); // Memanggil fungsi generateNomorInventaris dengan status "Generate"
                });

                // Menambahkan event listener pada tombol "Generate Terkini"
                generateTerkiniButton.addEventListener('click', function() {
                    generateNomorInventaris(
                        true); // Memanggil fungsi generateNomorInventaris dengan status "Generate Terkini"
                    setBulanTahunToCurrent(); // Mengatur nilai field bulan dan tahun ke posisi terkini
                });

                // Fungsi untuk mengatur nilai field bulan dan tahun ke posisi terkini
                function setBulanTahunToCurrent() {
                    var currentDate = new Date();
                    var currentMonth = currentDate.getMonth();
                    var currentYear = currentDate.getFullYear();

                    // Mengatur nilai field bulan ke posisi terkini
                    bulanSelect.value = getRomanMonth(currentMonth);

                    // Mengatur nilai field tahun ke posisi terkini
                    tahunSelect.value = currentYear.toString();
                }

                // Fungsi untuk meng-generate nomor inventaris berdasarkan jenis aset, bulan, dan tahun terpilih
                function generateNomorInventaris(isTerkini) {

                    // Mendapatkan bulan dan tahun sesuai kondisi
                    var bulanTerpilih, tahunTerpilih;

                    if (isTerkini) {
                        // Jika "Generate Terkini" diklik, ambil bulan dan tahun saat ini
                        var currentDate = new Date();
                        bulanTerpilih = getRomanMonth(currentDate.getMonth());
                        tahunTerpilih = currentDate.getFullYear().toString();
                    } else {
                        // Jika "Generate" diklik, ambil bulan dan tahun dari field bulan dan tahun
                        bulanTerpilih = bulanSelect.value;
                        tahunTerpilih = tahunSelect.value;

                        if (bulanTerpilih === 'Pilih Bulan' || tahunTerpilih === 'Pilih Tahun') {
                            alert('Pilih bulan dan tahun terlebih dahulu!');
                            return;
                        }
                    }

                    var nomorUrut =
                        "{{ $last_urut && $last_urut->nomor_urut !== null ? sprintf('%04d', $last_urut->nomor_urut + 1) : '0001' }}";



                    var bulanRomawi = bulanTerpilih;
                    var nomorInventaris = nomorUrut + '/' + 'APPS' + '/' + bulanRomawi + '/' + tahunTerpilih;
                    var slugAsets = nomorUrut + '-' + 'APPS' + '-' + bulanRomawi + '-' + tahunTerpilih;

                    // Memasukkan nomor inventaris dan nomor urut ke dalam input field
                    nomorInventarisInput.value = nomorInventaris;
                    slugAset.value = slugAsets;
                    nomorUrutInput.value = nomorUrut;
                }

                // Fungsi untuk mendapatkan bulan dalam format Romawi
                function getRomanMonth(month) {
                    var months = [
                        'I', 'II', 'III', 'IV', 'V', 'VI',
                        'VII', 'VIII', 'IX', 'X', 'XI', 'XII'
                    ];

                    var romanMonth = months[month];
                    return romanMonth;
                }
            });
        </script> --}}
    @endsection
