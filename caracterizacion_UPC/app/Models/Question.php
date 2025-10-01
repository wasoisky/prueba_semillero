<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'question';

    protected $fillable = [
        'test_id', 'question_type_id', 'criterion_id', 'description', 'is_mandatory'
    ];

    public function test()
    {
        return $this->belongsTo(Test::class, 'test_id');
    }

    public function questionType()
    {
        return $this->belongsTo(QuestionType::class, 'question_type_id');
    }

    public function criterion()
    {
        return $this->belongsTo(Criterion::class, 'criterion_id');
    }

    public function options()
    {
        return $this->hasMany(Option::class, 'question_id');
    }

    public function userAnswers()
    {
        return $this->hasMany(UserAnswer::class, 'question_id');
    }
}
