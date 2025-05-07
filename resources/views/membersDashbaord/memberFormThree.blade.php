@include('includes.members.header')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 dash-headings">Membership form</h1>
        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
    </div>

    <div class="card shadow py-2">
        <div class="card-header">
            <h2 class="h3 text-gray-800 membership-dashbaord-from-heading">Membership Application Details</h2>
            <p >Please complete all relevant sections below:</p>
            <div class="row mt-3">
                <div class="col-lg-3"><a class="btn btn-primary">Member & Organisation</a></div>
                <div class="col-lg-3"><a  class="btn
                    @if(session('from_step_one')) btn-primary 
                    @else btn-outline-primary 
                    @endif"
                 >Activity & Documentation</a></div>
                <div class="col-lg-3"><a class="btn btn-outline-primary">About your organisation</a></div>
                <div class="col-lg-3"><a class="btn btn-outline-primary">Agreements & Networks</a></div>
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
        <div class="card-body">

            <form class="user" action="{{ route('memberformThree', session('members_id_sess') )}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                        <label for="">Your activity (Please select all that apply) <span class="field-fillup-required">*</span> </label>
                        <select name="your_activity" class="form-control membership-from-select-field">
                            <option value="Advice & Advocacy" {{ $member_two->your_activity == "Advice & Advocacy" ? 'selected' : '' }}>Advice & Advocacy</option>
                            <option value="Animal Welfare" {{ $member_two->your_activity == "Animal Welfare" ? 'selected' : '' }}>Animal Welfare</option>
                            <option value="Arts, Culture & Heritage" {{ $member_two->your_activity == "Arts, Culture & Heritage" ? 'selected' : '' }}>Arts, Culture & Heritage</option>
                            <option value="Benefits advice" {{ $member_two->your_activity == "Benefits advice" ? 'selected' : '' }}>Benefits advice</option>
                            <option value="Benevolent Organisations" {{ $member_two->your_activity == "Benevolent Organisations" ? 'selected' : '' }}>Benevolent Organisations</option>
                            <option value="Carers" {{ $member_two->your_activity == "Carers" ? 'selected' : '' }}>Carers</option>
                            <option value="Childcare" {{ $member_two->your_activity == "Childcare" ? 'selected' : '' }}>Childcare</option>
                            <option value="Children & Families" {{ $member_two->your_activity == "Children & Families" ? 'selected' : '' }}>Children & Families</option>
                            <option value="Community" {{ $member_two->your_activity == "Community" ? 'selected' : '' }}>Community</option>
                            <option value="Community Justice" {{ $member_two->your_activity == "Community Justice" ? 'selected' : '' }}>Community Justice</option>
                            <option value="Dementia, Disability" {{ $member_two->your_activity == "Dementia, Disability" ? 'selected' : '' }}>Dementia, Disability</option>
                            <option value="Education, Training" {{ $member_two->your_activity == "Education, Training" ? 'selected' : '' }}>Education, Training</option>
                            <option value="Employment" {{ $member_two->your_activity == "Employment" ? 'selected' : '' }}>Employment</option>
                            <option value="Environment" {{ $member_two->your_activity == "Environment" ? 'selected' : '' }}>Environment</option>
                            <option value="Financial Advice" {{ $member_two->your_activity == "Financial Advice" ? 'selected' : '' }}>Financial Advice</option>
                            <option value="Funding" {{ $member_two->your_activity == "Funding" ? 'selected' : '' }}>Funding</option>
                            <option value="Health & Social Care" {{ $member_two->your_activity == "Health & Social Care" ? 'selected' : '' }}>Health & Social Care</option>
                            <option value="Housing" {{ $member_two->your_activity == "Housing" ? 'selected' : '' }}>Housing</option>
                            <option value="Sports & Recreation" {{ $member_two->your_activity == "Sports & Recreation" ? 'selected' : '' }}>Sports & Recreation</option>
                            <option value="Volunteering" {{ $member_two->your_activity == "Volunteering" ? 'selected' : '' }}>Volunteering</option>
                            <option value="Youth" {{ $member_two->your_activity == "Youth" ? 'selected' : '' }}>Youth</option>
                        </select>
                        </div>
                        <div class="form-group">
                            <label for="">Special Interest</label>
                            <select name="special_interest" class="form-control membership-from-select-field">
                                <option value="Age" {{ $member_two->special_interest == "Age" ? 'selected' : '' }}>Age</option>
                                <option value="BME" {{ $member_two->special_interest == "BME" ? 'selected' : '' }}>BME</option>
                                <option value="Disability" {{ $member_two->special_interest == "Disability" ? 'selected' : '' }}>Disability</option>
                                <option value="Faith Groups" {{ $member_two->special_interest == "Faith Groups" ? 'selected' : '' }}>Faith Groups</option>
                                <option value="Gender" {{ $member_two->special_interest == "Gender" ? 'selected' : '' }}>Gender</option>
                                <option value="Religion" {{ $member_two->special_interest == "Religion" ? 'selected' : '' }}>Religion</option>
                                <option value="Sexuality" {{ $member_two->special_interest == "Sexuality" ? 'selected' : '' }}>Sexuality</option>
                            </select>
                        </div>
                        @if(session('membershiptype_sess') != "2")
                        <div class="mb-3">
                            <!-- <label class="form-label">Constitution / Governing Document</label><br>
                            <small >If your group/organisation has a constitution or governing document, please upload the relevant document to this application or in your email - it must be signed and dated (this will speed up your membership application)</small>
                            <div class="input-group" style="padding-top:20px;">
                                <input type="file" class="form-control d-none" id="customFileInput">
                                <input type="text" class="form-control" id="fileName" placeholder="No file chosen" readonly>
                                <label class="input-group-text btn btn-primary" for="customFileInput">Browse</label>
                            </div> -->

                            <label class="form-label">Constitution / Governing Document</label><br>
                            <small>If your group/organisation has a constitution or governing document, please upload the relevant document(s).</small>
                            <div class="input-group mt-3">
                                <input type="file" class="form-control d-none" id="customFileInput" name="documents[]" multiple>
                                <input type="text" class="form-control" id="fileName" placeholder="No files chosen" readonly>
                                <label class="input-group-text btn btn-primary" for="customFileInput">Browse</label>
                            </div>

                            @if (!empty($member_two->governing_documents))
                                @php
                                    $existingFiles = json_decode($member_two->governing_documents, true);
                                @endphp
                                @if (is_array($existingFiles) && count($existingFiles))
                                    <div class="mt-3">
                                        <label><strong>Uploaded Document(s):</strong></label>
                                        <ul>
                                            @foreach ($existingFiles as $doc)
                                                <li>
                                                    <a href="{{ asset('storage/' . $doc) }}" target="_blank">{{ basename($doc) }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            @endif

                            <script>
                            document.getElementById('customFileInput').addEventListener('change', function() {
                                const preview = document.getElementById('filePreview');
                                preview.innerHTML = '';
                                const fileNames = Array.from(this.files).map(file => file.name);
                                document.getElementById('fileName').value = fileNames.join(', ');
                                fileNames.forEach(name => {
                                    const p = document.createElement('p');
                                    p.textContent = name;
                                    preview.appendChild(p);
                                });
                            });
                            </script>


                        </div>
                        @endif

                        <script>
                        document.getElementById('customFileInput').addEventListener('change', function() {
                            let fileName = this.files.length > 0 ? this.files[0].name : "No file chosen";
                            document.getElementById('fileName').value = fileName;
                        });
                        </script>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="">Other – please specify</label>
                            <input type="text" name="other_activity" class="form-control form-control-user" value="{{ $member_two->other_activity }}">
                        </div>
                        <div class="form-group">
                            <label for="">Short description of individual, group or organisation <span class="field-fillup-required">*</span></label>
                            <textarea class="form-control form-control-user" name="description_group" style="
                                @if(session('membershiptype_sess') === '2')
                                    height:50px;
                                @else
                                    height:226px
                                @endif
                            ">{{ $member_two->short_description }}</textarea>
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
                        <button class="btn btn-primary btn-user btn-block">Next</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>

@include('includes.members.footer')

