<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aspirant extends Model
{
    use HasFactory;

    protected $table = 'aspirant';
    protected $fillable = [
        'id_user',
        'id_program',
        'candidate_program'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function aspirantVisits()
    {
        return $this->hasMany(AspirantVisit::class, 'id_aspirant');
    }

    public function aspirantAdvertisings()
    {
        return $this->hasMany(AspirantAdvertising::class, 'id_aspirant');
    }

    public function calls()
    {
        return $this->hasMany(CallModel::class, 'aspirant_id');
    }

    public function processes()
    {
        return $this->hasMany(Process::class, 'id_aspirant');
    }
}
