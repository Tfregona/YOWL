<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'slug'
    ];


    public function subcategory()
    {
    	return $this->hasMany(subcategory::class, 'cat_id');
    }

    public static function boot() {
        parent::boot();

        static::deleting(function($category) {
            //remove related rows region and city
            $category->subcategory->each(function($subcategory) {
                $subcategory->post()->delete();
            });
            $category->subcategory()->delete();
            return true;
        });
    }

}
