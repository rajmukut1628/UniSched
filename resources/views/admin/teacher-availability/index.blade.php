<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Faculty Availability | UniSched</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;

            font-family:
                Inter,
                Arial,
                sans-serif;

            background:
                radial-gradient(
                    circle at 85% 5%,
                    rgba(37,99,235,.11),
                    transparent 25%
                ),
                radial-gradient(
                    circle at 10% 95%,
                    rgba(124,58,237,.07),
                    transparent 25%
                ),
                #070b16;

            color: #f8fafc;
        }

        .layout {
            min-height: 100vh;
            display: flex;
        }

        /* =====================================
           SIDEBAR
        ===================================== */

        .sidebar {
            position: fixed;

            left: 0;
            top: 0;

            width: 270px;
            min-height: 100vh;

            padding: 28px 20px;

            background:
                rgba(11,17,32,.97);

            border-right:
                1px solid
                rgba(255,255,255,.07);

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
            margin:
                25px
                10px
                10px;

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

            transform:
                translateX(2px);
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
                1px solid
                rgba(59,130,246,.15);
        }

        .nav-icon {
            width: 20px;
            text-align: center;
        }

        .coming {
            opacity: .45;
        }

        /* =====================================
           MAIN
        ===================================== */

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
            margin:
                7px
                0
                0;

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
                1px solid
                rgba(59,130,246,.12);

            font-size: 11px;

            font-weight: 800;
        }

        /* =====================================
           ALERT
        ===================================== */

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
                1px solid
                rgba(34,197,94,.16);
        }

        .error {
            color: #fca5a5;

            background:
                rgba(239,68,68,.08);

            border:
                1px solid
                rgba(239,68,68,.16);
        }

        /* =====================================
           PANEL
        ===================================== */

        .panel {
            padding: 23px;

            margin-bottom: 20px;

            border-radius: 18px;

            background:
                rgba(15,23,42,.78);

            border:
                1px solid
                rgba(255,255,255,.065);
        }

        .panel-title {
            margin: 0;

            font-size: 17px;

            font-weight: 800;
        }

        .panel-description {
            margin:
                6px
                0
                20px;

            color: #64748b;

            font-size: 11px;

            line-height: 1.6;
        }

        /* =====================================
           FACULTY SELECTOR
        ===================================== */

        .selector {
            display: grid;

            grid-template-columns:
                minmax(0,1fr)
                auto;

            gap: 12px;

            align-items: end;
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
                1px solid
                rgba(255,255,255,.08);

            background: #090f1d;

            color: #f8fafc;

            outline: none;
        }

        select:focus {
            border-color: #3b82f6;

            box-shadow:
                0 0 0 3px
                rgba(59,130,246,.09);
        }

        select option {
            background: #0f172a;
        }

        /* =====================================
           BUTTONS
        ===================================== */

        .btn {
            display: inline-flex;

            align-items: center;

            justify-content: center;

            border: 0;

            padding:
                11px
                16px;

            border-radius: 9px;

            cursor: pointer;

            text-decoration: none;

            font-size: 11px;

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

        .secondary {
            color: #93c5fd;

            background:
                rgba(59,130,246,.10);

            border:
                1px solid
                rgba(59,130,246,.10);
        }

        .danger {
            color: #fca5a5;

            background:
                rgba(239,68,68,.08);

            border:
                1px solid
                rgba(239,68,68,.10);
        }

        /* =====================================
           FACULTY INFO
        ===================================== */

        .faculty-card {
            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 15px;

            margin-bottom: 20px;

            padding: 17px;

            border-radius: 14px;

            background:
                rgba(2,6,23,.38);

            border:
                1px solid
                rgba(255,255,255,.05);
        }

        .faculty-profile {
            display: flex;

            align-items: center;

            gap: 13px;
        }

        .avatar {
            width: 46px;
            height: 46px;

            display: flex;

            align-items: center;

            justify-content: center;

            border-radius: 13px;

            color: #bfdbfe;

            background:
                linear-gradient(
                    135deg,
                    rgba(37,99,235,.25),
                    rgba(124,58,237,.18)
                );

            font-size: 13px;

            font-weight: 900;
        }

        .faculty-name {
            color: #e2e8f0;

            font-size: 15px;

            font-weight: 800;
        }

        .faculty-meta {
            margin-top: 4px;

            color: #64748b;

            font-size: 11px;
        }

        .faculty-actions {
            display: flex;

            gap: 8px;
        }

        /* =====================================
           AVAILABILITY GRID
        ===================================== */

        .availability-wrapper {
            overflow-x: auto;
        }

        .availability-table {
            width: 100%;

            min-width: 850px;

            border-collapse: separate;

            border-spacing: 0 9px;
        }

        .availability-table th {
            padding: 10px;

            color: #64748b;

            font-size: 10px;

            font-weight: 800;

            text-align: center;
        }

        .availability-table th:first-child {
            text-align: left;
        }

        .availability-table td {
            padding: 12px 10px;

            text-align: center;

            background:
                rgba(2,6,23,.35);

            border-top:
                1px solid
                rgba(255,255,255,.04);

            border-bottom:
                1px solid
                rgba(255,255,255,.04);
        }

        .availability-table td:first-child {
            text-align: left;

            border-left:
                1px solid
                rgba(255,255,255,.04);

            border-radius:
                11px
                0
                0
                11px;
        }

        .availability-table td:last-child {
            border-right:
                1px solid
                rgba(255,255,255,.04);

            border-radius:
                0
                11px
                11px
                0;
        }

        .day-name {
            color: #e2e8f0;

            font-size: 12px;

            font-weight: 800;
        }

        .slot-title {
            color: #cbd5e1;

            font-size: 10px;

            font-weight: 700;
        }

        .slot-time {
            display: block;

            margin-top: 4px;

            color: #475569;

            font-size: 9px;
        }

        /* =====================================
           CUSTOM CHECKBOX
        ===================================== */

        .slot-check {
            position: relative;

            display: inline-flex;

            align-items: center;

            justify-content: center;

            width: 34px;
            height: 34px;

            cursor: pointer;
        }

        .slot-check input {
            position: absolute;

            opacity: 0;

            pointer-events: none;
        }

        .check-ui {
            width: 30px;
            height: 30px;

            display: flex;

            align-items: center;

            justify-content: center;

            border-radius: 9px;

            color: #475569;

            background:
                rgba(15,23,42,.85);

            border:
                1px solid
                rgba(255,255,255,.07);

            font-size: 13px;

            font-weight: 900;

            transition: .18s;
        }

        .slot-check input:checked + .check-ui {
            color: white;

            background:
                linear-gradient(
                    135deg,
                    #2563eb,
                    #7c3aed
                );

            border-color:
                rgba(96,165,250,.45);

            box-shadow:
                0 5px 16px
                rgba(37,99,235,.18);
        }

        .slot-check input:checked + .check-ui::before {
            content: "✓";
        }

        /* =====================================
           QUICK CONTROLS
        ===================================== */

        .quick-controls {
            display: flex;

            flex-wrap: wrap;

            gap: 8px;

            margin:
                5px
                0
                20px;
        }

        .quick-btn {
            padding:
                8px
                11px;

            border-radius: 8px;

            border:
                1px solid
                rgba(255,255,255,.06);

            color: #94a3b8;

            background:
                rgba(15,23,42,.70);

            cursor: pointer;

            font-size: 10px;

            font-weight: 700;
        }

        .quick-btn:hover {
            color: #bfdbfe;

            border-color:
                rgba(59,130,246,.20);
        }

        /* =====================================
           SAVE
        ===================================== */

        .save-bar {
            display: flex;

            justify-content: space-between;

            align-items: center;

            gap: 15px;

            margin-top: 18px;

            padding-top: 18px;

            border-top:
                1px solid
                rgba(255,255,255,.055);
        }

        .save-note {
            color: #64748b;

            font-size: 10px;

            line-height: 1.5;
        }

        .save-button {
            min-width: 170px;
        }

        /* =====================================
           EMPTY
        ===================================== */

        .empty-state {
            padding: 60px 20px;

            text-align: center;
        }

        .empty-icon {
            width: 60px;
            height: 60px;

            margin:
                0
                auto
                15px;

            display: flex;

            align-items: center;

            justify-content: center;

            border-radius: 17px;

            color: #60a5fa;

            background:
                rgba(59,130,246,.08);

            font-size: 23px;

            font-weight: 900;
        }

        .empty-state h3 {
            margin:
                0
                0
                7px;

            font-size: 15px;
        }

        .empty-state p {
            margin: 0;

            color: #64748b;

            font-size: 11px;
        }

        /* =====================================
           RESPONSIVE
        ===================================== */

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

            .header,
            .faculty-card,
            .save-bar {
                flex-direction: column;

                align-items: flex-start;
            }

            .selector {
                grid-template-columns: 1fr;
            }

            .faculty-actions {
                width: 100%;

                flex-wrap: wrap;
            }
        }

    </style>

</head>

<body>

<div class="layout">

    {{-- =====================================
         SIDEBAR
    ====================================== --}}

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
            class="nav-item active"
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
            href="#"
            class="nav-item coming"
        >
            <span class="nav-icon">R</span>
            Rooms & Labs
        </a>

        <a
            href="#"
            class="nav-item coming"
        >
            <span class="nav-icon">↔</span>
            Course Assignments
        </a>

        <a
            href="#"
            class="nav-item coming"
        >
            <span class="nav-icon">+</span>
            Routine Builder
        </a>

        <a
            href="#"
            class="nav-item coming"
        >
            <span class="nav-icon">▦</span>
            Routine Views
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


    {{-- =====================================
         MAIN
    ====================================== --}}

    <main class="main">

        <div class="header">

            <div>

                <h1>
                    Faculty Availability
                </h1>

                <p>
                    Configure when each faculty member is available for academic scheduling.
                </p>

            </div>

            <div class="header-badge">
                SATURDAY — THURSDAY
            </div>

        </div>


        {{-- =====================================
             ALERTS
        ====================================== --}}

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


        {{-- =====================================
             SELECT FACULTY
        ====================================== --}}

        <section class="panel">

            <h2 class="panel-title">
                Select Faculty Member
            </h2>

            <p class="panel-description">
                Select a faculty member to view or update their weekly availability.
            </p>


            <form
                method="GET"
                action="{{ route('admin.teacher-availability.index') }}"
            >

                <div class="selector">

                    <div>

                        <label>
                            Faculty
                        </label>

                        <select
                            name="teacher_id"
                            required
                        >

                            <option value="">
                                Select Faculty Member
                            </option>

                            @foreach($teachers as $teacher)

                                <option
                                    value="{{ $teacher->id }}"
                                    {{ optional($selectedTeacher)->id === $teacher->id ? 'selected' : '' }}
                                >
                                    {{ $teacher->initial }}
                                    —
                                    {{ $teacher->name }}
                                    ({{ $teacher->department }})
                                </option>

                            @endforeach

                        </select>

                    </div>


                    <button
                        type="submit"
                        class="btn primary"
                    >
                        Load Availability
                    </button>

                </div>

            </form>

        </section>


        @if($selectedTeacher)

            <section class="panel">

                {{-- FACULTY PROFILE --}}

                <div class="faculty-card">

                    <div class="faculty-profile">

                        <div class="avatar">

                            {{ strtoupper(
                                substr(
                                    $selectedTeacher->initial,
                                    0,
                                    2
                                )
                            ) }}

                        </div>


                        <div>

                            <div class="faculty-name">
                                {{ $selectedTeacher->name }}
                            </div>

                            <div class="faculty-meta">

                                {{ $selectedTeacher->initial }}

                                &nbsp;•&nbsp;

                                {{ $selectedTeacher->department }}

                                &nbsp;•&nbsp;

                                {{ $selectedTeacher->is_active ? 'Active Faculty' : 'Inactive Faculty' }}

                            </div>

                        </div>

                    </div>


                    <div class="faculty-actions">

                        <form
                            method="POST"
                            action="{{ route('admin.teacher-availability.all', $selectedTeacher) }}"
                        >

                            @csrf

                            <button
                                type="submit"
                                class="btn secondary"
                            >
                                Available All Week
                            </button>

                        </form>


                        <form
                            method="POST"
                            action="{{ route('admin.teacher-availability.clear', $selectedTeacher) }}"
                            onsubmit="return confirm('Clear all availability for this faculty member?')"
                        >

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="btn danger"
                            >
                                Clear Availability
                            </button>

                        </form>

                    </div>

                </div>


                <h2 class="panel-title">
                    Weekly Availability Matrix
                </h2>

                <p class="panel-description">
                    Checked cells mean the faculty member is available during that day and time slot.
                </p>


                @if($timeSlots->count())

                    <form
                        method="POST"
                        action="{{ route('admin.teacher-availability.update', $selectedTeacher) }}"
                    >

                        @csrf
                        @method('PUT')


                        {{-- QUICK CONTROLS --}}

                        <div class="quick-controls">

                            <button
                                type="button"
                                class="quick-btn"
                                onclick="selectAllSlots()"
                            >
                                Select All
                            </button>

                            <button
                                type="button"
                                class="quick-btn"
                                onclick="clearAllSlots()"
                            >
                                Clear All
                            </button>


                            @foreach($days as $day)

                                <button
                                    type="button"
                                    class="quick-btn"
                                    onclick="toggleDay('{{ $day }}')"
                                >
                                    Toggle {{ $day }}
                                </button>

                            @endforeach

                        </div>


                        {{-- MATRIX --}}

                        <div class="availability-wrapper">

                            <table class="availability-table">

                                <thead>

                                <tr>

                                    <th>
                                        DAY
                                    </th>

                                    @foreach($timeSlots as $slot)

                                        <th>

                                            <span class="slot-title">

                                                {{ $slot->name ?: 'Slot ' . $slot->sort_order }}

                                            </span>

                                            <span class="slot-time">

                                                {{ \Carbon\Carbon::parse($slot->start_time)->format('g:i A') }}

                                                -

                                                {{ \Carbon\Carbon::parse($slot->end_time)->format('g:i A') }}

                                            </span>

                                        </th>

                                    @endforeach

                                </tr>

                                </thead>


                                <tbody>

                                @foreach($days as $day)

                                    <tr>

                                        <td>

                                            <span class="day-name">
                                                {{ $day }}
                                            </span>

                                        </td>


                                        @foreach($timeSlots as $slot)

                                            <td>

                                                <label class="slot-check">

                                                    <input
                                                        type="checkbox"
                                                        class="availability-checkbox day-{{ $day }}"
                                                        name="availability[{{ $day }}][]"
                                                        value="{{ $slot->id }}"
                                                        {{ isset(
                                                            $availabilityMap[$day][$slot->id]
                                                        ) ? 'checked' : '' }}
                                                    >

                                                    <span class="check-ui"></span>

                                                </label>

                                            </td>

                                        @endforeach

                                    </tr>

                                @endforeach

                                </tbody>

                            </table>

                        </div>


                        <div class="save-bar">

                            <div class="save-note">

                                Saving this form replaces the current availability
                                configuration for

                                <strong>
                                    {{ $selectedTeacher->initial }}
                                </strong>.

                            </div>


                            <button
                                type="submit"
                                class="btn primary save-button"
                            >
                                Save Availability
                            </button>

                        </div>

                    </form>

                @else

                    <div class="empty-state">

                        <div class="empty-icon">
                            T
                        </div>

                        <h3>
                            No Time Slots Available
                        </h3>

                        <p>
                            Create time slots before configuring faculty availability.
                        </p>

                    </div>

                @endif

            </section>

        @else

            <section class="panel">

                <div class="empty-state">

                    <div class="empty-icon">
                        F
                    </div>

                    <h3>
                        Select a Faculty Member
                    </h3>

                    <p>
                        Choose a faculty member above to configure their weekly availability.
                    </p>

                </div>

            </section>

        @endif

    </main>

</div>


<script>

    function selectAllSlots() {

        document
            .querySelectorAll(
                '.availability-checkbox'
            )
            .forEach(function (checkbox) {

                checkbox.checked = true;

            });
    }


    function clearAllSlots() {

        document
            .querySelectorAll(
                '.availability-checkbox'
            )
            .forEach(function (checkbox) {

                checkbox.checked = false;

            });
    }


    function toggleDay(day) {

        const checkboxes =
            document.querySelectorAll(
                '.day-' + day
            );

        let allChecked = true;


        checkboxes.forEach(function (checkbox) {

            if (!checkbox.checked) {
                allChecked = false;
            }

        });


        checkboxes.forEach(function (checkbox) {

            checkbox.checked =
                !allChecked;

        });
    }

</script>

</body>

</html>