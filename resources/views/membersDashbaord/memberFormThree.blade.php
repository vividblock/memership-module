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
                <div class="col-lg-3"><a class="btn btn-primary">Member Details</a></div>
                <div class="col-lg-3"><a  class="btn
                    @if(session('from_step_one')) btn-primary 
                    @else btn-outline-primary 
                    @endif"
                 >Your Activity</a></div>
                <div class="col-lg-3"><a class="btn btn-outline-primary">About your organisation</a></div>
                <div class="col-lg-3"><a class="btn btn-outline-primary">1. Member Details</a></div>
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
                            <option value="Advice &amp; Advocacy">Advice &amp; Advocacy</option>
                            <option value="Animal Welfare ">Animal Welfare </option>
                            <option value="Arts, Culture &amp; Heritage  ">Arts, Culture &amp; Heritage  </option>
                            <option value="Benefits advice   ">Benefits advice   </option>
                            <option value="Benevolent Organisations ">Benevolent Organisations </option>
                            <option value="Carers">Carers</option>
                            <option value="Childcare">Childcare</option>
                            <option value="Children &amp; Families ">Children &amp; Families </option>
                            <option value="Community ">Community </option>
                            <option value="Community Justice ">Community Justice </option>
                            <option value="Dementia, Disability  ">Dementia, Disability  </option>
                            <option value="Education, Training  ">Education, Training  </option>
                            <option value="Employment ">Employment </option>
                            <option value="Environment ">Environment </option>
                            <option value="Financial Advice  ">Financial Advice  </option>
                            <option value="Funding">Funding</option>
                            <option value="Health &amp; Social Care ">Health &amp; Social Care </option>
                            <option value="Housing ">Housing </option>
                            <option value="Sports &amp; Recreation ">Sports &amp; Recreation </option>
                            <option value="Volunteering ">Volunteering </option>
                            <option value="Youth">Youth</option>
                        </select>
                        </div>
                        <div class="form-group">
                            <label for="">Special Interest</label>
                            <select name="special_interest" class="form-control membership-from-select-field">
                                <option value="Age ">Age </option>
                                <option value="BME ">BME </option>
                                <option value="Disability ">Disability </option>
                                <option value="Faith Groups  ">Faith Groups  </option>
                                <option value="Gender">Gender</option>
                                <option value="Religion">Religion</option>
                                <option value="Sexuality ">Sexuality </option>
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

                            <div id="filePreview" class="mt-2"></div>

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
                            <input type="text" name="other_activity" class="form-control form-control-user">
                        </div>
                        <div class="form-group">
                            <label for="">Short description of individual, group or organisation <span class="field-fillup-required">*</span></label>
                            <textarea class="form-control form-control-user" name="description_group" style="
                                @if(session('membershiptype_sess') === '2')
                                    height:50px;
                                @else
                                    height:226px
                                @endif
                            "></textarea>
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

