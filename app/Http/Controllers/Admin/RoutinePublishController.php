<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Routine;
use App\Models\Section;
use App\Models\Semester;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoutinePublishController extends Controller
{
    public function index(Request $request)
    {
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

        $routines = $this->filteredQuery($request)
            ->with([
                'courseAssignment.course',
                'section.semester',
                'teacher',
                'room',
                'timeSlot',
            ])
            ->get()
            ->sortBy(function ($routine) {

                $days = [
                    'Saturday' => 1,
                    'Sunday' => 2,
                    'Monday' => 3,
                    'Tuesday' => 4,
                    'Wednesday' => 5,
                    'Thursday' => 6,
                ];

                return sprintf(
                    '%02d-%05d-%03d-%s',
                    $days[$routine->day] ?? 99,
                    $routine->timeSlot->sort_order,
                    $routine->section->semester->number,
                    $routine->section->code
                );
            })
            ->values();

        $stats = [
            'total' => $routines->count(),

            'draft' => $routines
                ->where('status', 'draft')
                ->count(),

            'published' => $routines
                ->where('status', 'published')
                ->count(),

            'sections' => $routines
                ->pluck('section_id')
                ->unique()
                ->count(),
        ];

        return view(
            'admin.routine-publish.index',
            compact(
                'semesters',
                'sections',
                'teachers',
                'rooms',
                'routines',
                'stats'
            )
        );
    }

    public function publish(Routine $routine)
    {
        if ($routine->status === 'published') {
            return back()->with(
                'success',
                'This routine class is already published.'
            );
        }

        $routine->update([
            'status' => 'published',
        ]);

        return back()->with(
            'success',
            'Routine class published successfully.'
        );
    }

    public function draft(Routine $routine)
    {
        if ($routine->status === 'draft') {
            return back()->with(
                'success',
                'This routine class is already in draft status.'
            );
        }

        $routine->update([
            'status' => 'draft',
        ]);

        return back()->with(
            'success',
            'Routine class moved back to draft successfully.'
        );
    }

    public function bulkPublish(Request $request)
    {
        $validated = $request->validate([
            'routine_ids' => [
                'required',
                'array',
                'min:1',
            ],

            'routine_ids.*' => [
                'required',
                'integer',
                'exists:routines,id',
            ],
        ]);

        $ids = array_values(
            array_unique(
                array_map(
                    'intval',
                    $validated['routine_ids']
                )
            )
        );

        $count = 0;

        DB::transaction(function () use ($ids, &$count) {

            $count = Routine::whereIn('id', $ids)
                ->where('status', 'draft')
                ->update([
                    'status' => 'published',
                ]);
        });

        if ($count === 0) {
            return back()->with(
                'success',
                'No selected draft classes needed publishing.'
            );
        }

        return back()->with(
            'success',
            $count . ' selected class(es) published successfully.'
        );
    }

    public function bulkDraft(Request $request)
    {
        $validated = $request->validate([
            'routine_ids' => [
                'required',
                'array',
                'min:1',
            ],

            'routine_ids.*' => [
                'required',
                'integer',
                'exists:routines,id',
            ],
        ]);

        $ids = array_values(
            array_unique(
                array_map(
                    'intval',
                    $validated['routine_ids']
                )
            )
        );

        $count = 0;

        DB::transaction(function () use ($ids, &$count) {

            $count = Routine::whereIn('id', $ids)
                ->where('status', 'published')
                ->update([
                    'status' => 'draft',
                ]);
        });

        if ($count === 0) {
            return back()->with(
                'success',
                'No selected published classes needed changing.'
            );
        }

        return back()->with(
            'success',
            $count . ' selected class(es) moved to draft successfully.'
        );
    }

    public function publishFiltered(Request $request)
    {
        $query = $this->filteredQuery($request);

        $count = 0;

        DB::transaction(function () use ($query, &$count) {

            $count = $query
                ->where('status', 'draft')
                ->update([
                    'status' => 'published',
                ]);
        });

        if ($count === 0) {
            return back()->with(
                'success',
                'No draft classes were found in the selected filter.'
            );
        }

        return back()->with(
            'success',
            $count . ' filtered class(es) published successfully.'
        );
    }

    public function draftFiltered(Request $request)
    {
        $query = $this->filteredQuery($request);

        $count = 0;

        DB::transaction(function () use ($query, &$count) {

            $count = $query
                ->where('status', 'published')
                ->update([
                    'status' => 'draft',
                ]);
        });

        if ($count === 0) {
            return back()->with(
                'success',
                'No published classes were found in the selected filter.'
            );
        }

        return back()->with(
            'success',
            $count . ' filtered class(es) moved to draft successfully.'
        );
    }

    private function filteredQuery(Request $request)
    {
        return Routine::query()

            ->when(
                $request->filled('semester_id'),
                function ($query) use ($request) {

                    $query->whereHas(
                        'section',
                        function ($sectionQuery) use ($request) {

                            $sectionQuery->where(
                                'semester_id',
                                $request->semester_id
                            );
                        }
                    );
                }
            )

            ->when(
                $request->filled('section_id'),
                fn ($query) => $query->where(
                    'section_id',
                    $request->section_id
                )
            )

            ->when(
                $request->filled('teacher_id'),
                fn ($query) => $query->where(
                    'teacher_id',
                    $request->teacher_id
                )
            )

            ->when(
                $request->filled('room_id'),
                fn ($query) => $query->where(
                    'room_id',
                    $request->room_id
                )
            )

            ->when(
                $request->filled('status'),
                fn ($query) => $query->where(
                    'status',
                    $request->status
                )
            );
    }
}