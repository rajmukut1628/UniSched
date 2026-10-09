<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Course Management | UniSched</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: Inter, Arial, sans-serif;
            background:
                radial-gradient(circle at 85% 5%, rgba(37,99,235,.10), transparent 25%),
                radial-gradient(circle at 15% 95%, rgba(124,58,237,.08), transparent 25%),
                #070b16;
            color: #f8fafc;
        }

        .layout {
            min-height: 100vh;
            display: flex;
        }

        /* ========================================
           SIDEBAR
        ======================================== */

        .sidebar {
            width: 270px;
            min-height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 100;

            padding: 28px 20px;

            background: rgba(11,17,32,.97);
            border-right: 1px solid rgba(255,255,255,.07);

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

            background: linear-gradient(
                135deg,
                #2563eb,
                #7c3aed
            );

            font-weight: 900;

            box-shadow:
                0 10px 25px
                rgba(37,99,235,.25);
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
            background: rgba(59,130,246,.08);
            transform: translateX(2px);
        }

        .nav-item.active {
            color: #bfdbfe;

            background: linear-gradient(
                90deg,
                rgba(37,99,235,.18),
                rgba(124,58,237,.08)
            );

            border:
                1px solid
                rgba(59,130,246,.15);
        }

        .nav-icon {
            width: 20px;
            text-align: center;
        }

        .coming {
            opacity: .45;
            cursor: default;
        }

        .coming:hover {
            transform: none;
        }

        /* ========================================
           MAIN
        ======================================== */

        .main {
            flex: 1;
            margin-left: 270px;
            padding: 35px 38px 60px;
        }

        /* ========================================
           HEADER
        ======================================== */

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;

            gap: 20px;

            margin-bottom: 28px;
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

        .course-count {
            padding: 9px 15px;

            border-radius: 20px;

            color: #93c5fd;
            background: rgba(59,130,246,.08);

            border:
                1px solid
                rgba(59,130,246,.12);

            font-size: 12px;
            font-weight: 800;
        }

        /* ========================================
           ALERT
        ======================================== */

        .alert {
            margin-bottom: 20px;
            padding: 14px 17px;

            border-radius: 11px;

            font-size: 13px;
        }

        .alert-success {
            color: #86efac;
            background: rgba(34,197,94,.08);

            border:
                1px solid
                rgba(34,197,94,.16);
        }

        .alert-error {
            color: #fca5a5;
            background: rgba(239,68,68,.08);

            border:
                1px solid
                rgba(239,68,68,.16);
        }

        /* ========================================
           STATISTICS
        ======================================== */

        .stats {
            display: grid;

            grid-template-columns:
                repeat(4, 1fr);

            gap: 14px;

            margin-bottom: 22px;
        }

        .stat-card {
            padding: 18px;

            border-radius: 15px;

            background:
                rgba(15,23,42,.72);

            border:
                1px solid
                rgba(255,255,255,.06);
        }

        .stat-label {
            color: #64748b;

            font-size: 10px;
            font-weight: 800;

            letter-spacing: .8px;
        }

        .stat-value {
            margin-top: 9px;

            font-size: 25px;
            font-weight: 800;
        }

        /* ========================================
           GRID
        ======================================== */

        .content-grid {
            display: grid;

            grid-template-columns:
                350px
                minmax(0, 1fr);

            gap: 22px;

            align-items: start;
        }

        /* ========================================
           PANEL
        ======================================== */

        .panel {
            padding: 23px;

            border-radius: 18px;

            background:
                rgba(15,23,42,.78);

            border:
                1px solid
                rgba(255,255,255,.065);
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

        /* ========================================
           FORMS
        ======================================== */

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
                1px solid
                rgba(255,255,255,.08);

            background: #090f1d;

            color: #f8fafc;

            outline: none;

            transition: .2s;
        }

        input:focus,
        select:focus {
            border-color: #3b82f6;

            box-shadow:
                0 0 0 3px
                rgba(59,130,246,.09);
        }

        select option {
            background: #0f172a;
            color: white;
        }

        .form-row {
            display: grid;

            grid-template-columns:
                1fr
                1fr;

            gap: 12px;
        }

        /* ========================================
           BUTTONS
        ======================================== */

        .btn {
            border: 0;

            padding: 10px 14px;

            border-radius: 9px;

            cursor: pointer;

            font-size: 11px;
            font-weight: 700;

            transition: .2s;
        }

        .btn-primary {
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

        .btn-primary:hover {
            transform: translateY(-1px);

            box-shadow:
                0 10px 25px
                rgba(37,99,235,.18);
        }

        .btn-edit {
            color: #93c5fd;
            background: rgba(59,130,246,.10);
        }

        .btn-delete {
            color: #fca5a5;
            background: rgba(239,68,68,.09);
        }

        .btn-filter {
            color: #dbeafe;
            background: rgba(59,130,246,.12);
        }

        .btn-reset {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            text-decoration: none;

            color: #94a3b8;
            background: rgba(100,116,139,.10);
        }

        .btn-save {
            color: white;

            background:
                linear-gradient(
                    135deg,
                    #2563eb,
                    #7c3aed
                );
        }

        /* ========================================
           FILTERS
        ======================================== */

        .filter-box {
            margin-bottom: 18px;

            padding: 16px;

            border-radius: 13px;

            background:
                rgba(2,6,23,.40);

            border:
                1px solid
                rgba(255,255,255,.05);
        }

        .filter-grid {
            display: grid;

            grid-template-columns:
                1.3fr
                1fr
                .8fr
                auto;

            gap: 10px;

            align-items: end;
        }

        .filter-grid .form-group {
            margin: 0;
        }

        .filter-actions {
            display: flex;
            gap: 7px;
        }

        /* ========================================
           TABLE
        ======================================== */

        .table-wrapper {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;

            border-collapse: collapse;

            min-width: 820px;
        }

        th {
            padding: 12px 11px;

            text-align: left;

            color: #64748b;

            font-size: 10px;
            font-weight: 800;

            letter-spacing: .6px;

            border-bottom:
                1px solid
                rgba(255,255,255,.07);
        }

        td {
            padding: 14px 11px;

            color: #cbd5e1;

            font-size: 12px;

            border-bottom:
                1px solid
                rgba(255,255,255,.045);
        }

        tbody tr:hover {
            background:
                rgba(59,130,246,.025);
        }

        .course-code {
            color: #bfdbfe;
            font-weight: 800;
        }

        .course-name {
            color: #e2e8f0;
            font-weight: 600;
        }

        .semester-text {
            color: #94a3b8;
        }

        /* ========================================
           BADGES
        ======================================== */

        .badge {
            display: inline-block;

            padding: 5px 8px;

            border-radius: 20px;

            font-size: 9px;
            font-weight: 800;

            letter-spacing: .4px;
        }

        .badge-theory {
            color: #93c5fd;
            background: rgba(59,130,246,.09);
        }

        .badge-lab {
            color: #c4b5fd;
            background: rgba(139,92,246,.10);
        }

        .badge-active {
            color: #86efac;
            background: rgba(34,197,94,.09);
        }

        .badge-inactive {
            color: #fca5a5;
            background: rgba(239,68,68,.09);
        }

        /* ========================================
           ACTIONS
        ======================================== */

        .actions {
            display: flex;
            gap: 6px;
        }

        .edit-row {
            display: none;
        }

        .edit-container {
            padding: 18px;

            border-radius: 13px;

            background:
                rgba(2,6,23,.55);

            border:
                1px solid
                rgba(59,130,246,.09);
        }

        .edit-container h3 {
            margin: 0 0 16px;

            color: #dbeafe;

            font-size: 13px;
        }

        .edit-grid {
            display: grid;

            grid-template-columns:
                repeat(5, 1fr);

            gap: 11px;
        }

        .edit-grid .form-group {
            margin-bottom: 12px;
        }

        .checkbox-row {
            display: flex;
            align-items: center;
            gap: 8px;

            margin: 5px 0 15px;
        }

        .checkbox-row input {
            width: auto;
            margin: 0;
        }

        .checkbox-row label {
            margin: 0;
        }

        /* ========================================
           EMPTY
        ======================================== */

        .empty {
            padding: 35px 15px;

            text-align: center;

            color: #64748b;
        }

        /* ========================================
           RESPONSIVE
        ======================================== */

        @media(max-width:1200px) {
            .stats {
                grid-template-columns:
                    repeat(2, 1fr);
            }

            .content-grid {
                grid-template-columns: 1fr;
            }

            .filter-grid {
                grid-template-columns:
                    1fr
                    1fr;
            }

            .edit-grid {
                grid-template-columns:
                    repeat(2, 1fr);
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

        @media(max-width:600px) {
            .stats,
            .filter-grid,
            .form-row,
            .edit-grid {
                grid-template-columns: 1fr;
            }

            .header {
                align-items: flex-start;
                flex-direction: column;
            }
        }
    </style>
    @include('admin.partials.navigation-styles')
</head>

<body>

@include('admin.partials.mobile-navigation')

<div class="layout">

    {{-- =========================================
         SIDEBAR
    ========================================== --}}

    @include('admin.partials.sidebar')


    {{-- =========================================
         MAIN
    ========================================== --}}

    <main class="main">

        <div class="header">

            <div>

                <h1>
                    Course Management
                </h1>

                <p>
                    Add and manage academic courses for every semester.
                </p>

            </div>

            <div class="course-count">
                {{ $courses->count() }}
                {{ $courses->count() === 1 ? 'COURSE' : 'COURSES' }}
            </div>

        </div>


        {{-- =====================================
             ALERTS
        ====================================== --}}

        @if(session('success'))

            <div class="alert alert-success">
                {{ session('success') }}
            </div>

        @endif


        @if(session('error'))

            <div class="alert alert-error">
                {{ session('error') }}
            </div>

        @endif


        @if($errors->any())

            <div class="alert alert-error">

                @foreach($errors->all() as $error)

                    <div>
                        {{ $error }}
                    </div>

                @endforeach

            </div>

        @endif


        {{-- =====================================
             STATS
        ====================================== --}}

        <div class="stats">

            <div class="stat-card">

                <div class="stat-label">
                    DISPLAYED COURSES
                </div>

                <div class="stat-value">
                    {{ $courses->count() }}
                </div>

            </div>


            <div class="stat-card">

                <div class="stat-label">
                    THEORY COURSES
                </div>

                <div class="stat-value">
                    {{ $courses->where('course_type', 'theory')->count() }}
                </div>

            </div>


            <div class="stat-card">

                <div class="stat-label">
                    LAB COURSES
                </div>

                <div class="stat-value">
                    {{ $courses->where('course_type', 'lab')->count() }}
                </div>

            </div>


            <div class="stat-card">

                <div class="stat-label">
                    ACTIVE COURSES
                </div>

                <div class="stat-value">
                    {{ $courses->where('is_active', true)->count() }}
                </div>

            </div>

        </div>


        <div class="content-grid">

            {{-- =====================================
                 ADD COURSE
            ====================================== --}}

            <section class="panel">

                <div class="panel-header">

                    <h2>
                        Add New Course
                    </h2>

                    <p>
                        Courses can be added manually and assigned
                        to the appropriate academic semester.
                    </p>

                </div>


                <form
                    method="POST"
                    action="{{ route('admin.courses.store') }}"
                >

                    @csrf


                    <div class="form-group">

                        <label>
                            Semester
                        </label>

                        <select
                            name="semester_id"
                            required
                        >

                            <option value="">
                                Select Semester
                            </option>

                            @foreach($semesters as $semester)

                                <option
                                    value="{{ $semester->id }}"
                                    {{ old('semester_id') == $semester->id ? 'selected' : '' }}
                                >
                                    {{ $semester->name }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    <div class="form-group">

                        <label>
                            Course Code
                        </label>

                        <input
                            type="text"
                            name="course_code"
                            value="{{ old('course_code') }}"
                            placeholder="Example: CSE-4201"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label>
                            Course Name
                        </label>

                        <input
                            type="text"
                            name="course_name"
                            value="{{ old('course_name') }}"
                            placeholder="Example: Software Development II"
                            required
                        >

                    </div>


                    <div class="form-row">

                        <div class="form-group">

                            <label>
                                Credit
                            </label>

                            <input
                                type="number"
                                name="credit"
                                value="{{ old('credit', '3.0') }}"
                                min="0.5"
                                max="10"
                                step="0.5"
                                required
                            >

                        </div>


                        <div class="form-group">

                            <label>
                                Course Type
                            </label>

                            <select
                                name="course_type"
                                required
                            >

                                <option
                                    value="theory"
                                    {{ old('course_type') === 'theory' ? 'selected' : '' }}
                                >
                                    Theory
                                </option>

                                <option
                                    value="lab"
                                    {{ old('course_type') === 'lab' ? 'selected' : '' }}
                                >
                                    Lab
                                </option>

                            </select>

                        </div>

                    </div>


                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Add Course
                    </button>

                </form>

            </section>


            {{-- =====================================
                 COURSE LIST
            ====================================== --}}

            <section class="panel">

                <div class="panel-header">

                    <h2>
                        Academic Courses
                    </h2>

                    <p>
                        Search, filter, edit or remove existing courses.
                    </p>

                </div>


                {{-- FILTER --}}

                <div class="filter-box">

                    <form
                        method="GET"
                        action="{{ route('admin.courses.index') }}"
                    >

                        <div class="filter-grid">

                            <div class="form-group">

                                <label>
                                    Search
                                </label>

                                <input
                                    type="text"
                                    name="search"
                                    value="{{ request('search') }}"
                                    placeholder="Code or course name..."
                                >

                            </div>


                            <div class="form-group">

                                <label>
                                    Semester
                                </label>

                                <select name="semester_id">

                                    <option value="">
                                        All Semesters
                                    </option>

                                    @foreach($semesters as $semester)

                                        <option
                                            value="{{ $semester->id }}"
                                            {{ request('semester_id') == $semester->id ? 'selected' : '' }}
                                        >
                                            {{ $semester->name }}
                                        </option>

                                    @endforeach

                                </select>

                            </div>


                            <div class="form-group">

                                <label>
                                    Type
                                </label>

                                <select name="course_type">

                                    <option value="">
                                        All Types
                                    </option>

                                    <option
                                        value="theory"
                                        {{ request('course_type') === 'theory' ? 'selected' : '' }}
                                    >
                                        Theory
                                    </option>

                                    <option
                                        value="lab"
                                        {{ request('course_type') === 'lab' ? 'selected' : '' }}
                                    >
                                        Lab
                                    </option>

                                </select>

                            </div>


                            <div class="filter-actions">

                                <button
                                    type="submit"
                                    class="btn btn-filter"
                                >
                                    Filter
                                </button>

                                <a
                                    href="{{ route('admin.courses.index') }}"
                                    class="btn btn-reset"
                                >
                                    Reset
                                </a>

                            </div>

                        </div>

                    </form>

                </div>


                {{-- TABLE --}}

                <div class="table-wrapper">

                    <table>

                        <thead>

                        <tr>

                            <th>
                                CODE
                            </th>

                            <th>
                                COURSE
                            </th>

                            <th>
                                SEMESTER
                            </th>

                            <th>
                                CREDIT
                            </th>

                            <th>
                                TYPE
                            </th>

                            <th>
                                STATUS
                            </th>

                            <th>
                                ACTION
                            </th>

                        </tr>

                        </thead>


                        <tbody>

                        @forelse($courses as $course)

                            <tr>

                                <td>

                                    <span class="course-code">
                                        {{ $course->course_code }}
                                    </span>

                                </td>


                                <td>

                                    <span class="course-name">
                                        {{ $course->course_name }}
                                    </span>

                                </td>


                                <td>

    <div style="
        display: flex;
        flex-wrap: wrap;
        gap: 5px;
    ">

        @forelse($course->semesters as $semester)

            <span style="
                display: inline-block;
                padding: 5px 8px;
                border-radius: 20px;
                background: rgba(59,130,246,.10);
                color: #93c5fd;
                font-size: 9px;
                font-weight: 800;
                white-space: nowrap;
            ">
                {{ $semester->name }}
            </span>

        @empty

            <span class="semester-text">
                {{ optional($course->semester)->name ?? 'Not Assigned' }}
            </span>

        @endforelse

    </div>

</td>


                                <td>
                                    {{ $course->credit }}
                                </td>


                                <td>

                                    @if($course->course_type === 'lab')

                                        <span class="badge badge-lab">
                                            LAB
                                        </span>

                                    @else

                                        <span class="badge badge-theory">
                                            THEORY
                                        </span>

                                    @endif

                                </td>


                                <td>

                                    @if($course->is_active)

                                        <span class="badge badge-active">
                                            ACTIVE
                                        </span>

                                    @else

                                        <span class="badge badge-inactive">
                                            INACTIVE
                                        </span>

                                    @endif

                                </td>


                                <td>

                                    <div class="actions">

                                        <button
                                            type="button"
                                            class="btn btn-edit"
                                            onclick="toggleCourseEdit({{ $course->id }})"
                                        >
                                            Edit
                                        </button>


                                        <form
                                            method="POST"
                                            action="{{ route('admin.courses.destroy', $course) }}"
                                            onsubmit="return confirm('Are you sure you want to delete this course?')"
                                        >

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn btn-delete"
                                            >
                                                Delete
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>


                            {{-- =================================
                                 EDIT ROW
                            ================================== --}}

                            <tr
                                id="course-edit-{{ $course->id }}"
                                class="edit-row"
                            >

                                <td colspan="7">

                                    <div class="edit-container">

                                        <h3>
                                            Edit Course —
                                            {{ $course->course_code }}
                                        </h3>


                                        <form
                                            method="POST"
                                            action="{{ route('admin.courses.update', $course) }}"
                                        >

                                            @csrf
                                            @method('PUT')


                                            <div class="edit-grid">

                                                <div class="form-group">

    <label>
        Offered Semesters
    </label>

    @php
        $selectedSemesterIds = $course->semesters
            ->pluck('id')
            ->map(fn ($id) => (string) $id)
            ->toArray();
    @endphp

    <select
        name="semester_ids[]"
        multiple
        required
        size="6"
    >

        @foreach($semesters as $semester)

            <option
                value="{{ $semester->id }}"
                {{
                    in_array(
                        (string) $semester->id,
                        $selectedSemesterIds,
                        true
                    ) ? 'selected' : ''
                }}
            >
                {{ $semester->name }}
            </option>

        @endforeach

    </select>

    <div style="
        margin-top: 7px;
        color: #64748b;
        font-size: 10px;
        line-height: 1.5;
    ">
        Hold Ctrl and click to select multiple semesters.
    </div>

</div>


                                                <div class="form-group">

                                                    <label>
                                                        Course Code
                                                    </label>

                                                    <input
                                                        type="text"
                                                        name="course_code"
                                                        value="{{ $course->course_code }}"
                                                        required
                                                    >

                                                </div>


                                                <div class="form-group">

                                                    <label>
                                                        Course Name
                                                    </label>

                                                    <input
                                                        type="text"
                                                        name="course_name"
                                                        value="{{ $course->course_name }}"
                                                        required
                                                    >

                                                </div>


                                                <div class="form-group">

                                                    <label>
                                                        Credit
                                                    </label>

                                                    <input
                                                        type="number"
                                                        name="credit"
                                                        value="{{ $course->credit }}"
                                                        min="0.5"
                                                        max="10"
                                                        step="0.5"
                                                        required
                                                    >

                                                </div>


                                                <div class="form-group">

                                                    <label>
                                                        Course Type
                                                    </label>

                                                    <select
                                                        name="course_type"
                                                        required
                                                    >

                                                        <option
                                                            value="theory"
                                                            {{ $course->course_type === 'theory' ? 'selected' : '' }}
                                                        >
                                                            Theory
                                                        </option>

                                                        <option
                                                            value="lab"
                                                            {{ $course->course_type === 'lab' ? 'selected' : '' }}
                                                        >
                                                            Lab
                                                        </option>

                                                    </select>

                                                </div>

                                            </div>


                                            <div class="checkbox-row">

                                                <input
                                                    type="checkbox"
                                                    id="active-{{ $course->id }}"
                                                    name="is_active"
                                                    value="1"
                                                    {{ $course->is_active ? 'checked' : '' }}
                                                >

                                                <label
                                                    for="active-{{ $course->id }}"
                                                >
                                                    Active Course
                                                </label>

                                            </div>


                                            <button
                                                type="submit"
                                                class="btn btn-save"
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
                                    No courses found.
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

    function toggleCourseEdit(id) {

        const row =
            document.getElementById(
                'course-edit-' + id
            );

        if (!row) {
            return;
        }

        if (
            row.style.display === 'table-row'
        ) {

            row.style.display = 'none';

        } else {

            row.style.display = 'table-row';

        }
    }

</script>

</body>
</html>