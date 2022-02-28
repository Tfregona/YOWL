<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    use HasFactory;


    protected $fillable = ['user_id','post_id','content'];

public function user(){
        return $this->belongsTo(User::class);
    }
public function post(){
        return $this->belongsTo(Post::class);
    }
/* public function category(){
        return $this->belongsTo(Category::class)->withDefault(['title'=>'Pas de catégorie définie.',
    ]);
    } */
}
