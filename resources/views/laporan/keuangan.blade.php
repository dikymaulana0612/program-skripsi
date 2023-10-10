@extends('layouts.app')

@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">
                <!-- start page title -->
                <div class="page-title-box">
                    <div class="d-flex justify-content-between">
                        <div class="">
                            <h4 class="page-title">{{ $title }}</h4>
                        </div>

                    </div>
                </div>
                <!-- end page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                @include('components.flash_messages')
                                <form action="" method="GET" class="d-flex align-items-end gap-2 mb-3 no-print">
                                    <div class="form-group">
                                        <label>Dari</label>
                                        <input type="date" class="form-control" name="date_from"
                                            value="{{ $date_from }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Sampai</label>
                                        <input type="date" class="form-control" name="date_to"
                                            value="{{ $date_to }}">
                                    </div>

                                    @if (Auth::user()->role == 'super_admin')
                                        <div class="form-group">
                                            <label>SKPD</label>
                                            <select name="skpd_id" id="skpd_id" class="form-control select2"
                                                style="width: 100%">
                                                <option value="">Semua SKPD</option>
                                                @foreach ($skpds as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ ($skpd->id ?? null) == $item->id ? 'selected' : '' }}>
                                                        {{ $item->nama_skpd }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Cari</button>
                                        <a href="{{ route('dashboard.laporan.keuangan') }}" class="btn btn-danger">Reset</a>
                                    </div>
                                </form>
                                <h4 class="text-center">{{ $title }}</h4>
                                <hr>
                                @if ($data)
                                    <div class="card-body row">
                                        <div class="col-md-12 mb-3">
                                            <canvas id="pieKeuangan" height="60"></canvas>
                                        </div>
                                        <div class="col-md-4">
                                            <!-- card -->
                                            <div class="card card-animate">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between">
                                                        <div class="flex-grow-1">
                                                            <p
                                                                class="text-uppercase fw-medium text-muted text-truncate fs-13">
                                                                Jml Booking</p>
                                                            <h4 class="fs-22 fw-semibold mb-3">{{ $data['jml_booking'] }}</h4>

                                                        </div>
                                                        <div class="avatar-sm flex-shrink-0">
                                                            <span class="avatar-title bg-primary-subtle rounded fs-3">
                                                                <i class="bx bx-book text-primary"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div><!-- end card body -->
                                                <div class="animation-effect-6 text-primary opacity-25 fs-18">
                                                    <i class="bi bi-currency-dollar"></i>
                                                </div>
                                                <div class="animation-effect-4 text-primary opacity-25 fs-18">
                                                    <i class="bi bi-currency-pound"></i>
                                                </div>
                                                <div class="animation-effect-3 text-primary opacity-25 fs-18">
                                                    <i class="bi bi-currency-euro"></i>
                                                </div>
                                            </div><!-- end card -->
                                        </div>
                                        <div class="col-md-4">
                                            <!-- card -->
                                            <div class="card card-animate">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between">
                                                        <div class="flex-grow-1">
                                                            <p
                                                                class="text-uppercase fw-medium text-muted text-truncate fs-13">
                                                                Lunas</p>
                                                            <h4 class="fs-22 fw-semibold mb-3">{{ $data['lunas'] }}</h4>

                                                        </div>
                                                        <div class="avatar-sm flex-shrink-0">
                                                            <span class="avatar-title bg-success-subtle rounded fs-3">
                                                                <i class="bx bx-check text-success"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div><!-- end card body -->
                                                <div class="animation-effect-6 text-success opacity-25 fs-18">
                                                    <i class="bi bi-currency-dollar"></i>
                                                </div>
                                                <div class="animation-effect-4 text-success opacity-25 fs-18">
                                                    <i class="bi bi-currency-pound"></i>
                                                </div>
                                                <div class="animation-effect-3 text-success opacity-25 fs-18">
                                                    <i class="bi bi-currency-euro"></i>
                                                </div>
                                            </div><!-- end card -->
                                        </div>
                                        <div class="col-md-4">
                                            <!-- card -->
                                            <div class="card card-animate">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between">
                                                        <div class="flex-grow-1">
                                                            <p
                                                                class="text-uppercase fw-medium text-muted text-truncate fs-13">
                                                                Belum Lunas</p>
                                                            <h4 class="fs-22 fw-semibold mb-3">{{ $data['belum_lunas'] }}</h4>

                                                        </div>
                                                        <div class="avatar-sm flex-shrink-0">
                                                            <span class="avatar-title bg-danger-subtle rounded fs-3">
                                                                <i class="bx bx-time text-danger"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div><!-- end card body -->
                                                <div class="animation-effect-6 text-danger opacity-25 fs-18">
                                                    <i class="bi bi-currency-dollar"></i>
                                                </div>
                                                <div class="animation-effect-4 text-danger opacity-25 fs-18">
                                                    <i class="bi bi-currency-pound"></i>
                                                </div>
                                                <div class="animation-effect-3 text-danger opacity-25 fs-18">
                                                    <i class="bi bi-currency-euro"></i>
                                                </div>
                                            </div><!-- end card -->
                                        </div>
                                    </div>
                                @else
                                    <div class="text-center">Silahkan filter periode terlebih dahulu</div>
                                @endif

                                <div class="col-md-12">
                                    <div class="text-right">
                                        <button class="btn btn-primary btn-sm no-print" onclick="window.print()">Cetak
                                            Laporan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->
            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
        @include('components.footer')
    </div>
@endsection

@push('js')
    <script src="{{ asset('hybrix') }}/assets/libs/chart.js/Chart.bundle.min.js"></script>

    @if ($data)
        <script>
            const data = {
                labels: [
                    'Lunas', 'Belum Lunas'
                ],
                datasets: [{
                    label: 'Grafik Keuangan',
                    data: [
                        {{ $data['lunas'] }}, {{ $data['belum_lunas'] }}
                    ],
                    backgroundColor: [
                        'rgb( 99, 199, 123)',
                        'rgb( 237, 116, 113)',
                    ],
                    hoverOffset: 4
                }]
            };

            const pieKeuangan = document.getElementById('pieKeuangan');

            new Chart(pieKeuangan, {
                type: 'pie',
                data: data
            });
        </script>
    @endif
@endpush
