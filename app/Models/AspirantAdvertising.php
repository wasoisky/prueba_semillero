<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AspirantAdvertising extends Model
{
    use HasFactory;

    protected $table = 'aspirant_advertising';
    protected $fillable = [
        'id_aspirant',
        'id_advertising'
    ];

    public function aspirant()
    {
        return $this->belongsTo(Aspirant::class, 'id_aspirant');
    }

    public function advertising()
    {
        return $this->belongsTo(Advertising::class, 'id_advertising');
    }
}
