<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';

    protected $fillable = [
        'login', 'password', 'person_id', 'role_id'
    ];

    public function person()
    {
        return $this->belongsTo(Person::class, 'person_id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function aspirant()
    {
        return $this->hasOne(Aspirant::class, 'id_user');
    }

    public function studentDetails()
    {
        return $this->hasOne(StudentDetails::class, 'user_id');
    }

    public function visits()
    {
        return $this->hasMany(Visit::class, 'user_id');
    }

    public function calls()
    {
        return $this->hasMany(Call::class, 'user_id');
    }

    public function userAnswers()
    {
        return $this->hasMany(UserAnswer::class, 'user_id');
    }
}
