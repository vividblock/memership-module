<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class support_chat extends Model
{
    use HasFactory;
    protected $table = 'support_chat';
    protected $fillable = [
        'member_id',
        'admin_id',
        'support_ticket_id',
        'chat_from_admin',
        'chat_from_member',
        'files_urls_admin',
        'files_urls_member',
    ];

    public static function getSupportBasedOnTicketId($memberID, $supportTicketId){
        return self::where('member_id', $memberID)->where('support_ticket_id', $supportTicketId)->get();
    }

    public static function InsertChat($data){
        return self::create($data);
    }




}
