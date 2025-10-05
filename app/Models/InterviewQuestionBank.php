<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InterviewQuestionBank extends Model
{
    protected $table = 'interview_questions_bank';

    protected $fillable = ['description', 'type']; // type: open/close

    public function options()
    {
        return $this->hasMany(InterviewOption::class, 'question_id');
    }
}
