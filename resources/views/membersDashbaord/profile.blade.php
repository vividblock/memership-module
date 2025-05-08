@include('includes.members.header')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Member Profile</h1>
    </div>

    <!-- Profile Overview -->
    <div class="card shadow mb-4">
        <div class="card-header bg-primary text-white">
            Member Info
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <strong>Name:</strong> {{ $member->firstname }} {{ $member->lastname }}
                </div>
                <div class="col-md-6">
                    <strong>Email:</strong> {{ $member->email }}
                </div>
                <div class="col-md-6">
                    <strong>Membership Type:</strong> {{ $member->membership_type }}
                </div>
                <div class="col-md-6">
                    <strong>Status:</strong> {!! $member->user_status ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Inactive</span>' !!}
                </div>
            </div>
        </div>
    </div>

    <!-- Tabs for Additional Info -->
    <ul class="nav nav-tabs mb-3" id="profileTab" role="tablist">
        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#org">Organisation</a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#details">Details</a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#local">Local Activities</a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#interest">Interest</a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#survey">Survey</a></li>
    </ul>

    <div class="tab-content">
        <!-- Organisation -->
        <div class="tab-pane fade show active" id="org">
            @if($organisation)
            <div class="card blur-shadow mb-4">
                <div class="card-header">Organisation Information</div>
                <div class="card-body">
                    <p><strong>Name:</strong> {{ $organisation->organisation_name }}</p>
                    <p><strong>Email:</strong> {{ $organisation->organisation_email }}</p>
                    <p><strong>Address:</strong> {{ $organisation->correspondence_address }}, {{ $organisation->city }} {{ $organisation->postcode }}, {{ $organisation->country }}</p>
                    <p><strong>Contact:</strong> {{ $organisation->contact_number }}</p>
                    <p><strong>Website:</strong> <a href="{{ $organisation->website }}" target="_blank">{{ $organisation->website }}</a></p>
                </div>
            </div>
            @endif
        </div>

        <!-- Organisation Details -->
        <div class="tab-pane fade" id="details">
            @if($orgDetails)
            <div class="card blur-shadow mb-4">
                <div class="card-header">Organisational Details</div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr><th>Description</th><td>{{ $orgDetails->org_description }}</td></tr>
                        <tr><th>Accreditation</th><td>{{ $orgDetails->quality_marks }} ({{ $orgDetails->date_accreditation_awarded }})</td></tr>
                        <tr><th>Annual Turnover</th><td>{{ $orgDetails->annual_turnover }}</td></tr>
                        <tr><th>Employees</th><td>{{ $orgDetails->currently_employ }}</td></tr>
                        <tr><th>Volunteers</th><td>{{ $orgDetails->volunteers_number }}</td></tr>
                    </table>
                </div>
            </div>
            @endif
        </div>

        <!-- Local Activities -->
        <div class="tab-pane fade" id="local">
            @if($activity)
            
            <div class="card blur-shadow mb-4">
                <div class="card-header">Activity: {{ $activity->name_of_group }}</div>
                <div class="card-body">
                    <p><strong>Frequency:</strong> {{ $activity->frequency_of_group_meetings }}</p>
                    <p><strong>Activities:</strong> {{ implode(', ', json_decode($activity->type_of_activities ?? '[]')) }}</p>
                    <p><strong>Additional Info:</strong> {{ $activity->response_to_any_additional_information }}</p>
                </div>
            </div>
            
            @endif
        </div>


    </div>

</div>

@include('includes.members.footer')
