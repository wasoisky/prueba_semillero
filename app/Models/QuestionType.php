<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionType extends Model
{
    protected $table = 'question_type';

    protected $fillable = ['description'];

    public function questions()
    {
        return $this->hasMany(Question::class, 'question_type_id');
    }
}
