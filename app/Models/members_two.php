<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class members_two extends Model
{
    use HasFactory;
    protected $table = 'members_interest';
    protected $fillable =[
        'member_id',
        'your_activity',
        'other_activity',
        'special_interest',
        'short_description',
    ];
}
