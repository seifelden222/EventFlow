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
        // The questions table uses the foreign key 'quiz_id' (singular),
        // so specify it explicitly to avoid Eloquent inferring 'quizes_id'.
        return $this->hasMany(Questions::class, 'quiz_id');
    }
}
