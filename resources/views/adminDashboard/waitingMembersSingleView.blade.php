@include('includes.admin.header')

<!-- Begin Page Content -->
<div class="container-fluid pb-5">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 admindash-headings">Waiting Members</h1>

    </div>

    <div class="card">
        <div class="card-header">
            <h3>Members Details</h3>
        </div>
        <div class="card-body">
            <span>FUll Name: </span>{{ $members->firstname }} {{ $members->lastname }}
        </div>
    </div>




</div>
<!-- /.container-fluid -->



@include('includes.admin.footer')