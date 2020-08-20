<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable=[
        'title',
        'status',
        'link',
        'track_id',

    ];

    public function photo() {
        return $this->morphOne('App\Photo', 'photoable');
    }

    public function usres()
    {
        return $this->belongsTo('App\User');

    }
    public function quizzes()
    {
        return $this->hasMany('App\Quiz');
    }


    public function track()
    {
      return $this->belongsTo('App\Track');

    }
    public function videos()
    {
        return $this->hasMany('App\Video');
    }
}
