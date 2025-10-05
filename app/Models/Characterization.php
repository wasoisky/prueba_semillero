<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Characterization extends Model
{
    protected $table = 'characterization';

    protected $fillable = ['description', 'date_start', 'date_end', 'semester'];

    public function tests()
    {
        return $this->hasMany(Test::class, 'characterization_id');
    }
}
