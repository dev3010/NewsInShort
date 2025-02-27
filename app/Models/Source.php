<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    public function articles(){
        return $this->hasMany(Article::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
}
