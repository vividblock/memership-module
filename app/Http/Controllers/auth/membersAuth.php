<?php

namespace App\Http\Controllers\auth;
use Carbon\Carbon;

use App\Mail\OtpMail;
use Illuminate\Support\Facades\Mail;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

use App\Models\members;
use App\Models\organisation;
use App\Models\admin\admin_smtp_settings;
use App\Models\membersEmailValidationTemporary;
use App\Models\Members_form_fillup_status;

class membersAuth extends Controller
{
    public function registrationOneView(){
        return view('auth.membershipRegistrationOne');
    }

    public function registrationOne(Request $request){

        // dd($request);
        Session::put([
            'membership_registration_one' => true,
            'membershiptype_sess' => $request->membershiptype,
            'firstname_sess' => $request->firstname,
            'lastname_sess' => $request->lastname,
            'email_sess' => $request->email,
            'contactnumber_sess' => $request->contactnumber,
            'email_validate_by_otp' => $request->email_otp_status,
        ]);

        $rules =[
            'membershiptype' => 'required',
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'contactnumber' => 'required',
            // 'memebership_package'=>'required'
        ];

        $messages = [
            'membershiptype.required' => 'Please select a membership type.',
            // 'memebership_package.required'=>'Please select a membership package.',
            
            'firstname.required' => 'First name is required.',
            'firstname.string' => 'First name must be a valid text.',
            'firstname.max' => 'First name cannot exceed 255 characters.',
            
            'lastname.required' => 'Last name is required.',
            'lastname.string' => 'Last name must be a valid text.',
            'lastname.max' => 'Last name cannot exceed 255 characters.',
            
            'email.required' => 'Email address is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.max' => 'Email cannot exceed 255 characters.',
        
            'contactnumber.required' => 'Contact number is required.',
            // 'contactnumber.digits_between' => 'Contact number must be between 10-15 digits.',
            // 'contactnumber.numeric' => 'Only numbers are allowed in the contact number.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $members = members::where('email', $request->email)->first();
        if($members){
            return redirect()->back()->withErrors(['email' => 'Email allready used.'])->withInput();
        }

        $membersEmailValidation = membersEmailValidationTemporary::where('members_email', $request->email)->latest()->first();
        if( $membersEmailValidation && $membersEmailValidation->email_validation_status == '0'){

            return redirect()->back()->withErrors(['email' => 'Please verify your email.'])->withInput();

        }
        
        if($membersEmailValidation === null){
            return redirect()->back()->withErrors(['email' => 'Please verify your email.'])->withInput();
        }


        return redirect()->route('membersRegistrationTwoView');
    }

    public function registrationTwoView(){
        if(!Session::get('membership_registration_one')){
            return redirect()->back();
        }
        return view('auth.membershipRegistrationTwo');
    }

    public function registrationTwo(Request $request){
        Session::put([
            'organisationname_sess' => $request->organisationname,
            'correspondenceaddress_sess' => $request->correspondenceaddress,
            'city_sess' => $request->city,
            'postcode_sess' => $request->postcode,
            'organisationemail_sess' => $request->organisationemail,
            'password_sess' => $request->password,
            'organisation_request_descripiton_sess' => $request->organisation_request_descripiton,
        ]);


        $rules = [
            'organisationname' => 'required|string|max:255',
            'correspondenceaddress' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'postcode' => 'required|string|max:255',
            'organisationemail' => 'required|email|max:255',
            'password' => 'required|string|min:8',
            
        ];

        $messages = [
            'organisationname.required' => 'Organisation name is required.',
            'organisationname.string' => 'Organisation name must be a valid text.',
            'organisationname.max' => 'Organisation name cannot exceed 255 characters.',
        
            'correspondenceaddress.required' => 'Correspondence address is required.',
            'correspondenceaddress.string' => 'Correspondence address must be valid text.',
            'correspondenceaddress.max' => 'Correspondence address cannot exceed 255 characters.',
        
            'city.required' => 'City is required.',
            'city.string' => 'City must be a valid text.',
            'city.max' => 'City cannot exceed 255 characters.',
        
            'postcode.required' => 'Postcode is required.',
            'postcode.string' => 'Postcode must be valid text.',
            'postcode.max' => 'Postcode cannot exceed 255 characters.',
        
            'organisationemail.required' => 'Email address is required.',
            'organisationemail.email' => 'Please enter a valid email address.',
            'organisationemail.max' => 'Email cannot exceed 255 characters.',
        
            'password.required' => 'Password is required.',
            'password.string' => 'Password must be a valid string.',
            'password.min' => 'Password must be at least 8 characters long.',

        ];

        $organisation_description = null;

        if(Session::get('membershiptype_sess') == 2){
            $rules = [
                'organisation_request_descripiton' => 'required|string',
            ];

            $messages = [
                'organisation_request_descripiton.required' => 'Please provide brif Description.',
                'organisation_request_descripiton.string' => 'Description must be a valid string.',
            ];

            $organisation_description = $request->organisation_request_descripiton;

        }

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $organisation = organisation::where('organisation_email', $request->organisationemail)->first();

        if($organisation){
            return redirect()->back()->withErrors(['organisationemail' => 'Email allready used.'])->withInput();
        }

        


        $members = members::create([
            'members_c3sc_id' => rand(1000,9999),
            'membership_type' => Session::get('membershiptype_sess'),
            'username' => 'c3sc@'.rand(10,999).'@'.Session::get('firstname_sess'),
            'email' => Session::get('email_sess'),
            'firstname' => Session::get('firstname_sess'),
            'lastname' => Session::get('lastname_sess'),
            'password' => Hash::make($request->password),
            'contactnumber' => Session::get('contactnumber_sess'),
            'memebership_package' => $request->membership_package,
            'free_membership_individual'=>$request->free_membership_individual,
        ]);

        $organisation = organisation::create([
            'member_id'=> $members->id,
            'organisation_name' => $request->organisationname,
            'organisation_email' => $request->organisationemail,
            'correspondence_address' => $request->correspondenceaddress,
            'city' => $request->city,
            'postcode' => $request->postcode,
            'organisation_request_descripiton' => $organisation_description
        ]);


        $formSteps = new Members_form_fillup_status;
        $formSteps->registerFormSteps($members->id, Session::get('membershiptype_sess') == 2 ? '4' : '5');

        Session::forget([
            'membership_registration_one',
            'membershiptype_sess',
            'firstname_sess',
            'lastname_sess',
            'email_sess',
            'contactnumber_sess',
            'organisationname_sess',
            'correspondenceaddress_sess',
            'city_sess',
            'postcode_sess',
            'organisationemail_sess',
            'password_sess',
            'organisation_request_descripiton_sess',
        ]);

        Session::put([
            'members_in_sess' => true,
            'members_id_sess' => $members->id,
            'members_firstname_sess' => $members->firstname,
            'members_lastname_sess' => $members->lastname,
            'organisation_id_sess' => $organisation->id,
        ]);



        return redirect()->route('membersDashboard');
    }

    public function membersloginView(){
        return view('auth.membershipLogin');
    }

    public function memberslogin(Request $request){
        $rules =[
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:8',
        ];

        $messages = [
            'username.required' => 'Username is required.',
            'username.string' => 'Username must be a valid text.',
            'username.max' => 'Username cannot exceed 255 characters.',
        
            'password.required' => 'Password is required.',
            'password.string' => 'Password must be a valid string.',
            'password.min' => 'Password must be at least 8 characters long.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $members = members::where('username', $request->username)->orWhere('email', $request->username)->orWhere('members_c3sc_id', $request->username)->first();
        if(!$members){
            return redirect()->back()->withErrors(['username' => 'Username or Email or Member not exsists'])->withInput();
        }

        if(!Hash::check($request->password, $members->password)){
            return redirect()->back()->withErrors(['password' => 'Password not matched.'])->withInput();
        }

        $organisation = organisation::where('member_id', $members->id)->first();

        Session::put([
            'members_in_sess' => true,
            'members_id_sess' => $members->id,
            'members_firstname_sess' => $members->firstname,
            'members_lastname_sess' => $members->lastname,
            'organisation_id_sess' => $organisation->id,
        ]);

        return redirect()->route('membersDashboard');
    }


    public function membersEmailValidateApi(Request $request)
    {
        $smtp = admin_smtp_settings::first();
    
        if ($smtp->status == 1) {
            try {
                $existing = MembersEmailValidationTemporary::where('members_email', $request->email)->latest()->first();
    
                if ($existing && $existing->created_at->diffInMinutes(Carbon::now()) < 2) {
                    return response()->json([
                        'success' => false,
                        'message' => 'OTP already sent. Please wait 2 minutes before requesting again.',
                    ]);
                }
    
                $otp = rand(100000, 999999);
    
                // Save OTP to DB
                MembersEmailValidationTemporary::create([
                    'members_email' => $request->email,
                    'otp' => $otp,
                    'email_validation_status' => '0',
                ]);
    
                // Send mail
                Mail::to($request->email)->send(new OtpMail($otp));
    
                return response()->json([
                    'success' => true,
                    'message' => 'Please check your email. We’ve sent an OTP to '.$request->email,
                ]);
            } catch (\Throwable $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Something went wrong. Please contact support.',
                    'error'   => $e->getMessage(),
                ], 500);
            }
        }
    
        return response()->json([
            'success' => false,
            'message' => 'SMTP is disabled. Please contact admin.',
        ]);
    }


    public function otpVerify(Request $request)
    {
        $membersEmail = MembersEmailValidationTemporary::where('members_email', $request->email)->latest()->first();
    
        if (!$membersEmail) {
            return response()->json([
                'success' => false,
                'message' => 'Email not found.',
            ]);
        }
    
        if ($membersEmail->otp == $request->otp) {
            $membersEmail->email_validation_status = '1'; // Must be string if using enum('0','1')
            $membersEmail->save();
    
            return response()->json([
                'success' => true,
                'message' => 'OTP verified successfully.',
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Invalid OTP.',
            ]);
        }
    }

    public function emailAlreadyExists(Request $request){
        $registrationMail = members::where('email', $request->email)->first();
        if($registrationMail){
            return response()->json([
                'success' => true,
                'message' => 'This email already exists.',
            ]);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'This email is an new email.',
            ]);
        }
    }
    
}
