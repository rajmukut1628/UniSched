<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Rooms & Labs | UniSched</title>

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

            color: #f8fafc;

            background:
                radial-gradient(
                    circle at 88% 5%,
                    rgba(37,99,235,.11),
                    transparent 26%
                ),
                radial-gradient(
                    circle at 10% 95%,
                    rgba(124,58,237,.08),
                    transparent 25%
                ),
                #070b16;
        }

        .layout {
            min-height: 100vh;
            display: flex;
        }

        /* ==============================
           SIDEBAR
        ============================== */

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;

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

            box-shadow:
                0 10px 25px
                rgba(37,99,235,.22);
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

        /* ==============================
           MAIN
        ============================== */

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
                1px solid
                rgba(59,130,246,.12);

            font-size: 11px;
            font-weight: 800;
        }

        /* ==============================
           ALERT
        ============================== */

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

        /* ==============================
           STATS
        ============================== */

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
                1px solid
                rgba(255,255,255,.06);
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

        /* ==============================
           CONTENT
        ============================== */

        .content-grid {
            display: grid;

            grid-template-columns:
                350px
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

        /* ==============================
           FORM
        ============================== */

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
        }

        .form-row {
            display: grid;

            grid-template-columns:
                1fr
                1fr;

            gap: 11px;
        }

        /* ==============================
           BUTTON
        ============================== */

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

            transition: .2s;
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

        /* ==============================
           FILTER
        ============================== */

        .filter-box {
            padding: 16px;

            margin-bottom: 18px;

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
                1fr
                180px
                150px
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

        /* ==============================
           TABLE
        ============================== */

        .table-wrapper {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;

            min-width: 820px;

            border-collapse: collapse;
        }

        th {
            padding: 12px 10px;

            text-align: left;

            color: #64748b;

            font-size: 10px;
            font-weight: 800;

            border-bottom:
                1px solid
                rgba(255,255,255,.07);
        }

        td {
            padding: 14px 10px;

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

        .room-info {
            display: flex;

            align-items: center;

            gap: 10px;
        }

        .room-icon {
            width: 37px;
            height: 37px;

            flex-shrink: 0;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 10px;

            color: #bfdbfe;

            background:
                linear-gradient(
                    135deg,
                    rgba(37,99,235,.23),
                    rgba(124,58,237,.16)
                );

            font-size: 11px;
            font-weight: 900;
        }

        .room-number {
            color: #e2e8f0;

            font-weight: 800;
        }

        .room-name {
            margin-top: 3px;

            color: #64748b;

            font-size: 10px;
        }

        /* ==============================
           BADGES
        ============================== */

        .badge {
            display: inline-block;

            padding: 5px 8px;

            border-radius: 20px;

            font-size: 9px;
            font-weight: 800;
        }

        .type-classroom {
            color: #93c5fd;

            background:
                rgba(59,130,246,.09);
        }

        .type-computer {
            color: #c4b5fd;

            background:
                rgba(139,92,246,.10);
        }

        .type-eee {
            color: #fde68a;

            background:
                rgba(245,158,11,.09);
        }

        .type-physics {
            color: #67e8f9;

            background:
                rgba(6,182,212,.09);
        }

        .type-other {
            color: #cbd5e1;

            background:
                rgba(148,163,184,.09);
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

        /* ==============================
           EDIT PANEL
        ============================== */

        .edit-row {
            display: none;
        }

        .edit-box {
            padding: 18px;

            border-radius: 13px;

            background:
                rgba(2,6,23,.55);

            border:
                1px solid
                rgba(59,130,246,.09);
        }

        .edit-box h3 {
            margin: 0 0 16px;

            color: #dbeafe;

            font-size: 13px;
        }

        .edit-grid {
            display: grid;

            grid-template-columns:
                1fr
                1.5fr
                1fr
                .8fr;

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

        /* ==============================
           RESPONSIVE
        ============================== */

        @media(max-width:1200px) {

            .stats {
                grid-template-columns:
                    repeat(2,1fr);
            }

            .content-grid {
                grid-template-columns: 1fr;
            }

            .filter-grid,
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

            .stats,
            .form-row,
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

</head>

<body>

<div class="layout">

    {{-- ==========================================
         SIDEBAR
    =========================================== --}}

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
            class="nav-item active"
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


    {{-- ==========================================
         MAIN
    =========================================== --}}

    <main class="main">

        <div class="header">

            <div>

                <h1>
                    Rooms & Labs
                </h1>

                <p>
                    Manage classrooms and laboratories available for academic scheduling.
                </p>

            </div>

            <div class="header-badge">

                {{ $rooms->count() }}

                {{ $rooms->count() === 1 ? 'ROOM' : 'ROOMS / LABS' }}

            </div>

        </div>


        {{-- ALERTS --}}

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


        {{-- STATS --}}

        <div class="stats">

            <div class="stat">

                <div class="stat-label">
                    DISPLAYED ROOMS
                </div>

                <div class="stat-value">
                    {{ $rooms->count() }}
                </div>

            </div>


            <div class="stat">

                <div class="stat-label">
                    CLASSROOMS
                </div>

                <div class="stat-value">
                    {{ $rooms->where('room_type', 'classroom')->count() }}
                </div>

            </div>


            <div class="stat">

                <div class="stat-label">
                    LABS
                </div>

                <div class="stat-value">

                    {{
                        $rooms->whereIn(
                            'room_type',
                            [
                                'computer_lab',
                                'eee_lab',
                                'physics_lab'
                            ]
                        )->count()
                    }}

                </div>

            </div>


            <div class="stat">

                <div class="stat-label">
                    ACTIVE
                </div>

                <div class="stat-value">
                    {{ $rooms->where('is_active', true)->count() }}
                </div>

            </div>

        </div>


        <div class="content-grid">

            {{-- =================================
                 ADD ROOM
            ================================== --}}

            <section class="panel">

                <div class="panel-header">

                    <h2>
                        Add Room / Lab
                    </h2>

                    <p>
                        Admin can manually add any classroom or laboratory used by the university.
                    </p>

                </div>


                <form
                    method="POST"
                    action="{{ route('admin.rooms.store') }}"
                >

                    @csrf


                    <div class="form-group">

                        <label>
                            Room Number
                        </label>

                        <input
                            type="text"
                            name="room_number"
                            value="{{ old('room_number') }}"
                            placeholder="Example: 401"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label>
                            Room Name
                        </label>

                        <input
                            type="text"
                            name="room_name"
                            value="{{ old('room_name') }}"
                            placeholder="Optional name"
                        >

                    </div>


                    <div class="form-group">

                        <label>
                            Room Type
                        </label>

                        <select
                            name="room_type"
                            required
                        >

                            <option
                                value="classroom"
                                {{ old('room_type') === 'classroom' ? 'selected' : '' }}
                            >
                                Classroom
                            </option>

                            <option
                                value="computer_lab"
                                {{ old('room_type') === 'computer_lab' ? 'selected' : '' }}
                            >
                                Computer Lab
                            </option>

                            <option
                                value="eee_lab"
                                {{ old('room_type') === 'eee_lab' ? 'selected' : '' }}
                            >
                                EEE Lab
                            </option>

                            <option
                                value="physics_lab"
                                {{ old('room_type') === 'physics_lab' ? 'selected' : '' }}
                            >
                                Physics Lab
                            </option>

                            <option
                                value="other"
                                {{ old('room_type') === 'other' ? 'selected' : '' }}
                            >
                                Other
                            </option>

                        </select>

                    </div>


                    <div class="form-group">

                        <label>
                            Capacity
                        </label>

                        <input
                            type="number"
                            name="capacity"
                            value="{{ old('capacity') }}"
                            min="1"
                            max="1000"
                            placeholder="Example: 45"
                        >

                    </div>


                    <button
                        type="submit"
                        class="btn primary"
                    >
                        Add Room / Lab
                    </button>

                </form>

            </section>


            {{-- =================================
                 ROOM LIST
            ================================== --}}

            <section class="panel">

                <div class="panel-header">

                    <h2>
                        Room Directory
                    </h2>

                    <p>
                        Search, filter, edit or deactivate scheduling resources.
                    </p>

                </div>


                {{-- FILTER --}}

                <div class="filter-box">

                    <form
                        method="GET"
                        action="{{ route('admin.rooms.index') }}"
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
                                    placeholder="Room number or name..."
                                >

                            </div>


                            <div class="form-group">

                                <label>
                                    Room Type
                                </label>

                                <select name="room_type">

                                    <option value="">
                                        All Types
                                    </option>

                                    <option
                                        value="classroom"
                                        {{ request('room_type') === 'classroom' ? 'selected' : '' }}
                                    >
                                        Classroom
                                    </option>

                                    <option
                                        value="computer_lab"
                                        {{ request('room_type') === 'computer_lab' ? 'selected' : '' }}
                                    >
                                        Computer Lab
                                    </option>

                                    <option
                                        value="eee_lab"
                                        {{ request('room_type') === 'eee_lab' ? 'selected' : '' }}
                                    >
                                        EEE Lab
                                    </option>

                                    <option
                                        value="physics_lab"
                                        {{ request('room_type') === 'physics_lab' ? 'selected' : '' }}
                                    >
                                        Physics Lab
                                    </option>

                                    <option
                                        value="other"
                                        {{ request('room_type') === 'other' ? 'selected' : '' }}
                                    >
                                        Other
                                    </option>

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
                                    href="{{ route('admin.rooms.index') }}"
                                    class="btn reset"
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
                            <th>ROOM</th>
                            <th>TYPE</th>
                            <th>CAPACITY</th>
                            <th>STATUS</th>
                            <th>ACTION</th>
                        </tr>

                        </thead>


                        <tbody>

                        @forelse($rooms as $room)

                            <tr>

                                <td>

                                    <div class="room-info">

                                        <div class="room-icon">
                                            {{ strtoupper(substr($room->room_number, 0, 2)) }}
                                        </div>


                                        <div>

                                            <div class="room-number">
                                                {{ $room->room_number }}
                                            </div>

                                            <div class="room-name">
                                                {{ $room->room_name ?: 'No custom name' }}
                                            </div>

                                        </div>

                                    </div>

                                </td>


                                <td>

                                    @if($room->room_type === 'classroom')

                                        <span class="badge type-classroom">
                                            CLASSROOM
                                        </span>

                                    @elseif($room->room_type === 'computer_lab')

                                        <span class="badge type-computer">
                                            COMPUTER LAB
                                        </span>

                                    @elseif($room->room_type === 'eee_lab')

                                        <span class="badge type-eee">
                                            EEE LAB
                                        </span>

                                    @elseif($room->room_type === 'physics_lab')

                                        <span class="badge type-physics">
                                            PHYSICS LAB
                                        </span>

                                    @else

                                        <span class="badge type-other">
                                            OTHER
                                        </span>

                                    @endif

                                </td>


                                <td>
                                    {{ $room->capacity ?: '—' }}
                                </td>


                                <td>

                                    @if($room->is_active)

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
                                            onclick="toggleRoom({{ $room->id }})"
                                        >
                                            Edit
                                        </button>


                                        <form
                                            method="POST"
                                            action="{{ route('admin.rooms.destroy', $room) }}"
                                            onsubmit="return confirm('Are you sure you want to delete this room or lab?')"
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


                            {{-- EDIT ROW --}}

                            <tr
                                id="room-edit-{{ $room->id }}"
                                class="edit-row"
                            >

                                <td colspan="5">

                                    <div class="edit-box">

                                        <h3>
                                            Edit Room —
                                            {{ $room->room_number }}
                                        </h3>


                                        <form
                                            method="POST"
                                            action="{{ route('admin.rooms.update', $room) }}"
                                        >

                                            @csrf
                                            @method('PUT')


                                            <div class="edit-grid">

                                                <div class="form-group">

                                                    <label>
                                                        Room Number
                                                    </label>

                                                    <input
                                                        type="text"
                                                        name="room_number"
                                                        value="{{ $room->room_number }}"
                                                        required
                                                    >

                                                </div>


                                                <div class="form-group">

                                                    <label>
                                                        Room Name
                                                    </label>

                                                    <input
                                                        type="text"
                                                        name="room_name"
                                                        value="{{ $room->room_name }}"
                                                    >

                                                </div>


                                                <div class="form-group">

                                                    <label>
                                                        Room Type
                                                    </label>

                                                    <select
                                                        name="room_type"
                                                        required
                                                    >

                                                        <option
                                                            value="classroom"
                                                            {{ $room->room_type === 'classroom' ? 'selected' : '' }}
                                                        >
                                                            Classroom
                                                        </option>

                                                        <option
                                                            value="computer_lab"
                                                            {{ $room->room_type === 'computer_lab' ? 'selected' : '' }}
                                                        >
                                                            Computer Lab
                                                        </option>

                                                        <option
                                                            value="eee_lab"
                                                            {{ $room->room_type === 'eee_lab' ? 'selected' : '' }}
                                                        >
                                                            EEE Lab
                                                        </option>

                                                        <option
                                                            value="physics_lab"
                                                            {{ $room->room_type === 'physics_lab' ? 'selected' : '' }}
                                                        >
                                                            Physics Lab
                                                        </option>

                                                        <option
                                                            value="other"
                                                            {{ $room->room_type === 'other' ? 'selected' : '' }}
                                                        >
                                                            Other
                                                        </option>

                                                    </select>

                                                </div>


                                                <div class="form-group">

                                                    <label>
                                                        Capacity
                                                    </label>

                                                    <input
                                                        type="number"
                                                        name="capacity"
                                                        value="{{ $room->capacity }}"
                                                        min="1"
                                                        max="1000"
                                                    >

                                                </div>

                                            </div>


                                            <div class="checkbox">

                                                <input
                                                    type="checkbox"
                                                    id="room-active-{{ $room->id }}"
                                                    name="is_active"
                                                    value="1"
                                                    {{ $room->is_active ? 'checked' : '' }}
                                                >

                                                <label
                                                    for="room-active-{{ $room->id }}"
                                                >
                                                    Active Room / Lab
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
                                    colspan="5"
                                    class="empty"
                                >
                                    No rooms or labs found.
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

    function toggleRoom(id) {

        const row =
            document.getElementById(
                'room-edit-' + id
            );

        if (!row) {
            return;
        }

        row.style.display =
            row.style.display === 'table-row'
                ? 'none'
                : 'table-row';
    }

</script>

</body>
</html>