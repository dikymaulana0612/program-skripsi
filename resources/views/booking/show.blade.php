@extends('layouts.app')
@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">{{ $title }}</h4>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row justify-content-center">
                    <div class="col-xxl-9">
                        <div class="hstack gap-2 justify-content-end d-print-none mb-4">
                            <a href="javascript:window.print()" class="btn btn-success"><i
                                    class="ri-printer-line align-bottom me-1"></i> Print</a>
                            <a href="{{ route('dashboard.booking.index') }}" class="btn btn-warning"> Kembali</a>
                        </div>
                        <div class="card overflow-hidden" id="invoice">
                            <div class="invoice-effect-top position-absolute start-0">
                                <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 764 182" width="764"
                                    height="182">
                                    <title>&lt;Group&gt;</title>
                                    <g id="&lt;Group&gt;">
                                        <g id="&lt;Group&gt;">
                                            <path id="&lt;Path&gt;" style="fill: var(--tb-light);"
                                                d="m-6.6 177.4c17.5 0.1 35.1 0 52.8-0.4 286.8-6.6 537.6-77.8 700.3-184.6h-753.1z" />
                                        </g>
                                        <g id="&lt;Group&gt;">
                                            <path id="&lt;Path&gt;" style="fill: var(--tb-secondary);"
                                                d="m-6.6 132.8c43.5 2.1 87.9 2.7 132.9 1.7 246.9-5.6 467.1-59.2 627.4-142.1h-760.3z" />
                                        </g>
                                        <g id="&lt;Group&gt;" style="opacity: .5">
                                            <path id="&lt;Path&gt;" style="fill: var(--tb-primary);"
                                                d="m-6.6 87.2c73.2 7.4 149.3 10.6 227.3 8.8 206.2-4.7 393.8-42.8 543.5-103.6h-770.8z" />
                                        </g>
                                    </g>
                                </svg>
                            </div>
                            <div class="card-body z-1 position-relative">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <img src="{{ asset('img/fav.png') }}" class="card-logo" alt="logo light" style="width: 100px;">
                                    </div>

                                </div>
                                <div class="mt-5 pt-4">
                                    <div class="row g-3">
                                        <div class="col-lg col-6">
                                            <p class="text-muted mb-2 text-uppercase">No Tiket</p>
                                            <h5 class="fs-md mb-1">#<span id="invoice-no">{{ $data->no_tiket }}</span></h5>
                                            {!! QrCode::size(120)->generate($data->no_tiket); !!}
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg col-6">
                                            <p class="text-muted mb-2 text-uppercase">Tgl Jam</p>
                                            <h5 class="fs-md mb-0"><span id="invoice-date">{{ $data->jadwal_aset->tgl_jam_fixed }}</span></h5>
                                        </div>
                                        <div class="col-lg col-6">
                                            <p class="text-muted mb-2 text-uppercase">Nama Guide</p>
                                            <h5 class="fs-md mb-0"><span id="invoice-date">{{ $data->asset->nama_guide }}</span></h5>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg col-6">
                                            <p class="text-muted mb-2 text-uppercase">Status</p>
                                            {!! MyHelper::getStatus($data) !!}

                                            @if (in_array(Auth::user()->role, ['admin', 'pengelola']))
                                                @if ($data->status == 'pending')
                                                    <form action="{{ route('dashboard.booking.set_paid', $data->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <button class="btn btn-sm btn-primary mt-3" onclick="return confirm('Yakin set lunas?')">Set Lunas</button>
                                                    </form>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                    <!--end row-->
                                </div>
                                <div class="mt-4 pt-2">
                                    <div class="row g-3">
                                        <div class="col-6">
                                            <p class="text-muted text-uppercase">Informasi Pengunjung</p>
                                            <h6 class="fs-md" id="billing-name">{{ $data->user->name }}</h6>
                                            <p class="text-muted mb-1" id="billing-address-line-1">{{ $data->user->alamat }}</p>
                                            <p class="text-muted mb-1"><span>Email: {{ $data->user->email }}</span></p>
                                        </div>
                                        <!--end col-->
                                    </div>
                                    <!--end row-->
                                </div>
                                <div class="table-responsive mt-4">
                                    <table class="table table-borderless text-center table-nowrap align-middle mb-0">
                                        <thead>
                                            <tr class="table-light">
                                                <th scope="col" style="width: 50px;">#</th>
                                                <th scope="col">Aset</th>
                                                <th scope="col">Jadwal</th>
                                                <th scope="col">Jml Orang</th>
                                                <th scope="col" class="text-end">Harga</th>
                                            </tr>
                                        </thead>
                                        <tbody id="products-list">
                                            <tr>
                                                <th scope="row">01</th>
                                                <td class="text-start">
                                                    <span class="fw-medium">{{ $data->asset->nama }}</span>
                                                </td>
                                                <td>{{ $data->jadwal_aset->tgl_jam_fixed }}</td>
                                                <td>{{ $data->jml_orang }}</td>
                                                <td class="text-end">{{ MyHelper::formatRupiah(MyHelper::getHargaFix($data)) }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <!--end table-->
                                </div>
                                <div class="border-top border-top-dashed mt-2" id="products-list-total">
                                    <table class="table table-borderless table-nowrap align-middle mb-0 ms-auto"
                                        style="width:250px">
                                        <tbody>

                                            <tr class="border-top border-top-dashed fs-15">
                                                <th scope="row">Grand Total</th>
                                                <th class="text-end">{{ MyHelper::formatRupiah(MyHelper::getHargaFix($data) * $data->jml_orang, false) }}</th>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <!--end table-->
                                </div>
                                <div class="mt-3">
                                    <h6 class="text-muted text-uppercase fw-semibold mb-3">Informasi Pembayaran:</h6>
                                    <p class="text-muted mb-1">A.n: <span class="fw-medium"
                                            id="card-holder-name">{{ env('BANK_AN') }}</span></p>
                                    <p class="text-muted mb-1">Bank: <span class="fw-medium"
                                            id="payment-method">{{ env('BANK_NAMA') }}</span></p>
                                    <p class="text-muted mb-1">No Rek: <span class="fw-medium"
                                            id="card-holder-name">{{ env('BANK_NOREK') }}</span></p>
                                </div>

                            </div>
                            <div class="invoice-effect-top position-absolute end-0"
                                style="transform: rotate(180deg); bottom: -80px;">
                                <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 764 182"
                                    width="764" height="182">
                                    <title>&lt;Group&gt;</title>
                                    <g id="&lt;Group&gt;">
                                        <g id="&lt;Group&gt;">
                                            <path id="&lt;Path&gt;" style="fill: var(--tb-light);"
                                                d="m-6.6 177.4c17.5 0.1 35.1 0 52.8-0.4 286.8-6.6 537.6-77.8 700.3-184.6h-753.1z" />
                                        </g>
                                        <g id="&lt;Group&gt;">
                                            <path id="&lt;Path&gt;" style="fill: var(--tb-secondary);"
                                                d="m-6.6 132.8c43.5 2.1 87.9 2.7 132.9 1.7 246.9-5.6 467.1-59.2 627.4-142.1h-760.3z" />
                                        </g>
                                        <g id="&lt;Group&gt;" style="opacity: .5">
                                            <path id="&lt;Path&gt;" style="fill: var(--tb-primary);"
                                                d="m-6.6 87.2c73.2 7.4 149.3 10.6 227.3 8.8 206.2-4.7 393.8-42.8 543.5-103.6h-770.8z" />
                                        </g>
                                    </g>
                                </svg>
                            </div>
                        </div>
                        <!--end card-->
                    </div>
                    <!--end col-->
                </div>

            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        @include('components.footer')
    </div>
@endsection

@push('js')
@endpush
