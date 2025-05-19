@include('includes.admin.header')

<!-- Begin Page Content -->
<div class="container-fluid pb-5">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 admindash-headings">Listing</h1>

    </div>

    <!-- Main Content -->
    <div class="card p-4">
      <div class="card-header mb-3"><h6 class="h6 mb-0 text-gray-800 admindash-headings">Add Listing</h4></div>

      <div class="row">
        <!-- Left Column (Excerpt, Custom Fields etc) -->
        <div class="col-md-8">
          <div class="panel">
            <input type="text" class="form-control mb-3" placeholder="Enter title here">

            <script src="https://cdn.tiny.cloud/1/w12g53mmdhlettmiu1p1nuqses3oqpjy97vxit63v7umnlit/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
            <script>
            tinymce.init({
                selector: '#listing-description-textarea',
                plugins: [
                // Core editing features
                'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'image', 'link', 'lists', 'media', 'searchreplace', 'table', 'visualblocks', 'wordcount',
                // Your account includes a free trial of TinyMCE premium features
                // Try the most popular premium features until Jun 2, 2025:
                'checklist', 'mediaembed', 'casechange', 'formatpainter', 'pageembed', 'a11ychecker', 'tinymcespellchecker', 'permanentpen', 'powerpaste', 'advtable', 'advcode', 'editimage', 'advtemplate', 'ai', 'mentions', 'tinycomments', 'tableofcontents', 'footnotes', 'mergetags', 'autocorrect', 'typography', 'inlinecss', 'markdown','importword', 'exportword', 'exportpdf'
                ],
                toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
                tinycomments_mode: 'embedded',
                tinycomments_author: 'Author name',
                mergetags_list: [
                { value: 'First.Name', title: 'First Name' },
                { value: 'Email', title: 'Email' },
                ],
                ai_request: (request, respondWith) => respondWith.string(() => Promise.reject('See docs to implement AI Assistant')),
            });
            </script>
            <textarea id="listing-description-textarea"></textarea>
          </div>

          <div class="card mt-3">
            <div class="card-header">
              <h6><strong>Listing Settings</strong></h6>
            </div>
            <div class="card-body">
              <label for=""><strong>Branding</strong></label>
              <div class="form-group">
                <label class="mb-0" for="">Business Logo</label><br>
                <small>Select business logo for your listing</small>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Upload</span>
                  </div>
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="inputGroupFile01">
                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                  </div>
                </div>
              </div>

              <div class="form-group mt-4">
                <label class="mb-0" for="">Business Tagline Text</label><br>
                <small>Your Business One liner</small>
                <input type="text" name="" id="" class="form-control">
                
              </div>

              <div class="form-group mt-4">
                <label class="mb-0" for="">Background Banner</label><br>
                <small>Select page background image</small>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Upload</span>
                  </div>
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="inputGroupFile01">
                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                  </div>
                </div>
                
              </div>

              <hr>
              <label for=""><strong>Contact Details</strong></label>
              <div class="row mt-4">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Phone</label>
                    <input type="tel" name="" id="" class="form-control">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Email</label>
                    <input type="email" name="" id="" class="form-control">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Whatsapp</label>
                    <input type="tel" name="" id="" class="form-control">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Website</label>
                    <input type="email" name="" id="" class="form-control">
                  </div>
                </div>
              </div>

              <hr>

            <!-- Visible Inputs -->
            <!-- Search Box -->
            <div class="form-group">
              <label for=""><strong>Location</strong></label>
              <input type="text" id="searchBox" name="location_name" class="form-control" placeholder="Search location..." autocomplete="off">
            </div>

            <!-- Map -->
            <div id="map" style="height: 400px; width: 100%; margin-bottom: 20px;"></div>

              <!-- Location Info Inputs -->
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
                  <div class="col-md-6">
                      <div class="form-group">
                          <label>Full Address</label>
                          <input type="text" id="full_address" name="location_google_address" class="form-control" >
                      </div>
                  </div>
                  <div class="col-md-3">
                      <div class="form-group">
                          <label>Country</label>
                          <input type="text" id="country" name="location_country" class="form-control" readonly>
                      </div>
                  </div>
                  <div class="col-md-3">
                      <div class="form-group">
                          <label>Zip Code</label>
                          <input type="text" id="zipcode" name="location_zipcode" class="form-control" >
                      </div>
                  </div>
              </div>

              <input type="hidden" id="location_raw_data" name="location_raw_data">

              <!-- Async Google Maps API with callback -->
              <script>
                  let map, marker, geocoder;

                  function initMap() {
                      geocoder = new google.maps.Geocoder();
                      const defaultLatLng = { lat: 28.6139, lng: 77.2090 }; // Default: New Delhi

                      map = new google.maps.Map(document.getElementById("map"), {
                          center: defaultLatLng,
                          zoom: 13,
                      });

                      marker = new google.maps.Marker({
                          position: defaultLatLng,
                          map,
                          draggable: true,
                      });

                      google.maps.event.addListener(marker, "dragend", function () {
                          updatePosition(marker.getPosition());
                      });

                      const input = document.getElementById("searchBox");
                      const autocomplete = new google.maps.places.Autocomplete(input);
                      autocomplete.bindTo("bounds", map);

                      autocomplete.addListener("place_changed", function () {
                          const place = autocomplete.getPlace();
                          if (!place.geometry) return;

                          map.setCenter(place.geometry.location);
                          map.setZoom(15);
                          marker.setPosition(place.geometry.location);
                          updatePosition(place.geometry.location);

                          document.getElementById("location_raw_data").value = JSON.stringify(place);
                      });

                      updatePosition(defaultLatLng);
                  }

                  function updatePosition(latlng) {
                      const lat = typeof latlng.lat === "function" ? latlng.lat() : latlng.lat;
                      const lng = typeof latlng.lng === "function" ? latlng.lng() : latlng.lng;

                      document.getElementById("latitude").value = lat;
                      document.getElementById("longitude").value = lng;

                      geocoder.geocode({ location: { lat, lng } }, (results, status) => {
                          if (status === "OK" && results[0]) {
                              const components = results[0].address_components;
                              let country = "", zip = "";

                              for (let c of components) {
                                  if (c.types.includes("country")) country = c.long_name;
                                  if (c.types.includes("postal_code")) zip = c.long_name;
                              }

                              document.getElementById("full_address").value = results[0].formatted_address;
                              document.getElementById("country").value = country;
                              document.getElementById("zipcode").value = zip;
                          }
                      });
                  }
              </script>

              <!-- Google Maps API with Places -->
              <script async defer
                  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDbOwo3HPw7YB8g54d3xi7HLENgbOpEjzk&libraries=places&callback=initMap">
              </script>

              <hr>
            <!-- Open Hours -->
            <!-- <div class="container my-4"> -->
            <label for=""><strong>Business Hours</strong></label>

            <div id="hours-list">
              <!-- Existing day entries will go here -->
            </div>

            <!-- Add new row -->
            <div class="row g-2 align-items-center mt-3" id="addRow">
              <div class="col-md-3">
                <select class="form-control membership-from-select-field" id="daySelect">
                  <option selected disabled>Select Day</option>
                  <option>Monday</option>
                  <option>Tuesday</option>
                  <option>Wednesday</option>
                  <option>Thursday</option>
                  <option>Friday</option>
                  <option>Saturday</option>
                  <option>Sunday</option>
                </select>
              </div>
              <div class="col-md-3">
                <input type="time" class="form-control form-control-user" id="startTime">
                <!-- <small>Open</small> -->
              </div>
              <div class="col-md-3">
                <input type="time" class="form-control form-control-user" id="endTime">
                <!-- <small>Close</small> -->
              </div>
              <div class="col-md-2">
                <input type="checkbox" id="is24Hours"> <label for="is24Hours">24 Hours</label>
                
              </div>
              <div class="col-md-1">
                <button type="button" class="btn btn-dark" onclick="addHourRow()">
                  <i class="fas fa-plus"></i>
                </button>
              </div>
            </div>
            <!-- </div> -->
            <script>
              function addHourRow() {
                const day = document.getElementById("daySelect").value;
                const start = document.getElementById("startTime").value;
                const end = document.getElementById("endTime").value;
                const is24 = document.getElementById("is24Hours").checked;

                if (!day || (!start && !is24) || (!end && !is24)) {
                  alert("Please fill all fields or select 24 Hours.");
                  return;
                }

                const hoursList = document.getElementById("hours-list");

                const row = document.createElement("div");
                row.className = "row g-2 align-items-center mb-2";
                row.innerHTML = `
                  <div class="col-md-3"><strong>${day}</strong></div>
                  <div class="col-md-6">${is24 ? "24 Hours" : `${formatTime(start)} - ${formatTime(end)}`}</div>
                  <div class="col-md-1 text-danger" style="cursor:pointer" onclick="this.parentElement.remove()">
                    <i class="fas fa-times"></i>
                  </div>
                `;

                hoursList.appendChild(row);
              }

              function formatTime(t) {
                const [h, m] = t.split(":");
                const hour = parseInt(h);
                const suffix = hour >= 12 ? "PM" : "AM";
                const formattedHour = hour % 12 === 0 ? 12 : hour % 12;
                return `${String(formattedHour).padStart(2, "0")}:${m} ${suffix}`;
              }
            </script>

            <hr>  
            <!-- Socials Links -->
            <!-- <div class="container my-4"> -->
            <label for=""><strong>Social Links</strong></label>

            <div id="socialLinksWrapper">
              <div class="input-group mb-2">
                <input type="url" name="social_links[]" class="form-control" placeholder="Enter social link">
                <button class="btn btn-outline-danger" type="button" onclick="removeSocialLink(this)">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>

            <button type="button" class="btn btn-dark" onclick="addSocialLink()">
              <i class="fas fa-plus"></i> Add Social Link
            </button>
            <!-- </div> -->
            <script>
              function addSocialLink() {
                const wrapper = document.getElementById("socialLinksWrapper");

                const inputGroup = document.createElement("div");
                inputGroup.className = "input-group mb-2";

                inputGroup.innerHTML = `
                  <input type="url" name="social_links[]" class="form-control" placeholder="Enter social link">
                  <button class="btn btn-outline-danger" type="button" onclick="removeSocialLink(this)">
                    <i class="fas fa-times"></i>
                  </button>
                `;

                wrapper.appendChild(inputGroup);
              }

              function removeSocialLink(btn) {
                btn.parentElement.remove();
              }
            </script>

            <hr>
            <div class="form-group">
              <label for="">Verify Listing</label><br>
              <small>Approve claim at claim section this will override complete claim process</small>
              <select name="" class="form-control membership-from-select-field" id="">
                <option value="">Not Claimed</option>
                <option value="">Claimed</option>
              </select>
            </div>

            <div class="form-group">
              <label class="mb-0" for="">Gallery</label><br>
              <small>Select page Gallery</small>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">Upload</span>
                </div>
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="inputGroupFile01">
                  <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="">Youtube Video URL</label><br>
              <small>Any specific Youtube Video? You want to share on business page</small>
              <input type="text" class="form-control">
            </div>

            <div class="form-group">
              <label for="">Show Price Status</label><br>
              <small>It will show your business price range</small>
              <select name="" class="form-control membership-from-select-field" id="">
                <option value="notsay">Prefer not to say</option>
                <option value="inexpensive">£ Inexpensive</option>
                <option value="moderate">££ Moderate</option>
                <option value="pricey">£££ Pricey</option>
                <option value="ultra_high_end">££££ Ultra High-End</option>   
              </select>
            </div>

            <div class="form-group">
              <label for="">Price From</label><br>
              <small>Ignore this if your buisness does not have any specific price to show</small>
              <input type="text" class="form-control">
            </div>

            <div class="form-group">
              <label for="">Price To</label><br>
              <small>Ignore this if your buisness does not have any specific price to show</small>
              <input type="text" class="form-control">
            </div>


          </div>
          
          
          </div>
        </div>

        
        <!-- Right Column (Publish, Format, Categories) -->
        <div class="col-md-4">

          <!-- Publish Card -->
          <div class="card ">
            <div class="card-header">
              <h6>Publish</h6>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-6 text-left">
                  <span class="btn btn-sm btn-outline-primary">Save Draft</span>
                </div>
                <div class="col-md-6 text-right">
                  <span class="btn btn-sm btn-outline-primary">Preview</span>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <div class="row">
                <div class="col-md-6 text-left">
                  
                </div>
                <div class="col-md-6 text-right">
                  <button type="submit" class="btn btn-sm btn-primary">Publish</button>
                </div>
              </div>
            </div>
          </div>

          <!-- Category Card -->
          <div class="card mt-3">
            <div class="card-header">
              <h6><strong>Categories</strong></h6>
            </div>
            <div class="card-body">
              @foreach($categories as $ca)
                <div class="d-flex align-items-center">
                  <input value="{{ $ca->id }}" type="checkbox"><span class="ml-2">{{ $ca->categories_name }} </span>
                </div>
                
              @endforeach
            </div>
            <div class="card-footer">
              <span class="btn btn-link">+ Add New Category</span>
            </div>
          </div>


          <!-- Location Card -->
          <div class="card mt-3">
            <div class="card-header">
              <h6><strong>Location</strong></h6>
            </div>
            <div class="card-body">
              @foreach($locations as $la)
                <div class="d-flex align-items-center">
                  <input value="{{ $la->id }}" type="checkbox"><span class="ml-2">{{ $la->location_name }} </span>
                </div>
                
              @endforeach
            </div>
            <div class="card-footer">
              <span class="btn btn-link">+ Add New Location</span>
            </div>
          </div>
        </div>


      </div>

    </div>


</div>



@include('includes.admin.footer')