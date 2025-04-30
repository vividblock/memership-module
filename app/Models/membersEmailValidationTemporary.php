<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class membersEmailValidationTemporary extends Model
{
    use HasFactory;
    protected $table = 'temporary_members_validation';
    protected $fillable =[
        'members_email',
        'otp',
        'email_validation_status',
    ];
}
