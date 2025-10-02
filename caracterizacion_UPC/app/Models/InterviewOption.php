<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InterviewOption extends Model
{
    protected $table = 'interview_options';

    protected $fillable = ['question_id', 'description'];

    public function question()
    {
        return $this->belongsTo(InterviewQuestionBank::class, 'question_id');
    }
}
