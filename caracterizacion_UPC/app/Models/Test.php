<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    protected $table = 'test';

    protected $fillable = ['characterization_id', 'description'];

    public function characterization()
    {
        return $this->belongsTo(Characterization::class, 'characterization_id');
    }

    public function questions()
    {
        return $this->hasMany(Question::class, 'test_id');
    }
}
