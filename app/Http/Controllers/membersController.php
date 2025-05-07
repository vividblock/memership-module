<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

use App\Models\members;
use App\Models\organisation;
use App\Models\members_two;
use App\Models\organisation_details;
use App\Models\member_network_survey;
use App\Models\organisation_local_activities;
use App\Models\Members_form_fillup_status;

class membersController extends Controller
{
    public function dashboard(){
        $members = members::where('id', Session::get('members_id_sess'))->first();
        $MembersformStep = new Members_form_fillup_status;
        $formStep = $MembersformStep->getFormSteps(Session::get('members_id_sess'));

        return view('membersDashbaord.dashboard')->with([
            'members' => $members,
            'form_steps' => $formStep,
        ]);
    }

    public function memberformOneView(Request $request){
        $members = members::where('id', $request->memberId)->first();
        $organisation = organisation::where('member_id', $request->memberId)->first();
        $MembersformStep = new Members_form_fillup_status;
        $formStep = $MembersformStep->getFormSteps(Session::get('members_id_sess'));
        return view('membersDashbaord.memberFormOne')->with([
            'members' => $members, 
            'organisation' => $organisation,
            'form_steps' => $formStep,
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
        $memberformStep->updateFormSteps($request->memberId, '1', "false" , $request->membershiptype == "2" ? "5" : "6");
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
        $organisation = organisation::where('member_id', $request->memberId)->first();
        $MembersformStep = new Members_form_fillup_status;
        $formStep = $MembersformStep->getFormSteps(Session::get('members_id_sess'));
        return view('membersDashbaord.memberFormThree')->with([
            'members' => $members, 
            'organisation' => $organisation,
            'form_steps' => $formStep,
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
    public function memberformThree(Request $request)
    {
        $data = [
            'your_activity'     => $request->your_activity,
            'other_activity'    => $request->other_activity,
            'special_interest'  => $request->special_interest,
            'short_description' => $request->description_group,
        ];

        // If a file was uploaded, save it and store path
        if ($request->hasFile('documents')) {
            $file = $request->file('documents')[0]; // get first file
            if ($file->isValid()) {
                $path = $file->store('documents', 'public');
                $data['governing_documents'] = $path;
            }
        }

        // Save or update
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
            Session::get('membershiptype_sess') === '2' ? '5' : '6'
        );

        return redirect()->route('memberformFourView', $request->memberId);
    }


    public function memberformFourView(Request $request){
        return view('membersDashbaord.memberFormFour');
    }

    public function memberformFour(Request $request){
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
        return redirect()->route('memberformFiveView', $request->memberId);
        
    }

    public function memberformFiveView(Request $request){
        return view('membersDashbaord.memberFormFive');
    }

    public function memberformFive(Request $request){

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
        if(Session::get('membershiptype_sess')=== "2"){
            return redirect()->route('membersDashboard');
        }
        return redirect()->route('memberformSixView', $request->memberId);
    }

    public function memberformSixView(Request $request){
        return view('membersDashbaord.memberFormSix');
    }

    public function memberformSix(Request $request){
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
        return redirect()->route('membersDashboard');

    }


    public function cardsView(Request $request){
        $members = members::where('id', Session::get('members_id_sess'))->first();
        $organisation = organisation::where('member_id', Session::get('members_id_sess'))->first();


        return view('membersDashbaord.cards')->with(['members' => $members, 'organisation' => $organisation]);;
    }
}
