@include('includes.admin.header')

<!-- Begin Page Content -->
<div class="container-fluid pb-5">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 admindash-headings">Listing Views</h1>

    </div>

    <!-- <div class="row">
        <div class="col-md-7"> -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Listing</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Categorie Name</th>
                                    <th>Link</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Categorie Name</th>
                                    <th>Link</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>   
                            <tbody>
                                {{ dd($listing) }}
                                @php    
                                    $count = 1;
                                @endphp
                                @foreach($listing as $la)
                                <tr>
                                    <td>{{ $count }}</td>
                                    <td><i class=" mr-2"></i>{{ $la->listing_name }}</td>
                                    <td>{{ $la->listing_slug }}</td>
                                    <td>
                                        <a href="" class="btn btn-danger btn-icon-split">
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
        <!-- </div>
    </div> -->
</div>


@include('includes.admin.footer')