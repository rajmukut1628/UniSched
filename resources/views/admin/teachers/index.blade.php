<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Faculty Management | UniSched</title>

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
            display: flex;
            min-height: 100vh;
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

            background: rgba(11,17,32,.97);

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

            align-items: center;

            justify-content: space-between;

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
                repeat(3, 1fr);

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
            border: 0;

            border-radius: 9px;

            padding:
                10px
                14px;

            cursor: pointer;

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
            display: inline-flex;

            align-items: center;

            text-decoration: none;

            color: #94a3b8;

            background:
                rgba(100,116,139,.10);
        }

        /* ==============================
           FILTER
        ============================== */

        .filter-box {
            padding: 16px;

            margin-bottom: 17px;

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

            min-width: 850px;

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

        .faculty {
            display: flex;

            align-items: center;

            gap: 10px;
        }

        .faculty-avatar {
            width: 34px;
            height: 34px;

            flex-shrink: 0;

            display: flex;

            align-items: center;

            justify-content: center;

            border-radius: 9px;

            color: #bfdbfe;

            background:
                linear-gradient(
                    135deg,
                    rgba(37,99,235,.25),
                    rgba(124,58,237,.18)
                );

            font-size: 11px;

            font-weight: 800;
        }

        .faculty-name {
            color: #e2e8f0;

            font-weight: 700;
        }

        .initial {
            color: #93c5fd;

            font-weight: 800;
        }

        .muted {
            color: #64748b;
        }

        /* ==============================
           BADGE
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

        .active {
            color: #86efac;

            background:
                rgba(34,197,94,.09);
        }

        .inactive {
            color: #fca5a5;

            background:
                rgba(239,68,68,.09);
        }

        .actions {
            display: flex;

            gap: 6px;
        }

        /* ==============================
           EDIT
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
            margin:
                0
                0
                16px;

            color: #dbeafe;

            font-size: 13px;
        }

        .edit-grid {
            display: grid;

            grid-template-columns:
                repeat(5,1fr);

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

        .save {
            color: white;

            background:
                linear-gradient(
                    135deg,
                    #2563eb,
                    #7c3aed
                );
        }

        .empty {
            padding: 35px;

            text-align: center;

            color: #64748b;
        }

        /* ==============================
           RESPONSIVE
        ============================== */

        @media(max-width:1150px) {
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
            class="nav-item active"
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


    <main class="main">

        <div class="header">

            <div>

                <h1>
                    Faculty Management
                </h1>

                <p>
                    Manage faculty information used by the academic scheduling system.
                </p>

            </div>

            <div class="count">
                {{ $teachers->count() }}
                {{ $teachers->count() === 1 ? 'FACULTY' : 'FACULTY MEMBERS' }}
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
                    DISPLAYED FACULTY
                </div>

                <div class="stat-value">
                    {{ $teachers->count() }}
                </div>

            </div>


            <div class="stat">

                <div class="stat-label">
                    ACTIVE
                </div>

                <div class="stat-value">
                    {{ $teachers->where('is_active', true)->count() }}
                </div>

            </div>


            <div class="stat">

                <div class="stat-label">
                    INACTIVE
                </div>

                <div class="stat-value">
                    {{ $teachers->where('is_active', false)->count() }}
                </div>

            </div>

        </div>


        <div class="content-grid">

            {{-- ADD FACULTY --}}

            <section class="panel">

                <div class="panel-header">

                    <h2>
                        Add Faculty Member
                    </h2>

                    <p>
                        Faculty information is completely manageable by the administrator.
                    </p>

                </div>


                <form
                    method="POST"
                    action="{{ route('admin.teachers.store') }}"
                >

                    @csrf


                    <div class="form-group">

                        <label>
                            Faculty Name
                        </label>

                        <input
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            placeholder="Example: Dr. John Doe"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label>
                            Faculty Initial
                        </label>

                        <input
                            type="text"
                            name="initial"
                            value="{{ old('initial') }}"
                            placeholder="Example: FZA"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label>
                            Department
                        </label>

                        <input
                            type="text"
                            name="department"
                            value="{{ old('department', 'CSE') }}"
                            placeholder="Example: CSE"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label>
                            Email
                        </label>

                        <input
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="Optional"
                        >

                    </div>


                    <div class="form-group">

                        <label>
                            Phone
                        </label>

                        <input
                            type="text"
                            name="phone"
                            value="{{ old('phone') }}"
                            placeholder="Optional"
                        >

                    </div>


                    <button
                        type="submit"
                        class="btn primary"
                    >
                        Add Faculty Member
                    </button>

                </form>

            </section>


            {{-- FACULTY LIST --}}

            <section class="panel">

                <div class="panel-header">

                    <h2>
                        Faculty Directory
                    </h2>

                    <p>
                        Search, edit and control faculty availability status.
                    </p>

                </div>


                <div class="filter-box">

                    <form
                        method="GET"
                        action="{{ route('admin.teachers.index') }}"
                    >

                        <div class="filter-grid">

                            <div class="form-group">

                                <label>
                                    Search Faculty
                                </label>

                                <input
                                    type="text"
                                    name="search"
                                    value="{{ request('search') }}"
                                    placeholder="Name, initial, email, phone..."
                                >

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
                                    href="{{ route('admin.teachers.index') }}"
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
                            <th>FACULTY</th>
                            <th>INITIAL</th>
                            <th>DEPARTMENT</th>
                            <th>EMAIL</th>
                            <th>PHONE</th>
                            <th>STATUS</th>
                            <th>ACTION</th>
                        </tr>

                        </thead>


                        <tbody>

                        @forelse($teachers as $teacher)

                            <tr>

                                <td>

                                    <div class="faculty">

                                        <div class="faculty-avatar">
                                            {{ strtoupper(substr($teacher->initial, 0, 2)) }}
                                        </div>

                                        <div class="faculty-name">
                                            {{ $teacher->name }}
                                        </div>

                                    </div>

                                </td>


                                <td>

                                    <span class="initial">
                                        {{ $teacher->initial }}
                                    </span>

                                </td>


                                <td>
                                    {{ $teacher->department }}
                                </td>


                                <td>

                                    <span class="muted">
                                        {{ $teacher->email ?: '—' }}
                                    </span>

                                </td>


                                <td>

                                    <span class="muted">
                                        {{ $teacher->phone ?: '—' }}
                                    </span>

                                </td>


                                <td>

                                    @if($teacher->is_active)

                                        <span class="badge active">
                                            ACTIVE
                                        </span>

                                    @else

                                        <span class="badge inactive">
                                            INACTIVE
                                        </span>

                                    @endif

                                </td>


                                <td>

                                    <div class="actions">

                                        <button
                                            type="button"
                                            class="btn edit"
                                            onclick="toggleTeacher({{ $teacher->id }})"
                                        >
                                            Edit
                                        </button>


                                        <form
                                            method="POST"
                                            action="{{ route('admin.teachers.destroy', $teacher) }}"
                                            onsubmit="return confirm('Delete this faculty member?')"
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
                                id="teacher-edit-{{ $teacher->id }}"
                                class="edit-row"
                            >

                                <td colspan="7">

                                    <div class="edit-box">

                                        <h3>
                                            Edit Faculty —
                                            {{ $teacher->initial }}
                                        </h3>


                                        <form
                                            method="POST"
                                            action="{{ route('admin.teachers.update', $teacher) }}"
                                        >

                                            @csrf
                                            @method('PUT')


                                            <div class="edit-grid">

                                                <div class="form-group">

                                                    <label>
                                                        Name
                                                    </label>

                                                    <input
                                                        type="text"
                                                        name="name"
                                                        value="{{ $teacher->name }}"
                                                        required
                                                    >

                                                </div>


                                                <div class="form-group">

                                                    <label>
                                                        Initial
                                                    </label>

                                                    <input
                                                        type="text"
                                                        name="initial"
                                                        value="{{ $teacher->initial }}"
                                                        required
                                                    >

                                                </div>


                                                <div class="form-group">

                                                    <label>
                                                        Department
                                                    </label>

                                                    <input
                                                        type="text"
                                                        name="department"
                                                        value="{{ $teacher->department }}"
                                                        required
                                                    >

                                                </div>


                                                <div class="form-group">

                                                    <label>
                                                        Email
                                                    </label>

                                                    <input
                                                        type="email"
                                                        name="email"
                                                        value="{{ $teacher->email }}"
                                                    >

                                                </div>


                                                <div class="form-group">

                                                    <label>
                                                        Phone
                                                    </label>

                                                    <input
                                                        type="text"
                                                        name="phone"
                                                        value="{{ $teacher->phone }}"
                                                    >

                                                </div>

                                            </div>


                                            <div class="checkbox">

                                                <input
                                                    type="checkbox"
                                                    id="teacher-active-{{ $teacher->id }}"
                                                    name="is_active"
                                                    value="1"
                                                    {{ $teacher->is_active ? 'checked' : '' }}
                                                >

                                                <label
                                                    for="teacher-active-{{ $teacher->id }}"
                                                >
                                                    Active Faculty Member
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
                                    No faculty members found.
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

    function toggleTeacher(id) {

        const row =
            document.getElementById(
                'teacher-edit-' + id
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