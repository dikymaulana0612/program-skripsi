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
                                    <a href="{{ route('dashboard.user.index') }}" class="btn btn-warning">Kembali</a>
                                </div>
                                <hr>

                                @include('components.flash_messages')

                                <form class="row g-4 needs-validation myForm" method="POST"
                                    action="{{ route('dashboard.user.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row mt-4">
                                        <div class="form-group mb-3 col-md-8">
                                            <label class="form-label">Nama</label>
                                            <span class="desc"></span>
                                            <div class="controls">
                                                <input type="text" class="form-control" name="name"
                                                    value="{{ old('name') }}" autofocus>
                                            </div>
                                        </div>
                                        <div class="form-group mb-3 col-md-4">
                                            <label class="form-label">Email <span class="text-danger">*</span></label>
                                            <span class="desc"></span>
                                            <div class="controls">
                                                <input type="email" class="form-control" name="email"
                                                    value="{{ old('email') }}">
                                            </div>
                                        </div>
                                        <div class="form-group mb-3 col-md-3">
                                            <label class="form-label">Password</label>
                                            <span class="desc"></span>
                                            <div class="controls">
                                                <input type="password" class="form-control" name="password">
                                            </div>
                                        </div>
                                        <div class="form-group mb-3 col-md-2">
                                            <label class="form-label">Role / Peran</label>
                                            <span class="desc"></span>
                                            <select name="role" id="role" class="form-control">
                                                @foreach (config('roles') as $key => $value)
                                                    <option value="{{ $key }}">{{ $value }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3 col-md-3 div_pengelola" style="display: none">
                                            <label class="form-label">Penanggung Jawab</label>
                                            <input type="text" class="form-control" id="penanggung_jawab"
                                                name="penanggung_jawab" value="{{ old('penanggung_jawab') }}"
                                                placeholder="Masukkan penanggung jawab">
                                        </div>
                                        <div class="form-group mb-3 col-md-3 div_status_pengunjung" style="display: none">
                                            <label class="form-label">Nama Instansi</label>
                                            <input type="text" class="form-control" id="instansi" name="instansi"
                                                value="{{ old('instansi') }}" placeholder="Masukkan instansi">
                                        </div>
                                        <div class="form-group mb-3 col-md-3 div_status_pengunjung" style="display: none">
                                            <label class="form-label">Asal</label>
                                            <input type="text" class="form-control" id="asal" name="asal"
                                                value="{{ old('>asal') }}" placeholder="Masukkan asal">
                                        </div>
                                        <div class="form-group mb-3 col-md-3 div_status_pengunjung" style="display: none">
                                            <label class="form-label">Status Pengunjung</label>
                                            <span class="desc"></span>
                                            <select name="status_pengunjung" id="status_pengunjung" class="form-control">
                                                @foreach (config('status_pengunjung') as $item)
                                                    <option value="{{ $item }}">{{ $item }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group mb-3 col-md-3">
                                            <label class="form-label">Alamat</label>
                                            <span class="desc"></span>
                                            <div class="controls">
                                                <input type="text" class="form-control" name="alamat"
                                                    value="{{ old('alamat') }}">
                                            </div>
                                        </div>
                                        <div class="form-group mb-3 col-md-2">
                                            <label class="form-label">Status Aktif</label>
                                            <span class="desc"></span>
                                            <select name="is_aktif" id="is_aktif" class="form-control">
                                                <option value="1">Aktif</option>
                                                <option value="0">Tidak Aktif</option>
                                            </select>
                                        </div>
                                        <div class="form-group mb-3 col-md-3 div_pengelola" style="display: none">
                                            <label class="form-label">Dokumen Aset</label>
                                            <span class="desc"></span>
                                            <div class="controls">
                                                <input type="file" class="form-control" name="dokumen">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- end col -->
                                    <div class="col-12">
                                        <button class="btn btn-primary formSubmitter" type="submit">Simpan</button>
                                    </div>
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
