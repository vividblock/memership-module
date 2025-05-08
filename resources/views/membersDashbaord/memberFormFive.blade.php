@include('includes.members.header')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 dash-headings">Membership form</h1>
    </div>

    <div class="card shadow py-2">
        @include('includes.members.members_form_header')

        <div class="card-body">
            <form class="user" action="{{ route('memberformFive', session('members_id_sess') )}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="">Please specify which themes are your key areas of interest: (feel free to select more than one) </label>
                            <select name="networks" class="form-control membership-from-select-field">
                                <option value="BME people and communities" {{ optional($member_network_survay)->networks == 'BME people and communities' ? 'selected' : '' }}>BME people and communities</option>
                                <option value="Children, Young People and Families (Starting well)" {{ optional($member_network_survay)->networks == 'Children, Young People and Families (Starting well)' ? 'selected' : '' }}>Children, Young People and Families (Starting well)</option>
                                <option value="Education, learning and employment" {{ optional($member_network_survay)->networks == 'Education, learning and employment' ? 'selected' : '' }}>Education, learning and employment</option>
                                <option value="Environmental sustainability" {{ optional($member_network_survay)->networks == 'Environmental sustainability' ? 'selected' : '' }}>Environmental sustainability</option>
                                <option value="Equality and Diversity/ Human Rights" {{ optional($member_network_survay)->networks == 'Equality and Diversity/ Human Rights' ? 'selected' : '' }}>Equality and Diversity/ Human Rights</option>
                                <option value="Enterprise and learning" {{ optional($member_network_survay)->networks == 'Enterprise and learning' ? 'selected' : '' }}>Enterprise and learning</option>
                                <option value="Health, Social Care and Well-being" {{ optional($member_network_survay)->networks == 'Health, Social Care and Well-being' ? 'selected' : '' }}>Health, Social Care and Well-being</option>
                                <option value="Older People (Aging Well)" {{ optional($member_network_survay)->networks == 'Older People (Aging Well)' ? 'selected' : '' }}>Older People (Aging Well)</option>
                                <option value="Safer and Cohesive Communities" {{ optional($member_network_survay)->networks == 'Safer and Cohesive Communities' ? 'selected' : '' }}>Safer and Cohesive Communities</option>
                                <option value="Trustees/Governance" {{ optional($member_network_survay)->networks == 'Trustees/Governance' ? 'selected' : '' }}>Trustees/Governance</option>
                                <option value="Volunteer Coordination" {{ optional($member_network_survay)->networks == 'Volunteer Coordination' ? 'selected' : '' }}>Volunteer Coordination</option>
                                <option value="None of the above" {{ optional($member_network_survay)->networks == 'None of the above' ? 'selected' : '' }}>None of the above</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">If none of the above, suggest a theme/network of interest: </label>
                            <input type="text" name="network_interst" class="form-control form-control-user" value="{{ optional($member_network_survay)->network_interst ?? '' }}">
                        </div>

                        <div class="form-group">
                            <label for="">We are interested in connecting with our members for an informal discussion.</label><br>
                            <input type="checkbox" name="informal_discussion" {{ optional($member_network_survay)->informal_discussion == 'on' ? 'checked' : '' }}>
                            <span class="checkbox-fields-label">If you would be interested for one of C3SC’s team or trustees to get in touch and arrange a discussion with you please tick this box</span>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <input type="checkbox" class="checkbox-fields-input" name="how_to_use_this" {{ optional($member_network_survay)->how_to_use_this == 'on' ? 'checked' : '' }}>
                            <span class="checkbox-fields-label">If you do not want your details to be used in this way, then please tick this box.</span><br>
                            <small>Please note: If you do not tick this box, your details will appear in our directories.</small>
                        </div>

                        <div class="form-group">
                            <label for="">Do you give us permission to contact you if an opportunity arises for us to use your details in our digital and print communications – such as on or website, social media, and/or any publications - or if you have the opportunity to be featured in the media?<span class="field-fillup-required">*</span> </label><br>
                            <input type="radio" name="how_u_use_this_details_media" value="yes" {{ optional($member_network_survay)->how_u_use_this_details_media == 'yes' ? 'checked' : '' }}>Yes<br>
                            <input type="radio" name="how_u_use_this_details_media" value="no" {{ optional($member_network_survay)->how_u_use_this_details_media == 'no' ? 'checked' : '' }}>No<br>
                            <small>Note: digital communications may be available online indefinitely. Please visit the Privacy Notice page on our website to understand how we will use the information you provide.</small><br>
                            @if ($errors->has('how_u_use_this_details_media'))
                                <span class="text-danger">{{ $errors->first('how_u_use_this_details_media') }}</span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <h4>Email Updates</h4>
                        <p>When you become a member of Cardiff Third Sector Council you will receive essential emails from us regarding your membership, as well as updates - with news, funding opportunities, job vacancies, and more. Should you prefer not to receive the updates you will have the opportunity to unsubscribe from them at any time.</p>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Date Signed<span class="field-fillup-required">*</span></label>
                                    <input type="date" name="member_signed_date" class="form-control from-control-user" value="{{ optional($member_network_survay)->member_signed_date ?? '' }}">
                                </div>
                                @if ($errors->has('member_signed_date'))
                                    <span class="text-danger">{{ $errors->first('member_signed_date') }}</span>
                                @endif
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Electronic Signature<span class="field-fillup-required">*</span></label>
                                    <input type="text" name="member_signed" class="form-control from-control-user" value="{{ optional($member_network_survay)->member_signed ?? '' }}">
                                    <small>Please write your full name to sign this application.</small><br>
                                    @if ($errors->has('member_signed'))
                                        <span class="text-danger">{{ $errors->first('member_signed') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-lg-4">
                        <a href="{{ route('memberformOneView', session('members_id_sess')) }}" class="btn btn-success btn-user btn-block">back</a>
                    </div>
                    <div class="col-lg-4"></div>
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
