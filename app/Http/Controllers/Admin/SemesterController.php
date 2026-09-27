<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SemesterController extends Controller
{
    public function index()
    {
        $semesters = Semester::withCount('sections')
            ->orderBy('number')
            ->get();

        return view('admin.semesters.index', compact('semesters'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'number' => ['required', 'integer', 'min:1', 'max:20', 'unique:semesters,number'],
        ]);

        Semester::create([
            'name' => $validated['name'],
            'number' => $validated['number'],
            'is_active' => true,
        ]);

        return back()->with('success', 'Semester added successfully.');
    }

    public function update(Request $request, Semester $semester)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'number' => [
                'required',
                'integer',
                'min:1',
                'max:20',
                Rule::unique('semesters', 'number')->ignore($semester->id),
            ],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $semester->update([
            'name' => $validated['name'],
            'number' => $validated['number'],
            'is_active' => $request->boolean('is_active'),
        ]);

        return back()->with('success', 'Semester updated successfully.');
    }

    public function destroy(Semester $semester)
    {
        if ($semester->sections()->exists() || $semester->courses()->exists()) {
            return back()->with(
                'error',
                'This semester cannot be deleted because sections or courses are connected to it.'
            );
        }

        $semester->delete();

        return back()->with('success', 'Semester deleted successfully.');
    }
}