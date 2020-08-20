<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable=[
    'filename','photoable_id','photoable_type'
    ];
    protected $table = 'photoable';

    public function photoable()
    {
     return $this->morphTo('App\Photo');

    }
}
