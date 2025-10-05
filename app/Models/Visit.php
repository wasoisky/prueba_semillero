<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $table = 'visits';

    protected $fillable = ['aspirant_id', 'who_went', 'date', 'place', 'purpose', 'user_id'];

    public function aspirant()
    {
        return $this->belongsTo(Aspirant::class, 'aspirant_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
