<?php

use App\Http\Controllers\Admin\AdminManagementController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CourseAssignmentController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\RoutineController;
use App\Http\Controllers\Admin\RoutineExportController;
use App\Http\Controllers\Admin\RoutinePublishController;
use App\Http\Controllers\Admin\RoutineViewController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\SemesterController;
use App\Http\Controllers\Admin\TeacherAvailabilityController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\TimeSlotController;
use App\Http\Controllers\PublicRoutineController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Public Website
|--------------------------------------------------------------------------
*/

Route::view(
    '/',
    'welcome'
)->name('home');


/*
|--------------------------------------------------------------------------
| Public Student Routine
|--------------------------------------------------------------------------
*/

Route::get(
    '/routine',
    [PublicRoutineController::class, 'student']
)->name('public.routine');


/*
|--------------------------------------------------------------------------
| Public Faculty Routine
|--------------------------------------------------------------------------
*/

Route::get(
    '/faculty-routine',
    [PublicRoutineController::class, 'faculty']
)->name('public.faculty-routine');


/*
|--------------------------------------------------------------------------
| Guest / Admin Authentication
|--------------------------------------------------------------------------
|
| Only users who are not currently logged in can access these routes.
|
*/

Route::middleware('guest')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Admin Login
    |--------------------------------------------------------------------------
    */
    Route::get('/login', function () {
    return redirect()->route('admin.login');
     })->name('login');

    Route::get(
        '/admin/login',
        [AuthController::class, 'showLogin']
    )->name('admin.login');


    Route::post(
        '/admin/login',
        [AuthController::class, 'login']
    )->name('admin.login.submit');


    /*
    |--------------------------------------------------------------------------
    | Forgot Password
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/admin/forgot-password',
        [AuthController::class, 'showForgotPassword']
    )->name('admin.password.request');


    Route::post(
        '/admin/forgot-password',
        [AuthController::class, 'sendResetLink']
    )->name('admin.password.email');


    /*
    |--------------------------------------------------------------------------
    | Reset Password
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/admin/reset-password/{token}',
        [AuthController::class, 'showResetPassword']
    )->name('admin.password.reset');


    Route::post(
        '/admin/reset-password',
        [AuthController::class, 'resetPassword']
    )->name('admin.password.update');
});


/*
|--------------------------------------------------------------------------
| Protected Admin Panel
|--------------------------------------------------------------------------
|
| Everything below requires authenticated administrator access.
|
*/

Route::middleware('auth')
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {


        /*
        |--------------------------------------------------------------------------
        | Dashboard
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/dashboard',
            [DashboardController::class, 'index']
        )->name('dashboard');


        /*
        |--------------------------------------------------------------------------
        | Semester Management
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/semesters',
            [SemesterController::class, 'index']
        )->name('semesters.index');


        Route::post(
            '/semesters',
            [SemesterController::class, 'store']
        )->name('semesters.store');


        Route::put(
            '/semesters/{semester}',
            [SemesterController::class, 'update']
        )->name('semesters.update');


        Route::delete(
            '/semesters/{semester}',
            [SemesterController::class, 'destroy']
        )->name('semesters.destroy');


        /*
        |--------------------------------------------------------------------------
        | Section Management
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/sections',
            [SectionController::class, 'index']
        )->name('sections.index');


        Route::post(
            '/sections',
            [SectionController::class, 'store']
        )->name('sections.store');


        Route::put(
            '/sections/{section}',
            [SectionController::class, 'update']
        )->name('sections.update');


        Route::delete(
            '/sections/{section}',
            [SectionController::class, 'destroy']
        )->name('sections.destroy');


        /*
        |--------------------------------------------------------------------------
        | Course Management
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/courses',
            [CourseController::class, 'index']
        )->name('courses.index');


        Route::post(
            '/courses',
            [CourseController::class, 'store']
        )->name('courses.store');


        Route::put(
            '/courses/{course}',
            [CourseController::class, 'update']
        )->name('courses.update');


        Route::delete(
            '/courses/{course}',
            [CourseController::class, 'destroy']
        )->name('courses.destroy');


        /*
        |--------------------------------------------------------------------------
        | Faculty Management
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/teachers',
            [TeacherController::class, 'index']
        )->name('teachers.index');


        Route::post(
            '/teachers',
            [TeacherController::class, 'store']
        )->name('teachers.store');


        Route::put(
            '/teachers/{teacher}',
            [TeacherController::class, 'update']
        )->name('teachers.update');


        Route::delete(
            '/teachers/{teacher}',
            [TeacherController::class, 'destroy']
        )->name('teachers.destroy');


        /*
        |--------------------------------------------------------------------------
        | Faculty Availability
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/faculty-availability',
            [TeacherAvailabilityController::class, 'index']
        )->name('teacher-availability.index');


        Route::put(
            '/faculty-availability/{teacher}',
            [TeacherAvailabilityController::class, 'update']
        )->name('teacher-availability.update');


        Route::post(
            '/faculty-availability/{teacher}/all',
            [TeacherAvailabilityController::class, 'makeAllAvailable']
        )->name('teacher-availability.all');


        Route::delete(
            '/faculty-availability/{teacher}/clear',
            [TeacherAvailabilityController::class, 'clear']
        )->name('teacher-availability.clear');


        /*
        |--------------------------------------------------------------------------
        | Time Slot Management
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/time-slots',
            [TimeSlotController::class, 'index']
        )->name('time-slots.index');


        Route::post(
            '/time-slots',
            [TimeSlotController::class, 'store']
        )->name('time-slots.store');


        Route::put(
            '/time-slots/{timeSlot}',
            [TimeSlotController::class, 'update']
        )->name('time-slots.update');


        Route::delete(
            '/time-slots/{timeSlot}',
            [TimeSlotController::class, 'destroy']
        )->name('time-slots.destroy');


        /*
        |--------------------------------------------------------------------------
        | Room & Lab Management
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/rooms',
            [RoomController::class, 'index']
        )->name('rooms.index');


        Route::post(
            '/rooms',
            [RoomController::class, 'store']
        )->name('rooms.store');


        Route::put(
            '/rooms/{room}',
            [RoomController::class, 'update']
        )->name('rooms.update');


        Route::delete(
            '/rooms/{room}',
            [RoomController::class, 'destroy']
        )->name('rooms.destroy');


        /*
        |--------------------------------------------------------------------------
        | Course Assignment
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/course-assignments',
            [CourseAssignmentController::class, 'index']
        )->name('course-assignments.index');


        Route::post(
            '/course-assignments',
            [CourseAssignmentController::class, 'store']
        )->name('course-assignments.store');


        Route::put(
            '/course-assignments/{courseAssignment}',
            [CourseAssignmentController::class, 'update']
        )->name('course-assignments.update');


        Route::delete(
            '/course-assignments/{courseAssignment}',
            [CourseAssignmentController::class, 'destroy']
        )->name('course-assignments.destroy');


        /*
        |--------------------------------------------------------------------------
        | Smart Routine Builder
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/routines',
            [RoutineController::class, 'index']
        )->name('routines.index');


        Route::post(
            '/routines',
            [RoutineController::class, 'store']
        )->name('routines.store');


        Route::put(
            '/routines/{routine}',
            [RoutineController::class, 'update']
        )->name('routines.update');


        Route::delete(
            '/routines/{routine}',
            [RoutineController::class, 'destroy']
        )->name('routines.destroy');


        /*
        |--------------------------------------------------------------------------
        | Smart Routine Suggestions
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/routine-smart/time-slots',
            [RoutineController::class, 'availableTimeSlots']
        )->name('routines.available-time-slots');


        Route::get(
            '/routine-smart/rooms',
            [RoutineController::class, 'availableRooms']
        )->name('routines.available-rooms');


        /*
        |--------------------------------------------------------------------------
        | Routine Views
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/routine-views',
            [RoutineViewController::class, 'index']
        )->name('routine-views.index');


        /*
        |--------------------------------------------------------------------------
        | Professional Routine Print / Save PDF
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/routine-export/print',
            [RoutineExportController::class, 'print']
        )->name('routine-export.print');


        /*
        |--------------------------------------------------------------------------
        | Routine Publish Management
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/routine-publish',
            [RoutinePublishController::class, 'index']
        )->name('routine-publish.index');


        /*
        |--------------------------------------------------------------------------
        | Single Routine Publish
        |--------------------------------------------------------------------------
        */

        Route::post(
            '/routines/{routine}/publish',
            [RoutinePublishController::class, 'publish']
        )->name('routines.publish');


        /*
        |--------------------------------------------------------------------------
        | Single Routine Draft
        |--------------------------------------------------------------------------
        */

        Route::post(
            '/routines/{routine}/draft',
            [RoutinePublishController::class, 'draft']
        )->name('routines.draft');


        /*
        |--------------------------------------------------------------------------
        | Bulk Publish
        |--------------------------------------------------------------------------
        */

        Route::post(
            '/routine-publish/bulk',
            [RoutinePublishController::class, 'bulkPublish']
        )->name('routine-publish.bulk');


        /*
        |--------------------------------------------------------------------------
        | Bulk Draft
        |--------------------------------------------------------------------------
        */

        Route::post(
            '/routine-draft/bulk',
            [RoutinePublishController::class, 'bulkDraft']
        )->name('routine-draft.bulk');


        /*
        |--------------------------------------------------------------------------
        | Publish Current Filtered Routine
        |--------------------------------------------------------------------------
        */

        Route::post(
            '/routine-publish/filtered',
            [RoutinePublishController::class, 'publishFiltered']
        )->name('routine-publish.filtered');


        /*
        |--------------------------------------------------------------------------
        | Draft Current Filtered Routine
        |--------------------------------------------------------------------------
        */

        Route::post(
            '/routine-draft/filtered',
            [RoutinePublishController::class, 'draftFiltered']
        )->name('routine-draft.filtered');


        /*
        |--------------------------------------------------------------------------
        | Admin Management
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/admins',
            [AdminManagementController::class, 'index']
        )->name('admins.index');


        /*
        |--------------------------------------------------------------------------
        | Create Admin
        |--------------------------------------------------------------------------
        */

        Route::post(
            '/admins',
            [AdminManagementController::class, 'store']
        )->name('admins.store');


        /*
        |--------------------------------------------------------------------------
        | Update Admin
        |--------------------------------------------------------------------------
        */

        Route::put(
            '/admins/{admin}',
            [AdminManagementController::class, 'update']
        )->name('admins.update');


        /*
        |--------------------------------------------------------------------------
        | Change Admin Password
        |--------------------------------------------------------------------------
        */

        Route::put(
            '/admins/{admin}/password',
            [AdminManagementController::class, 'updatePassword']
        )->name('admins.password');


        /*
        |--------------------------------------------------------------------------
        | Delete Admin
        |--------------------------------------------------------------------------
        */

        Route::delete(
            '/admins/{admin}',
            [AdminManagementController::class, 'destroy']
        )->name('admins.destroy');


        /*
        |--------------------------------------------------------------------------
        | Logout
        |--------------------------------------------------------------------------
        */

        Route::post(
            '/logout',
            [AuthController::class, 'logout']
        )->name('logout');
    });