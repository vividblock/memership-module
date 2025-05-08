<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;


use App\Models\members;
use App\Models\organisation;
use App\Models\members_two;
use App\Models\organisation_details;
use App\Models\member_network_survey;
use App\Models\organisation_local_activities;
use App\Models\Members_form_fillup_status;
use App\Models\notification_members;
use App\Models\support_admin_members;

use App\Mail\OtpMail;
use Illuminate\Support\Facades\Mail;
use App\Models\membersEmailValidationTemporary;

class membersController extends Controller
{

    protected $formStep;
    protected $memberID;
    protected $member;
    protected $memberActivity;
    protected $memberNetworkSurvey;
    protected $organisation;
    protected $organisationDetails;
    protected $organisationLocalActivities;

    public function __construct(){
        $this->memberID = Session::get('members_id_sess');
        if ($this->memberID) {
            $MembersformStep = new Members_form_fillup_status();
            $this->formStep = $MembersformStep->getFormSteps($this->memberID);
            $this->member = members::where('id', $this->memberID)->first();
            $this->memberActivity = members_two::where('member_id', $this->memberID)->first();
            $this->memberNetworkSurvey = member_network_survey::where('member_id', $this->memberID)->first();
            $this->organisation = organisation::where("member_id", $this->memberID)->first();
            $this->organisationDetails = organisation_details::where('org_id', $this->organisation->id)->first();
            $this->organisationLocalActivities = organisation_local_activities::where('org_id', $this->organisation->id)->first();
            Session::put([
                "form_fillup_status" => $this->formStep->form_fillup_status,
                "profile_status" => $this->member->user_status
            ]);
        }
    }

    public function dashboard(){
        // $members = members::where('id', $this->memberID)->first();

        return view('membersDashbaord.dashboard')->with([
            'members' => $this->member,
            "organisation" => $this->organisation,
            "orgDetails" => $this->organisationDetails,
            "activity" => $this->organisationLocalActivities,
            "interest" => $this->memberActivity,
            "survey" => $this->memberNetworkSurvey,
            'form_steps' => $this->formStep,
        ]);
    }

    public function memberformOneView(Request $request){
        // $members = members::where('id', $request->memberId)->first();
        // $organisation = organisation::where('member_id', $request->memberId)->first();
        return view('membersDashbaord.memberFormOne')->with([
            'members' => $this->member, 
            'organisation' => $this->organisation,
            'form_steps' => $this->formStep,
        ]);
    }

    public function membersformOne(Request $request){
        // dd($request);
        $rules = [
            'correspondence_address' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'org_email' => 'required|email|max:255',
            'socail_handle' => 'nullable|string|max:255',
            'contact_number' => 'required',
            'organization_name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'postcode' => 'required|string|max:20',
            'org_contact_number' => 'required',
            'website' => 'nullable|url|max:255'
        ];

        $messages = [
        
            'correspondence_address.required' => 'The correspondence address field is required.',
            'correspondence_address.string' => 'The correspondence address must be a valid text.',
            'correspondence_address.max' => 'The correspondence address must not exceed 255 characters.',
        
            'country.required' => 'The country field is required.',
            'country.string' => 'The country must be a valid text.',
            'country.max' => 'The country must not exceed 255 characters.',
        
            'org_email.required' => 'The organization email field is required.',
            'org_email.email' => 'The organization email must be a valid email address.',
            'org_email.max' => 'The organization email must not exceed 255 characters.',
        
            'socail_handle.string' => 'The social handle must be valid text.',
            'socail_handle.max' => 'The social handle must not exceed 255 characters.',
        
            // 'contact_number.digits_between' => 'The contact number must be between 10 and 15 digits.',
            // 'contact_number.numeric' => 'The contact number must be a valid number.',
        
            'organization_name.required' => 'The organization name field is required.',
            'organization_name.string' => 'The organization name must be valid text.',
            'organization_name.max' => 'The organization name must not exceed 255 characters.',
        
            'city.required' => 'The city field is required.',
            'city.string' => 'The city must be valid text.',
            'city.max' => 'The city must not exceed 255 characters.',
        
            'postcode.required' => 'The postcode field is required.',
            'postcode.string' => 'The postcode must be valid text.',
            'postcode.max' => 'The postcode must not exceed 20 characters.',
        
            'org_contact_number.required' => 'The organization contact number is required.',
            // 'org_contact_number.digits_between' => 'The organization contact number must be between 10 and 15 digits.',
            // 'org_contact_number.numeric' => 'The organization contact number must be a valid number.',
        
            'website.url' => 'The website must be a valid URL.',
            'website.max' => 'The website must not exceed 255 characters.',

        ];
        
        
        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $organisationDetails = json_encode($request->organisation_details);

        Session::put('from_step_one',true);
        $memberformStep = new Members_form_fillup_status;
        $memberformStep->updateFormSteps($request->memberId, '1', "false" , $request->membershiptype == "2" ? "4" : "5");
        // if($request->membershiptype === "2"){
            Session::put('membershiptype_sess',$request->membershiptype);
            members::where('id', $request->memberId)->update([
                'membership_type'=>$request->membershiptype,
                'contactnumber'=>$request->contact_number
            ]);

            organisation::where('member_id', $request->memberId)->update([
                'organisation_name'=>$request->organization_name,
                'organisation_email'=>$request->org_email,
                'correspondence_address'=>$request->correspondence_address,
                'city'=>$request->city,
                'postcode'=>$request->postcode,
                'country'=>$request->country,
                'contact_number'=>$request->org_contact_number,
                // 'social_handle'=>$request->socail_handle,
                'social_handle'=>json_decode($request->social_handle, true),
                'website'=>$request->website,
                'organization_details'=>$organisationDetails,
            ]);

            // Session::put('from_step_one_filled_up',true);
            return redirect()->route('memberformThreeView', $request->memberId);
        // }else{

        //     return redirect()->route('memberformTwoView');
        // }

    }

    public function memberformTwoView(Request $request){
    }

    public function memberformTwo(Request $request){
    }

    public function memberformThreeView(Request $request){
        $members = members::where('id', $request->memberId)->first();
        $members_two = members_two::where('member_id', $request->memberId)->first();
        $organisation = organisation::where('member_id', $request->memberId)->first();
        return view('membersDashbaord.memberFormThree')->with([
            'members' => $members, 
            'organisation' => $organisation,
            'member_two' => $members_two,
            'form_steps' => $this->formStep,
        ]);
    }

    // public function memberformThree(Request $request){
    //     $members_two =  members_two::where('member_id', $request->memberId)->first();

    //     // Handle multiple files
    //     if ($request->hasFile('documents')) {
    //         foreach ($request->file('documents') as $file) {
    //             $path = $file->store('documents', 'public'); 
    //             // dd($path);// 'public/documents/filename.ext'
    //             // Save each file path in a related table, e.g., member_documents
    //             members_two::where('member_id', $request->memberId)->update(
    //                 governing_documents
    //             // \App\Models\MemberDocument::create([
    //             //     'member_id' => $request->memberId,
    //             //     'file_path' => $path,
    //             // ]);
    //         }
    //     }

    //     if($members_two){
    //         members_two::where('member_id', $request->memberId)->update([
    //             'your_activity'=>$request->your_activity,
    //             'other_activity'=>$request->other_activity ,
    //             'special_interest'=>$request->special_interest,
    //             'short_description'=>$request->description_group,
    //         ]);
    //     }else{
    //         members_two::create([
    //             'member_id'=> $request->memberId,
    //             'your_activity'=>$request->your_activity,
    //             'other_activity'=>$request->other_activity ,
    //             'special_interest'=>$request->special_interest,
    //             'short_description'=>$request->description_group,
    //         ]);
    //     }




    //     Session::put('from_step_three',true);
    //     $memberformStep = new Members_form_fillup_status;
    //     $memberformStep->updateFormSteps($request->memberId, '2', "false" , Session::get('membershiptype_sess') == "2" ? "5" : "6");


    //     return redirect()->route('memberformFourView', $request->memberId);
    // }
    public function memberformThree(Request $request){   

        $allowedActivities = [
            'Advice & Advocacy', 'Animal Welfare', 'Arts, Culture & Heritage', 'Benefits advice',
            'Benevolent Organisations', 'Carers', 'Childcare', 'Children & Families', 'Community',
            'Community Justice', 'Dementia, Disability', 'Education, Training', 'Employment',
            'Environment', 'Financial Advice', 'Funding', 'Health & Social Care', 'Housing',
            'Sports & Recreation', 'Volunteering', 'Youth'
        ];

        $rules = [
            'your_activity'     => ['required', Rule::in($allowedActivities)],
            'description_group' => 'required|string|min:10|max:1000',
        ];
        

        $messages = [
            'your_activity.required' => 'Please select your main activity.',
            'your_activity.in'       => 'The selected activity is not valid.',
        
            'description_group.required' => 'Please provide a short description of your group or activity.',
            'description_group.min'      => 'The description must be at least 10 characters.',
            'description_group.max'      => 'The description must not exceed 1000 characters.',
        ];

        // Extra validation if membership type is not '2'
        if(Session::get('membershiptype_sess') !== '2'){
            // Get existing member record to check if documents were already uploaded
            $existing = members_two::where('member_id', $request->memberId)->first();

            $hasExistingDocuments = $existing && !empty($existing->governing_documents);

            // Only require new documents if none exist yet
            if (!$hasExistingDocuments) {
                $rules['documents'] = 'required';
            }
            $rules['documents.*'] = 'file|mimes:pdf,jpeg,png,jpg,doc,docx';

            $messages['documents.required']    = 'You must upload at least one document.';
            $messages['documents.*.file']      = 'Each uploaded item must be a valid file.';
            $messages['documents.*.mimes']     = 'Only PDF, image (jpg, jpeg, png, gif), or Word documents (doc, docx) are allowed.';
        }

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Prepare data to update or create the member
        $data = [
            'your_activity'     => $request->your_activity,
            'other_activity'    => $request->other_activity,
            'special_interest'  => $request->special_interest,
            'short_description' => $request->description_group,
        ];
        
        if(Session::get('membershiptype_sess') !== '2'){

            // Initialize an array to store the paths of uploaded files
            $paths = [];
        
            // If files are uploaded, process them
            if ($request->hasFile('documents')) {
                foreach ($request->file('documents') as $file) {
                    if ($file->isValid()) {
                        // $originalName = $file->getClientOriginalName();
                        // Store the file and get its path
                        $path = $file->store('documents', 'public');
                        // Add the file path to the array
                        $paths[] = $path;
                    }
                }
        
                // If any files were uploaded, save their paths as a JSON string in the database
                if (count($paths) > 0) {
                    $data['governing_documents'] = json_encode($paths);
                }
            }
        }

        // Save or update the member data
        members_two::updateOrCreate(
            ['member_id' => $request->memberId],
            $data
        );
    
        // Update step status
        Session::put('from_step_three', true);
        (new Members_form_fillup_status)->updateFormSteps(
            $request->memberId,
            '2',
            'false',
            Session::get('membershiptype_sess') === '2' ? '4' : '5'
        );
    
        // Redirect to the next step
        return redirect()->route('memberformFourView', $request->memberId);
    }
    
    public function memberformFourView(Request $request){
        $organisation = organisation::where('member_id', $request->memberId)->first();
        $organisation_details = organisation_details::where('org_id', $organisation->id)->first();
        return view('membersDashbaord.memberFormFour')->with([
            'organisation_details' =>  $organisation_details,
            'form_steps' => $this->formStep,
        ]);
    }

    public function memberformFour(Request $request){
        $rules = [
            'currently_employ'               => 'required|numeric|min:0',
            'volunteers_number'              => 'required|integer|min:0',
            'registered_on'                  => 'required|in:yes,no',
            'support_to_recruit_volunteers'  => 'required|in:yes,no',
            'organisation_area'              => 'required|string|max:255',
            'organisation_part_of'           => 'required|in:yes,no',
        ];

        $messages = [
            'currently_employ.required' => 'Please enter the number of staff currently employed.',
            'currently_employ.numeric'  => 'The number of staff must be a numeric value.',
            'currently_employ.min'      => 'The number of staff cannot be negative.',
        
            'volunteers_number.required' => 'Please enter the number of volunteers.',
            'volunteers_number.integer'  => 'The number of volunteers must be an integer.',
            'volunteers_number.min'      => 'The number of volunteers cannot be negative.',
        
            'registered_on.required' => 'Please indicate whether you are registered on www.Volunteering-Wales.net.',
            'registered_on.in'       => 'Invalid selection for Volunteering-Wales.net registration.',
        
            'support_to_recruit_volunteers.required' => 'Please indicate if you want support to recruit volunteers.',
            'support_to_recruit_volunteers.in'       => 'Invalid selection for volunteer recruitment support.',
        
            'organisation_area.required' => 'Please select your organisation area.',
            'organisation_area.max'      => 'Organisation area exceeds the maximum length.',
        
            'organisation_part_of.required' => 'Please indicate if your organisation is part of a national or umbrella body.',
            'organisation_part_of.in'       => 'Invalid selection for organisation affiliation.',
        ];
        

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // dd($request);
        $organisation = organisation::where('member_id', $request->memberId)->first();
        // dd($organisation);
        $organisation_details = organisation_details::where('org_id', $organisation->id)->first();
        if($organisation_details){
            organisation_details::where('org_id', $organisation->id)->update([
                'organisation_area'=>$request->organisation_area,
                'organisation_part_of'=>$request->organisation_part_of,
                'umbrella_body_details'=>$request->umbrella_body_details,
                'quality_marks'=>$request->quality_marks,
                'date_accreditation_awarded'=>$request->date_accreditation_awarded,
                'date_accreditation_reviewed'=>$request->date_accreditation_reviewed,
                'annual_turnover'=>$request->annual_turnover,
                'currently_employ'=>$request->currently_employ,
                'volunteers_number'=>$request->volunteers_number,
                'registered_on'=>$request->registered_on,
                'support_to_recruit_volunteers'=>$request->support_to_recruit_volunteers,
                'collaboration_area_1'=>$request->collaboration_area_1,
                'collaboration_area_2'=>$request->collaboration_area_2,
                'collaboration_area_3'=>$request->collaboration_area_3,
            ]);
        }else{
            organisation_details::create([
                'org_id'=>$organisation->id,
                'organisation_area'=>$request->organisation_area,
                'organisation_part_of'=>$request->organisation_part_of,
                'umbrella_body_details'=>$request->umbrella_body_details,
                'quality_marks'=>$request->quality_marks,
                'date_accreditation_awarded'=>$request->date_accreditation_awarded,
                'date_accreditation_reviewed'=>$request->date_accreditation_reviewed,
                'annual_turnover'=>$request->annual_turnover,
                'currently_employ'=>$request->currently_employ,
                'volunteers_number'=>$request->volunteers_number,
                'registered_on'=>$request->registered_on,
                'support_to_recruit_volunteers'=>$request->support_to_recruit_volunteers,
                'collaboration_area_1'=>$request->collaboration_area_1,
                'collaboration_area_2'=>$request->collaboration_area_2,
                'collaboration_area_3'=>$request->collaboration_area_3,
            ]);
        }
        Session::put('from_step_four',true);
        (new Members_form_fillup_status)->updateFormSteps(
            $request->memberId,
            '3',
            'false',
            Session::get('membershiptype_sess') === '2' ? '4' : '5'
        );
        return redirect()->route('memberformFiveView', $request->memberId);
        
    }

    public function memberformFiveView(Request $request){
        $member_network_survay = member_network_survey::where('member_id', $request->memberId)->first();
        return view('membersDashbaord.memberFormFive')->with([
            'form_steps' => $this->formStep,
            'member_network_survay' => $member_network_survay,
        ]);
    }

    public function memberformFive(Request $request){

        $rules = [
            'how_u_use_this_details_media' => 'required|in:yes,no',
            'member_signed_date'           => 'required|date',
            'member_signed'                => 'required|string|min:3|max:100',
        ];

        $messages = [
            'how_u_use_this_details_media.required' => 'Please let us know if we have permission to use your details in media.',
            'how_u_use_this_details_media.in'       => 'Invalid selection for media permissions.',
        
            'member_signed_date.required' => 'Please provide the date of signature.',
            'member_signed_date.date'     => 'The signature date must be a valid date.',
        
            'member_signed.required' => 'Please provide your full name as an electronic signature.',
            'member_signed.string'   => 'Your signature must be a text value.',
            'member_signed.min'      => 'Your full name must be at least :min characters.',
            'member_signed.max'      => 'Your full name may not exceed :max characters.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $member_network_survay = member_network_survey::where('member_id', $request->memberId)->first();
        if($member_network_survay){
            member_network_survey::where('member_id', $request->memberId)->update([
                'networks'=>$request->networks,
                'network_interst'=>$request->network_interst,
                'informal_discussion'=>$request->informal_discussion,
                'how_to_use_this'=>$request->how_to_use_this,
                'how_u_use_this_details_media'=>$request->how_u_use_this_details_media,
                'member_signed_date'=>$request->member_signed_date,
                'member_signed'=>$request->member_signed,
            ]);
        }else{
            member_network_survey::create([
                'member_id'=>$request->memberId,
                'networks'=>$request->networks,
                'network_interst'=>$request->network_interst,
                'informal_discussion'=>$request->informal_discussion,
                'how_to_use_this'=>$request->how_to_use_this,
                'how_u_use_this_details_media'=>$request->how_u_use_this_details_media,
                'member_signed_date'=>$request->member_signed_date,
                'member_signed'=>$request->member_signed,
            ]);
        }
        (new Members_form_fillup_status)->updateFormSteps(
            $request->memberId,
            '4',
            'submited',
            Session::get('membershiptype_sess') === '2' ? '4' : '5'
        );

        // notification_members::

        if(Session::get('membershiptype_sess')=== "2"){
            return redirect()->route('membersDashboard');
        }


        return redirect()->route('memberformSixView', $request->memberId);
    }

    public function memberformSixView(Request $request){
        $orgData = organisation::where('member_id', $request->memberId)->first();
        $org_local_activity_details = organisation_local_activities::where('org_id', $orgData->id)->first();
        return view('membersDashbaord.memberFormSix')->with([
            'form_steps' => $this->formStep,
            'org_local_activity_details' => $org_local_activity_details,
        ]);
    }

    public function memberformSix(Request $request){

        $rules = [
            'gdpr' => 'required|in:C3SC may share the groups contact details with other Third Sector Organisations or community groups,Do not share this groups\' contact details.',
        ];
        $messages = [
            'gdpr.required' => 'Please indicate your preference for data sharing (GDPR).',
            'gdpr.in' => 'Please select a valid GDPR option.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        
        // dd($request);
        $orgData = organisation::where('member_id', $request->memberId)->first();
        $org_local_activity_details = organisation_local_activities::where('org_id', $orgData->id)->first();
        if($org_local_activity_details){
            organisation_local_activities::where('org_id', $orgData->id)->update([
                'name_of_group'=>$request->name_of_group,
                'frequency_of_group_meetings'=>$request->frequency_of_group_meetings,
                'activity_taking_place'=>$request->activity_taking_place,
                'type_of_activities' =>json_encode($request->type_of_activities),
                'type_of_activities_other' =>$request->type_of_activities_other,
                'response_to_any_additional_information' =>$request->response_to_any_additional_information,
                'receive_more_information_from_c3sc' =>$request->receive_more_information_from_c3sc, // Yes/No
                'promotion_on_dewis_cymru_website' =>$request->promotion_on_dewis_cymru_website,   // Yes/No
                'know_more_dewis_cymru' =>$request->know_more_dewis_cymru,              // Yes/No
                'attend_events'=>$request-> attend_events,                      // Yes/No
                'gdpr' =>$request->gdpr, 
            ]);
        }
        organisation_local_activities::create([
            'org_id'=>$orgData->id,
            'name_of_group'=>$request->name_of_group,
            'frequency_of_group_meetings'=>$request->frequency_of_group_meetings,
            'activity_taking_place'=>$request->activity_taking_place,
            'type_of_activities' =>json_encode($request->type_of_activities),
            'type_of_activities_other' =>$request->type_of_activities_other,
            'response_to_any_additional_information' =>$request->response_to_any_additional_information,
            'receive_more_information_from_c3sc' =>$request->receive_more_information_from_c3sc, // Yes/No
            'promotion_on_dewis_cymru_website' =>$request->promotion_on_dewis_cymru_website,   // Yes/No
            'know_more_dewis_cymru' =>$request->know_more_dewis_cymru,              // Yes/No
            'attend_events'=>$request-> attend_events,                      // Yes/No
            'gdpr' =>$request->gdpr, 
        ]);

        (new Members_form_fillup_status)->updateFormSteps(
            $request->memberId,
            '5',
            'submited',
            Session::get('membershiptype_sess') === '2' ? '4' : '5'
        );
        return redirect()->route('membersDashboard');

    }

    public function cardsView(Request $request){
        $members = members::where('id', $this->memberID)->first();
        $organisation = organisation::where('member_id', $this->memberID)->first();


        return view('membersDashbaord.cards')->with(['members' => $members, 'organisation' => $organisation]);;
    }

    // Support -------
    public function supportView(){
        return view('membersDashbaord.support')->with([
            'support_list' => support_admin_members::getAllSupport($this->memberID),
        ]);
    }

    public function supportSubmit(Request $request){
        $rules = [
            'urgency_lavel' => ['required', 'in:1,2,3'],
            'subject'       => ['required', 'string', 'max:255'],
            'description'   => ['required', 'string'],
        ];
        $messages = [
            'urgency_lavel.required' => 'Please select the urgency level.',
            'urgency_lavel.in'       => 'Choose a valid urgency option.',
            'subject.required'       => 'Subject is required.',
            'subject.string'         => 'Subject must be text.',
            'subject.max'            => 'Subject cannot exceed 255 characters.',
            'description.required'   => 'Please enter a description.',
            'description.string'     => 'Description must be a valid text.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $data = [
            'member_id' => $request->memberId,
            'urgency_lable'  => $request->urgency_lavel,
            'support_subject'  =>  $request->subject,
            'support_message'  => $request->description,
        ];
        support_admin_members::createSupport($data);
        return redirect()->back();
    }

    // Profile ------
    public function profileView(){
        return view('membersDashbaord.profile')->with([
            "member" => $this->member,
            "organisation" => $this->organisation,
            "orgDetails" => $this->organisationDetails,
            "activity" => $this->organisationLocalActivities,
            "interest" => $this->memberActivity,
            "survey" => $this->memberNetworkSurvey,
            "formStep" => $this->formStep,
        ]);
    }


    public function resetPasswordView(){
        $lastSent = Session::get('reset_password_sent_at');

        // Check if OTP was sent less than 2 minutes ago
        if (!$lastSent || now()->diffInMinutes($lastSent) >= 2) {
            $otp = rand(100000, 999999);
            Session::put([
                'reset_password_otp' => $otp,
                'reset_password_sent_at' => now()
            ]);
    
            Mail::to($this->member->email)->send(new OtpMail($otp));
        }
        return view('membersDashbaord.resetPassword')->with([
            "member" => $this->member,
        ]);
    }

    public function resetPassword(Request $request){

        $rules=[
            'otp' => 'required',
            'password' => 'required|confirmed|min:8',
        ];

        $messages = [
            'otp.required' => 'OTP is required.',
            'email.required' => 'Email address is required.',
            'password.required' => 'Password is required.',
            'password.confirmed' => 'Password confirmation does not match.',
            'password.min' => 'Password must be at least 8 characters long.',
        ];


        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }


        if($request->otp == Session::get("reset_password_otp")){
            if($request->password === $request->password_confirmation){
                $this->member->update([
                    'password' => Hash::make($request->password),
                ]);
                Session::forget('reset_password_otp');
                return redirect()->back()->with('status', 'Password reset successfully. Please log in.');
            }else{
                return redirect()->back()->withErrors(['email' => 'No member found with this email.'])->withInput();
            }
        }else{
            return redirect()->back()->withErrors(['otp' => 'Invalid OTP.'])->withInput();
        }
    }

}
