@include('includes.members.header')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 dash-headings">Membership form</h1>
        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
    </div>

    <div class="card shadow py-2">
        <div class="card-header">
            <h2 class="h3 text-gray-800 membership-dashbaord-from-heading">Membership Application Details</h2>
            <p >Please complete all relevant sections below:</p>
            <div class="row mt-3">
                <div class="col-lg-2 text-center"><a class="btn btn-primary">Member & Organisation</a></div>
                <div class="col-lg-2 text-center"><a  class="btn btn-primary">Activity & Documentation</a></div>
                <div class="col-lg-3 text-center"><a class="btn btn-primary">About your organisation</a></div>
                <div class="col-lg-3 text-center"><a class="btn
                @if(session('from_step_four')) btn-primary 
                @else btn-outline-primary 
                @endif">Agreements & Networks</a></div>
                <div class="col-lg-2 text-center"><a class="btn btn-outline-primary">Submission</a></div>
            </div>
            <div class="row my-3 align-items-center ">
                <div class="col-lg-11">
                    <div class="mb-3  small"></div>
                    <div class="progress ">
                        <div class="progress-bar" role="progressbar" style="width: 99%"
                            aria-valuenow="99" aria-valuemin="0" aria-valuemax="99"></div>
                    </div>
                </div>
                <div class="col-lg-1" style="padding-top: 13px !important;">
                    <strong class="text-center text-gray-800" >99%</strong>
                </div>
            </div>
        </div>
        <div class="card-body">

            <form class="user" action="{{ route('memberformFive', session('members_id_sess') )}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="">Please specify which themes are your key areas of interest: (feel free to select more than one) </label>
                            <select name="networks" class="form-control membership-from-select-field">
                                <option value="BME people and communities ">BME people and communities </option>
                                <option value="Children, Young People and Families (Starting well) ">Children, Young People and Families (Starting well) </option>
                                <option value="Education, learning and employment ">Education, learning and employment </option>
                                <option value="Environmental sustainability  ">Environmental sustainability  </option>
                                <option value="Equality and Diversity/ Human Rights  ">Equality and Diversity/ Human Rights  </option>
                                <option value="Enterprise and learning ">Enterprise and learning </option>
                                <option value="Health, Social Care and Well-being ">Health, Social Care and Well-being </option>
                                <option value="Older People (Aging Well) ">Older People (Aging Well) </option>
                                <option value="Safer and Cohesive Communities">Safer and Cohesive Communities</option>
                                <option value="Trustees/Governance ">Trustees/Governance </option>
                                <option value="Volunteer Coordination ">Volunteer Coordination </option>
                                <option value="None of the above">None of the above</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">If none of the above, suggest a theme/network of interest: </label>
                            <input type="text" name="network_interst" class="form-control form-control-user" id="">
                        </div>
                        <div class="form-group">
                            <label for="">We are interested in connecting with our members for an informal discussion.</label><br>
                            <input type="checkbox" name="informal_discussion" id=""><span class="checkbox-fields-label">If you would be interested for one of C3SC’s team or trustees to get in touch and arrange a discussion with you please tick this box</span>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <input type="checkbox" class="checkbox-fields-input" name="how_to_use_this" id=""><span class="checkbox-fields-label">If you do not want your details to be used in this way, then please tick this box.</span><br>
                            <small>Please note: If you do not tick this box, your details will appear in our directories.</small>
                        </div>
                        <div class="form-group">
                        <label for="">Do you give us permission to contact you if an opportunity arises for us to use your details in our digital and print communications – such as on or website, social media, and/or any publications - or if you have the opportunity to be featured in the media?<span class="field-fillup-required">*</span> </label><br>
                        <input type="radio"  name="how_u_use_this_details_media" id="">Yes<br>
                        <input type="radio" name="how_u_use_this_details_media" id="">No<br>
                        <small>Note: digital communications may be available online indefinitely. Please visit the Privacy Notice page on our website to understand how we will use the information you provide.</small>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <h4>
                            Email Updates
                        </h4>
                        <p>When you become a member of Cardiff Third Sector Council you will receive essential emails from us regarding your membership, as well as updates - with news, funding opportunities, job vacancies, and more. Should you prefer not to receive the updates you will have the opportunity to unsubscribe from them at any time.</p>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Date Signed<span class="field-fillup-required">*</span></label>
                                    <input type="date" name="member_signed_date" class="form-control from-control-user" id="">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Electronic Signature<span class="field-fillup-required">*</span></label>
                                    <input type="text" name="member_signed" class="form-control from-control-user" id="">
                                    <small>Please write your full name to sign this application.</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-4">
                        <a href="{{ route('memberformOneView', session('members_id_sess')) }}" class="btn btn-success btn-user btn-block">back</a>
                    </div>
                    <div class="col-lg-4">
                        
                    </div>
                    <div class="col-lg-4">
                        <button class="btn btn-primary btn-user btn-block">
                            @if(session('membershiptype_sess') == "2")
                                Submit
                            @else
                                Next
                            @endif

                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>

@include('includes.members.footer')

