<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>AsTI Persero</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('vendor/landing/assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('vendor/landing/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('vendor/landing/assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/landing/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/landing/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/landing/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/landing/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/landing/assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/landing/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('vendor/landing/assets/css/style.css') }}" rel="stylesheet">

</head>

<body>

    @include('landing-page.partials.header')



    <main id="main">
        @yield('cont')
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

                // Isi hasil scan ke dalam input pencarian
                document.getElementById('cari_data').value = content;

                // Submit form secara otomatis
                document.getElementById('pencarian-form').submit();

                // Hentikan scanner
                scanner.stop();

                // Tutuplah modal tanpa getInstance
                let modalElement = document.getElementById('modal-scan-camera');
                modalElement.classList.remove('show'); // Tutup modal
                modalElement.style.display = 'none'; // Hilangkan modal dari tampilan
                document.body.classList.remove('modal-open'); // Hapus class modal-open dari body
                document.body.style = ''; // Reset style body

                let backdrop = document.getElementsByClassName('modal-backdrop')[0];
                if (backdrop) {
                    backdrop.parentNode.removeChild(backdrop); // Hapus backdrop
                }
            });

            Instascan.Camera.getCameras().then(function(cameras) {
                if (cameras.length > 0) {
                    // Pilih kamera belakang jika ada
                    let selectedCamera = cameras.find(camera => camera.name.toLowerCase().includes('back')) ||
                        cameras[0];

                    // Mengatur transformasi berdasarkan kamera
                    if (selectedCamera.name.toLowerCase().includes('back')) {
                        document.getElementById('scanner').style.transform = 'scaleX(1)'; // Tidak mirror
                    } else {
                        document.getElementById('scanner').style.transform = 'scaleX(-1)'; // Mirror
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

        // Mulai kamera saat modal terbuka
        document.getElementById('modal-scan-camera').addEventListener('shown.bs.modal', startCamera);

        // Hentikan kamera saat modal ditutup
        document.getElementById('modal-scan-camera').addEventListener('hidden.bs.modal', stopCamera);
    </script>

    <!-- ======= Footer ======= -->
    <footer id="footer">

        {{-- <div class="footer-newsletter">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <h4>Join Our Newsletter</h4>
                        <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna</p>
                        <form action="" method="post">
                            <input type="email" name="email"><input type="submit" value="Subscribe">
                        </form>
                    </div>
                </div>
            </div>
        </div> --}}

        <div class="footer-top">
            <div class="container">
                <div class="row">

                    <div class="col-lg-3 col-md-6 footer-contact">
                        <h3>AsTI</h3>
                        <p>
                            PT PERSERO BATAM <br>
                            Kota Batam<br>
                            <strong>Email:</strong> it@perserobatam.com<br>
                        </p>
                    </div>

                </div>
            </div>
        </div>

        <div class="container footer-bottom clearfix">
            {{-- <div class="copyright">
                &copy; Copyright <strong><span>Arsha</span></strong>. All Rights Reserved
            </div>
            <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/ -->
                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div> --}}
        </div>
    </footer><!-- End Footer -->

    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('vendor/landing/assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('vendor/landing/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/landing/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('vendor/landing/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('vendor/landing/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/landing/assets/vendor/waypoints/noframework.waypoints.js') }}"></script>
    <script src="{{ asset('vendor/landing/assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('vendor/landing/assets/js/main.js') }}"></script>


</body>

</html>
