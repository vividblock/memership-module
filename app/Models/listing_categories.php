<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class listing_categories extends Model
{
    use HasFactory;
    protected $table = 'listing_categories';
    protected $fillable =[
        'categories_name',
        'categories_slug',
        'categories_icon',
        'categories_iamge',
    ];

    public static function addCategories($data){
        return self::create($data);
    }

    public static function getAllCategories(){
        return self::get();
    }

    public static function getCategoriesBySlug($slugId){
        return self::where('categories_slug', $slugId)->first();
    }

    public static function getCategoriesById($cateId){
        return self::where('id', $cateId)->first();
    }

    public static function updateCategoriesById($cateId, $data){
        return self::where('id', $cateId)->update(
            $data
        );
    }

    public static function deleteCategoriesById($cateId){
        return self::where('id', $cateId)->delete();
    }
}
