<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\TeacherAvailability;
use App\Models\TimeSlot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class TeacherAvailabilityController extends Controller
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
        $teachers = Teacher::orderBy('name')->get();

        $timeSlots = TimeSlot::orderBy('sort_order')
            ->orderBy('start_time')
            ->get();

        $selectedTeacher = null;
        $availabilityMap = [];

        if ($request->filled('teacher_id')) {

            $selectedTeacher = Teacher::find(
                $request->teacher_id
            );

            if ($selectedTeacher) {

                $records = TeacherAvailability::where(
                    'teacher_id',
                    $selectedTeacher->id
                )
                    ->where('is_available', true)
                    ->get();

                foreach ($records as $record) {

                    $availabilityMap[
                        $record->day
                    ][
                        $record->time_slot_id
                    ] = true;
                }
            }
        }

        $days = $this->days;

        return view(
            'admin.teacher-availability.index',
            compact(
                'teachers',
                'timeSlots',
                'selectedTeacher',
                'availabilityMap',
                'days'
            )
        );
    }

    public function update(
        Request $request,
        Teacher $teacher
    ) {
        $validSlotIds = TimeSlot::pluck('id')
            ->map(fn ($id) => (string) $id)
            ->toArray();

        $request->validate([
            'availability' => [
                'nullable',
                'array',
            ],

            'availability.*' => [
                'nullable',
                'array',
            ],

            'availability.*.*' => [
                Rule::in($validSlotIds),
            ],
        ]);

        DB::transaction(function () use (
            $request,
            $teacher
        ) {
            TeacherAvailability::where(
                'teacher_id',
                $teacher->id
            )->delete();

            $availability =
                $request->input(
                    'availability',
                    []
                );

            foreach ($this->days as $day) {

                $selectedSlots =
                    $availability[$day] ?? [];

                foreach ($selectedSlots as $slotId) {

                    TeacherAvailability::create([
                        'teacher_id' => $teacher->id,

                        'time_slot_id' => $slotId,

                        'day' => $day,

                        'is_available' => true,
                    ]);
                }
            }
        });

        return redirect()
            ->route(
                'admin.teacher-availability.index',
                [
                    'teacher_id' => $teacher->id,
                ]
            )
            ->with(
                'success',
                'Faculty availability updated successfully.'
            );
    }

    public function makeAllAvailable(
        Teacher $teacher
    ) {
        $timeSlots = TimeSlot::where(
            'is_active',
            true
        )->get();

        DB::transaction(function () use (
            $teacher,
            $timeSlots
        ) {
            TeacherAvailability::where(
                'teacher_id',
                $teacher->id
            )->delete();

            foreach ($this->days as $day) {

                foreach ($timeSlots as $slot) {

                    TeacherAvailability::create([
                        'teacher_id' => $teacher->id,

                        'time_slot_id' => $slot->id,

                        'day' => $day,

                        'is_available' => true,
                    ]);
                }
            }
        });

        return redirect()
            ->route(
                'admin.teacher-availability.index',
                [
                    'teacher_id' => $teacher->id,
                ]
            )
            ->with(
                'success',
                'Faculty member marked available for all active time slots.'
            );
    }

    public function clear(
        Teacher $teacher
    ) {
        TeacherAvailability::where(
            'teacher_id',
            $teacher->id
        )->delete();

        return redirect()
            ->route(
                'admin.teacher-availability.index',
                [
                    'teacher_id' => $teacher->id,
                ]
            )
            ->with(
                'success',
                'Faculty availability cleared successfully.'
            );
    }
}