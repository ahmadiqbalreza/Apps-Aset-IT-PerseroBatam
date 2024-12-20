@extends('layout.main')
@section('container')
    <div class="pagetitle">
        <h1 class="mb-3">Dashboard</h1>

        <section class="section dashboard">

            <div class="row">

                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">ASET | Public App's <span>| Non-Kritikal</span></h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-layout-wtf"></i>
                                </div>
                                <div class="ps-3">
                                    <h3>
                                        <a href="" type="button" data-bs-toggle="modal"
                                            data-bs-target="#modal-aset-nonkritikal">
                                            <span class="text-success pt-1 fw-bold">
                                                {{ $data_count_non_kritikal }}
                                            </span> <span class="text-muted small pt-2 ps-1">Unit | </span>
                                        </a>
                                        <a href="" type="button" data-bs-toggle="modal"
                                            data-bs-target="#modal-aset-nonkritikal-public-apps">
                                            <span class="text-success pt-1 fw-bold">
                                                {{ $data_count_non_kritikal_public_apps }}
                                            </span> <span class="text-muted small pt-2 ps-1">Public App's</span>
                                        </a>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">ASET | Public App's<span>| Kritikal</span></h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-radioactive"></i>
                                </div>
                                <div class="ps-3">
                                    <h3>
                                        <a href="" type="button" data-bs-toggle="modal"
                                            data-bs-target="#modal-aset-kritikal">
                                            <span class="text-danger pt-1 fw-bold">
                                                {{ $data_count_kritikal }}
                                            </span> <span class="text-muted small pt-2 ps-1">Unit | </span>
                                        </a>
                                        <a href="" type="button" data-bs-toggle="modal"
                                            data-bs-target="#modal-aset-kritikal-public-apps">
                                            <span class="text-danger pt-1 fw-bold">
                                                {{ $data_count_kritikal_public_apps }}
                                            </span> <span class="text-muted small pt-2 ps-1">Public App's</span>
                                        </a>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Modal Aset Non-Kritikal --}}
                <div class="modal fade" id="modal-aset-nonkritikal" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">
                                    ASET NON KRITIKAL
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="card">
                                <div class="card-body">

                                    <!-- Default Table -->
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">No. Inventaris</th>
                                                <th scope="col">Tahun</th>
                                                <th scope="col">Jenis</th>
                                                <th scope="col">Merek</th>
                                                <th scope="col">Pengguna</th>
                                                <th scope="col">Unit</th>
                                                <th scope="col">Lokasi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($datanonkritikalaset as $dataa)
                                                <tr>
                                                    <td>
                                                        {{ $dataa->nomor_inventaris }}
                                                    </td>
                                                    <td>{{ $dataa->tahun }}</td>
                                                    <td>{!! $dataa->jenis ? $dataa->jenis->nama_jenis : '<strong>Master Data jenis dihapus</strong>' !!}</td>
                                                    <td class="text-truncate" style="max-width: 150px;">
                                                        {{ $dataa->merek }}
                                                    </td>
                                                    <td>{{ $dataa->pengguna }}</td>
                                                    <td>{!! $dataa->unit ? $dataa->unit->nama_unit : '<strong>Master Data unit dihapus</strong>' !!}</td>
                                                    <td>{!! $dataa->lokasi ? $dataa->lokasi->nama_lokasi : '<strong>Master Data lokasi dihapus</strong>' !!}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    Close
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Modal Aset Kritikal --}}
                <div class="modal fade" id="modal-aset-kritikal" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">
                                    ASET KRITIKAL
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="card">
                                <div class="card-body">

                                    <!-- Default Table -->
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">No. Inventaris</th>
                                                <th scope="col">Tahun</th>
                                                <th scope="col">Jenis</th>
                                                <th scope="col">Merek</th>
                                                <th scope="col">Pengguna</th>
                                                <th scope="col">Unit</th>
                                                <th scope="col">Lokasi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($datakritikalaset as $dataa)
                                                <tr>
                                                    <td>
                                                        {{ $dataa->nomor_inventaris }}
                                                    </td>
                                                    <td>{{ $dataa->tahun }}</td>
                                                    <td>{!! $dataa->jenis ? $dataa->jenis->nama_jenis : '<strong>Master Data jenis dihapus</strong>' !!}</td>
                                                    <td class="text-truncate" style="max-width: 150px;">
                                                        {{ $dataa->merek }}
                                                    </td>
                                                    <td>{{ $dataa->pengguna }}</td>
                                                    <td>{!! $dataa->unit ? $dataa->unit->nama_unit : '<strong>Master Data unit dihapus</strong>' !!}</td>
                                                    <td>{!! $dataa->lokasi ? $dataa->lokasi->nama_lokasi : '<strong>Master Data lokasi dihapus</strong>' !!}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    Close
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Modal Aset Non-Kritikal-Public-Apps --}}
                <div class="modal fade" id="modal-aset-nonkritikal-public-apps" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">
                                    ASET NON KRITIKAL PUBLIC APPS
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="card">
                                <div class="card-body">

                                    <!-- Default Table -->
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">No.</th>
                                                <th scope="col">Domain</th>
                                                <th scope="col">Directory</th>
                                                <th scope="col">IP Server</th>
                                                <th scope="col">Port</th>
                                                <th scope="col">Jenis Server</th>
                                                <th scope="col">Kategori</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($datanonkritikalpublicapp as $dataa)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        {{ $dataa->domain }}
                                                    </td>
                                                    <td>
                                                        {{ $dataa->directory }}
                                                    </td>
                                                    <td>
                                                        {{ $dataa->ip_server }}
                                                    </td>
                                                    <td>
                                                        {{ $dataa->port }}
                                                    </td>
                                                    <td>
                                                        {{ $dataa->jenis_server }}
                                                    </td>
                                                    <td>
                                                        {{ $dataa->kategori }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    Close
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Modal Aset Kritikal Public Apps --}}
                <div class="modal fade" id="modal-aset-kritikal-public-apps" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">
                                    ASET KRITIKAL PUBLIC APPS
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="card">
                                <div class="card-body">

                                    <!-- Default Table -->
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">No.</th>
                                                <th scope="col">Domain</th>
                                                <th scope="col">Directory</th>
                                                <th scope="col">IP Server</th>
                                                <th scope="col">Port</th>
                                                <th scope="col">Jenis Server</th>
                                                <th scope="col">Kategori</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($datakritikalpublicapp as $dataa)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        {{ $dataa->domain }}
                                                    </td>
                                                    <td>
                                                        {{ $dataa->directory }}
                                                    </td>
                                                    <td>
                                                        {{ $dataa->ip_server }}
                                                    </td>
                                                    <td>
                                                        {{ $dataa->port }}
                                                    </td>
                                                    <td>
                                                        {{ $dataa->jenis_server }}
                                                    </td>
                                                    <td>
                                                        {{ $dataa->kategori }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    Close
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-12 col-sm-6 col-lg-7">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">ASET PERSERO BATAM BERDASARKAN TAHUN dan LOKASI</h5>
                            <!-- Bordered Table -->
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr class="text-center align-middle">
                                            <th scope="col">TAHUN</th>
                                            @foreach ($data_count_lokasi as $lokasi)
                                                <th scope="col" class="lokasi-column">{{ $lokasi->nama_lokasi }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            // Array untuk menyimpan total tiap kolom (lokasi)
                                            $total_per_lokasi = array_fill(0, $data_count_lokasi->count(), 0);
                                        @endphp

                                        @foreach ($data_count_kode_jenis as $jenis)
                                            <tr>
                                                <td class="text-center">{{ $jenis->tahun }}</td>
                                                @foreach ($data_count_lokasi as $index => $lokasi)
                                                    <td class="lokasi-column">
                                                        @php
                                                            $total_data = $data_tabel
                                                                ->where('tahun', $jenis->tahun)
                                                                ->where('nama_lokasi', $lokasi->nama_lokasi)
                                                                ->first();
                                                            $count = $total_data->total_data ?? 0;
                                                            // Tambahkan ke total per lokasi
                                                            $total_per_lokasi[$index] += $count;
                                                        @endphp
                                                        {{ $count }}
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Total</th>
                                            @foreach ($total_per_lokasi as $total)
                                                <th class="text-center">{{ $total }}</th>
                                            @endforeach
                                        </tr>
                                        <tr>
                                            <th>Total Keseluruhan</th>
                                            <td class="fw-bold text-center table-danger"
                                                colspan="{{ $data_count_lokasi->count() }}">
                                                @php
                                                    $total_keseluruhan = array_sum($total_per_lokasi);
                                                @endphp
                                                {{ $total_keseluruhan }}
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- End Bordered Table -->
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-5">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">PUBLIC APPS PERSERO BATAM</h5>
                            <!-- Bordered Table -->
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped mb-4">
                                    <thead>
                                        <tr>
                                            <th scope="col">JENIS SERVER</th>
                                            <th scope="col">TOTAL</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Production</td>
                                            <td class="text-center">{{ $data_count_production_public_apps }} App's</td>
                                        </tr>
                                        <tr>
                                            <td>Development</td>
                                            <td class="text-center">{{ $data_count_development_public_apps }} App's</td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Total Keseluruhan</th>
                                            <td class="fw-bold text-center table-danger">
                                                {{ $data_count_public_apps }} App's</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">DOMAIN</th>
                                            <th scope="col">IP Lokal</th>
                                            <th scope="col">PORT</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($datapublicapps as $data)
                                            <tr>
                                                <td>{{ $data->domain }}</td>
                                                <td>{{ $data->ip_server }}</td>
                                                <td>{{ $data->port }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Berdasarkan Jenis</h5>
                            <!-- Bar Chart -->
                            <div id="barChartContainer" style="overflow-y: scroll; height: 215px;">
                                <!-- Batas tinggi tetap untuk scroll vertikal -->
                                <div id="barChart" style="height: 100%;"></div>
                            </div>

                            <script>
                                document.addEventListener("DOMContentLoaded", () => {
                                    new ApexCharts(document.querySelector("#barChart"), {
                                        series: [{
                                            data: [
                                                @foreach ($data_count as $dtc)
                                                    '{{ $dtc->total_data }}',
                                                @endforeach
                                            ]
                                        }],
                                        chart: {
                                            type: 'bar',
                                            height: {{ count($data_count) * 18 }}, // Atur tinggi berdasarkan jumlah data
                                        },
                                        plotOptions: {
                                            bar: {
                                                borderRadius: 4,
                                                horizontal: true,
                                                barHeight: '60%' // Menyesuaikan tinggi batang
                                            }
                                        },
                                        dataLabels: {
                                            enabled: false
                                        },
                                        xaxis: {
                                            categories: [
                                                @foreach ($data_count as $dtc)
                                                    '{{ $dtc->nama_jenis }}',
                                                @endforeach
                                            ],
                                        }
                                    }).render();
                                });
                            </script>
                            <!-- End Bar Chart -->

                        </div>
                    </div>
                </div>


                {{-- 
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Berdasarkan Jenis</h5>
                            <!-- Bar Chart -->
                            <div id="barChart"></div>

                            <script>
                                document.addEventListener("DOMContentLoaded", () => {
                                    new ApexCharts(document.querySelector("#barChart"), {
                                        series: [{
                                            data: [
                                                @foreach ($data_count as $dtc)
                                                    '{{ $dtc->total_data }}',
                                                @endforeach
                                            ]
                                        }],
                                        chart: {
                                            type: 'bar',
                                            height: 200
                                        },
                                        plotOptions: {
                                            bar: {
                                                borderRadius: 4,
                                                horizontal: true,
                                            }
                                        },
                                        dataLabels: {
                                            enabled: false
                                        },
                                        xaxis: {
                                            categories: [
                                                @foreach ($data_count as $dtc)
                                                    '{{ $dtc->nama_jenis }}',
                                                @endforeach
                                            ],
                                        }
                                    }).render();
                                });
                            </script>
                            <!-- End Bar Chart -->

                        </div>
                    </div>
                </div> --}}

                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Berdasarkan Tahun</h5>

                            <!-- Column Chart -->
                            <div id="columnChart"></div>

                            <script>
                                document.addEventListener("DOMContentLoaded", () => {
                                    new ApexCharts(document.querySelector("#columnChart"), {
                                        series: [{
                                            name: 'Jumlah',
                                            data: [
                                                @foreach ($data_count_kode_jenis as $dtc)
                                                    '{{ $dtc->total_data }}',
                                                @endforeach
                                            ]
                                        }],
                                        chart: {
                                            type: 'bar',
                                            height: 200
                                        },
                                        plotOptions: {
                                            bar: {
                                                horizontal: false,
                                                columnWidth: '55%',
                                                endingShape: 'rounded'
                                            },
                                        },
                                        dataLabels: {
                                            enabled: false
                                        },
                                        stroke: {
                                            show: true,
                                            width: 2,
                                            colors: ['transparent']
                                        },
                                        xaxis: {
                                            categories: [
                                                @foreach ($data_count_kode_jenis as $dtc)
                                                    '{{ $dtc->tahun }}',
                                                @endforeach
                                            ],
                                        },
                                        yaxis: {
                                            title: {
                                                text: 'Jumlah Perangkat'
                                            }
                                        },
                                        fill: {
                                            opacity: 1
                                        },
                                        tooltip: {
                                            y: {
                                                formatter: function(val) {
                                                    return val + "  Perangkat"
                                                }
                                            }
                                        }
                                    }).render();
                                });
                            </script>
                            <!-- End Column Chart -->

                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Berdasarkan Lokasi</h5>

                            <!-- Pie Chart -->
                            <div id="pieChart"></div>

                            <script>
                                document.addEventListener("DOMContentLoaded", () => {
                                    new ApexCharts(document.querySelector("#pieChart"), {
                                        series: [
                                            @foreach ($data_count_lokasi as $dtl)
                                                {{ $dtl->total_data }},
                                            @endforeach
                                        ],
                                        chart: {
                                            height: 212,
                                            type: 'pie',
                                            toolbar: {
                                                show: true
                                            }
                                        },
                                        labels: [
                                            @foreach ($data_count_lokasi as $dtl)
                                                '{{ $dtl->nama_lokasi }}',
                                            @endforeach
                                        ]
                                    }).render();
                                });
                            </script>
                            <!-- End Pie Chart -->

                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Berdasarkan Unit</h5>
                            <!-- Bar Chart -->
                            <div id="barChartContainer" style="overflow-y: scroll; height: 215px;">
                                <!-- Batas tinggi tetap untuk scroll vertikal -->
                                <div id="barChartunit" style="height: 100%;"></div>
                            </div>

                            <script>
                                document.addEventListener("DOMContentLoaded", () => {
                                    new ApexCharts(document.querySelector("#barChartunit"), {
                                        series: [{
                                            data: [
                                                @foreach ($data_count_unit as $dtc)
                                                    '{{ $dtc->total_data }}',
                                                @endforeach
                                            ]
                                        }],
                                        chart: {
                                            type: 'bar',
                                            height: {{ count($data_count) * 50 }}, // Atur tinggi berdasarkan jumlah data
                                        },
                                        plotOptions: {
                                            bar: {
                                                borderRadius: 4,
                                                horizontal: true,
                                                barHeight: '60%' // Menyesuaikan tinggi batang
                                            }
                                        },
                                        dataLabels: {
                                            enabled: false
                                        },
                                        xaxis: {
                                            categories: [
                                                @foreach ($data_count_unit as $dtc)
                                                    '{{ $dtc->nama_unit }}',
                                                @endforeach
                                            ],
                                        }
                                    }).render();
                                });
                            </script>
                            <!-- End Bar Chart -->

                        </div>
                    </div>
                </div>




            </div>
        </section>
    @endsection
