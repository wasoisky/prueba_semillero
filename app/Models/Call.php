<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Call extends Model
{
    protected $table = 'calls';

    protected $fillable = ['aspirant_id', 'user_id', 'date', 'contact_person', 'response'];

    public function aspirant()
    {
        return $this->belongsTo(Aspirant::class, 'aspirant_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
