@include('includes.admin.header')

<div class="container-fluid pb-5">
    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
        <h1 class="h3 text-primary fw-bold">Application Details</h1>
    </div>

    <div class="row g-4">
        {{-- Member Details --}}
        <div class="col-md-6 mb-2">
            <div class="card shadow rounded-4 border border-primary-subtle">
                <div class="card-header bg-primary text-white rounded-top-4 border-bottom">
                    <h5 class="mb-0">Member Details</h5>
                </div>
                <div class="card-body">
                    <hr class="my-2">
                    <ul class="list-unstyled">
                        <li><strong>Name:</strong> {{ $members->firstname }} {{ $members->lastname }}</li><hr>
                        <li><strong>Member ID:</strong> {{ $members->members_c3sc_id }}</li><hr>
                        <li><strong>Username:</strong> {{ $members->username }}</li><hr>
                        <li><strong>Email:</strong> {{ $members->email }}</li><hr>
                        <li><strong>Contact Number:</strong> {{ $members->contactnumber }}</li><hr>
                        <li><strong>Membership Package:</strong> {{ $members->memebership_package }}</li><hr>
                        <li><strong>Membership Type:</strong> {{ $members->membership_type }}</li><hr>
                        <li><strong>Membership Expiry:</strong> {{ $members->membership_expiry }}</li><hr>
                        <li><strong>Apply Date:</strong> {{ $members->created_at->format('d M Y') }}</li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- Organisation Details --}}
        <div class="col-md-6 mb-2">
            <div class="card shadow rounded-4 border border-success-subtle">
                <div class="card-header bg-success text-white rounded-top-4 border-bottom">
                    <h5 class="mb-0">Organisation Details</h5>
                </div>
                <div class="card-body">
                    <hr class="my-2">
                    <ul class="list-unstyled">
                        <li><strong>Name:</strong> {{ $organisation->organisation_name }}</li><hr>
                        <li><strong>Email:</strong> {{ $organisation->organisation_email }}</li><hr>
                        <li><strong>Contact Number:</strong> {{ $organisation->contact_number }}</li><hr>
                        <li><strong>Address:</strong> {{ $organisation->correspondence_address }}</li><hr>
                        <li><strong>City:</strong> {{ $organisation->city }}</li><hr>
                        <li><strong>Postal Code:</strong> {{ $organisation->postcode }}</li><hr>
                        <li><strong>Country:</strong> {{ $organisation->country }}</li><hr>
                        <li><strong>Social Handle:</strong> {{ $organisation->social_handle }}</li><hr>
                        <li><strong>Website:</strong> {{ $organisation->website }}</li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- Organisation Description --}}
        <div class="col-md-12 mb-2">
            <div class="card shadow rounded-4 border border-info-subtle">
                <div class="card-header bg-info text-white rounded-top-4 border-bottom">
                    <h5 class="mb-0">Organisation Description</h5>
                </div>
                <div class="card-body">
                    <hr class="my-2">
                    <p><strong>Details:</strong> {{ $organisation->organization_details }}</p><hr>
                    <p><strong>Request Description:</strong> {{ $organisation->organisation_request_descripiton }}</p>
                </div>
            </div>
        </div>

        {{-- Extended Organisation Details --}}
        @if ($organisation_details)
        <div class="col-md-6 mb-2">
            <div class="card shadow rounded-4 border border-warning-subtle">
                <div class="card-header bg-warning text-dark rounded-top-4 border-bottom">
                    <h5 class="mb-0">Additional Organisation Info</h5>
                </div>
                <div class="card-body">
                    <hr class="my-2">
                    <ul class="list-unstyled">
                        <li><strong>Description:</strong> {{ $organisation_details->org_description }}</li><hr>
                        <li><strong>Area:</strong> {{ $organisation_details->organisation_area }}</li><hr>
                        <li><strong>Part Of:</strong> {{ $organisation_details->organisation_part_of }}</li><hr>
                        <li><strong>Umbrella Body:</strong> {{ $organisation_details->umbrella_body_details }}</li><hr>
                        <li><strong>Quality Marks:</strong> {{ $organisation_details->quality_marks }}</li><hr>
                        <li><strong>Accreditation Awarded:</strong> {{ $organisation_details->date_accreditation_awarded }}</li><hr>
                        <li><strong>Accreditation Reviewed:</strong> {{ $organisation_details->date_accreditation_reviewed }}</li><hr>
                        <li><strong>Annual Turnover:</strong> {{ $organisation_details->annual_turnover }}</li><hr>
                        <li><strong>Employees:</strong> {{ $organisation_details->currently_employ }}</li><hr>
                        <li><strong>Volunteers:</strong> {{ $organisation_details->volunteers_number }}</li>
                    </ul>
                </div>
            </div>
        </div>
        @endif

        {{-- Local Activities --}}
        @if ($organisation_local_activities)
        <div class="col-md-6 mb-2">
            <div class="card shadow rounded-4 border border-secondary-subtle">
                <div class="card-header bg-secondary text-white rounded-top-4 border-bottom">
                    <h5 class="mb-0">Local Activities</h5>
                </div>
                <div class="card-body">
                    <hr class="my-2">
                    <ul class="list-unstyled">
                        <li><strong>Group Name:</strong> {{ $organisation_local_activities->name_of_group }}</li><hr>
                        <li><strong>Meeting Frequency:</strong> {{ $organisation_local_activities->frequency_of_group_meetings }}</li><hr>
                        <li><strong>Activity Taking Place:</strong> {{ $organisation_local_activities->activity_taking_place }}</li><hr>
                        @php $activities = json_decode($organisation_local_activities->type_of_activities, true); @endphp
                        <li><strong>Type of Activities:</strong>
                            {{ is_array($activities) ? implode(', ', $activities) : $organisation_local_activities->type_of_activities }}
                        </li><hr>
                        <li><strong>Other Activities:</strong> {{ $organisation_local_activities->type_of_activities_other }}</li><hr>
                        <li><strong>Additional Info:</strong> {{ $organisation_local_activities->response_to_any_additional_information }}</li><hr>
                        <li><strong>Receive Info from C3SC:</strong> {{ $organisation_local_activities->receive_more_information_from_c3sc }}</li><hr>
                        <li><strong>Dewis Cymru Promotion:</strong> {{ $organisation_local_activities->promotion_on_dewis_cymru_website }}</li>
                    </ul>
                </div>
            </div>
        </div>
        @endif

        {{-- Network Survey --}}
        @if ($member_network_survey)
        <div class="col-md-12 mb-2">
            <div class="card shadow rounded-4 border border-dark-subtle">
                <div class="card-header bg-dark text-white rounded-top-4 border-bottom">
                    <h5 class="mb-0">Network Survey</h5>
                </div>
                <div class="card-body">
                    <hr class="my-2">
                    <ul class="list-unstyled">
                        <li><strong>Networks:</strong> {{ $member_network_survey->networks }}</li><hr>
                        <li><strong>Network Interest:</strong> {{ $member_network_survey->network_interst }}</li><hr>
                        <li><strong>Informal Discussions:</strong> {{ $member_network_survey->informal_discussion }}</li><hr>
                        <li><strong>How to Use:</strong> {{ $member_network_survey->how_to_use_this }}</li><hr>
                        <li><strong>Media Details:</strong> {{ $member_network_survey->how_u_use_this_details_media }}</li><hr>
                        <li><strong>Signed By:</strong> {{ $member_network_survey->member_signed }}</li><hr>
                        <li><strong>Signed Date:</strong> {{ $member_network_survey->member_signed_date }}</li>
                    </ul>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

@include('includes.admin.footer')
