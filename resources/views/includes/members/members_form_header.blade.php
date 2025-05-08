<div class="card-header">
    <h2 class="h3 text-gray-800 membership-dashbaord-from-heading">Membership Application Details</h2>
    <p >Please complete all relevant sections below:</p>
    @php
    $memberId = session('members_id_sess');
    $currentStep = (int) $form_steps->form_steps;
    $memberType = session('membershiptype_sess') == "2" ? "single" : "other";

    // Common steps
    $steps = [
        ['title' => 'Member & Organisation', 'route' => route('memberformOneView', $memberId)],
        ['title' => 'Activity & Documentation', 'route' => route('memberformThreeView', $memberId)],
        ['title' => 'About your organisation', 'route' => route('memberformFourView', $memberId)],
        ['title' => 'Agreements & Networks', 'route' => route('memberformFiveView', $memberId)],
    ];

    // Add additional step only for "other" type
    if ($memberType === "other") {
        $steps[] = [
            'title' => 'Submission',
            'route' => route('memberformSixView', $memberId),
        ];
    } else {
        $steps[] = [
            'title' => 'Submission',
            'route' => route('memberformFiveView', $memberId),
        ];
    }
@endphp

    <div class="row mt-3 align-items-center">
        @foreach($steps as $index => $step)
            @php
                $stepNumber = $index;
                if ($stepNumber < $currentStep) {
                    $btnClass = 'btn-success'; // Completed
                } elseif ($stepNumber == $currentStep) {
                    $btnClass = 'btn-primary'; // Current step
                } else {
                    $btnClass = 'btn-outline-primary'; // Upcoming
                }
            @endphp
            <div class="col text-center">
                <a href="{{ $step['route'] }}" class="btn {{ $btnClass }} w-100 mb-2">
                    {{ $step['title'] }}
                </a>
            </div>
        @endforeach
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