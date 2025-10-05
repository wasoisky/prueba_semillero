<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $table = 'person';

    protected $fillable = [
        'dni_id', 'name', 'lastname', 'phone', 'address',
        'email', 'city_id', 'birthday', 'biological_gender',
        'latitude', 'longitude'
    ];

    public function dni()
    {
        return $this->belongsTo(Dni::class, 'dni_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'person_id');
    }
}
