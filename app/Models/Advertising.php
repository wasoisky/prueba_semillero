<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertising extends Model
{
    use HasFactory;

    protected $table = 'advertising';
    protected $fillable = [
        'type',
        'content',
        'channel',
        'description',
        'start_date',
        'end_date'
    ];

    public function metrics()
    {
        return $this->hasMany(Metric::class, 'id_advertising');
    }

    public function aspirantAdvertisings()
    {
        return $this->hasMany(AspirantAdvertising::class, 'id_advertising');
    }
}
