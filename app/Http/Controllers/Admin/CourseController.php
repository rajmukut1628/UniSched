<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class CourseController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Course List
    |--------------------------------------------------------------------------
    */
    public function index(Request $request)
    {
        $semesters = Semester::orderBy('number')->get();

        $courses = Course::with([
                'semester',
                'semesters' => function ($query) {
                    $query->orderBy('number');
                }
            ])

            // Semester filter now uses pivot table
            ->when($request->semester_id, function ($query, $semesterId) {
                $query->whereHas('semesters', function ($q) use ($semesterId) {
                    $q->where('semesters.id', $semesterId);
                });
            })

            ->when($request->course_type, function ($query, $type) {
                $query->where('course_type', $type);
            })

            ->when($request->search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('course_code', 'like', '%' . $search . '%')
                      ->orWhere('course_name', 'like', '%' . $search . '%');
                });
            })

            ->orderBy('course_code')
            ->get();

        return view(
            'admin.courses.index',
            compact('courses', 'semesters')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Store Course
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $validated = $request->validate([

            'semester_ids' => [
                'required',
                'array',
                'min:1',
            ],

            'semester_ids.*' => [
                'required',
                'integer',
                'distinct',
                'exists:semesters,id',
            ],

            'course_code' => [
                'required',
                'string',
                'max:50',
                'unique:courses,course_code',
            ],

            'course_name' => [
                'required',
                'string',
                'max:255',
            ],

            'credit' => [
                'required',
                'numeric',
                'min:0.5',
                'max:10',
            ],

            'course_type' => [
                'required',
                Rule::in([
                    'theory',
                    'lab',
                ]),
            ],
        ]);

        DB::transaction(function () use ($validated) {

            /*
             * Keep first selected semester as legacy semester_id.
             * This keeps old Assignment/Routine code compatible.
             */
            $primarySemesterId = $validated['semester_ids'][0];

            $course = Course::create([

                'semester_id' => $primarySemesterId,

                'course_code' => strtoupper(
                    trim($validated['course_code'])
                ),

                'course_name' => trim(
                    $validated['course_name']
                ),

                'credit' => $validated['credit'],

                'course_type' => $validated['course_type'],

                'is_active' => true,
            ]);

            /*
             * Save all offered semesters
             */
            $course->semesters()->sync(
                $validated['semester_ids']
            );
        });

        return back()->with(
            'success',
            'Course added successfully.'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Update Course
    |--------------------------------------------------------------------------
    */
    public function update(
        Request $request,
        Course $course
    ) {
        $validated = $request->validate([

            'semester_ids' => [
                'required',
                'array',
                'min:1',
            ],

            'semester_ids.*' => [
                'required',
                'integer',
                'distinct',
                'exists:semesters,id',
            ],

            'course_code' => [
                'required',
                'string',
                'max:50',

                Rule::unique(
                    'courses',
                    'course_code'
                )->ignore($course->id),
            ],

            'course_name' => [
                'required',
                'string',
                'max:255',
            ],

            'credit' => [
                'required',
                'numeric',
                'min:0.5',
                'max:10',
            ],

            'course_type' => [
                'required',
                Rule::in([
                    'theory',
                    'lab',
                ]),
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],
        ]);

        DB::transaction(function () use (
            $validated,
            $request,
            $course
        ) {

            /*
             * First selected semester remains the legacy
             * primary semester.
             */
            $primarySemesterId = $validated['semester_ids'][0];

            $course->update([

                'semester_id' => $primarySemesterId,

                'course_code' => strtoupper(
                    trim($validated['course_code'])
                ),

                'course_name' => trim(
                    $validated['course_name']
                ),

                'credit' => $validated['credit'],

                'course_type' => $validated['course_type'],

                'is_active' => $request->boolean(
                    'is_active'
                ),
            ]);

            /*
             * Update pivot semesters.
             *
             * Removed semester -> detached
             * New semester     -> attached
             */
            $course->semesters()->sync(
                $validated['semester_ids']
            );
        });

        return back()->with(
            'success',
            'Course updated successfully.'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Delete Course
    |--------------------------------------------------------------------------
    */
    public function destroy(Course $course)
    {
        if ($course->assignments()->exists()) {

            return back()->with(
                'error',
                'This course cannot be deleted because it is already assigned to a section and faculty member.'
            );
        }

        DB::transaction(function () use ($course) {

            /*
             * Usually cascadeOnDelete handles this.
             * Explicit detach keeps it safe.
             */
            $course->semesters()->detach();

            $course->delete();
        });

        return back()->with(
            'success',
            'Course deleted successfully.'
        );
    }
}