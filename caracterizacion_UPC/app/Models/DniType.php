<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DniType extends Model
{
    protected $table = 'dni_type';

    protected $fillable = ['description', 'abbreviation'];

    public function persons()
    {
        return $this->hasMany(Person::class, 'dni_type_id');
    }
}
