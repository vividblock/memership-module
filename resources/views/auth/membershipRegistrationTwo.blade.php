<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Cardiff Third Sector Council - Become a Member</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- fontawsome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.css') }}" rel="stylesheet">

    <!-- Custom css -->
    <link rel="stylesheet" href="{{ asset('css/members-base-style.css')}}">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center auth-container-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <!-- <div class="col-lg-6 d-none d-lg-block bg-login-image"></div> -->
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Hello <strong>@Member</strong></h1>
                                    </div>
                                    <div class="step-progress pb-3">
                                        <div class="step active">1</div>
                                        <div class="step-line" style="background-color:#007bff;"></div>
                                        <div class="step active">2</div>
                                    </div>

                                    <form class="user" action="{{ route('membersRegistrationTwo') }}" method="post">
                                        @csrf

                                        @if(session('membershiptype_sess') == "2")
                                            <h6 class="text-gray-800 membership-registration-form-field-heading">Individual Membership</h6>
                                            <select name="free_membership_individual" class="form-control membership-from-select-field">
                                                <option value="I am involved with the Third Sector In Cardiff">I am involved with the Third Sector In Cardiff  </option>
                                                <option value="Not Applicable">Not Applicable</option>
                                            </select>
                                        @endif
                                        <h6 class="text-gray-800 membership-registration-form-field-heading pt-2">Membership Package</h6>
                                        <div class="form-group">
                                            <select name="membership_package" class="form-control membership-from-select-field">
                                                <option value="Full Membership">Full Membership</option>
                                                <option value="Associate Membership">Associate Membership</option>
                                                <option value="Friends of C3SC">Friends of C3SC</option>
                                            </select>
                                        </div>


                                        <h6 class="text-gray-800 membership-registration-form-field-heading">Organisation or Group Name</h6>
                                        <div class="form-group pb-2">
                                            <input type="text" class="form-control form-control-user"
                                            placeholder="Group/Organisation Name" name="organisationname">
                                            @if ($errors->has('organisationname'))
                                                <span class="text-danger">{{ $errors->first('organisationname') }}</span>
                                            @endif
                                        </div>
                                        <h6 class="text-gray-800 membership-registration-form-field-heading">Organisation Address</h6>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                            placeholder="Correspondence Address" name="correspondenceaddress" id="autocomplete" value="{{ session('correspondenceaddress_sess') }}">
                                            @if ($errors->has('correspondenceaddress'))
                                                <span class="text-danger">{{ $errors->first('correspondenceaddress') }}</span>
                                            @endif
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-user"
                                                    placeholder="City" name="city" id="city" value="{{ session('city_sess') }}">
                                                    @if ($errors->has('city'))
                                                        <span class="text-danger">{{ $errors->first('city') }}</span>
                                                    @endif
                                                </div>
                                                
                                            </div>
                                            <div class="col-lg-6 pb-2">
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-user"
                                                    placeholder="Postcode" name="postcode" id="postcode">
                                                    @if ($errors->has('postcode'))
                                                        <span class="text-danger">{{ $errors->first('postcode') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <h6 class="text-gray-800 membership-registration-form-field-heading">Organisation Registration Details</h6>
                                        <div class="row pb-2">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-user"
                                                    placeholder="Organisation Email" name="organisationemail">
                                                    @if ($errors->has('organisationemail'))
                                                        <span class="text-danger">{{ $errors->first('organisationemail') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <input type="password" class="form-control form-control-user"
                                                    placeholder="Password" name="password">
                                                    <span class="eye-button-for-password"><i class="fa-solid fa-eye"></i></span>
                                                    @if ($errors->has('password'))
                                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                                    @endif
                                                </div>
                                            </div>

                                        </div>
                                        @if(session('membershiptype_sess') == "2")
                                            
                                            <h6 class="text-gray-800 membership-registration-form-field-heading">Use the box below to describe your involvement with the third sector: [maximum: 100 words].</h6>
                                        @else
                                            <h6 class="text-gray-800 membership-registration-form-field-heading">Please provide a brief description of your group’s or organisation’s purpose and aims [maximum: 100 words].</h6>
                                        @endif
                                        <div class="form-group pb-2">
                                            <textarea class="form-control" name="organisation_request_descripiton"></textarea>
                                        </div>
                                        

                                        
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <a href="{{ route('membersRegistrationOneView') }}" class="btn btn-success btn-user btn-block">Back</a>
                                            </div>
                                            <div class="col-lg-4">
                                               
                                            </div>
                                            <div class="col-lg-4">
                                                <button class="btn btn-primary btn-user btn-block">Register</button>
                                            </div>
                                        </div>
                                        

                                    </form>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js')}}"></script>

    <!-- Google maps Autom complete -->
    <!-- Google Places API -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDbOwo3HPw7YB8g54d3xi7HLENgbOpEjzk&libraries=places"></script>

    <script>
        function initAutocomplete() {
            let input = document.getElementById('autocomplete');
            let autocomplete = new google.maps.places.Autocomplete(input);

            autocomplete.addListener('place_changed', function () {
                let place = autocomplete.getPlace();
                
                let address_components = place.address_components;
                let city = "";
                let postcode = "";

                for (let i = 0; i < address_components.length; i++) {
                    let type = address_components[i].types[0];

                    if (type === "locality") {
                        city = address_components[i].long_name;
                    } else if (type === "postal_code") {
                        postcode = address_components[i].long_name;
                    }
                }

                document.getElementById('city').value = city;
                document.getElementById('postcode').value = postcode;
            });
        }

        google.maps.event.addDomListener(window, 'load', initAutocomplete);
    </script>
</body>

</html>