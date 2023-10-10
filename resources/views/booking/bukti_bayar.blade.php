@extends('layouts.app')
@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

                                <div class="d-flex justify-content-between">
                                    <h4 class="card-title">{{ $title }}</h4>
                                    <a href="{{ route('dashboard.booking.index') }}" class="btn btn-warning">Kembali</a>
                                </div>
                                <hr>

                                @include('components.flash_messages')

                                <form class="row g-3 needs-validation myForm" method="POST"
                                    action="{{ route('dashboard.booking.bukti_bayar_store', $data->id) }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="col-md-12">
                                        @if ($data->bukti_bayar)
                                            <br>
                                            <img src="{{ MyHelper::get_avatar($data->bukti_bayar) }}" alt="" style="width: 200px;">
                                            <br><br>
                                        @endif

                                        @if (Auth::user()->role == 'pengunjung')
                                            <label class="form-label">Upload Bukti Bayar</label>
                                            <input type="file" class="form-control" name="bukti_bayar">
                                        @endif
                                    </div>
                                    <!-- end col -->
                                    @if (Auth::user()->role == 'pengunjung')
                                    <div class="col-12">
                                        <button class="btn btn-primary formSubmitter" type="submit">Simpan</button>
                                    </div>
                                    @endif
                                    <!-- end col -->
                                </form>
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
