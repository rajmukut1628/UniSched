<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseAssignment;
use App\Models\Section;
use App\Models\Semester;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CourseAssignmentController extends Controller
{
    public function index(Request $request)
    {
        $semesters = Semester::where('is_active', true)
            ->orderBy('number')
            ->get();

        $sections = Section::with('semester')
            ->where('is_active', true)
            ->orderBy('semester_id')
            ->orderBy('code')
            ->get();

        $courses = Course::with(['semester', 'semesters'])
            ->where('is_active', true)
            ->orderBy('course_code')
            ->get();

        $teachers = Teacher::where('is_active', true)
            ->orderBy('name')
            ->get();

        $assignments = CourseAssignment::with([
                'course.semester',
                'section.semester',
                'teacher',
            ])
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
                function ($query) use ($request) {
                    $query->where(
                        'section_id',
                        $request->section_id
                    );
                }
            )
            ->when(
                $request->filled('teacher_id'),
                function ($query) use ($request) {
                    $query->where(
                        'teacher_id',
                        $request->teacher_id
                    );
                }
            )
            ->when(
                $request->status === 'active',
                function ($query) {
                    $query->where('is_active', true);
                }
            )
            ->when(
                $request->status === 'inactive',
                function ($query) {
                    $query->where('is_active', false);
                }
            )
            ->latest()
            ->get();

        return view(
            'admin.course-assignments.index',
            compact(
                'semesters',
                'sections',
                'courses',
                'teachers',
                'assignments'
            )
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'semester_id' => [
                'required',
                'integer',
                'exists:semesters,id',
            ],

            'section_id' => [
                'required',
                'integer',
                'exists:sections,id',
            ],

            'course_id' => [
                'required',
                'integer',
                'exists:courses,id',
            ],

            'teacher_id' => [
                'required',
                'integer',
                'exists:teachers,id',
            ],
        ]);

        $semester = Semester::findOrFail(
            $validated['semester_id']
        );

        $section = Section::findOrFail(
            $validated['section_id']
        );

        $course = Course::findOrFail(
            $validated['course_id']
        );

        $teacher = Teacher::findOrFail(
            $validated['teacher_id']
        );

        if (!$semester->is_active) {
            return back()
                ->withInput()
                ->with(
                    'error',
                    'Selected semester is inactive.'
                );
        }

        if (!$section->is_active) {
            return back()
                ->withInput()
                ->with(
                    'error',
                    'Selected section is inactive.'
                );
        }

        if (!$course->is_active) {
            return back()
                ->withInput()
                ->with(
                    'error',
                    'Selected course is inactive.'
                );
        }

        if (!$teacher->is_active) {
            return back()
                ->withInput()
                ->with(
                    'error',
                    'Selected faculty member is inactive.'
                );
        }

        if ((int) $section->semester_id !== (int) $semester->id) {
            return back()
                ->withInput()
                ->with(
                    'error',
                    'Selected section does not belong to the selected semester.'
                );
        }

              $courseOfferedInSemester = $course->semesters()
              ->where('semesters.id', $semester->id)
              ->exists();

          if (!$courseOfferedInSemester) {
            return back()
               ->withInput()
               ->with(
               'error',
             'Selected course is not offered in the selected semester.'
        );
}

        $duplicate = CourseAssignment::where(
            'course_id',
            $course->id
        )
            ->where(
                'section_id',
                $section->id
            )
            ->exists();

        if ($duplicate) {
            return back()
                ->withInput()
                ->with(
                    'error',
                    'This course is already assigned to this section.'
                );
        }

        CourseAssignment::create([
            'course_id' => $course->id,
            'section_id' => $section->id,
            'teacher_id' => $teacher->id,
            'is_active' => true,
        ]);

        return redirect()
            ->route('admin.course-assignments.index')
            ->with(
                'success',
                'Course assigned to faculty successfully.'
            );
    }

    public function update(
        Request $request,
        CourseAssignment $courseAssignment
    ) {
        $validated = $request->validate([
            'course_id' => [
                'required',
                'integer',
                'exists:courses,id',
            ],

            'section_id' => [
                'required',
                'integer',
                'exists:sections,id',
            ],

            'teacher_id' => [
                'required',
                'integer',
                'exists:teachers,id',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],
        ]);

        $course = Course::findOrFail(
            $validated['course_id']
        );

        $section = Section::findOrFail(
            $validated['section_id']
        );

        $teacher = Teacher::findOrFail(
            $validated['teacher_id']
        );

        $courseOfferedInSectionSemester = $course->semesters()
    ->where('semesters.id', $section->semester_id)
    ->exists();

if (!$courseOfferedInSectionSemester) {
    return back()
        ->withInput()
        ->with(
            'error',
            'Selected course is not offered in the semester of the selected section.'
        );
}

        if (!$course->is_active) {
            return back()->with(
                'error',
                'Selected course is inactive.'
            );
        }

        if (!$section->is_active) {
            return back()->with(
                'error',
                'Selected section is inactive.'
            );
        }

        if (!$teacher->is_active) {
            return back()->with(
                'error',
                'Selected faculty member is inactive.'
            );
        }

        $duplicate = CourseAssignment::where(
            'course_id',
            $course->id
        )
            ->where(
                'section_id',
                $section->id
            )
            ->where(
                'id',
                '!=',
                $courseAssignment->id
            )
            ->exists();

        if ($duplicate) {
            return back()->with(
                'error',
                'This course is already assigned to this section.'
            );
        }

        if (
            $courseAssignment->routines()->exists()
            &&
            (
                (int) $courseAssignment->course_id !== (int) $course->id
                ||
                (int) $courseAssignment->section_id !== (int) $section->id
                ||
                (int) $courseAssignment->teacher_id !== (int) $teacher->id
            )
        ) {
            return back()->with(
                'error',
                'This assignment is already used in the routine. Delete its routine entries before changing course, section or faculty.'
            );
        }

        $courseAssignment->update([
            'course_id' => $course->id,
            'section_id' => $section->id,
            'teacher_id' => $teacher->id,
            'is_active' => $request->boolean(
                'is_active'
            ),
        ]);

        return back()->with(
            'success',
            'Course assignment updated successfully.'
        );
    }

    public function destroy(
        CourseAssignment $courseAssignment
    ) {
        if ($courseAssignment->routines()->exists()) {
            return back()->with(
                'error',
                'This assignment cannot be deleted because routine entries are using it. Remove those routine entries first.'
            );
        }

        $courseAssignment->delete();

        return back()->with(
            'success',
            'Course assignment deleted successfully.'
        );
    }
}