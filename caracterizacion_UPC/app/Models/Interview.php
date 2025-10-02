<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Interview extends Model
{
    protected $table = 'interviews';

    protected $fillable = ['aspirant_id', 'user_id', 'date', 'description', 'status'];

    public function aspirant()
    {
        return $this->belongsTo(Aspirant::class, 'aspirant_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function interviewQuestions()
    {
        return $this->hasMany(InterviewQuestion::class, 'interview_id');
    }
}
