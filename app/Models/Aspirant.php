<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aspirant extends Model
{
    protected $table = 'aspirants';

    protected $fillable = ['user_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relación N:M con programas a través de aspirant_programs
    public function programs()
    {
        return $this->belongsToMany(
            Program::class,
            'aspirant_programs',
            'aspirant_id',
            'program_id'
        )->withPivot(['enrollment_date', 'status']);
    }

    public function aspirantPrograms()
    {
        return $this->hasMany(AspirantProgram::class, 'aspirant_id');
    }

    public function calls()
    {
        return $this->hasMany(Call::class, 'aspirant_id');
    }

    public function interviews()
    {
        return $this->hasMany(Interview::class, 'aspirant_id');
    }

    public function visits()
    {
        return $this->hasMany(Visit::class, 'aspirant_id');
    }
}
