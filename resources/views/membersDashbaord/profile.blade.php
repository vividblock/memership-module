@include('includes.members.header')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Member Profile</h1>

        <a href="{{ route('memberformOneView',session('members_id_sess')) }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fa-solid fa-user-pen"></i> Edit Profile</a>
    </div>

    <!-- Profile Overview -->
    <div class="card shadow mb-4">
        <div class="card-header bg-primary text-white">
            Member Info
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6 mb-2">
                    <strong>Name:</strong> {{ $member->firstname }} {{ $member->lastname }}
                </div>
                <div class="col-md-6 mb-2">
                    <strong>Email:</strong> {{ $member->email }}
                </div>
                <div class="col-md-6 mb-2">
                    <strong>Username:</strong> {{ $member->username }}
                </div>
                <div class="col-md-6 mb-2">
                    <strong>Contact:</strong> 
                    {{ $member->contactnumber }}
                </div>
                <div class="col-md-6 mb-2">
                    <strong>C3SC ID:</strong> {{ $member->members_c3sc_id }}
                </div>
                <div class="col-md-6 mb-2">
                    <strong>Membership Type:</strong> 
                    @php
                        $types = [
                            "1" => "Non for profit - Group or Organisation",
                            "2" => "Non for profit - Individual",
                            "3" => "Statutory Sector",
                            "4" => "Private Sector"
                        ];
                    @endphp
                    {{ $types[$member->membership_type] ?? 'N/A' }}
                </div>
                <div class="col-md-6 mb-2">
                    <strong>Status:</strong>
                    @if($member->user_status)
                        <span class="badge badge-success">Active</span>
                    @else
                        @if($formStep->form_fillup_status === "submited")
                            <span class="badge badge-warning">In Review</span>
                        @elseif($formStep->form_fillup_status === "false")
                            span class="badge badge-danger">Inactive</span>
                        @endif
                    @endif
                </div>
                <div class="col-md-6 mb-2">
                    <strong>Membership Package:</strong> 
                    {{ $member->memebership_package ?? 'N/A' }}
                </div>
                
                    
            </div>
        </div>
    </div>

    <!-- Tabs for Additional Info -->
    <ul class="nav nav-tabs mb-3" id="profileTab" role="tablist">
        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#org">Organisation Information</a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#details">Organisational Details</a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#local">Local Activities</a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#interest">Interest</a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#survey">Survey</a></li>
    </ul>

    <div class="tab-content">
        <!-- Organisation -->
        <div class="tab-pane fade show active" id="org">
            @if($organisation)
            <div class="card shadow-sm mb-4 border-0">
                <!-- <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Organisation Information</h5>
                </div> -->
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6 mb-2">
                            <strong>Organisation Name:</strong> {{ $organisation->organisation_name }}
                        </div>
                        <div class="col-md-6 mb-2">
                            <strong>Email:</strong> {{ $organisation->organisation_email }}
                        </div>
                        <div class="col-md-6 mb-2">
                            <strong>Contact Number:</strong> {{ $organisation->contact_number ?? 'N/A' }}
                        </div>
                        <div class="col-md-6 mb-2">
                            <strong>Country:</strong> {{ $organisation->country ?? 'N/A' }}
                        </div>
                        <div class="col-md-6 mb-2">
                            <strong>Full Address:</strong>
                            {{ $organisation->correspondence_address }},
                            {{ $organisation->city }},
                            {{ $organisation->postcode }}
                        </div>
                        <div class="col-md-6 mb-2">
                            <strong>Postal Code:</strong> {{ $organisation->postcode ?? 'N/A' }}
                        </div>
                        <div class="col-md-6 mb-2">
                            <strong>Social Handles:</strong>
                            <div class="border rounded p-2 bg-light">
                                @if(is_array($organisation->social_handle))
                                    {{ implode(', ', $organisation->social_handle) }}
                                @elseif(is_string($organisation->social_handle) && Str::startsWith($organisation->social_handle, '['))
                                    {{ implode(', ', json_decode($organisation->social_handle, true)) }}
                                @else
                                    {{ $organisation->social_handle ?? 'N/A' }}
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <strong>Website:</strong>
                            @if($organisation->website)
                                <a href="{{ $organisation->website }}" target="_blank">{{ $organisation->website }}</a>
                            @else
                                N/A
                            @endif
                        </div>
                        <div class="col-md-12 mb-2">
                            <strong>Organisation Details:</strong>
                            <div class="border rounded p-2 bg-light">
                                @php
                                    $details = [];

                                    if (is_array($organisation->organization_details)) {
                                        $details = $organisation->organization_details;
                                    } elseif (is_string($organisation->organization_details) && \Illuminate\Support\Str::startsWith($organisation->organization_details, '[')) {
                                        $details = json_decode($organisation->organization_details, true);
                                    } elseif (is_string($organisation->organization_details)) {
                                        $details = [$organisation->organization_details];
                                    }
                                @endphp

                                @if (!empty($details))
                                    @foreach($details as $detail)
                                        <span class="badge badge-primary">
                                            {{ \Illuminate\Support\Str::of($detail)->replace('-', ' ')->title() }}
                                        </span>
                                    @endforeach
                                @else
                                    N/A
                                @endif
                            </div>
                        </div>

                        <div class="col-md-12">
                            <strong>Request Description:</strong>
                            <div class="border rounded p-2 bg-light">
                                {{ $organisation->organisation_request_descripiton ?? 'N/A' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @else
                <div class="alert alert-warning">No organisation information available.</div>
            @endif
        </div>


        <!-- Organisation Details -->
        <div class="tab-pane fade" id="details">
            @if($orgDetails)
            <div class="card blur-shadow mb-4">
                <!-- <div class="card-header">
                    <h5 class="mb-0">Organisational Details</h5>
                </div> -->
                <div class="card-body p-4">
                    <table class="table table-bordered table-hover">
                        <tbody>
                            <tr>
                                <th scope="row" style="width: 30%;">Organisation Description</th>
                                <td>{{ $orgDetails->org_description ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Organisation Area</th>
                                <td>{{ $orgDetails->organisation_area ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Part Of</th>
                                <td>{{ $orgDetails->organisation_part_of ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Umbrella Body Details</th>
                                <td>{{ $orgDetails->umbrella_body_details ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Quality Marks</th>
                                <td>{{ $orgDetails->quality_marks ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Accreditation Awarded</th>
                                <td>{{ optional($orgDetails->date_accreditation_awarded)->format('d M Y') ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Accreditation Reviewed</th>
                                <td>{{ optional($orgDetails->date_accreditation_reviewed)->format('d M Y') ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Annual Turnover</th>
                                <td>{{ $orgDetails->annual_turnover ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Employees</th>
                                <td>{{ $orgDetails->currently_employ ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Volunteers</th>
                                <td>{{ $orgDetails->volunteers_number ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Registered On</th>
                                <td>{{ $orgDetails->registered_on ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Supports Volunteer Recruitment</th>
                                <td>{{ $orgDetails->support_to_recruit_volunteers ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Collaboration Area 1</th>
                                <td>{{ $orgDetails->collaboration_area_1 ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Collaboration Area 2</th>
                                <td>{{ $orgDetails->collaboration_area_2 ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Collaboration Area 3</th>
                                <td>{{ $orgDetails->collaboration_area_3 ?? 'N/A' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            @else
                <div class="alert alert-info">No organisation details found.</div>
            @endif
        </div>


        <!-- Local Activities -->
        <div class="tab-pane fade" id="local">
            @if($activity)
            <div class="card blur-shadow mb-4">
                <!-- <div class="card-header">
                    <h5 class="mb-0">Local Activity: {{ $activity->name_of_group }}</h5>
                </div> -->
                <div class="card-body p-4">
                    <table class="table table-bordered table-hover">
                        <tbody>
                            <tr>
                                <th scope="row" style="width: 30%;">Frequency of Group Meetings</th>
                                <td>{{ $activity->frequency_of_group_meetings ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Activity Taking Place</th>
                                <td>{{ $activity->activity_taking_place ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Types of Activities</th>
                                <td>
                                    @php
                                        $types = is_array(json_decode($activity->type_of_activities, true)) 
                                            ? json_decode($activity->type_of_activities, true) 
                                            : [$activity->type_of_activities];
                                    @endphp
                                    @foreach($types as $type)
                                        <span class="badge badge-primary">{{ $type }}</span>
                                    @endforeach
                                    @if($activity->type_of_activities_other)
                                        <br><em>Other:</em> {{ $activity->type_of_activities_other }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Additional Information</th>
                                <td>{{ $activity->response_to_any_additional_information ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Receive Info from C3SC?</th>
                                <td>{{ $activity->receive_more_information_from_c3sc ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Promotion on Dewis Cymru Website?</th>
                                <td>{{ $activity->promotion_on_dewis_cymru_website ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Wants to Know More About Dewis Cymru?</th>
                                <td>{{ $activity->know_more_dewis_cymru ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Willing to Attend Events?</th>
                                <td>{{ $activity->attend_events ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>GDPR Consent</th>
                                <td>{{ $activity->gdpr ?? 'N/A' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            @else
            <div class="alert alert-info">No local activity data found.</div>
            @endif
        </div>


        <!-- Member Interest -->
        <div class="tab-pane fade" id="interest">
            @if($interest)
            <div class="card blur-shadow mb-4">
                <div class="card-header">Member Interests</div>
                <div class="card-body">
                    <p><strong>Activity:</strong> {{ $interest->your_activity }}</p>
                    <p><strong>Special Interest:</strong> {{ $interest->special_interest }}</p>
                    <p><strong>Description:</strong> {{ $interest->short_description }}</p>
                </div>
            </div>
            @endif
        </div>

        <!-- Survey -->
        <div class="tab-pane fade" id="survey">
            @if($survey)
            <div class="card blur-shadow mb-4">
                <div class="card-header">Network Survey</div>
                <div class="card-body">
                    <p><strong>Networks:</strong> {{ $survey->networks }}</p>
                    <p><strong>Discussion:</strong> {{ $survey->informal_discussion }}</p>
                    <p><strong>Signed:</strong> {{ $survey->member_signed }} on {{ $survey->member_signed_date }}</p>
                </div>
            </div>
            @endif
        </div>
    </div>

</div>

@include('includes.members.footer')
