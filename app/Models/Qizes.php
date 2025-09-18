<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Qizes extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'event_id',
        'title',
        'is_active',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function questions()
    {
        return $this->hasMany(Questions::class);
    }
}
