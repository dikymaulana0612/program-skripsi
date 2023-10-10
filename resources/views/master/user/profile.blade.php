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
                                </div>
                                <hr>

                                @include('components.flash_messages')

                                <form class="row g-3 needs-validation myForm" method="POST"
                                    action="{{ route('dashboard.user.profile_update', $data->id) }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row mt-4">
                                        <div class="form-group mb-3 col-md-8">
                                            <label class="form-label">Nama</label>
                                            <span class="desc"></span>
                                            <div class="controls">
                                                <input type="text" class="form-control" name="name"
                                                    value="{{ $data->name }}" autofocus>
                                            </div>
                                        </div>
                                        <div class="form-group mb-3 col-md-4">
                                            <label class="form-label">Email <span class="text-danger">*</span></label>
                                            <span class="desc"></span>
                                            <div class="controls">
                                                <input type="email" class="form-control" name="email"
                                                    value="{{ $data->email }}">
                                            </div>
                                        </div>
                                        <div class="form-group mb-3 col-md-3">
                                            <label class="form-label">Password</label>
                                            <span class="desc"></span>
                                            <div class="controls">
                                                <input type="password" class="form-control" name="password">
                                            </div>
                                            <small class="text-muted">Kosongkan jika tidak ingin diupdate</small>
                                        </div>
                                        <div class="form-group mb-3 col-md-2">
                                            <label class="form-label">Role / Peran</label>
                                            <span class="desc"></span>
                                            <br>
                                            <div class="badge bg-info"><b>{{ Auth::user()->role }}</b></div>
                                        </div>
                                        <div class="mb-3 col-md-3 div_pengelola" style="display: {{ $data->role == 'pengelola' ? 'block' : 'none' }}">
                                            <label class="form-label">Penanggung Jawab</label>
                                            <input type="text" class="form-control" id="penanggung_jawab"
                                                name="penanggung_jawab" value="{{ $data->penanggung_jawab }}"
                                                placeholder="Masukkan penanggung jawab">
                                        </div>
                                        <div class="form-group mb-3 col-md-3 div_status_pengunjung" style="display: {{ $data->role == 'pengunjung' ? 'block' : 'none' }}">
                                            <label class="form-label">Nama Instansi</label>
                                            <input type="text" class="form-control" id="instansi" name="instansi"
                                                value="{{ $data->instansi }}" placeholder="Masukkan instansi">
                                        </div>
                                        <div class="form-group mb-3 col-md-3 div_status_pengunjung" style="display: {{ $data->role == 'pengunjung' ? 'block' : 'none' }}">
                                            <label class="form-label">Asal</label>
                                            <input type="text" class="form-control" id="asal" name="asal"
                                                value="{{ $data->asal }}" placeholder="Masukkan asal">
                                        </div>
                                        <div class="form-group mb-3 col-md-3 div_status_pengunjung" style="display: {{ $data->role == 'pengunjung' ? 'block' : 'none' }}">
                                            <label class="form-label">Status Pengunjung</label>
                                            <span class="desc"></span>
                                            <select name="status_pengunjung" id="status_pengunjung" class="form-control">
                                                @foreach (config('status_pengunjung') as $item)
                                                    <option value="{{ $item }}" {{ $data->status_pengunjung == $item ? 'selected' : '' }}>{{ $item }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group mb-3 col-md-3">
                                            <label class="form-label">Alamat</label>
                                            <span class="desc"></span>
                                            <div class="controls">
                                                <input type="text" class="form-control" name="alamat"
                                                    value="{{ $data->alamat }}">
                                            </div>
                                        </div>
                                        @if (Auth::user()->role == 'pengelola')
                                            <div class="form-group mb-3 col-md-2">
                                                <label class="form-label">Status Aktif</label>
                                                <span class="desc"></span>
                                                <br>
                                                <div class="badge bg-{{ $data->is_aktif == 1 ? 'success' : 'danger' }}"><b>{{ $data->is_aktif == 1 ? 'Aktif' : 'Tidak Aktif' }}</b></div>
                                            </div>
                                        @endif

                                        @if (Auth::user()->role == 'pengelola')
                                            <div class="form-group mb-3 col-md-3 div_pengelola" style="display: {{ $data->role == 'pengelola' ? 'block' : 'none' }}">
                                                <label class="form-label">Dokumen Aset</label>
                                                @if ($data->dokumen)
                                                    <br>
                                                    <a href="{{ url(Storage::url($data->dokumen)) }}">Lihat Dokumen</a>
                                                    <br><br>
                                                @endif
                                                <span class="desc"></span>
                                                <div class="controls">
                                                    <input type="file" class="form-control" name="dokumen">
                                                </div>
                                            </div>

                                        @endif
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
    <script src="https://maps.googleapis.com/maps/api/js?libraries=places&key={{ env('GMAP_API_KEY') }}&callback=initMap">
    </script>

    @include('components.script_coordinate')

    <script>
        latitude = {{ $data->latitude }}
        longitude = {{ $data->longitude }}
    </script>

    <script>
        var input = document.getElementById('searchTextField');
        var autocomplete = new google.maps.places.Autocomplete(input);
        google.maps.event.addListener(autocomplete, 'place_changed', function() {
            var place = autocomplete.getPlace();
            document.getElementById('latitude').value = place.geometry.location.lat();
            document.getElementById('longitude').value = place.geometry.location.lng();
            var lat = place.geometry.location.lat();
            var lng = place.geometry.location.lng();
            var latLong = new google.maps.LatLng(lat, lng);
            map.setCenter(latLong);

        });
    </script>
@endpush
