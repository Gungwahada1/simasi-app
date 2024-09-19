<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject_name',
        'subject_code',
        'subject_description',
        'subject_status',
    ];

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class, 'detail_subjects', 'subject_id', 'student_id');
    }
}
