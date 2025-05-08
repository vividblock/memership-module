@include('includes.members.header')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 dash-headings">Membership form</h1>
        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
    </div>

    <div class="card shadow py-2">
        @include('includes.members.members_form_header')
        <div class="card-body">

            <form class="user" action="{{ route('memberformSix', session('members_id_sess') )}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="">1. Name of Group</label>
                            <input type="text" class="form-control form-control-user" name="name_of_group" value="{{ $org_local_activity_details->name_of_group ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label for="">2. When - how often does the group meet</label>
                            <select name="frequency_of_group_meetings" class="form-control membership-from-select-field">
                                <option value="Daily" {{ $org_local_activity_details->frequency_of_group_meetings == 'Daily' ? 'selected' : '' }}>Daily</option>
                                <option value="Weekly" {{ $org_local_activity_details->frequency_of_group_meetings == 'Weekly' ? 'selected' : '' }}>Weekly</option>
                                <option value="Monthly" {{ $org_local_activity_details->frequency_of_group_meetings == 'Monthly' ? 'selected' : '' }}>Monthly</option>
                                <option value="Other" {{ $org_local_activity_details->frequency_of_group_meetings == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">3. Where is the activity taking place?</label>
                            <input type="text" class="form-control form-control-user" name="activity_taking_place" value="{{ $org_local_activity_details->activity_taking_place ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label for="">4. What type of activities does the group do/provide? Please tick all the boxes that apply</label>
                            <select name="type_of_activities[]" class="form-control membership-from-select-field" multiple>
                                <option value="Meeting Rooms" {{ in_array('Meeting Rooms', explode(',', $org_local_activity_details->type_of_activities ?? '')) ? 'selected' : '' }}>Meeting Rooms</option>
                                <option value="Physical Activities" {{ in_array('Physical Activities', explode(',', $org_local_activity_details->type_of_activities ?? '')) ? 'selected' : '' }}>Physical Activities</option>
                                <option value="Mental Wellbeing" {{ in_array('Mental Wellbeing', explode(',', $org_local_activity_details->type_of_activities ?? '')) ? 'selected' : '' }}>Mental Wellbeing</option>
                                <option value="Advice / Support" {{ in_array('Advice / Support', explode(',', $org_local_activity_details->type_of_activities ?? '')) ? 'selected' : '' }}>Advice / Support</option>
                                <option value="Arts and Crafts" {{ in_array('Arts and Crafts', explode(',', $org_local_activity_details->type_of_activities ?? '')) ? 'selected' : '' }}>Arts and Crafts</option>
                                <option value="Education and skills building" {{ in_array('Education and skills building', explode(',', $org_local_activity_details->type_of_activities ?? '')) ? 'selected' : '' }}>Education and skills building</option>
                                <option value="Parent and toddler" {{ in_array('Parent and toddler', explode(',', $org_local_activity_details->type_of_activities ?? '')) ? 'selected' : '' }}>Parent and toddler</option>
                                <option value="Social" {{ in_array('Social', explode(',', $org_local_activity_details->type_of_activities ?? '')) ? 'selected' : '' }}>Social</option>
                                <option value="Environmental" {{ in_array('Environmental', explode(',', $org_local_activity_details->type_of_activities ?? '')) ? 'selected' : '' }}>Environmental</option>
                                <option value="Young people" {{ in_array('Young people', explode(',', $org_local_activity_details->type_of_activities ?? '')) ? 'selected' : '' }}>Young people</option>
                                <option value="Other" {{ in_array('Other', explode(',', $org_local_activity_details->type_of_activities ?? '')) ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">If other, please specify</label>
                            <input type="text" class="form-control form-control-user" name="type_of_activities_other" value="{{ $org_local_activity_details->type_of_activities_other ?? '' }}">
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="">5. Please provide any additional information to allow us to gain a clear picture of the group/service.</label>
                            <input type="text" name="response_to_any_additional_information" class="form-control form-control-user" value="{{ $org_local_activity_details->response_to_any_additional_information ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label for="">6. Would the group like to receive more information about C3SC?</label>
                            <select name="receive_more_information_from_c3sc" class="form-control membership-from-select-field">
                                <option value="Yes" {{ $org_local_activity_details->receive_more_information_from_c3sc == 'Yes' ? 'selected' : '' }}>Yes</option>
                                <option value="No" {{ $org_local_activity_details->receive_more_information_from_c3sc == 'No' ? 'selected' : '' }}>No</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="7">7. Is the group currently promoted on the Dewis Cymru website?</label>
                            <select name="promotion_on_dewis_cymru_website" class="form-control membership-from-select-field">
                                <option value="Yes" {{ $org_local_activity_details->promotion_on_dewis_cymru_website == 'Yes' ? 'selected' : '' }}>Yes</option>
                                <option value="No" {{ $org_local_activity_details->promotion_on_dewis_cymru_website == 'No' ? 'selected' : '' }}>No</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="8">8. Would the group like to know more about Dewis Cymru?</label>
                            <select name="know_more_dewis_cymru" class="form-control membership-from-select-field">
                                <option value="Yes" {{ $org_local_activity_details->know_more_dewis_cymru == 'Yes' ? 'selected' : '' }}>Yes</option>
                                <option value="No" {{ $org_local_activity_details->know_more_dewis_cymru == 'No' ? 'selected' : '' }}>No</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="9">9. Would your group be interested in finding out about or attending events which bring other local groups and projects together?</label>
                            <select name="attend_events" class="form-control membership-from-select-field">
                                <option value="Yes" {{ $org_local_activity_details->attend_events == 'Yes' ? 'selected' : '' }}>Yes</option>
                                <option value="No" {{ $org_local_activity_details->attend_events == 'No' ? 'selected' : '' }}>No</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="10">10. GDPR: Please read the statements below and give consent where applicable by selecting the tick box or choose not to share the groups contact details. C3SC may use the groups contact details in its mapping exercise and may share this information with other C3SC projects and its project partners.<span class="field-fillup-required">*</span></label>
                            <select name="gdpr" class="form-control membership-from-select-field">
                                <option value="C3SC may share the groups contact details with other Third Sector Organisations or community groups" {{ $org_local_activity_details->gdpr == 'C3SC may share the groups contact details with other Third Sector Organisations or community groups' ? 'selected' : '' }}>C3SC may share the groups contact details with other Third Sector Organisations or community groups</option>
                                <option value="Do not share this groups' contact details." {{ $org_local_activity_details->gdpr == 'Do not share this groups\' contact details.' ? 'selected' : '' }}>Do not share this groups' contact details.</option>
                            </select>
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
                        <button class="btn btn-primary btn-user btn-block">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>

@include('includes.members.footer')
