<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $table = 'User'; // O 'users' si renombraste la tabla
    protected $fillable = [
        'login',
        'password',
        'person_id',
        'role_id'
    ];

    public function studentDetails()
    {
        return $this->hasOne(StudentDetail::class, 'user_id');
    }

    public function aspirant()
    {
        return $this->hasOne(Aspirant::class, 'id_user');
    }

    public function visits()
    {
        return $this->hasMany(Visit::class, 'user_id');
    }

    public function calls()
    {
        return $this->hasMany(CallModel::class, 'user_id');
    }
}
