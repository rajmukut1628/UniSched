<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TeacherController extends Controller
{
    public function index(Request $request)
    {
        $teachers = Teacher::query()
            ->when($request->search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                        ->orWhere('initial', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%')
                        ->orWhere('phone', 'like', '%' . $search . '%')
                        ->orWhere('department', 'like', '%' . $search . '%');
                });
            })
            ->when(
                $request->status === 'active',
                fn ($query) => $query->where('is_active', true)
            )
            ->when(
                $request->status === 'inactive',
                fn ($query) => $query->where('is_active', false)
            )
            ->orderBy('name')
            ->get();

        return view(
            'admin.teachers.index',
            compact('teachers')
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:150',
            ],

            'initial' => [
                'required',
                'string',
                'max:20',
                'unique:teachers,initial',
            ],

            'email' => [
                'nullable',
                'email',
                'max:255',
                'unique:teachers,email',
            ],

            'phone' => [
                'nullable',
                'string',
                'max:30',
            ],

            'department' => [
                'required',
                'string',
                'max:100',
            ],
        ]);

        Teacher::create([
            'name' => trim($validated['name']),

            'initial' => strtoupper(
                trim($validated['initial'])
            ),

            'email' => !empty($validated['email'])
                ? strtolower(trim($validated['email']))
                : null,

            'phone' => !empty($validated['phone'])
                ? trim($validated['phone'])
                : null,

            'department' => trim(
                $validated['department']
            ),

            'is_active' => true,
        ]);

        return back()->with(
            'success',
            'Faculty member added successfully.'
        );
    }

    public function update(
        Request $request,
        Teacher $teacher
    ) {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:150',
            ],

            'initial' => [
                'required',
                'string',
                'max:20',

                Rule::unique(
                    'teachers',
                    'initial'
                )->ignore($teacher->id),
            ],

            'email' => [
                'nullable',
                'email',
                'max:255',

                Rule::unique(
                    'teachers',
                    'email'
                )->ignore($teacher->id),
            ],

            'phone' => [
                'nullable',
                'string',
                'max:30',
            ],

            'department' => [
                'required',
                'string',
                'max:100',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],
        ]);

        $teacher->update([
            'name' => trim($validated['name']),

            'initial' => strtoupper(
                trim($validated['initial'])
            ),

            'email' => !empty($validated['email'])
                ? strtolower(trim($validated['email']))
                : null,

            'phone' => !empty($validated['phone'])
                ? trim($validated['phone'])
                : null,

            'department' => trim(
                $validated['department']
            ),

            'is_active' => $request->boolean(
                'is_active'
            ),
        ]);

        return back()->with(
            'success',
            'Faculty member updated successfully.'
        );
    }

    public function destroy(Teacher $teacher)
    {
        if ($teacher->courseAssignments()->exists()) {
            return back()->with(
                'error',
                'This faculty member cannot be deleted because course assignments are connected to this account.'
            );
        }

        if ($teacher->routines()->exists()) {
            return back()->with(
                'error',
                'This faculty member cannot be deleted because routine entries are connected to this account.'
            );
        }

        $teacher->delete();

        return back()->with(
            'success',
            'Faculty member deleted successfully.'
        );
    }
}