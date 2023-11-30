<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'date',
        'area',
        'layout',
        'topography',
        'distance',
        'eleAsc',
        'eleDsc',
        'distEff',
        'eleStart',
        'eleMax',
        'duration',
        'difficulty',
        'google',
        'hut',
        'dogFriendly',
        'comments' 
    ];
}
