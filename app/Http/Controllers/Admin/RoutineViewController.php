<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Routine;
use App\Models\Section;
use App\Models\Semester;
use App\Models\Teacher;
use App\Models\TimeSlot;
use Illuminate\Http\Request;

class RoutineViewController extends Controller
{
    private array $days = [
        'Saturday',
        'Sunday',
        'Monday',
        'Tuesday',
        'Wednesday',
        'Thursday',
    ];

    public function index(Request $request)
    {
        $days = $this->days;

        $semesters = Semester::where('is_active', true)
            ->orderBy('number')
            ->get();

        $sections = Section::with('semester')
            ->where('is_active', true)
            ->when(
                $request->filled('semester_id'),
                fn ($query) => $query->where(
                    'semester_id',
                    $request->semester_id
                )
            )
            ->get()
            ->sortBy(function ($section) {
                return sprintf(
                    '%03d-%s',
                    $section->semester->number,
                    $section->code
                );
            })
            ->values();

        $teachers = Teacher::where('is_active', true)
            ->orderBy('name')
            ->get();

        $rooms = Room::where('is_active', true)
            ->orderBy('room_number')
            ->get();

        $timeSlots = TimeSlot::where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('start_time')
            ->get();

        $viewType = $request->get('view', 'master');

        $query = Routine::with([
            'courseAssignment.course.semester',
            'section.semester',
            'teacher',
            'room',
            'timeSlot',
        ]);

        if ($request->filled('semester_id')) {
            $query->whereHas(
                'section',
                fn ($q) => $q->where(
                    'semester_id',
                    $request->semester_id
                )
            );
        }

        if ($request->filled('section_id')) {
            $query->where(
                'section_id',
                $request->section_id
            );
        }

        if ($request->filled('teacher_id')) {
            $query->where(
                'teacher_id',
                $request->teacher_id
            );
        }

        if ($request->filled('room_id')) {
            $query->where(
                'room_id',
                $request->room_id
            );
        }

        if ($request->filled('status')) {
            $query->where(
                'status',
                $request->status
            );
        }

        $routines = $query
            ->get()
            ->sortBy(function ($routine) use ($days) {

                $dayIndex = array_search(
                    $routine->day,
                    $days,
                    true
                );

                return sprintf(
                    '%02d-%05d-%03d-%s',
                    $dayIndex === false
                        ? 99
                        : $dayIndex,

                    $routine->timeSlot->sort_order,

                    $routine->section->semester->number,

                    $routine->section->code
                );
            })
            ->values();

        $routineMap = [];

        foreach ($routines as $routine) {

            $routineMap[
                $routine->day
            ][
                $routine->time_slot_id
            ][] = $routine;
        }

        $stats = [
            'total' =>
                $routines->count(),

            'published' =>
                $routines
                    ->where(
                        'status',
                        'published'
                    )
                    ->count(),

            'draft' =>
                $routines
                    ->where(
                        'status',
                        'draft'
                    )
                    ->count(),

            'sections' =>
                $routines
                    ->pluck('section_id')
                    ->unique()
                    ->count(),

            'faculty' =>
                $routines
                    ->pluck('teacher_id')
                    ->unique()
                    ->count(),

            'rooms' =>
                $routines
                    ->pluck('room_id')
                    ->unique()
                    ->count(),
        ];

        return view(
            'admin.routine-views.index',
            compact(
                'days',
                'semesters',
                'sections',
                'teachers',
                'rooms',
                'timeSlots',
                'routines',
                'routineMap',
                'stats',
                'viewType'
            )
        );
    }
}