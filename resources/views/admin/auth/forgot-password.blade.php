<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Forgot Password | UniSched</title>

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

            overflow: hidden;

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

        .orb {
            position: fixed;

            border-radius: 50%;

            opacity: .5;

            animation:
                float 8s ease-in-out infinite;
        }

        .orb-one {
            width: 260px;
            height: 260px;

            top: -80px;
            left: -70px;

            background:
                rgba(37,99,235,.25);
        }

        .orb-two {
            width: 320px;
            height: 320px;

            right: -100px;
            bottom: -120px;

            background:
                rgba(124,58,237,.20);

            animation-delay: -3s;
        }

        @keyframes float {
            50% {
                transform:
                    translateY(-25px)
                    rotate(10deg);
            }
        }

        .wrapper {
            position: relative;

            z-index: 10;

            width: 100%;
            max-width: 440px;
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

        .icon {
            width: 65px;
            height: 65px;

            margin:
                0 auto
                20px;

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

            box-shadow:
                0 15px 35px
                rgba(37,99,235,.30);

            font-size: 22px;
            font-weight: 800;
        }

        h1 {
            margin: 0;

            text-align: center;

            font-size: 26px;
        }

        .description {
            margin:
                10px 0
                28px;

            text-align: center;

            color: #94a3b8;

            font-size: 13px;

            line-height: 1.7;
        }

        label {
            display: block;

            margin-bottom: 8px;

            color: #cbd5e1;

            font-size: 14px;
            font-weight: 600;
        }

        input {
            width: 100%;

            padding: 15px 16px;

            border:
                1px solid
                rgba(255,255,255,.10);

            border-radius: 13px;

            outline: none;

            color: white;

            background:
                rgba(2,6,23,.55);

            font-size: 15px;
        }

        input:focus {
            border-color: #3b82f6;

            box-shadow:
                0 0 0 4px
                rgba(59,130,246,.12);
        }

        button {
            width: 100%;

            margin-top: 20px;

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

        .back {
            display: block;

            margin-top: 22px;

            text-align: center;

            color: #93c5fd;

            font-size: 13px;
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

<div class="orb orb-one"></div>
<div class="orb orb-two"></div>


<div class="wrapper">

    <div class="card">

        <div class="icon">
            US
        </div>

        <h1>
            Forgot Password?
        </h1>

        <div class="description">
            Enter your registered administrator email.
            UniSched will send a secure password reset link
            to that email address.
        </div>


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
            action="{{ route('admin.password.email') }}"
        >

            @csrf


            <label>
                Registered Admin Email
            </label>

            <input
                type="email"
                name="email"
                value="{{ old('email') }}"
                placeholder="Enter your email"
                required
                autofocus
                autocomplete="email"
            >


            <button type="submit">
                Send Password Reset Link
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