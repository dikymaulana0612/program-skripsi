@extends('layouts.front')

@push('css')
    <style>
        .themap {
            height: 700px !important;
            z-index: 999;
        }
    </style>
@endpush

@section('content')
    <div class="main-content" style="margin-top: -50px;">

        <div class="page-content" style="margin-top: 0px;">
            <div class="container-fluid">
                <div class="row">
                    <form action="" class="row" method="GET">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Pilih Kecamatan</label>
                                <select name="kecamatan_id" id="kecamatan_id" class="form-control">
                                    <option value="">Silahkan Pilih</option>
                                    @foreach ($kecamatans as $item)
                                        <option value="{{ $item->id }}" {{ $item->id == ($kecamatan->id ?? null) ? 'selected' : '' }}>{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Keyword Pencarian</label>
                                <input type="text" name="keyword" class="form-control" value="{{ $keyword ?? '' }}">
                            </div>
                        </div>
                        <div class="col-md-12 mt-4 text-center">
                            <button type="submit" class="btn btn-info">Filter</button>
                        </div>
                    </form>
                    <div class="col-lg-12 mt-3">
                        <div class="card">
                            <div class="card-body">
                                <div id="themap" class="themap" style="height: 100%"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
        @include('components.footer')
    </div>
@endsection

@push('js')
    <script defer
        src="https://maps.googleapis.com/maps/api/js?libraries=places&key={{ env('GMAP_API_KEY') }}&callback=initMap">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/js-marker-clusterer/1.0.0/markerclusterer_compiled.js"></script>

    <script>
        var longitude = {{ env('LONG_DEFAULT') }};
        var latitude = {{ env('LAT_DEFAULT') }};
        $(document).ready(function() {

            var gmarkers1 = [];
            var markers1 = [];
            var infowindow = new google.maps.InfoWindow({
                content: ''
            });

            let data = {
                'kecamatan_id': $('#kecamatan_id').val(),
                'keyword': $('input[name="keyword"]').val(),
            };

            /**
             * Function to init map
             */

            function initialize() {
                var center = new google.maps.LatLng(latitude, longitude);
                var mapOptions = {
                    zoom: 10,
                    center: {
                        lat: {{ env('LAT_DEFAULT') }},
                        lng: {{ env('LONG_DEFAULT') }}
                    },
                    zoomControl: true,
                    mapTypeId: google.maps.MapTypeId.HYBRID
                };

                map = new google.maps.Map(document.getElementById('themap'), mapOptions);
                $('.map-card').addClass('is-loading');
                $.ajax({
                    url: "{{ route('v1.tracking.get_tracking_aset') }}",
                    dataType: 'json',
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: data,
                    success: function(response) {
                        $('.map-card').removeClass('is-loading');
                        markers1 = response.map(el => {
                            return {
                                "id": el['id'],
                                "nama": el['nama'],
                                "harga": el['harga'],
                                "letak": el['letak'],
                                "asal": el['asal'],
                                "penemu": el['penemu'],
                                "status": el['status'],
                                "kondisi": el['kondisi'],
                                "latitude": parseFloat(el['latitude']),
                                "longitude": parseFloat(el['longitude']),
                                "marker_icon": el['marker_icon'],
                                "booking_url": el['booking_url'],
                                "dokumen_aset": el['dokumen_aset'],
                            }
                        });

                        for (i = 0; i < markers1.length; i++) {
                            addMarker(markers1[i]);
                        }
                        var markerCluster = new MarkerClusterer(map, gmarkers1, {
                            imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'
                        });
                    }
                })

            }

            /**
             * Function to add marker to map
             */

            function addMarker(marker) {
                var title = marker["nama"];
                var pos = new google.maps.LatLng(marker["latitude"], marker["longitude"]);

                var content = `<div class="keterangan">
                        <div style="color:black;font-size:16px;font-weight:bold;">${title}</div>
                        <p style="color:black;margin-bottom:2px;">Harga: <span style="color:black"> ${marker.harga} </span></p>
                        <p style="color:black;margin-bottom:2px;">Letak: ${marker.letak}</p>
                        <p style="color:black;margin-bottom:2px;">Asal: ${marker.asal} m</p>
                        <p style="color:black;margin-bottom:2px;">Penemu: ${marker.penemu}</p>
                        <p style="color:black;margin-bottom:2px;">Status : ${marker.status}</p>
                        <p style="color:black;margin-bottom:2px;">Kondisi : ${marker.kondisi}</p>
                        <p style="color:black;margin-bottom:2px;">Dokumentasi:</p>
                        <p></p><img src="${marker.dokumen_aset}" style="width:100px;"></p>
                        <a href="${marker.booking_url}" class="btn btn-sm btn-primary">Detail</a>
                    </div>`;
                var theIcon = `${marker.marker_icon}`;
                var icon = {
                    url: theIcon,
                    scaledSize: new google.maps.Size(20, 20)
                };
                marker1 = new google.maps.Marker({
                    title: title,
                    position: pos,
                    map: map,
                    icon: icon
                });

                gmarkers1.push(marker1);

                // Marker click listener
                google.maps.event.addListener(marker1, 'click', (function(marker1, content) {
                    return function() {
                        infowindow.setContent(content);
                        infowindow.open(map, marker1);
                        map.panTo(this.getPosition());
                    }
                })(marker1, content));
            }
            filterMarkers = function(category) {
                for (i = 0; i < gmarkers1.length; i++) {
                    marker = gmarkers1[i];
                    // If is same category or category not picked
                    if (marker.category == category || category.length === 0) {
                        //Close InfoWindows
                        marker.setVisible(true);
                        if (infowindow) {
                            infowindow.close();
                        }
                    }
                    // Categories don't match
                    else {
                        marker.setVisible(false);
                    }
                }
            }

            // Init map
            initialize();
        })
    </script>
@endpush
