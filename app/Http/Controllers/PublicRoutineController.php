<?php

namespace App\Http\Controllers;

use App\Models\Routine;
use App\Models\Section;
use App\Models\Semester;
use App\Models\Teacher;
use App\Models\TimeSlot;
use Illuminate\Http\Request;

class PublicRoutineController extends Controller
{
    private array $days = [
        'Saturday',
        'Sunday',
        'Monday',
        'Tuesday',
        'Wednesday',
        'Thursday',
    ];

    /*
    |--------------------------------------------------------------------------
    | Student Routine
    |--------------------------------------------------------------------------
    */

    public function student(Request $request)
    {
        $semesters = Semester::where('is_active', true)
            ->orderBy('number')
            ->get();

        $selectedSemester = null;
        $selectedSection = null;

        $sections = collect();
        $routines = collect();

        $timeSlots = $this->getTimeSlots();

        if ($request->filled('semester_id')) {

            $selectedSemester = Semester::where(
                'is_active',
                true
            )->find($request->semester_id);

            if ($selectedSemester) {

                $sections = Section::where(
                    'semester_id',
                    $selectedSemester->id
                )
                    ->where('is_active', true)
                    ->orderBy('code')
                    ->get();
            }
        }

        if (
            $selectedSemester
            &&
            $request->filled('section_id')
        ) {

            $selectedSection = Section::where(
                'semester_id',
                $selectedSemester->id
            )
                ->where('is_active', true)
                ->find($request->section_id);
        }

        if ($selectedSemester && $selectedSection) {

            $routines = Routine::with([
                'courseAssignment.course',
                'section.semester',
                'teacher',
                'room',
                'timeSlot',
            ])
                ->where(
                    'section_id',
                    $selectedSection->id
                )
                ->where(
                    'status',
                    'published'
                )
                ->get();

            $routines = $this->sortRoutines(
                $routines
            );
        }

        $routineMap = $this->makeRoutineMap(
            $routines
        );

        return view(
            'public.routine',
            [
                'days' => $this->days,
                'semesters' => $semesters,
                'sections' => $sections,
                'timeSlots' => $timeSlots,
                'routines' => $routines,
                'routineMap' => $routineMap,
                'selectedSemester' => $selectedSemester,
                'selectedSection' => $selectedSection,
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Faculty Routine
    |--------------------------------------------------------------------------
    */

    public function faculty(Request $request)
    {
        $teachers = Teacher::where(
            'is_active',
            true
        )
            ->orderBy('name')
            ->get();

        $selectedTeacher = null;

        $routines = collect();

        $timeSlots = $this->getTimeSlots();

        if ($request->filled('teacher_id')) {

            $selectedTeacher = Teacher::where(
                'is_active',
                true
            )->find($request->teacher_id);
        }

        if ($selectedTeacher) {

            $routines = Routine::with([
                'courseAssignment.course',
                'section.semester',
                'teacher',
                'room',
                'timeSlot',
            ])
                ->where(
                    'teacher_id',
                    $selectedTeacher->id
                )
                ->where(
                    'status',
                    'published'
                )
                ->get();

            $routines = $this->sortRoutines(
                $routines
            );
        }

        $routineMap = $this->makeRoutineMap(
            $routines
        );

        return view(
            'public.faculty-routine',
            [
                'days' => $this->days,
                'teachers' => $teachers,
                'timeSlots' => $timeSlots,
                'routines' => $routines,
                'routineMap' => $routineMap,
                'selectedTeacher' => $selectedTeacher,
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    private function getTimeSlots()
    {
        return TimeSlot::where(
            'is_active',
            true
        )
            ->orderBy('sort_order')
            ->orderBy('start_time')
            ->get();
    }


    private function sortRoutines($routines)
    {
        $dayOrder = [
            'Saturday' => 1,
            'Sunday' => 2,
            'Monday' => 3,
            'Tuesday' => 4,
            'Wednesday' => 5,
            'Thursday' => 6,
        ];

        return $routines
            ->sortBy(function ($routine) use ($dayOrder) {

                return sprintf(
                    '%02d-%05d',
                    $dayOrder[$routine->day] ?? 99,
                    $routine->timeSlot->sort_order
                );
            })
            ->values();
    }


    private function makeRoutineMap($routines): array
    {
        $routineMap = [];

        foreach ($routines as $routine) {

            $routineMap[
                $routine->day
            ][
                $routine->time_slot_id
            ][] = $routine;
        }

        return $routineMap;
    }
}