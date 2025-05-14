<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Mail\MailTemplateOne;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;

use App\Models\admin\admin_smtp_settings;
use App\Models\members;
use App\Models\organisation;
use App\Models\members_two;
use App\Models\organisation_details;
use App\Models\member_network_survey;
use App\Models\organisation_local_activities;
use App\Models\Members_form_fillup_status;
use App\Models\notification_main;

class adminController extends Controller
{
    // GLOBAL FUNCTIONS
    protected $members;
    protected $organisation;


    public function __construct(){

    }


    public function index(){
        return view('adminDashboard.dashboard');
    }




    // SMTP SETTINGS
    public function SmtpIntrigationView(){
        $smtp_data = admin_smtp_settings::first();
        if(!$smtp_data){
            admin_smtp_settings::create([
                'host'     => null,
                'username' => null,
                'password' => null,
                'email'    => null,
                'port'     => null,
                'protocol' => null,
                'status' => 0,
            ]);
        }
        return view('adminDashboard.smtpSettings')->with(['smtp_data'=>$smtp_data]);
    }

    public function SmtpIntrigationSave(Request $request){
        // dd($request);
        $smtp_data = admin_smtp_settings::first();
        if (!$smtp_data) {
            admin_smtp_settings::create([
                'host'     => $request->smtp_host,
                'username' => $request->smtp_username,
                'password' => $request->smtp_password,
                'email'    => $request->smtp_email,
                'port'     => $request->smtp_port,
                'protocol' => $request->smtp_protocol,
                'status' => 0,
            ]);
        } else {
            $smtp_data->update([
                'host'     => $request->smtp_host,
                'username' => $request->smtp_username,
                'password' => $request->smtp_password,
                'email'    => $request->smtp_email,
                'port'     => $request->smtp_port,
                'protocol' => $request->smtp_protocol,
                'status' => 0,
            ]);
        }

        return redirect()->back()->with('success', 'Smtp Settings saved successfully.');

    }

    public function TestMailSend(Request $request){
        $smtp = admin_smtp_settings::first();
        try {
            Mail::to($request->mailTest)->send(new MailTemplateOne());
            $smtp->update(['status' => 1]);
            return response()->json([
                'success' => true,
                'message' => 'Test mail sent successfully.'
            ]);
        } catch (\Throwable $th) {
            $smtp->update(['status' => 0]);
            return response()->json([
                'success' => false,
                'message' => 'Failed to send test mail.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }




    // Members SETTINGS
    public function WaitingMembersView(){
        // Get all submitted form statuses
        $submittedFormMemberIds = Members_form_fillup_status::where('form_fillup_status', 'submited')
        ->pluck('member_id')
        ->toArray();

        // Filter members whose form is submitted
        $members = members::whereIn('id', $submittedFormMemberIds)->get();

        // Get organisations related to those members
        $organisation = organisation::whereIn('member_id', $submittedFormMemberIds)->get();

        return view('adminDashboard.waitingMembers', [
            'members' => $members,
            'organisation' => $organisation,
        ]);
    }

    public function waitingMembersSingleView(Request $request){
        $memberId = Crypt::decrypt($request->memberId);

        $members = members::where('id', $memberId)->first();
        $organisation = organisation::where('member_id', $memberId)->first();
        $members_two = members_two::where('member_id', $memberId)->first();
        $organisation_details = organisation_details::where('org_id', $organisation->id)->first();
        $member_network_survey = member_network_survey::where('member_id', $memberId)->first();
        $organisation_local_activities = organisation_local_activities::where('org_id', $organisation->id)->first();
        // if($members){
        return view('adminDashboard.waitingMembersSingleView')->with([
            "members"=> $members,
            "organisation" => $organisation,
            "members_two" => $members_two,
            "organisation_details" => $organisation_details,
            "member_network_survey" => $member_network_survey,
            "organisation_local_activities" => $organisation_local_activities,
        ]);
        // }

    }



    public function abandonedMembersList(){

        // Get all rows from Members_form_fillup_status where form_fillup_status is not 'submitted'
        $notSubmittedForms = Members_form_fillup_status::where('form_fillup_status', '!=', 'submited')->get();

        // Get the related members and organisations based on those form IDs
        $members = members::whereIn('id', $notSubmittedForms->pluck('member_id'))->get();
        $organisation = organisation::whereIn('member_id', $notSubmittedForms->pluck('member_id'))->get();

        return view('adminDashboard.abandonedMembersList',[
            'members' => $members,
            'organisation' => $organisation,
            'formStaus' => $notSubmittedForms,
        ]);
    }




    // Notification List
    public function notificationList(){
        
        return view('adminDashboard.notification',[
            'notification'=>notification_main::get(),
        ]);
    }
}
