<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CourseAssignment;
use App\Models\Room;
use App\Models\Routine;
use App\Models\TeacherAvailability;
use App\Models\TimeSlot;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class RoutineController extends Controller
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

        $assignments = CourseAssignment::with([
                'course.semester',
                'section.semester',
                'teacher',
            ])
            ->where('is_active', true)
            ->whereHas('course', fn ($q) => $q->where('is_active', true))
            ->whereHas('section', fn ($q) => $q->where('is_active', true))
            ->whereHas('teacher', fn ($q) => $q->where('is_active', true))
            ->get()
            ->sortBy(function ($assignment) {
                return sprintf(
                    '%03d-%s-%s',
                    $assignment->section->semester->number,
                    $assignment->section->code,
                    $assignment->course->course_code
                );
            })
            ->values();

        $rooms = Room::where('is_active', true)
            ->orderBy('room_number')
            ->get();

        $timeSlots = TimeSlot::where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('start_time')
            ->get();

        $routines = Routine::with([
                'courseAssignment.course.semester',
                'section.semester',
                'teacher',
                'room',
                'timeSlot',
            ])
            ->when(
                $request->filled('day'),
                fn ($q) => $q->where('day', $request->day)
            )
            ->when(
                $request->filled('section_id'),
                fn ($q) => $q->where('section_id', $request->section_id)
            )
            ->when(
                $request->filled('teacher_id'),
                fn ($q) => $q->where('teacher_id', $request->teacher_id)
            )
            ->when(
                $request->filled('room_id'),
                fn ($q) => $q->where('room_id', $request->room_id)
            )
            ->get()
            ->sortBy(function ($routine) {
                $dayIndex = array_search(
                    $routine->day,
                    $this->days,
                    true
                );

                return sprintf(
                    '%02d-%05d',
                    $dayIndex === false ? 99 : $dayIndex,
                    $routine->timeSlot->sort_order
                );
            })
            ->values();

        $sections = $assignments
            ->pluck('section')
            ->unique('id')
            ->sortBy(function ($section) {
                return sprintf(
                    '%03d-%s',
                    $section->semester->number,
                    $section->code
                );
            })
            ->values();

        $teachers = $assignments
            ->pluck('teacher')
            ->unique('id')
            ->sortBy('name')
            ->values();

        return view(
            'admin.routines.index',
            compact(
                'days',
                'assignments',
                'rooms',
                'timeSlots',
                'routines',
                'sections',
                'teachers'
            )
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Smart Suggestion: Available Time Slots
    |--------------------------------------------------------------------------
    */

    public function availableTimeSlots(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'course_assignment_id' => [
                'required',
                'integer',
                'exists:course_assignments,id',
            ],

            'day' => [
                'required',
                Rule::in($this->days),
            ],

            'ignore_routine_id' => [
                'nullable',
                'integer',
                'exists:routines,id',
            ],
        ]);

        $assignment = CourseAssignment::with([
                'course',
                'section',
                'teacher',
            ])
            ->findOrFail(
                $validated['course_assignment_id']
            );

        if (
            !$assignment->is_active ||
            !$assignment->course->is_active ||
            !$assignment->section->is_active ||
            !$assignment->teacher->is_active
        ) {
            return response()->json([
                'success' => false,
                'message' => 'Selected course assignment is inactive.',
                'slots' => [],
            ], 422);
        }

        $hasConfiguredAvailability =
            TeacherAvailability::where(
                'teacher_id',
                $assignment->teacher_id
            )->exists();

        if (!$hasConfiguredAvailability) {
            return response()->json([
                'success' => false,
                'message' => 'Faculty availability has not been configured for this faculty member.',
                'slots' => [],
            ], 422);
        }

        $availableSlotIds =
            TeacherAvailability::where(
                'teacher_id',
                $assignment->teacher_id
            )
                ->where(
                    'day',
                    $validated['day']
                )
                ->where(
                    'is_available',
                    true
                )
                ->pluck('time_slot_id');

        $slots = TimeSlot::where('is_active', true)
            ->whereIn('id', $availableSlotIds)
            ->orderBy('sort_order')
            ->orderBy('start_time')
            ->get();

        $ignoreRoutineId =
            $validated['ignore_routine_id'] ?? null;

        $availableSlots = [];

        foreach ($slots as $slot) {

            $teacherBusy = Routine::query()
                ->where(
                    'day',
                    $validated['day']
                )
                ->where(
                    'time_slot_id',
                    $slot->id
                )
                ->where(
                    'teacher_id',
                    $assignment->teacher_id
                )
                ->when(
                    $ignoreRoutineId,
                    fn ($q) => $q->where(
                        'id',
                        '!=',
                        $ignoreRoutineId
                    )
                )
                ->exists();

            if ($teacherBusy) {
                continue;
            }

            $sectionBusy = Routine::query()
                ->where(
                    'day',
                    $validated['day']
                )
                ->where(
                    'time_slot_id',
                    $slot->id
                )
                ->where(
                    'section_id',
                    $assignment->section_id
                )
                ->when(
                    $ignoreRoutineId,
                    fn ($q) => $q->where(
                        'id',
                        '!=',
                        $ignoreRoutineId
                    )
                )
                ->exists();

            if ($sectionBusy) {
                continue;
            }

            $freeRoomCount = Room::where(
                    'is_active',
                    true
                )
                ->whereDoesntHave(
                    'routines',
                    function ($query) use (
                        $validated,
                        $slot,
                        $ignoreRoutineId
                    ) {
                        $query
                            ->where(
                                'day',
                                $validated['day']
                            )
                            ->where(
                                'time_slot_id',
                                $slot->id
                            );

                        if ($ignoreRoutineId) {
                            $query->where(
                                'id',
                                '!=',
                                $ignoreRoutineId
                            );
                        }
                    }
                )
                ->count();

            if ($freeRoomCount < 1) {
                continue;
            }

            $availableSlots[] = [
                'id' => $slot->id,

                'name' => $slot->name,

                'start_time' =>
                    date(
                        'g:i A',
                        strtotime($slot->start_time)
                    ),

                'end_time' =>
                    date(
                        'g:i A',
                        strtotime($slot->end_time)
                    ),

                'free_rooms' => $freeRoomCount,

                'label' =>
                    ($slot->name
                        ? $slot->name . ' — '
                        : '')
                    .
                    date(
                        'g:i A',
                        strtotime($slot->start_time)
                    )
                    .
                    ' - '
                    .
                    date(
                        'g:i A',
                        strtotime($slot->end_time)
                    ),
            ];
        }

        return response()->json([
            'success' => true,

            'message' =>
                count($availableSlots) > 0
                    ? count($availableSlots) . ' available time slot(s) found.'
                    : 'No available time slot found for this faculty and section on the selected day.',

            'slots' => $availableSlots,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Smart Suggestion: Available Rooms
    |--------------------------------------------------------------------------
    */

    public function availableRooms(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'course_assignment_id' => [
                'required',
                'integer',
                'exists:course_assignments,id',
            ],

            'day' => [
                'required',
                Rule::in($this->days),
            ],

            'time_slot_id' => [
                'required',
                'integer',
                'exists:time_slots,id',
            ],

            'ignore_routine_id' => [
                'nullable',
                'integer',
                'exists:routines,id',
            ],
        ]);

        $assignment = CourseAssignment::with([
                'course',
                'section',
                'teacher',
            ])
            ->findOrFail(
                $validated['course_assignment_id']
            );

        $timeSlot = TimeSlot::findOrFail(
            $validated['time_slot_id']
        );

        if (!$timeSlot->is_active) {
            return response()->json([
                'success' => false,
                'message' => 'Selected time slot is inactive.',
                'rooms' => [],
            ], 422);
        }

        $availabilityError =
            $this->checkFacultyAvailability(
                $assignment->teacher_id,
                $validated['day'],
                $timeSlot->id
            );

        if ($availabilityError) {
            return response()->json([
                'success' => false,
                'message' => $availabilityError,
                'rooms' => [],
            ], 422);
        }

        $ignoreRoutineId =
            $validated['ignore_routine_id'] ?? null;

        $teacherConflict = Routine::query()
            ->where(
                'day',
                $validated['day']
            )
            ->where(
                'time_slot_id',
                $timeSlot->id
            )
            ->where(
                'teacher_id',
                $assignment->teacher_id
            )
            ->when(
                $ignoreRoutineId,
                fn ($q) => $q->where(
                    'id',
                    '!=',
                    $ignoreRoutineId
                )
            )
            ->exists();

        if ($teacherConflict) {
            return response()->json([
                'success' => false,
                'message' => 'Faculty conflict exists in this time slot.',
                'rooms' => [],
            ], 422);
        }

        $sectionConflict = Routine::query()
            ->where(
                'day',
                $validated['day']
            )
            ->where(
                'time_slot_id',
                $timeSlot->id
            )
            ->where(
                'section_id',
                $assignment->section_id
            )
            ->when(
                $ignoreRoutineId,
                fn ($q) => $q->where(
                    'id',
                    '!=',
                    $ignoreRoutineId
                )
            )
            ->exists();

        if ($sectionConflict) {
            return response()->json([
                'success' => false,
                'message' => 'Section conflict exists in this time slot.',
                'rooms' => [],
            ], 422);
        }

        $rooms = Room::where(
                'is_active',
                true
            )
            ->whereDoesntHave(
                'routines',
                function ($query) use (
                    $validated,
                    $ignoreRoutineId
                ) {
                    $query
                        ->where(
                            'day',
                            $validated['day']
                        )
                        ->where(
                            'time_slot_id',
                            $validated['time_slot_id']
                        );

                    if ($ignoreRoutineId) {
                        $query->where(
                            'id',
                            '!=',
                            $ignoreRoutineId
                        );
                    }
                }
            )
            ->get();

        $courseType =
            $assignment->course->course_type;

        $sortedRooms =
            $rooms
                ->sortBy(function ($room) use ($courseType) {

                    if ($courseType === 'lab') {

                        $priority =
                            $room->room_type === 'classroom'
                                ? 2
                                : 1;

                    } else {

                        $priority =
                            $room->room_type === 'classroom'
                                ? 1
                                : 2;
                    }

                    return sprintf(
                        '%02d-%s',
                        $priority,
                        $room->room_number
                    );
                })
                ->values();

        $availableRooms =
            $sortedRooms
                ->map(function ($room) use ($courseType) {

                    $isRecommended =
                        $courseType === 'lab'
                            ? $room->room_type !== 'classroom'
                            : $room->room_type === 'classroom';

                    return [
                        'id' => $room->id,

                        'room_number' =>
                            $room->room_number,

                        'room_name' =>
                            $room->room_name,

                        'room_type' =>
                            ucwords(
                                str_replace(
                                    '_',
                                    ' ',
                                    $room->room_type
                                )
                            ),

                        'capacity' =>
                            $room->capacity,

                        'recommended' =>
                            $isRecommended,

                        'label' =>
                            $room->room_number
                            .
                            ($room->room_name
                                ? ' — ' . $room->room_name
                                : '')
                            .
                            ' — '
                            .
                            ucwords(
                                str_replace(
                                    '_',
                                    ' ',
                                    $room->room_type
                                )
                            )
                            .
                            ($isRecommended
                                ? ' ★ Recommended'
                                : ''),
                    ];
                })
                ->values();

        return response()->json([
            'success' => true,

            'course_type' => $courseType,

            'message' =>
                $availableRooms->count() > 0
                    ? $availableRooms->count() . ' available room(s) found.'
                    : 'No free room or lab is available in this time slot.',

            'rooms' => $availableRooms,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Store Routine
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_assignment_id' => [
                'required',
                'integer',
                'exists:course_assignments,id',
            ],

            'day' => [
                'required',
                Rule::in($this->days),
            ],

            'time_slot_id' => [
                'required',
                'integer',
                'exists:time_slots,id',
            ],

            'room_id' => [
                'required',
                'integer',
                'exists:rooms,id',
            ],
        ]);

        $assignment = CourseAssignment::with([
                'course',
                'section',
                'teacher',
            ])
            ->findOrFail(
                $validated['course_assignment_id']
            );

        $room = Room::findOrFail(
            $validated['room_id']
        );

        $timeSlot = TimeSlot::findOrFail(
            $validated['time_slot_id']
        );

        $validationError =
            $this->validateRoutineResources(
                $assignment,
                $room,
                $timeSlot
            );

        if ($validationError) {
            return back()
                ->withInput()
                ->with(
                    'error',
                    $validationError
                );
        }

        $conflict = $this->findConflict(
            $assignment,
            $validated['day'],
            $timeSlot->id,
            $room->id
        );

        if ($conflict) {
            return back()
                ->withInput()
                ->with(
                    'error',
                    $conflict
                );
        }

        $availabilityError =
            $this->checkFacultyAvailability(
                $assignment->teacher_id,
                $validated['day'],
                $timeSlot->id
            );

        if ($availabilityError) {
            return back()
                ->withInput()
                ->with(
                    'error',
                    $availabilityError
                );
        }

        try {

            DB::transaction(
                function () use (
                    $assignment,
                    $validated,
                    $room,
                    $timeSlot
                ) {
                    Routine::create([
                        'course_assignment_id' =>
                            $assignment->id,

                        'section_id' =>
                            $assignment->section_id,

                        'teacher_id' =>
                            $assignment->teacher_id,

                        'room_id' =>
                            $room->id,

                        'time_slot_id' =>
                            $timeSlot->id,

                        'day' =>
                            $validated['day'],

                        'status' =>
                            'draft',
                    ]);
                }
            );

        } catch (\Throwable $exception) {

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Routine could not be created. Another scheduling conflict may already exist.'
                );
        }

        return redirect()
            ->route('admin.routines.index')
            ->with(
                'success',
                'Routine entry created successfully.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | Update Routine
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        Routine $routine
    ) {
        $validated = $request->validate([
            'course_assignment_id' => [
                'required',
                'integer',
                'exists:course_assignments,id',
            ],

            'day' => [
                'required',
                Rule::in($this->days),
            ],

            'time_slot_id' => [
                'required',
                'integer',
                'exists:time_slots,id',
            ],

            'room_id' => [
                'required',
                'integer',
                'exists:rooms,id',
            ],

            'status' => [
                'required',
                Rule::in([
                    'draft',
                    'published',
                ]),
            ],
        ]);

        $assignment = CourseAssignment::with([
                'course',
                'section',
                'teacher',
            ])
            ->findOrFail(
                $validated['course_assignment_id']
            );

        $room = Room::findOrFail(
            $validated['room_id']
        );

        $timeSlot = TimeSlot::findOrFail(
            $validated['time_slot_id']
        );

        $validationError =
            $this->validateRoutineResources(
                $assignment,
                $room,
                $timeSlot
            );

        if ($validationError) {
            return back()->with(
                'error',
                $validationError
            );
        }

        $conflict = $this->findConflict(
            $assignment,
            $validated['day'],
            $timeSlot->id,
            $room->id,
            $routine->id
        );

        if ($conflict) {
            return back()->with(
                'error',
                $conflict
            );
        }

        $availabilityError =
            $this->checkFacultyAvailability(
                $assignment->teacher_id,
                $validated['day'],
                $timeSlot->id
            );

        if ($availabilityError) {
            return back()->with(
                'error',
                $availabilityError
            );
        }

        try {

            DB::transaction(
                function () use (
                    $routine,
                    $assignment,
                    $validated,
                    $room,
                    $timeSlot
                ) {
                    $routine->update([
                        'course_assignment_id' =>
                            $assignment->id,

                        'section_id' =>
                            $assignment->section_id,

                        'teacher_id' =>
                            $assignment->teacher_id,

                        'room_id' =>
                            $room->id,

                        'time_slot_id' =>
                            $timeSlot->id,

                        'day' =>
                            $validated['day'],

                        'status' =>
                            $validated['status'],
                    ]);
                }
            );

        } catch (\Throwable $exception) {

            return back()->with(
                'error',
                'Routine could not be updated because a scheduling conflict exists.'
            );
        }

        return back()->with(
            'success',
            'Routine entry updated successfully.'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Delete Routine
    |--------------------------------------------------------------------------
    */

    public function destroy(Routine $routine)
    {
        $routine->delete();

        return back()->with(
            'success',
            'Routine entry deleted successfully.'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Resource Validation
    |--------------------------------------------------------------------------
    */

    private function validateRoutineResources(
        CourseAssignment $assignment,
        Room $room,
        TimeSlot $timeSlot
    ): ?string {
        if (!$assignment->is_active) {
            return 'Selected course assignment is inactive.';
        }

        if (!$assignment->course->is_active) {
            return 'The course in this assignment is inactive.';
        }

        if (!$assignment->section->is_active) {
            return 'The section in this assignment is inactive.';
        }

        if (!$assignment->teacher->is_active) {
            return 'The faculty member in this assignment is inactive.';
        }

        if (!$room->is_active) {
            return 'Selected room or lab is inactive.';
        }

        if (!$timeSlot->is_active) {
            return 'Selected time slot is inactive.';
        }

        return null;
    }

    /*
    |--------------------------------------------------------------------------
    | Conflict Engine
    |--------------------------------------------------------------------------
    */

    private function findConflict(
        CourseAssignment $assignment,
        string $day,
        int $timeSlotId,
        int $roomId,
        ?int $ignoreRoutineId = null
    ): ?string {
        $roomConflict = Routine::query()
            ->where('day', $day)
            ->where(
                'time_slot_id',
                $timeSlotId
            )
            ->where(
                'room_id',
                $roomId
            )
            ->when(
                $ignoreRoutineId,
                fn ($q) => $q->where(
                    'id',
                    '!=',
                    $ignoreRoutineId
                )
            )
            ->exists();

        if ($roomConflict) {
            return 'Room conflict: this room is already occupied during the selected day and time slot.';
        }

        $teacherConflict = Routine::query()
            ->where('day', $day)
            ->where(
                'time_slot_id',
                $timeSlotId
            )
            ->where(
                'teacher_id',
                $assignment->teacher_id
            )
            ->when(
                $ignoreRoutineId,
                fn ($q) => $q->where(
                    'id',
                    '!=',
                    $ignoreRoutineId
                )
            )
            ->exists();

        if ($teacherConflict) {
            return 'Faculty conflict: this faculty member already has another class during the selected day and time slot.';
        }

        $sectionConflict = Routine::query()
            ->where('day', $day)
            ->where(
                'time_slot_id',
                $timeSlotId
            )
            ->where(
                'section_id',
                $assignment->section_id
            )
            ->when(
                $ignoreRoutineId,
                fn ($q) => $q->where(
                    'id',
                    '!=',
                    $ignoreRoutineId
                )
            )
            ->exists();

        if ($sectionConflict) {
            return 'Section conflict: this section already has another class during the selected day and time slot.';
        }

        return null;
    }

    /*
    |--------------------------------------------------------------------------
    | Faculty Availability
    |--------------------------------------------------------------------------
    */

    private function checkFacultyAvailability(
        int $teacherId,
        string $day,
        int $timeSlotId
    ): ?string {
        $hasConfiguredAvailability =
            TeacherAvailability::where(
                'teacher_id',
                $teacherId
            )->exists();

        if (!$hasConfiguredAvailability) {
            return 'Faculty availability has not been configured for this faculty member.';
        }

        $available =
            TeacherAvailability::where(
                'teacher_id',
                $teacherId
            )
                ->where(
                    'day',
                    $day
                )
                ->where(
                    'time_slot_id',
                    $timeSlotId
                )
                ->where(
                    'is_available',
                    true
                )
                ->exists();

        if (!$available) {
            return 'Faculty unavailable: this faculty member is not available during the selected day and time slot.';
        }

        return null;
    }
}