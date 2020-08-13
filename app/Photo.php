<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable=[
    'filename',
    ];

    public function photoable()
    {
     return $this->morphTo('App\Photo');

    }
}
