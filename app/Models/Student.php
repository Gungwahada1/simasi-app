<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory, SoftDeletes;

    public $incrementing = false; // Non-auto-increment
    protected $keyType = 'string'; // Tipe kunci adalah string

    protected $primaryKey = 'id';

    protected $fillable = [
        'id', // ID UUID diizinkan untuk mass assignment
        'name',
        'grade',
        'gender',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'deleted_at',
        'deleted_by',
    ];

    public function getRouteKeyName()
    {
        return 'id'; // Menggunakan UUID di rute
    }

    protected $dates = ['deleted_at'];

    public function subjects(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class, 'detail_subjects', 'student_id', 'subject_id');
    }
}
