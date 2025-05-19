<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class listing extends Model
{
    use HasFactory;
    protected $table = 'listing';
    protected $fillable =[
        'member_id',
        'listing_status',
        'listing_name',
        'listing_slug',
        'listing_description',
        'location_id',
        'categories_id',
        'brand_logo',
        'gallery',
        'background_image',
        'open_time_table',
        'tags_id',
        'contact_number',
        'logititude_lattidue',
        'exact_location',
        'website',
        'social_links',
    ];

    public static function createListing($data){
        return self::create($data);
    }


    public static function deleteListing($listingId){
        return self::where('id', $listingId)->delete();
    }

}
