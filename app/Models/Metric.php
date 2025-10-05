<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Metric extends Model
{
    use HasFactory;

    protected $table = 'metric';
    protected $fillable = [
        'id_advertising',
        'visits',
        'coments',
        'measured_at_datetime'
    ];

    public function advertising()
    {
        return $this->belongsTo(Advertising::class, 'id_advertising');
    }
}
