@include('includes.members.header')

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 text-gray-800 dash-headings">Reset Password</h1>
    </div>

    <!-- <div class="row justify-content-center">
        <div class="col-md-6"> -->
            @if(session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card shadow">
                <div class="card-header">Verify OTP & Reset Password</div>
                <div class="card-body">
                    <form method="POST" action="">
                        @csrf

                        <div class="form-group">
                            <label for="otp">OTP Code</label>
                            <input type="text" name="otp" id="otp" class="form-control" required maxlength="6" placeholder="Enter the 6-digit OTP">
                        </div>

                        <div class="form-group mt-3">
                            <label for="password">New Password</label>
                            <input type="password" name="password" id="password" class="form-control" required placeholder="New password">
                        </div>

                        <div class="form-group mt-3">
                            <label for="password_confirmation">Confirm Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required placeholder="Confirm new password">
                        </div>

                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-primary w-100">Reset Password</button>
                        </div>
                    </form>
                </div>
            </div>

        <!-- </div>
    </div> -->
</div>

@include('includes.members.footer')
