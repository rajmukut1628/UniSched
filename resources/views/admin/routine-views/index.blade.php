<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Routine Views | UniSched</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;

            font-family: Inter, Arial, sans-serif;

            color: #f8fafc;

            background:
                radial-gradient(
                    circle at 90% 4%,
                    rgba(37,99,235,.14),
                    transparent 28%
                ),
                radial-gradient(
                    circle at 5% 95%,
                    rgba(124,58,237,.09),
                    transparent 27%
                ),
                #070b16;
        }

        .layout {
            min-height: 100vh;
            display: flex;
        }

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

            justify-content: space-between;
            align-items: center;

            gap: 20px;

            margin-bottom: 24px;
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
            padding: 9px 14px;

            border-radius: 20px;

            color: #93c5fd;

            background:
                rgba(59,130,246,.07);

            border:
                1px solid rgba(59,130,246,.13);

            font-size: 10px;
            font-weight: 800;
        }

        .view-tabs {
            display: flex;

            gap: 8px;

            margin-bottom: 18px;

            overflow-x: auto;
        }

        .view-tab {
            white-space: nowrap;

            padding: 10px 15px;

            border-radius: 10px;

            color: #94a3b8;

            background:
                rgba(15,23,42,.65);

            border:
                1px solid rgba(255,255,255,.055);

            text-decoration: none;

            font-size: 11px;
            font-weight: 700;
        }

        .view-tab:hover {
            color: #dbeafe;

            border-color:
                rgba(59,130,246,.18);
        }

        .view-tab.active {
            color: white;

            background:
                linear-gradient(
                    135deg,
                    rgba(37,99,235,.85),
                    rgba(124,58,237,.75)
                );

            border-color: transparent;
        }

        .panel {
            padding: 20px;

            margin-bottom: 20px;

            border-radius: 17px;

            background:
                rgba(15,23,42,.76);

            border:
                1px solid rgba(255,255,255,.06);
        }

        .filter-grid {
            display: grid;

            grid-template-columns:
                repeat(5,1fr)
                auto;

            gap: 10px;

            align-items: end;
        }

        .form-group label {
            display: block;

            margin-bottom: 7px;

            color: #64748b;

            font-size: 10px;
            font-weight: 800;
        }

        select {
            width: 100%;

            padding: 11px;

            border-radius: 9px;

            border:
                1px solid rgba(255,255,255,.08);

            color: #e2e8f0;

            background: #090f1d;

            outline: none;
        }

        select option {
            background: #0f172a;
        }

        .actions {
            display: flex;
            gap: 7px;
        }

        .btn {
            display: inline-flex;

            align-items: center;
            justify-content: center;

            padding: 11px 14px;

            border: 0;

            border-radius: 9px;

            cursor: pointer;

            text-decoration: none;

            font-size: 10px;
            font-weight: 800;
        }

        .primary {
            color: white;

            background:
                linear-gradient(
                    135deg,
                    #2563eb,
                    #7c3aed
                );
        }

        .reset {
            color: #94a3b8;

            background:
                rgba(100,116,139,.10);
        }

        .stats {
            display: grid;

            grid-template-columns:
                repeat(6,1fr);

            gap: 10px;

            margin-bottom: 20px;
        }

        .stat {
            padding: 16px;

            border-radius: 13px;

            background:
                rgba(15,23,42,.72);

            border:
                1px solid rgba(255,255,255,.055);
        }

        .stat-value {
            font-size: 23px;
            font-weight: 900;
        }

        .stat-label {
            margin-top: 5px;

            color: #64748b;

            font-size: 9px;
            font-weight: 800;

            text-transform: uppercase;

            letter-spacing: .8px;
        }

        .routine-header {
            display: flex;

            justify-content: space-between;
            align-items: center;

            gap: 15px;

            margin-bottom: 17px;
        }

        .routine-header h2 {
            margin: 0;

            font-size: 17px;
        }

        .routine-header p {
            margin: 5px 0 0;

            color: #64748b;

            font-size: 10px;
        }

        .count {
            color: #93c5fd;

            font-size: 10px;
            font-weight: 800;
        }

        .routine-wrapper {
            width: 100%;

            overflow-x: auto;

            border-radius: 12px;
        }

        table {
            width: 100%;

            min-width: 1150px;

            border-collapse: collapse;

            background:
                rgba(2,6,23,.25);
        }

        th {
            padding: 13px 10px;

            color: #94a3b8;

            background:
                rgba(15,23,42,.90);

            font-size: 9px;
            font-weight: 800;

            text-align: center;

            border:
                1px solid rgba(255,255,255,.055);
        }

        th.day-column {
            min-width: 105px;
        }

        td {
            min-width: 150px;

            padding: 8px;

            vertical-align: top;

            border:
                1px solid rgba(255,255,255,.045);
        }

        .day-cell {
            min-width: 105px;

            color: #c4b5fd;

            background:
                rgba(139,92,246,.045);

            font-size: 11px;
            font-weight: 800;

            text-align: center;
            vertical-align: middle;
        }

        .class-card {
            padding: 10px;

            margin-bottom: 7px;

            border-radius: 9px;

            background:
                linear-gradient(
                    135deg,
                    rgba(37,99,235,.08),
                    rgba(124,58,237,.055)
                );

            border:
                1px solid rgba(59,130,246,.10);
        }

        .class-card:last-child {
            margin-bottom: 0;
        }

        .course {
            color: #bfdbfe;

            font-size: 10px;
            font-weight: 900;
        }

        .course-name {
            margin-top: 3px;

            color: #64748b;

            font-size: 8px;

            line-height: 1.4;
        }

        .class-info {
            display: flex;

            flex-wrap: wrap;

            gap: 4px;

            margin-top: 7px;
        }

        .tag {
            padding: 4px 6px;

            border-radius: 12px;

            font-size: 7px;
            font-weight: 800;
        }

        .section-tag {
            color: #93c5fd;

            background:
                rgba(59,130,246,.10);
        }

        .faculty-tag {
            color: #c4b5fd;

            background:
                rgba(139,92,246,.10);
        }

        .room-tag {
            color: #67e8f9;

            background:
                rgba(6,182,212,.09);
        }

        .published-tag {
            color: #86efac;

            background:
                rgba(34,197,94,.09);
        }

        .draft-tag {
            color: #fde68a;

            background:
                rgba(245,158,11,.09);
        }

        .empty-slot {
            display: flex;

            min-height: 65px;

            align-items: center;
            justify-content: center;

            color: #334155;

            font-size: 15px;
        }

        .no-routine {
            padding: 50px;

            text-align: center;

            color: #64748b;
        }

        @media(max-width:1250px) {

            .filter-grid {
                grid-template-columns:
                    repeat(3,1fr);
            }

            .stats {
                grid-template-columns:
                    repeat(3,1fr);
            }
        }

        @media(max-width:850px) {

            .sidebar {
                display: none;
            }

            .main {
                margin-left: 0;

                padding: 24px;
            }

            .filter-grid {
                grid-template-columns:
                    repeat(2,1fr);
            }

            .header {
                align-items: flex-start;

                flex-direction: column;
            }
        }

        @media(max-width:550px) {

            .filter-grid,
            .stats {
                grid-template-columns: 1fr;
            }
        }

        @media print {

            .sidebar,
            .view-tabs,
            .filter-panel,
            .header-badge {
                display: none !important;
            }

            body {
                background: white;
                color: black;
            }

            .main {
                margin: 0;
                padding: 10px;
            }

            .panel {
                background: white;

                border: 0;

                padding: 0;
            }

            table {
                background: white;
            }

            th,
            td {
                border: 1px solid #999;
                color: black;
            }

            .class-card {
                background: white;
                border: 1px solid #ccc;
            }

            .course,
            .course-name,
            .day-cell,
            .tag {
                color: black;
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
                    Routine Views
                </h1>

                <p>
                    Master, semester, section, faculty and room-wise academic schedules.
                </p>

            </div>

            <div class="header-badge">
                LIVE ROUTINE DATA
            </div>

        </div>


        <div class="view-tabs">

            <a
                href="{{ route('admin.routine-views.index', ['view' => 'master']) }}"
                class="view-tab {{ $viewType === 'master' ? 'active' : '' }}"
            >
                Master Routine
            </a>

            <a
                href="{{ route('admin.routine-views.index', ['view' => 'semester']) }}"
                class="view-tab {{ $viewType === 'semester' ? 'active' : '' }}"
            >
                Semester-wise
            </a>

            <a
                href="{{ route('admin.routine-views.index', ['view' => 'section']) }}"
                class="view-tab {{ $viewType === 'section' ? 'active' : '' }}"
            >
                Section-wise
            </a>

            <a
                href="{{ route('admin.routine-views.index', ['view' => 'faculty']) }}"
                class="view-tab {{ $viewType === 'faculty' ? 'active' : '' }}"
            >
                Faculty-wise
            </a>

            <a
                href="{{ route('admin.routine-views.index', ['view' => 'room']) }}"
                class="view-tab {{ $viewType === 'room' ? 'active' : '' }}"
            >
                Room-wise
            </a>

        </div>


        <section class="panel filter-panel">

            <form
                method="GET"
                action="{{ route('admin.routine-views.index') }}"
            >

                <input
                    type="hidden"
                    name="view"
                    value="{{ $viewType }}"
                >


                <div class="filter-grid">

                    <div class="form-group">

                        <label>
                            SEMESTER
                        </label>

                        <select
                            name="semester_id"
                            onchange="semesterChanged()"
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
                            SECTION
                        </label>

                        <select name="section_id">

                            <option value="">
                                All Sections
                            </option>

                            @foreach($sections as $section)

                                <option
                                    value="{{ $section->id }}"
                                    {{ (string) request('section_id') === (string) $section->id ? 'selected' : '' }}
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
                            FACULTY
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
                                    —
                                    {{ $teacher->name }}

                                </option>

                            @endforeach

                        </select>

                    </div>


                    <div class="form-group">

                        <label>
                            ROOM / LAB
                        </label>

                        <select name="room_id">

                            <option value="">
                                All Rooms
                            </option>

                            @foreach($rooms as $room)

                                <option
                                    value="{{ $room->id }}"
                                    {{ (string) request('room_id') === (string) $room->id ? 'selected' : '' }}
                                >

                                    {{ $room->room_number }}

                                </option>

                            @endforeach

                        </select>

                    </div>


                    <div class="form-group">

                        <label>
                            STATUS
                        </label>

                        <select name="status">

                            <option value="">
                                All Status
                            </option>

                            <option
                                value="published"
                                {{ request('status') === 'published' ? 'selected' : '' }}
                            >
                                Published
                            </option>

                            <option
                                value="draft"
                                {{ request('status') === 'draft' ? 'selected' : '' }}
                            >
                                Draft
                            </option>

                        </select>

                    </div>


                    <div class="actions">

                        <button
                            type="submit"
                            class="btn primary"
                        >
                            Apply
                        </button>

                        <a
                            href="{{ route('admin.routine-views.index', ['view' => $viewType]) }}"
                            class="btn reset"
                        >
                            Reset
                        </a>

                    </div>

                </div>

            </form>

        </section>


        <div class="stats">

            <div class="stat">

                <div class="stat-value">
                    {{ $stats['total'] }}
                </div>

                <div class="stat-label">
                    Classes
                </div>

            </div>


            <div class="stat">

                <div class="stat-value">
                    {{ $stats['published'] }}
                </div>

                <div class="stat-label">
                    Published
                </div>

            </div>


            <div class="stat">

                <div class="stat-value">
                    {{ $stats['draft'] }}
                </div>

                <div class="stat-label">
                    Draft
                </div>

            </div>


            <div class="stat">

                <div class="stat-value">
                    {{ $stats['sections'] }}
                </div>

                <div class="stat-label">
                    Sections
                </div>

            </div>


            <div class="stat">

                <div class="stat-value">
                    {{ $stats['faculty'] }}
                </div>

                <div class="stat-label">
                    Faculty
                </div>

            </div>


            <div class="stat">

                <div class="stat-value">
                    {{ $stats['rooms'] }}
                </div>

                <div class="stat-label">
                    Rooms
                </div>

            </div>

        </div>


        <section class="panel">

            <div class="routine-header">

                <div>

                    <h2>

                        @if($viewType === 'semester')

                            Semester Routine

                        @elseif($viewType === 'section')

                            Section Routine

                        @elseif($viewType === 'faculty')

                            Faculty Routine

                        @elseif($viewType === 'room')

                            Room Routine

                        @else

                            Master Routine

                        @endif

                    </h2>

                    <p>
                        Saturday to Thursday academic schedule
                    </p>

                </div>


                <div class="actions">

                    <span class="count">
                        {{ $routines->count() }} CLASS(ES)
                    </span>

                    <button
                        type="button"
                        class="btn reset"
                        onclick="window.print()"
                    >
                        Print
                    </button>

                </div>

            </div>


            @if($routines->count())

                <div class="routine-wrapper">

                    <table>

                        <thead>

                        <tr>

                            <th class="day-column">
                                DAY
                            </th>

                            @foreach($timeSlots as $slot)

                                <th>

                                    {{ \Carbon\Carbon::parse(
                                        $slot->start_time
                                    )->format('g:i A') }}

                                    <br>

                                    <span style="color:#475569">

                                        {{ \Carbon\Carbon::parse(
                                            $slot->end_time
                                        )->format('g:i A') }}

                                    </span>

                                </th>

                            @endforeach

                        </tr>

                        </thead>


                        <tbody>

                        @foreach($days as $day)

                            <tr>

                                <td class="day-cell">
                                    {{ $day }}
                                </td>


                                @foreach($timeSlots as $slot)

                                    <td>

                                        @php

                                            $cellRoutines =
                                                $routineMap[$day][$slot->id]
                                                ?? [];

                                        @endphp


                                        @forelse($cellRoutines as $routine)

                                            <div class="class-card">

                                                <div class="course">

                                                    {{ $routine->courseAssignment->course->course_code }}

                                                </div>


                                                <div class="course-name">

                                                    {{ $routine->courseAssignment->course->course_name }}

                                                </div>


                                                <div class="class-info">

                                                    <span class="tag section-tag">

                                                        Sem
                                                        {{ $routine->section->semester->number }}

                                                        /

                                                        {{ $routine->section->code }}

                                                    </span>


                                                    <span class="tag faculty-tag">

                                                        {{ $routine->teacher->initial }}

                                                    </span>


                                                    <span class="tag room-tag">

                                                        {{ $routine->room->room_number }}

                                                    </span>


                                                    @if($routine->status === 'published')

                                                        <span class="tag published-tag">
                                                            Published
                                                        </span>

                                                    @else

                                                        <span class="tag draft-tag">
                                                            Draft
                                                        </span>

                                                    @endif

                                                </div>

                                            </div>

                                        @empty

                                            <div class="empty-slot">
                                                —
                                            </div>

                                        @endforelse

                                    </td>

                                @endforeach

                            </tr>

                        @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div class="no-routine">

                    No routine classes found for the selected filters.

                </div>

            @endif

        </section>

    </main>

</div>


<script>

    function semesterChanged() {

        const form =
            document.querySelector(
                '.filter-panel form'
            );

        const sectionSelect =
            form.querySelector(
                'select[name="section_id"]'
            );

        sectionSelect.value = '';

        form.submit();
    }

</script>

</body>

</html>