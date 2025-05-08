<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class notification_members extends Model
{
    
    use HasFactory;
    protected $table = 'notification_info';
    protected $fillable =[
        'member_id',
        'notification_message',
        'notification_link',
        'notification_status',
        'notification_reason',
    ];

    public static function createNotification($data){
        return self::create($data);
    }

    public static function getNotification($memberId){
        return self::where('member_id', $memberId)->get();
        
    }

    public static function updateNotification($data){
        return self::where('member_id', $data['member_id'])
               ->where('id', $data['notification_id'])
               ->update($data);
    }
}
