<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AspirantVisit extends Model
{
    use HasFactory;

    protected $table = 'aspirant_visit';
    protected $fillable = [
        'id_aspirant',
        'id_visit'
    ];

    public function aspirant()
    {
        return $this->belongsTo(Aspirant::class, 'id_aspirant');
    }

    public function visit()
    {
        return $this->belongsTo(Visit::class, 'id_visit');
    }
}
