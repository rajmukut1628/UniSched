<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Admin Login | UniSched</title>

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

            color: white;

            display: flex;
            align-items: center;
            justify-content: center;

            overflow: hidden;
        }

        .orb {
            position: fixed;

            border-radius: 50%;

            filter: blur(2px);

            opacity: .5;

            animation:
                float 8s ease-in-out infinite;
        }

        .orb-one {
            width: 260px;
            height: 260px;

            background:
                rgba(37,99,235,.25);

            top: -80px;
            left: -70px;
        }

        .orb-two {
            width: 320px;
            height: 320px;

            background:
                rgba(124,58,237,.20);

            right: -100px;
            bottom: -120px;

            animation-delay: -3s;
        }

        @keyframes float {
            0%,
            100% {
                transform:
                    translateY(0)
                    rotate(0deg);
            }

            50% {
                transform:
                    translateY(-25px)
                    rotate(10deg);
            }
        }

        .login-wrapper {
            width: 100%;
            max-width: 430px;

            padding: 24px;

            position: relative;
            z-index: 10;
        }

        .login-card {
            padding: 42px;

            border-radius: 28px;

            background:
                rgba(15,23,42,.72);

            border:
                1px solid
                rgba(255,255,255,.10);

            backdrop-filter:
                blur(24px);

            box-shadow:
                0 30px 80px
                rgba(0,0,0,.45);
        }

        .brand {
            text-align: center;

            margin-bottom: 34px;
        }

        .brand-badge {
            width: 68px;
            height: 68px;

            margin:
                0 auto
                18px;

            border-radius: 20px;

            display: flex;
            align-items: center;
            justify-content: center;

            font-weight: 800;
            font-size: 25px;

            background:
                linear-gradient(
                    135deg,
                    #2563eb,
                    #7c3aed
                );

            box-shadow:
                0 15px 35px
                rgba(37,99,235,.30);
        }

        .brand h1 {
            margin: 0;

            font-size: 30px;
        }

        .brand p {
            margin:
                8px 0
                0;

            color: #94a3b8;

            font-size: 14px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;

            margin-bottom: 8px;

            color: #cbd5e1;

            font-size: 14px;
            font-weight: 600;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;

            padding: 15px 16px;

            border-radius: 13px;

            border:
                1px solid
                rgba(255,255,255,.10);

            background:
                rgba(2,6,23,.55);

            color: white;

            outline: none;

            font-size: 15px;

            transition: .25s;
        }

        input:focus {
            border-color: #3b82f6;

            box-shadow:
                0 0 0 4px
                rgba(59,130,246,.12);
        }

        .options {
            display: flex;

            align-items: center;
            justify-content: space-between;

            gap: 15px;

            margin-bottom: 22px;
        }

        .remember {
            display: flex;

            align-items: center;

            gap: 9px;

            margin: 0;

            color: #94a3b8;

            font-size: 13px;
            font-weight: 500;

            cursor: pointer;
        }

        .remember input {
            width: 16px;
            height: 16px;
        }

        .forgot {
            color: #93c5fd;

            font-size: 13px;
            font-weight: 600;

            transition: .2s;
        }

        .forgot:hover {
            color: #bfdbfe;
        }

        .login-button {
            width: 100%;

            border: none;

            padding: 15px;

            border-radius: 13px;

            color: white;

            font-size: 15px;
            font-weight: 700;

            cursor: pointer;

            background:
                linear-gradient(
                    135deg,
                    #2563eb,
                    #7c3aed
                );

            transition: .25s;
        }

        .login-button:hover {
            transform:
                translateY(-2px);

            box-shadow:
                0 15px 30px
                rgba(37,99,235,.28);
        }

        .error,
        .success {
            padding: 12px;

            margin-bottom: 20px;

            border-radius: 12px;

            font-size: 13px;

            line-height: 1.5;
        }

        .error {
            color: #fca5a5;

            background:
                rgba(239,68,68,.12);

            border:
                1px solid
                rgba(239,68,68,.25);
        }

        .success {
            color: #86efac;

            background:
                rgba(34,197,94,.10);

            border:
                1px solid
                rgba(34,197,94,.20);
        }

        .home-link {
            display: block;

            margin-top: 18px;

            text-align: center;

            color: #64748b;

            font-size: 12px;

            transition: .2s;
        }

        .home-link:hover {
            color: #94a3b8;
        }

        .footer {
            text-align: center;

            margin-top: 25px;

            color: #64748b;

            font-size: 12px;
        }

        @media (max-width: 520px) {
            .login-card {
                padding:
                    30px 22px;
            }

            .options {
                align-items:
                    flex-start;

                flex-direction:
                    column;
            }
        }
    </style>
</head>

<body>

<div class="orb orb-one"></div>
<div class="orb orb-two"></div>

<div class="login-wrapper">

    <div class="login-card">

        <div class="brand">

            <div class="brand-badge">
                US
            </div>

            <h1>
                UniSched
            </h1>

            <p>
                Intelligent Academic Scheduling System
            </p>

        </div>


        @if(session('success'))

            <div class="success">
                {{ session('success') }}
            </div>

        @endif


        @if(session('status'))

            <div class="success">
                {{ session('status') }}
            </div>

        @endif


        @if($errors->any())

            <div class="error">
                {{ $errors->first() }}
            </div>

        @endif


        <form
            method="POST"
            action="{{ route('admin.login.submit') }}"
        >

            @csrf


            <div class="form-group">

                <label>
                    Admin Email
                </label>

                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="Enter registered admin email"
                    required
                    autofocus
                    autocomplete="email"
                >

            </div>


            <div class="form-group">

                <label>
                    Password
                </label>

                <input
                    type="password"
                    name="password"
                    placeholder="Enter your password"
                    required
                    autocomplete="current-password"
                >

            </div>


            <div class="options">

                <label class="remember">

                    <input
                        type="checkbox"
                        name="remember"
                        value="1"
                    >

                    Remember me

                </label>


                <a
                    href="{{ route('admin.password.request') }}"
                    class="forgot"
                >
                    Forgot Password?
                </a>

            </div>


            <button
                type="submit"
                class="login-button"
            >
                Sign In to Dashboard
            </button>

        </form>


        <a
            href="{{ route('home') }}"
            class="home-link"
        >
            ← Back to UniSched
        </a>


        <div class="footer">
            UniSched • Academic Scheduling Administration
        </div>

    </div>

</div>

</body>
</html>