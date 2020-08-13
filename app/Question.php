<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillabl=
    [
      'title',
      'answers',
      'right_answers',
      'score'

      ];

      public function quiz()
      {
        return $this->belongsTo('App\Quiz');
      }
}
