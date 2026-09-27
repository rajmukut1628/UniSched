<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TimeSlot;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TimeSlotController extends Controller
{
    public function index()
    {
        $timeSlots = TimeSlot::orderBy('sort_order')
            ->orderBy('start_time')
            ->get();

        return view(
            'admin.time-slots.index',
            compact('timeSlots')
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'nullable',
                'string',
                'max:100',
            ],

            'start_time' => [
                'required',
                'date_format:H:i',
            ],

            'end_time' => [
                'required',
                'date_format:H:i',
                'after:start_time',
            ],

            'sort_order' => [
                'required',
                'integer',
                'min:0',
                'max:999',
            ],
        ]);

        $startTime = $validated['start_time'];
        $endTime = $validated['end_time'];

        $duplicate = TimeSlot::where('start_time', $startTime)
            ->where('end_time', $endTime)
            ->exists();

        if ($duplicate) {
            return back()
                ->withInput()
                ->with(
                    'error',
                    'This exact time slot already exists.'
                );
        }

        $overlap = TimeSlot::where(function ($query) use (
            $startTime,
            $endTime
        ) {
            $query
                ->where('start_time', '<', $endTime)
                ->where('end_time', '>', $startTime);
        })->exists();

        if ($overlap) {
            return back()
                ->withInput()
                ->with(
                    'error',
                    'This time overlaps with an existing time slot.'
                );
        }

        TimeSlot::create([
            'name' => !empty($validated['name'])
                ? trim($validated['name'])
                : null,

            'start_time' => $startTime,
            'end_time' => $endTime,

            'sort_order' => $validated['sort_order'],

            'is_active' => true,
        ]);

        return back()->with(
            'success',
            'Time slot added successfully.'
        );
    }

    public function update(
        Request $request,
        TimeSlot $timeSlot
    ) {
        $validated = $request->validate([
            'name' => [
                'nullable',
                'string',
                'max:100',
            ],

            'start_time' => [
                'required',
                'date_format:H:i',
            ],

            'end_time' => [
                'required',
                'date_format:H:i',
                'after:start_time',
            ],

            'sort_order' => [
                'required',
                'integer',
                'min:0',
                'max:999',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],
        ]);

        $startTime = $validated['start_time'];
        $endTime = $validated['end_time'];

        $duplicate = TimeSlot::where(
            'id',
            '!=',
            $timeSlot->id
        )
            ->where('start_time', $startTime)
            ->where('end_time', $endTime)
            ->exists();

        if ($duplicate) {
            return back()->with(
                'error',
                'This exact time slot already exists.'
            );
        }

        $overlap = TimeSlot::where(
            'id',
            '!=',
            $timeSlot->id
        )
            ->where(function ($query) use (
                $startTime,
                $endTime
            ) {
                $query
                    ->where('start_time', '<', $endTime)
                    ->where('end_time', '>', $startTime);
            })
            ->exists();

        if ($overlap) {
            return back()->with(
                'error',
                'This time overlaps with another existing time slot.'
            );
        }

        $timeSlot->update([
            'name' => !empty($validated['name'])
                ? trim($validated['name'])
                : null,

            'start_time' => $startTime,
            'end_time' => $endTime,

            'sort_order' => $validated['sort_order'],

            'is_active' => $request->boolean(
                'is_active'
            ),
        ]);

        return back()->with(
            'success',
            'Time slot updated successfully.'
        );
    }

    public function destroy(TimeSlot $timeSlot)
    {
        if ($timeSlot->teacherAvailabilities()->exists()) {
            return back()->with(
                'error',
                'This time slot cannot be deleted because faculty availability records are using it.'
            );
        }

        if ($timeSlot->routines()->exists()) {
            return back()->with(
                'error',
                'This time slot cannot be deleted because routine entries are using it.'
            );
        }

        $timeSlot->delete();

        return back()->with(
            'success',
            'Time slot deleted successfully.'
        );
    }
}