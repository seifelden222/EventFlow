<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Audit_Logs extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'action',
        'target_type',
        'target_id',
        'meta_json',
    ];
    protected $casts = [
        'meta_json' => 'array',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function target()
    {
        return $this->morphTo(null, 'target_type', 'target_id');
    }

}
