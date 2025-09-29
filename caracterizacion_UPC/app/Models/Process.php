<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Process extends Model
{
    use HasFactory;

    protected $table = 'process';
    protected $fillable = [
        'id_aspirant',
        'status',
        'location',
        'update_date'
    ];

    public function aspirant()
    {
        return $this->belongsTo(Aspirant::class, 'id_aspirant');
    }
}
