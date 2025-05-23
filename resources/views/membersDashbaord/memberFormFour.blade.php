@include('includes.members.header')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 dash-headings">Membership form</h1>
    </div>

    <div class="card shadow py-2">
        @include('includes.members.members_form_header')
        <div class="card-body">

            <form class="user" action="{{ route('memberformFour', session('members_id_sess') )}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group pb-2">
                            <label for="">Organisation Area (Please tick relevant boxes) <span class="field-fillup-required">*</span> </label>
                            <select name="organisation_area" class="form-control membership-from-select-field">
                                <option value="All of Wales" {{ optional($organisation_details)->organisation_area == 'All of Wales' ? 'selected' : '' }}>All of Wales</option>
                                <option value="All of Cardiff" {{ optional($organisation_details)->organisation_area == 'All of Cardiff' ? 'selected' : '' }}>All of Cardiff</option>
                                <option value="Cardiff City & South" {{ optional($organisation_details)->organisation_area == 'Cardiff City & South' ? 'selected' : '' }}>Cardiff City & South</option>
                                <option value="Cardiff East" {{ optional($organisation_details)->organisation_area == 'Cardiff East' ? 'selected' : '' }}>Cardiff East</option>
                                <option value="Cardiff North" {{ optional($organisation_details)->organisation_area == 'Cardiff North' ? 'selected' : '' }}>Cardiff North</option>
                                <option value="Cardiff South-East" {{ optional($organisation_details)->organisation_area == 'Cardiff South-East' ? 'selected' : '' }}>Cardiff South-East</option>
                                <option value="Cardiff South-West" {{ optional($organisation_details)->organisation_area == 'Cardiff South-West' ? 'selected' : '' }}>Cardiff South-West</option>
                                <option value="Cardiff West" {{ optional($organisation_details)->organisation_area == 'Cardiff West' ? 'selected' : '' }}>Cardiff West</option>
                            </select>
                            @if ($errors->has('organisation_area'))
                                <span class="text-danger">{{ $errors->first('organisation_area') }}</span>
                            @endif
                        </div>

                        <div class="form-group pb-2">
                            <label for="">Are you / is your organisation part of a national or umbrella body?<span class="field-fillup-required">*</span></label><br>

                            <input type="radio" name="organisation_part_of" value="yes"
                                {{ optional($organisation_details)->organisation_part_of == 'yes' ? 'checked' : '' }}> Yes

                            <input type="radio" name="organisation_part_of" value="no"
                                {{ optional($organisation_details)->organisation_part_of == 'no' ? 'checked' : '' }}> No

                            @if ($errors->has('organisation_part_of'))
                                <span class="text-danger">{{ $errors->first('organisation_part_of') }}</span>
                            @endif
                        </div>

                        <div class="form-group pb-2">
                            <label for="">National or umbrella body details:</label>
                            <input type="text" name="umbrella_body_details" value="{{ optional($organisation_details)->umbrella_body_details }}" class="form-control form-control-user">
                        </div>

                        <div class="form-group pb-2">
                            <label for="">Quality Marks / Accreditation (Select all that apply)</label>
                            <select name="quality_marks" class="form-control membership-from-select-field">
                                <option value="Trusted Charity" {{ optional($organisation_details)->quality_marks == 'Trusted Charity' ? 'selected' : '' }}>Trusted Charity</option>
                                <option value="Investor in Volunteering (IiV)" {{ optional($organisation_details)->quality_marks == 'Investor in Volunteering (IiV)' ? 'selected' : '' }}>Investor in Volunteering (IiV)</option>
                                <option value="Investors in Personnel (IiP)" {{ optional($organisation_details)->quality_marks == 'Investors in Personnel (IiP)' ? 'selected' : '' }}>Investors in Personnel (IiP)</option>
                                <option value="Cyber Essentials" {{ optional($organisation_details)->quality_marks == 'Cyber Essentials' ? 'selected' : '' }}>Cyber Essentials</option>
                                <option value="Cynnig Cymraeg (Welsh Offer)" {{ optional($organisation_details)->quality_marks == 'Cynnig Cymraeg (Welsh Offer)' ? 'selected' : '' }}>Cynnig Cymraeg (Welsh Offer)</option>
                                <option value="Living Wage" {{ optional($organisation_details)->quality_marks == 'Living Wage' ? 'selected' : '' }}>Living Wage</option>
                                <option value="UK Investors in Equality in Diversity (UKIED)" {{ optional($organisation_details)->quality_marks == 'UK Investors in Equality in Diversity (UKIED)' ? 'selected' : '' }}>UK Investors in Equality in Diversity (UKIED)</option>
                                <option value="Other  Quality Marks" {{ optional($organisation_details)->quality_marks == 'Other  Quality Marks' ? 'selected' : '' }}>Other Quality Marks</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">Date accreditation was awarded:</label>
                            <input type="date" name="date_accreditation_awarded" class="form-control form-control-user" 
                                value="{{ optional(optional($organisation_details)->date_accreditation_awarded)->format('Y-m-d') }}">
                            <small>Write each accreditation and its corresponding date.</small>
                        </div>

                        <div class="form-group">
                            <label for="">Date accreditation will be reviewed:</label>
                            <input type="date" name="date_accreditation_reviewed" class="form-control form-control-user"
                                value="{{ optional(optional($organisation_details)->date_accreditation_reviewed)->format('Y-m-d') }}">
                            <small>Write each accreditation and its corresponding date.</small>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="">Most recent annual turnover in £ (GBP)</label>
                            <input type="text" name="annual_turnover" value="{{ optional($organisation_details)->annual_turnover }}" class="form-control form-control-user" id="">
                        </div>
                        <div class="form-group">
                            <label for="">What is the total number of staff you currently employ?<span class="field-fillup-required">*</span></label>
                            <input type="text" name="currently_employ" class="form-control form-control-user" 
                                value="{{ old('currently_employ', optional($organisation_details)->currently_employ) }}">
                            @if ($errors->has('currently_employ'))
                                <span class="text-danger">{{ $errors->first('currently_employ') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="">How many volunteers are involved with you or in your group/organisation?<span class="field-fillup-required">*</span></label>
                            <input type="text" name="volunteers_number" class="form-control form-control-user" 
                                value="{{ old('volunteers_number', optional($organisation_details)->volunteers_number) }}">
                            @if ($errors->has('volunteers_number'))
                                <span class="text-danger">{{ $errors->first('volunteers_number') }}</span>
                            @endif
                        </div>

                        <div class="form-group pb-2">
                            <label for="">Are you registered on www.Volunteering-Wales.net?<span class="field-fillup-required">*</span></label><br>
                            <input type="radio" name="registered_on" value="yes" 
                                {{ old('registered_on', optional($organisation_details)->registered_on) == 'yes' ? 'checked' : '' }}> Yes
                            <input type="radio" name="registered_on" value="no" 
                                {{ old('registered_on', optional($organisation_details)->registered_on) == 'no' ? 'checked' : '' }}> No

                            @if ($errors->has('registered_on'))
                                <span class="text-danger">{{ $errors->first('registered_on') }}</span>
                            @endif
                        </div>

                        <div class="form-group pb-2">
                            <label for="">Would you like support to recruit volunteers?<span class="field-fillup-required">*</span></label><br>
                            <input type="radio" name="support_to_recruit_volunteers" value="yes" 
                                {{ old('support_to_recruit_volunteers', optional($organisation_details)->support_to_recruit_volunteers) == 'yes' ? 'checked' : '' }}> Yes
                            <input type="radio" name="support_to_recruit_volunteers" value="no" 
                                {{ old('support_to_recruit_volunteers', optional($organisation_details)->support_to_recruit_volunteers) == 'no' ? 'checked' : '' }}> No
                            @if ($errors->has('support_to_recruit_volunteers'))
                                <span class="text-danger">{{ $errors->first('support_to_recruit_volunteers') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg">
                        <label for="">C3SC is constantly looking at a range of bids and tender opportunities to submit applications to respond to identified areas of need. What do you feel as an organisation are the top 3 areas of need / opportunities for collaboration?</label>
                        <div class="form-group">
                            <label for="">Area 1</label>
                            <textarea name="collaboration_area_1" class="form-control form-control-user">{{ optional($organisation_details)->collaboration_area_1 }}</textarea>

                            <label for="">Area 2</label>
                            <textarea name="collaboration_area_2" class="form-control form-control-user">{{ optional($organisation_details)->collaboration_area_2 }}</textarea>

                            <label for="">Area 3</label>
                            <textarea name="collaboration_area_3" class="form-control form-control-user">{{ optional($organisation_details)->collaboration_area_3 }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-4">
                        <a href="{{ route('memberformThreeView', session('members_id_sess')) }}" class="btn btn-success btn-user btn-block">back</a>
                    </div>
                    <div class="col-lg-4"></div>
                    <div class="col-lg-4">
                        <button class="btn btn-primary btn-user btn-block">Next</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>

@include('includes.members.footer')
