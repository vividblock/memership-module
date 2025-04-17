@include('includes.admin.header')

<!-- Begin Page Content -->
<div class="container-fluid pb-5">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 admindash-headings">Waiting Members</h1>

    </div>



    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Waiting members for approval</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User Id</th>
                            <th>Name</th>
                            <th>organisation</th>
                            <th>Contact Details</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>User Id</th>
                            <th>Name</th>
                            <th>organisation</th>
                            <th>Contact Details</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                    @php
                        $count = 1;
                    @endphp
                    @foreach($members as $m )
                        @foreach($organisation as $o)
                            @if($m->id === $o->member_id)
                                <tr>
                                    <td>{{ $count }}</td>
                                    <td>{{ $m->	members_c3sc_id }}</td>
                                    <td>{{ $m->firstname }} {{ $m->lastname }}</td>
                                    <td>{{ $o->organisation_name }}</td>
                                    <td>Edinburgh</td>
                                    <td>
                                        <a href="#" class="btn btn-success btn-icon-split">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-info-circle"></i>
                                            </span>
                                        </a>
                                        <a href="#" class="btn btn-danger btn-icon-split">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-trash"></i>
                                            </span>
                                        </a>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
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
<!-- /.container-fluid -->



@include('includes.admin.footer')