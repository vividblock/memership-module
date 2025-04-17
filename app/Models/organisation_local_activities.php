<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class organisation_local_activities extends Model
{
    //
    use HasFactory;
    protected $table = 'organisation_local_activities';
    protected $fillable = [
        'org_id',
        'name_of_group',
        'frequency_of_group_meetings',
        'activity_taking_place',
        'type_of_activities', // stores multiple selected options
        'type_of_activities_other',
        'response_to_any_additional_information',
        'receive_more_information_from_c3sc', // Yes/No
        'promotion_on_dewis_cymru_website',   // Yes/No
        'know_more_dewis_cymru',              // Yes/No
        'attend_events',                      // Yes/No
        'gdpr', 
    ];
}
