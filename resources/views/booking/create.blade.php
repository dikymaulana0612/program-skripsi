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
                                    <a href="{{ route('dashboard.gis_aset') }}" class="btn btn-warning">Kembali</a>
                                </div>
                                <hr>

                                @include('components.flash_messages')

                                <form class="row g-3 needs-validation myForm" method="POST"
                                    action="{{ route('dashboard.booking.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="asset_id" value="{{ $aset->id }}">
                                    <div class="col-md-3">
                                        <label class="form-label">Aset</label>
                                        <input type="text" class="form-control disabled" style="background-color: #eee;" name="aset" value="{{ $aset->nama }}" disabled readonly>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Nama Guide</label>
                                        <input type="text" class="form-control disabled" style="background-color: #eee;" name="nama_guide" value="{{ $aset->nama_guide }}" disabled readonly>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Pilih Jadwal</label>
                                        <select name="jadwal_asset_id" id="jadwal_asset_id" class="form-control">
                                            <option value="">Pilih Jadwal</option>
                                            @foreach ($jadwals as $item)
                                                <option value="{{ $item->id }}">{{ $item->tgl_jam_fixed . ' (max pengunjung: '. $item->max_pengunjung .')' }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Jml Orang</label>
                                        <input type="number" class="form-control" name="jml_orang" value="{{ old('jml_orang') }}" required="">
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
