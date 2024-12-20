    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top ">
        <div class="container d-flex align-items-center">

            <h1 class="logo me-auto"><a href="/">AsTI</a></h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html" class="logo me-auto"><img src="/vendor/landing/assets/img/logo.png" alt="" class="img-fluid"></a>-->

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto" href="/#hero">BERANDA</a></li>
                    <li><a class="nav-link scrollto" href="/#about">TENTANG</a></li>
                    <li><a class="nav-link scrollto" href="/#pencarian">CARI ASET</a></li>
                    {{-- <li><a id="btntikett" href="/tiket" class="nav-link scrollto">BUAT TIKET</a></li> --}}
                    <li>
                        @if (Route::has('login'))
                            <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                                @auth
                                    <a href="{{ url('/dashboard') }}" class="getstarted scrollto">DASHBOARD</a>
                                @else
                                    <a href="{{ route('login') }}" class="getstarted scrollto">MASUK</a>

                                    {{-- @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="getstarted scrollto">Register</a>
                                    @endif --}}
                                @endauth
                            </div>
                        @endif
                    </li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->
        </div>
    </header><!-- End Header -->

    <!-- Memuat jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Memuat SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('btntiket').addEventListener('click', async function() {
            const {
                value: nomorAset,
                isConfirmed
            } = await Swal.fire({
                title: 'Nomor Aset',
                input: "text",
                inputPlaceholder: "Masukkan Nomor Aset",
                showCancelButton: true,
                confirmButtonText: 'Cek',
                cancelButtonText: 'Batal'
            });

            if (isConfirmed) {
                if (nomorAset) {
                    // Modifikasi nomor aset sesuai format yang diinginkan
                    // Swal.fire(`Nomor Aset: ${formattedNomorAset}`);
                    // Kirim formattedNomorAset ke controller menggunakan AJAX
                    const formattedNomorAset = nomorAset.replace(/\//g, '-');
                    $.ajax({
                        url: `/tiket/${formattedNomorAset}`,
                        type: 'GET',
                        success: function(response) {
                            // Redirect ke halaman tiket
                            window.location.href = `/tiket/${formattedNomorAset}`;
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                        }
                    });
                } else {
                    Swal.fire('Nomor Aset tidak boleh kosong', '', 'error');
                }
            }
        });
    </script>
