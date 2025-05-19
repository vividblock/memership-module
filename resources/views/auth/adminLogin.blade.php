<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Cardiff Third Sector Council - Login</title>

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
    <link rel="stylesheet" href="{{ asset('css/base-style.css')}}">
    <style>
        #InputPassword{
            position: relative;
        }
        .eye-button-for-password{
            position: absolute;
            top: 13px;
            right: 28px;
        }
    </style>

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center align-items-center auth-container-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Hello <strong>@Admin</strong></h1>
                                    </div>
                                    <form class="user" action="{{ route('adminLogin') }}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Username" name="username">
                                                @if ($errors->has('username'))
                                                    <span class="text-danger">{{ $errors->first('username') }}</span>
                                                @endif
                                        </div>
                                        <div class="form-group" id="InputPassword">
                                            <input type="password" class="form-control form-control-user"  placeholder="Password" name="password">
                                            <span class="eye-button-for-password" id="show-password"><i class="fa-solid fa-eye"></i></span>
                                                @if ($errors->has('password'))
                                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                                @endif
                                        </div>

                                        <button class="btn btn-primary btn-user btn-block">Login</button>

                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="#">Forgot Password?</a>
                                    </div>

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
    <script>
        $(document).ready(function(){
            $("#show-password").on("click", function(){
                let passwordInput = $('input[name="password"]');
                let isPassword = passwordInput.attr('type') === 'password';

                passwordInput.attr('type', isPassword ? 'text' : 'password');
                $(this).html(isPassword 
                    ? '<i class="fa-solid fa-eye-slash"></i>' 
                    : '<i class="fa-solid fa-eye"></i>');
            });
        });
    </script>

</body>

</html>