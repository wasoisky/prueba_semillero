<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $table = 'option';

    protected $fillable = ['order', 'question_id', 'description'];

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }

    public function userAnswers()
    {
        return $this->hasMany(UserAnswer::class, 'option_id');
    }
}
