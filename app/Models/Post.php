<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'status'];
    protected $hidden = ['created_at', 'updated_at'];

    public function trends(){
        return $this->belongsToMany(Trend::class, 'post_trend');
    }

    public function pages(){
        return $this->belongsToMany(Trend::class, 'post_page');
    }

    public function groups(){
        return $this->belongsToMany(Trend::class, 'post_group');
    }

    public function medias(){
        return $this->morphToMany(Media::class, 'mediable');
    }

//    public function medias(){
//        return $this->hasMany(Media::class, 'media');
//    }


}
