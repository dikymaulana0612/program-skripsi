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

                                <form class="row g-4 needs-validation myForm" method="POST"
                                    action="{{ route('dashboard.aset.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-md-4">
                                        <label class="form-label">Nama Aset</label>
                                        <input type="text" class="form-control" name="nama" value="{{ old('nama') }}">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">Harga Umum</label>
                                        <input type="number" class="form-control" name="harga" value="{{ old('harga') }}">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">Harga Instansi</label>
                                        <input type="number" class="form-control" name="harga_instansi" value="{{ old('harga_instansi') }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Letak</label>
                                        <input type="text" class="form-control" name="letak" value="{{ old('letak') }}">
                                    </div>
                                    <!-- end col -->
                                    <div class="col-md-4">
                                        <label class="form-label">Asal</label>
                                        <input type="text" class="form-control" name="asal" value="{{ old('asal') }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Penemu</label>
                                        <input type="text" class="form-control" name="penemu" value="{{ old('penemu') }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Status</label>
                                        <input type="text" class="form-control" name="status" value="{{ old('status') }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Kondisi</label>
                                        <input type="text" class="form-control" name="kondisi" value="{{ old('kondisi') }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Nama Guide</label>
                                        <input type="text" class="form-control" name="nama_guide" value="{{ old('nama_guide') }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Kecamatan</label>
                                        <select name="kecamatan_id" id="kecamatan_id" class="form-control">
                                            <option value="">Silahkan Pilih</option>
                                            @foreach ($kecamatans as $item)
                                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label>Koordinat Lokasi</label>
                                            <div id="gmap"  style="height: 450px;"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label>Latitude</label>
                                                    <input type="text" class="form-control" name="latitude" value="{{ old('latitude') }}"
                                                        id="latitude">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label>Longitude</label>
                                                    <input type="text" class="form-control" name="longitude" value="{{ old('longitude') }}"
                                                        id="longitude">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label>Lampiran/Dokumentasi</label>
                                            <input type="file" class="form-control" name="dokumen_aset">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label>Foto 1</label>
                                            <input type="file" class="form-control" name="foto1">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label>Foto 2</label>
                                            <input type="file" class="form-control" name="foto2">
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
