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
                <div class="col-lg-2"><a class="btn btn-primary">Member Details</a></div>
                <div class="col-lg-2"><a  class="btn btn-primary">Activity & Documentation</a></div>
                <div class="col-lg-3"><a class="btn 
                @if(session('from_step_three')) btn-primary 
                    @else btn-outline-primary 
                    @endif">About your organisation</a></div>
                <div class="col-lg-3"><a class="btn btn-outline-primary">Agreements & Networks</a></div>
                <div class="col-lg-2 text-center"><a class="btn btn-outline-primary">Submission</a></div>
            </div>
            <div class="row my-3 align-items-center ">
                <div class="col-lg-11">
                    <div class="mb-3 small"></div>
                    <div class="progress ">
                        <div class="progress-bar" role="progressbar" style="width: 75%"
                            aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <div class="col-lg-1" style="padding-top: 13px !important;">
                    <strong class="text-center text-gray-800" >75%</strong>
                </div>
            </div>
        </div>
        <div class="card-body">

            <form class="user" action="{{ route('memberformFour', session('members_id_sess') )}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group pb-2">
                            <label for="">Organisation Area (Please tick relevant box/es) <span class="field-fillup-required">*</span> </label>
                            <select name="organisation_area" class="form-control membership-from-select-field">
                                <option value="All of Wales">All of Wales</option>
                                <option value="All of Cardiff">All of Cardiff</option>
                                <option value="Cardiff City &amp; South">Cardiff City &amp; South</option>
                                <option value="Cardiff East">Cardiff East</option>
                                <option value="Cardiff North">Cardiff North</option>
                                <option value="Cardiff South-East">Cardiff South-East</option>
                                <option value="Cardiff South-West">Cardiff South-West</option>
                                <option value="Cardiff West">Cardiff West</option>
                            </select>
                        </div>

                        <div class="form-group pb-2">
                            <label for="">Are you / is your organisation part of a national or umbrella body?<span class="field-fillup-required">*</span> </label><br>
                            <input type="radio" name="organisation_part_of" value="yes"> Yes
                            <input type="radio" name="organisation_part_of" value="no"> No
                        </div>

                        <div class="form-group pb-2">
                            <label for="">National or umbrella body details:<span class="field-fillup-required">*</span> </label>
                            <input type="text" name="umbrella_body_details" class="form-control form-control-user">
                        </div>

                        <div class="form-group pb-2">
                            <label for="">Quality Marks / Accreditation (Select all that apply) </label>
                            <select name="quality_marks" class="form-control membership-from-select-field">
                                <option value="Trusted Charity">Trusted Charity</option>
                                <option value="Investor in Volunteering (IiV)">Investor in Volunteering (IiV)</option>
                                <option value="Investors in Personnel (IiP)">Investors in Personnel (IiP)</option>
                                <option value="Cyber Essentials">Cyber Essentials</option>
                                <option value="Cynnig Cymraeg (Welsh Offer)">Cynnig Cymraeg (Welsh Offer)</option>
                                <option value="Living Wage">Living Wage</option>
                                <option value="UK Investors in Equality in Diversity (UKIED)">UK Investors in Equality in Diversity (UKIED)</option>
                                <option value="Other  Quality Marks ">Other  Quality Marks </option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">Date accreditation was awarded:</label>
                            <input type="date" name="date_accreditation_awarded" class="form-control form-control-user" id="">
                            <small>Write each accreditation and its corresponding date.</small>
                        </div>

                        <div class="form-group">
                            <label for="">Date accreditation will be reviewed:</label>
                            <input type="date" name="date_accreditation_reviewed" class="form-control form-control-user" id="">
                            <small>Write each accreditation and its corresponding date.</small>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="">Most recent annual turnover in £ (GBP)</label>
                            <input type="text" name="annual_turnover" class="form-control form-control-user" id="">
                        </div>
                        <div class="form-group">
                            <label for="">What is the total number of staff you currently employ?<span class="field-fillup-required">*</span>
                            </label>
                            <input type="text" name="currently_employ" class="form-control form-control-user" id="">
                        </div>
                        <div class="form-group">
                            <label for="">How many volunteers are involved with you or in your group/organisation?<span class="field-fillup-required">*</span>
                            </label>
                            <input type="text" name="volunteers_number" class="form-control form-control-user" id="">
                        </div>
                        <div class="form-group pb-2">
                            <label for="">Are you registered on www.Volunteering-Wales.net?<span class="field-fillup-required">*</span> </label><br>
                            <input type="radio" name="registered_on" value="yes"> Yes
                            <input type="radio" name="registered_on" value="no"> No
                        </div>
                        <div class="form-group pb-2">
                            <label for="">Would you like support to recruit volunteers?<span class="field-fillup-required">*</span> </label><br>
                            <input type="radio" name="support_to_recruit_volunteers" value="yes"> Yes
                            <input type="radio" name="support_to_recruit_volunteers" value="no"> No
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg">
                        <label for="">C3SC is constantly looking at a range of bids and tender opportunities to submit applications to respond to identified areas of need. What do you feel as an organisation are the top 3 areas of need / opportunities for collaboration?</label>
                        <div class="form-group">
                            <label for="">Area 1</label>
                            <textarea name="collaboration_area_1" class="form-control form-control-user"></textarea>
                            <label for="">Area 2</label>
                            <textarea name="collaboration_area_2" class="form-control form-control-user"></textarea>
                            <label for="">Area 3</label>
                            <textarea name="collaboration_area_3" class="form-control form-control-user"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-4">
                        <a href="{{ route('memberformThreeView', session('members_id_sess')) }}" class="btn btn-success btn-user btn-block">back</a>
                    </div>
                    <div class="col-lg-4">
                        
                    </div>
                    <div class="col-lg-4">
                        <button class="btn btn-primary btn-user btn-block">Next</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>

@include('includes.members.footer')

