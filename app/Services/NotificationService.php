<?php

namespace App\Services;

use App\Models\notification_main;
use Illuminate\Support\Facades\Mail;

class NotificationService
{
    public function sendMail($reason, $user)
    {
        // Get the template based on reason
        $notification = notification_main::where('notification_reason', $reason)
            ->where('notification_status', true)
            ->first();

        if (!$notification) {
            return false;
        }

        // Replace placeholders in the message
        $message = str_replace([
            '{{FirstName}}',
            '{{LastName}}',
            '{{Email}}',
            '{{MemberID}}',
            '{{Username}}',
            '{{ContactNumber}}',
        ], [
            $user->firstname ?? '',
            $user->lastname ?? '',
            $user->email ?? '',
            $user->members_c3sc_id ?? '',
            $user->username ?? '',
            $user->ccontactnumber ?? '',
        ], $notification->notification_message);

        // Send mail using Laravel's Mailable
        Mail::to($user->email)->send(new \App\Mail\GenericMail($message));

        return true;
    }
}
