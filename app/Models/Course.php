<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    protected $fillable = [
        'semester_id',
        'course_code',
        'course_name',
        'credit',
        'course_type',
        'is_active',
    ];

    protected $casts = [
        'credit' => 'decimal:1',
        'is_active' => 'boolean',
    ];

    /*
    |--------------------------------------------------------------------------
    | Primary / Legacy Semester
    |--------------------------------------------------------------------------
    |
    | এটি আপাতত রাখছি কারণ existing CourseController এবং অন্য কিছু
    | functionality courses.semester_id ব্যবহার করতে পারে।
    |
    | পরে পুরো project many-to-many compatible হয়ে গেলে চাইলে
    | semester_id column remove করা যাবে।
    |
    */

    public function semester(): BelongsTo
    {
        return $this->belongsTo(Semester::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Offered Semesters
    |--------------------------------------------------------------------------
    |
    | একটি course একাধিক semester-এ offer করা যাবে।
    |
    | Example:
    | CSE 2215 -> 4th Semester
    | CSE 2215 -> 5th Semester
    |
    */

    public function semesters(): BelongsToMany
    {
        return $this->belongsToMany(
            Semester::class,
            'course_semester',
            'course_id',
            'semester_id'
        )->withTimestamps();
    }

    /*
    |--------------------------------------------------------------------------
    | Course Assignments
    |--------------------------------------------------------------------------
    */

    public function assignments(): HasMany
    {
        return $this->hasMany(CourseAssignment::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeTheory($query)
    {
        return $query->where('course_type', 'theory');
    }

    public function scopeLab($query)
    {
        return $query->where('course_type', 'lab');
    }

    /*
    |--------------------------------------------------------------------------
    | Helper
    |--------------------------------------------------------------------------
    */

    public function isOfferedInSemester(int $semesterId): bool
    {
        return $this->semesters()
            ->where('semesters.id', $semesterId)
            ->exists();
    }
}