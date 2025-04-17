<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class member_network_survey extends Model
{
    use HasFactory;
    protected $table = 'network_surveys';
    protected $fillable =[
        'member_id',
        'networks',
        'network_interst',
        'informal_discussion',
        'how_to_use_this',
        'how_u_use_this_details_media',
        'member_signed_date',
        'member_signed',
    ];
}
