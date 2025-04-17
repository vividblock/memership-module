<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class organisation extends Model
{
    use HasFactory;
    protected $table = 'organisation';
    protected $fillable = [
        'member_id',
        'organisation_name',
        'organisation_email',
        'correspondence_address',
        'city',
        'postcode',
        'country',
        'contact_number',
        'social_handle',
        'website',
        'organization_details',
        'organisation_request_descripiton'
    ];
}
