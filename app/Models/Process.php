<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Process extends Model
{
    protected $table = 'processes';

    protected $fillable = ['aspirant_id', 'interview_id', 'call_id', 'visit_id', 'description', 'status', 'update_date'];

    public function aspirant()
    {
        return $this->belongsTo(Aspirant::class, 'aspirant_id');
    }

    public function interview()
    {
        return $this->belongsTo(Interview::class, 'interview_id');
    }

    public function call()
    {
        return $this->belongsTo(Call::class, 'call_id');
    }

    public function visit()
    {
        return $this->belongsTo(Visit::class, 'visit_id');
    }
}
