<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $table = 'programs'; // o 'program' si el nombre en la base es singular

    protected $fillable = ['code', 'description', 'faculty_id'];

    public function faculty()
    {
        return $this->belongsTo(Faculty::class, 'faculty_id');
    }

    // Relación N:M con aspirants a través de aspirant_programs
    public function aspirants()
    {
        return $this->belongsToMany(
            Aspirant::class,
            'aspirant_programs',
            'program_id',
            'aspirant_id'
        )->withPivot(['enrollment_date', 'status']);
    }

    public function aspirantPrograms()
    {
        return $this->hasMany(AspirantProgram::class, 'program_id');
    }
}
