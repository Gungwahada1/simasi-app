<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'grade',
        'gender'
    ];

    public function subjects(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class, 'detail_subjects', 'student_id', 'subject_id');
    }
}
