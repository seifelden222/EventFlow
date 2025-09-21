<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected  $fillable = [
        'user_id',
        'title',
        'description',
        'location',
        'event_date',
        'start_time',
        'end_time',
        'is_published',
        'main_image',
        'category',
        'organizer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * One-to-one relation: an event may have one quiz
     */
    public function quize()
    {
        return $this->hasOne(\App\Models\Quizes::class, 'event_id');
    }
    
}
