<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Time Slot Management | UniSched</title>

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

        /* ==============================
           SIDEBAR
        ============================== */

        .sidebar {
            width: 270px;
            min-height: 100vh;

            position: fixed;

            top: 0;
            left: 0;

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

            margin-bottom: 28px;
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

        .count {
            padding:
                9px
                15px;

            border-radius: 20px;

            color: #93c5fd;

            background:
                rgba(59,130,246,.08);

            border:
                1px solid
                rgba(59,130,246,.12);

            font-size: 12px;

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
                repeat(3,1fr);

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
            margin:
                6px
                0
                0;

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

        input {
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

        input:focus {
            border-color: #3b82f6;

            box-shadow:
                0 0 0 3px
                rgba(59,130,246,.09);
        }

        input[type="time"] {
            color-scheme: dark;
        }

        .form-row {
            display: grid;

            grid-template-columns:
                1fr
                1fr;

            gap: 11px;
        }

        /* ==============================
           BUTTONS
        ============================== */

        .btn {
            border: 0;

            border-radius: 9px;

            padding:
                10px
                14px;

            cursor: pointer;

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

        .primary:hover {
            transform:
                translateY(-1px);
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
           INFO BOX
        ============================== */

        .info-box {
            margin-top: 18px;

            padding: 16px;

            border-radius: 13px;

            background:
                rgba(59,130,246,.04);

            border:
                1px solid
                rgba(59,130,246,.09);
        }

        .info-title {
            color: #bfdbfe;

            font-size: 11px;

            font-weight: 800;
        }

        .info-box p {
            margin:
                7px
                0
                0;

            color: #64748b;

            font-size: 10px;

            line-height: 1.6;
        }

        /* ==============================
           SLOT LIST
        ============================== */

        .slot-list {
            display: flex;

            flex-direction: column;

            gap: 10px;
        }

        .slot-card {
            padding: 17px;

            border-radius: 14px;

            background:
                rgba(9,15,29,.70);

            border:
                1px solid
                rgba(255,255,255,.055);
        }

        .slot-main {
            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 15px;
        }

        .slot-left {
            display: flex;

            align-items: center;

            gap: 14px;
        }

        .slot-number {
            width: 43px;
            height: 43px;

            display: flex;

            align-items: center;

            justify-content: center;

            flex-shrink: 0;

            border-radius: 11px;

            color: #bfdbfe;

            background:
                linear-gradient(
                    135deg,
                    rgba(37,99,235,.20),
                    rgba(124,58,237,.15)
                );

            font-weight: 900;
        }

        .slot-name {
            color: #e2e8f0;

            font-size: 14px;

            font-weight: 700;
        }

        .slot-time {
            margin-top: 5px;

            color: #94a3b8;

            font-size: 12px;
        }

        .slot-order {
            margin-top: 4px;

            color: #475569;

            font-size: 10px;
        }

        .actions {
            display: flex;

            gap: 6px;

            align-items: center;
        }

        /* ==============================
           BADGES
        ============================== */

        .badge {
            display: inline-block;

            padding:
                5px
                8px;

            border-radius: 20px;

            font-size: 9px;

            font-weight: 800;
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

        /* ==============================
           EDIT
        ============================== */

        .edit-panel {
            display: none;

            margin-top: 15px;

            padding: 17px;

            border-radius: 12px;

            background:
                rgba(2,6,23,.55);

            border:
                1px solid
                rgba(59,130,246,.08);
        }

        .edit-panel h3 {
            margin:
                0
                0
                15px;

            color: #dbeafe;

            font-size: 13px;
        }

        .edit-grid {
            display: grid;

            grid-template-columns:
                1.2fr
                1fr
                1fr
                .7fr;

            gap: 10px;
        }

        .checkbox {
            display: flex;

            align-items: center;

            gap: 8px;

            margin-bottom: 14px;
        }

        .checkbox input {
            width: auto;

            margin: 0;
        }

        .checkbox label {
            margin: 0;
        }

        .empty {
            padding: 35px;

            text-align: center;

            color: #64748b;
        }

        /* ==============================
           RESPONSIVE
        ============================== */

        @media(max-width:1100px) {

            .content-grid {
                grid-template-columns: 1fr;
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

            .stats,
            .form-row,
            .edit-grid {
                grid-template-columns: 1fr;
            }

            .header,
            .slot-main {
                flex-direction: column;

                align-items: flex-start;
            }
        }

    </style>

</head>

<body>

<div class="layout">

    {{-- SIDEBAR --}}

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
            href="#"
            class="nav-item coming"
        >
            <span class="nav-icon">A</span>
            Faculty Availability
        </a>


        <div class="nav-title">
            SCHEDULING
        </div>

        <a
            href="{{ route('admin.time-slots.index') }}"
            class="nav-item active"
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


    {{-- MAIN --}}

    <main class="main">

        <div class="header">

            <div>

                <h1>
                    Time Slot Management
                </h1>

                <p>
                    Create and control the academic scheduling time structure.
                </p>

            </div>

            <div class="count">
                {{ $timeSlots->count() }}
                {{ $timeSlots->count() === 1 ? 'TIME SLOT' : 'TIME SLOTS' }}
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
                    TOTAL SLOTS
                </div>

                <div class="stat-value">
                    {{ $timeSlots->count() }}
                </div>

            </div>


            <div class="stat">

                <div class="stat-label">
                    ACTIVE SLOTS
                </div>

                <div class="stat-value">
                    {{ $timeSlots->where('is_active', true)->count() }}
                </div>

            </div>


            <div class="stat">

                <div class="stat-label">
                    INACTIVE SLOTS
                </div>

                <div class="stat-value">
                    {{ $timeSlots->where('is_active', false)->count() }}
                </div>

            </div>

        </div>


        <div class="content-grid">

            {{-- ADD SLOT --}}

            <section class="panel">

                <div class="panel-header">

                    <h2>
                        Add Time Slot
                    </h2>

                    <p>
                        Admin can manually create any academic time slot required by the university.
                    </p>

                </div>


                <form
                    method="POST"
                    action="{{ route('admin.time-slots.store') }}"
                >

                    @csrf


                    <div class="form-group">

                        <label>
                            Slot Name
                        </label>

                        <input
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            placeholder="Example: Morning Slot 1"
                        >

                    </div>


                    <div class="form-row">

                        <div class="form-group">

                            <label>
                                Start Time
                            </label>

                            <input
                                type="time"
                                name="start_time"
                                value="{{ old('start_time') }}"
                                required
                            >

                        </div>


                        <div class="form-group">

                            <label>
                                End Time
                            </label>

                            <input
                                type="time"
                                name="end_time"
                                value="{{ old('end_time') }}"
                                required
                            >

                        </div>

                    </div>


                    <div class="form-group">

                        <label>
                            Display Order
                        </label>

                        <input
                            type="number"
                            name="sort_order"
                            value="{{ old('sort_order', $timeSlots->count() + 1) }}"
                            min="0"
                            max="999"
                            required
                        >

                    </div>


                    <button
                        type="submit"
                        class="btn primary"
                    >
                        Add Time Slot
                    </button>

                </form>


                <div class="info-box">

                    <div class="info-title">
                        Smart Time Validation
                    </div>

                    <p>
                        UniSched prevents duplicate and overlapping time slots so that the scheduling engine can detect conflicts accurately.
                    </p>

                </div>

            </section>


            {{-- SLOT LIST --}}

            <section class="panel">

                <div class="panel-header">

                    <h2>
                        Academic Time Slots
                    </h2>

                    <p>
                        Edit, deactivate or remove unused scheduling periods.
                    </p>

                </div>


                <div class="slot-list">

                    @forelse($timeSlots as $timeSlot)

                        <div class="slot-card">

                            <div class="slot-main">

                                <div class="slot-left">

                                    <div class="slot-number">
                                        {{ $timeSlot->sort_order }}
                                    </div>


                                    <div>

                                        <div class="slot-name">

                                            {{ $timeSlot->name ?: 'Time Slot ' . $timeSlot->sort_order }}

                                        </div>


                                        <div class="slot-time">

                                            {{ \Carbon\Carbon::parse($timeSlot->start_time)->format('g:i A') }}

                                            —

                                            {{ \Carbon\Carbon::parse($timeSlot->end_time)->format('g:i A') }}

                                        </div>


                                        <div class="slot-order">
                                            Display Order:
                                            {{ $timeSlot->sort_order }}
                                        </div>

                                    </div>

                                </div>


                                <div class="actions">

                                    @if($timeSlot->is_active)

                                        <span class="badge active-badge">
                                            ACTIVE
                                        </span>

                                    @else

                                        <span class="badge inactive-badge">
                                            INACTIVE
                                        </span>

                                    @endif


                                    <button
                                        type="button"
                                        class="btn edit"
                                        onclick="toggleSlot({{ $timeSlot->id }})"
                                    >
                                        Edit
                                    </button>


                                    <form
                                        method="POST"
                                        action="{{ route('admin.time-slots.destroy', $timeSlot) }}"
                                        onsubmit="return confirm('Are you sure you want to delete this time slot?')"
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

                            </div>


                            {{-- EDIT PANEL --}}

                            <div
                                id="slot-edit-{{ $timeSlot->id }}"
                                class="edit-panel"
                            >

                                <h3>
                                    Edit Time Slot
                                </h3>


                                <form
                                    method="POST"
                                    action="{{ route('admin.time-slots.update', $timeSlot) }}"
                                >

                                    @csrf
                                    @method('PUT')


                                    <div class="edit-grid">

                                        <div class="form-group">

                                            <label>
                                                Slot Name
                                            </label>

                                            <input
                                                type="text"
                                                name="name"
                                                value="{{ $timeSlot->name }}"
                                            >

                                        </div>


                                        <div class="form-group">

                                            <label>
                                                Start Time
                                            </label>

                                            <input
                                                type="time"
                                                name="start_time"
                                                value="{{ \Carbon\Carbon::parse($timeSlot->start_time)->format('H:i') }}"
                                                required
                                            >

                                        </div>


                                        <div class="form-group">

                                            <label>
                                                End Time
                                            </label>

                                            <input
                                                type="time"
                                                name="end_time"
                                                value="{{ \Carbon\Carbon::parse($timeSlot->end_time)->format('H:i') }}"
                                                required
                                            >

                                        </div>


                                        <div class="form-group">

                                            <label>
                                                Display Order
                                            </label>

                                            <input
                                                type="number"
                                                name="sort_order"
                                                value="{{ $timeSlot->sort_order }}"
                                                min="0"
                                                max="999"
                                                required
                                            >

                                        </div>

                                    </div>


                                    <div class="checkbox">

                                        <input
                                            type="checkbox"
                                            id="slot-active-{{ $timeSlot->id }}"
                                            name="is_active"
                                            value="1"
                                            {{ $timeSlot->is_active ? 'checked' : '' }}
                                        >

                                        <label
                                            for="slot-active-{{ $timeSlot->id }}"
                                        >
                                            Active Time Slot
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

                        </div>

                    @empty

                        <div class="empty">
                            No time slots found.
                        </div>

                    @endforelse

                </div>

            </section>

        </div>

    </main>

</div>


<script>

    function toggleSlot(id) {

        const panel =
            document.getElementById(
                'slot-edit-' + id
            );

        if (!panel) {
            return;
        }

        panel.style.display =
            panel.style.display === 'block'
                ? 'none'
                : 'block';
    }

</script>

</body>
</html>