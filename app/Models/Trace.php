<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trace extends Model
{
    use HasFactory;

    protected $fillable = [
        'lat',
        'lon',
        'ele',
        'gpx_id',
        'tim',
        'dis',
        'sid',
    ];

    public function gpxes (){
        return $this->belongsTo(Gpx::class);
    }
}