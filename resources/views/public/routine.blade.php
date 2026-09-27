<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Student Routine | UniSched</title>

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
                    circle at 90% 5%,
                    rgba(37,99,235,.15),
                    transparent 27%
                ),
                radial-gradient(
                    circle at 5% 95%,
                    rgba(124,58,237,.11),
                    transparent 26%
                ),
                #060a14;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        .navbar {
            width:
                min(1500px, calc(100% - 45px));

            margin: auto;

            padding: 22px 0;

            display: flex;

            align-items: center;
            justify-content: space-between;

            gap: 20px;
        }

        .brand {
            display: flex;

            align-items: center;

            gap: 11px;
        }

        .logo {
            width: 41px;
            height: 41px;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 12px;

            background:
                linear-gradient(
                    135deg,
                    #2563eb,
                    #7c3aed
                );

            font-size: 11px;
            font-weight: 900;
        }

        .brand-name {
            font-size: 21px;
            font-weight: 900;
        }

        .brand-name span {
            color: #60a5fa;
        }

        .brand-sub {
            margin-top: 2px;

            color: #64748b;

            font-size: 8px;
        }

        .nav-actions {
            display: flex;

            gap: 8px;
        }

        .nav-button {
            padding: 9px 13px;

            border-radius: 9px;

            color: #94a3b8;

            background:
                rgba(255,255,255,.03);

            border:
                1px solid rgba(255,255,255,.06);

            font-size: 9px;
            font-weight: 900;
        }

        .container {
            width:
                min(1500px, calc(100% - 45px));

            margin: auto;

            padding:
                45px 0
                70px;
        }

        .header {
            text-align: center;

            margin-bottom: 30px;
        }

        .header-label {
            display: inline-block;

            padding: 6px 10px;

            margin-bottom: 12px;

            border-radius: 20px;

            color: #93c5fd;

            background:
                rgba(59,130,246,.07);

            border:
                1px solid rgba(59,130,246,.12);

            font-size: 8px;
            font-weight: 900;

            letter-spacing: 1.2px;
        }

        .header h1 {
            margin: 0;

            font-size:
                clamp(30px, 4vw, 48px);

            font-weight: 900;
        }

        .header p {
            max-width: 620px;

            margin:
                10px auto
                0;

            color: #64748b;

            font-size: 11px;

            line-height: 1.7;
        }

        .filter-card {
            max-width: 900px;

            margin:
                0 auto
                30px;

            padding: 20px;

            border-radius: 17px;

            background:
                rgba(15,23,42,.78);

            border:
                1px solid rgba(255,255,255,.06);

            box-shadow:
                0 20px 60px
                rgba(0,0,0,.15);
        }

        .filter-grid {
            display: grid;

            grid-template-columns:
                1fr
                1fr
                auto;

            gap: 10px;

            align-items: end;
        }

        .form-group label {
            display: block;

            margin-bottom: 7px;

            color: #64748b;

            font-size: 8px;
            font-weight: 900;

            letter-spacing: .7px;
        }

        select {
            width: 100%;

            padding: 12px;

            border:
                1px solid rgba(255,255,255,.08);

            border-radius: 9px;

            outline: none;

            color: #e2e8f0;

            background: #090f1c;
        }

        select:focus {
            border-color:
                rgba(59,130,246,.4);
        }

        select option {
            background: #0f172a;
        }

        .view-button {
            min-height: 43px;

            padding: 0 18px;

            border: 0;

            border-radius: 9px;

            cursor: pointer;

            color: white;

            background:
                linear-gradient(
                    135deg,
                    #2563eb,
                    #7c3aed
                );

            font-size: 9px;
            font-weight: 900;
        }

        .routine-heading {
            display: flex;

            align-items: flex-end;
            justify-content: space-between;

            gap: 15px;

            margin-bottom: 13px;
        }

        .routine-heading h2 {
            margin: 0;

            font-size: 19px;
        }

        .routine-heading p {
            margin: 5px 0 0;

            color: #64748b;

            font-size: 9px;
        }

        .published-badge {
            padding: 7px 10px;

            border-radius: 20px;

            color: #86efac;

            background:
                rgba(34,197,94,.07);

            border:
                1px solid rgba(34,197,94,.12);

            font-size: 8px;
            font-weight: 900;
        }

        .routine-card {
            padding: 15px;

            border-radius: 17px;

            background:
                rgba(15,23,42,.76);

            border:
                1px solid rgba(255,255,255,.055);

            overflow-x: auto;
        }

        table {
            width: 100%;

            min-width: 1100px;

            border-collapse: separate;

            border-spacing: 5px;

            table-layout: fixed;
        }

        th {
            padding: 10px 5px;

            color: #64748b;

            background:
                rgba(255,255,255,.025);

            border-radius: 7px;

            font-size: 8px;
            font-weight: 900;
        }

        th:first-child {
            width: 85px;
        }

        td {
            padding: 5px;

            vertical-align: top;

            background:
                rgba(255,255,255,.016);

            border-radius: 8px;
        }

        .day {
            vertical-align: middle;

            text-align: center;

            color: #94a3b8;

            background:
                rgba(255,255,255,.025);

            font-size: 9px;
            font-weight: 900;
        }

        .class-card {
            min-height: 94px;

            padding: 9px;

            margin-bottom: 5px;

            border-radius: 8px;

            background:
                linear-gradient(
                    145deg,
                    rgba(37,99,235,.10),
                    rgba(124,58,237,.05)
                );

            border:
                1px solid rgba(96,165,250,.09);
        }

        .class-card:last-child {
            margin-bottom: 0;
        }

        .course-code {
            color: #93c5fd;

            font-size: 9px;
            font-weight: 900;
        }

        .course-name {
            margin-top: 4px;

            color: #cbd5e1;

            font-size: 7px;

            line-height: 1.35;
        }

        .class-details {
            display: flex;

            flex-wrap: wrap;

            gap: 4px;

            margin-top: 8px;
        }

        .tag {
            padding: 4px 6px;

            border-radius: 10px;

            color: #94a3b8;

            background:
                rgba(255,255,255,.035);

            font-size: 6.5px;
        }

        .empty-slot {
            min-height: 94px;

            display: flex;

            align-items: center;
            justify-content: center;

            color: #334155;

            font-size: 10px;
        }

        .empty-state {
            max-width: 700px;

            margin: 20px auto;

            padding: 45px 20px;

            border-radius: 16px;

            text-align: center;

            color: #64748b;

            background:
                rgba(15,23,42,.65);

            border:
                1px solid rgba(255,255,255,.05);
        }

        .empty-icon {
            width: 50px;
            height: 50px;

            margin:
                0 auto
                14px;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 14px;

            color: #60a5fa;

            background:
                rgba(59,130,246,.07);

            font-weight: 900;
        }

        .empty-title {
            color: #cbd5e1;

            font-size: 13px;
            font-weight: 900;
        }

        .empty-text {
            margin-top: 6px;

            font-size: 9px;

            line-height: 1.6;
        }

        .print-button {
            display: inline-flex;

            margin-top: 15px;

            padding: 10px 14px;

            border: 0;

            border-radius: 9px;

            cursor: pointer;

            color: #bfdbfe;

            background:
                rgba(59,130,246,.08);

            border:
                1px solid rgba(59,130,246,.12);

            font-size: 8px;
            font-weight: 900;
        }

        .footer {
            padding:
                20px 0
                30px;

            text-align: center;

            color: #334155;

            font-size: 8px;
        }


        /*
        |--------------------------------------------------------------------------
        | Print
        |--------------------------------------------------------------------------
        */

        @media print {

            @page {
                size: A4 landscape;
                margin: 8mm;
            }

            body {
                color: #111827;
                background: white;

                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .navbar,
            .header,
            .filter-card,
            .print-button,
            .footer {
                display: none !important;
            }

            .container {
                width: 100%;
                padding: 0;
            }

            .routine-heading {
                margin-bottom: 8px;
            }

            .routine-heading h2 {
                color: #111827;
            }

            .routine-heading p {
                color: #4b5563;
            }

            .published-badge {
                color: #166534;
                border-color: #86efac;
            }

            .routine-card {
                padding: 0;

                border: 0;

                background: white;
            }

            table {
                min-width: 0;

                border-collapse: collapse;

                border-spacing: 0;
            }

            th,
            td {
                border: 1px solid #9ca3af;

                border-radius: 0;

                background: white;
            }

            th {
                color: #111827;
            }

            .day {
                color: #111827;

                background: #f3f4f6;
            }

            .class-card {
                min-height: 0;

                color: #111827;

                background: #f8fafc;

                border-color: #d1d5db;
            }

            .course-code,
            .course-name,
            .tag {
                color: #111827;
            }

            .tag {
                border: 1px solid #e5e7eb;
            }

            .empty-slot {
                min-height: 50px;
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Responsive
        |--------------------------------------------------------------------------
        */

        @media(max-width:750px) {

            .container,
            .navbar {
                width:
                    min(100% - 26px, 1500px);
            }

            .filter-grid {
                grid-template-columns: 1fr;
            }

            .routine-heading {
                align-items: flex-start;

                flex-direction: column;
            }

            .brand-sub {
                display: none;
            }
        }

    </style>

</head>

<body>


<!-- =========================================================
     NAVBAR
========================================================== -->

<nav class="navbar">

    <a
        href="{{ route('home') }}"
        class="brand"
    >

        <div class="logo">
            US
        </div>

        <div>

            <div class="brand-name">
                Uni<span>Sched</span>
            </div>

            <div class="brand-sub">
                STUDENT ROUTINE PORTAL
            </div>

        </div>

    </a>


    <div class="nav-actions">

        <a
            href="{{ route('home') }}"
            class="nav-button"
        >
            Home
        </a>

        <a
            href="{{ route('admin.login') }}"
            class="nav-button"
        >
            Admin Login
        </a>

    </div>

</nav>


<main class="container">


    <!-- =====================================================
         HEADER
    ====================================================== -->

    <header class="header">

        <div class="header-label">
            OFFICIAL PUBLISHED ROUTINE
        </div>

        <h1>
            Student Routine
        </h1>

        <p>

            Select your semester and section to view your
            officially published weekly academic routine.

        </p>

    </header>


    <!-- =====================================================
         FILTER
    ====================================================== -->

    <section class="filter-card">

        <form
            method="GET"
            action="{{ route('public.routine') }}"
            id="routineFilter"
        >

            <div class="filter-grid">


                <div class="form-group">

                    <label>
                        SEMESTER
                    </label>

                    <select
                        name="semester_id"
                        id="semesterSelect"
                        onchange="semesterChanged()"
                        required
                    >

                        <option value="">
                            Select Semester
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

                    <select
                        name="section_id"
                        id="sectionSelect"
                        {{ !$selectedSemester ? 'disabled' : '' }}
                        required
                    >

                        <option value="">
                            Select Section
                        </option>

                        @foreach($sections as $section)

                            <option
                                value="{{ $section->id }}"
                                {{ (string) request('section_id') === (string) $section->id ? 'selected' : '' }}
                            >

                                {{ $section->code }}

                                @if($section->name !== $section->code)
                                    — {{ $section->name }}
                                @endif

                            </option>

                        @endforeach

                    </select>

                </div>


                <button
                    type="submit"
                    class="view-button"
                >
                    View Routine
                </button>

            </div>

        </form>

    </section>


    <!-- =====================================================
         ROUTINE
    ====================================================== -->

    @if($selectedSemester && $selectedSection)


        <div class="routine-heading">

            <div>

                <h2>

                    {{ $selectedSemester->name }}

                    —

                    Section
                    {{ $selectedSection->code }}

                </h2>

                <p>

                    Weekly academic schedule ·
                    Saturday to Thursday

                </p>

            </div>


            <span class="published-badge">
                PUBLISHED ROUTINE
            </span>

        </div>


        @if($routines->count())


            <section class="routine-card">

                <table>

                    <thead>

                    <tr>

                        <th>
                            DAY
                        </th>

                        @foreach($timeSlots as $slot)

                            <th>

                                {{ \Carbon\Carbon::parse(
                                    $slot->start_time
                                )->format('g:i A') }}

                                <br>

                                —

                                <br>

                                {{ \Carbon\Carbon::parse(
                                    $slot->end_time
                                )->format('g:i A') }}

                            </th>

                        @endforeach

                    </tr>

                    </thead>


                    <tbody>

                    @foreach($days as $day)

                        <tr>

                            <td class="day">
                                {{ $day }}
                            </td>


                            @foreach($timeSlots as $slot)

                                <td>

                                    @php

                                        $classes =
                                            $routineMap[$day][$slot->id]
                                            ?? [];

                                    @endphp


                                    @forelse($classes as $routine)

                                        <div class="class-card">


                                            <div class="course-code">

                                                {{ $routine->courseAssignment->course->course_code }}

                                            </div>


                                            <div class="course-name">

                                                {{ $routine->courseAssignment->course->course_name }}

                                            </div>


                                            <div class="class-details">


                                                <span class="tag">

                                                    Faculty:
                                                    {{ $routine->teacher->initial }}

                                                </span>


                                                <span class="tag">

                                                    Room:
                                                    {{ $routine->room->room_number }}

                                                </span>


                                                @if(
                                                    $routine->courseAssignment->course->course_type === 'lab'
                                                )

                                                    <span class="tag">
                                                        LAB
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

            </section>


            <button
                type="button"
                class="print-button"
                onclick="window.print()"
            >
                Print / Save as PDF
            </button>


        @else


            <section class="empty-state">

                <div class="empty-icon">
                    !
                </div>

                <div class="empty-title">
                    Routine Not Published Yet
                </div>

                <div class="empty-text">

                    There is currently no published routine
                    available for

                    {{ $selectedSemester->name }}

                    —

                    Section

                    {{ $selectedSection->code }}.

                </div>

            </section>


        @endif


    @else


        <section class="empty-state">

            <div class="empty-icon">
                US
            </div>

            <div class="empty-title">
                Select Your Academic Information
            </div>

            <div class="empty-text">

                Choose your semester first, then select your
                section to access the official published routine.

            </div>

        </section>


    @endif


</main>


<footer class="footer">

    UniSched · Intelligent Academic Scheduling System

</footer>


<script>

    function semesterChanged() {

        const form =
            document.getElementById(
                'routineFilter'
            );

        const section =
            document.getElementById(
                'sectionSelect'
            );

        if (section) {
            section.value = '';
        }

        form.submit();
    }

</script>


</body>

</html>