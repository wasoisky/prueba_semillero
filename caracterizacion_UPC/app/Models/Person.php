<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $table = 'person';

    protected $fillable = [
        'dni_type_id', 'dni', 'name', 'lastname', 'phone', 'address',
        'email', 'city_id', 'birthday', 'biological_gender',
        'latitude', 'longitude'
    ];

    public function dniType()
    {
        return $this->belongsTo(DniType::class, 'dni_type_id');
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
