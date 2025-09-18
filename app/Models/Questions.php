<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Questions extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'quiz_id',
        'text',
        'options_json',
        'correct_index',
    ];
    protected $casts = [
        'options_json' => 'array', // Cast options_json to an array
    ];
    public function quiz()
    {
        return $this->belongsTo(Qizes::class);
    }

    public function submissions()
    {
        return $this->hasMany(Submissions::class);
    }
}
