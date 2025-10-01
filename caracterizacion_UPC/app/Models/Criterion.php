<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Criterion extends Model
{
    protected $table = 'criterion';

    protected $fillable = ['description'];

    public function questions()
    {
        return $this->hasMany(Question::class, 'criterion_id');
    }
}
