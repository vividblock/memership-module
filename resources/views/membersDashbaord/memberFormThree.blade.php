@include('includes.members.header')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 dash-headings">Membership form</h1>
        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
    </div>

    <div class="card shadow py-2">
        @include('includes.members.members_form_header')
        <div class="card-body">

            <form class="user" action="{{ route('memberformThree', session('members_id_sess') )}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="">Your activity (Please select all that apply) <span class="field-fillup-required">*</span> </label>
                            <select name="your_activity" class="form-control membership-from-select-field">
                                <option value="">Please select</option>
                                <option value="Advice & Advocacy" {{ old('your_activity', optional($member_two)->your_activity) == "Advice & Advocacy" ? 'selected' : '' }}>Advice & Advocacy</option>
                                <option value="Animal Welfare" {{ old('your_activity', optional($member_two)->your_activity) == "Animal Welfare" ? 'selected' : '' }}>Animal Welfare</option>
                                <option value="Arts, Culture & Heritage" {{ old('your_activity', optional($member_two)->your_activity) == "Arts, Culture & Heritage" ? 'selected' : '' }}>Arts, Culture & Heritage</option>
                                <option value="Benefits advice" {{ old('your_activity', optional($member_two)->your_activity) == "Benefits advice" ? 'selected' : '' }}>Benefits advice</option>
                                <option value="Benevolent Organisations" {{ old('your_activity', optional($member_two)->your_activity) == "Benevolent Organisations" ? 'selected' : '' }}>Benevolent Organisations</option>
                                <option value="Carers" {{ old('your_activity', optional($member_two)->your_activity) == "Carers" ? 'selected' : '' }}>Carers</option>
                                <option value="Childcare" {{ old('your_activity', optional($member_two)->your_activity) == "Childcare" ? 'selected' : '' }}>Childcare</option>
                                <option value="Children & Families" {{ old('your_activity', optional($member_two)->your_activity) == "Children & Families" ? 'selected' : '' }}>Children & Families</option>
                                <option value="Community" {{ old('your_activity', optional($member_two)->your_activity) == "Community" ? 'selected' : '' }}>Community</option>
                                <option value="Community Justice" {{ old('your_activity', optional($member_two)->your_activity) == "Community Justice" ? 'selected' : '' }}>Community Justice</option>
                                <option value="Dementia, Disability" {{ old('your_activity', optional($member_two)->your_activity) == "Dementia, Disability" ? 'selected' : '' }}>Dementia, Disability</option>
                                <option value="Education, Training" {{ old('your_activity', optional($member_two)->your_activity) == "Education, Training" ? 'selected' : '' }}>Education, Training</option>
                                <option value="Employment" {{ old('your_activity', optional($member_two)->your_activity) == "Employment" ? 'selected' : '' }}>Employment</option>
                                <option value="Environment" {{ old('your_activity', optional($member_two)->your_activity) == "Environment" ? 'selected' : '' }}>Environment</option>
                                <option value="Financial Advice" {{ old('your_activity', optional($member_two)->your_activity) == "Financial Advice" ? 'selected' : '' }}>Financial Advice</option>
                                <option value="Funding" {{ old('your_activity', optional($member_two)->your_activity) == "Funding" ? 'selected' : '' }}>Funding</option>
                                <option value="Health & Social Care" {{ old('your_activity', optional($member_two)->your_activity) == "Health & Social Care" ? 'selected' : '' }}>Health & Social Care</option>
                                <option value="Housing" {{ old('your_activity', optional($member_two)->your_activity) == "Housing" ? 'selected' : '' }}>Housing</option>
                                <option value="Sports & Recreation" {{ old('your_activity', optional($member_two)->your_activity) == "Sports & Recreation" ? 'selected' : '' }}>Sports & Recreation</option>
                                <option value="Volunteering" {{ old('your_activity', optional($member_two)->your_activity) == "Volunteering" ? 'selected' : '' }}>Volunteering</option>
                                <option value="Youth" {{ old('your_activity', optional($member_two)->your_activity) == "Youth" ? 'selected' : '' }}>Youth</option>
                            </select>

                            @if ($errors->has('your_activity'))
                                <span class="text-danger">{{ $errors->first('your_activity') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="">Special Interest</label>
                            <select name="special_interest" class="form-control membership-from-select-field">
                                <option value="">Please select</option>
                                <option value="Age" {{ old('special_interest', optional($member_two)->special_interest) == "Age" ? 'selected' : '' }}>Age</option>
                                <option value="BME" {{ old('special_interest', optional($member_two)->special_interest) == "BME" ? 'selected' : '' }}>BME</option>
                                <option value="Disability" {{ old('special_interest', optional($member_two)->special_interest) == "Disability" ? 'selected' : '' }}>Disability</option>
                                <option value="Faith Groups" {{ old('special_interest', optional($member_two)->special_interest) == "Faith Groups" ? 'selected' : '' }}>Faith Groups</option>
                                <option value="Gender" {{ old('special_interest', optional($member_two)->special_interest) == "Gender" ? 'selected' : '' }}>Gender</option>
                                <option value="Religion" {{ old('special_interest', optional($member_two)->special_interest) == "Religion" ? 'selected' : '' }}>Religion</option>
                                <option value="Sexuality" {{ old('special_interest', optional($member_two)->special_interest) == "Sexuality" ? 'selected' : '' }}>Sexuality</option>
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

                            <label class="form-label">Constitution or Governing Document <span class="field-fillup-required">*</span></label><br>
                            <small>If your group or organisation has a constitution or governing document, please upload the relevant document(s).</small>
                            <div class="input-group mt-3">
                                <input type="file" class="form-control d-none" id="customFileInput" name="documents[]" multiple>
                                <input type="text" class="form-control" id="fileName" placeholder="No files chosen" readonly>
                                <label class="input-group-text btn btn-primary" for="customFileInput">Browse</label>
                                
                            </div>
                            @if ($errors->has('documents'))
                                <span class="text-danger">{{ $errors->first('documents') }}</span>
                            @endif


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
                            @if ($errors->has('description_group'))
                                <span class="text-danger">{{ $errors->first('description_group') }}</span>
                            @endif
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

