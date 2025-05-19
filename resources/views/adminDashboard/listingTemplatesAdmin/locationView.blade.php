@include('includes.admin.header')

<!-- Begin Page Content -->
<div class="container-fluid pb-5">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 admindash-headings">Locations</h1>

    </div>

    <div class="row">
        <div class="col-md-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Locations</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Location Name</th>
                                    <th>Link</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Location Name</th>
                                    <th>Link</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>   
                            <tbody>
                                @php
                                    $count = 1;
                                @endphp
                                @foreach($location as $la)
                                <tr>
                                    <td>{{ $count }}</td>
                                    <td>{{ $la->location_name }}</td>
                                    <td>{{ $la->location_slug }}</td>
                                    <td>
                                        <a href="{{ route('listingLocationDelete', $la->id ) }}" class="btn btn-danger btn-icon-split">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-trash"></i>
                                            </span>
                                        </a>
                                    </td>
                                </tr>
                                @php
                                    $count++;
                                @endphp
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Add Categories</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('listingLocationsAdd') }}" method="post">
                        @csrf
                        <div class="card">
                            <div class="card-head">Choose on map</div>
                            <div class="card-body">
                                <div id="map" style="height: 400px;"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Latitude</label>
                                        <input type="text" id="latitude" name="location_latitude" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Longitude</label>
                                        <input type="text" id="longitude" name="location_longititude" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Location Name</label>
                            <input type="text" id="location_name" name="location_name" class="form-control" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label>Category Slug</label>
                            <input type="text" id="location_slug" name="location_slug" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Google Address</label>
                            <input type="text" id="google_address" name="location_google_address" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label>Country</label>
                            <input type="text" id="country" name="location_country" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label>ZIP Code</label>
                            <input type="text" id="zipcode" name="location_zipcode" class="form-control" readonly>
                        </div>
                        <input type="hidden" id="location_raw_data" name="location_raw_data">
                        <button type="submit" class="btn btn-primary btn-sm">Add location</button>
                    </form>

                    {{-- Google Maps Script --}}
                    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDbOwo3HPw7YB8g54d3xi7HLENgbOpEjzk&libraries=places"></script>

                    <script>
                        let map, marker, geocoder;

                        function initMap() {
                            geocoder = new google.maps.Geocoder();

                            map = new google.maps.Map(document.getElementById("map"), {
                                center: { lat: 55.3781, lng: -3.4360 },
                                zoom: 5,
                            });

                            marker = new google.maps.Marker({
                                map,
                                draggable: true,
                            });

                            map.addListener("click", (e) => {
                                let lat = e.latLng.lat();
                                let lng = e.latLng.lng();
                                updatePosition(lat, lng);
                            });

                            marker.addListener("dragend", () => {
                                let lat = marker.getPosition().lat();
                                let lng = marker.getPosition().lng();
                                updatePosition(lat, lng);
                            });

                            // Autocomplete feature for location_name input
                            const input = document.getElementById('location_name');
                            const autocomplete = new google.maps.places.Autocomplete(input);

                            autocomplete.bindTo('bounds', map);

                            autocomplete.addListener('place_changed', () => {
                                const place = autocomplete.getPlace();
                                // console.log(place);
                                document.getElementById("location_raw_data").value = JSON.stringify(place);
                                if (!place.geometry) {
                                    alert("No details available for input: '" + place.name + "'");
                                    return;
                                }

                                const lat = place.geometry.location.lat();
                                const lng = place.geometry.location.lng();

                                updatePosition(lat, lng);

                                document.getElementById("location_name").value = place.name;
                                document.getElementById("google_address").value = place.formatted_address || "";

                                // Reset fields before filling
                                document.getElementById("country").value = "";
                                document.getElementById("zipcode").value = "";

                                const components = place.address_components || [];
                                components.forEach(comp => {
                                    if (comp.types.includes("country")) {
                                        document.getElementById("country").value = comp.long_name;
                                    }
                                    if (comp.types.includes("postal_code")) {
                                        document.getElementById("zipcode").value = comp.long_name;
                                    }
                                });
                            });
                        }

                        function updatePosition(lat, lng) {
                            document.getElementById("latitude").value = lat;
                            document.getElementById("longitude").value = lng;
                            // document.getElementById("location_raw_data").value = JSON.stringify(place);

                            let latlng = { lat: parseFloat(lat), lng: parseFloat(lng) };
                            marker.setPosition(latlng);
                            map.panTo(latlng);

                            geocoder.geocode({ location: latlng }, (results, status) => {
                                if (status === "OK" && results[0]) {
                                    let components = results[0].address_components;
                                    document.getElementById("google_address").value = results[0].formatted_address;

                                    // Only set location_name if empty (so autocomplete doesn't overwrite)
                                    if (!document.getElementById("location_name").value) {
                                        document.getElementById("location_name").value = results[0].formatted_address.split(",")[0];
                                    }

                                    // Reset before filling country & zip
                                    document.getElementById("country").value = "";
                                    document.getElementById("zipcode").value = "";

                                    components.forEach(comp => {
                                        if (comp.types.includes("country")) {
                                            document.getElementById("country").value = comp.long_name;
                                        }
                                        if (comp.types.includes("postal_code")) {
                                            document.getElementById("zipcode").value = comp.long_name;
                                        }
                                    });
                                }
                            });
                        }

                        window.onload = initMap;
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>



@include('includes.admin.footer')