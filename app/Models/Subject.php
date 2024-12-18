<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Subject extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'subject_name',
        'subject_description',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'deleted_at',
        'deleted_by',
    ];

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    public function getRouteKeyName()
    {
        return 'id';
    }

    protected $dates = ['deleted_at'];
    protected static function booted()
    {
        static::deleting(function ($subject) {
            $subject->deleted_by = Auth::user()->id;
            $subject->save();
        });
    }

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class, 'detail_subjects', 'subject_id', 'student_id');
    }
}
