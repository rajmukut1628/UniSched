<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Section;
use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SectionController extends Controller
{
    public function index(Request $request)
    {
        $semesters = Semester::orderBy('number')->get();

        $sections = Section::with('semester')
            ->when($request->semester_id, function ($query, $semesterId) {
                $query->where('semester_id', $semesterId);
            })
            ->orderBy('semester_id')
            ->orderBy('code')
            ->get();

        return view(
            'admin.sections.index',
            compact('semesters', 'sections')
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'semester_id' => ['required', 'exists:semesters,id'],
            'name' => ['required', 'string', 'max:50'],
            'code' => [
                'required',
                'string',
                'max:20',
                Rule::unique('sections', 'code')
                    ->where(
                        fn ($query) =>
                        $query->where('semester_id', $request->semester_id)
                    ),
            ],
        ]);

        Section::create([
            'semester_id' => $validated['semester_id'],
            'name' => strtoupper(trim($validated['name'])),
            'code' => strtoupper(trim($validated['code'])),
            'is_active' => true,
        ]);

        return back()->with('success', 'Section added successfully.');
    }

    public function update(Request $request, Section $section)
    {
        $validated = $request->validate([
            'semester_id' => ['required', 'exists:semesters,id'],
            'name' => ['required', 'string', 'max:50'],
            'code' => [
                'required',
                'string',
                'max:20',
                Rule::unique('sections', 'code')
                    ->where(
                        fn ($query) =>
                        $query->where('semester_id', $request->semester_id)
                    )
                    ->ignore($section->id),
            ],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $section->update([
            'semester_id' => $validated['semester_id'],
            'name' => strtoupper(trim($validated['name'])),
            'code' => strtoupper(trim($validated['code'])),
            'is_active' => $request->boolean('is_active'),
        ]);

        return back()->with('success', 'Section updated successfully.');
    }

    public function destroy(Section $section)
    {
        if (
            $section->courseAssignments()->exists() ||
            $section->routines()->exists()
        ) {
            return back()->with(
                'error',
                'This section cannot be deleted because scheduling data is connected to it.'
            );
        }

        $section->delete();

        return back()->with('success', 'Section deleted successfully.');
    }
}