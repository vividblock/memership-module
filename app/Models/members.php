<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class members extends Model
{
    use HasFactory;
    protected $table = 'members';
    protected $fillable =[
        'members_c3sc_id',
        'username',
        'email',
        'firstname',
        'lastname',
        'password',
        'user_status',
        'contactnumber',
        'membership_type',
        'membership_expiry',
        'free_membership_individual',
        'memebership_package',
    ];

    // Ensure membership_expiry is treated as a datetime
    protected $casts = [
        'membership_expiry' => 'datetime',
    ];
}
