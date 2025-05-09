@include('includes.admin.header')

<div class="container-fluid pb-5">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 text-gray-800">Member Application Details</h1>
    </div>

    <div class="row">

        {{-- Member Details --}}
        <div class="col-md-6 mb-4">
            <div class="card shadow">
                <div class="card-header">
                    <h5 class="mb-0">Member Details</h5>
                </div>
                <div class="card-body">
                    <p><strong>Name:</strong> {{ $members->firstname }} {{ $members->lastname }}</p>
                    <p><strong>Member ID:</strong> {{ $members->members_c3sc_id }}</p>
                    <p><strong>Username:</strong> {{ $members->username }}</p>
                    <p><strong>Email:</strong> {{ $members->email }}</p>
                    <p><strong>Contact Number:</strong> {{ $members->contactnumber }}</p>
                    <p><strong>Membership Package:</strong> {{ $members->memebership_package }}</p>
                    <p><strong>Membership Type:</strong> {{ $members->membership_type }}</p>
                    <p><strong>Membership Expiry:</strong> {{ $members->membership_expiry }}</p>
                    <p><strong>Apply Date:</strong> {{ $members->created_at->format('d M Y') }}</p>
                </div>
            </div>
        </div>

        {{-- Organisation Details --}}
        <div class="col-md-6 mb-4">
            <div class="card shadow">
                <div class="card-header">
                    <h5 class="mb-0">Organisation Details</h5>
                </div>
                <div class="card-body">
                    <p><strong>Name:</strong> {{ $organisation->organisation_name }}</p>
                    <p><strong>Email:</strong> {{ $organisation->organisation_email }}</p>
                    <p><strong>Contact Number:</strong> {{ $organisation->contact_number }}</p>
                    <p><strong>Address:</strong> {{ $organisation->correspondence_address }}</p>
                    <p><strong>City:</strong> {{ $organisation->city }}</p>
                    <p><strong>Postal Code:</strong> {{ $organisation->postcode }}</p>
                    <p><strong>Country:</strong> {{ $organisation->country }}</p>
                    <p><strong>Social Handle:</strong> {{ $organisation->social_handle }}</p>
                    <p><strong>Website:</strong> {{ $organisation->website }}</p>
                </div>
            </div>
        </div>

        {{-- Organisation Description --}}
        <div class="col-md-12 mb-4">
            <div class="card shadow">
                <div class="card-header">
                    <h5 class="mb-0">Organisation Description</h5>
                </div>
                <div class="card-body">
                    <p><strong>Details:</strong> {{ $organisation->organization_details }}</p>
                    <p><strong>Request Description:</strong> {{ $organisation->organisation_request_descripiton }}</p>
                </div>
            </div>
        </div>

        {{-- Extended Organisation Details --}}
        @if ($organisation_details)
        <div class="col-md-6 mb-4">
            <div class="card shadow">
                <div class="card-header">
                    <h5 class="mb-0">Additional Organisation Info</h5>
                </div>
                <div class="card-body">
                    <p><strong>Description:</strong> {{ $organisation_details->org_description }}</p>
                    <p><strong>Area:</strong> {{ $organisation_details->organisation_area }}</p>
                    <p><strong>Part Of:</strong> {{ $organisation_details->organisation_part_of }}</p>
                    <p><strong>Umbrella Body:</strong> {{ $organisation_details->umbrella_body_details }}</p>
                    <p><strong>Quality Marks:</strong> {{ $organisation_details->quality_marks }}</p>
                    <p><strong>Accreditation Awarded:</strong> {{ $organisation_details->date_accreditation_awarded }}</p>
                    <p><strong>Accreditation Reviewed:</strong> {{ $organisation_details->date_accreditation_reviewed }}</p>
                    <p><strong>Annual Turnover:</strong> {{ $organisation_details->annual_turnover }}</p>
                    <p><strong>Employees:</strong> {{ $organisation_details->currently_employ }}</p>
                    <p><strong>Volunteers:</strong> {{ $organisation_details->volunteers_number }}</p>
                </div>
            </div>
        </div>
        @endif

        {{-- Local Activities --}}
        @if ($organisation_local_activities)
        <div class="col-md-6 mb-4">
            <div class="card shadow">
                <div class="card-header">
                    <h5 class="mb-0">Local Activities</h5>
                </div>
                <div class="card-body">
                    <p><strong>Group Name:</strong> {{ $organisation_local_activities->name_of_group }}</p>
                    <p><strong>Meeting Frequency:</strong> {{ $organisation_local_activities->frequency_of_group_meetings }}</p>
                    <p><strong>Activity Taking Place:</strong> {{ $organisation_local_activities->activity_taking_place }}</p>
                    <p><strong>Type of Activities:</strong> {{ implode(', ', json_decode($organisation_local_activities->type_of_activities ?? '[]')) }}</p>
                    <p><strong>Other Activities:</strong> {{ $organisation_local_activities->type_of_activities_other }}</p>
                    <p><strong>Additional Info:</strong> {{ $organisation_local_activities->response_to_any_additional_information }}</p>
                    <p><strong>Receive Info from C3SC:</strong> {{ $organisation_local_activities->receive_more_information_from_c3sc }}</p>
                    <p><strong>Dewis Cymru Promotion:</strong> {{ $organisation_local_activities->promotion_on_dewis_cymru_website }}</p>
                </div>
            </div>
        </div>
        @endif

        {{-- Network Survey --}}
        @if ($member_network_survey)
        <div class="col-md-12 mb-4">
            <div class="card shadow">
                <div class="card-header">
                    <h5 class="mb-0">Network Survey</h5>
                </div>
                <div class="card-body">
                    <p><strong>Networks:</strong> {{ $member_network_survey->networks }}</p>
                    <p><strong>Network Interest:</strong> {{ $member_network_survey->network_interst }}</p>
                    <p><strong>Informal Discussions:</strong> {{ $member_network_survey->informal_discussion }}</p>
                    <p><strong>How to Use:</strong> {{ $member_network_survey->how_to_use_this }}</p>
                    <p><strong>Media Details:</strong> {{ $member_network_survey->how_u_use_this_details_media }}</p>
                    <p><strong>Signed By:</strong> {{ $member_network_survey->member_signed }}</p>
                    <p><strong>Signed Date:</strong> {{ $member_network_survey->member_signed_date }}</p>
                </div>
            </div>
        </div>
        @endif

    </div>
</div>

@include('includes.admin.footer')
