@extends('layout.main')
@section('container')
    <div class="pagetitle">
        <h1 class="mb-4">Tambah Data Aset</h1>

        <section class="section dashboard">
            <div class="row">
                <div class="col-md-6">

                    <div class="card">
                        <div class="card-body">

                            <!-- Multi Columns Form -->
                            <form action="/aset" method="post" class="row g-3 mt-4" enctype="multipart/form-data">
                                @csrf

                                <div class="col-md-12">
                                    <label for="kategori_aset" class="form-label">Kategori Aset*</label>
                                    <select id="kategori_aset" name="kategori_aset" class="form-select" autofocus>
                                        <option value="Non-Kritikal"
                                            {{ old('kategori_aset') == 'Non-Kritikal' ? 'selected' : '' }}>
                                            Non-Kritikal</option>
                                        <option value="Kritikal" {{ old('kategori_aset') == 'Kritikal' ? 'selected' : '' }}>
                                            Kritikal</option>
                                    </select>
                                    @error('kategori_aset')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-12">
                                    <label for="jenis_id" class="form-label">Jenis Aset*</label>
                                    <select id="jenis_id" name="jenis_id"
                                        class="form-select @error('jenis_id') is-invalid @enderror"
                                        @error('jenis_id') autofocus @enderror onchange="generateNomorInventaris()"
                                        required>
                                        <option selected disabled>Pilih Jenis</option>
                                        @foreach ($data_jenis as $jns)
                                            @if (old('jenis_id') != $jns->id)
                                                <option value="{{ $jns->id }}" data-kode="{{ $jns->kode_jenis }}">
                                                    {{ $jns->nama_jenis }}</option>
                                            @else
                                                <option value="{{ $jns->id }}" data-kode="{{ $jns->kode_jenis }}"
                                                    selected>{{ $jns->nama_jenis }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('jenis_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>


                                <div class="col-md-12">
                                    <label for="tahun" class="form-label">Bulan & Tahun*</label>
                                    <div class="input-group mb-3">
                                        <select id="bulan" name="bulan"
                                            class="form-select col-6 @error('bulan') is-invalid @enderror"
                                            @error('bulan') autofocus @enderror onchange="generateNomorInventaris()"
                                            required>
                                            <option selected disabled>Pilih Bulan</option>
                                            @php
                                                $bulanList = [
                                                    ['value' => 'I', 'label' => 'Januari'],
                                                    ['value' => 'II', 'label' => 'Februari'],
                                                    ['value' => 'III', 'label' => 'Maret'],
                                                    ['value' => 'IV', 'label' => 'April'],
                                                    ['value' => 'V', 'label' => 'Mei'],
                                                    ['value' => 'VI', 'label' => 'Juni'],
                                                    ['value' => 'VII', 'label' => 'Juli'],
                                                    ['value' => 'VIII', 'label' => 'Agustus'],
                                                    ['value' => 'IX', 'label' => 'September'],
                                                    ['value' => 'X', 'label' => 'Oktober'],
                                                    ['value' => 'XI', 'label' => 'November'],
                                                    ['value' => 'XII', 'label' => 'Desember'],
                                                ];
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
                                            @error('tahun') autofocus @enderror onchange="generateNomorInventaris()"
                                            required>
                                            <option selected disabled>Pilih Tahun</option>
                                            @foreach ($th as $thn)
                                                @if (old('tahun') == $thn)
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
                                    <label for="jenis_id" class="form-label">Nomor Urut*</label>
                                    <input type="number" class="form-control @error('nomor_urut') is-invalid @enderror"
                                        id="nomor_urut" name="nomor_urut" value="{{ old('nomor_urut') }}"
                                        onchange="generateNomorInventaris()" required>
                                </div>

                                <div class="col-md-12">
                                    <label for="nomor_inventaris" class="form-label">Nomor Inventaris</label>
                                    <input type="text"
                                        class="form-control fw-bold @error('nomor_inventaris') is-invalid @enderror"
                                        id="nomor_inventaris" name="nomor_inventaris" value="{{ old('nomor_inventaris') }}"
                                        @error('nomor_inventaris') autofocus @enderror readonly
                                        style="background-color: yellow;">
                                    @error('nomor_inventaris')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                    <input type="hidden" class="form-control @error('slug_aset') is-invalid @enderror"
                                        id="slug_aset" name="slug_aset" value="{{ old('slug') }}">

                                    {{-- <button type="button" class="btn btn-sm btn-info mb-2 mt-2" id="generate"
                                        name="generate">Generate</button>
                                    <button type="button" class="btn btn-sm btn-info mb-2 mt-2" id="generate_terkini"
                                        name="generate_terkini">Generate Terkini</button> --}}
                                </div>

                                <script>
                                    function generateNomorInventaris() {
                                        let nomorurut = document.getElementById('nomor_urut').value;
                                        let nomor = nomorurut.padStart(4, '0');

                                        let jenisId = document.getElementById('jenis_id').value;
                                        let selectedOption = document.querySelector('#jenis_id option[value="' + jenisId + '"]');
                                        let kodejenis = selectedOption.getAttribute('data-kode');

                                        let bulan = document.getElementById('bulan').value;
                                        let tahun = document.getElementById('tahun').value;
                                        let nomorInventaris = nomor + '/' + kodejenis + '/' + bulan + '/' + tahun;
                                        let slug_aset = nomor + '-' + kodejenis + '-' + bulan + '-' + tahun;
                                        document.getElementById('nomor_inventaris').value = nomorInventaris;
                                        document.getElementById('slug_aset').value = slug_aset;
                                    }
                                </script>

                                <div class="col-md-12">
                                    <label for="merek" class="form-label">Merek*</label>
                                    <input type="text" class="form-control @error('merek') is-invalid @enderror"
                                        id="merek" name="merek" value="{{ old('merek') }}"
                                        style="text-transform: uppercase;">
                                    @error('merek')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <label for="processor" class="form-label">Processor</label>
                                    <input type="text" class="form-control @error('processor') is-invalid @enderror"
                                        id="processor" name="processor" value="{{ old('processor') }}"
                                        style="text-transform: uppercase;">
                                    @error('processor')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <label for="ram" class="form-label">Ram</label>
                                    <input type="text" class="form-control @error('ram') is-invalid @enderror"
                                        id="ram" name="ram" value="{{ old('ram') }}"
                                        style="text-transform: uppercase;">
                                    @error('ram')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <label for="hdd" class="form-label">Hardisk</label>
                                    <input type="text" class="form-control @error('hdd') is-invalid @enderror"
                                        id="hdd" name="hdd" value="{{ old('hdd') }}"
                                        style="text-transform: uppercase;">
                                    @error('hdd')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <label for="pengguna" class="form-label">Pengguna*</label>
                                    <input type="text" class="form-control @error('pengguna') is-invalid @enderror"
                                        id="pengguna" name="pengguna" value="{{ old('pengguna') }}"
                                        style="text-transform: uppercase;" @error('pengguna') autofocus @enderror>
                                    @error('pengguna')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-12">
                                    <label for="unit_id" class="form-label">Unit*</label>
                                    <select id="unit_id" name="unit_id"
                                        class="form-select @error('unit_id') is-invalid @enderror"
                                        @error('unit_id') autofocus @enderror>
                                        <option selected disabled>Pilih Unit</option>
                                        @foreach ($data_unit as $unit)
                                            @if (old('unit_id') != $unit->id)
                                                <option value="{{ $unit->id }}">{{ $unit->nama_unit }}
                                                </option>
                                            @else
                                                <option value="{{ $unit->id }}" selected>{{ $unit->nama_unit }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('unit_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-12">
                                    <label for="lokasi_id" class="form-label">Lokasi Aset*</label>
                                    <select id="lokasi_id" name="lokasi_id"
                                        class="form-select @error('lokasi_id') is-invalid @enderror"
                                        @error('lokasi_id') autofocus @enderror>
                                        <option selected disabled>Pilih Lokasi</option>
                                        @foreach ($data_lokasi as $lksi)
                                            @if (old('lokasi_id') != $lksi->id)
                                                <option value="{{ $lksi->id }}">{{ $lksi->nama_lokasi }}
                                                </option>
                                            @else
                                                <option value="{{ $lksi->id }}" selected>{{ $lksi->nama_lokasi }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('lokasi_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <fieldset class="col-md-12">
                                    <legend class="col-form-label col-sm-3 pt-0">Status*</legend>
                                    <div class="col-sm-10">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status"
                                                id="status_baik" value="BAIK"
                                                @if (old('status') == 'Baik') checked @endif required>
                                            <label class="form-check-label" for="status_baik">
                                                Baik
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status"
                                                id="status_lambat" value="LAMBAT"
                                                @if (old('status') == 'Lambat') checked @endif required>
                                            <label class="form-check-label" for="status_lambat">
                                                Lambat
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status"
                                                id="status_rusak" value="RUSAK"
                                                @if (old('status') == 'Rusak') checked @endif required>
                                            <label class="form-check-label" for="status_rusak">
                                                Rusak
                                            </label>
                                        </div>
                                        {{-- <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status"
                                                id="status_lainnya" value="Lainnya"
                                                @if (old('status') == 'Lainnya') checked @endif required>
                                            <label class="form-check-label" for="status_lainnya">
                                                Lainnya
                                            </label>
                                        </div> --}}


                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status" id="lainnya"
                                                value="LAINNYA" @if (old('status') == 'Lainnya') checked @endif required>
                                            <label class="form-check-label" for="lainnya">
                                                Lainnya
                                            </label>
                                        </div>

                                        <div id="input_lainnya" style="display: none;">
                                            <input type="text" class="form-control" id="status_lainnya"
                                                name="status_lainnya" value="{{ old('status_lainnya') }}">
                                        </div>

                                        <script>
                                            document.addEventListener('DOMContentLoaded', function() {
                                                var radioButtons = document.querySelectorAll('input[name="status"]');
                                                var inputLainnya = document.getElementById('input_lainnya');
                                                var radioLainnya = document.getElementById('lainnya');

                                                // Fungsi untuk menampilkan atau menyembunyikan field input teks
                                                function toggleInputLainnya() {
                                                    if (radioLainnya.checked) {
                                                        inputLainnya.style.display = 'block';
                                                    } else {
                                                        inputLainnya.style.display = 'none';
                                                    }
                                                }

                                                // Periksa status saat halaman dimuat
                                                toggleInputLainnya();

                                                // Tambahkan event listener pada semua radio button
                                                radioButtons.forEach(function(radio) {
                                                    radio.addEventListener('change', toggleInputLainnya);
                                                });

                                                // Tambahkan event listener pada form submission
                                                document.querySelector('form').addEventListener('submit', function() {
                                                    if (radioLainnya.checked) {
                                                        // Pastikan nilai dari input teks dikirimkan
                                                        document.querySelector('input[name="status"]').value = document.getElementById(
                                                            'status_lainnya').value;
                                                    }
                                                });
                                            });
                                        </script>
                                    </div>
                                </fieldset>

                                <div class="col-md-12 mt-2">
                                    <label for="upl_gambar" class="form-label">Upload Gambar</label> <br>
                                    <input type="file" name="image" id="image">
                                </div>
                                <label for="note" class="text-muted form-label fs-6 fw-light fst-italic">Note: "*"
                                    wajib diisi</label>
                                <br>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form><!-- End Multi Columns Form -->

                        </div>
                    </div>
                </div>
            </div>
        </section>

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
                var jenisAsetSelect = document.getElementById('jenis_id');
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
                    // Mendapatkan jenis aset yang dipilih
                    var jenisAset;
                    @foreach ($data_jenis as $jns)
                        if ("{{ $jns->id }}" === jenisAsetSelect.value) {
                            jenisAset = "{{ $jns->kode_jenis }}";
                        }
                    @endforeach

                    // Mendapatkan bulan dan tahun sesuai kondisi
                    var bulanTerpilih, tahunTerpilih;

                    if (!jenisAset) {
                        alert('Pilih jenis aset terlebih dahulu!');
                        return;
                    }

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
                    var nomorInventaris = nomorUrut + '/' + jenisAset + '/' + bulanRomawi + '/' + tahunTerpilih;
                    var slugAsets = nomorUrut + '-' + jenisAset + '-' + bulanRomawi + '-' + tahunTerpilih;

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

        {{-- GET DATA nomor urut --}}
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>
            $(document).ready(function() {
                // Ajax request untuk mendapatkan data nomor aset terbaru
                $.ajax({
                    url: "{{ route('nomoraset') }}",
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        // Memasukkan nomor aset terbaru ke dalam input dengan id 'nomor_urut'
                        // $('#nomor_urut').val(response.nomor_urut);
                        $('#nomor_urut').val(response.nomor_urut).change(); // Memicu event change
                        console.log(response);
                    }
                });
            });
        </script>
    @endsection
