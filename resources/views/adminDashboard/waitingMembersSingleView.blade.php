@include('includes.admin.header')

<!-- Begin Page Content -->
<div class="container-fluid pb-5">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 admindash-headings">Waiting Members</h1>

    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="h5 mb-0 text-gray-700 admindash-headings">Members Details</h3>
                </div>
                <div class="card-body">
                    <span class="text-xl font-weight-bold text-primary text-uppercase" >Name: </span>{{ $members->firstname }} {{ $members->lastname }}<br>
                    <span>Member Id: </span>{{ $members->members_c3sc_id }}<br>
                    <span>Username: </span>{{ $members->username }}<br>
                    <span>Email: </span>{{ $members->email }}<br>
                    <span>Contact number: </span> {{ $members->contactnumber }}<br>
                    <span>Membership package: </span>{{ $members->memebership_package }}<br>
                    <span>Apply Date: </span> {{ $members->created_at }}
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="h5 mb-0 text-gray-700 admindash-headings">Organisation Details</h3>
                </div>
                <div class="card-body">
                    <span>Name: </span>{{ $organisation->organisation_name }}<br>
                    <span>Email: </span>{{ $organisation->organisation_email }}<br>
                    <span>Contact number: </span>{{ $organisation->contact_number }}<br>
                    <span>Address: </span>{{ $organisation->correspondence_address }}<br>
                    <span>City: </span>	{{ $organisation->city }}<br>
                    <span>Postal code: </span>  {{ $organisation->postcode }}<br>
                    <span>Country: </span> {{ $organisation->country }}<br>
                </div>
            </div>
        </div>
    </div>





</div>
<!-- /.container-fluid -->



@include('includes.admin.footer')