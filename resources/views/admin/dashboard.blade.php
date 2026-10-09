<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Admin Dashboard | UniSched</title>

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
                    circle at 90% 3%,
                    rgba(37,99,235,.16),
                    transparent 27%
                ),
                radial-gradient(
                    circle at 4% 96%,
                    rgba(124,58,237,.11),
                    transparent 27%
                ),
                #070b16;
        }

        button,
        input,
        select {
            font-family: inherit;
        }

        .layout {
            display: flex;

            min-height: 100vh;
        }


        /*
        |--------------------------------------------------------------------------
        | Sidebar
        |--------------------------------------------------------------------------
        */

        .sidebar {
            position: fixed;

            top: 0;
            left: 0;

            width: 275px;
            height: 100vh;

            padding: 27px 19px;

            overflow-y: auto;

            background:
                rgba(9,15,29,.98);

            border-right:
                1px solid rgba(255,255,255,.065);

            z-index: 100;
        }

        .brand {
            display: flex;

            align-items: center;

            gap: 12px;

            padding: 0 8px;

            margin-bottom: 34px;
        }

        .brand-icon {
            position: relative;

            width: 45px;
            height: 45px;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 14px;

            background:
                linear-gradient(
                    135deg,
                    #2563eb,
                    #7c3aed
                );

            font-size: 13px;
            font-weight: 900;

            box-shadow:
                0 12px 35px
                rgba(37,99,235,.20);
        }

        .brand-icon::after {
            content: "";

            position: absolute;

            inset: -4px;

            border:
                1px solid rgba(96,165,250,.13);

            border-radius: 17px;
        }

        .brand-name {
            font-size: 23px;
            font-weight: 900;
        }

        .brand-name span {
            color: #60a5fa;
        }

        .brand-subtitle {
            margin-top: 2px;

            color: #64748b;

            font-size: 9px;
        }

        .nav-title {
            margin:
                24px
                10px
                9px;

            color: #475569;

            font-size: 9px;
            font-weight: 900;

            letter-spacing: 1.6px;
        }

        .nav-item {
            display: flex;

            align-items: center;

            gap: 11px;

            padding: 11px 13px;

            margin-bottom: 4px;

            border-radius: 10px;

            color: #94a3b8;

            text-decoration: none;

            font-size: 13px;

            transition: .2s ease;
        }

        .nav-item:hover {
            color: #dbeafe;

            background:
                rgba(59,130,246,.07);

            transform:
                translateX(2px);
        }

        .nav-item.active {
            color: #dbeafe;

            background:
                linear-gradient(
                    90deg,
                    rgba(37,99,235,.19),
                    rgba(124,58,237,.07)
                );

            border:
                1px solid rgba(59,130,246,.13);
        }

        .nav-icon {
            width: 21px;

            text-align: center;

            font-size: 12px;
            font-weight: 900;
        }

        .sidebar-bottom {
            margin-top: 28px;

            padding-top: 17px;

            border-top:
                1px solid rgba(255,255,255,.055);
        }

        .admin-card {
            padding: 12px;

            margin-bottom: 10px;

            border-radius: 11px;

            background:
                rgba(15,23,42,.70);

            border:
                1px solid rgba(255,255,255,.05);
        }

        .admin-name {
            color: #e2e8f0;

            font-size: 11px;
            font-weight: 800;
        }

        .admin-email {
            margin-top: 4px;

            overflow: hidden;

            color: #64748b;

            font-size: 9px;

            text-overflow: ellipsis;

            white-space: nowrap;
        }

        .logout-button {
            width: 100%;

            padding: 10px;

            border: 0;

            border-radius: 9px;

            color: #fca5a5;

            background:
                rgba(239,68,68,.07);

            cursor: pointer;

            font-size: 10px;
            font-weight: 800;

            transition: .2s;
        }

        .logout-button:hover {
            background:
                rgba(239,68,68,.13);
        }


        /*
        |--------------------------------------------------------------------------
        | Main
        |--------------------------------------------------------------------------
        */

        .main {
            flex: 1;

            margin-left: 275px;

            padding:
                34px
                37px
                60px;
        }

        .topbar {
            display: flex;

            align-items: center;
            justify-content: space-between;

            gap: 20px;

            margin-bottom: 26px;
        }

        .topbar h1 {
            margin: 0;

            font-size: 30px;
            font-weight: 900;
        }

        .topbar p {
            margin: 7px 0 0;

            color: #64748b;

            font-size: 12px;
        }

        .system-status {
            display: flex;

            align-items: center;

            gap: 7px;

            padding: 9px 13px;

            border-radius: 20px;

            color: #86efac;

            background:
                rgba(34,197,94,.07);

            border:
                1px solid rgba(34,197,94,.13);

            font-size: 9px;
            font-weight: 900;
        }

        .status-dot {
            width: 6px;
            height: 6px;

            border-radius: 50%;

            background: #22c55e;

            box-shadow:
                0 0 12px
                rgba(34,197,94,.8);
        }


        /*
        |--------------------------------------------------------------------------
        | Hero
        |--------------------------------------------------------------------------
        */

        .hero {
            position: relative;

            overflow: hidden;

            display: grid;

            grid-template-columns:
                1.5fr
                .8fr;

            gap: 25px;

            padding: 27px;

            margin-bottom: 20px;

            border-radius: 20px;

            background:
                linear-gradient(
                    135deg,
                    rgba(37,99,235,.13),
                    rgba(124,58,237,.08)
                );

            border:
                1px solid rgba(96,165,250,.11);
        }

        .hero::before {
            content: "";

            position: absolute;

            width: 270px;
            height: 270px;

            right: -90px;
            top: -130px;

            border-radius: 50%;

            background:
                rgba(37,99,235,.09);

            filter: blur(5px);
        }

        .hero-label {
            color: #60a5fa;

            font-size: 9px;
            font-weight: 900;

            letter-spacing: 1.7px;
        }

        .hero h2 {
            margin:
                10px 0
                8px;

            max-width: 680px;

            font-size: 26px;
            line-height: 1.25;
        }

        .hero-description {
            max-width: 700px;

            color: #94a3b8;

            font-size: 11px;

            line-height: 1.7;
        }

        .hero-actions {
            display: flex;

            flex-wrap: wrap;

            gap: 8px;

            margin-top: 18px;
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

            font-size: 9px;
            font-weight: 900;

            transition: .2s;
        }

        .btn:hover {
            transform:
                translateY(-1px);
        }

        .btn-primary {
            color: white;

            background:
                linear-gradient(
                    135deg,
                    #2563eb,
                    #7c3aed
                );
        }

        .btn-secondary {
            color: #bfdbfe;

            background:
                rgba(59,130,246,.08);

            border:
                1px solid rgba(59,130,246,.12);
        }

        .hero-progress {
            position: relative;

            z-index: 2;

            display: flex;

            align-items: center;
            justify-content: center;

            flex-direction: column;

            min-height: 175px;

            border-radius: 16px;

            background:
                rgba(2,6,23,.27);

            border:
                1px solid rgba(255,255,255,.05);
        }

        .progress-circle {
            position: relative;

            width: 110px;
            height: 110px;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 50%;

            background:
                conic-gradient(
                    #3b82f6
                    {{ $publicationPercentage }}%,
                    rgba(255,255,255,.06)
                    0
                );
        }

        .progress-circle::before {
            content: "";

            position: absolute;

            inset: 8px;

            border-radius: 50%;

            background: #0b1220;
        }

        .progress-value {
            position: relative;

            z-index: 2;

            font-size: 23px;
            font-weight: 900;
        }

        .progress-label {
            margin-top: 10px;

            color: #64748b;

            font-size: 8px;
            font-weight: 900;

            letter-spacing: 1px;
        }


        /*
        |--------------------------------------------------------------------------
        | Statistics
        |--------------------------------------------------------------------------
        */

        .stats {
            display: grid;

            grid-template-columns:
                repeat(5,1fr);

            gap: 11px;

            margin-bottom: 20px;
        }

        .stat-card {
            padding: 17px;

            border-radius: 14px;

            background:
                rgba(15,23,42,.75);

            border:
                1px solid rgba(255,255,255,.055);

            transition: .2s;
        }

        .stat-card:hover {
            transform:
                translateY(-2px);

            border-color:
                rgba(59,130,246,.14);
        }

        .stat-top {
            display: flex;

            justify-content: space-between;

            align-items: center;

            gap: 10px;
        }

        .stat-icon {
            width: 31px;
            height: 31px;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 9px;

            color: #93c5fd;

            background:
                rgba(59,130,246,.08);

            font-size: 10px;
            font-weight: 900;
        }

        .stat-value {
            margin-top: 12px;

            font-size: 24px;
            font-weight: 900;
        }

        .stat-label {
            margin-top: 4px;

            color: #64748b;

            font-size: 8px;
            font-weight: 900;

            letter-spacing: .8px;
        }

        .active-count {
            margin-top: 7px;

            color: #86efac;

            font-size: 8px;
        }


        /*
        |--------------------------------------------------------------------------
        | Quick Actions
        |--------------------------------------------------------------------------
        */

        .section-title {
            display: flex;

            align-items: center;
            justify-content: space-between;

            gap: 10px;

            margin-bottom: 13px;
        }

        .section-title h3 {
            margin: 0;

            font-size: 16px;
        }

        .section-title span {
            color: #475569;

            font-size: 9px;
        }

        .quick-grid {
            display: grid;

            grid-template-columns:
                repeat(4,1fr);

            gap: 10px;

            margin-bottom: 20px;
        }

        .quick-card {
            position: relative;

            overflow: hidden;

            min-height: 110px;

            padding: 17px;

            border-radius: 14px;

            color: inherit;

            text-decoration: none;

            background:
                rgba(15,23,42,.72);

            border:
                1px solid rgba(255,255,255,.055);

            transition: .2s;
        }

        .quick-card:hover {
            transform:
                translateY(-2px);

            border-color:
                rgba(59,130,246,.16);

            background:
                rgba(15,23,42,.90);
        }

        .quick-icon {
            width: 34px;
            height: 34px;

            display: flex;

            align-items: center;
            justify-content: center;

            margin-bottom: 12px;

            border-radius: 9px;

            color: #bfdbfe;

            background:
                rgba(59,130,246,.09);

            font-size: 11px;
            font-weight: 900;
        }

        .quick-title {
            font-size: 11px;
            font-weight: 900;
        }

        .quick-description {
            margin-top: 5px;

            color: #64748b;

            font-size: 8px;

            line-height: 1.5;
        }


        /*
        |--------------------------------------------------------------------------
        | Content Grid
        |--------------------------------------------------------------------------
        */

        .content-grid {
            display: grid;

            grid-template-columns:
                1.45fr
                .75fr;

            gap: 18px;
        }

        .panel {
            padding: 19px;

            border-radius: 16px;

            background:
                rgba(15,23,42,.74);

            border:
                1px solid rgba(255,255,255,.055);
        }

        .panel-header {
            display: flex;

            align-items: center;
            justify-content: space-between;

            gap: 12px;

            margin-bottom: 15px;
        }

        .panel-header h3 {
            margin: 0;

            font-size: 14px;
        }

        .panel-header a {
            color: #60a5fa;

            text-decoration: none;

            font-size: 8px;
            font-weight: 900;
        }

        .routine-row {
            display: grid;

            grid-template-columns:
                1.1fr
                .8fr
                .7fr
                .7fr
                .6fr;

            gap: 9px;

            align-items: center;

            padding: 11px 5px;

            border-bottom:
                1px solid rgba(255,255,255,.045);
        }

        .routine-row:last-child {
            border-bottom: 0;
        }

        .course-code {
            color: #93c5fd;

            font-size: 10px;
            font-weight: 900;
        }

        .small {
            margin-top: 3px;

            color: #64748b;

            font-size: 8px;
        }

        .info {
            color: #cbd5e1;

            font-size: 9px;
        }

        .badge {
            display: inline-block;

            padding: 5px 7px;

            border-radius: 15px;

            font-size: 7px;
            font-weight: 900;
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

        .assignment {
            padding: 11px 0;

            border-bottom:
                1px solid rgba(255,255,255,.045);
        }

        .assignment:last-child {
            border-bottom: 0;
        }

        .assignment-course {
            color: #bfdbfe;

            font-size: 10px;
            font-weight: 900;
        }

        .assignment-details {
            display: flex;

            flex-wrap: wrap;

            gap: 5px;

            margin-top: 7px;
        }

        .mini-tag {
            padding: 4px 6px;

            border-radius: 12px;

            color: #94a3b8;

            background:
                rgba(100,116,139,.09);

            font-size: 7px;
        }

        .empty {
            padding: 35px 10px;

            text-align: center;

            color: #475569;

            font-size: 10px;
        }


        /*
        |--------------------------------------------------------------------------
        | Responsive
        |--------------------------------------------------------------------------
        */

        @media(max-width:1250px) {

            .stats {
                grid-template-columns:
                    repeat(3,1fr);
            }

            .quick-grid {
                grid-template-columns:
                    repeat(2,1fr);
            }
        }

        @media(max-width:1000px) {

            .content-grid,
            .hero {
                grid-template-columns: 1fr;
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

            .topbar {
                align-items: flex-start;

                flex-direction: column;
            }
        }

        @media(max-width:650px) {

            .stats,
            .quick-grid {
                grid-template-columns: 1fr;
            }

            .routine-row {
                grid-template-columns: 1fr;

                gap: 5px;

                padding: 14px 5px;
            }

            .hero {
                padding: 20px;
            }
        }

    </style>

    @include('admin.partials.navigation-styles')
</head>

<body>

@include('admin.partials.mobile-navigation')


<div class="layout">


    <!-- =========================================================
         SIDEBAR
    ========================================================== -->

    @include('admin.partials.sidebar')


    <!-- =========================================================
         MAIN
    ========================================================== -->

    <main class="main">


        <div class="topbar">

            <div>

                <h1>
                    Dashboard
                </h1>

                <p>
                    Manage academic resources, build conflict-free schedules and publish university routines.
                </p>

            </div>


            <div class="system-status">

                <span class="status-dot"></span>

                SYSTEM ACTIVE

            </div>

        </div>


        <!-- =====================================================
             HERO
        ====================================================== -->

        <section class="hero">

            <div>

                <div class="hero-label">
                    INTELLIGENT SCHEDULING CONTROL CENTER
                </div>

                <h2>
                    Build and manage conflict-free academic routines.
                </h2>

                <div class="hero-description">

                    UniSched connects semesters, sections, courses,
                    faculty availability, rooms, labs and time slots
                    into one academic scheduling workflow.

                </div>


                <div class="hero-actions">

                    <a
                        href="{{ route('admin.routines.index') }}"
                        class="btn btn-primary"
                    >
                        Build Routine
                    </a>

                    <a
                        href="{{ route('admin.routine-views.index') }}"
                        class="btn btn-secondary"
                    >
                        View Routine
                    </a>

                    <a
                        href="{{ route('admin.routine-publish.index') }}"
                        class="btn btn-secondary"
                    >
                        Publish Routine
                    </a>

                    <a
                        href="{{ route('admin.routine-export.print', ['type' => 'master']) }}"
                        target="_blank"
                        class="btn btn-secondary"
                    >
                        Print Master Routine
                    </a>

                </div>

            </div>


            <div class="hero-progress">

                <div class="progress-circle">

                    <div class="progress-value">
                        {{ $publicationPercentage }}%
                    </div>

                </div>

                <div class="progress-label">
                    ROUTINE PUBLISHED
                </div>

            </div>

        </section>


        <!-- =====================================================
             STATS
        ====================================================== -->

        <section class="stats">

            <div class="stat-card">

                <div class="stat-top">

                    <div class="stat-icon">
                        S
                    </div>

                </div>

                <div class="stat-value">
                    {{ $stats['semesters'] }}
                </div>

                <div class="stat-label">
                    SEMESTERS
                </div>

                <div class="active-count">
                    {{ $activeStats['semesters'] }} active
                </div>

            </div>


            <div class="stat-card">

                <div class="stat-top">

                    <div class="stat-icon">
                        §
                    </div>

                </div>

                <div class="stat-value">
                    {{ $stats['sections'] }}
                </div>

                <div class="stat-label">
                    SECTIONS
                </div>

                <div class="active-count">
                    {{ $activeStats['sections'] }} active
                </div>

            </div>


            <div class="stat-card">

                <div class="stat-top">

                    <div class="stat-icon">
                        C
                    </div>

                </div>

                <div class="stat-value">
                    {{ $stats['courses'] }}
                </div>

                <div class="stat-label">
                    COURSES
                </div>

                <div class="active-count">
                    {{ $activeStats['courses'] }} active
                </div>

            </div>


            <div class="stat-card">

                <div class="stat-top">

                    <div class="stat-icon">
                        F
                    </div>

                </div>

                <div class="stat-value">
                    {{ $stats['teachers'] }}
                </div>

                <div class="stat-label">
                    FACULTY
                </div>

                <div class="active-count">
                    {{ $activeStats['teachers'] }} active
                </div>

            </div>


            <div class="stat-card">

                <div class="stat-top">

                    <div class="stat-icon">
                        R
                    </div>

                </div>

                <div class="stat-value">
                    {{ $stats['rooms'] }}
                </div>

                <div class="stat-label">
                    ROOMS / LABS
                </div>

                <div class="active-count">
                    {{ $activeStats['rooms'] }} active
                </div>

            </div>


            <div class="stat-card">

                <div class="stat-top">

                    <div class="stat-icon">
                        T
                    </div>

                </div>

                <div class="stat-value">
                    {{ $stats['time_slots'] }}
                </div>

                <div class="stat-label">
                    TIME SLOTS
                </div>

                <div class="active-count">
                    {{ $activeStats['time_slots'] }} active
                </div>

            </div>


            <div class="stat-card">

                <div class="stat-top">

                    <div class="stat-icon">
                        ↔
                    </div>

                </div>

                <div class="stat-value">
                    {{ $stats['assignments'] }}
                </div>

                <div class="stat-label">
                    COURSE ASSIGNMENTS
                </div>

                <div class="active-count">
                    {{ $activeStats['assignments'] }} active
                </div>

            </div>


            <div class="stat-card">

                <div class="stat-top">

                    <div class="stat-icon">
                        ▦
                    </div>

                </div>

                <div class="stat-value">
                    {{ $stats['routines'] }}
                </div>

                <div class="stat-label">
                    ROUTINE CLASSES
                </div>

                <div class="active-count">
                    {{ $stats['published_routines'] }} published
                </div>

            </div>


            <div class="stat-card">

                <div class="stat-top">

                    <div class="stat-icon">
                        D
                    </div>

                </div>

                <div class="stat-value">
                    {{ $stats['draft_routines'] }}
                </div>

                <div class="stat-label">
                    DRAFT CLASSES
                </div>

                <div class="active-count">
                    Awaiting publication
                </div>

            </div>


            <div class="stat-card">

                <div class="stat-top">

                    <div class="stat-icon">
                        ✓
                    </div>

                </div>

                <div class="stat-value">
                    {{ $stats['published_routines'] }}
                </div>

                <div class="stat-label">
                    PUBLISHED
                </div>

                <div class="active-count">
                    Official schedule
                </div>

            </div>

        </section>


        <!-- =====================================================
             QUICK ACTIONS
        ====================================================== -->

        <div class="section-title">

            <h3>
                Quick Actions
            </h3>

            <span>
                Complete scheduling workflow
            </span>

        </div>


        <section class="quick-grid">

            <a
                href="{{ route('admin.semesters.index') }}"
                class="quick-card"
            >

                <div class="quick-icon">
                    01
                </div>

                <div class="quick-title">
                    Academic Structure
                </div>

                <div class="quick-description">
                    Manage semesters and sections before configuring courses.
                </div>

            </a>


            <a
                href="{{ route('admin.courses.index') }}"
                class="quick-card"
            >

                <div class="quick-icon">
                    02
                </div>

                <div class="quick-title">
                    Course Management
                </div>

                <div class="quick-description">
                    Add theory and laboratory courses semester-wise.
                </div>

            </a>


            <a
                href="{{ route('admin.teachers.index') }}"
                class="quick-card"
            >

                <div class="quick-icon">
                    03
                </div>

                <div class="quick-title">
                    Faculty Management
                </div>

                <div class="quick-description">
                    Manage faculty profiles and academic resources.
                </div>

            </a>


            <a
                href="{{ route('admin.teacher-availability.index') }}"
                class="quick-card"
            >

                <div class="quick-icon">
                    04
                </div>

                <div class="quick-title">
                    Faculty Availability
                </div>

                <div class="quick-description">
                    Define which days and time slots each faculty member can teach.
                </div>

            </a>


            <a
                href="{{ route('admin.rooms.index') }}"
                class="quick-card"
            >

                <div class="quick-icon">
                    05
                </div>

                <div class="quick-title">
                    Rooms & Labs
                </div>

                <div class="quick-description">
                    Configure classrooms, computer labs and specialized labs.
                </div>

            </a>


            <a
                href="{{ route('admin.course-assignments.index') }}"
                class="quick-card"
            >

                <div class="quick-icon">
                    06
                </div>

                <div class="quick-title">
                    Course Assignment
                </div>

                <div class="quick-description">
                    Assign courses and sections to their responsible faculty.
                </div>

            </a>


            <a
                href="{{ route('admin.routines.index') }}"
                class="quick-card"
            >

                <div class="quick-icon">
                    07
                </div>

                <div class="quick-title">
                    Smart Routine Builder
                </div>

                <div class="quick-description">
                    Schedule classes with faculty, section and room conflict protection.
                </div>

            </a>


            <a
                href="{{ route('admin.routine-publish.index') }}"
                class="quick-card"
            >

                <div class="quick-icon">
                    08
                </div>

                <div class="quick-title">
                    Publish Routine
                </div>

                <div class="quick-description">
                    Review draft schedules and publish the final academic routine.
                </div>

            </a>

        </section>


        <!-- =====================================================
             RECENT DATA
        ====================================================== -->

        <section class="content-grid">


            <!-- Recent Routine -->

            <div class="panel">

                <div class="panel-header">

                    <h3>
                        Recent Routine Classes
                    </h3>

                    <a href="{{ route('admin.routines.index') }}">
                        VIEW ALL
                    </a>

                </div>


                @forelse($recentRoutines as $routine)

                    <div class="routine-row">

                        <div>

                            <div class="course-code">

                                {{ $routine->courseAssignment->course->course_code }}

                            </div>

                            <div class="small">

                                Sem
                                {{ $routine->section->semester->number }}

                                /

                                {{ $routine->section->code }}

                            </div>

                        </div>


                        <div class="info">

                            {{ $routine->day }}

                            <div class="small">

                                {{ \Carbon\Carbon::parse(
                                    $routine->timeSlot->start_time
                                )->format('g:i A') }}

                            </div>

                        </div>


                        <div class="info">

                            {{ $routine->teacher->initial }}

                            <div class="small">
                                Faculty
                            </div>

                        </div>


                        <div class="info">

                            {{ $routine->room->room_number }}

                            <div class="small">
                                Room
                            </div>

                        </div>


                        <div>

                            @if($routine->status === 'published')

                                <span class="badge published">
                                    PUBLISHED
                                </span>

                            @else

                                <span class="badge draft">
                                    DRAFT
                                </span>

                            @endif

                        </div>

                    </div>

                @empty

                    <div class="empty">
                        No routine classes created yet.
                    </div>

                @endforelse

            </div>


            <!-- Recent Assignments -->

            <div class="panel">

                <div class="panel-header">

                    <h3>
                        Recent Assignments
                    </h3>

                    <a
                        href="{{ route('admin.course-assignments.index') }}"
                    >
                        VIEW ALL
                    </a>

                </div>


                @forelse($recentAssignments as $assignment)

                    <div class="assignment">

                        <div class="assignment-course">

                            {{ $assignment->course->course_code }}

                        </div>


                        <div class="small">

                            {{ $assignment->course->course_name }}

                        </div>


                        <div class="assignment-details">

                            <span class="mini-tag">

                                Sem
                                {{ $assignment->section->semester->number }}

                            </span>

                            <span class="mini-tag">

                                Section
                                {{ $assignment->section->code }}

                            </span>

                            <span class="mini-tag">

                                {{ $assignment->teacher->initial }}

                            </span>

                        </div>

                    </div>

                @empty

                    <div class="empty">
                        No course assignments available.
                    </div>

                @endforelse

            </div>

        </section>


    </main>

</div>


</body>

</html>