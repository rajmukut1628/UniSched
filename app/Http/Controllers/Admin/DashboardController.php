<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseAssignment;
use App\Models\Room;
use App\Models\Routine;
use App\Models\Section;
use App\Models\Semester;
use App\Models\Teacher;
use App\Models\TimeSlot;

class DashboardController extends Controller
{
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | Main Statistics
        |--------------------------------------------------------------------------
        */

        $stats = [
            'semesters' => Semester::count(),

            'sections' => Section::count(),

            'courses' => Course::count(),

            'teachers' => Teacher::count(),

            'rooms' => Room::count(),

            'time_slots' => TimeSlot::count(),

            'assignments' => CourseAssignment::count(),

            'routines' => Routine::count(),

            'draft_routines' => Routine::where(
                'status',
                'draft'
            )->count(),

            'published_routines' => Routine::where(
                'status',
                'published'
            )->count(),
        ];


        /*
        |--------------------------------------------------------------------------
        | Active Resources
        |--------------------------------------------------------------------------
        */

        $activeStats = [
            'semesters' => Semester::where(
                'is_active',
                true
            )->count(),

            'sections' => Section::where(
                'is_active',
                true
            )->count(),

            'courses' => Course::where(
                'is_active',
                true
            )->count(),

            'teachers' => Teacher::where(
                'is_active',
                true
            )->count(),

            'rooms' => Room::where(
                'is_active',
                true
            )->count(),

            'time_slots' => TimeSlot::where(
                'is_active',
                true
            )->count(),

            'assignments' => CourseAssignment::where(
                'is_active',
                true
            )->count(),
        ];


        /*
        |--------------------------------------------------------------------------
        | Publication Progress
        |--------------------------------------------------------------------------
        */

        $publicationPercentage = 0;

        if ($stats['routines'] > 0) {

            $publicationPercentage = round(
                (
                    $stats['published_routines']
                    /
                    $stats['routines']
                ) * 100
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Recent Routine Entries
        |--------------------------------------------------------------------------
        */

        $recentRoutines = Routine::with([
            'courseAssignment.course',
            'section.semester',
            'teacher',
            'room',
            'timeSlot',
        ])
            ->latest()
            ->take(8)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Recent Course Assignments
        |--------------------------------------------------------------------------
        */

        $recentAssignments = CourseAssignment::with([
            'course.semester',
            'section.semester',
            'teacher',
        ])
            ->latest()
            ->take(6)
            ->get();


        return view(
            'admin.dashboard',
            compact(
                'stats',
                'activeStats',
                'publicationPercentage',
                'recentRoutines',
                'recentAssignments'
            )
        );
    }
}