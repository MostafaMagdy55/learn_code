<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\FuncCall;

class Track extends Model
{
    protected $fillable=[
        'name'
    ];
    public function usres()
    {
        return $this->belongsTo('App\User');

    }
    public function courses()
    {

        return $this->hasMany('App\Course');
    }
}
