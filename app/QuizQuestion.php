<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuizQuestion extends Model
{
    protected $guarded = [];
    protected $table = 'quiz_questions';


    /**
     * Get the category associated with the question.
     */
    public function question()
    {
        return $this->belongsTo('App\Question', 'question_id');
    }
}
