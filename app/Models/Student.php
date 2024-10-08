<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Student extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $keytype = 'string';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
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
    

    // Laravel will use this to bind models to routes
    public function getRouteKeyName()
    {
        return 'id';
    }

    public function subjects(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class, 'detail_subjects', 'student_id', 'subject_id');
    }
}
