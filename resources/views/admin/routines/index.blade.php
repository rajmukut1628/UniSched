<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Smart Routine Builder | UniSched</title>

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
                    circle at 88% 5%,
                    rgba(37,99,235,.15),
                    transparent 27%
                ),
                radial-gradient(
                    circle at 8% 94%,
                    rgba(124,58,237,.10),
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

        .coming {
            opacity: .45;
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

            margin-bottom: 25px;
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

        .engine-badge {
            padding: 10px 15px;

            border-radius: 22px;

            color: #86efac;

            background:
                rgba(34,197,94,.07);

            border:
                1px solid rgba(34,197,94,.14);

            font-size: 10px;
            font-weight: 800;
        }

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

        .smart-strip {
            display: grid;

            grid-template-columns:
                repeat(5,1fr);

            gap: 10px;

            margin-bottom: 22px;
        }

        .smart-card {
            padding: 14px;

            border-radius: 13px;

            background:
                rgba(15,23,42,.72);

            border:
                1px solid rgba(255,255,255,.055);
        }

        .smart-card strong {
            display: block;

            color: #cbd5e1;

            font-size: 10px;
        }

        .smart-card span {
            display: block;

            margin-top: 5px;

            color: #64748b;

            font-size: 9px;

            line-height: 1.45;
        }

        .content-grid {
            display: grid;

            grid-template-columns:
                400px
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

        select:focus {
            border-color: #3b82f6;

            box-shadow:
                0 0 0 3px rgba(59,130,246,.09);
        }

        select:disabled {
            opacity: .55;
            cursor: not-allowed;
        }

        select option {
            background: #0f172a;
        }

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

        .primary:disabled {
            opacity: .45;
            cursor: not-allowed;
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

        .assignment-preview {
            display: none;

            padding: 15px;

            margin-bottom: 16px;

            border-radius: 13px;

            background:
                rgba(59,130,246,.045);

            border:
                1px solid rgba(59,130,246,.10);
        }

        .preview-title {
            color: #93c5fd;

            font-size: 10px;
            font-weight: 800;
        }

        .preview-content {
            margin-top: 7px;

            color: #cbd5e1;

            font-size: 11px;

            line-height: 1.7;
        }

        .smart-message {
            display: none;

            padding: 11px 13px;

            margin-top: -5px;
            margin-bottom: 15px;

            border-radius: 10px;

            font-size: 10px;

            line-height: 1.5;
        }

        .smart-message.loading {
            display: block;

            color: #93c5fd;

            background:
                rgba(59,130,246,.06);

            border:
                1px solid rgba(59,130,246,.10);
        }

        .smart-message.good {
            display: block;

            color: #86efac;

            background:
                rgba(34,197,94,.06);

            border:
                1px solid rgba(34,197,94,.11);
        }

        .smart-message.bad {
            display: block;

            color: #fca5a5;

            background:
                rgba(239,68,68,.06);

            border:
                1px solid rgba(239,68,68,.11);
        }

        .flow {
            display: flex;

            align-items: center;
            justify-content: space-between;

            gap: 5px;

            margin-bottom: 20px;
        }

        .flow-item {
            flex: 1;

            padding: 8px 4px;

            text-align: center;

            border-radius: 8px;

            color: #64748b;

            background:
                rgba(2,6,23,.42);

            font-size: 8px;
            font-weight: 800;
        }

        .flow-arrow {
            color: #334155;
            font-size: 10px;
        }

        .filter-box {
            padding: 15px;

            margin-bottom: 17px;

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

            gap: 8px;

            align-items: end;
        }

        .filter-grid .form-group {
            margin: 0;
        }

        .filter-actions {
            display: flex;
            gap: 6px;
        }

        .table-wrapper {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;

            min-width: 1000px;

            border-collapse: collapse;
        }

        th {
            padding: 12px 9px;

            text-align: left;

            color: #64748b;

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
                rgba(59,130,246,.022);
        }

        .course-code {
            color: #93c5fd;
            font-weight: 800;
        }

        .course-name {
            margin-top: 3px;

            color: #64748b;

            font-size: 9px;
        }

        .faculty {
            color: #e2e8f0;
            font-weight: 700;
        }

        .faculty-initial {
            margin-top: 3px;

            color: #60a5fa;

            font-size: 9px;
            font-weight: 800;
        }

        .badge {
            display: inline-block;

            padding: 5px 8px;

            border-radius: 20px;

            font-size: 8px;
            font-weight: 800;
        }

        .day-badge {
            color: #c4b5fd;

            background:
                rgba(139,92,246,.10);
        }

        .section-badge {
            color: #93c5fd;

            background:
                rgba(59,130,246,.09);
        }

        .room-badge {
            color: #67e8f9;

            background:
                rgba(6,182,212,.09);
        }

        .draft {
            color: #fde68a;

            background:
                rgba(245,158,11,.09);
        }

        .published {
            color: #86efac;

            background:
                rgba(34,197,94,.09);
        }

        .actions {
            display: flex;
            gap: 6px;
        }

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
                2fr
                1fr
                1fr
                1fr
                1fr;

            gap: 10px;
        }

        .empty {
            padding: 45px 15px;

            text-align: center;

            color: #64748b;
        }

        @media(max-width:1250px) {

            .smart-strip {
                grid-template-columns:
                    repeat(3,1fr);
            }

            .content-grid {
                grid-template-columns: 1fr;
            }

            .filter-grid {
                grid-template-columns:
                    repeat(2,1fr);
            }

            .edit-grid {
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

        @media(max-width:600px) {

            .smart-strip,
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
                    Smart Routine Builder
                </h1>

                <p>
                    UniSched automatically finds conflict-free time slots and available rooms.
                </p>

            </div>

            <div class="engine-badge">
                SMART SCHEDULING ENGINE ACTIVE
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


        <div class="smart-strip">

            <div class="smart-card">

                <strong>
                    Faculty Availability
                </strong>

                <span>
                    Only faculty-approved time slots are suggested.
                </span>

            </div>


            <div class="smart-card">

                <strong>
                    Faculty Conflict
                </strong>

                <span>
                    Busy faculty time slots are automatically removed.
                </span>

            </div>


            <div class="smart-card">

                <strong>
                    Section Conflict
                </strong>

                <span>
                    Existing section classes are excluded automatically.
                </span>

            </div>


            <div class="smart-card">

                <strong>
                    Room Conflict
                </strong>

                <span>
                    Occupied rooms disappear from the available-room list.
                </span>

            </div>


            <div class="smart-card">

                <strong>
                    Smart Room Priority
                </strong>

                <span>
                    Lab courses prioritize labs and theory courses prioritize classrooms.
                </span>

            </div>

        </div>


        <div class="content-grid">

            <section class="panel">

                <div class="panel-header">

                    <h2>
                        Smart Class Placement
                    </h2>

                    <p>
                        Follow the scheduling flow. Each next option is generated from live routine data.
                    </p>

                </div>


                <div class="flow">

                    <div class="flow-item">
                        ASSIGNMENT
                    </div>

                    <div class="flow-arrow">
                        →
                    </div>

                    <div class="flow-item">
                        DAY
                    </div>

                    <div class="flow-arrow">
                        →
                    </div>

                    <div class="flow-item">
                        FREE TIME
                    </div>

                    <div class="flow-arrow">
                        →
                    </div>

                    <div class="flow-item">
                        FREE ROOM
                    </div>

                </div>


                <form
                    method="POST"
                    action="{{ route('admin.routines.store') }}"
                >

                    @csrf


                    <div class="form-group">

                        <label>
                            Course Assignment
                        </label>

                        <select
                            id="course_assignment_id"
                            name="course_assignment_id"
                            required
                        >

                            <option value="">
                                Select Assignment
                            </option>

                            @foreach($assignments as $assignment)

                                <option
                                    value="{{ $assignment->id }}"

                                    data-semester="{{ $assignment->section->semester->name }}"

                                    data-section="{{ $assignment->section->code }}"

                                    data-course="{{ $assignment->course->course_code }} — {{ $assignment->course->course_name }}"

                                    data-faculty="{{ $assignment->teacher->initial }} — {{ $assignment->teacher->name }}"

                                    data-type="{{ strtoupper($assignment->course->course_type) }}"

                                    {{ (string) old('course_assignment_id') === (string) $assignment->id ? 'selected' : '' }}
                                >

                                    {{ $assignment->section->semester->name }}

                                    |

                                    {{ $assignment->section->code }}

                                    |

                                    {{ $assignment->course->course_code }}

                                    |

                                    {{ $assignment->teacher->initial }}

                                </option>

                            @endforeach

                        </select>

                    </div>


                    <div
                        id="assignmentPreview"
                        class="assignment-preview"
                    >

                        <div class="preview-title">
                            SELECTED CLASS
                        </div>

                        <div
                            id="assignmentPreviewContent"
                            class="preview-content"
                        ></div>

                    </div>


                    <div class="form-group">

                        <label>
                            Day
                        </label>

                        <select
                            id="routine_day"
                            name="day"
                            required
                        >

                            <option value="">
                                Select Day
                            </option>

                            @foreach($days as $day)

                                <option
                                    value="{{ $day }}"
                                    {{ old('day') === $day ? 'selected' : '' }}
                                >
                                    {{ $day }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    <div
                        id="slotMessage"
                        class="smart-message"
                    ></div>


                    <div class="form-group">

                        <label>
                            Smart Available Time Slot
                        </label>

                        <select
                            id="time_slot_id"
                            name="time_slot_id"
                            required
                            disabled
                        >

                            <option value="">
                                Select assignment and day first
                            </option>

                        </select>

                    </div>


                    <div
                        id="roomMessage"
                        class="smart-message"
                    ></div>


                    <div class="form-group">

                        <label>
                            Smart Available Room / Lab
                        </label>

                        <select
                            id="room_id"
                            name="room_id"
                            required
                            disabled
                        >

                            <option value="">
                                Select a time slot first
                            </option>

                        </select>

                    </div>


                    <button
                        id="routineSubmit"
                        type="submit"
                        class="btn primary"
                        disabled
                    >
                        Add Conflict-Free Class
                    </button>

                </form>

            </section>


            <section class="panel">

                <div class="panel-header">

                    <h2>
                        Current Routine Entries
                    </h2>

                    <p>
                        All saved classes remain protected by backend conflict validation.
                    </p>

                </div>


                <div class="filter-box">

                    <form
                        method="GET"
                        action="{{ route('admin.routines.index') }}"
                    >

                        <div class="filter-grid">

                            <div class="form-group">

                                <label>
                                    Day
                                </label>

                                <select name="day">

                                    <option value="">
                                        All Days
                                    </option>

                                    @foreach($days as $day)

                                        <option
                                            value="{{ $day }}"
                                            {{ request('day') === $day ? 'selected' : '' }}
                                        >
                                            {{ $day }}
                                        </option>

                                    @endforeach

                                </select>

                            </div>


                            <div class="form-group">

                                <label>
                                    Section
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
                                    Room
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


                            <div class="filter-actions">

                                <button
                                    type="submit"
                                    class="btn filter-button"
                                >
                                    Filter
                                </button>

                                <a
                                    href="{{ route('admin.routines.index') }}"
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
                            <th>DAY</th>
                            <th>TIME</th>
                            <th>SECTION</th>
                            <th>COURSE</th>
                            <th>FACULTY</th>
                            <th>ROOM</th>
                            <th>STATUS</th>
                            <th>ACTION</th>
                        </tr>

                        </thead>


                        <tbody>

                        @forelse($routines as $routine)

                            <tr>

                                <td>

                                    <span class="badge day-badge">
                                        {{ $routine->day }}
                                    </span>

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

                                    <span class="badge section-badge">

                                        {{ $routine->section->semester->name }}

                                        /

                                        {{ $routine->section->code }}

                                    </span>

                                </td>


                                <td>

                                    <div class="course-code">

                                        {{ $routine->courseAssignment->course->course_code }}

                                    </div>

                                    <div class="course-name">

                                        {{ $routine->courseAssignment->course->course_name }}

                                    </div>

                                </td>


                                <td>

                                    <div class="faculty">

                                        {{ $routine->teacher->name }}

                                    </div>

                                    <div class="faculty-initial">

                                        {{ $routine->teacher->initial }}

                                    </div>

                                </td>


                                <td>

                                    <span class="badge room-badge">

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

                                    <div class="actions">

                                        <button
                                            type="button"
                                            class="btn edit"
                                            onclick="toggleRoutine({{ $routine->id }})"
                                        >
                                            Edit
                                        </button>


                                        <form
                                            method="POST"
                                            action="{{ route('admin.routines.destroy', $routine) }}"
                                            onsubmit="return confirm('Delete this routine entry?')"
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
                                id="routine-edit-{{ $routine->id }}"
                                class="edit-row"
                            >

                                <td colspan="8">

                                    <div class="edit-box">

                                        <h3>
                                            Edit Routine Entry
                                        </h3>


                                        <form
                                            method="POST"
                                            action="{{ route('admin.routines.update', $routine) }}"
                                        >

                                            @csrf
                                            @method('PUT')


                                            <div class="edit-grid">

                                                <div class="form-group">

                                                    <label>
                                                        Assignment
                                                    </label>

                                                    <select
                                                        name="course_assignment_id"
                                                        required
                                                    >

                                                        @foreach($assignments as $assignment)

                                                            <option
                                                                value="{{ $assignment->id }}"
                                                                {{ $routine->course_assignment_id === $assignment->id ? 'selected' : '' }}
                                                            >

                                                                {{ $assignment->section->semester->name }}

                                                                |

                                                                {{ $assignment->section->code }}

                                                                |

                                                                {{ $assignment->course->course_code }}

                                                                |

                                                                {{ $assignment->teacher->initial }}

                                                            </option>

                                                        @endforeach

                                                    </select>

                                                </div>


                                                <div class="form-group">

                                                    <label>
                                                        Day
                                                    </label>

                                                    <select
                                                        name="day"
                                                        required
                                                    >

                                                        @foreach($days as $day)

                                                            <option
                                                                value="{{ $day }}"
                                                                {{ $routine->day === $day ? 'selected' : '' }}
                                                            >
                                                                {{ $day }}
                                                            </option>

                                                        @endforeach

                                                    </select>

                                                </div>


                                                <div class="form-group">

                                                    <label>
                                                        Time
                                                    </label>

                                                    <select
                                                        name="time_slot_id"
                                                        required
                                                    >

                                                        @foreach($timeSlots as $slot)

                                                            <option
                                                                value="{{ $slot->id }}"
                                                                {{ $routine->time_slot_id === $slot->id ? 'selected' : '' }}
                                                            >

                                                                {{ \Carbon\Carbon::parse(
                                                                    $slot->start_time
                                                                )->format('g:i A') }}

                                                                -

                                                                {{ \Carbon\Carbon::parse(
                                                                    $slot->end_time
                                                                )->format('g:i A') }}

                                                            </option>

                                                        @endforeach

                                                    </select>

                                                </div>


                                                <div class="form-group">

                                                    <label>
                                                        Room
                                                    </label>

                                                    <select
                                                        name="room_id"
                                                        required
                                                    >

                                                        @foreach($rooms as $room)

                                                            <option
                                                                value="{{ $room->id }}"
                                                                {{ $routine->room_id === $room->id ? 'selected' : '' }}
                                                            >
                                                                {{ $room->room_number }}
                                                            </option>

                                                        @endforeach

                                                    </select>

                                                </div>


                                                <div class="form-group">

                                                    <label>
                                                        Status
                                                    </label>

                                                    <select
                                                        name="status"
                                                        required
                                                    >

                                                        <option
                                                            value="draft"
                                                            {{ $routine->status === 'draft' ? 'selected' : '' }}
                                                        >
                                                            Draft
                                                        </option>

                                                        <option
                                                            value="published"
                                                            {{ $routine->status === 'published' ? 'selected' : '' }}
                                                        >
                                                            Published
                                                        </option>

                                                    </select>

                                                </div>

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
                                    colspan="8"
                                    class="empty"
                                >
                                    No routine entries have been created yet.
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

    const assignmentSelect =
        document.getElementById(
            'course_assignment_id'
        );

    const daySelect =
        document.getElementById(
            'routine_day'
        );

    const slotSelect =
        document.getElementById(
            'time_slot_id'
        );

    const roomSelect =
        document.getElementById(
            'room_id'
        );

    const submitButton =
        document.getElementById(
            'routineSubmit'
        );

    const slotMessage =
        document.getElementById(
            'slotMessage'
        );

    const roomMessage =
        document.getElementById(
            'roomMessage'
        );

    const preview =
        document.getElementById(
            'assignmentPreview'
        );

    const previewContent =
        document.getElementById(
            'assignmentPreviewContent'
        );


    const slotUrl =
        @json(
            route(
                'admin.routines.available-time-slots'
            )
        );

    const roomUrl =
        @json(
            route(
                'admin.routines.available-rooms'
            )
        );


    function setMessage(
        element,
        text,
        type
    ) {
        element.className =
            'smart-message ' + type;

        element.textContent = text;
    }


    function clearMessage(element) {

        element.className =
            'smart-message';

        element.textContent = '';
    }


    function resetSlots() {

        slotSelect.innerHTML =
            '<option value="">Select assignment and day first</option>';

        slotSelect.disabled = true;

        resetRooms();
    }


    function resetRooms() {

        roomSelect.innerHTML =
            '<option value="">Select a time slot first</option>';

        roomSelect.disabled = true;

        submitButton.disabled = true;

        clearMessage(roomMessage);
    }


    function showAssignmentPreview() {

        const option =
            assignmentSelect.options[
                assignmentSelect.selectedIndex
            ];

        if (
            !option
            ||
            !option.value
        ) {
            preview.style.display = 'none';
            previewContent.innerHTML = '';
            return;
        }

        previewContent.innerHTML =
            '<strong>Semester:</strong> '
            + option.dataset.semester
            + '<br>'
            + '<strong>Section:</strong> '
            + option.dataset.section
            + '<br>'
            + '<strong>Course:</strong> '
            + option.dataset.course
            + '<br>'
            + '<strong>Faculty:</strong> '
            + option.dataset.faculty
            + '<br>'
            + '<strong>Type:</strong> '
            + option.dataset.type;

        preview.style.display = 'block';
    }


    async function loadAvailableSlots() {

        showAssignmentPreview();

        resetSlots();

        clearMessage(slotMessage);

        const assignmentId =
            assignmentSelect.value;

        const day =
            daySelect.value;


        if (
            !assignmentId
            ||
            !day
        ) {
            return;
        }


        setMessage(
            slotMessage,
            'Checking faculty availability, section schedule and free rooms...',
            'loading'
        );


        const url =
            slotUrl
            + '?course_assignment_id='
            + encodeURIComponent(
                assignmentId
            )
            + '&day='
            + encodeURIComponent(day);


        try {

            const response =
                await fetch(
                    url,
                    {
                        headers: {
                            'Accept':
                                'application/json',
                            'X-Requested-With':
                                'XMLHttpRequest'
                        }
                    }
                );


            const data =
                await response.json();


            if (
                !response.ok
                ||
                !data.success
            ) {
                setMessage(
                    slotMessage,
                    data.message
                        || 'Unable to load available time slots.',
                    'bad'
                );

                return;
            }


            slotSelect.innerHTML =
                '<option value="">Select Available Time Slot</option>';


            if (
                !data.slots
                ||
                data.slots.length === 0
            ) {
                setMessage(
                    slotMessage,
                    data.message,
                    'bad'
                );

                return;
            }


            data.slots.forEach(
                function (slot) {

                    const option =
                        document.createElement(
                            'option'
                        );

                    option.value =
                        slot.id;

                    option.textContent =
                        slot.label
                        + ' | '
                        + slot.free_rooms
                        + ' room(s) free';

                    slotSelect.appendChild(
                        option
                    );
                }
            );


            slotSelect.disabled = false;


            setMessage(
                slotMessage,
                data.message,
                'good'
            );

        } catch (error) {

            setMessage(
                slotMessage,
                'Smart time-slot service could not be reached.',
                'bad'
            );
        }
    }


    async function loadAvailableRooms() {

        resetRooms();


        const assignmentId =
            assignmentSelect.value;

        const day =
            daySelect.value;

        const timeSlotId =
            slotSelect.value;


        if (
            !assignmentId
            ||
            !day
            ||
            !timeSlotId
        ) {
            return;
        }


        setMessage(
            roomMessage,
            'Finding free rooms and labs...',
            'loading'
        );


        const url =
            roomUrl
            + '?course_assignment_id='
            + encodeURIComponent(
                assignmentId
            )
            + '&day='
            + encodeURIComponent(day)
            + '&time_slot_id='
            + encodeURIComponent(
                timeSlotId
            );


        try {

            const response =
                await fetch(
                    url,
                    {
                        headers: {
                            'Accept':
                                'application/json',
                            'X-Requested-With':
                                'XMLHttpRequest'
                        }
                    }
                );


            const data =
                await response.json();


            if (
                !response.ok
                ||
                !data.success
            ) {
                setMessage(
                    roomMessage,
                    data.message
                        || 'Unable to load available rooms.',
                    'bad'
                );

                return;
            }


            roomSelect.innerHTML =
                '<option value="">Select Available Room / Lab</option>';


            if (
                !data.rooms
                ||
                data.rooms.length === 0
            ) {
                setMessage(
                    roomMessage,
                    data.message,
                    'bad'
                );

                return;
            }


            data.rooms.forEach(
                function (room) {

                    const option =
                        document.createElement(
                            'option'
                        );

                    option.value =
                        room.id;

                    option.textContent =
                        room.label;

                    roomSelect.appendChild(
                        option
                    );
                }
            );


            roomSelect.disabled = false;


            setMessage(
                roomMessage,
                data.message,
                'good'
            );

        } catch (error) {

            setMessage(
                roomMessage,
                'Smart room service could not be reached.',
                'bad'
            );
        }
    }


    function updateSubmitButton() {

        submitButton.disabled =
            !assignmentSelect.value
            ||
            !daySelect.value
            ||
            !slotSelect.value
            ||
            !roomSelect.value;
    }


    function toggleRoutine(id) {

        const row =
            document.getElementById(
                'routine-edit-' + id
            );

        if (!row) {
            return;
        }

        row.style.display =
            row.style.display === 'table-row'
                ? 'none'
                : 'table-row';
    }


    assignmentSelect.addEventListener(
        'change',
        loadAvailableSlots
    );


    daySelect.addEventListener(
        'change',
        loadAvailableSlots
    );


    slotSelect.addEventListener(
        'change',
        loadAvailableRooms
    );


    roomSelect.addEventListener(
        'change',
        updateSubmitButton
    );


    document.addEventListener(
        'DOMContentLoaded',
        function () {

            showAssignmentPreview();

            @if(old('course_assignment_id') && old('day'))

                loadAvailableSlots()
                    .then(function () {

                        const oldSlot =
                            @json(
                                (string) old(
                                    'time_slot_id'
                                )
                            );

                        if (oldSlot) {

                            slotSelect.value =
                                oldSlot;

                            return loadAvailableRooms();
                        }

                    })
                    .then(function () {

                        const oldRoom =
                            @json(
                                (string) old(
                                    'room_id'
                                )
                            );

                        if (oldRoom) {
                            roomSelect.value =
                                oldRoom;
                        }

                        updateSubmitButton();

                    });

            @endif

        }
    );

</script>

</body>

</html>