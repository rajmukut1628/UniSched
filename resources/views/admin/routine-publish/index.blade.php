<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Routine Publishing | UniSched</title>

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
                    circle at 88% 3%,
                    rgba(37,99,235,.15),
                    transparent 27%
                ),
                radial-gradient(
                    circle at 4% 94%,
                    rgba(124,58,237,.10),
                    transparent 26%
                ),
                #070b16;
        }

        .layout {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            position: fixed;

            top: 0;
            left: 0;

            width: 270px;
            height: 100vh;

            padding: 28px 20px;

            overflow-y: auto;

            background: rgba(11,17,32,.98);

            border-right:
                1px solid rgba(255,255,255,.07);
        }

        .brand {
            display: flex;

            align-items: center;

            gap: 12px;

            padding: 0 8px;

            margin-bottom: 35px;
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
            margin:
                25px
                10px
                10px;

            color: #475569;

            font-size: 10px;
            font-weight: 800;

            letter-spacing: 1.5px;
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

            align-items: center;
            justify-content: space-between;

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

        .live-badge {
            padding: 9px 14px;

            border-radius: 20px;

            color: #86efac;

            background:
                rgba(34,197,94,.07);

            border:
                1px solid rgba(34,197,94,.13);

            font-size: 10px;
            font-weight: 800;
        }

        .alert {
            padding: 14px 17px;

            margin-bottom: 18px;

            border-radius: 11px;

            font-size: 12px;
        }

        .success {
            color: #86efac;

            background:
                rgba(34,197,94,.07);

            border:
                1px solid rgba(34,197,94,.14);
        }

        .error {
            color: #fca5a5;

            background:
                rgba(239,68,68,.07);

            border:
                1px solid rgba(239,68,68,.14);
        }

        .stats {
            display: grid;

            grid-template-columns:
                repeat(4,1fr);

            gap: 12px;

            margin-bottom: 20px;
        }

        .stat {
            padding: 18px;

            border-radius: 14px;

            background:
                rgba(15,23,42,.74);

            border:
                1px solid rgba(255,255,255,.055);
        }

        .stat-number {
            font-size: 27px;
            font-weight: 900;
        }

        .stat-label {
            margin-top: 5px;

            color: #64748b;

            font-size: 9px;
            font-weight: 800;

            letter-spacing: .8px;
        }

        .panel {
            padding: 20px;

            margin-bottom: 20px;

            border-radius: 17px;

            background:
                rgba(15,23,42,.77);

            border:
                1px solid rgba(255,255,255,.06);
        }

        .panel-header {
            display: flex;

            align-items: center;
            justify-content: space-between;

            gap: 15px;

            margin-bottom: 18px;
        }

        .panel-header h2 {
            margin: 0;

            font-size: 17px;
        }

        .panel-header p {
            margin: 5px 0 0;

            color: #64748b;

            font-size: 10px;
        }

        .filter-grid {
            display: grid;

            grid-template-columns:
                repeat(5,1fr)
                auto;

            gap: 9px;

            align-items: end;
        }

        .form-group label {
            display: block;

            margin-bottom: 7px;

            color: #64748b;

            font-size: 9px;
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

        .btn {
            display: inline-flex;

            align-items: center;
            justify-content: center;

            padding: 10px 13px;

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
                rgba(100,116,139,.11);
        }

        .publish {
            color: #86efac;

            background:
                rgba(34,197,94,.09);
        }

        .draft-btn {
            color: #fde68a;

            background:
                rgba(245,158,11,.09);
        }

        .bulk-bar {
            display: flex;

            flex-wrap: wrap;

            align-items: center;

            justify-content: space-between;

            gap: 12px;

            padding: 14px;

            margin-bottom: 16px;

            border-radius: 12px;

            background:
                rgba(2,6,23,.40);

            border:
                1px solid rgba(255,255,255,.05);
        }

        .bulk-left,
        .bulk-right {
            display: flex;

            flex-wrap: wrap;

            gap: 7px;

            align-items: center;
        }

        .selected-count {
            color: #93c5fd;

            font-size: 10px;
            font-weight: 800;
        }

        .table-wrapper {
            width: 100%;

            overflow-x: auto;
        }

        table {
            width: 100%;

            min-width: 1100px;

            border-collapse: collapse;
        }

        th {
            padding: 12px 9px;

            color: #64748b;

            text-align: left;

            font-size: 9px;
            font-weight: 800;

            border-bottom:
                1px solid rgba(255,255,255,.07);
        }

        td {
            padding: 14px 9px;

            color: #cbd5e1;

            font-size: 11px;

            border-bottom:
                1px solid rgba(255,255,255,.045);
        }

        tbody tr:hover {
            background:
                rgba(59,130,246,.025);
        }

        .checkbox {
            width: 16px;
            height: 16px;

            accent-color: #2563eb;
        }

        .course {
            color: #93c5fd;

            font-weight: 900;
        }

        .course-name {
            margin-top: 3px;

            color: #64748b;

            font-size: 9px;
        }

        .badge {
            display: inline-block;

            padding: 5px 8px;

            border-radius: 20px;

            font-size: 8px;
            font-weight: 800;
        }

        .semester {
            color: #c4b5fd;

            background:
                rgba(139,92,246,.10);
        }

        .section {
            color: #93c5fd;

            background:
                rgba(59,130,246,.10);
        }

        .room {
            color: #67e8f9;

            background:
                rgba(6,182,212,.09);
        }

        .published {
            color: #86efac;

            background:
                rgba(34,197,94,.09);
        }

        .draft {
            color: #fde68a;

            background:
                rgba(245,158,11,.09);
        }

        .action-group {
            display: flex;

            gap: 6px;
        }

        .empty {
            padding: 45px;

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
                    repeat(2,1fr);
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

            .header {
                flex-direction: column;

                align-items: flex-start;
            }

            .filter-grid {
                grid-template-columns:
                    repeat(2,1fr);
            }
        }

        @media(max-width:550px) {

            .stats,
            .filter-grid {
                grid-template-columns: 1fr;
            }
        }

    </style>

</head>

<body>

<div class="layout">

    <aside class="sidebar">

        <div class="brand">

            <div class="brand-icon">
                US
            </div>

            <div>

                <div class="brand-name">
                    Uni<span>Sched</span>
                </div>

                <div class="brand-subtitle">
                    Academic Scheduling System
                </div>

            </div>

        </div>


        <div class="nav-title">
            OVERVIEW
        </div>

        <a
            href="{{ route('admin.dashboard') }}"
            class="nav-item"
        >
            <span class="nav-icon">◈</span>
            Dashboard
        </a>


        <div class="nav-title">
            ACADEMIC
        </div>

        <a
            href="{{ route('admin.semesters.index') }}"
            class="nav-item"
        >
            <span class="nav-icon">S</span>
            Semesters
        </a>

        <a
            href="{{ route('admin.sections.index') }}"
            class="nav-item"
        >
            <span class="nav-icon">§</span>
            Sections
        </a>

        <a
            href="{{ route('admin.courses.index') }}"
            class="nav-item"
        >
            <span class="nav-icon">C</span>
            Courses
        </a>

        <a
            href="{{ route('admin.teachers.index') }}"
            class="nav-item"
        >
            <span class="nav-icon">F</span>
            Faculty
        </a>

        <a
            href="{{ route('admin.teacher-availability.index') }}"
            class="nav-item"
        >
            <span class="nav-icon">A</span>
            Faculty Availability
        </a>


        <div class="nav-title">
            SCHEDULING
        </div>

        <a
            href="{{ route('admin.time-slots.index') }}"
            class="nav-item"
        >
            <span class="nav-icon">T</span>
            Time Slots
        </a>

        <a
            href="{{ route('admin.rooms.index') }}"
            class="nav-item"
        >
            <span class="nav-icon">R</span>
            Rooms & Labs
        </a>

        <a
            href="{{ route('admin.course-assignments.index') }}"
            class="nav-item"
        >
            <span class="nav-icon">↔</span>
            Course Assignments
        </a>

        <a
            href="{{ route('admin.routines.index') }}"
            class="nav-item"
        >
            <span class="nav-icon">+</span>
            Routine Builder
        </a>

        <a
            href="{{ route('admin.routine-views.index') }}"
            class="nav-item"
        >
            <span class="nav-icon">▦</span>
            Routine Views
        </a>

        <a
            href="{{ route('admin.routine-publish.index') }}"
            class="nav-item active"
        >
            <span class="nav-icon">✓</span>
            Publish Routine
        </a>


        <div class="nav-title">
            SYSTEM
        </div>

        <a
            href="{{ route('admin.admins.index') }}"
            class="nav-item"
        >
            <span class="nav-icon">⚙</span>
            Admin Management
        </a>

    </aside>


    <main class="main">

        <div class="header">

            <div>

                <h1>
                    Routine Publishing
                </h1>

                <p>
                    Review draft schedules and control which routine classes are officially published.
                </p>

            </div>

            <div class="live-badge">
                PUBLICATION CONTROL ACTIVE
            </div>

        </div>


        @if(session('success'))

            <div class="alert success">
                {{ session('success') }}
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

                <div class="stat-number">
                    {{ $stats['total'] }}
                </div>

                <div class="stat-label">
                    FILTERED CLASSES
                </div>

            </div>


            <div class="stat">

                <div class="stat-number">
                    {{ $stats['draft'] }}
                </div>

                <div class="stat-label">
                    DRAFT
                </div>

            </div>


            <div class="stat">

                <div class="stat-number">
                    {{ $stats['published'] }}
                </div>

                <div class="stat-label">
                    PUBLISHED
                </div>

            </div>


            <div class="stat">

                <div class="stat-number">
                    {{ $stats['sections'] }}
                </div>

                <div class="stat-label">
                    SECTIONS
                </div>

            </div>

        </div>


        <section class="panel">

            <div class="panel-header">

                <div>

                    <h2>
                        Publication Filter
                    </h2>

                    <p>
                        Filter a semester, section, faculty, room or publication status.
                    </p>

                </div>

            </div>


            <form
                method="GET"
                action="{{ route('admin.routine-publish.index') }}"
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
                            ROOM
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
                                value="draft"
                                {{ request('status') === 'draft' ? 'selected' : '' }}
                            >
                                Draft
                            </option>

                            <option
                                value="published"
                                {{ request('status') === 'published' ? 'selected' : '' }}
                            >
                                Published
                            </option>

                        </select>

                    </div>


                    <div class="action-group">

                        <button
                            type="submit"
                            class="btn primary"
                        >
                            Apply
                        </button>

                        <a
                            href="{{ route('admin.routine-publish.index') }}"
                            class="btn reset"
                        >
                            Reset
                        </a>

                    </div>

                </div>

            </form>

        </section>


        <section class="panel">

            <div class="panel-header">

                <div>

                    <h2>
                        Routine Publication List
                    </h2>

                    <p>
                        Select individual classes or publish the entire filtered schedule.
                    </p>

                </div>

            </div>


            <div class="bulk-bar">

                <div class="bulk-left">

                    <button
                        type="button"
                        class="btn reset"
                        onclick="selectAllRows()"
                    >
                        Select All
                    </button>

                    <button
                        type="button"
                        class="btn reset"
                        onclick="clearAllRows()"
                    >
                        Clear
                    </button>

                    <span
                        id="selectedCount"
                        class="selected-count"
                    >
                        0 selected
                    </span>

                </div>


                <div class="bulk-right">

                    <button
                        type="button"
                        class="btn publish"
                        onclick="submitBulk(
                            '{{ route('admin.routine-publish.bulk') }}'
                        )"
                    >
                        Publish Selected
                    </button>


                    <button
                        type="button"
                        class="btn draft-btn"
                        onclick="submitBulk(
                            '{{ route('admin.routine-draft.bulk') }}'
                        )"
                    >
                        Move Selected to Draft
                    </button>


                    <form
                        method="POST"
                        action="{{ route('admin.routine-publish.filtered') }}"
                        onsubmit="return confirm('Publish every draft class currently matched by this filter?')"
                    >

                        @csrf

                        <input
                            type="hidden"
                            name="semester_id"
                            value="{{ request('semester_id') }}"
                        >

                        <input
                            type="hidden"
                            name="section_id"
                            value="{{ request('section_id') }}"
                        >

                        <input
                            type="hidden"
                            name="teacher_id"
                            value="{{ request('teacher_id') }}"
                        >

                        <input
                            type="hidden"
                            name="room_id"
                            value="{{ request('room_id') }}"
                        >

                        <button
                            type="submit"
                            class="btn publish"
                        >
                            Publish Filtered
                        </button>

                    </form>


                    <form
                        method="POST"
                        action="{{ route('admin.routine-draft.filtered') }}"
                        onsubmit="return confirm('Move every published class currently matched by this filter back to draft?')"
                    >

                        @csrf

                        <input
                            type="hidden"
                            name="semester_id"
                            value="{{ request('semester_id') }}"
                        >

                        <input
                            type="hidden"
                            name="section_id"
                            value="{{ request('section_id') }}"
                        >

                        <input
                            type="hidden"
                            name="teacher_id"
                            value="{{ request('teacher_id') }}"
                        >

                        <input
                            type="hidden"
                            name="room_id"
                            value="{{ request('room_id') }}"
                        >

                        <button
                            type="submit"
                            class="btn draft-btn"
                        >
                            Draft Filtered
                        </button>

                    </form>

                </div>

            </div>


            <form
                id="bulkForm"
                method="POST"
                action=""
            >

                @csrf


                <div class="table-wrapper">

                    <table>

                        <thead>

                        <tr>

                            <th>
                                SELECT
                            </th>

                            <th>
                                SEMESTER
                            </th>

                            <th>
                                SECTION
                            </th>

                            <th>
                                COURSE
                            </th>

                            <th>
                                FACULTY
                            </th>

                            <th>
                                DAY
                            </th>

                            <th>
                                TIME
                            </th>

                            <th>
                                ROOM
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

                        @forelse($routines as $routine)

                            <tr>

                                <td>

                                    <input
                                        type="checkbox"
                                        class="checkbox routine-checkbox"
                                        name="routine_ids[]"
                                        value="{{ $routine->id }}"
                                        onchange="updateSelectedCount()"
                                    >

                                </td>


                                <td>

                                    <span class="badge semester">

                                        {{ $routine->section->semester->name }}

                                    </span>

                                </td>


                                <td>

                                    <span class="badge section">

                                        {{ $routine->section->code }}

                                    </span>

                                </td>


                                <td>

                                    <div class="course">

                                        {{ $routine->courseAssignment->course->course_code }}

                                    </div>

                                    <div class="course-name">

                                        {{ $routine->courseAssignment->course->course_name }}

                                    </div>

                                </td>


                                <td>

                                    {{ $routine->teacher->name }}

                                    <div class="course-name">

                                        {{ $routine->teacher->initial }}

                                    </div>

                                </td>


                                <td>
                                    {{ $routine->day }}
                                </td>


                                <td>

                                    {{ \Carbon\Carbon::parse(
                                        $routine->timeSlot->start_time
                                    )->format('g:i A') }}

                                    -

                                    {{ \Carbon\Carbon::parse(
                                        $routine->timeSlot->end_time
                                    )->format('g:i A') }}

                                </td>


                                <td>

                                    <span class="badge room">

                                        {{ $routine->room->room_number }}

                                    </span>

                                </td>


                                <td>

                                    @if($routine->status === 'published')

                                        <span class="badge published">
                                            PUBLISHED
                                        </span>

                                    @else

                                        <span class="badge draft">
                                            DRAFT
                                        </span>

                                    @endif

                                </td>


                                <td>

                                    @if($routine->status === 'draft')

                                        <button
                                            type="button"
                                            class="btn publish"
                                            onclick="submitSingle(
                                                '{{ route('admin.routines.publish', $routine) }}',
                                                'Publish this routine class?'
                                            )"
                                        >
                                            Publish
                                        </button>

                                    @else

                                        <button
                                            type="button"
                                            class="btn draft-btn"
                                            onclick="submitSingle(
                                                '{{ route('admin.routines.draft', $routine) }}',
                                                'Move this routine class back to draft?'
                                            )"
                                        >
                                            Draft
                                        </button>

                                    @endif

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="10"
                                    class="empty"
                                >
                                    No routine classes found for the selected filters.
                                </td>

                            </tr>

                        @endforelse

                        </tbody>

                    </table>

                </div>

            </form>

        </section>

    </main>

</div>


<form
    id="singleActionForm"
    method="POST"
    style="display:none;"
>
    @csrf
</form>


<script>

    function semesterChanged() {

        const semester =
            document.querySelector(
                'select[name="semester_id"]'
            );

        const section =
            document.querySelector(
                'select[name="section_id"]'
            );

        if (section) {
            section.value = '';
        }

        semester.form.submit();
    }


    function getCheckboxes() {

        return Array.from(
            document.querySelectorAll(
                '.routine-checkbox'
            )
        );
    }


    function updateSelectedCount() {

        const count =
            getCheckboxes()
                .filter(
                    checkbox =>
                        checkbox.checked
                )
                .length;

        document.getElementById(
            'selectedCount'
        ).textContent =
            count + ' selected';
    }


    function selectAllRows() {

        getCheckboxes().forEach(
            checkbox => {
                checkbox.checked = true;
            }
        );

        updateSelectedCount();
    }


    function clearAllRows() {

        getCheckboxes().forEach(
            checkbox => {
                checkbox.checked = false;
            }
        );

        updateSelectedCount();
    }


    function submitBulk(action) {

        const selected =
            getCheckboxes()
                .filter(
                    checkbox =>
                        checkbox.checked
                );

        if (selected.length === 0) {

            alert(
                'Please select at least one routine class.'
            );

            return;
        }

        if (
            !confirm(
                'Apply this action to '
                + selected.length
                + ' selected class(es)?'
            )
        ) {
            return;
        }

        const form =
            document.getElementById(
                'bulkForm'
            );

        form.action = action;

        form.submit();
    }


    function submitSingle(
        action,
        message
    ) {

        if (!confirm(message)) {
            return;
        }

        const form =
            document.getElementById(
                'singleActionForm'
            );

        form.action = action;

        form.submit();
    }

</script>

</body>

</html>