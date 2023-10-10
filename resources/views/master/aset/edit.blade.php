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
                                    <a href="{{ route('dashboard.aset.index') }}" class="btn btn-warning">Kembali</a>
                                </div>
                                <hr>

                                @include('components.flash_messages')

                                <form class="row g-3 needs-validation myForm" method="POST"
                                    action="{{ route('dashboard.aset.update', $data->id) }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="col-md-4">
                                        <label class="form-label">Nama Aset</label>
                                        <input type="text" class="form-control" name="nama" value="{{ $data->nama }}">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">Harga</label>
                                        <input type="number" class="form-control" name="harga" value="{{ $data->harga }}">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">Harga Instansi</label>
                                        <input type="number" class="form-control" name="harga_instansi" value="{{ $data->harga_instansi }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Letak</label>
                                        <input type="text" class="form-control" name="letak" value="{{ $data->letak }}">
                                    </div>
                                    <!-- end col -->
                                    <div class="col-md-4">
                                        <label class="form-label">Asal</label>
                                        <input type="text" class="form-control" name="asal" value="{{ $data->asal }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Penemu</label>
                                        <input type="text" class="form-control" name="penemu" value="{{ $data->penemu }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Status</label>
                                        <input type="text" class="form-control" name="status" value="{{ $data->status }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Kondisi</label>
                                        <input type="text" class="form-control" name="kondisi" value="{{ $data->kondisi }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Nama Guide</label>
                                        <input type="text" class="form-control" name="nama_guide" value="{{ $data->nama_guide }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Kecamatan</label>
                                        <select name="kecamatan_id" id="kecamatan_id" class="form-control">
                                            <option value="">Silahkan Pilih</option>
                                            @foreach ($kecamatans as $item)
                                                <option value="{{ $item->id }}" {{ $item->id == $data->kecamatan_id ? 'selected' : '' }}>{{ $item->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label>Koordinat Lokasi</label>
                                            <div id="gmap"  style="height: 300px;"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label>Latitude</label>
                                                    <input type="text" class="form-control" name="latitude" value="{{ $data->latitude }}"
                                                        id="latitude">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label>Longitude</label>
                                                    <input type="text" class="form-control" name="longitude" value="{{ $data->longitude }}"
                                                        id="longitude">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            @if ($data->dokumen_aset)
                                                <img src="{{ MyHelper::get_avatar($data->dokumen_aset) }}" alt="" style="width: 200px;">
                                                <br><br>
                                            @endif
                                            <label>Lampiran/Dokumentasi</label>
                                            <input type="file" class="form-control" name="dokumen_aset">
                                            <small class="text-muted">Upload jika ingin memperbarui</small>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            @if ($data->foto1)
                                                <img src="{{ MyHelper::get_avatar($data->foto1) }}" alt="" style="width: 200px;">
                                                <br><br>
                                            @endif
                                            <label>Foto 1</label>
                                            <input type="file" class="form-control" name="foto1">
                                            <small class="text-muted">Upload jika ingin memperbarui</small>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            @if ($data->foto2)
                                                <img src="{{ MyHelper::get_avatar($data->foto2) }}" alt="" style="width: 200px;">
                                                <br><br>
                                            @endif
                                            <label>Foto 2</label>
                                            <input type="file" class="form-control" name="foto2">
                                            <small class="text-muted">Upload jika ingin memperbarui</small>
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
    <script src="https://maps.googleapis.com/maps/api/js?libraries=places&key={{ env('GMAP_API_KEY') }}&callback=initMap">
    </script>

    @include('components.script_coordinate')

    <script>
        latitude = {{ $data->latitude }}
        longitude = {{ $data->longitude }}
    </script>

    <script>
        var input = dokumen_asetument.getElementById('searchTextField');
        var autocomplete = new google.maps.places.Autocomplete(input);
        google.maps.event.addListener(autocomplete, 'place_changed', function() {
            var place = autocomplete.getPlace();
            dokumen_asetument.getElementById('latitude').value = place.geometry.location.lat();
            dokumen_asetument.getElementById('longitude').value = place.geometry.location.lng();
            var lat = place.geometry.location.lat();
            var lng = place.geometry.location.lng();
            var latLong = new google.maps.LatLng(lat, lng);
            map.setCenter(latLong);

        });
    </script>
@endpush
