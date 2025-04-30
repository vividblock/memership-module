<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

use App\Models\members;
use App\Models\organisation;

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
        ]);

        $rules =[
            'membershiptype' => 'required',
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'contactnumber' => 'required|digits_between',
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
            'contactnumber.digits_between' => 'Contact number must be between 10-15 digits.',
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


        return redirect()->route('membersRegistrationTwoView');
    }

    public function registrationTwoView(){
        if(!Session::get('membership_registration_one')){
            return redirect()->back();
        }
        return view('auth.membershipRegistrationTwo');
    }

    public function registrationTwo(Request $request){
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

        Session::forget([
            'membership_registration_one',
            'membershiptype_sess',
            'firstname_sess',
            'lastname_sess',
            'email_sess',
            'contactnumber_sess',
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


    public function membersEmailValidateApi(Request $request){
        
    }
}
