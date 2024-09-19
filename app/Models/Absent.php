<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Absent extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'detail_subject_id',
        'status',
        'subject_start_datetime',
        'subject_end_datetime',
        'proof_photo_start',
        'proof_photo_end',
        'location_start',
        'location_end',
        'daily_report',
        'daily_note',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'deleted_at',
        'deleted_by',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
