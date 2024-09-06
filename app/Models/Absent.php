<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    ];
}
