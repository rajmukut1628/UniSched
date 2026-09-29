<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="theme-color" content="#020617">
<title>Routine Command Center | UniSched</title>
@vite(['resources/css/app.css', 'resources/js/app.js'])
<style>

:root{
 --bg:#02040b;--panel:rgba(7,13,27,.74);--panel2:rgba(10,18,36,.88);
 --line:rgba(148,163,184,.11);--text:#f8fafc;--muted:#64748b;
 --blue:#3b82f6;--cyan:#22d3ee;--violet:#8b5cf6;--green:#22c55e;--amber:#f59e0b;
}
*{box-sizing:border-box}html{scroll-behavior:smooth}body{margin:0;min-height:100vh;overflow-x:hidden;color:var(--text);font-family:Inter,ui-sans-serif,system-ui,-apple-system,BlinkMacSystemFont,"Segoe UI",sans-serif;background:#02040b}a{color:inherit;text-decoration:none}button,select{font:inherit}::selection{background:#2563eb;color:white}
.cosmos{position:fixed;inset:0;z-index:-40;overflow:hidden;background:radial-gradient(circle at 84% 10%,rgba(37,99,235,.17),transparent 28%),radial-gradient(circle at 8% 90%,rgba(124,58,237,.14),transparent 29%),radial-gradient(circle at 50% 48%,rgba(6,182,212,.045),transparent 38%),linear-gradient(180deg,#020617,#030712 48%,#02040b)}
.cosmos:before{content:"";position:absolute;inset:-60%;filter:blur(65px);opacity:.8;background:conic-gradient(from 90deg,transparent,rgba(37,99,235,.07),transparent,rgba(168,85,247,.065),transparent,rgba(34,211,238,.045),transparent);animation:aurora 40s linear infinite}@keyframes aurora{to{transform:rotate(360deg)}}
.grid3d{position:absolute;left:-20%;right:-20%;bottom:-43%;height:90%;background-image:linear-gradient(rgba(96,165,250,.05) 1px,transparent 1px),linear-gradient(90deg,rgba(96,165,250,.05) 1px,transparent 1px);background-size:72px 72px;transform:perspective(680px) rotateX(63deg);transform-origin:center top;mask-image:linear-gradient(to bottom,transparent,#000 23%,#000 68%,transparent);animation:gridmove 12s linear infinite}@keyframes gridmove{to{background-position:0 72px,72px 0}}
#stars{position:absolute;inset:0}.star{position:absolute;border-radius:50%;background:#dbeafe;box-shadow:0 0 10px #60a5fa;animation:rise linear infinite}@keyframes rise{0%{opacity:0;transform:translateY(80px) scale(.4)}15%{opacity:.75}80%{opacity:.25}100%{opacity:0;transform:translateY(-110vh) scale(1.2)}}
#cursorGlow{position:fixed;z-index:-5;width:560px;height:560px;border-radius:50%;pointer-events:none;opacity:0;transform:translate(-50%,-50%);background:radial-gradient(circle,rgba(59,130,246,.085),transparent 66%);transition:opacity .2s}
.layout{min-height:100vh}.sidebar{position:fixed;z-index:60;left:16px;top:16px;bottom:16px;width:252px;padding:20px 14px;overflow-y:auto;border:1px solid rgba(255,255,255,.07);border-radius:22px;background:linear-gradient(180deg,rgba(8,15,30,.91),rgba(4,9,20,.84));backdrop-filter:blur(28px);box-shadow:0 35px 90px rgba(0,0,0,.34),inset 0 1px rgba(255,255,255,.04)}
.sidebar::-webkit-scrollbar{width:4px}.sidebar::-webkit-scrollbar-thumb{background:#1e3a5f;border-radius:99px}.brand{display:flex;align-items:center;gap:11px;padding:4px 7px 18px;margin-bottom:12px;border-bottom:1px solid rgba(255,255,255,.05)}.brand-icon{position:relative;overflow:hidden;width:43px;height:43px;flex:0 0 43px;display:grid;place-items:center;border-radius:13px;background:linear-gradient(135deg,#2563eb,#7c3aed);box-shadow:0 12px 32px rgba(37,99,235,.28);font-size:10px;font-weight:950}.brand-icon:after{content:"";position:absolute;width:70px;height:13px;background:rgba(255,255,255,.25);transform:rotate(-45deg) translateY(-55px);animation:shine 5s ease-in-out infinite}@keyframes shine{0%,60%{transform:rotate(-45deg) translateY(-55px)}80%,100%{transform:rotate(-45deg) translateY(55px)}}.brand-name{font-size:19px;font-weight:950;letter-spacing:-.6px}.brand-name span{color:#60a5fa}.brand-subtitle{margin-top:3px;color:#475569;font-size:6.5px;font-weight:900;letter-spacing:.7px}.nav-title{margin:18px 10px 7px;color:#344258;font-size:6.5px;font-weight:950;letter-spacing:1.5px}.nav-item{position:relative;display:flex;align-items:center;gap:10px;padding:10px 11px;margin-bottom:4px;border:1px solid transparent;border-radius:10px;color:#718096;font-size:8px;font-weight:800;transition:.22s}.nav-item:hover{color:#dbeafe;transform:translateX(3px);background:rgba(59,130,246,.055);border-color:rgba(96,165,250,.08)}.nav-item.active{color:#dbeafe;background:linear-gradient(90deg,rgba(37,99,235,.16),rgba(124,58,237,.07));border-color:rgba(96,165,250,.13);box-shadow:inset 3px 0 #3b82f6}.nav-icon{width:19px;text-align:center;color:#60a5fa}
.main{margin-left:284px;padding:28px 30px 70px;min-width:0}.hero{position:relative;overflow:hidden;min-height:245px;margin-bottom:18px;padding:30px 32px;display:flex;align-items:center;justify-content:space-between;gap:30px;border:1px solid rgba(255,255,255,.075);border-radius:24px;background:linear-gradient(135deg,rgba(11,20,41,.83),rgba(5,10,23,.68));backdrop-filter:blur(26px);box-shadow:0 30px 85px rgba(0,0,0,.28),inset 0 1px rgba(255,255,255,.04)}
.hero:before{content:"";position:absolute;width:500px;height:500px;right:-180px;top:-240px;border-radius:50%;background:radial-gradient(circle,rgba(59,130,246,.17),transparent 67%)}.hero-copy{position:relative;z-index:2;max-width:680px}.eyebrow{display:inline-flex;align-items:center;gap:7px;padding:7px 10px;border:1px solid rgba(96,165,250,.15);border-radius:999px;color:#93c5fd;background:rgba(59,130,246,.055);font-size:6.5px;font-weight:950;letter-spacing:1.3px}.eyebrow:before{content:"";width:5px;height:5px;border-radius:50%;background:#22c55e;box-shadow:0 0 9px #22c55e;animation:pulse 2s ease-in-out infinite}@keyframes pulse{50%{opacity:.35;transform:scale(.7)}}.hero h1{margin:13px 0 0;font-size:clamp(38px,4vw,60px);line-height:.96;letter-spacing:-2.6px;font-weight:950;background:linear-gradient(110deg,#fff 18%,#bfdbfe 46%,#c4b5fd 72%,#fff);background-size:200% auto;color:transparent;background-clip:text;-webkit-background-clip:text;animation:textflow 8s linear infinite}@keyframes textflow{to{background-position:200% center}}.hero p{max-width:610px;margin:14px 0 0;color:#64748b;font-size:9px;line-height:1.7}.hero-badges{display:flex;gap:7px;flex-wrap:wrap;margin-top:18px}.hero-chip{padding:7px 9px;border-radius:999px;color:#8493aa;background:rgba(255,255,255,.025);border:1px solid rgba(255,255,255,.055);font-size:6.5px;font-weight:900}
.core{position:relative;z-index:2;width:240px;height:180px;flex:0 0 240px;perspective:900px;transform-style:preserve-3d;transition:transform .12s}.sphere{position:absolute;left:50%;top:50%;width:76px;height:76px;margin:-38px;border-radius:50%;background:radial-gradient(circle at 30% 25%,#fff,#bfdbfe 5%,rgba(96,165,250,.55) 13%,rgba(37,99,235,.18) 42%,#030712 75%);border:1px solid rgba(147,197,253,.2);box-shadow:0 0 45px rgba(37,99,235,.3),0 0 100px rgba(37,99,235,.12);animation:float 4s ease-in-out infinite}.sphere:after{content:"US";position:absolute;inset:0;display:grid;place-items:center;font-size:12px;font-weight:950}.ring{position:absolute;left:50%;top:50%;border-radius:50%;border:1px solid rgba(96,165,250,.18);transform-style:preserve-3d}.ring.one{width:150px;height:62px;margin:-31px -75px;transform:rotateX(67deg);animation:r1 8s linear infinite}.ring.two{width:210px;height:88px;margin:-44px -105px;border-color:rgba(192,132,252,.14);transform:rotateX(67deg) rotateY(15deg);animation:r2 13s linear infinite reverse}.ring.three{width:235px;height:120px;margin:-60px -117px;border-color:rgba(103,232,249,.09);transform:rotateX(62deg) rotateY(-14deg);animation:r3 19s linear infinite}@keyframes r1{to{transform:rotateX(67deg) rotateZ(360deg)}}@keyframes r2{to{transform:rotateX(67deg) rotateY(15deg) rotateZ(360deg)}}@keyframes r3{to{transform:rotateX(62deg) rotateY(-14deg) rotateZ(360deg)}}@keyframes float{50%{transform:translateY(-7px)}}.node{position:absolute;left:50%;top:-5px;width:10px;height:10px;margin-left:-5px;border-radius:50%;background:#60a5fa;box-shadow:0 0 14px #3b82f6}.two .node{background:#c084fc;box-shadow:0 0 14px #a855f7}.three .node{background:#67e8f9;box-shadow:0 0 14px #22d3ee}
.header{display:none}.view-tabs{position:sticky;top:12px;z-index:45;display:flex;gap:7px;margin:0 0 16px;padding:7px;width:max-content;max-width:100%;overflow-x:auto;border:1px solid rgba(255,255,255,.065);border-radius:14px;background:rgba(5,11,24,.72);backdrop-filter:blur(24px);box-shadow:0 15px 45px rgba(0,0,0,.2)}.view-tab{white-space:nowrap;padding:9px 13px;border-radius:9px;color:#718096;font-size:7px;font-weight:900;transition:.22s}.view-tab:hover{color:#dbeafe;background:rgba(59,130,246,.055)}.view-tab.active{color:white;background:linear-gradient(135deg,#2563eb,#4f46e5,#7c3aed);box-shadow:0 8px 24px rgba(37,99,235,.2)}
.panel{position:relative;padding:19px;margin-bottom:16px;border:1px solid rgba(255,255,255,.07);border-radius:19px;background:linear-gradient(145deg,rgba(12,20,39,.78),rgba(5,10,23,.68));backdrop-filter:blur(24px);box-shadow:0 25px 70px rgba(0,0,0,.22),inset 0 1px rgba(255,255,255,.03)}.panel:before,.stat:before{content:"";position:absolute;inset:0;pointer-events:none;border-radius:inherit;background:radial-gradient(circle at var(--mx,50%) var(--my,0%),rgba(59,130,246,.085),transparent 28%)}
.filter-panel{padding:18px}.filter-grid{display:grid;grid-template-columns:repeat(5,minmax(130px,1fr)) auto;gap:9px;align-items:end}.form-group label{display:block;margin:0 0 7px;color:#607089;font-size:6.5px;font-weight:950;letter-spacing:.8px}.form-group select{width:100%;height:44px;padding:0 11px;border:1px solid rgba(255,255,255,.075);border-radius:10px;outline:none;color:#dbeafe;background:#07101f;font-size:8px;transition:.2s}.form-group select:focus{border-color:rgba(96,165,250,.42);box-shadow:0 0 0 4px rgba(59,130,246,.065)}select option{background:#0f172a}.actions{display:flex;gap:6px;align-items:center}.btn{min-height:44px;padding:0 13px;display:inline-flex;align-items:center;justify-content:center;border:1px solid transparent;border-radius:10px;cursor:pointer;font-size:7px;font-weight:950;transition:.22s}.btn:hover{transform:translateY(-2px)}.primary{color:#fff;background:linear-gradient(135deg,#2563eb,#4f46e5,#7c3aed);box-shadow:0 12px 30px rgba(37,99,235,.2)}.reset{color:#8493aa;background:rgba(255,255,255,.025);border-color:rgba(255,255,255,.055)}
.stats{display:grid;grid-template-columns:repeat(6,1fr);gap:9px;margin-bottom:16px}.stat{position:relative;overflow:hidden;min-height:92px;padding:15px;border:1px solid rgba(255,255,255,.06);border-radius:15px;background:linear-gradient(145deg,rgba(12,20,39,.74),rgba(5,10,23,.65));box-shadow:0 18px 45px rgba(0,0,0,.14);transition:.22s}.stat:hover{transform:translateY(-4px);border-color:rgba(96,165,250,.13)}.stat-value{position:relative;font-size:24px;font-weight:950;letter-spacing:-1px;background:linear-gradient(135deg,#fff,#93c5fd);color:transparent;background-clip:text;-webkit-background-clip:text}.stat-label{position:relative;margin-top:5px;color:#526177;font-size:6.5px;font-weight:950;letter-spacing:.9px;text-transform:uppercase}
.routine-header{display:flex;justify-content:space-between;align-items:center;gap:14px;margin-bottom:14px}.routine-header h2{margin:0;font-size:17px;letter-spacing:-.4px}.routine-header p{margin:5px 0 0;color:#536177;font-size:7px}.count{padding:7px 9px;border-radius:999px;color:#93c5fd;background:rgba(59,130,246,.055);border:1px solid rgba(96,165,250,.12);font-size:6.5px;font-weight:950}.routine-wrapper{width:100%;overflow:auto;border:1px solid rgba(255,255,255,.04);border-radius:14px;background:rgba(2,6,23,.22)}.routine-wrapper::-webkit-scrollbar{height:7px;width:7px}.routine-wrapper::-webkit-scrollbar-thumb{background:#172554;border-radius:99px}
table{width:100%;min-width:1180px;border-collapse:separate;border-spacing:6px;table-layout:fixed}th{padding:12px 7px;border:1px solid rgba(255,255,255,.045);border-radius:9px;color:#718096;background:rgba(15,23,42,.74);font-size:6.5px;font-weight:950;text-align:center;letter-spacing:.25px}th.day-column{width:90px}td{padding:5px;vertical-align:top;border:1px solid rgba(255,255,255,.025);border-radius:9px;background:rgba(255,255,255,.008)}.day-cell{width:90px;vertical-align:middle;text-align:center;color:#c4b5fd;background:linear-gradient(145deg,rgba(124,58,237,.07),rgba(37,99,235,.035));font-size:7px;font-weight:950;letter-spacing:.35px}
.class-card{position:relative;overflow:hidden;min-height:104px;padding:10px;margin-bottom:5px;border:1px solid rgba(96,165,250,.09);border-radius:10px;background:linear-gradient(145deg,rgba(37,99,235,.105),rgba(124,58,237,.05));box-shadow:0 10px 24px rgba(0,0,0,.08);transition:.23s}.class-card:before{content:"";position:absolute;left:0;top:0;bottom:0;width:2px;background:linear-gradient(#60a5fa,#8b5cf6)}.class-card:hover{z-index:4;transform:translateY(-4px) scale(1.018);border-color:rgba(96,165,250,.23);box-shadow:0 18px 38px rgba(0,0,0,.2),0 0 30px rgba(59,130,246,.055)}.class-card:last-child{margin-bottom:0}.course{color:#bfdbfe;font-size:7.5px;font-weight:950}.course-name{margin-top:4px;color:#8493aa;font-size:6.5px;line-height:1.45}.class-info{display:flex;flex-wrap:wrap;gap:4px;margin-top:8px}.tag{padding:4px 6px;border-radius:999px;font-size:5.7px;font-weight:900;border:1px solid rgba(255,255,255,.035)}.section-tag{color:#93c5fd;background:rgba(59,130,246,.075)}.faculty-tag{color:#c4b5fd;background:rgba(139,92,246,.075)}.room-tag{color:#67e8f9;background:rgba(6,182,212,.07)}.published-tag{color:#86efac;background:rgba(34,197,94,.07)}.draft-tag{color:#fde68a;background:rgba(245,158,11,.07)}.empty-slot{min-height:104px;display:grid;place-items:center;color:#26354b;font-size:12px}.no-routine{padding:60px 20px;text-align:center;color:#526177;font-size:8px}
@media(max-width:1280px){.filter-grid{grid-template-columns:repeat(3,1fr)}.stats{grid-template-columns:repeat(3,1fr)}}@media(max-width:900px){.sidebar{display:none}.main{margin-left:0;padding:18px}.hero{padding:25px}.filter-grid{grid-template-columns:repeat(2,1fr)}}@media(max-width:680px){.hero{min-height:auto;align-items:flex-start;flex-direction:column}.core{align-self:center}.filter-grid,.stats{grid-template-columns:1fr}.routine-header{align-items:flex-start;flex-direction:column}.main{padding:12px}.hero h1{font-size:40px}.panel{padding:12px}}
@media(prefers-reduced-motion:reduce){*,*:before,*:after{animation-duration:.01ms!important;animation-iteration-count:1!important;scroll-behavior:auto!important}}
@media print{@page{size:A4 landscape;margin:7mm}.cosmos,#cursorGlow,.sidebar,.hero,.view-tabs,.filter-panel,.stats,.routine-header .actions{display:none!important}body{background:#fff;color:#111827;-webkit-print-color-adjust:exact;print-color-adjust:exact}.main{margin:0;padding:0}.panel{padding:0;border:0;background:#fff;box-shadow:none}.routine-header h2{color:#111827}.routine-header p,.count{color:#4b5563}.routine-wrapper{overflow:visible;border:0;background:#fff}table{min-width:0;border-collapse:collapse;border-spacing:0}th,td{border:1px solid #9ca3af;border-radius:0;background:#fff;color:#111827}.day-cell{color:#111827;background:#f3f4f6}.class-card{min-height:0;background:#f8fafc;border:1px solid #d1d5db;box-shadow:none}.course,.course-name,.tag{color:#111827}.empty-slot{min-height:45px}}

</style>
</head>
<body>
<div class="cosmos"><div class="grid3d"></div><div id="stars"></div></div>
<div id="cursorGlow"></div>
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

            class="nav-item active"

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

<section class="hero" id="hero">
  <div class="hero-copy">
    <div class="eyebrow">LIVE ACADEMIC SCHEDULING INTELLIGENCE</div>
    <h1>Routine Command Center</h1>
    <p>Explore the complete UniSched academic timetable through master, semester, section, faculty and room perspectives — with live filtering, resource visibility and publication status in one control surface.</p>
    <div class="hero-badges"><span class="hero-chip">MASTER MATRIX</span><span class="hero-chip">CONFLICT-AWARE DATA</span><span class="hero-chip">SATURDAY — THURSDAY</span></div>
  </div>
  <div class="core" id="core">
    <div class="ring three"><i class="node"></i></div>
    <div class="ring two"><i class="node"></i></div>
    <div class="ring one"><i class="node"></i></div>
    <div class="sphere"></div>
  </div>
</section>




        





        <div class="view-tabs">



            <a

                href="{{ route('admin.routine-views.index', ['view' => 'master']) }}"

                class="view-tab {{ $viewType === 'master' ? 'active' : '' }}"

            >

                Master Routine

            </a>



            <a

                href="{{ route('admin.routine-views.index', ['view' => 'semester']) }}"

                class="view-tab {{ $viewType === 'semester' ? 'active' : '' }}"

            >

                Semester-wise

            </a>



            <a

                href="{{ route('admin.routine-views.index', ['view' => 'section']) }}"

                class="view-tab {{ $viewType === 'section' ? 'active' : '' }}"

            >

                Section-wise

            </a>



            <a

                href="{{ route('admin.routine-views.index', ['view' => 'faculty']) }}"

                class="view-tab {{ $viewType === 'faculty' ? 'active' : '' }}"

            >

                Faculty-wise

            </a>



            <a

                href="{{ route('admin.routine-views.index', ['view' => 'room']) }}"

                class="view-tab {{ $viewType === 'room' ? 'active' : '' }}"

            >

                Room-wise

            </a>



        </div>





        <section class="panel filter-panel">



            <form

                method="GET"

                action="{{ route('admin.routine-views.index') }}"

            >



                <input

                    type="hidden"

                    name="view"

                    value="{{ $viewType }}"

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

                            ROOM / LAB

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

                                value="published"

                                {{ request('status') === 'published' ? 'selected' : '' }}

                            >

                                Published

                            </option>



                            <option

                                value="draft"

                                {{ request('status') === 'draft' ? 'selected' : '' }}

                            >

                                Draft

                            </option>



                        </select>



                    </div>





                    <div class="actions">



                        <button

                            type="submit"

                            class="btn primary"

                        >

                            Apply

                        </button>



                        <a

                            href="{{ route('admin.routine-views.index', ['view' => $viewType]) }}"

                            class="btn reset"

                        >

                            Reset

                        </a>



                    </div>



                </div>



            </form>



        </section>





        <div class="stats">



            <div class="stat">



                <div class="stat-value">

                    {{ $stats['total'] }}

                </div>



                <div class="stat-label">

                    Classes

                </div>



            </div>





            <div class="stat">



                <div class="stat-value">

                    {{ $stats['published'] }}

                </div>



                <div class="stat-label">

                    Published

                </div>



            </div>





            <div class="stat">



                <div class="stat-value">

                    {{ $stats['draft'] }}

                </div>



                <div class="stat-label">

                    Draft

                </div>



            </div>





            <div class="stat">



                <div class="stat-value">

                    {{ $stats['sections'] }}

                </div>



                <div class="stat-label">

                    Sections

                </div>



            </div>





            <div class="stat">



                <div class="stat-value">

                    {{ $stats['faculty'] }}

                </div>



                <div class="stat-label">

                    Faculty

                </div>



            </div>





            <div class="stat">



                <div class="stat-value">

                    {{ $stats['rooms'] }}

                </div>



                <div class="stat-label">

                    Rooms

                </div>



            </div>



        </div>





        <section class="panel">



            <div class="routine-header">



                <div>



                    <h2>



                        @if($viewType === 'semester')



                            Semester Routine



                        @elseif($viewType === 'section')



                            Section Routine



                        @elseif($viewType === 'faculty')



                            Faculty Routine



                        @elseif($viewType === 'room')



                            Room Routine



                        @else



                            Master Routine



                        @endif



                    </h2>



                    <p>

                        Saturday to Thursday academic schedule

                    </p>



                </div>





                <div class="actions">



                    <span class="count">

                        {{ $routines->count() }} CLASS(ES)

                    </span>



                    <button

                        type="button"

                        class="btn reset"

                        onclick="window.print()"

                    >

                        Print

                    </button>



                </div>



            </div>





            @if($routines->count())



                <div class="routine-wrapper">



                    <table>



                        <thead>



                        <tr>



                            <th class="day-column">

                                DAY

                            </th>



                            @foreach($timeSlots as $slot)



                                <th>



                                   {{ \Carbon\Carbon::parse($slot->start_time)->format('g:i A') }}



                                    <br>



                                    <span style="color:#475569">



                                        {{ \Carbon\Carbon::parse($slot->end_time)->format('g:i A') }}



                                    </span>



                                </th>



                            @endforeach



                        </tr>



                        </thead>





                        <tbody>



                        @foreach($days as $day)



                            <tr>



                                <td class="day-cell">

                                    {{ $day }}

                                </td>





                                @foreach($timeSlots as $slot)



                                    <td>



                                       @php
$cellRoutines = $routineMap[$day][$slot->id] ?? [];
@endphp





                                        @forelse($cellRoutines as $routine)



                                            <div class="class-card">



                                                <div class="course">



                                                    {{ $routine->courseAssignment->course->course_code }}



                                                </div>





                                                <div class="course-name">



                                                    {{ $routine->courseAssignment->course->course_name }}



                                                </div>





                                                <div class="class-info">



                                                    <span class="tag section-tag">



                                                        Sem

                                                        {{ $routine->section->semester->number }}



                                                        /



                                                        {{ $routine->section->code }}



                                                    </span>





                                                    <span class="tag faculty-tag">



                                                        {{ $routine->teacher->initial }}



                                                    </span>





                                                    <span class="tag room-tag">



                                                        {{ $routine->room->room_number }}



                                                    </span>





                                                    @if($routine->status === 'published')



                                                        <span class="tag published-tag">

                                                            Published

                                                        </span>



                                                    @else



                                                        <span class="tag draft-tag">

                                                            Draft

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



                </div>



            @else



                <div class="no-routine">



                    No routine classes found for the selected filters.



                </div>



            @endif



        </section>



    </main>



</div>







<script>
function semesterChanged(){
    const form=document.querySelector('.filter-panel form');
    if(!form)return;
    const sectionSelect=form.querySelector('select[name="section_id"]');
    if(sectionSelect)sectionSelect.value='';
    form.submit();
}
document.addEventListener('DOMContentLoaded',()=>{
 const reduced=matchMedia('(prefers-reduced-motion: reduce)').matches, fine=matchMedia('(pointer:fine)').matches;
 const stars=document.getElementById('stars');
 if(stars&&!reduced){for(let i=0;i<42;i++){const p=document.createElement('span');p.className='star';const z=1+Math.random()*2;p.style.cssText=`left:${Math.random()*100}%;top:${45+Math.random()*65}%;width:${z}px;height:${z}px;animation-duration:${12+Math.random()*17}s;animation-delay:${Math.random()*-24}s`;stars.appendChild(p)}}
 const glow=document.getElementById('cursorGlow');
 if(glow&&fine){addEventListener('mousemove',e=>{glow.style.opacity='1';glow.style.left=e.clientX+'px';glow.style.top=e.clientY+'px'});document.addEventListener('mouseleave',()=>glow.style.opacity='0')}
 document.querySelectorAll('.panel,.stat').forEach(el=>{if(!fine||reduced)return;el.addEventListener('mousemove',e=>{const r=el.getBoundingClientRect();el.style.setProperty('--mx',((e.clientX-r.left)/r.width*100)+'%');el.style.setProperty('--my',((e.clientY-r.top)/r.height*100)+'%')})});
 const hero=document.getElementById('hero'),core=document.getElementById('core');
 if(hero&&core&&fine&&!reduced){hero.addEventListener('mousemove',e=>{const r=hero.getBoundingClientRect(),x=(e.clientX-r.left)/r.width,y=(e.clientY-r.top)/r.height;core.style.transform=`rotateX(${(y-.5)*-8}deg) rotateY(${(x-.5)*11}deg)`});hero.addEventListener('mouseleave',()=>core.style.transform='rotateX(0) rotateY(0)')}
});
</script>

</body>
</html>
