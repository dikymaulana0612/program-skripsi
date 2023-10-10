@extends('layouts.app')
@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">


                <div class="row">
                    <div class="col">

                        <div class="h-100">
                            <div class="row">
                                <div class="col-xl-12">
                                    <!-- card -->
                                    <div class="card bg-info-subtle text-info border-0">
                                        <div class="card-body">
                                            <div class="row gy-3">
                                                <div class="col-sm">
                                                    <h5 class="card-title fs-17">Selamat Datang {{ Auth::user()->name }}</h5>
                                                    <p class="mb-0">Di Aplikasi {{ env('APP_NAME') }}</p>
                                                </div>
                                                <div class="col-sm-auto">

                                                </div>
                                            </div>
                                            <div class="position-absolute top-0 start-50 mt-2 opacity-25">
                                                <i class="bi bi-shop display-4"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end card -->
                                </div>
                                <!-- end col -->

                                @if (Auth::user()->role == 'pengelola')
                                <div class="col-md-6">
                                    <!-- card -->
                                    <div class="card card-animate">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between">
                                                <div class="flex-grow-1">
                                                    <p class="text-uppercase fw-medium text-muted text-truncate fs-13">
                                                        Lunas</p>
                                                    <h4 class="fs-22 fw-semibold mb-3">{{ $lunas }}</h4>

                                                </div>
                                                <div class="avatar-sm flex-shrink-0">
                                                    <span class="avatar-title bg-success-subtle rounded fs-3">
                                                        <i class="bx bx-user text-success"></i>
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
                                <div class="col-md-6">
                                    <!-- card -->
                                    <div class="card card-animate">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between">
                                                <div class="flex-grow-1">
                                                    <p class="text-uppercase fw-medium text-muted text-truncate fs-13">
                                                        Belum Lunas</p>
                                                    <h4 class="fs-22 fw-semibold mb-3">{{ $belum_lunas }}</h4>

                                                </div>
                                                <div class="avatar-sm flex-shrink-0">
                                                    <span class="avatar-title bg-danger-subtle rounded fs-3">
                                                        <i class="bx bx-user text-danger"></i>
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
                                @else
                                    <div class="col-md-6">
                                        <!-- card -->
                                        <div class="card card-animate">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between">
                                                    <div class="flex-grow-1">
                                                        <p class="text-uppercase fw-medium text-muted text-truncate fs-13">
                                                            Pengelola Aktif</p>
                                                        <h4 class="fs-22 fw-semibold mb-3">{{ $pengelola_aktif }}</h4>

                                                    </div>
                                                    <div class="avatar-sm flex-shrink-0">
                                                        <span class="avatar-title bg-success-subtle rounded fs-3">
                                                            <i class="bx bx-user text-success"></i>
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
                                    <div class="col-md-6">
                                        <!-- card -->
                                        <div class="card card-animate">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between">
                                                    <div class="flex-grow-1">
                                                        <p class="text-uppercase fw-medium text-muted text-truncate fs-13">
                                                            Pengelola Tidak Aktif</p>
                                                        <h4 class="fs-22 fw-semibold mb-3">{{ $pengelola_tidak_aktif }}</h4>

                                                    </div>
                                                    <div class="avatar-sm flex-shrink-0">
                                                        <span class="avatar-title bg-danger-subtle rounded fs-3">
                                                            <i class="bx bx-user text-danger"></i>
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
                                @endif

                                <div class="col-xl-12">
                                    <div class="card">
                                        <div class="card-header align-items-center d-flex">
                                            <h4 class="card-title mb-0 flex-grow-1">Highlight Pengunjung</h4>

                                        </div><!-- end card header -->

                                        <div class="card-body row">
                                            <div class="col-md-4">
                                                <!-- card -->
                                                <div class="card card-animate">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between">
                                                            <div class="flex-grow-1">
                                                                <p
                                                                    class="text-uppercase fw-medium text-muted text-truncate fs-13">
                                                                    Harian</p>
                                                                <h4 class="fs-22 fw-semibold mb-3">{{ $harian }}</h4>

                                                            </div>
                                                            <div class="avatar-sm flex-shrink-0">
                                                                <span class="avatar-title bg-primary-subtle rounded fs-3">
                                                                    <i class="bx bx-user text-primary"></i>
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
                                                                    Bulanan</p>
                                                                <h4 class="fs-22 fw-semibold mb-3">{{ $bulanan }}</h4>

                                                            </div>
                                                            <div class="avatar-sm flex-shrink-0">
                                                                <span class="avatar-title bg-primary-subtle rounded fs-3">
                                                                    <i class="bx bx-user text-primary"></i>
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
                                                                    Tahunan</p>
                                                                <h4 class="fs-22 fw-semibold mb-3">{{ $tahunan }}</h4>

                                                            </div>
                                                            <div class="avatar-sm flex-shrink-0">
                                                                <span class="avatar-title bg-primary-subtle rounded fs-3">
                                                                    <i class="bx bx-user text-primary"></i>
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end .h-100-->
                    </div> <!-- end col -->
                </div>
            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->


        @include('components.footer')
    </div>
@endsection
