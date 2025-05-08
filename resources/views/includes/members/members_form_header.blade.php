<div class="card-header">
    <h2 class="h3 text-gray-800 membership-dashbaord-from-heading">Membership Application Details</h2>
    <p >Please complete all relevant sections below:</p>
    <div class="row mt-3 align-items-center">
        <div class="col"><a href="{{ route('memberformOneView', session('members_id_sess') ) }}" class="btn btn-primary">Member & Organisation</a></div>
        <div class="col">
        <a class="btn btn-outline-primary ">Activity & Documentation</a></div>
        <div class="col"><a class="btn btn-outline-primary">About your organisation</a></div>
        <div class="col"><a class="btn btn-outline-primary">Agreements & Networks</a></div>
        <div class="col text-center"><a class="btn btn-outline-primary">Submission</a></div>
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