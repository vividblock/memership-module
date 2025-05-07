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
                <div class="col-lg-3"><a class="btn btn-primary">Member Details</a></div>
                <div class="col-lg-3">
                <a class="btn btn-outline-primary ">Your Activity</a></div>
                <div class="col-lg-3"><a class="btn btn-outline-primary">1. Member Details</a></div>
                <div class="col-lg-3"><a class="btn btn-outline-primary">1. Member Details</a></div>
            </div>


            @php
                $currentStep = (int) $form_steps->form_steps;
                $totalSteps = (int) $form_steps->member_total_step;
                $progressPercent = $totalSteps > 0 ? round(($currentStep / $totalSteps) * 100) : 0;
            @endphp
            <div class="row my-3 align-items-center ">
                <div class="col-lg-11">
                    <div class="mb-3  small"></div>

                    <div class="progress">
                        <div 
                            class="progress-bar" 
                            role="progressbar" 
                            style="width: {{ $progressPercent }}%" 
                            aria-valuenow="{{ $progressPercent }}" 
                            aria-valuemin="0" 
                            aria-valuemax="100">
                        </div>
                    </div>
                </div>
                <div class="col-lg-1" style="padding-top: 13px !important;">
                    <strong class="text-center text-gray-800">{{ $progressPercent }}%</strong>
                </div>
            </div>


        </div>
        <div class="card-body">

            <form class="user" action="{{ route('membersformOne', session('members_id_sess') )}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label >Membership Type <span class="field-fillup-required">*</span> </label>
                            <select class="form-control membership-from-select-field" name="membershiptype" id="">
                                <option value="1" {{ $members->membership_type == 1 ? 'selected' : '' }} >Non for profit - Group or Organisation</option>
                                <option value="2" {{ $members->membership_type == 2 ? 'selected': '' }} >Non for profit - Individual</option>
                                <option value="3">Statutory Sector</option>
                                <option value="4">Private Sector</option>
                            </select>
                        </div>

                        <!-- <div class="form-group pt-3 pb-3">
                            <label for="">Organisation or Group Membership <span class="field-fillup-required">*</span></label><br>
                            
                            <input type="checkbox" class="checkbox-fields-input" name="organisation_details[]" value="not-for-profit-organisation-or-group">
                            <span class="checkbox-fields-label">We are a not-for-profit organisation or group</span><br>

                            <input type="checkbox" name="organisation_details[]" value="unpaid-committee">
                            <span class="checkbox-fields-label">We are run by an unpaid committee</span><br>

                            <input type="checkbox" name="organisation_details[]" value="serve-city-cardiff">
                            <span class="checkbox-fields-label">We are based in, or serve, the city of Cardiff</span><br>

                            <input type="checkbox" name="organisation_details[]" value="not-applicable">
                            <span class="checkbox-fields-label">Not Applicable</span><br>
                        </div> -->
                        @php
                            $raw = $organisation->organization_details ?? '[]';
                            dd($raw);
                            $selected = json_decode($raw, true);

                            if (!is_array($selected)) {
                                $selected = explode(',', $raw); // fallback to comma-separated
                            }
                        @endphp


                        <div class="form-group pt-3 pb-3">
                            <label for="">Organisation or Group Membership <span class="field-fillup-required">*</span></label><br>

                            <input type="checkbox" name="organisation_details[]" value="not-for-profit-organisation-or-group"
                                {{ in_array('not-for-profit-organisation-or-group', $selected) ? 'checked' : '' }}>
                            <span class="checkbox-fields-label">We are a not-for-profit organisation or group</span><br>

                            <input type="checkbox" name="organisation_details[]" value="unpaid-committee"
                                {{ in_array('unpaid-committee', $selected) ? 'checked' : '' }}>
                            <span class="checkbox-fields-label">We are run by an unpaid committee</span><br>

                            <input type="checkbox" name="organisation_details[]" value="serve-city-cardiff"
                                {{ in_array('serve-city-cardiff', $selected) ? 'checked' : '' }}>
                            <span class="checkbox-fields-label">We are based in, or serve, the city of Cardiff</span><br>

                            <input type="checkbox" name="organisation_details[]" value="not-applicable"
                                {{ in_array('not-applicable', $selected) ? 'checked' : '' }}>
                            <span class="checkbox-fields-label">Not Applicable</span><br>
                        </div>


                        <h6 class="text-gray-800 membership-registration-form-field-heading" style="padding-top: 60px;">Organisation Address</h6>
                        <hr>
                        <div class="form-group pt-3">
                            <label for="">Correspondence Address <span class="field-fillup-required">*</span> </label>
                            <input type="text" name="correspondence_address" value="{{ $organisation->correspondence_address }}" class="form-control form-control-user">
                            @if ($errors->has('correspondence_address'))
                                <span class="text-danger">{{ $errors->first('correspondence_address') }}</span>
                            @endif
                        </div>

                        <div class="form-group pt-3 pb-3">
                            <label for="">Country <span class="field-fillup-required">*</span> </label>
                            <input type="text" name="country" value="{{ $organisation->country }}" class="form-control form-control-user">
                            @if ($errors->has('country'))
                                <span class="text-danger">{{ $errors->first('country') }}</span>
                            @endif
                        </div>


                        <h6 class="text-gray-800 membership-registration-form-field-heading">Organisation Contact Details</h6>
                        <hr>


                        <div class="form-group">
                            <label for="">Email <span class="field-fillup-required">*</span> </label>
                            <input type="text" name="org_email" id="" class="form-control form-control-user" placeholder="Email" value="{{ $organisation->organisation_email }}">
                            @if ($errors->has('org_email'))
                                <span class="text-danger">{{ $errors->first('org_email') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="">Social Handles <span class="field-fillup-required">*</span> </label>
                            <input type="text" name="socail_handle" id="" class="form-control form-control-user" placeholder="@organization, @twitter, " value="{{ $organisation->social_handle  }}">
                            @if ($errors->has('socail_handle'))
                                <span class="text-danger">{{ $errors->first('socail_handle') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="">Email <span class="field-fillup-required">*</span> </label>
                            <input type="email" id="" class="form-control form-control-user" placeholder="Email" value="{{ $members->email }}" readonly >
                        </div>
                        <div class="form-group">
                            <label for="">Phone <span class="field-fillup-required">*</span> </label>
                            <input type="tel" name="contact_number" id="" class="form-control form-control-user" placeholder="Phone Number" value="{{ $members->contactnumber }}">
                            @if ($errors->has('contact_number'))
                                <span class="text-danger">{{ $errors->first('contact_number') }}</span>
                            @endif
                        </div>
                        <div class="form-group pt-3">
                            <label for=""> Group or Organisation Name <span class="field-fillup-required">*</span></label>
                            <input type="text" name="organization_name" id="" class="form-control form-control-user" placeholder="Group or Organisation Name" value="{{ $organisation->organisation_name }}">
                            <small>If you need support to set up a group, please email us <a href="mailto:enquiries@c3sc.org.uk">enquiries@c3sc.org.uk</a></small>
                            @if ($errors->has('organization_name'))
                                <span class="text-danger">{{ $errors->first('organization_name') }}</span>
                            @endif
                        </div>
                        <hr style="margin-top:54px;">
                        <div class="form-group" style="padding-top:15px;">
                            <label for="">City <span class="field-fillup-required">*</span> </label>
                            <input type="text" name="city" value="{{ $organisation->city }}" class="form-control form-control-user">
                            @if ($errors->has('city'))
                                <span class="text-danger">{{ $errors->first('city') }}</span>
                            @endif
                        </div>
                        <div class="form-group pt-3 ">
                            <label for="">Postcode <span class="field-fillup-required">*</span> </label>
                            <input type="text" name="postcode" value="{{ $organisation->postcode }}" class="form-control form-control-user">
                            @if ($errors->has('postcode'))
                                <span class="text-danger">{{ $errors->first('postcode') }}</span>
                            @endif
                        </div>
                        <hr style="margin-top:75px;">
                        <div class="form-group">
                            <label for="">Phone <span class="field-fillup-required">*</span> </label>
                            <input type="tel" name="org_contact_number" id="" class="form-control form-control-user" placeholder="Phone Number" value="{{ $organisation->contact_number }}">
                            @if ($errors->has('org_contact_number'))
                                <span class="text-danger">{{ $errors->first('org_contact_number') }}</span>
                            @endif
                        </div>

                        <div class="form-group" >
                            <label for="">Website <span class="field-fillup-required">*</span> </label>
                            <input type="text" name="website" id="" class="form-control form-control-user" placeholder="example.com" value="{{ $organisation->website }}">
                            @if ($errors->has('website'))
                                <span class="text-danger">{{ $errors->first('website') }}</span>
                            @endif
                        </div>
                        

                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4"></div>
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