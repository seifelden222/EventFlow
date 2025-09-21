<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Submissions extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'quiz_id',
        'user_id',
        'answers_json',
        'score',
    ];
    protected $casts = [
        'answers_json' => 'array', // Cast JSON to array
    ];
    public function quiz()
    {
        return $this->belongsTo(Quizes::class, 'quiz_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
