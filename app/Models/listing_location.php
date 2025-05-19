<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class listing_location extends Model
{
    use HasFactory;
    protected $table = 'listing_location';
    protected $fillable =[
        'location_name',
        'location_slug',
        'location_latitude',
        'location_longititude',
        'location_google_address',
        'location_country',
        'location_zipcode',
        'location_raw_date',
    ];

    public static function addLocation($data){
        return self::create($data);
    }

    public static function getAllLocation(){
        return self::get();
    }

    public static function getLocationById($locationId){
        return self::where("id", $locationId)->first();
    }

    public static function getLocationBySlug($locationSlug){
        return self::where("location_slug", $locationSlug)->first();
    }

    public static function deleteLocation($locationId){
        return self::where("id", $locationId)->delete();
    }
}
