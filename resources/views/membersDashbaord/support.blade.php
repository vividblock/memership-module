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
            <div class="card border-top-primary shadow py-2" >

            </div>
        </div>

    </div>

   


 </div>
<!-- /.container-fluid -->






@include('includes.members.footer')