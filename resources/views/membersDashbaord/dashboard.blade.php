@include('includes.members.header')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 dash-headings">Dashboard</h1>
        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
    </div>

    <div class="card border-left-primary shadow py-2">
        <div class="card-body">
            <h5 class="mb-3">Welcome, 
                <strong class="text-gray-800">{{ session('members_firstname_sess') }} {{ session('members_lastname_sess') }}</strong> 
                @if($form_steps->form_fillup_status == 'false')
                    <small class="members-account-status">
                        Account not complete yet.
                    </small>
                @else
                    <small class="members-account-status" style="background-color:green;">
                        Account Active.
                    </small>
                @endif
            </h5>

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



            <div class="row mt-4">
                <div class="col-lg-6">
                    <div class="card shadow py-2 animated--grow-in">
                        <div class="card-body">
                            <b class="text-gray-700">Have you claimed your C3SC public Listing Page ?</b>
                            <p class="mt-2">Please ensure your organisation's details are complete and up to date.</p>
                            <!-- <a href="" class="btn btn-warning text-gray-800">Review & Update Details</a> -->
                            <a href="#" class="btn btn-primary btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </span>
                                <span class="text">Review & Update Details</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card shadow py-2 animated--grow-in">
                        <div class="card-body">
                            <b class="text-gray-700">Your C3SC Membership Details</b>
                            <p class="mt-2">Please ensure your organisation's details are complete and up to date.</p>

                            <a href="{{ route('memberformOneView',session('members_id_sess')) }}" class="btn btn-primary btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </span>
                                <span class="text ">Review & Update Details</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-lg-6">
                    <div class="card animated--grow-in">

                        <div class="card-body">
                            <h5 class="h5 text-gray-800"><strong>Personal Information</strong></h5>
                            <hr>
                            <p><strong>Username:</strong> {{ $members->username }}</p>
                            <p><strong>Email:</strong> {{ $members->email }}</p>
                            <p><strong>Member Since:</strong> {{ $members->created_at->format('d M Y') }}</p>
                            <p><strong>Membership ID:</strong> {{ $members->members_c3sc_id }}</p>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>


</div>
<!-- /.container-fluid -->

@include('includes.members.footer')