<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    protected $table = 'faculty';

    protected $fillable = ['code', 'description'];

    public function programs()
    {
        return $this->hasMany(Program::class, 'faculty_id');
    }
}
