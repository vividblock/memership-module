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
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Listing Category</th>
                                    <th>Location</th>
                                    <th>Author</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Listing Category</th>
                                    <th>Location</th>
                                    <th>Author</th>
                                    <th>Date</th>
                                </tr>
                            </tfoot>      
                            <tbody>

                                @php    
                                    $count = 1;
                                @endphp
                                @foreach($listing as $la)
                                <tr>
                                    <td>{{ $count }}</td>
                                    <td>{{ $la->listing_id }}</td>
                                    <td><a href="{{ $la->listing_slug }}">{{ $la->listing_name }}</a></td>
                                    <td>
                                        @foreach(explode(',', $la->categories_id) as $catId)
                                            @foreach($categories as $ca)
                                                @if($ca->id == $catId)
                                                    {{ $ca->categories_name }}@if(!$loop->last), @endif
                                                @endif
                                            @endforeach
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach(explode(',', $la->location_id) as $locID)
                                            @foreach($locations as $lo)
                                                @if($lo->id == $locID)
                                                    {{ $lo->location_name }}@if(!$loop->last), @endif
                                                @endif
                                            @endforeach
                                        @endforeach
                                    </td>
                                    <td></td>
                                    <td>
                                        {{ $la->created_at->format('F j, Y g:i A') }}
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