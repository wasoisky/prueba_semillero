<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CallModel extends Model
{
    use HasFactory;

    protected $table = 'call';
    protected $fillable = [
        'user_id',
        'aspirant_id',
        'date',
        'contact_person',
        'response'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function aspirant()
    {
        return $this->belongsTo(Aspirant::class, 'aspirant_id');
    }
}
