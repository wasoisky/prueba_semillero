<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    use HasFactory;

    protected $table = 'visit';
    protected $fillable = [
        'user_id',
        'place',
        'date',
        'purpose'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function aspirantVisits()
    {
        return $this->hasMany(AspirantVisit::class, 'id_visit');
    }
}
