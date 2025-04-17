<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Mail\MailTemplateOne;
use Illuminate\Support\Facades\Mail;



use App\Models\admin\admin_smtp_settings;
use App\Models\members;
use App\Models\organisation;
use App\Models\members_two;
use App\Models\organisation_details;
use App\Models\member_network_survey;
use App\Models\organisation_local_activities;

class adminController extends Controller
{
    public function index(){
        return view('adminDashboard.dashboard');
    }

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

    public function waitingMembersView(){
        $members = members::get();
        $organisation = organisation::get();
        return view('adminDashboard.waitingMembers')->with([
            'members'=>$members,
            'organisation'=>$organisation,
        ]);
    }
}
