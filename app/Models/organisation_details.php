<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class organisation_details extends Model
{
    use HasFactory;
    protected $table = 'organisation_details';
    protected $fillable = [
        'org_id',
        'organisation_area',
        'organisation_part_of',
        'umbrella_body_details',
        'quality_marks',
        'date_accreditation_awarded',
        'date_accreditation_reviewed',
        'annual_turnover',
        'currently_employ',
        'volunteers_number',
        'registered_on',
        'support_to_recruit_volunteers',
        'collaboration_area_1',
        'collaboration_area_2',
        'collaboration_area_3',
    ];

    protected $casts = [
        'date_accreditation_awarded' => 'date',
        'date_accreditation_reviewed' => 'date',
    ];
}
