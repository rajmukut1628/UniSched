<!DOCTYPE html>

<html lang="en">



<head>



    <meta charset="UTF-8">



    <meta

        name="viewport"

        content="width=device-width, initial-scale=1.0"

    >



    <title>Course Assignments | UniSched</title>



    @vite(['resources/css/app.css', 'resources/js/app.js'])



    <style>



        \* {

            box-sizing: border-box;

        }



        body {

            margin: 0;

            min-height: 100vh;



            font-family: Inter, Arial, sans-serif;



            color: #f8fafc;



            background:

                radial-gradient(

                    circle at 88% 4%,

                    rgba(37,99,235,.12),

                    transparent 27%

                ),

                radial-gradient(

                    circle at 8% 95%,

                    rgba(124,58,237,.08),

                    transparent 25%

                ),

                #070b16;

        }



        .layout {

            min-height: 100vh;

            display: flex;

        }



        /* SIDEBAR */



        .sidebar {

            position: fixed;

            top: 0;

            left: 0;



            width: 270px;

            height: 100vh;



            padding: 28px 20px;



            background: rgba(11,17,32,.97);



            border-right:

                1px solid rgba(255,255,255,.07);



            overflow-y: auto;

        }



        .brand {

            display: flex;

            align-items: center;

            gap: 12px;



            padding: 0 8px;

            margin-bottom: 36px;

        }



        .brand-icon {

            width: 43px;

            height: 43px;



            display: flex;

            align-items: center;

            justify-content: center;



            border-radius: 13px;



            background:

                linear-gradient(

                    135deg,

                    #2563eb,

                    #7c3aed

                );



            font-weight: 900;

        }



        .brand-name {

            font-size: 23px;

            font-weight: 800;

        }



        .brand-name span {

            color: #60a5fa;

        }



        .brand-subtitle {

            margin-top: 2px;



            color: #64748b;



            font-size: 10px;

        }



        .nav-title {

            margin: 25px 10px 10px;



            color: #475569;



            font-size: 10px;

            font-weight: 800;



            letter-spacing: 1.6px;

        }



        .nav-item {

            display: flex;

            align-items: center;



            gap: 11px;



            padding: 12px 14px;

            margin-bottom: 5px;



            border-radius: 11px;



            color: #94a3b8;



            text-decoration: none;



            font-size: 14px;



            transition: .2s;

        }



        .nav-item:hover {

            color: #dbeafe;



            background:

                rgba(59,130,246,.08);



            transform: translateX(2px);

        }



        .nav-item.active {

            color: #bfdbfe;



            background:

                linear-gradient(

                    90deg,

                    rgba(37,99,235,.18),

                    rgba(124,58,237,.08)

                );



            border:

                1px solid rgba(59,130,246,.15);

        }



        .nav-icon {

            width: 20px;

            text-align: center;

        }



        .coming {

            opacity: .45;

        }



        /* MAIN */



        .main {

            flex: 1;



            margin-left: 270px;



            padding:

                35px

                38px

                60px;

        }



        .header {

            display: flex;



            align-items: center;

            justify-content: space-between;



            gap: 20px;



            margin-bottom: 27px;

        }



        .header h1 {

            margin: 0;



            font-size: 30px;

            font-weight: 800;

        }



        .header p {

            margin: 7px 0 0;



            color: #64748b;



            font-size: 13px;

        }



        .header-badge {

            padding: 9px 15px;



            border-radius: 20px;



            color: #93c5fd;



            background:

                rgba(59,130,246,.08);



            border:

                1px solid rgba(59,130,246,.12);



            font-size: 11px;

            font-weight: 800;

        }



        /* ALERT */



        .alert {

            padding: 14px 17px;



            margin-bottom: 20px;



            border-radius: 11px;



            font-size: 13px;

        }



        .success {

            color: #86efac;



            background:

                rgba(34,197,94,.08);



            border:

                1px solid rgba(34,197,94,.16);

        }



        .error {

            color: #fca5a5;



            background:

                rgba(239,68,68,.08);



            border:

                1px solid rgba(239,68,68,.16);

        }



        /* STATS */



        .stats {

            display: grid;



            grid-template-columns:

                repeat(4,1fr);



            gap: 14px;



            margin-bottom: 22px;

        }



        .stat {

            padding: 18px;



            border-radius: 15px;



            background:

                rgba(15,23,42,.72);



            border:

                1px solid rgba(255,255,255,.06);

        }



        .stat-label {

            color: #64748b;



            font-size: 10px;

            font-weight: 800;



            letter-spacing: .7px;

        }



        .stat-value {

            margin-top: 9px;



            font-size: 26px;

            font-weight: 800;

        }



        /* PANEL */



        .content-grid {

            display: grid;



            grid-template-columns:

                370px

                minmax(0,1fr);



            gap: 22px;



            align-items: start;

        }



        .panel {

            padding: 23px;



            border-radius: 18px;



            background:

                rgba(15,23,42,.78);



            border:

                1px solid rgba(255,255,255,.065);

        }



        .panel-header {

            margin-bottom: 21px;

        }



        .panel-header h2 {

            margin: 0;



            font-size: 17px;

        }



        .panel-header p {

            margin: 6px 0 0;



            color: #64748b;



            font-size: 11px;

            line-height: 1.6;

        }



        /* FORM */



        .form-group {

            margin-bottom: 16px;

        }



        label {

            display: block;



            margin-bottom: 7px;



            color: #94a3b8;



            font-size: 12px;

            font-weight: 600;

        }



        input,

        select {

            width: 100%;



            padding: 12px 13px;



            border-radius: 10px;



            border:

                1px solid rgba(255,255,255,.08);



            background: #090f1d;



            color: #f8fafc;



            outline: none;

        }



        input:focus,

        select:focus {

            border-color: #3b82f6;



            box-shadow:

                0 0 0 3px rgba(59,130,246,.09);

        }



        select option {

            background: #0f172a;

        }



        select:disabled {

            opacity: .5;

            cursor: not-allowed;

        }



        /* BUTTONS */



        .btn {

            display: inline-flex;



            align-items: center;

            justify-content: center;



            border: 0;



            padding: 10px 14px;



            border-radius: 9px;



            cursor: pointer;



            text-decoration: none;



            font-size: 11px;

            font-weight: 700;

        }



        .primary {

            width: 100%;



            padding: 13px;



            color: white;



            background:

                linear-gradient(

                    135deg,

                    #2563eb,

                    #7c3aed

                );

        }



        .edit {

            color: #93c5fd;



            background:

                rgba(59,130,246,.10);

        }



        .delete {

            color: #fca5a5;



            background:

                rgba(239,68,68,.09);

        }



        .filter-button {

            color: #dbeafe;



            background:

                rgba(59,130,246,.12);

        }



        .reset {

            color: #94a3b8;



            background:

                rgba(100,116,139,.10);

        }



        .save {

            color: white;



            background:

                linear-gradient(

                    135deg,

                    #2563eb,

                    #7c3aed

                );

        }



        /* INFO */



        .info-box {

            margin-top: 18px;



            padding: 16px;



            border-radius: 13px;



            background:

                rgba(59,130,246,.04);



            border:

                1px solid rgba(59,130,246,.09);

        }



        .info-title {

            color: #bfdbfe;



            font-size: 11px;

            font-weight: 800;

        }



        .info-box p {

            margin: 7px 0 0;



            color: #64748b;



            font-size: 10px;

            line-height: 1.6;

        }



        /* FILTER */



        .filter-box {

            padding: 16px;



            margin-bottom: 18px;



            border-radius: 13px;



            background:

                rgba(2,6,23,.40);



            border:

                1px solid rgba(255,255,255,.05);

        }



        .filter-grid {

            display: grid;



            grid-template-columns:

                repeat(4,1fr)

                auto;



            gap: 10px;



            align-items: end;

        }



        .filter-grid .form-group {

            margin: 0;

        }



        .filter-actions {

            display: flex;

            gap: 6px;

        }



        /* TABLE */



        .table-wrapper {

            width: 100%;

            overflow-x: auto;

        }



        table {

            width: 100%;



            min-width: 900px;



            border-collapse: collapse;

        }



        th {

            padding: 12px 10px;



            text-align: left;



            color: #64748b;



            font-size: 10px;

            font-weight: 800;



            border-bottom:

                1px solid rgba(255,255,255,.07);

        }



        td {

            padding: 14px 10px;



            color: #cbd5e1;



            font-size: 12px;



            border-bottom:

                1px solid rgba(255,255,255,.045);

        }



        tbody tr:hover {

            background:

                rgba(59,130,246,.025);

        }



        .course-code {

            color: #93c5fd;



            font-weight: 800;

        }



        .course-name {

            margin-top: 4px;



            color: #64748b;



            font-size: 10px;

        }



        .faculty {

            color: #e2e8f0;



            font-weight: 700;

        }



        .faculty-initial {

            margin-top: 3px;



            color: #60a5fa;



            font-size: 10px;

            font-weight: 800;

        }



        /* BADGE */



        .badge {

            display: inline-block;



            padding: 5px 8px;



            border-radius: 20px;



            font-size: 9px;

            font-weight: 800;

        }



        .semester-badge {

            color: #c4b5fd;



            background:

                rgba(139,92,246,.10);

        }



        .section-badge {

            color: #93c5fd;



            background:

                rgba(59,130,246,.09);

        }



        .theory-badge {

            color: #67e8f9;



            background:

                rgba(6,182,212,.09);

        }



        .lab-badge {

            color: #fde68a;



            background:

                rgba(245,158,11,.09);

        }



        .active-badge {

            color: #86efac;



            background:

                rgba(34,197,94,.09);

        }



        .inactive-badge {

            color: #fca5a5;



            background:

                rgba(239,68,68,.09);

        }



        .actions {

            display: flex;

            gap: 6px;

        }



        /* EDIT */



        .edit-row {

            display: none;

        }



        .edit-box {

            padding: 18px;



            border-radius: 13px;



            background:

                rgba(2,6,23,.55);



            border:

                1px solid rgba(59,130,246,.09);

        }



        .edit-box h3 {

            margin: 0 0 16px;



            color: #dbeafe;



            font-size: 13px;

        }



        .edit-grid {

            display: grid;



            grid-template-columns:

                repeat(3,1fr);



            gap: 10px;

        }



        .checkbox {

            display: flex;

            align-items: center;



            gap: 8px;



            margin-bottom: 15px;

        }



        .checkbox input {

            width: auto;

            margin: 0;

        }



        .checkbox label {

            margin: 0;

        }



        .empty {

            padding: 40px 15px;



            text-align: center;



            color: #64748b;

        }



        @media(max-width:1200px) {



            .stats {

                grid-template-columns:

                    repeat(2,1fr);

            }



            .content-grid {

                grid-template-columns: 1fr;

            }



            .filter-grid {

                grid-template-columns:

                    repeat(2,1fr);

            }

        }



        @media(max-width:850px) {



            .sidebar {

                display: none;

            }



            .main {

                margin-left: 0;

                padding: 25px;

            }

        }



        @media(max-width:650px) {



            .stats,

            .filter-grid,

            .edit-grid {

                grid-template-columns: 1fr;

            }



            .header {

                flex-direction: column;

                align-items: flex-start;

            }

        }



    </style>



    @include('admin.partials.navigation-styles')
</head>



<body>

@include('admin.partials.mobile-navigation')



<div class="layout">



    @include('admin.partials.sidebar')





    <main class="main">



        <div class="header">



            <div>



                <h1>

                    Course Assignments

                </h1>



                <p>

                    Assign each section's courses to the responsible faculty members.

                </p>



            </div>



            <div class="header-badge">



                {{ $assignments->count() }}

                ASSIGNMENTS



            </div>



        </div>





        @if(session('success'))



            <div class="alert success">

                {{ session('success') }}

            </div>



        @endif





        @if(session('error'))



            <div class="alert error">

                {{ session('error') }}

            </div>



        @endif





        @if($errors->any())



            <div class="alert error">



                @foreach($errors->all() as $error)



                    <div>

                        {{ $error }}

                    </div>



                @endforeach



            </div>



        @endif





        <div class="stats">



            <div class="stat">



                <div class="stat-label">

                    DISPLAYED ASSIGNMENTS

                </div>



                <div class="stat-value">

                    {{ $assignments->count() }}

                </div>



            </div>





            <div class="stat">



                <div class="stat-label">

                    ACTIVE

                </div>



                <div class="stat-value">

                    {{ $assignments->where('is_active', true)->count() }}

                </div>



            </div>





            <div class="stat">



                <div class="stat-label">

                    FACULTY INVOLVED

                </div>



                <div class="stat-value">

                    {{ $assignments->pluck('teacher_id')->unique()->count() }}

                </div>



            </div>





            <div class="stat">



                <div class="stat-label">

                    SECTIONS COVERED

                </div>



                <div class="stat-value">

                    {{ $assignments->pluck('section_id')->unique()->count() }}

                </div>



            </div>



        </div>





        <div class="content-grid">



            {{-- ADD ASSIGNMENT --}}



            <section class="panel">



                <div class="panel-header">



                    <h2>

                        New Assignment

                    </h2>



                    <p>

                        Select semester first. UniSched will show only matching sections and courses.

                    </p>



                </div>





                <form

                    method="POST"

                    action="{{ route('admin.course-assignments.store') }}"

                >



                    @csrf



                    <div class="form-group">



    <label>

        Semester

    </label>



    <select

        id="semester_id"

        name="semester_id"

        required

        onchange="filterAssignmentOptions()"

    >



        <option value="">

            Select Semester

        </option>



        @foreach($semesters as $semester)



            <option

                value="{{ $semester->id }}"

                {{ (string) old('semester_id') === (string) $semester->id ? 'selected' : '' }}

            >

                {{ $semester->name }}

            </option>



        @endforeach



    </select>



</div>





                    <div class="form-group">



                        <label>

                            Section

                        </label>



                        <select

    id="section_id"

    name="section_id"

    required

>



                            <option value="">

                                Select Section

                            </option>



                            @foreach($sections as $section)



                                <option

                                    value="{{ $section->id }}"

                                    data-semester="{{ $section->semester_id }}"

                                    {{ (string) old('section_id') === (string) $section->id ? 'selected' : '' }}

                                >

                                    {{ $section->code }}

                                    —

                                    {{ $section->semester->name }}

                                </option>



                            @endforeach



                        </select>



                    </div>





                    <div class="form-group">



                        <label>

                            Course

                        </label>



                        <select

    id="course_id"

    name="course_id"

    required

>



                            <option value="">

                                Select Course

                            </option>



                           @foreach($courses as $course)



    <option

        value="{{ $course->id }}"

        data-semesters="{{ $course->semesters->pluck('id')->implode(',') }}"

        {{ (string) old('course_id') === (string) $course->id ? 'selected' : '' }}

    >

                                    {{ $course->course_code }}

                                    —

                                    {{ $course->course_name }}

                                </option>



                            @endforeach



                        </select>



                    </div>





                    <div class="form-group">



                        <label>

                            Faculty

                        </label>



                        <select

                            name="teacher_id"

                            required

                        >



                            <option value="">

                                Select Faculty

                            </option>



                            @foreach($teachers as $teacher)



                                <option

                                    value="{{ $teacher->id }}"

                                    {{ (string) old('teacher_id') === (string) $teacher->id ? 'selected' : '' }}

                                >

                                    {{ $teacher->initial }}

                                    —

                                    {{ $teacher->name }}

                                </option>



                            @endforeach



                        </select>



                    </div>





                    <button

                        type="submit"

                        class="btn primary"

                    >

                        Create Assignment

                    </button>



                </form>





                <div class="info-box">



                    <div class="info-title">

                        Assignment Protection

                    </div>



                    <p>

                        The same course cannot be assigned twice to the same section. Course and section must also belong to the same semester.

                    </p>



                </div>



            </section>





            {{-- ASSIGNMENTS --}}



            <section class="panel">



                <div class="panel-header">



                    <h2>

                        Assignment Directory

                    </h2>



                    <p>

                        Review and manage faculty teaching responsibilities before creating the routine.

                    </p>



                </div>





                {{-- FILTER --}}



                <div class="filter-box">



                    <form

                        method="GET"

                        action="{{ route('admin.course-assignments.index') }}"

                    >



                        <div class="filter-grid">



                            <div class="form-group">



                                <label>

                                    Semester

                                </label>



                                <select

                                    name="semester_id"

                                    id="filter_semester"

                                    onchange="filterFilterSections()"

                                >



                                    <option value="">

                                        All Semesters

                                    </option>



                                    @foreach($semesters as $semester)



                                        <option

                                            value="{{ $semester->id }}"

                                            {{ (string) request('semester_id') === (string) $semester->id ? 'selected' : '' }}

                                        >

                                            {{ $semester->name }}

                                        </option>



                                    @endforeach



                                </select>



                            </div>





                            <div class="form-group">



                                <label>

                                    Section

                                </label>



                                <select

                                    name="section_id"

                                    id="filter_section"

                                >



                                    <option value="">

                                        All Sections

                                    </option>



                                    @foreach($sections as $section)



                                        <option

                                            value="{{ $section->id }}"

                                            data-semester="{{ $section->semester_id }}"

                                            {{ (string) request('section_id') === (string) $section->id ? 'selected' : '' }}

                                        >

                                            {{ $section->code }}

                                        </option>



                                    @endforeach



                                </select>



                            </div>





                            <div class="form-group">



                                <label>

                                    Faculty

                                </label>



                                <select name="teacher_id">



                                    <option value="">

                                        All Faculty

                                    </option>



                                    @foreach($teachers as $teacher)



                                        <option

                                            value="{{ $teacher->id }}"

                                            {{ (string) request('teacher_id') === (string) $teacher->id ? 'selected' : '' }}

                                        >

                                            {{ $teacher->initial }}

                                        </option>



                                    @endforeach



                                </select>



                            </div>





                            <div class="form-group">



                                <label>

                                    Status

                                </label>



                                <select name="status">



                                    <option value="">

                                        All

                                    </option>



                                    <option

                                        value="active"

                                        {{ request('status') === 'active' ? 'selected' : '' }}

                                    >

                                        Active

                                    </option>



                                    <option

                                        value="inactive"

                                        {{ request('status') === 'inactive' ? 'selected' : '' }}

                                    >

                                        Inactive

                                    </option>



                                </select>



                            </div>





                            <div class="filter-actions">



                                <button

                                    type="submit"

                                    class="btn filter-button"

                                >

                                    Filter

                                </button>



                                <a

                                    href="{{ route('admin.course-assignments.index') }}"

                                    class="btn reset"

                                >

                                    Reset

                                </a>



                            </div>



                        </div>



                    </form>



                </div>





                <div class="table-wrapper">



                    <table>



                        <thead>



                        <tr>

                            <th>SEMESTER</th>

                            <th>SECTION</th>

                            <th>COURSE</th>

                            <th>FACULTY</th>

                            <th>TYPE</th>

                            <th>STATUS</th>

                            <th>ACTION</th>

                        </tr>



                        </thead>





                        <tbody>



                        @forelse($assignments as $assignment)



                            <tr>



                                <td>



                                    <span class="badge semester-badge">



                                        {{ $assignment->section->semester->name }}



                                    </span>



                                </td>





                                <td>



                                    <span class="badge section-badge">

                                        {{ $assignment->section->code }}

                                    </span>



                                </td>





                                <td>



                                    <div class="course-code">

                                        {{ $assignment->course->course_code }}

                                    </div>



                                    <div class="course-name">

                                        {{ $assignment->course->course_name }}

                                    </div>



                                </td>





                                <td>



                                    <div class="faculty">

                                        {{ $assignment->teacher->name }}

                                    </div>



                                    <div class="faculty-initial">

                                        {{ $assignment->teacher->initial }}

                                    </div>



                                </td>





                                <td>



                                    @if($assignment->course->course_type === 'lab')



                                        <span class="badge lab-badge">

                                            LAB

                                        </span>



                                    @else



                                        <span class="badge theory-badge">

                                            THEORY

                                        </span>



                                    @endif



                                </td>





                                <td>



                                    @if($assignment->is_active)



                                        <span class="badge active-badge">

                                            ACTIVE

                                        </span>



                                    @else



                                        <span class="badge inactive-badge">

                                            INACTIVE

                                        </span>



                                    @endif



                                </td>





                                <td>



                                    <div class="actions">



                                        <button

                                            type="button"

                                            class="btn edit"

                                            onclick="toggleAssignment({{ $assignment->id }})"

                                        >

                                            Edit

                                        </button>





                                        <form

                                            method="POST"

                                            action="{{ route('admin.course-assignments.destroy', $assignment) }}"

                                            onsubmit="return confirm('Delete this course assignment?')"

                                        >



                                            @csrf

                                            @method('DELETE')



                                            <button

                                                type="submit"

                                                class="btn delete"

                                            >

                                                Delete

                                            </button>



                                        </form>



                                    </div>



                                </td>



                            </tr>





                            <tr

                                id="assignment-edit-{{ $assignment->id }}"

                                class="edit-row"

                            >



                                <td colspan="7">



                                    <div class="edit-box">



                                        <h3>

                                            Edit Assignment —

                                            {{ $assignment->course->course_code }}

                                            /

                                            {{ $assignment->section->code }}

                                        </h3>





                                        <form

                                            method="POST"

                                            action="{{ route('admin.course-assignments.update', $assignment) }}"

                                        >



                                            @csrf

                                            @method('PUT')





                                            <div class="edit-grid">



                                                <div class="form-group">



                                                    <label>

                                                        Section

                                                    </label>



                                                    <select
                                                        name="section_id"
                                                        class="edit-section-select"
                                                        data-assignment="{{ $assignment->id }}"
                                                        onchange="filterEditCourses({{ $assignment->id }})"
                                                        required
                                                    >



                                                        @foreach($sections as $section)



                                                            <option

    value="{{ $section->id }}"

    data-semester="{{ $section->semester_id }}"

    {{ $assignment->section_id === $section->id ? 'selected' : '' }}

>

                                                                {{ $section->semester->name }}

                                                                —

                                                                {{ $section->code }}

                                                            </option>



                                                        @endforeach



                                                    </select>



                                                </div>





                                                <div class="form-group">



                                                    <label>

                                                        Course

                                                    </label>



                                                    <select
                                                        name="course_id"
                                                        id="edit-course-{{ $assignment->id }}"
                                                        required
                                                    >



                                                        @foreach($courses as $course)



                                                            <option

                                                                value="{{ $course->id }}"
                                                        data-semesters="{{ $course->semesters->pluck('id')->implode(',') }}"

                                                                {{ $assignment->course_id === $course->id ? 'selected' : '' }}

                                                            >

                                                                {{ $course->course_code }}

                                                                —

                                                                {{ $course->course_name }}

                                                            </option>



                                                        @endforeach



                                                    </select>



                                                </div>





                                                <div class="form-group">



                                                    <label>

                                                        Faculty

                                                    </label>



                                                    <select

                                                        name="teacher_id"

                                                        required

                                                    >



                                                        @foreach($teachers as $teacher)



                                                            <option

                                                                value="{{ $teacher->id }}"

                                                                {{ $assignment->teacher_id === $teacher->id ? 'selected' : '' }}

                                                            >

                                                                {{ $teacher->initial }}

                                                                —

                                                                {{ $teacher->name }}

                                                            </option>



                                                        @endforeach



                                                    </select>



                                                </div>



                                            </div>





                                            <div class="checkbox">



                                                <input

                                                    type="checkbox"

                                                    id="assignment-active-{{ $assignment->id }}"

                                                    name="is_active"

                                                    value="1"

                                                    {{ $assignment->is_active ? 'checked' : '' }}

                                                >



                                                <label

                                                    for="assignment-active-{{ $assignment->id }}"

                                                >

                                                    Active Assignment

                                                </label>



                                            </div>





                                            <button

                                                type="submit"

                                                class="btn save"

                                            >

                                                Save Changes

                                            </button>



                                        </form>



                                    </div>



                                </td>



                            </tr>



                        @empty



                            <tr>



                                <td

                                    colspan="7"

                                    class="empty"

                                >

                                    No course assignments found.

                                </td>



                            </tr>



                        @endforelse



                        </tbody>



                    </table>



                </div>



            </section>



        </div>



    </main>



</div>





<script>



    function filterAssignmentOptions() {



    const semesterSelect =

        document.getElementById('semester_id');



    const sectionSelect =

        document.getElementById('section_id');



    const courseSelect =

        document.getElementById('course_id');



    if (!semesterSelect || !sectionSelect || !courseSelect) {

        return;

    }



    const semester = semesterSelect.value;





    // =========================

    // FILTER SECTIONS

    // =========================



    const sectionOptions =

        sectionSelect.querySelectorAll(

            'option[data-semester]'

        );



    sectionOptions.forEach(function (option) {



        const show =

            semester !== '' &&

            option.dataset.semester === semester;



        option.hidden = !show;

        option.disabled = !show;



        if (!show && option.selected) {

            option.selected = false;

        }



    });



    sectionSelect.disabled = semester === '';





    // =========================

    // FILTER COURSES

    // =========================



    const courseOptions =

        courseSelect.querySelectorAll(

            'option[data-semesters]'

        );



    courseOptions.forEach(function (option) {



        const offeredSemesters =

            (option.dataset.semesters || '')

                .split(',')

                .map(id => id.trim());



        const show =

            semester !== '' &&

            offeredSemesters.includes(semester);



        option.hidden = !show;

        option.disabled = !show;



        if (!show && option.selected) {

            option.selected = false;

        }



    });



    courseSelect.disabled = semester === '';

}





    function filterFilterSections() {



        const semester =

            document.getElementById(

                'filter_semester'

            ).value;



        const sectionSelect =

            document.getElementById(

                'filter_section'

            );



        const options =

            sectionSelect.querySelectorAll(

                'option[data-semester]'

            );



        options.forEach(function (option) {



            const show =

                semester === ''

                ||

                option.dataset.semester === semester;



            option.hidden = !show;

            option.disabled = !show;



            if (!show && option.selected) {

                option.selected = false;

            }



        });

    }

     function filterEditCourses(assignmentId) {



    const sectionSelect =

        document.querySelector(

            '.edit-section-select[data-assignment="' +

            assignmentId +

            '"]'

        );



    const courseSelect =

        document.getElementById(

            'edit-course-' + assignmentId

        );



    if (!sectionSelect || !courseSelect) {

        return;

    }



    const selectedSection =

        sectionSelect.options[

            sectionSelect.selectedIndex

        ];



    const semesterId =

        selectedSection

            ? selectedSection.dataset.semester

            : '';



    const courseOptions =

        courseSelect.querySelectorAll(

            'option[data-semesters]'

        );



    courseOptions.forEach(function (option) {



        const offeredSemesters =

            (option.dataset.semesters || '')

                .split(',')

                .map(id => id.trim());



        const show =

            semesterId !== '' &&

            offeredSemesters.includes(semesterId);



        option.hidden = !show;

        option.disabled = !show;



        if (!show && option.selected) {

            option.selected = false;

        }



    });

}



    function toggleAssignment(id) {



        const row =

            document.getElementById(

                'assignment-edit-' + id

            );



        if (!row) {

            return;

        }



        row.style.display =

            row.style.display === 'table-row'

                ? 'none'

                : 'table-row';

    }





    document.addEventListener(

        'DOMContentLoaded',

        function () {



            filterAssignmentOptions();

            filterFilterSections();



        }

    );



</script>



</body>

</html>