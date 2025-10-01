<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $table = 'program';

    protected $fillable = ['code', 'description', 'faculty_id'];

    public function faculty()
    {
        return $this->belongsTo(Faculty::class, 'faculty_id');
    }

    public function aspirants()
    {
        return $this->hasMany(Aspirant::class, 'id_program');
    }

    public function studentDetails()
    {
        return $this->hasMany(StudentDetails::class, 'program_id');
    }
}
