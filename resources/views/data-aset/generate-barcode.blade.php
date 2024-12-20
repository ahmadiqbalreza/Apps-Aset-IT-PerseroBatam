@extends('layout.main')
@section('container')
    <div class="pagetitle">
        <h1 class="mb-3">Cetak Barcode</h1>

        <section class="section dashboard">
            <div class="row">
                <div class="col-lg">
                    <div class="row">
                        <div class="col-12">
                            <div class="card recent-sales overflow-auto">
                                <div class="card-body" id="printContent">

                                    <script>
                                        // Fungsi untuk memulai pemindaian
                                        function startScan() {
                                            Quagga.init({
                                                inputStream: {
                                                    name: "Live",
                                                    type: "LiveStream",
                                                    target: document.querySelector("#scanner"), // ID elemen untuk menampilkan video
                                                },
                                                decoder: {
                                                    readers: ["ean_reader", "code_128_reader"], // Pilih pembaca yang sesuai dengan kebutuhan
                                                },
                                            }, function(err) {
                                                if (err) {
                                                    console.error(err);
                                                    return;
                                                }
                                                Quagga.start();
                                            });

                                            Quagga.onDetected(function(result) {
                                                // Menampilkan hasil scan pada elemen dengan ID "hasil-scan"
                                                document.getElementById('hasil-scan').textContent = "Hasil Scan: " + result.codeResult.code;

                                                // Mematikan pemindaian setelah berhasil scan
                                                Quagga.stop();
                                            });
                                        }

                                        // Panggil fungsi startScan saat modal muncul
                                        document.getElementById('modal-scan-camera').addEventListener('shown.bs.modal', startScan);

                                        // Mematikan pemindaian saat modal ditutup
                                        document.getElementById('modal-scan-camera').addEventListener('hidden.bs.modal', function() {
                                            Quagga.stop();
                                            document.getElementById('hasil-scan').textContent = "Hasil Scan: ";
                                        });
                                    </script>

                                    {{-- <h1>Instascan QR Code Scanner</h1>
                                    <video id="scanner" style="width:50%;"></video>
                                    <script src="https://cdn.rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>

                                    <script>
                                        let scanner = new Instascan.Scanner({
                                            video: document.getElementById('scanner')
                                        });

                                        scanner.addListener('scan', function(content) {
                                            alert("QR Code detected: " + content);
                                            // Handle the detected QR Code as needed
                                        });

                                        Instascan.Camera.getCameras().then(function(cameras) {
                                            if (cameras.length > 0) {
                                                scanner.start(cameras[0]);
                                            } else {
                                                console.error('No cameras found.');
                                            }
                                        }).catch(function(e) {
                                            console.error(e);
                                        });
                                    </script> --}}

                                    {{-- <h1>Barcode Scanner</h1>
                                    <div id="scanner-container"></div>

                                    <script src="{{ asset('js/quagga.min.js') }}"></script>
                                    <script>
                                         --}}
                                    </script>
                                    {{-- <script>
                                        Quagga.init({
                                            inputStream: {
                                                name: "Live",
                                                type: "LiveStream",
                                                target: document.querySelector("#scanner-container"),
                                                constraints: {
                                                    width: 640,
                                                    height: 480,
                                                    facingMode: "environment",
                                                },
                                            },
                                            decoder: {
                                                readers: ["code_128_reader", "ean_reader"],
                                            },
                                        }, function(err) {
                                            if (err) {
                                                console.error(err);
                                                return;
                                            }
                                            Quagga.start();
                                        });

                                        Quagga.onDetected(function(result) {
                                            alert("Barcode detected: " + result.codeResult.code);
                                        });
                                    </script> --}}

                                    {!! QrCode::size(200)->generate('0002/LTP/V/2023') !!}
                                    <p>0002/LTP/V/2023</p>

                                    <!-- Tombol Cetak -->
                                    <button id="btnPrint" class="btn btn-primary" onclick="printPage()">Cetak</button>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Tambahkan script JavaScript -->
        <script>
            function printPage() {
                // Sembunyikan tombol cetak
                document.getElementById('btnPrint').style.display = 'none';

                // Sembunyikan elemen-elemen yang tidak perlu dicetak
                document.body.innerHTML = document.getElementById('printContent').innerHTML;

                // Cetak halaman
                window.print();

                // Kembalikan tampilan awal setelah selesai mencetak
                location.reload();
            }
        </script>
    @endsection
