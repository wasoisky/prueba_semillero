<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InterviewQuestion extends Model
{
    protected $table = 'interview_questions';

    protected $fillable = ['interview_id', 'question_id', 'option_id', 'answer_text'];

    public function interview()
    {
        return $this->belongsTo(Interview::class, 'interview_id');
    }

    public function question()
    {
        return $this->belongsTo(InterviewQuestionBank::class, 'question_id');
    }

    public function option()
    {
        return $this->belongsTo(InterviewOption::class, 'option_id');
    }
}
