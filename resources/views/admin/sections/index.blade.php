<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Section Management | UniSched</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        * { box-sizing:border-box; }

        body {
            margin:0;
            font-family:Inter,Arial,sans-serif;
            background:#070b16;
            color:#f8fafc;
        }

        .layout {
            min-height:100vh;
            display:flex;
        }

        .sidebar {
            position:fixed;
            width:260px;
            min-height:100vh;
            padding:28px 20px;
            background:#0b1120;
            border-right:1px solid rgba(255,255,255,.07);
        }

        .logo {
            font-size:25px;
            font-weight:800;
            margin-bottom:38px;
        }

        .logo span { color:#60a5fa; }

        .nav-title {
            color:#64748b;
            font-size:11px;
            font-weight:700;
            letter-spacing:1.4px;
            margin:24px 10px 10px;
        }

        .nav-item {
            display:block;
            text-decoration:none;
            color:#94a3b8;
            padding:12px 14px;
            border-radius:10px;
            margin-bottom:5px;
        }

        .nav-item:hover,
        .nav-item.active {
            color:#93c5fd;
            background:rgba(59,130,246,.12);
        }

        .main {
            flex:1;
            margin-left:260px;
            padding:35px;
        }

        h1 {
            margin:0;
            font-size:29px;
        }

        .subtitle {
            color:#64748b;
            margin:7px 0 30px;
        }

        .grid {
            display:grid;
            grid-template-columns:360px 1fr;
            gap:22px;
        }

        .panel {
            background:rgba(15,23,42,.78);
            border:1px solid rgba(255,255,255,.07);
            border-radius:18px;
            padding:24px;
        }

        .panel h2 {
            margin:0 0 22px;
            font-size:18px;
        }

        label {
            display:block;
            color:#94a3b8;
            font-size:13px;
            margin-bottom:8px;
        }

        input,
        select {
            width:100%;
            background:#090f1d;
            border:1px solid rgba(255,255,255,.09);
            color:white;
            border-radius:10px;
            padding:13px;
            margin-bottom:17px;
            outline:none;
        }

        .btn {
            border:0;
            border-radius:9px;
            padding:11px 15px;
            cursor:pointer;
            font-weight:700;
        }

        .primary {
            width:100%;
            color:white;
            background:linear-gradient(135deg,#2563eb,#7c3aed);
        }

        .edit {
            color:#93c5fd;
            background:rgba(59,130,246,.12);
        }

        .delete {
            color:#fca5a5;
            background:rgba(239,68,68,.10);
        }

        table {
            width:100%;
            border-collapse:collapse;
        }

        th {
            padding:13px;
            text-align:left;
            color:#64748b;
            font-size:11px;
            border-bottom:1px solid rgba(255,255,255,.07);
        }

        td {
            padding:14px 13px;
            color:#cbd5e1;
            border-bottom:1px solid rgba(255,255,255,.05);
        }

        .badge {
            display:inline-block;
            padding:5px 9px;
            border-radius:20px;
            font-size:11px;
            font-weight:700;
        }

        .active {
            color:#86efac;
            background:rgba(34,197,94,.10);
        }

        .inactive {
            color:#fca5a5;
            background:rgba(239,68,68,.10);
        }

        .actions {
            display:flex;
            gap:7px;
        }

        .alert {
            margin-bottom:20px;
            padding:13px 16px;
            border-radius:10px;
        }

        .success {
            color:#86efac;
            background:rgba(34,197,94,.10);
        }

        .error {
            color:#fca5a5;
            background:rgba(239,68,68,.10);
        }

        .filter {
            display:flex;
            gap:10px;
            margin-bottom:20px;
        }

        .filter select {
            margin:0;
            max-width:260px;
        }

        .filter button {
            color:white;
            background:#1e293b;
        }

        .edit-area {
            padding:15px;
            background:#090f1d;
            border-radius:12px;
        }

        @media(max-width:1000px) {
            .sidebar { display:none; }
            .main { margin-left:0; }
            .grid { grid-template-columns:1fr; }
        }
    </style>
    @include('admin.partials.navigation-styles')
</head>

<body>

@include('admin.partials.mobile-navigation')

<div class="layout">

    @include('admin.partials.sidebar')

    <main class="main">

        <h1>Section Management</h1>

        <div class="subtitle">
            Create and organize sections under each semester.
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

                <h2>Add Section</h2>

                <form
                    method="POST"
                    action="{{ route('admin.sections.store') }}"
                >

                    @csrf

                    <label>Semester</label>

                    <select name="semester_id" required>

                        <option value="">
                            Select Semester
                        </option>

                        @foreach($semesters as $semester)

                            <option value="{{ $semester->id }}">
                                {{ $semester->name }}
                            </option>

                        @endforeach

                    </select>

                    <label>Section Name</label>

                    <input
                        type="text"
                        name="name"
                        placeholder="Example: A"
                        required
                    >

                    <label>Section Code</label>

                    <input
                        type="text"
                        name="code"
                        placeholder="Example: 8A"
                        required
                    >

                    <button class="btn primary">
                        Add Section
                    </button>

                </form>

            </div>

            <div class="panel">

                <h2>Sections</h2>

                <form
                    method="GET"
                    action="{{ route('admin.sections.index') }}"
                    class="filter"
                >

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

                    <button class="btn">
                        Filter
                    </button>

                </form>

                <table>

                    <thead>
                    <tr>
                        <th>SEMESTER</th>
                        <th>SECTION</th>
                        <th>CODE</th>
                        <th>STATUS</th>
                        <th>ACTIONS</th>
                    </tr>
                    </thead>

                    <tbody>

                    @forelse($sections as $section)

                        <tr>

                            <td>
                                {{ $section->semester->name }}
                            </td>

                            <td>
                                {{ $section->name }}
                            </td>

                            <td>
                                <strong>
                                    {{ $section->code }}
                                </strong>
                            </td>

                            <td>

                                @if($section->is_active)

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
                                        class="btn edit"
                                        onclick="toggleSection({{ $section->id }})"
                                    >
                                        Edit
                                    </button>

                                    <form
                                        method="POST"
                                        action="{{ route('admin.sections.destroy', $section) }}"
                                        onsubmit="return confirm('Delete this section?')"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button class="btn delete">
                                            Delete
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                        <tr
                            id="section-edit-{{ $section->id }}"
                            style="display:none;"
                        >

                            <td colspan="5">

                                <div class="edit-area">

                                    <form
                                        method="POST"
                                        action="{{ route('admin.sections.update', $section) }}"
                                    >

                                        @csrf
                                        @method('PUT')

                                        <label>Semester</label>

                                        <select
                                            name="semester_id"
                                            required
                                        >

                                            @foreach($semesters as $semester)

                                                <option
                                                    value="{{ $semester->id }}"
                                                    {{ $section->semester_id == $semester->id ? 'selected' : '' }}
                                                >
                                                    {{ $semester->name }}
                                                </option>

                                            @endforeach

                                        </select>

                                        <label>Section Name</label>

                                        <input
                                            type="text"
                                            name="name"
                                            value="{{ $section->name }}"
                                            required
                                        >

                                        <label>Section Code</label>

                                        <input
                                            type="text"
                                            name="code"
                                            value="{{ $section->code }}"
                                            required
                                        >

                                        <label>
                                            <input
                                                style="width:auto;"
                                                type="checkbox"
                                                name="is_active"
                                                value="1"
                                                {{ $section->is_active ? 'checked' : '' }}
                                            >

                                            Active Section
                                        </label>

                                        <button class="btn primary">
                                            Save Changes
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="5">
                                No sections found.
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
    function toggleSection(id) {
        const row = document.getElementById(
            'section-edit-' + id
        );

        row.style.display =
            row.style.display === 'none'
                ? 'table-row'
                : 'none';
    }
</script>

</body>
</html>