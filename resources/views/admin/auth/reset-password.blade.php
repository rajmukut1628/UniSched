<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Reset Password | UniSched</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;

            min-height: 100vh;

            display: flex;
            align-items: center;
            justify-content: center;

            padding: 24px;

            font-family:
                Inter,
                Arial,
                sans-serif;

            color: white;

            background:
                radial-gradient(
                    circle at 15% 20%,
                    rgba(59,130,246,.18),
                    transparent 30%
                ),
                radial-gradient(
                    circle at 85% 80%,
                    rgba(139,92,246,.18),
                    transparent 30%
                ),
                #050816;
        }

        .wrapper {
            width: 100%;
            max-width: 450px;
        }

        .card {
            padding: 42px;

            border:
                1px solid
                rgba(255,255,255,.10);

            border-radius: 28px;

            background:
                rgba(15,23,42,.72);

            backdrop-filter:
                blur(24px);

            box-shadow:
                0 30px 80px
                rgba(0,0,0,.45);
        }

        .brand {
            text-align: center;

            margin-bottom: 30px;
        }

        .badge {
            width: 65px;
            height: 65px;

            margin:
                0 auto
                18px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 20px;

            background:
                linear-gradient(
                    135deg,
                    #2563eb,
                    #7c3aed
                );

            font-size: 22px;
            font-weight: 800;
        }

        h1 {
            margin: 0;

            font-size: 27px;
        }

        .brand p {
            margin:
                8px 0
                0;

            color: #94a3b8;

            font-size: 13px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;

            margin-bottom: 8px;

            color: #cbd5e1;

            font-size: 13px;
            font-weight: 600;
        }

        input {
            width: 100%;

            padding: 14px 15px;

            border:
                1px solid
                rgba(255,255,255,.10);

            border-radius: 12px;

            outline: none;

            color: white;

            background:
                rgba(2,6,23,.55);

            font-size: 14px;
        }

        input:focus {
            border-color: #3b82f6;

            box-shadow:
                0 0 0 4px
                rgba(59,130,246,.12);
        }

        .hint {
            margin-top: 7px;

            color: #64748b;

            font-size: 11px;
        }

        button {
            width: 100%;

            padding: 15px;

            border: 0;

            border-radius: 13px;

            cursor: pointer;

            color: white;

            background:
                linear-gradient(
                    135deg,
                    #2563eb,
                    #7c3aed
                );

            font-weight: 700;
        }

        .error {
            padding: 12px;

            margin-bottom: 20px;

            border-radius: 12px;

            color: #fca5a5;

            background:
                rgba(239,68,68,.12);

            border:
                1px solid
                rgba(239,68,68,.25);

            font-size: 13px;
        }

        .back {
            display: block;

            margin-top: 20px;

            text-align: center;

            color: #93c5fd;

            font-size: 12px;
        }

        @media(max-width:520px) {
            .card {
                padding:
                    30px 22px;
            }
        }
    </style>
</head>

<body>

<div class="wrapper">

    <div class="card">

        <div class="brand">

            <div class="badge">
                US
            </div>

            <h1>
                Create New Password
            </h1>

            <p>
                Secure your UniSched administrator account.
            </p>

        </div>


        @if($errors->any())

            <div class="error">
                {{ $errors->first() }}
            </div>

        @endif


        <form
            method="POST"
            action="{{ route('admin.password.update') }}"
        >

            @csrf


            <input
                type="hidden"
                name="token"
                value="{{ $token }}"
            >


            <div class="form-group">

                <label>
                    Admin Email
                </label>

                <input
                    type="email"
                    name="email"
                    value="{{ old('email', $email) }}"
                    required
                    readonly
                    autocomplete="email"
                >

            </div>


            <div class="form-group">

                <label>
                    New Password
                </label>

                <input
                    type="password"
                    name="password"
                    placeholder="Enter new password"
                    required
                    autofocus
                    autocomplete="new-password"
                >

                <div class="hint">
                    Minimum 8 characters with letters and numbers.
                </div>

            </div>


            <div class="form-group">

                <label>
                    Confirm New Password
                </label>

                <input
                    type="password"
                    name="password_confirmation"
                    placeholder="Confirm new password"
                    required
                    autocomplete="new-password"
                >

            </div>


            <button type="submit">
                Reset Password
            </button>

        </form>


        <a
            href="{{ route('admin.login') }}"
            class="back"
        >
            ← Back to Admin Login
        </a>

    </div>

</div>

</body>
</html>