<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quizes extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'event_id',
        'title',
        'is_active',
        'description',
        'time_start',
        'time_end',
        'date',
        'img',
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
