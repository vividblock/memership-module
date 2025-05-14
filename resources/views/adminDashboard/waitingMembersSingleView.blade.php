@include('includes.admin.header')

<div class="container-fluid pb-5">
    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
        <h1 class="h3 text-primary fw-bold">Member Application Details</h1>
    </div>

    <div class="row g-4">
        {{-- Member Details --}}
        <div class="col-md-6 mb-2">
            <div class="card shadow rounded-4 border border-primary-subtle">
                <div class="card-header bg-primary text-white rounded-top-4 border-bottom d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Member Details</h5>
                    <span class="edit-member-details-button"><i class="fa-solid fa-pen-to-square"></i></span>
                </div>
                <div class="card-body">
                    <hr class="my-2">
                    <table class="table table-borderless mb-0">
                        <tbody>
                            <tr>
                                <td><strong>Name</strong></td>
                                <td>
                                    <input type="text" class="form-control" readonly value="{{ $members->firstname }} {{ $members->lastname }}">
                                </td>
                            </tr>
                            <tr><td><strong>Member ID</strong></td><td>{{ $members->members_c3sc_id }}</td></tr>
                            <tr><td><strong>Username</strong></td><td>{{ $members->username }}</td></tr>
                            <tr><td><strong>Email</strong></td><td>{{ $members->email }}</td></tr>
                            <tr>
                                <td><strong>Contact Number</strong></td>
                                <td>
                                    <input type="text" class="form-control" readonly value="{{ $members->contactnumber }}">
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Membership Package</strong></td>
                                <td>
                                    <input type="text" class="form-control" readonly value="{{ $members->memebership_package }}">
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Membership Type</strong></td>
                                <td>
                                    <input type="text" class="form-control" readonly value="{{ $members->membership_type }}">
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Membership Expiry</strong></td>
                                <td>
                                    <input type="text" class="form-control" readonly value="{{ $members->membership_expiry }}">
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Apply Date</strong></td>
                                <td>
                                    <input type="text" class="form-control" readonly value="{{ $members->created_at->format('d M Y') }}">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Organisation Details --}}
        <div class="col-md-6 mb-2">
            <div class="card shadow rounded-4 border border-success-subtle">
                <div class="card-header bg-success text-white rounded-top-4 border-bottom d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Organisation Details</h5>
                </div>
                <div class="card-body">
                    <hr class="my-2">
                    <table class="table table-borderless mb-0">
                        <tbody>
                            <tr>
                                <td><strong>Name</strong></td>
                                <td><input type="text" class="form-control" readonly value="{{ $organisation->organisation_name }}"></td>
                            </tr>
                            <tr>
                                <td><strong>Email</strong></td>
                                <td><input type="text" class="form-control" readonly value="{{ $organisation->organisation_email }}"></td>
                            </tr>
                            <tr>
                                <td><strong>Contact Number</strong></td>
                                <td><input type="text" class="form-control" readonly value="{{ $organisation->contact_number }}"></td>
                            </tr>
                            <tr>
                                <td><strong>Address</strong></td>
                                <td><input type="text" class="form-control" readonly value="{{ $organisation->correspondence_address }}"></td>
                            </tr>
                            <tr>
                                <td><strong>City</strong></td>
                                <td><input type="text" class="form-control" readonly value="{{ $organisation->city }}"></td>
                            </tr>
                            <tr>
                                <td><strong>Postal Code</strong></td>
                                <td><input type="text" class="form-control" readonly value="{{ $organisation->postcode }}"></td>
                            </tr>
                            <tr>
                                <td><strong>Country</strong></td>
                                <td><input type="text" class="form-control" readonly value="{{ $organisation->country }}"></td>
                            </tr>
                            <tr>
                                <td><strong>Social Handle</strong></td>
                                <td>
                                    @foreach(json_decode($organisation->social_handle) as $handle)
                                        <input type="text" class="form-control mb-1" readonly value="{{ $handle }}">
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Website</strong></td>
                                <td><input type="text" class="form-control" readonly value="{{ $organisation->website }}"></td>
                            </tr>
                        </tbody>
                    </table>
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
                    <table class="table table-borderless mb-0">
                        <tbody>
                            <tr><td><strong>Details</strong></td><td>{{ $organisation->organization_details }}</td></tr>
                            <tr><td><strong>Request Description</strong></td><td>{{ $organisation->organisation_request_descripiton }}</td></tr>
                        </tbody>
                    </table>
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
                    <table class="table table-borderless mb-0">
                        <tbody>
                            <tr><td><strong>Description</strong></td><td>{{ $organisation_details->org_description }}</td></tr>
                            <tr><td><strong>Area</strong></td><td>{{ $organisation_details->organisation_area }}</td></tr>
                            <tr><td><strong>Part Of</strong></td><td>{{ $organisation_details->organisation_part_of }}</td></tr>
                            <tr><td><strong>Umbrella Body</strong></td><td>{{ $organisation_details->umbrella_body_details }}</td></tr>
                            <tr><td><strong>Quality Marks</strong></td><td>{{ $organisation_details->quality_marks }}</td></tr>
                            <tr><td><strong>Accreditation Awarded</strong></td><td>{{ $organisation_details->date_accreditation_awarded }}</td></tr>
                            <tr><td><strong>Accreditation Reviewed</strong></td><td>{{ $organisation_details->date_accreditation_reviewed }}</td></tr>
                            <tr><td><strong>Annual Turnover</strong></td><td>{{ $organisation_details->annual_turnover }}</td></tr>
                            <tr><td><strong>Employees</strong></td><td>{{ $organisation_details->currently_employ }}</td></tr>
                            <tr><td><strong>Volunteers</strong></td><td>{{ $organisation_details->volunteers_number }}</td></tr>
                        </tbody>
                    </table>
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
                    <table class="table table-borderless mb-0">
                        <tbody>
                            <tr><td><strong>Group Name</strong></td><td>{{ $organisation_local_activities->name_of_group }}</td></tr>
                            <tr><td><strong>Meeting Frequency</strong></td><td>{{ $organisation_local_activities->frequency_of_group_meetings }}</td></tr>
                            <tr><td><strong>Activity Taking Place</strong></td><td>{{ $organisation_local_activities->activity_taking_place }}</td></tr>
                            @php $activities = json_decode($organisation_local_activities->type_of_activities, true); 
                            @endphp
                            <tr><td><strong>Type of Activities</strong></td><td>{{ is_array($activities) ? implode(', ', $activities) : $organisation_local_activities->type_of_activities }}</td></tr>
                            <tr><td><strong>Other Activities</strong></td><td>{{ $organisation_local_activities->type_of_activities_other }}</td></tr>
                            <tr><td><strong>Additional Info</strong></td><td>{{ $organisation_local_activities->response_to_any_additional_information }}</td></tr>
                            <tr><td><strong>Receive Info from C3SC</strong></td><td>{{ $organisation_local_activities->receive_more_information_from_c3sc }}</td></tr>
                            <tr><td><strong>Dewis Cymru Promotion</strong></td><td>{{ $organisation_local_activities->promotion_on_dewis_cymru_website }}</td></tr>
                        </tbody>
                    </table>
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
                    <table class="table table-borderless mb-0">
                        <tbody>
                            <tr><td><strong>Networks</strong></td><td>{{ $member_network_survey->networks }}</td></tr>
                            <tr><td><strong>Network Interest</strong></td><td>{{ $member_network_survey->network_interst }}</td></tr>
                            <tr><td><strong>Informal Discussions</strong></td><td>{{ $member_network_survey->informal_discussion }}</td></tr>
                            <tr><td><strong>How to Use</strong></td><td>{{ $member_network_survey->how_to_use_this }}</td></tr>
                            <tr><td><strong>Media Details</strong></td><td>{{ $member_network_survey->how_u_use_this_details_media }}</td></tr>
                            <tr><td><strong>Signed By</strong></td><td>{{ $member_network_survey->member_signed }}</td></tr>
                            <tr><td><strong>Signed Date</strong></td><td>{{ $member_network_survey->member_signed_date }}</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

@include('includes.admin.footer')
