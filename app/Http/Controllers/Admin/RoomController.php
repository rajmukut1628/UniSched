<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RoomController extends Controller
{
    public function index(Request $request)
    {
        $rooms = Room::query()
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = trim($request->search);

                $query->where(function ($q) use ($search) {
                    $q->where('room_number', 'like', "%{$search}%")
                        ->orWhere('room_name', 'like', "%{$search}%");
                });
            })
            ->when($request->filled('room_type'), function ($query) use ($request) {
                $query->where('room_type', $request->room_type);
            })
            ->when($request->status === 'active', function ($query) {
                $query->where('is_active', true);
            })
            ->when($request->status === 'inactive', function ($query) {
                $query->where('is_active', false);
            })
            ->orderBy('room_number')
            ->get();

        return view(
            'admin.rooms.index',
            compact('rooms')
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'room_number' => [
                'required',
                'string',
                'max:50',
                'unique:rooms,room_number',
            ],

            'room_name' => [
                'nullable',
                'string',
                'max:150',
            ],

            'room_type' => [
                'required',
                Rule::in([
                    'classroom',
                    'computer_lab',
                    'eee_lab',
                    'physics_lab',
                    'other',
                ]),
            ],

            'capacity' => [
                'nullable',
                'integer',
                'min:1',
                'max:1000',
            ],
        ]);

        Room::create([
            'room_number' => strtoupper(
                trim($validated['room_number'])
            ),

            'room_name' => !empty($validated['room_name'])
                ? trim($validated['room_name'])
                : null,

            'room_type' => $validated['room_type'],

            'capacity' => $validated['capacity'] ?? null,

            'is_active' => true,
        ]);

        return back()->with(
            'success',
            'Room or lab added successfully.'
        );
    }

    public function update(
        Request $request,
        Room $room
    ) {
        $validated = $request->validate([
            'room_number' => [
                'required',
                'string',
                'max:50',

                Rule::unique(
                    'rooms',
                    'room_number'
                )->ignore($room->id),
            ],

            'room_name' => [
                'nullable',
                'string',
                'max:150',
            ],

            'room_type' => [
                'required',
                Rule::in([
                    'classroom',
                    'computer_lab',
                    'eee_lab',
                    'physics_lab',
                    'other',
                ]),
            ],

            'capacity' => [
                'nullable',
                'integer',
                'min:1',
                'max:1000',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],
        ]);

        $room->update([
            'room_number' => strtoupper(
                trim($validated['room_number'])
            ),

            'room_name' => !empty($validated['room_name'])
                ? trim($validated['room_name'])
                : null,

            'room_type' => $validated['room_type'],

            'capacity' => $validated['capacity'] ?? null,

            'is_active' => $request->boolean(
                'is_active'
            ),
        ]);

        return back()->with(
            'success',
            'Room or lab updated successfully.'
        );
    }

    public function destroy(Room $room)
    {
        if ($room->routines()->exists()) {
            return back()->with(
                'error',
                'This room cannot be deleted because routine entries are using it. You can make the room inactive instead.'
            );
        }

        $room->delete();

        return back()->with(
            'success',
            'Room or lab deleted successfully.'
        );
    }
}