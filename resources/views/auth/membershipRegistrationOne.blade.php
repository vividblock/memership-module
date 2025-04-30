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

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.css') }}" rel="stylesheet">

    <!-- Custom css -->
    <link rel="stylesheet" href="{{ asset('css/members-base-style.css')}}">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center  auth-container-center">

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
                                        <div class="step-line"></div>
                                        <div class="step">2</div>
                                    </div>

                                    <div class="pb-2 membership-registration-details">
                                        <h6 class="h5 text-gray-800">Membership Details Form</h6>
                                        <p>If you are applying to become a member of C3SC, thank you for your interest in joining our growing community of voluntary activities and services - please select below the type of membership that applies to you</p>
                                    </div>
                                    <form class="user" action="{{ route('membersRegistrationOne') }}" method="post">
                                        @csrf

                                        <div class="form-group pb-3">
                                            <select class="form-control membership-from-select-field" name="membershiptype" id="memebershipTypeID">
                                                <option value="" disabled selected>Membership type</option>
                                                <option value="1" {{ session('membershiptype_sess') == '1' ? 'selected' : '' }}>Non for profit - Group or Organisation</option>
                                                <option value="2" {{ session('membershiptype_sess') == '2' ? 'selected' : '' }}>Non for profit - Individual</option>
                                                <option value="3" {{ session('membershiptype_sess') == '3' ? 'selected' : '' }}>Statutory Sector</option>
                                                <option value="4" {{ session('membershiptype_sess') == '4' ? 'selected' : '' }}>Private Sector</option>
                                            </select>
                                            @if ($errors->has('membershiptype'))
                                                <span class="text-danger">{{ $errors->first('membershiptype') }}</span>
                                            @endif
                                        </div>

                                        <div class="pb-2 membership-registration-details">
                                            <h6 class="h5 text-gray-800">Your Correspondence Details.</h6>
                                            <p>These are the details that will be stored with our membership records. These records are kept in compliance with GDPR and best practices and will not be shared without your prior consent; see our privacy policy</p>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-user"
                                                    placeholder="First name" name="firstname" value="{{ session('firstname_sess') }}">
                                                    @if ($errors->has('firstname'))
                                                        <span class="text-danger">{{ $errors->first('firstname') }}</span>
                                                    @endif
                                                </div>
                                                
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-user"
                                                    placeholder="Last name" name="lastname" value="{{ session('lastname_sess') }}">
                                                    @if ($errors->has('lastname'))
                                                        <span class="text-danger">{{ $errors->first('lastname') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            
                                        </div>

                                        <div class="row ">
                                            <div class="col-lg-6">
                                                <div class="form-group auth-email-box">
                                                    <input type="email" class="form-control form-control-user"
                                                    placeholder="Email" name="email" value="{{ session('email_sess') }}">
                                                    <span class="email-verify-button" id="email-verify-auth-page">Verify</span>
                                                    @if ($errors->has('email'))
                                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                                    @endif
                                                    <small id="email-validation-message"></small>
                                                </div>
                                                 

                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <input type="tel" class="form-control form-control-user"
                                                    placeholder="Contact number" name="contactnumber" value="{{ session('contactnumber_sess') }}">
                                                    @if ($errors->has('contactnumber'))
                                                        <span class="text-danger">{{ $errors->first('contactnumber') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row otp-validate-box" style="display:none;">
                                            <div class="col-lg">
                                                <div class="form-group">
                                                    <small id="email-shows-for-otp"> <span ></span></small>
                                                    <input type="text" name="email_otp" class="form-control form-control-user" placeholder="Otp">
                                                    <input type="hidden" name="email_otp_status" value="false">
                                                </div>
                                            </div>
                                        </div>


                                        
                                        <div class="row pt-5">
                                            <div class="col-lg-4">

                                            </div>
                                            <div class="col-lg-4">
                                                <button disabled class="btn btn-primary btn-user btn-block">Next</button>
                                            </div>
                                            <div class="col-lg-4"></div>
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
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js')}}"></script>
    <script>
        $(document).ready(function(){

            $("#email-verify-auth-page").on("click", function(){
                // console.log("Hello WOrld");
                const email = $('input[name = "email"]').val();
                if(email != ""){
                    $(".otp-validate-box").fadeIn();
                    
                    $.ajax({
                        url:"{{route('membersEmailValidateApi')}}",
                        type:'POST',
                        data:{
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            email:email
                        },
                        success:function(data){
                            console.log(data);
                            if(data['success']){
                                $("#email-shows-for-otp").text(data['message']);
                            }
                            
                        }
                    });
                }else{
                    $("#email-validation-message").text("Please enter a valid email id.");
                    setTimeout(() => {
                        $("#email-validation-message").text("");
                    }, 1000);
                }
                
            });
        });
    </script>

</body>

</html>