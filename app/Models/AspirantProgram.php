<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AspirantProgram extends Model
{
    protected $table = 'aspirant_programs';

    protected $fillable = ['aspirant_id', 'program_id', 'enrollment_date', 'status'];

    public function aspirant()
    {
        return $this->belongsTo(Aspirant::class, 'aspirant_id');
    }

    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id');
    }
}
