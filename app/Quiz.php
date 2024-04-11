<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $guarded = [];
    protected $table = 'quizs';


    public function questions()
    {
        return $this->hasMany('App\QuizQuestion', 'quiz_id');
    }

}
