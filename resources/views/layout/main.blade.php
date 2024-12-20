<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>{{ $title }}</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    {{-- <link href="{{ asset('vendor/assets/img/favicon.png') }}" rel="icon"> --}}
    <link href="{{ asset('images/logopersero.png') }}" rel="icon">
    <link href="{{ asset('vendor/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('vendor/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">
    <link href="{{ asset('style.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('vendor/assets/css/style.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">
</head>

<body>

    @include('partials.header')

    @include('partials.sidebar')

    <main id="main" class="main">
        @yield('container')
    </main><!-- End #main -->

    {{-- Modal Scanner Aset --}}
    <div class="modal fade" id="modal-scan-camera" tabindex="-1" aria-labelledby="modal-scan-cameraLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-scan-cameraLabel">Scan Barcode</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- Kamera Scan --}}
                    <div class="card text-center align-center">
                        <video id="scanner" style="width:50%;transform: none;"></video>
                        <h6 id="hasil-scan"></h6>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let scanner;

        function startCamera() {
            scanner = new Instascan.Scanner({
                video: document.getElementById('scanner')
            });

            scanner.addListener('scan', function(content) {
                document.getElementById('hasil-scan').textContent = "Hasil Scan: " + content;
                window.location.href = "/pencarian?cari_data=" + encodeURIComponent(content);
                scanner.stop();
            });

            Instascan.Camera.getCameras().then(function(cameras) {
                if (cameras.length > 0) {
                    let selectedCamera = cameras.find(camera => camera.name.toLowerCase().includes('back')) ||
                        cameras[0];
                    // Jika kamera belakang digunakan, balik gambar agar tidak mirror
                    if (selectedCamera.name.toLowerCase().includes('back')) {
                        document.getElementById('scanner').style.transform = 'scaleX(1)';
                    } else {
                        // Jika kamera depan digunakan, mirror video
                        document.getElementById('scanner').style.transform = 'scaleX(-1)';
                    }
                    scanner.start(selectedCamera);
                } else {
                    console.error('No cameras found.');
                }
            }).catch(function(e) {
                console.error('Error initializing scanner:', e);
            });
        }

        function stopCamera() {
            if (scanner) {
                scanner.stop();
            }
            document.getElementById('hasil-scan').textContent = "";
        }

        document.getElementById('modal-scan-camera').addEventListener('shown.bs.modal', startCamera);
        document.getElementById('modal-scan-camera').addEventListener('hidden.bs.modal', stopCamera);
    </script>

    {{-- <script>
        let scanner;

        function startCamera() {
            scanner = new Instascan.Scanner({
                video: document.getElementById('scanner')
            });

            scanner.addListener('scan', function(content) {
                // Menampilkan hasil scan pada elemen dengan ID "hasil-scan"
                document.getElementById('hasil-scan').textContent = "Hasil Scan: " + content;

                // Redirect ke /pencarian dengan parameter hasil scan
                window.location.href = "/pencarian?cari_data=" + encodeURIComponent(content);

                // Mematikan kamera setelah berhasil scan
                scanner.stop();
            });

            Instascan.Camera.getCameras().then(function(cameras) {
                if (cameras.length > 1) {
                    scanner.start(cameras[1]);

                } else if (cameras.length > 0) {
                    scanner.start(cameras[0]);
                } else {
                    console.error('No cameras found.');
                }
            }).catch(function(e) {
                console.error(e);
            });
        }

        // Menambahkan event listener untuk memanggil fungsi startCamera saat modal muncul
        document.getElementById('modal-scan-camera').addEventListener('shown.bs.modal', startCamera);

        // Menambahkan event listener untuk memanggil fungsi stopCamera saat modal ditutup
        document.getElementById('modal-scan-camera').addEventListener('hidden.bs.modal', stopCamera);

        function stopCamera() {
            // Hentikan streaming dan matikan video
            if (scanner) {
                scanner.stop();
            }
            document.getElementById('hasil-scan').textContent;
        }
    </script> --}}
    {{-- End Modal Scanner --}}

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>IT</span></strong>. PerseroBatam
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Select2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            console.log('Initializing Select2...');
            $('#nomor-inventaris').select2({
                placeholder: "-- Pilih Nomor Inventaris --",
                allowClear: true
            });
        });
    </script>

    <!-- Vendor JS Files -->
    <script src="{{ asset('vendor/assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('vendor/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/assets/vendor/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('vendor/assets/vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('vendor/assets/vendor/quill/quill.min.js') }}"></script>
    <script src="{{ asset('vendor/assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('vendor/assets/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('vendor/assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('script.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('vendor/assets/js/main.js') }}"></script>

</body>

</html>
