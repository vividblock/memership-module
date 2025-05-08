<div class="card-header">
    <h2 class="h3 text-gray-800 membership-dashbaord-from-heading">Membership Application Details</h2>
    <p >Please complete all relevant sections below:</p>
    @php
        $memberId = session('members_id_sess');
        $currentStep = (int) $form_steps->form_steps;
        $memberType = session('membershiptype_sess') == "2" ? "single" : "other";

        // Define all possible steps
        $steps = [
            ['title' => 'Member & Organisation', 'route' => route('memberformOneView', $memberId)],
            ['title' => 'Activity & Documentation', 'route' => route('memberformThreeView', $memberId)],
            ['title' => 'About your organisation', 'route' => route('memberformFourView', $memberId)],
            ['title' => 'Agreements & Networks', 'route' => route('memberformFiveView', $memberId)],
            ['title' => 'Submission', 'route' => route('memberformFiveView', $memberId)],
        ];

        // Add extra step only for "other" members (making it 6 steps)
        if ($memberType == "other") {
            array_splice($steps, 4, 0, [[
                'title' => 'Additional Info',
                'route' => route('memberformSixView', $memberId)
            ]]);
        }
    @endphp

    <div class="row mt-3 align-items-center">
        @foreach($steps as $index => $step)
            @php
                $stepNumber = $index + 1;
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