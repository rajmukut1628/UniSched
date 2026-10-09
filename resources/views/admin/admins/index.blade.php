<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Admin Management | UniSched</title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

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
                    rgba(37, 99, 235, .10),
                    transparent 25%
                ),
                #070b16;

            color: #f8fafc;
        }

        /* ================================
           LAYOUT
        ================================= */

        .layout {
            min-height: 100vh;
            display: flex;
        }

        /* ================================
           SIDEBAR
        ================================= */

        .sidebar {
            width: 270px;
            min-height: 100vh;

            position: fixed;
            left: 0;
            top: 0;

            padding: 28px 20px;

            background: rgba(11, 17, 32, .97);

            border-right:
                1px solid
                rgba(255, 255, 255, .07);

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
                rgba(37, 99, 235, .25);
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
                rgba(59, 130, 246, .08);

            transform: translateX(2px);
        }

        .nav-item.active {
            color: #bfdbfe;

            background:
                linear-gradient(
                    90deg,
                    rgba(37, 99, 235, .18),
                    rgba(124, 58, 237, .08)
                );

            border:
                1px solid
                rgba(59, 130, 246, .15);
        }

        .nav-icon {
            width: 20px;
            text-align: center;
        }

        .coming {
            opacity: .48;
        }

        /* ================================
           MAIN
        ================================= */

        .main {
            flex: 1;

            margin-left: 270px;

            padding:
                35px
                38px
                60px;
        }

        /* ================================
           HEADER
        ================================= */

        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;

            margin-bottom: 30px;
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

        .admin-count {
            padding: 9px 14px;

            border-radius: 20px;

            color: #93c5fd;

            background:
                rgba(59, 130, 246, .08);

            border:
                1px solid
                rgba(59, 130, 246, .12);

            font-size: 12px;
            font-weight: 700;
        }

        /* ================================
           ALERT
        ================================= */

        .alert {
            margin-bottom: 20px;

            padding: 14px 17px;

            border-radius: 11px;

            font-size: 13px;
        }

        .alert-success {
            color: #86efac;

            background:
                rgba(34, 197, 94, .08);

            border:
                1px solid
                rgba(34, 197, 94, .16);
        }

        .alert-error {
            color: #fca5a5;

            background:
                rgba(239, 68, 68, .08);

            border:
                1px solid
                rgba(239, 68, 68, .16);
        }

        /* ================================
           GRID
        ================================= */

        .grid {
            display: grid;

            grid-template-columns:
                370px
                1fr;

            gap: 22px;

            align-items: start;
        }

        /* ================================
           PANEL
        ================================= */

        .panel {
            border-radius: 19px;

            padding: 24px;

            background:
                rgba(15, 23, 42, .78);

            border:
                1px solid
                rgba(255, 255, 255, .065);
        }

        .panel-header {
            margin-bottom: 23px;
        }

        .panel-header h2 {
            margin: 0;
            font-size: 18px;
        }

        .panel-header p {
            margin: 6px 0 0;

            color: #64748b;

            font-size: 11px;

            line-height: 1.6;
        }

        /* ================================
           FORM
        ================================= */

        .form-group {
            margin-bottom: 17px;
        }

        label {
            display: block;

            margin-bottom: 8px;

            color: #94a3b8;

            font-size: 12px;
            font-weight: 600;
        }

        input {
            width: 100%;

            padding: 13px 14px;

            border-radius: 10px;

            border:
                1px solid
                rgba(255, 255, 255, .08);

            background: #090f1d;

            color: white;

            outline: none;

            transition: .2s;
        }

        input:focus {
            border-color: #3b82f6;

            box-shadow:
                0 0 0 3px
                rgba(59, 130, 246, .10);
        }

        input:disabled {
            cursor: not-allowed;
            opacity: .6;
        }

        .password-note {
            margin-top: -8px;
            margin-bottom: 16px;

            color: #475569;

            font-size: 10px;

            line-height: 1.5;
        }

        /* ================================
           BUTTONS
        ================================= */

        .btn {
            border: 0;

            border-radius: 9px;

            padding: 10px 14px;

            cursor: pointer;

            font-weight: 700;

            font-size: 12px;

            transition: .2s;
        }

        .btn-primary {
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

        .btn-primary:hover {
            transform: translateY(-1px);

            box-shadow:
                0 10px 25px
                rgba(37, 99, 235, .20);
        }

        .btn-edit {
            color: #93c5fd;

            background:
                rgba(59, 130, 246, .10);
        }

        .btn-edit:hover {
            background:
                rgba(59, 130, 246, .18);
        }

        .btn-delete {
            color: #fca5a5;

            background:
                rgba(239, 68, 68, .09);
        }

        .btn-delete:hover {
            background:
                rgba(239, 68, 68, .16);
        }

        .btn-disabled {
            color: #64748b;

            background:
                rgba(100, 116, 139, .08);

            cursor: not-allowed;
        }

        .save-button {
            color: white;

            background:
                linear-gradient(
                    135deg,
                    #2563eb,
                    #7c3aed
                );
        }

        /* ================================
           ADMIN LIST
        ================================= */

        .admin-list {
            display: flex;

            flex-direction: column;

            gap: 12px;
        }

        .admin-card {
            padding: 17px;

            border-radius: 14px;

            background:
                rgba(9, 15, 29, .75);

            border:
                1px solid
                rgba(255, 255, 255, .055);
        }

        .owner-card {
            border:
                1px solid
                rgba(250, 204, 21, .18);

            background:
                linear-gradient(
                    135deg,
                    rgba(250, 204, 21, .035),
                    rgba(9, 15, 29, .75)
                );
        }

        .admin-card-top {
            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 15px;
        }

        .admin-profile {
            display: flex;

            align-items: center;

            gap: 13px;
        }

        .avatar {
            width: 44px;
            height: 44px;

            flex-shrink: 0;

            display: flex;

            align-items: center;

            justify-content: center;

            border-radius: 12px;

            background:
                linear-gradient(
                    135deg,
                    #1d4ed8,
                    #6d28d9
                );

            font-size: 16px;

            font-weight: 900;
        }

        .owner-avatar {
            background:
                linear-gradient(
                    135deg,
                    #d97706,
                    #facc15
                );

            color: #111827;
        }

        .admin-name {
            color: #e2e8f0;

            font-size: 14px;

            font-weight: 700;
        }

        .admin-email {
            margin-top: 4px;

            color: #64748b;

            font-size: 11px;
        }

        .you-badge,
        .owner-badge {
            display: inline-block;

            margin-left: 7px;

            padding: 3px 7px;

            border-radius: 15px;

            font-size: 9px;

            font-weight: 800;
        }

        .you-badge {
            color: #86efac;

            background:
                rgba(34, 197, 94, .08);
        }

        .owner-badge {
            color: #fde68a;

            background:
                rgba(245, 158, 11, .10);

            border:
                1px solid
                rgba(245, 158, 11, .12);
        }

        .actions {
            display: flex;

            gap: 7px;

            flex-wrap: wrap;

            justify-content: flex-end;
        }

        /* ================================
           EDIT PANEL
        ================================= */

        .hidden-panel {
            display: none;

            margin-top: 15px;

            padding: 17px;

            border-radius: 12px;

            background:
                rgba(2, 6, 23, .55);

            border:
                1px solid
                rgba(255, 255, 255, .05);
        }

        .hidden-panel h3 {
            margin: 0 0 15px;

            color: #cbd5e1;

            font-size: 13px;
        }

        .form-row {
            display: grid;

            grid-template-columns:
                1fr
                1fr;

            gap: 12px;
        }

        /* ================================
           SECURITY BOX
        ================================= */

        .security-box {
            margin-top: 22px;

            padding: 18px;

            border-radius: 14px;

            background:
                rgba(59, 130, 246, .04);

            border:
                1px solid
                rgba(59, 130, 246, .09);
        }

        .security-box h3 {
            margin: 0;

            color: #cbd5e1;

            font-size: 13px;
        }

        .security-box p {
            margin: 7px 0 0;

            color: #64748b;

            font-size: 11px;

            line-height: 1.6;
        }

        .security-note {
            margin-top: 12px;

            padding: 11px 12px;

            border-radius: 9px;

            color: #94a3b8;

            background:
                rgba(15, 23, 42, .55);

            font-size: 10px;

            line-height: 1.6;
        }

        /* ================================
           RESPONSIVE
        ================================= */

        @media(max-width: 1050px) {
            .grid {
                grid-template-columns: 1fr;
            }
        }

        @media(max-width: 850px) {
            .sidebar {
                display: none;
            }

            .main {
                margin-left: 0;
                padding: 25px;
            }
        }

        @media(max-width: 650px) {
            .admin-card-top {
                align-items: flex-start;
                flex-direction: column;
            }

            .actions {
                justify-content: flex-start;
            }

            .form-row {
                grid-template-columns: 1fr;
            }

            .header {
                align-items: flex-start;
                gap: 15px;
            }
        }
    </style>
<<<<<<< HEAD
=======

    @include('admin.partials.navigation-styles')
>>>>>>> 01ce32e (Update UniSched dashboard, routine views and UI improvements)
</head>

<body>

@include('admin.partials.mobile-navigation')

<div class="layout">

    {{-- ================================
         SIDEBAR
    ================================= --}}

<<<<<<< HEAD
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
            href="#"
            class="nav-item coming"
        >
            <span class="nav-icon">C</span>
            Courses
        </a>

        <a
            href="#"
            class="nav-item coming"
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
            class="nav-item active"
        >
            <span class="nav-icon">⚙</span>
            Admin Management
        </a>

    </aside>
=======
    @include('admin.partials.sidebar')
>>>>>>> 01ce32e (Update UniSched dashboard, routine views and UI improvements)


    {{-- ================================
         MAIN
    ================================= --}}

    <main class="main">

        <div class="header">

            <div>
                <h1>
                    Admin Management
                </h1>

                <p>
                    Create and securely manage UniSched administrators.
                </p>
            </div>

            <div class="admin-count">
                {{ $admins->count() }}
                {{ $admins->count() === 1 ? 'ADMIN' : 'ADMINS' }}
            </div>

        </div>


        {{-- ================================
             ALERTS
        ================================= --}}

        @if(session('success'))

            <div class="alert alert-success">
                {{ session('success') }}
            </div>

        @endif


        @if(session('error'))

            <div class="alert alert-error">
                {{ session('error') }}
            </div>

        @endif


        @if($errors->any())

            <div class="alert alert-error">

                @foreach($errors->all() as $error)

                    <div>
                        {{ $error }}
                    </div>

                @endforeach

            </div>

        @endif


        <div class="grid">

            {{-- ================================
                 CREATE ADMIN
            ================================= --}}

            <section class="panel">

                <div class="panel-header">

                    <h2>
                        Add New Admin
                    </h2>

                    <p>
                        Create another administrator who can access
                        the UniSched administration panel.
                    </p>

                </div>


                <form
                    method="POST"
                    action="{{ route('admin.admins.store') }}"
                >

                    @csrf


                    <div class="form-group">

                        <label>
                            Full Name
                        </label>

                        <input
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            placeholder="Example: John Doe"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label>
                            Email Address
                        </label>

                        <input
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="admin@example.com"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label>
                            Password
                        </label>

                        <input
                            type="password"
                            name="password"
                            placeholder="Minimum 8 characters"
                            autocomplete="new-password"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label>
                            Confirm Password
                        </label>

                        <input
                            type="password"
                            name="password_confirmation"
                            placeholder="Repeat password"
                            autocomplete="new-password"
                            required
                        >

                    </div>


                    <div class="password-note">
                        Password must contain at least 8 characters,
                        including letters and numbers.
                    </div>


                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Create Administrator
                    </button>

                </form>


                <div class="security-box">

                    <h3>
                        Admin Security
                    </h3>

                    <p>
                        Public registration is disabled.
                        Administrator passwords are securely hashed
                        and cannot be viewed after account creation.
                    </p>

                    <div class="security-note">
                        If an administrator forgets their password,
                        they should use the secure Forgot Password
                        and Reset Password system.
                    </div>

                </div>

            </section>


            {{-- ================================
                 ADMINISTRATORS
            ================================= --}}

            <section class="panel">

                <div class="panel-header">

                    <h2>
                        Administrators
                    </h2>

                    <p>
                        Manage administrator profiles.
                        Passwords are never displayed from this panel.
                    </p>

                </div>


                <div class="admin-list">

                    @forelse($admins as $admin)

                        @php
                            $isOwnerAdmin =
                                strtolower(trim($admin->email)) ===
                                strtolower(trim($ownerAdminEmail));

                            $isCurrentAdmin =
                                auth()->id() === $admin->id;

                            $currentUserIsOwner =
                                strtolower(trim(auth()->user()->email)) ===
                                strtolower(trim($ownerAdminEmail));

                            $canEdit =
                                $isCurrentAdmin ||
                                (
                                    $currentUserIsOwner &&
                                    !$isOwnerAdmin
                                );

                            $canDelete =
                                $currentUserIsOwner &&
                                !$isOwnerAdmin &&
                                !$isCurrentAdmin;
                        @endphp


                        <div
                            class="admin-card
                            {{ $isOwnerAdmin ? 'owner-card' : '' }}"
                        >

                            <div class="admin-card-top">

                                <div class="admin-profile">

                                    <div
                                        class="avatar
                                        {{ $isOwnerAdmin ? 'owner-avatar' : '' }}"
                                    >
                                        {{ strtoupper(
                                            substr(
                                                $admin->name,
                                                0,
                                                1
                                            )
                                        ) }}
                                    </div>


                                    <div>

                                        <div class="admin-name">

                                            {{ $admin->name }}

                                            @if($isOwnerAdmin)

                                                <span class="owner-badge">
                                                    MAIN ADMIN
                                                </span>

                                            @endif


                                            @if($isCurrentAdmin)

                                                <span class="you-badge">
                                                    YOU
                                                </span>

                                            @endif

                                        </div>


                                        <div class="admin-email">
                                            {{ $admin->email }}
                                        </div>

                                    </div>

                                </div>


                                <div class="actions">

                                    {{-- EDIT OPTION --}}

                                    @if($canEdit)

                                        <button
                                            type="button"
                                            class="btn btn-edit"
                                            onclick="togglePanel(
                                                'edit-{{ $admin->id }}'
                                            )"
                                        >
                                            Edit
                                        </button>

                                    @else

                                        <button
                                            type="button"
                                            class="btn btn-disabled"
                                            disabled
                                        >
                                            Protected
                                        </button>

                                    @endif


                                    {{--
                                        PASSWORD OPTION INTENTIONALLY REMOVED

                                        No administrator can see another
                                        administrator's password.

                                        No password-change option is exposed
                                        from Admin Management.

                                        Password reset should be performed
                                        through Forgot Password.
                                    --}}


                                    {{-- DELETE OPTION --}}

                                    @if($isOwnerAdmin)

                                        <button
                                            type="button"
                                            class="btn btn-disabled"
                                            disabled
                                        >
                                            Main Admin
                                        </button>

                                    @elseif($isCurrentAdmin)

                                        <button
                                            type="button"
                                            class="btn btn-disabled"
                                            disabled
                                        >
                                            Protected
                                        </button>

                                    @elseif($canDelete)

                                        <form
                                            method="POST"
                                            action="{{ route(
                                                'admin.admins.destroy',
                                                $admin
                                            ) }}"
                                            onsubmit="
                                                return confirm(
                                                    'Are you sure you want to delete this administrator?'
                                                );
                                            "
                                        >

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn btn-delete"
                                            >
                                                Delete
                                            </button>

                                        </form>

                                    @else

                                        <button
                                            type="button"
                                            class="btn btn-disabled"
                                            disabled
                                        >
                                            Protected
                                        </button>

                                    @endif

                                </div>

                            </div>


                            {{-- ================================
                                 EDIT ADMIN
                            ================================= --}}

                            @if($canEdit)

                                <div
                                    id="edit-{{ $admin->id }}"
                                    class="hidden-panel"
                                >

                                    <h3>
                                        Edit Administrator
                                    </h3>


                                    <form
                                        method="POST"
                                        action="{{ route(
                                            'admin.admins.update',
                                            $admin
                                        ) }}"
                                    >

                                        @csrf
                                        @method('PUT')


                                        <div class="form-row">

                                            <div class="form-group">

                                                <label>
                                                    Full Name
                                                </label>

                                                <input
                                                    type="text"
                                                    name="name"
                                                    value="{{ $admin->name }}"
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
                                                    value="{{ $admin->email }}"
                                                    {{ $isOwnerAdmin ? 'readonly' : '' }}
                                                    required
                                                >

                                            </div>

                                        </div>


                                        @if($isOwnerAdmin)

                                            <div class="security-note">
                                                The Main Administrator email
                                                address is permanently protected.
                                            </div>

                                        @endif


                                        <button
                                            type="submit"
                                            class="btn save-button"
                                        >
                                            Save Changes
                                        </button>

                                    </form>

                                </div>

                            @endif

                        </div>

                    @empty

                        <div>
                            No administrator accounts found.
                        </div>

                    @endforelse

                </div>

            </section>

        </div>

    </main>

</div>


<script>
    function togglePanel(id) {

        const panel =
            document.getElementById(id);

        if (!panel) {
            return;
        }

        if (
            panel.style.display === 'block'
        ) {
            panel.style.display = 'none';
        } else {
            panel.style.display = 'block';
        }
    }
</script>

</body>
</html>