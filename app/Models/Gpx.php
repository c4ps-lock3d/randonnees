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
        'google',
        'hut',
        'comments',
        'gpxpath',
        'cat_area_id',
        'cat_layout_id',
        'cat_topography_id',
        'cat_difficulty_id',
        'cat_dogfriendly_id'
    ];

    public function cat_area (){
        return $this->belongsTo(CatArea::class);
    }
    public function cat_layout (){
        return $this->belongsTo(CatLayout::class);
    }
    public function cat_topography (){
        return $this->belongsTo(CatTopography::class);
    }
    public function cat_difficulty (){
        return $this->belongsTo(CatDifficulty::class);
    }
    public function cat_dogfriendly (){
        return $this->belongsTo(CatDogfriendly::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }
}
