@include('includes.members.header')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 dash-headings">Support</h1>
        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card border-left-primary shadow py-2" >
                <div class="card-header">
                    Please fill this form
                </div>
                <div class="card-body">
                    <form action="{{route('supportSubmit', session('members_id_sess'))}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">Urgency Level<span class="field-fillup-required">*</span></label>
                            <select name="urgency_lavel" class="form-control membership-from-select-field">
                                <option selected>Please select</option>
                                <option value="1" >Today</option>
                                <option value="2" >Next Few days</option>
                                <option value="3" >Not Urgent</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Subject<span class="field-fillup-required">*</span></label>
                            <input type="text" class="form-control form-control-user" name="subject">
                        </div>
                        <div class="form-group">
                            <label for="">Description<span class="field-fillup-required">*</span></label>
                            <textarea name="description" class="form-control form-control-user" id=""></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-bottom-primary shadow py-2" >
                <div class="card-header">
                    Your previous requests
                </div>
                <div class="card-body">
                @foreach($support_list as $support)
                    @php
                        // Set border class based on urgency
                        switch ($support->urgency_lable) {
                            case 1:  $borderClass = 'border-left-danger'; break;    // Today
                            case 2:  $borderClass = 'border-left-warning'; break;   // Next Few Days
                            case 3:  $borderClass = 'border-left-success'; break;   // Not Urgent
                            default: $borderClass = 'border-left-secondary';
                        }

                        // Truncate description to 10 words
                        $words = explode(' ', strip_tags($support->support_message));
                        $shortMessage = implode(' ', array_slice($words, 0, 10)) . (count($words) > 10 ? '...' : '');
                    @endphp

                    <div class="card mb-3 shadow-sm {{ $borderClass }}">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="badge bg-primary">{{ ucfirst($support->support_status) }}</span>
                                <small class="text-muted">Created: {{ \Carbon\Carbon::parse($support->created_at)->format('d M Y, H:i') }}</small>
                            </div>
                            <h5 class="card-title text-primary">{{ $support->support_subject }}</h5>
                            <p class="card-text mb-0">{{ $shortMessage }}</p>
                        </div>
                    </div>
                @endforeach

                </div>
            </div>
        </div>

    </div>

   


 </div>
<!-- /.container-fluid -->






@include('includes.members.footer')