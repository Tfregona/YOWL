<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'descripton',
        'image',
        'slug'
    ];

    public function post()
    {
    	return $this->hasMany(post::class, 'subcat_id');
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }

    public static function boot() {
        parent::boot();

        static::deleting(function($subcategory) {
            //remove related rows region and city
            $subcategory->post->each(function($post) {
                $post->comment()->delete();
            });
            $subcategory->post()->delete();
            return true;
        });
    }

}
