<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class support_admin_members extends Model
{
    //support_members_admin
    use HasFactory;
    protected $table = 'support_members_admin';
    protected $fillable =[
        'member_id',
        'urgency_lable',
        'support_subject',
        'support_message',
        'support_status',
    ];

    public static function allSupport(){
        return self::get();
    }

    public static function createSupport($data){
        return self::create($data);
    }

    public static function getAllSupport($memberId){
        return self::where('member_id', $memberId)->get();
    }

    public static function updateSupport($memberId, $supportId, $data){
        return self::where('member_id', $memberId)
            ->where('id', $supportId)
            ->update($data);
    }
}
