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

class RoutineExportController extends Controller
{
    private array $days = [
        'Saturday',
        'Sunday',
        'Monday',
        'Tuesday',
        'Wednesday',
        'Thursday',
    ];

    public function print(Request $request)
    {
        $validated = $request->validate([
            'type' => [
                'nullable',
                'in:master,semester,section,faculty,room',
            ],

            'semester_id' => [
                'nullable',
                'integer',
                'exists:semesters,id',
            ],

            'section_id' => [
                'nullable',
                'integer',
                'exists:sections,id',
            ],

            'teacher_id' => [
                'nullable',
                'integer',
                'exists:teachers,id',
            ],

            'room_id' => [
                'nullable',
                'integer',
                'exists:rooms,id',
            ],
        ]);

        $type = $validated['type'] ?? 'master';

        $days = $this->days;

        $timeSlots = TimeSlot::where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('start_time')
            ->get();

        $query = Routine::with([
            'courseAssignment.course',
            'section.semester',
            'teacher',
            'room',
            'timeSlot',
        ])
            ->where('status', 'published');

        if (!empty($validated['semester_id'])) {

            $query->whereHas(
                'section',
                function ($sectionQuery) use ($validated) {

                    $sectionQuery->where(
                        'semester_id',
                        $validated['semester_id']
                    );
                }
            );
        }

        if (!empty($validated['section_id'])) {

            $query->where(
                'section_id',
                $validated['section_id']
            );
        }

        if (!empty($validated['teacher_id'])) {

            $query->where(
                'teacher_id',
                $validated['teacher_id']
            );
        }

        if (!empty($validated['room_id'])) {

            $query->where(
                'room_id',
                $validated['room_id']
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

        $semester = !empty($validated['semester_id'])
            ? Semester::find($validated['semester_id'])
            : null;

        $section = !empty($validated['section_id'])
            ? Section::with('semester')
                ->find($validated['section_id'])
            : null;

        $teacher = !empty($validated['teacher_id'])
            ? Teacher::find($validated['teacher_id'])
            : null;

        $room = !empty($validated['room_id'])
            ? Room::find($validated['room_id'])
            : null;

        $title = $this->buildTitle(
            $type,
            $semester,
            $section,
            $teacher,
            $room
        );

        $subtitle = $this->buildSubtitle(
            $semester,
            $section,
            $teacher,
            $room
        );

        return view(
            'admin.routine-export.print',
            compact(
                'type',
                'days',
                'timeSlots',
                'routines',
                'routineMap',
                'semester',
                'section',
                'teacher',
                'room',
                'title',
                'subtitle'
            )
        );
    }

    private function buildTitle(
        string $type,
        ?Semester $semester,
        ?Section $section,
        ?Teacher $teacher,
        ?Room $room
    ): string {

        return match ($type) {

            'semester' =>
                $semester
                    ? $semester->name . ' Routine'
                    : 'Semester Routine',

            'section' =>
                $section
                    ? $section->semester->name
                        . ' - '
                        . $section->code
                        . ' Routine'
                    : 'Section Routine',

            'faculty' =>
                $teacher
                    ? $teacher->name
                        . ' ('
                        . $teacher->initial
                        . ') Routine'
                    : 'Faculty Routine',

            'room' =>
                $room
                    ? 'Room '
                        . $room->room_number
                        . ' Routine'
                    : 'Room Routine',

            default =>
                'Master Academic Routine',
        };
    }

    private function buildSubtitle(
        ?Semester $semester,
        ?Section $section,
        ?Teacher $teacher,
        ?Room $room
    ): string {

        $parts = [];

        if ($semester) {
            $parts[] = $semester->name;
        }

        if ($section) {
            $parts[] = 'Section ' . $section->code;
        }

        if ($teacher) {
            $parts[] =
                $teacher->name
                . ' ('
                . $teacher->initial
                . ')';
        }

        if ($room) {
            $parts[] =
                'Room '
                . $room->room_number;
        }

        return count($parts)
            ? implode(' | ', $parts)
            : 'All Published Classes';
    }
}