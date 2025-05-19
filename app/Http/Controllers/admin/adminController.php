<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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

use App\Models\support_admin_members;
use App\Models\support_chat;
use App\Models\listing_categories;
use App\Models\listing_location;

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

    public function notificationAdd(Request $request){
        $notificationStatus = $request->has('notification_status') ? true : false;

        $data = notification_main::where('notification_reason', $request->notification_reason)->first();
    
        if ($data) {
            $data->update([
                'notification_status' => $notificationStatus,
                'notification_message' => $request->notification_message,
            ]);
        } else {
            notification_main::create([
                'notification_message' => $request->notification_message,
                'notification_reason' => $request->notification_reason,
                'notification_status' => $notificationStatus,
            ]);
        }
        
        return redirect()->back()->with('success', 'Notification saved successfully.');

    }

    public function notificationStatusChange(Request $request){
        // Decrypt the notification ID
        $notificationId = Crypt::decrypt($request->notiId);

        // Update the notification status (either 1 for checked, 0 for unchecked)
        $status = $request->status == 1 ? 1 : 0;  // Ensure status is 1 or 0
        $notification = notification_main::where('id', $notificationId)->first();

        if ($notification) {
            $notification->update([
                'notification_status' => $status,
            ]);
            
            // Return a JSON response to confirm the update
            return response()->json([
                'success' => true,
                'message' => 'Notification status updated successfully.',
                'status' => $status,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Notification not found.',
            ]);
        }
    }

    public function notificationDelete(Request $request){
        $notificationId = Crypt::decrypt($request->notificationId);
        $notification = notification_main::find($notificationId);
    
        if ($notification) {
            $notification->delete();
            return redirect()->back()->with('success', 'Notification deleted successfully.');
        }

        return redirect()->back();
    }


    // Support ticket
    public function supportTicketsView(){
        $data = support_admin_members::allSupport();
        return view('adminDashboard.supportView', [
            "supportlist" => $data
        ]);
    }

    public function supportTicketSingleView(Request $request){
        $supportId = $request->supportId;
        $memeberId = Crypt::decrypt($request->memberId);
        $supportTicket = support_admin_members::getSupportByMemberIdAndSupportTicketID($memeberId, $supportId);

        $chats = support_chat::getSupportBasedOnTicketId($memeberId, $supportId);
        // dd($supportTicket);
        return view("adminDashboard.chatSupportSingleView",[
            "supportTicket" => $supportTicket,
            "chats" => $chats,
        ]);
    }

    public function supportChatAdmin(Request $request){
        $data = [
            'member_id' => $request->memberID,
            'admin_id' => $request->adminId,
            'support_ticket_id' => $request->supportTicketId,
            'chat_from_admin' => $request->message,
        ];
        support_chat::InsertChat($data);
        return redirect() -> back();
    }

    // Listing categories 
    public function listingCategories(){
        $categories = listing_categories::getAllCategories();
        return view("adminDashboard.listingTemplatesAdmin.categoriesView", [
            "categories" => $categories,
        ]);
    }



    public function listingCategoriesAdd(Request $request)
    {
        // Validate required fields
        // $request->validate([
        //     'categori_name' => 'required|string|max:255',
        //     'categori_icon' => 'nullable|string|max:255',
        //     'categori_slug' => 'nullable|string|max:255',
        // ]);

        $slug = $request->categori_slug;

        // Generate slug from name if not provided
        if (empty($slug)) {
            $slug = Str::slug($request->categori_name);
        }

        // Ensure slug is unique
        $originalSlug = $slug;
        while (listing_categories::getCategoriesBySlug($slug)) {
            $slug = $originalSlug . '-' . Str::random(5); // Append 5-char random string
        }

        $data = [
            'categories_name' => $request->categori_name,
            'categories_icon' => $request->categori_icon,
            'categories_slug' => $slug,
        ];

        listing_categories::addCategories($data);

        return redirect()->back();
    }

    public function listingCategoriesDelete(Request $request){
        listing_categories::deleteCategoriesById($request->cateId);
        return redirect()->back();
    }


    // Listing Location
    public function listingLocations(){

        $listingLocation = listing_location::getAllLocation();
        return view("adminDashboard.listingTemplatesAdmin.locationView",[
            "location" => $listingLocation,
        ]);
    }

    public function listingLocationsAdd(Request $request){

        $userSlug = $request->input('location_slug');

        if ($userSlug) {
            // If user provided a slug, check if it's already taken
            if (listing_location::getLocationBySlug($userSlug)) {
                throw ValidationException::withMessages([
                    'location_slug' => 'This slug is already in use. Please choose a different one.',
                ]);
            }
            $slug = $userSlug;
        } else {
            // Generate slug from name and ensure uniqueness
            $slug = Str::slug($request->input('location_name'));
            $originalSlug = $slug;
            $counter = 1;
            while (listing_location::getLocationBySlug($slug)) {
                $slug = $originalSlug . '-' . $counter++;
            }
        }
    
        $data = $request->only([
            'location_name',
            'location_latitude',
            'location_longititude',
            'location_google_address',
            'location_country',
            'location_zipcode',
            'location_raw_data',
        ]);
        $data['location_slug'] = $slug;
    
        listing_location::addLocation($data);
    
        return redirect()->back()->with('success', 'Location added successfully!');
    }


    public function listingLocationsDeleter(Request $request){
        listing_location::deleteLocation($request->locationID);
        return redirect()->back();
    }

    // listing
    public function addListingView(){
        $categories = listing_categories::getAllCategories();
        $locations = listing_location::getAllLocation();
        return view("adminDashboard.listingTemplatesAdmin.addlistingForm",[
            "locations"=>$locations,
            "categories" =>$categories,
        ]);
    }

    public function addListing(Request $request){
        dd($request);
    }

}
