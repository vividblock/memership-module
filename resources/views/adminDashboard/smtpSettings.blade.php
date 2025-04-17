@include('includes.admin.header')

<!-- Begin Page Content -->
<div class="container-fluid pb-5">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 admindash-headings">SMTP Intrigations</h1>
        @if ($smtp_data->status != 1 || $smtp_data->status == null)
        <a href="#" id="smtp-test-mail-setup-error" class="btn btn-danger btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-exclamation-triangle"></i>
            </span>
            
                <span class="text">SMTP settings are not configured yet. Please hit 'Test Mail' to activate email functionality.</span>
            
        </a>
        @endif
    </div>

<div class="row">
    <div class="col-lg-7">
        <div class="card border-left-primary shadow py-2">
            <div class="card-header">
                <h5>Configure SMTP server</h5>
            </div>
            <div class="card-body">
                <form action="{{route('smtpIntrigationSave')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Host</label>
                                <input type="text" name="smtp_host" value="{{$smtp_data->host}}" class="form-control form-control-user">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Port</label>
                                <input type="text" name="smtp_port" value="{{$smtp_data->port}}" class="form-control form-control-user">
                            </div>
                        </div>

                    </div>
                    <div class="form-group">
                        <label for="">Username</label>
                        <input type="text" name="smtp_username" value="{{$smtp_data->username}}" class="form-control form-control-user">
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="text" name="smtp_email" value="{{$smtp_data->email}}" class="form-control form-control-user">
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" name="smtp_password" value="{{$smtp_data->password}}" class="form-control form-control-user">
                    </div>
                    <div class="form-group">
                        <label for="">Protocol</label>
                        <select class="form-control membership-from-select-field" name="smtp_protocol" id="">
                            <option value="TLS" {{ $smtp_data->protocol == 'TLS' ? 'selected' : '' }}>TLS</option>
                            <option value="SSL" {{ $smtp_data->protocol == 'SSL' ? 'selected' : '' }}>SSL</option>
                        </select>
                    </div>
                    <div class="row">
                    
                        <div class="col-lg-6">
                        @if ($smtp_data->status != 1 || $smtp_data->status == null)
                            <span class="btn btn-warning" id="send-test-mail-box">Send Test Mail</span>
                        @endif
                        </div>

                        <div class="col-lg-6 text-right">
                            @if ($smtp_data->status != 1 || $smtp_data->status == null)
                                <button type="submit" class="btn btn-primary px-4">Save</button>
                            @else
                                <button type="submit" class="btn btn-primary px-4">Update</button>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="card border-left-warning shadow py-2" id="test-mail-box" style="display:none;">
            <div class="card-body">
                <div class="text-x font-weight-bold text-warning text-uppercase mb-1">Test mail reciver</div>
                <div class="form-group">
                    <label for="">please add reciver mail</label>
                    <input type="text" id="test_mail_reciver" class="form-control form-control-user">

                </div>
                <button class="btn btn-warning" id="send-test-main">Send</button>
            </div>
        </div>
    </div>
</div>



<!-- Script -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<script type="text/javascript">
    $(document).ready(function(){
        $("#send-test-mail-box").on("click", function(){
            $("#test-mail-box").css("display","block");
        });

        $("#send-test-main").on("click",function(){
            const testMail = $("#test_mail_reciver").val();
            $.ajax({
                url:"{{route('SendTestMail')}}",
                type:'POST',
                data:{
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    mailTest:testMail
                },
                success:function(data){
                    if(data['success']){
                        $("#smtp-test-mail-setup-error","#send-test-mail-box","#test-mail-box").css('display', 'none');
                        
                    }
                }
            });
        });

    });

</script>




</div>
<!-- /.container-fluid -->



@include('includes.admin.footer')

