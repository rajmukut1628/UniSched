<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Semester extends Model
{
    protected $fillable = [
        'name',
        'number',
        'is_active',
    ];

    protected $casts = [
        'number' => 'integer',
        'is_active' => 'boolean',
    ];

    /*
    |--------------------------------------------------------------------------
    | Sections
    |--------------------------------------------------------------------------
    */

    public function sections(): HasMany
    {
        return $this->hasMany(Section::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Offered Courses
    |--------------------------------------------------------------------------
    |
    | course_semester pivot table ব্যবহার করে একটি semester-এ
    | অনেক course এবং একই course অনেক semester-এ থাকতে পারবে।
    |
    */

    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(
            Course::class,
            'course_semester',
            'semester_id',
            'course_id'
        )->withTimestamps();
    }

    /*
    |--------------------------------------------------------------------------
    | Legacy Courses
    |--------------------------------------------------------------------------
    |
    | courses.semester_id এখনো database-এ আছে।
    | Existing controller/functionality compatibility-এর জন্য আলাদা
    | relationship রাখা হলো।
    |
    */

    public function primaryCourses(): HasMany
    {
        return $this->hasMany(
            Course::class,
            'semester_id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Scope
    |--------------------------------------------------------------------------
    */

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}