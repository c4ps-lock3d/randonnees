<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gpx extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'date',
        'distance',
        'eleAsc',
        'eleDsc',
        'distEff',
        'eleStart',
        'eleMax',
        'duration',
        'canton',
        'commune',
        'hut',
        'comments',
        'gpxpath',
        'cat_layout_id',
        'cat_topography_id',
        'cat_difficulty_id',
        'cat_dogfriendly_id',
        'image'
    ];

    public function cat_layout (){
        return $this->belongsTo(CatLayout::class);
    }
    public function cat_difficulty (){
        return $this->belongsTo(CatDifficulty::class);
    }
    public function cat_dogfriendly (){
        return $this->belongsTo(CatDogfriendly::class);
    }
    public function tags (){
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }
    public function traces (){
        return $this->belongsToMany(Trace::class)->withTimestamps();
    }
}
