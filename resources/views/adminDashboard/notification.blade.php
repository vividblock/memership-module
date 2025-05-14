@include('includes.admin.header')

<!-- Begin Page Content -->
<div class="container-fluid pb-5">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 admindash-headings">Notifications</h1>

    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="table-responsive">
                <table class="table table-bordered dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Notification Reason</th>
                            <th>Message</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Notification Reason</th>
                            <th>Message</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @php
                            $count = 1;
                        @endphp
                        @foreach($notification as $noti)
                        <tr>
                            <td>
                                {{ $count }}
                            </td>
                            <td>
                                {{ $noti->notification_reason }}
                            </td>
                            <td>
                                {{ $noti->notification_message }}
                            </td>
                            <td>
                                <label class="switch">
                                <input data-notification-id="{{ encrypt($noti->id) }}" type="checkbox" class="slider_checkbox" {{ $noti->notification_status ? 'checked' : '' }}>
                                    <span class="slider_switch"></span>
                                </label>
                            </td>
                            <td>
                                <!-- <a href="#" class="btn btn-success btn-icon-split">
                                    <span class="icon text-white-50">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </span>
                                </a> -->
                                <a href="{{route('notificationDelete', encrypt($noti->id))}}" class="btn btn-danger btn-icon-split">
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

                    <tbody>
                </table>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card shadow">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Set Notifications</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('notificationAdd') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">Notification message</label>
                            <textarea name="notification_message" class="form-control form-control-user" id=""></textarea>

                            <small>Add dynamic value:</small><br><small><code>@{{MemberID}}</code>, <code>@{{Username}}</code>, <code>@{{FirstName}}</code>, <code>@{{LastName}}</code>, <code>@{{Email}}</code>, <code>@{{ContactNumber}}</code></small>
                        </div>
                        <div class="form-group">
                            <label for="">Notification Reason</label>
                            <select name="notification_reason" class="form-control membership-from-select-field" id="">
                                <option>Choose a reason</option>
                                <option value="account_created">Account Created</option>
                                <option value="account_abandoned">Account Abandoned</option>
                                <option value="account_in_review">Account In review</option>
                                <option value="account_in_hold">Account In Hold</option>
                                <option value="account_live">Account Live</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Notification Status</label>
                            <label class="switch">
                                <input type="checkbox" name="notification_status" class="slider_checkbox" checked>
                                <span class="slider_switch"></span>
                            </label>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary">Set Notification</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

</div>
<!-- /.container-fluid -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<script type="text/javascript" defer>
    $(document).ready(function(){
        $(".slider_checkbox").on("change",function(){
            let notificationId = $(this).data('notification-id');
            let notificationStatus = $(this).is(':checked') ? 1 : 0;
            // console.log(notificationStatus);
            $(this).prop('disabled',true);
            $.ajax({
                url:"{{ route('notificationStatusChange') }}",
                type:"POST",
                data:{
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    notiId:notificationId,
                    status:notificationStatus,
                },
                success:function(data){
                    if(data['success']){
                        $('.slider_checkbox').prop('disabled',false);
                    }   
                    
                }
            }); 
        });
    });
</script>


@include('includes.admin.footer')



