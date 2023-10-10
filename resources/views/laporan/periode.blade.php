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
                                                    <option value="{{ $item->id }}" {{ ($skpd->id ?? null) == $item->id ? 'selected' : '' }}>{{ $item->nama_skpd }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Cari</button>
                                        <a href="{{ route('dashboard.laporan.periode') }}" class="btn btn-danger">Reset</a>
                                    </div>
                                </form>
                                <h4 class="text-center">{{ $title }}</h4>
                                <hr>
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <tr>
                                            <td>#</td>
                                            <td>Nama Pengunjung</td>
                                            <td>Status Pengunjung</td>
                                            <td>No. Tiket</td>
                                            <td>Jml Orang</td>
                                            <td>Nama Aset</td>
                                            <td>Tgl & Jam</td>
                                            <td>Status</td>
                                            <td>Komplen</td>
                                        </tr>
                                        @if ($data)
                                            @foreach ($data as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item->user->name }}</td>
                                                    <td>{{ $item->user->status_pengunjung }}</td>
                                                    <td>{{ $item->no_tiket }}</td>
                                                    <td>{{ $item->jml_orang }}</td>
                                                    <td>{{ $item->asset->nama }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($item->created_at)->locale('id_ID')->isoFormat('LLL') }}</td>
                                                    <td>{!! MyHelper::getStatus($item) !!}</td>
                                                    <td>
                                                        {{ $item->komplen }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="11" class="text-center">Tidak ada Data, Silahkan Periode</td>
                                            </tr>
                                        @endif
                                    </table>
                                </div>

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
@endpush
