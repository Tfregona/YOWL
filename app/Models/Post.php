<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','subcat_id','title','slug','content','url'];

public function user(){
        return $this->belongsTo(User::class);
    }
public function comment(){
        return $this->hasMany(Comment::class, 'user_id', 'post_id');
    }
public function subcategory(){
        return $this->belongsTo(SubCategory::class)->withDefault(['title'=>'Pas de catégorie définie.',
    ]);
    } 
}
