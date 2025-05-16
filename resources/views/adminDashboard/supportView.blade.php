@include('includes.admin.header')

<!-- Begin Page Content -->
<div class="container-fluid pb-5">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 admindash-headings">Support Tickets</h1>

    </div>



    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <!-- <h6 class="m-0 font-weight-bold text-primary">Waiting members for approval</h6> -->
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th>Urgency</th>
                            <th>Status</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th>Urgency</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                    @php
                        $count = 1;
                    @endphp
                    @foreach($supportlist as $sl )

                        @php
                            // Set border class based on urgency
                            switch ($sl->urgency_lable) {
                                case 1:  $borderClass = '<span class="btn-sm btn-danger">Today</span>'; break;    // Today
                                case 2:  $borderClass = '<span class="btn-sm btn-warning">Next Few Days</span>'; break;   // Next Few Days
                                case 3:  $borderClass = '<span class="btn-sm btn-success">Not Urgent</span>'; break;   // Not Urgent
                                default: $borderClass = '<span class="btn-sm btn-primary">Need Help</span>';
                            }
                        @endphp

                        <tr>
                            <td>{{ $count }}</td>
                            <td>{{ $sl->support_subject }}</td>
                           <td>{{ \Illuminate\Support\Str::words($sl->support_message, 10, '...') }}</td>
                            <td>{!! $borderClass !!}</td>
                            <td>{{ ucfirst($sl->support_status) }}</td>
                            <td>
                                <a href="{{ route('supportTicketSingleView', ['supportId' => $sl->id, 'memberId' => encrypt($sl->member_id)]) }}" class="btn-sm btn-success btn-icon-split">
                                    <span class="icon text-white-50">
                                        <i class="fa-solid fa-eye"></i>
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

</div>
<!-- /.container-fluid -->



@include('includes.admin.footer')