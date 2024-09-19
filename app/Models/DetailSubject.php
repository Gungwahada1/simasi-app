<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailSubject extends Model
{
    use HasFactory;

    protected $table = 'detail_subjects';

    protected $fillable = [
        'student_id',
        'subject_id',
    ];
}
