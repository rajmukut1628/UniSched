<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Semester Management | UniSched</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: Inter, Arial, sans-serif;
            background: #070b16;
            color: #f8fafc;
        }

        .layout {
            min-height: 100vh;
            display: flex;
        }

        .sidebar {
            width: 260px;
            min-height: 100vh;
            padding: 28px 20px;
            background: #0b1120;
            border-right: 1px solid rgba(255,255,255,.07);
            position: fixed;
            left: 0;
            top: 0;
        }

        .logo {
            font-size: 25px;
            font-weight: 800;
            margin-bottom: 38px;
        }

        .logo span { color: #60a5fa; }

        .nav-title {
            color: #64748b;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1.4px;
            margin: 24px 10px 10px;
        }

        .nav-item {
            display: block;
            text-decoration: none;
            color: #94a3b8;
            padding: 12px 14px;
            margin-bottom: 5px;
            border-radius: 10px;
            transition: .2s;
        }

        .nav-item:hover,
        .nav-item.active {
            background: rgba(59,130,246,.12);
            color: #93c5fd;
        }

        .main {
            flex: 1;
            margin-left: 260px;
            padding: 35px;
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 30px;
        }

        h1 {
            margin: 0;
            font-size: 29px;
        }

        .subtitle {
            margin-top: 7px;
            color: #64748b;
        }

        .grid {
            display: grid;
            grid-template-columns: 360px 1fr;
            gap: 22px;
        }

        .panel {
            background: rgba(15,23,42,.78);
            border: 1px solid rgba(255,255,255,.07);
            border-radius: 18px;
            padding: 24px;
        }

        .panel h2 {
            margin: 0 0 22px;
            font-size: 18px;
        }

        label {
            display: block;
            color: #94a3b8;
            font-size: 13px;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            border: 1px solid rgba(255,255,255,.09);
            background: #090f1d;
            color: white;
            padding: 13px 14px;
            border-radius: 10px;
            outline: none;
            margin-bottom: 17px;
        }

        input:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59,130,246,.10);
        }

        .btn {
            border: 0;
            cursor: pointer;
            padding: 11px 16px;
            border-radius: 9px;
            font-weight: 700;
        }

        .btn-primary {
            width: 100%;
            color: white;
            background: linear-gradient(135deg,#2563eb,#7c3aed);
        }

        .btn-edit {
            color: #93c5fd;
            background: rgba(59,130,246,.12);
        }

        .btn-delete {
            color: #fca5a5;
            background: rgba(239,68,68,.10);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            text-align: left;
            padding: 13px;
            color: #64748b;
            font-size: 11px;
            letter-spacing: .7px;
            border-bottom: 1px solid rgba(255,255,255,.07);
        }

        td {
            padding: 15px 13px;
            border-bottom: 1px solid rgba(255,255,255,.05);
            color: #cbd5e1;
        }

        .badge {
            display: inline-block;
            padding: 5px 9px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
        }

        .active {
            color: #86efac;
            background: rgba(34,197,94,.10);
        }

        .inactive {
            color: #fca5a5;
            background: rgba(239,68,68,.10);
        }

        .actions {
            display: flex;
            gap: 7px;
        }

        .alert {
            margin-bottom: 20px;
            padding: 13px 16px;
            border-radius: 10px;
        }

        .success {
            background: rgba(34,197,94,.10);
            border: 1px solid rgba(34,197,94,.18);
            color: #86efac;
        }

        .error {
            background: rgba(239,68,68,.10);
            border: 1px solid rgba(239,68,68,.18);
            color: #fca5a5;
        }

        .edit-box {
            margin-top: 12px;
            padding: 15px;
            background: #090f1d;
            border-radius: 12px;
        }

        @media(max-width:1000px) {
            .sidebar { display:none; }
            .main { margin-left:0; }
            .grid { grid-template-columns:1fr; }
        }
    </style>
</head>

<body>

<div class="layout">

    <aside class="sidebar">

        <div class="logo">Uni<span>Sched</span></div>

        <div class="nav-title">OVERVIEW</div>
        <a href="{{ route('admin.dashboard') }}" class="nav-item">Dashboard</a>

        <div class="nav-title">ACADEMIC</div>

        <a href="{{ route('admin.semesters.index') }}"
           class="nav-item active">
            Semesters
        </a>

        <a href="{{ route('admin.sections.index') }}"
           class="nav-item">
            Sections
        </a>

        <a href="#" class="nav-item">Courses</a>
        <a href="#" class="nav-item">Faculty</a>
        <a href="#" class="nav-item">Faculty Availability</a>

        <div class="nav-title">SCHEDULING</div>

        <a href="#" class="nav-item">Rooms</a>
        <a href="#" class="nav-item">Course Assignments</a>
        <a href="#" class="nav-item">Routine Builder</a>
        <a href="#" class="nav-item">Routine Views</a>

        <div class="nav-title">SYSTEM</div>
        <a href="#" class="nav-item">Admin Management</a>

    </aside>

    <main class="main">

        <div class="header">
            <div>
                <h1>Semester Management</h1>
                <div class="subtitle">
                    Configure academic semesters for UniSched.
                </div>
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
                {{ $errors->first() }}
            </div>
        @endif

        <div class="grid">

            <div class="panel">

                <h2>Add Semester</h2>

                <form method="POST"
                      action="{{ route('admin.semesters.store') }}">

                    @csrf

                    <label>Semester Number</label>

                    <input
                        type="number"
                        name="number"
                        min="1"
                        max="20"
                        placeholder="Example: 8"
                        required
                    >

                    <label>Semester Name</label>

                    <input
                        type="text"
                        name="name"
                        placeholder="Example: 8th Semester"
                        required
                    >

                    <button class="btn btn-primary">
                        Add Semester
                    </button>

                </form>

            </div>

            <div class="panel">

                <h2>Academic Semesters</h2>

                <table>

                    <thead>
                    <tr>
                        <th>NO.</th>
                        <th>SEMESTER</th>
                        <th>SECTIONS</th>
                        <th>STATUS</th>
                        <th>ACTIONS</th>
                    </tr>
                    </thead>

                    <tbody>

                    @forelse($semesters as $semester)

                        <tr>

                            <td>{{ $semester->number }}</td>

                            <td>
                                <strong>{{ $semester->name }}</strong>
                            </td>

                            <td>
                                {{ $semester->sections_count }}
                            </td>

                            <td>
                                @if($semester->is_active)
                                    <span class="badge active">ACTIVE</span>
                                @else
                                    <span class="badge inactive">INACTIVE</span>
                                @endif
                            </td>

                            <td>

                                <div class="actions">

                                    <button
                                        class="btn btn-edit"
                                        onclick="toggleEdit({{ $semester->id }})"
                                    >
                                        Edit
                                    </button>

                                    <form
                                        method="POST"
                                        action="{{ route('admin.semesters.destroy', $semester) }}"
                                        onsubmit="return confirm('Delete this semester?')"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-delete">
                                            Delete
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                        <tr
                            id="edit-{{ $semester->id }}"
                            style="display:none;"
                        >

                            <td colspan="5">

                                <div class="edit-box">

                                    <form
                                        method="POST"
                                        action="{{ route('admin.semesters.update', $semester) }}"
                                    >

                                        @csrf
                                        @method('PUT')

                                        <label>Semester Number</label>

                                        <input
                                            type="number"
                                            name="number"
                                            value="{{ $semester->number }}"
                                            required
                                        >

                                        <label>Semester Name</label>

                                        <input
                                            type="text"
                                            name="name"
                                            value="{{ $semester->name }}"
                                            required
                                        >

                                        <label>
                                            <input
                                                style="width:auto;"
                                                type="checkbox"
                                                name="is_active"
                                                value="1"
                                                {{ $semester->is_active ? 'checked' : '' }}
                                            >
                                            Active Semester
                                        </label>

                                        <button class="btn btn-primary">
                                            Save Changes
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="5">
                                No semesters found.
                            </td>
                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </main>

</div>

<script>
    function toggleEdit(id) {
        const row = document.getElementById('edit-' + id);

        if (row.style.display === 'none') {
            row.style.display = 'table-row';
        } else {
            row.style.display = 'none';
        }
    }
</script>

</body>
</html>