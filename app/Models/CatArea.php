<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatArea extends Model
{
    use HasFactory;
    
    protected $fillable = ['name'];

    public function gpxes(){
        return $this->hasMany(Gpx::class);
    }
}
