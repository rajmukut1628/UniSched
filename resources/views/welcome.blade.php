<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <meta name="theme-color" content="#030712">

    <title>UniSched | Intelligent Academic Scheduling</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* ============================================================
           RESET
        ============================================================ */

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            min-height: 100vh;
            overflow-x: hidden;

            font-family:
                Inter,
                ui-sans-serif,
                system-ui,
                -apple-system,
                BlinkMacSystemFont,
                "Segoe UI",
                sans-serif;

            color: #f8fafc;

            background:
                radial-gradient(
                    circle at 72% 22%,
                    rgba(37, 99, 235, .17),
                    transparent 28%
                ),
                radial-gradient(
                    circle at 18% 78%,
                    rgba(124, 58, 237, .12),
                    transparent 28%
                ),
                radial-gradient(
                    circle at 50% 50%,
                    rgba(14, 165, 233, .035),
                    transparent 40%
                ),
                #02050d;
        }

        body::-webkit-scrollbar {
            width: 7px;
        }

        body::-webkit-scrollbar-track {
            background: #02050d;
        }

        body::-webkit-scrollbar-thumb {
            background:
                linear-gradient(
                    #2563eb,
                    #7c3aed
                );

            border-radius: 10px;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        button {
            font: inherit;
        }

        ::selection {
            color: white;
            background: #2563eb;
        }


        /* ============================================================
           MAIN WORLD
        ============================================================ */

        .world {
            position: relative;

            min-height: 100vh;

            overflow: hidden;

            isolation: isolate;
        }


        /* ============================================================
           ANIMATED BACKGROUND
        ============================================================ */

        .background {
            position: fixed;

            inset: 0;

            z-index: -20;

            overflow: hidden;

            pointer-events: none;
        }

        .background::before {
            content: "";

            position: absolute;

            inset: -50%;

            background:
                conic-gradient(
                    from 180deg at 50% 50%,
                    transparent,
                    rgba(37, 99, 235, .035),
                    transparent,
                    rgba(124, 58, 237, .025),
                    transparent
                );

            animation:
                backgroundRotate 40s linear infinite;
        }

        @keyframes backgroundRotate {
            to {
                transform: rotate(360deg);
            }
        }


        /* ============================================================
           MOVING GRID
        ============================================================ */

        .grid-layer {
            position: absolute;

            inset: -100px;

            opacity: .34;

            background-image:
                linear-gradient(
                    rgba(96, 165, 250, .035) 1px,
                    transparent 1px
                ),
                linear-gradient(
                    90deg,
                    rgba(96, 165, 250, .035) 1px,
                    transparent 1px
                );

            background-size:
                65px 65px;

            transform:
                perspective(800px)
                rotateX(62deg)
                scale(1.45)
                translateY(25%);

            transform-origin:
                center bottom;

            mask-image:
                linear-gradient(
                    to top,
                    black,
                    transparent 78%
                );

            animation:
                gridMove 10s linear infinite;
        }

        @keyframes gridMove {
            from {
                background-position:
                    0 0,
                    0 0;
            }

            to {
                background-position:
                    0 65px,
                    65px 0;
            }
        }


        /* ============================================================
           GLOW CLOUDS
        ============================================================ */

        .glow {
            position: absolute;

            border-radius: 50%;

            filter: blur(100px);

            opacity: .6;

            animation:
                glowFloat 13s ease-in-out infinite;
        }

        .glow-one {
            width: 500px;
            height: 500px;

            right: -120px;
            top: -130px;

            background:
                rgba(37, 99, 235, .18);
        }

        .glow-two {
            width: 450px;
            height: 450px;

            left: -160px;
            bottom: -150px;

            background:
                rgba(124, 58, 237, .13);

            animation-delay: -5s;
        }

        .glow-three {
            width: 320px;
            height: 320px;

            left: 45%;
            top: 40%;

            background:
                rgba(14, 165, 233, .06);

            animation-delay: -8s;
        }

        @keyframes glowFloat {
            0%,
            100% {
                transform:
                    translate3d(0, 0, 0)
                    scale(1);
            }

            50% {
                transform:
                    translate3d(30px, -35px, 0)
                    scale(1.12);
            }
        }


        /* ============================================================
           PARTICLES
        ============================================================ */

        #particles {
            position: absolute;

            inset: 0;

            overflow: hidden;
        }

        .particle {
            position: absolute;

            width: 3px;
            height: 3px;

            border-radius: 50%;

            background:
                rgba(147, 197, 253, .65);

            box-shadow:
                0 0 14px
                rgba(59, 130, 246, .8);

            animation:
                particleMove linear infinite;
        }

        @keyframes particleMove {
            0% {
                opacity: 0;

                transform:
                    translateY(80px)
                    scale(.3);
            }

            15% {
                opacity: .8;
            }

            80% {
                opacity: .45;
            }

            100% {
                opacity: 0;

                transform:
                    translateY(-100vh)
                    scale(1.3);
            }
        }


        /* ============================================================
           FLOATING DECORATIVE SPHERES
        ============================================================ */

        .decor-sphere {
            position: absolute;

            border-radius: 50%;

            pointer-events: none;

            background:
                radial-gradient(
                    circle at 30% 25%,
                    rgba(255, 255, 255, .55),
                    rgba(96, 165, 250, .18) 16%,
                    rgba(37, 99, 235, .07) 45%,
                    transparent 72%
                );

            border:
                1px solid rgba(147, 197, 253, .12);

            box-shadow:
                inset -20px -20px 45px
                rgba(2, 6, 23, .6),
                0 0 45px
                rgba(37, 99, 235, .08);

            animation:
                sphereFloat 8s ease-in-out infinite;
        }

        .sphere-a {
            width: 60px;
            height: 60px;

            left: 4%;
            top: 23%;
        }

        .sphere-b {
            width: 28px;
            height: 28px;

            left: 47%;
            top: 17%;

            animation-delay: -3s;
        }

        .sphere-c {
            width: 44px;
            height: 44px;

            right: 4%;
            bottom: 15%;

            animation-delay: -5s;
        }

        @keyframes sphereFloat {
            0%,
            100% {
                transform:
                    translate3d(0, 0, 0)
                    rotate(0deg);
            }

            50% {
                transform:
                    translate3d(0, -25px, 0)
                    rotate(180deg);
            }
        }


        /* ============================================================
           NAVBAR
        ============================================================ */

        .navbar-shell {
            position: relative;

            z-index: 100;

            width:
                min(1500px, calc(100% - 48px));

            margin: auto;

            padding-top: 20px;
        }

        .navbar {
            display: flex;

            align-items: center;
            justify-content: space-between;

            gap: 20px;

            padding:
                11px 12px
                11px 15px;

            border:
                1px solid rgba(255, 255, 255, .07);

            border-radius: 18px;

            background:
                rgba(7, 12, 24, .54);

            box-shadow:
                0 20px 70px
                rgba(0, 0, 0, .18),
                inset 0 1px 0
                rgba(255, 255, 255, .035);

            backdrop-filter:
                blur(22px);

            -webkit-backdrop-filter:
                blur(22px);
        }

        .brand {
            display: flex;

            align-items: center;

            gap: 12px;
        }

        .brand-logo {
            position: relative;

            width: 45px;
            height: 45px;

            display: grid;

            place-items: center;

            border-radius: 14px;

            overflow: hidden;

            background:
                linear-gradient(
                    135deg,
                    #2563eb,
                    #7c3aed
                );

            box-shadow:
                0 13px 35px
                rgba(37, 99, 235, .27);

            font-size: 11px;
            font-weight: 950;
        }

        .brand-logo::before {
            content: "";

            position: absolute;

            width: 70px;
            height: 15px;

            background:
                rgba(255, 255, 255, .22);

            transform:
                rotate(-45deg)
                translateY(-40px);

            animation:
                logoShine 5s ease-in-out infinite;
        }

        @keyframes logoShine {
            0%,
            60% {
                transform:
                    rotate(-45deg)
                    translateY(-55px);
            }

            78% {
                transform:
                    rotate(-45deg)
                    translateY(55px);
            }

            100% {
                transform:
                    rotate(-45deg)
                    translateY(55px);
            }
        }

        .brand-text {
            line-height: 1;
        }

        .brand-name {
            font-size: 22px;

            font-weight: 950;

            letter-spacing: -.7px;
        }

        .brand-name span {
            color: #60a5fa;
        }

        .brand-subtitle {
            margin-top: 6px;

            color: #475569;

            font-size: 7px;

            font-weight: 800;

            letter-spacing: 1.5px;
        }

        .nav-links {
            display: flex;

            align-items: center;

            gap: 3px;
        }

        .nav-link {
            position: relative;

            padding: 10px 12px;

            border-radius: 9px;

            color: #64748b;

            font-size: 9px;

            font-weight: 850;

            transition:
                color .2s,
                background .2s;
        }

        .nav-link:hover {
            color: #dbeafe;

            background:
                rgba(255, 255, 255, .035);
        }

        .admin-login {
            position: relative;

            overflow: hidden;

            display: inline-flex;

            align-items: center;
            justify-content: center;

            gap: 7px;

            padding: 11px 15px;

            margin-left: 4px;

            border:
                1px solid rgba(96, 165, 250, .18);

            border-radius: 10px;

            color: #dbeafe;

            background:
                linear-gradient(
                    135deg,
                    rgba(37, 99, 235, .15),
                    rgba(124, 58, 237, .08)
                );

            font-size: 9px;

            font-weight: 900;

            transition: .25s ease;
        }

        .admin-login:hover {
            transform:
                translateY(-2px);

            border-color:
                rgba(96, 165, 250, .35);

            box-shadow:
                0 10px 30px
                rgba(37, 99, 235, .12);
        }

        .admin-dot {
            width: 5px;
            height: 5px;

            border-radius: 50%;

            background: #60a5fa;

            box-shadow:
                0 0 10px
                #3b82f6;
        }


        /* ============================================================
           HERO
        ============================================================ */

        .hero {
            position: relative;

            z-index: 10;

            width:
                min(1500px, calc(100% - 48px));

            min-height:
                calc(100vh - 85px);

            margin: auto;

            display: grid;

            grid-template-columns:
                minmax(0, 1.02fr)
                minmax(520px, .98fr);

            gap: 35px;

            align-items: center;

            padding:
                45px 0
                80px;
        }


        /* ============================================================
           LEFT HERO
        ============================================================ */

        .hero-copy {
            position: relative;

            z-index: 5;

            max-width: 760px;
        }

        .eyebrow {
            display: inline-flex;

            align-items: center;

            gap: 8px;

            padding: 7px 11px;

            margin-bottom: 21px;

            border:
                1px solid rgba(96, 165, 250, .13);

            border-radius: 999px;

            color: #93c5fd;

            background:
                rgba(37, 99, 235, .055);

            box-shadow:
                inset 0 1px 0
                rgba(255, 255, 255, .025);

            font-size: 8px;

            font-weight: 900;

            letter-spacing: 1.5px;
        }

        .eyebrow-pulse {
            position: relative;

            width: 6px;
            height: 6px;

            border-radius: 50%;

            background: #60a5fa;
        }

        .eyebrow-pulse::before {
            content: "";

            position: absolute;

            inset: -5px;

            border:
                1px solid rgba(96, 165, 250, .5);

            border-radius: 50%;

            animation:
                pulseRing 2s ease-out infinite;
        }

        @keyframes pulseRing {
            from {
                opacity: .8;
                transform: scale(.4);
            }

            to {
                opacity: 0;
                transform: scale(1.5);
            }
        }

        .hero-title {
            max-width: 800px;

            font-size:
                clamp(48px, 6vw, 86px);

            line-height: .96;

            letter-spacing:
                clamp(-5px, -.4vw, -2px);

            font-weight: 950;
        }

        .hero-title-line {
            display: block;
        }

        .hero-gradient {
            position: relative;

            display: inline-block;

            color: transparent;

            background:
                linear-gradient(
                    100deg,
                    #60a5fa,
                    #818cf8,
                    #c084fc,
                    #67e8f9,
                    #60a5fa
                );

            background-size: 300% 100%;

            background-clip: text;
            -webkit-background-clip: text;

            animation:
                textFlow 7s linear infinite;
        }

        @keyframes textFlow {
            to {
                background-position: 300% center;
            }
        }

        .hero-description {
            max-width: 650px;

            margin-top: 25px;

            color: #7f8ca3;

            font-size: 13px;

            line-height: 1.85;
        }

        .hero-description strong {
            color: #cbd5e1;
            font-weight: 700;
        }


        /* ============================================================
           HERO BUTTONS
        ============================================================ */

        .hero-actions {
            display: flex;

            flex-wrap: wrap;

            gap: 9px;

            margin-top: 29px;
        }

        .button {
            position: relative;

            overflow: hidden;

            display: inline-flex;

            align-items: center;
            justify-content: center;

            gap: 9px;

            min-height: 46px;

            padding:
                0 18px;

            border-radius: 11px;

            font-size: 9px;

            font-weight: 900;

            transition:
                transform .25s ease,
                box-shadow .25s ease,
                border-color .25s ease;
        }

        .button:hover {
            transform:
                translateY(-3px);
        }

        .button-primary {
            color: white;

            background:
                linear-gradient(
                    135deg,
                    #2563eb,
                    #4f46e5,
                    #7c3aed
                );

            box-shadow:
                0 15px 45px
                rgba(37, 99, 235, .23);
        }

        .button-primary::before {
            content: "";

            position: absolute;

            width: 70px;
            height: 150px;

            top: -50px;
            left: -120px;

            transform: rotate(25deg);

            background:
                rgba(255, 255, 255, .17);

            filter: blur(5px);

            transition:
                left .6s ease;
        }

        .button-primary:hover::before {
            left: 120%;
        }

        .button-secondary {
            color: #cbd5e1;

            border:
                1px solid rgba(255, 255, 255, .07);

            background:
                rgba(255, 255, 255, .025);

            backdrop-filter:
                blur(10px);
        }

        .button-secondary:hover {
            border-color:
                rgba(96, 165, 250, .18);

            box-shadow:
                0 12px 35px
                rgba(0, 0, 0, .2);
        }

        .button-arrow {
            font-size: 14px;

            transition:
                transform .2s ease;
        }

        .button:hover .button-arrow {
            transform:
                translateX(3px);
        }


        /* ============================================================
           TRUST / FEATURE ROW
        ============================================================ */

        .trust-row {
            display: flex;

            flex-wrap: wrap;

            gap: 8px;

            margin-top: 27px;
        }

        .trust-item {
            display: flex;

            align-items: center;

            gap: 6px;

            padding: 7px 9px;

            border:
                1px solid rgba(255, 255, 255, .045);

            border-radius: 8px;

            color: #536178;

            background:
                rgba(255, 255, 255, .018);

            font-size: 7px;

            font-weight: 850;

            letter-spacing: .5px;
        }

        .trust-check {
            color: #60a5fa;
        }


        /* ============================================================
           3D UNIVERSE
        ============================================================ */

        .visual {
            position: relative;

            min-height: 650px;

            display: grid;

            place-items: center;

            perspective: 1400px;

            transform-style: preserve-3d;
        }

        .visual-scene {
            position: relative;

            width: 600px;
            height: 600px;

            transform-style: preserve-3d;

            transition:
                transform .15s ease-out;
        }


        /* ============================================================
           CENTRAL SPHERE
        ============================================================ */

        .core {
            position: absolute;

            left: 50%;
            top: 50%;

            width: 185px;
            height: 185px;

            transform:
                translate(-50%, -50%);

            border-radius: 50%;

            background:
                radial-gradient(
                    circle at 32% 27%,
                    rgba(255, 255, 255, .85),
                    rgba(147, 197, 253, .42) 9%,
                    rgba(59, 130, 246, .20) 28%,
                    rgba(37, 99, 235, .10) 48%,
                    rgba(2, 6, 23, .86) 74%
                );

            border:
                1px solid rgba(147, 197, 253, .19);

            box-shadow:
                inset -30px -30px 60px
                rgba(2, 6, 23, .85),
                inset 20px 20px 45px
                rgba(96, 165, 250, .08),
                0 0 50px
                rgba(37, 99, 235, .22),
                0 0 120px
                rgba(37, 99, 235, .12);

            animation:
                coreFloat 5s ease-in-out infinite;

            z-index: 10;
        }

        .core::before {
            content: "";

            position: absolute;

            inset: 19px;

            border-radius: 50%;

            border:
                1px solid rgba(147, 197, 253, .08);

            animation:
                coreInnerSpin 8s linear infinite;
        }

        .core::after {
            content: "";

            position: absolute;

            width: 48px;
            height: 19px;

            left: 36px;
            top: 27px;

            border-radius: 50%;

            transform: rotate(-35deg);

            background:
                rgba(255, 255, 255, .22);

            filter: blur(6px);
        }

        @keyframes coreFloat {
            0%,
            100% {
                transform:
                    translate(-50%, -50%)
                    translateY(0)
                    rotate(0deg);
            }

            50% {
                transform:
                    translate(-50%, -50%)
                    translateY(-10px)
                    rotate(3deg);
            }
        }

        @keyframes coreInnerSpin {
            to {
                transform: rotate(360deg);
            }
        }

        .core-content {
            position: absolute;

            inset: 0;

            display: flex;

            align-items: center;
            justify-content: center;

            flex-direction: column;

            z-index: 3;

            text-align: center;
        }

        .core-logo {
            font-size: 26px;

            font-weight: 950;

            letter-spacing: -1px;
        }

        .core-logo span {
            color: #93c5fd;
        }

        .core-subtitle {
            margin-top: 4px;

            color: #94a3b8;

            font-size: 6px;

            font-weight: 900;

            letter-spacing: 1.4px;
        }


        /* ============================================================
           ORBITAL RINGS
        ============================================================ */

        .orbit {
            position: absolute;

            left: 50%;
            top: 50%;

            border-radius: 50%;

            border:
                1px solid rgba(96, 165, 250, .12);

            transform-style: preserve-3d;

            pointer-events: none;
        }

        .orbit-one {
            width: 310px;
            height: 310px;

            margin:
                -155px 0 0
                -155px;

            transform:
                rotateX(68deg)
                rotateZ(10deg);

            animation:
                orbitOneSpin 10s linear infinite;
        }

        .orbit-two {
            width: 430px;
            height: 430px;

            margin:
                -215px 0 0
                -215px;

            border-color:
                rgba(167, 139, 250, .10);

            transform:
                rotateX(74deg)
                rotateY(22deg)
                rotateZ(-20deg);

            animation:
                orbitTwoSpin 16s linear infinite reverse;
        }

        .orbit-three {
            width: 545px;
            height: 545px;

            margin:
                -272.5px 0 0
                -272.5px;

            border-color:
                rgba(103, 232, 249, .07);

            transform:
                rotateX(60deg)
                rotateY(-18deg)
                rotateZ(35deg);

            animation:
                orbitThreeSpin 24s linear infinite;
        }

        @keyframes orbitOneSpin {
            from {
                transform:
                    rotateX(68deg)
                    rotateZ(0deg);
            }

            to {
                transform:
                    rotateX(68deg)
                    rotateZ(360deg);
            }
        }

        @keyframes orbitTwoSpin {
            from {
                transform:
                    rotateX(74deg)
                    rotateY(22deg)
                    rotateZ(0deg);
            }

            to {
                transform:
                    rotateX(74deg)
                    rotateY(22deg)
                    rotateZ(360deg);
            }
        }

        @keyframes orbitThreeSpin {
            from {
                transform:
                    rotateX(60deg)
                    rotateY(-18deg)
                    rotateZ(0deg);
            }

            to {
                transform:
                    rotateX(60deg)
                    rotateY(-18deg)
                    rotateZ(360deg);
            }
        }


        /* ============================================================
           ORBITAL OBJECTS
        ============================================================ */

        .orbital-node {
            position: absolute;

            left: 50%;
            top: -7px;

            width: 14px;
            height: 14px;

            margin-left: -7px;

            border-radius: 50%;

            background:
                radial-gradient(
                    circle at 35% 30%,
                    white,
                    #60a5fa 25%,
                    #2563eb 60%,
                    #172554
                );

            box-shadow:
                0 0 18px
                rgba(59, 130, 246, .85),
                0 0 40px
                rgba(59, 130, 246, .3);
        }

        .node-purple {
            background:
                radial-gradient(
                    circle at 35% 30%,
                    white,
                    #c084fc 25%,
                    #7c3aed 60%,
                    #2e1065
                );

            box-shadow:
                0 0 18px
                rgba(168, 85, 247, .8),
                0 0 40px
                rgba(124, 58, 237, .25);
        }

        .node-cyan {
            background:
                radial-gradient(
                    circle at 35% 30%,
                    white,
                    #67e8f9 25%,
                    #0891b2 60%,
                    #083344
                );

            box-shadow:
                0 0 18px
                rgba(34, 211, 238, .7);
        }


        /* ============================================================
           ROTATING ENERGY DISCS
        ============================================================ */

        .energy-disc {
            position: absolute;

            left: 50%;
            top: 50%;

            border-radius: 50%;

            pointer-events: none;
        }

        .energy-disc-one {
            width: 245px;
            height: 245px;

            margin:
                -122.5px 0 0
                -122.5px;

            border:
                1px dashed
                rgba(96, 165, 250, .11);

            animation:
                discSpin 13s linear infinite;
        }

        .energy-disc-two {
            width: 275px;
            height: 275px;

            margin:
                -137.5px 0 0
                -137.5px;

            border:
                1px dotted
                rgba(167, 139, 250, .09);

            animation:
                discSpin 19s linear infinite reverse;
        }

        @keyframes discSpin {
            to {
                transform: rotate(360deg);
            }
        }


        /* ============================================================
           PORTAL CARDS AROUND SPHERE
        ============================================================ */

        .portal-card {
            position: absolute;

            z-index: 20;

            width: 195px;

            padding: 14px;

            border:
                1px solid rgba(255, 255, 255, .075);

            border-radius: 15px;

            background:
                linear-gradient(
                    145deg,
                    rgba(15, 23, 42, .77),
                    rgba(7, 12, 24, .58)
                );

            box-shadow:
                0 20px 60px
                rgba(0, 0, 0, .22),
                inset 0 1px 0
                rgba(255, 255, 255, .035);

            backdrop-filter:
                blur(18px);

            -webkit-backdrop-filter:
                blur(18px);

            transition:
                transform .25s ease,
                border-color .25s ease,
                background .25s ease;
        }

        .portal-card:hover {
            border-color:
                rgba(96, 165, 250, .22);

            background:
                linear-gradient(
                    145deg,
                    rgba(18, 32, 58, .9),
                    rgba(9, 16, 31, .78)
                );
        }

        .student-card {
            left: 5px;
            top: 112px;

            animation:
                cardFloatOne 6s ease-in-out infinite;
        }

        .faculty-card {
            right: -3px;
            top: 185px;

            animation:
                cardFloatTwo 7s ease-in-out infinite;
        }

        .admin-card {
            left: 48px;
            bottom: 90px;

            animation:
                cardFloatThree 7.5s ease-in-out infinite;
        }

        @keyframes cardFloatOne {
            0%,
            100% {
                transform:
                    translate3d(0, 0, 35px)
                    rotateY(8deg);
            }

            50% {
                transform:
                    translate3d(0, -13px, 55px)
                    rotateY(3deg);
            }
        }

        @keyframes cardFloatTwo {
            0%,
            100% {
                transform:
                    translate3d(0, 0, 45px)
                    rotateY(-8deg);
            }

            50% {
                transform:
                    translate3d(0, 14px, 65px)
                    rotateY(-3deg);
            }
        }

        @keyframes cardFloatThree {
            0%,
            100% {
                transform:
                    translate3d(0, 0, 30px)
                    rotateX(2deg);
            }

            50% {
                transform:
                    translate3d(12px, -10px, 50px)
                    rotateX(-2deg);
            }
        }

        .portal-card-top {
            display: flex;

            align-items: center;

            gap: 9px;
        }

        .portal-icon {
            width: 35px;
            height: 35px;

            flex: 0 0 35px;

            display: grid;

            place-items: center;

            border-radius: 10px;

            color: #bfdbfe;

            background:
                linear-gradient(
                    145deg,
                    rgba(37, 99, 235, .17),
                    rgba(124, 58, 237, .08)
                );

            border:
                1px solid rgba(96, 165, 250, .08);

            font-size: 8px;

            font-weight: 950;
        }

        .portal-name {
            color: #e2e8f0;

            font-size: 9px;

            font-weight: 900;
        }

        .portal-caption {
            margin-top: 3px;

            color: #536178;

            font-size: 6.5px;

            line-height: 1.4;
        }

        .portal-bottom {
            display: flex;

            align-items: center;
            justify-content: space-between;

            gap: 8px;

            margin-top: 11px;

            padding-top: 9px;

            border-top:
                1px solid rgba(255, 255, 255, .045);
        }

        .portal-status {
            display: flex;

            align-items: center;

            gap: 5px;

            color: #64748b;

            font-size: 6px;

            font-weight: 850;
        }

        .status-dot {
            width: 5px;
            height: 5px;

            border-radius: 50%;

            background: #22c55e;

            box-shadow:
                0 0 8px
                rgba(34, 197, 94, .7);
        }

        .portal-arrow {
            color: #60a5fa;

            font-size: 12px;

            transition:
                transform .2s ease;
        }

        .portal-card:hover .portal-arrow {
            transform:
                translateX(3px);
        }


        /* ============================================================
           FLOATING DATA CARDS
        ============================================================ */

        .data-chip {
            position: absolute;

            z-index: 15;

            display: flex;

            align-items: center;

            gap: 7px;

            padding: 8px 10px;

            border:
                1px solid rgba(255, 255, 255, .06);

            border-radius: 999px;

            color: #64748b;

            background:
                rgba(7, 12, 24, .65);

            backdrop-filter:
                blur(15px);

            font-size: 6.5px;

            font-weight: 850;

            white-space: nowrap;
        }

        .data-chip-one {
            right: 55px;
            bottom: 70px;

            animation:
                chipFloat 5s ease-in-out infinite;
        }

        .data-chip-two {
            right: 38px;
            top: 83px;

            animation:
                chipFloat 6s ease-in-out infinite -2s;
        }

        @keyframes chipFloat {
            50% {
                transform:
                    translateY(-10px);
            }
        }

        .chip-light {
            width: 5px;
            height: 5px;

            border-radius: 50%;

            background: #60a5fa;

            box-shadow:
                0 0 10px
                rgba(96, 165, 250, .7);
        }


        /* ============================================================
           BOTTOM SYSTEM STRIP
        ============================================================ */

        .system-strip {
            position: relative;

            z-index: 20;

            width:
                min(1500px, calc(100% - 48px));

            margin:
                -55px auto
                30px;

            display: grid;

            grid-template-columns:
                repeat(4, 1fr);

            border:
                1px solid rgba(255, 255, 255, .055);

            border-radius: 16px;

            overflow: hidden;

            background:
                rgba(7, 12, 24, .5);

            backdrop-filter:
                blur(18px);

            box-shadow:
                0 20px 60px
                rgba(0, 0, 0, .13);
        }

        .system-item {
            position: relative;

            padding: 15px 18px;

            border-right:
                1px solid rgba(255, 255, 255, .045);
        }

        .system-item:last-child {
            border-right: 0;
        }

        .system-value {
            color: #cbd5e1;

            font-size: 10px;

            font-weight: 900;
        }

        .system-label {
            margin-top: 4px;

            color: #3f4b60;

            font-size: 6.5px;

            font-weight: 850;

            letter-spacing: .7px;
        }


        /* ============================================================
           MOUSE LIGHT
        ============================================================ */

        .mouse-light {
            position: fixed;

            width: 500px;
            height: 500px;

            left: 0;
            top: 0;

            z-index: -5;

            border-radius: 50%;

            transform:
                translate(-50%, -50%);

            background:
                radial-gradient(
                    circle,
                    rgba(59, 130, 246, .065),
                    transparent 65%
                );

            pointer-events: none;

            opacity: 0;

            transition:
                opacity .3s ease;
        }


        /* ============================================================
           MOBILE
        ============================================================ */

        @media (max-width: 1200px) {
            .hero {
                grid-template-columns:
                    minmax(0, 1fr)
                    500px;
            }

            .visual-scene {
                transform:
                    scale(.86);
            }
        }

        @media (max-width: 1020px) {
            .nav-link {
                display: none;
            }

            .hero {
                grid-template-columns: 1fr;

                gap: 20px;

                padding-top: 80px;
            }

            .hero-copy {
                max-width: 850px;

                margin: auto;

                text-align: center;
            }

            .hero-description {
                margin-left: auto;
                margin-right: auto;
            }

            .hero-actions,
            .trust-row {
                justify-content: center;
            }

            .visual {
                min-height: 620px;
            }

            .system-strip {
                margin-top: 0;
            }
        }

        @media (max-width: 700px) {
            .navbar-shell,
            .hero,
            .system-strip {
                width:
                    min(100% - 26px, 1500px);
            }

            .navbar {
                border-radius: 14px;
            }

            .brand-subtitle {
                display: none;
            }

            .brand-name {
                font-size: 19px;
            }

            .hero {
                padding-top: 60px;
            }

            .hero-title {
                font-size:
                    clamp(44px, 14vw, 68px);

                letter-spacing: -3px;
            }

            .hero-description {
                font-size: 11px;
            }

            .visual {
                min-height: 520px;

                overflow: visible;
            }

            .visual-scene {
                width: 600px;
                height: 600px;

                transform:
                    scale(.68);
            }

            .system-strip {
                grid-template-columns:
                    1fr 1fr;
            }

            .system-item:nth-child(2) {
                border-right: 0;
            }

            .system-item:nth-child(-n+2) {
                border-bottom:
                    1px solid rgba(255, 255, 255, .045);
            }
        }

        @media (max-width: 480px) {
            .admin-login {
                padding:
                    10px 11px;
            }

            .admin-login-text {
                display: none;
            }

            .visual {
                min-height: 470px;
            }

            .visual-scene {
                transform:
                    scale(.59);
            }

            .button {
                flex: 1 1 100%;
            }
        }


        /* ============================================================
           REDUCED MOTION
        ============================================================ */

        @media (
            prefers-reduced-motion: reduce
        ) {
            *,
            *::before,
            *::after {
                animation-duration:
                    .01ms !important;

                animation-iteration-count:
                    1 !important;

                scroll-behavior:
                    auto !important;
            }
        }
    /* ============================================================
   CLICK / NAVIGATION FIX
============================================================ */

/* Navbar always stays above every 3D/animated layer */
.navbar-shell {
    position: relative !important;
    z-index: 99999 !important;
    pointer-events: auto !important;
}

.navbar {
    position: relative !important;
    z-index: 99999 !important;
    pointer-events: auto !important;
}

.nav-links {
    position: relative !important;
    z-index: 100000 !important;
    pointer-events: auto !important;
}

.nav-link,
.admin-login,
.brand {
    position: relative !important;
    z-index: 100001 !important;
    pointer-events: auto !important;
    cursor: pointer !important;
}


/* Decorative background must never block clicks */
.background,
.grid-layer,
.glow,
#particles,
.particle,
.mouse-light,
.decor-sphere {
    pointer-events: none !important;
}


/* Hero visual itself should not block other areas */
.visual {
    pointer-events: none !important;
}

.visual-scene {
    pointer-events: none !important;
}

.core,
.orbit,
.energy-disc,
.orbital-node,
.data-chip {
    pointer-events: none !important;
}


/* But actual portal cards remain clickable */
.portal-card {
    pointer-events: auto !important;
    cursor: pointer !important;
}


/* Hero buttons must remain clickable */
.hero-copy,
.hero-actions {
    position: relative !important;
    z-index: 100 !important;
    pointer-events: auto !important;
}

.button {
    position: relative !important;
    z-index: 101 !important;
    pointer-events: auto !important;
    cursor: pointer !important;
}
    </style>
</head>

<body>

<div class="world">

    <!-- =========================================================
         ANIMATED BACKGROUND
    ========================================================== -->

    <div class="background">

        <div class="grid-layer"></div>

        <div class="glow glow-one"></div>
        <div class="glow glow-two"></div>
        <div class="glow glow-three"></div>

        <div id="particles"></div>

    </div>


    <div class="mouse-light"
         id="mouseLight"></div>


    <div class="decor-sphere sphere-a"></div>
    <div class="decor-sphere sphere-b"></div>
    <div class="decor-sphere sphere-c"></div>


    <!-- =========================================================
         NAVBAR
    ========================================================== -->

    <div class="navbar-shell">

        <nav class="navbar">

            <a href="{{ route('home') }}"
               class="brand">

                <div class="brand-logo">
                    US
                </div>

                <div class="brand-text">

                    <div class="brand-name">
                        Uni<span>Sched</span>
                    </div>

                    <div class="brand-subtitle">
                        INTELLIGENT ACADEMIC SCHEDULING
                    </div>

                </div>

            </a>


            <div class="nav-links">

                <a href="{{ route('home') }}"
                   class="nav-link">
                    Home
                </a>

                <a href="{{ route('public.routine') }}"
                   class="nav-link">
                    Student Routine
                </a>

                <a href="{{ route('public.faculty-routine') }}"
                   class="nav-link">
                    Faculty Routine
                </a>

                <a href="{{ route('admin.login') }}"
                   class="admin-login">

                    <span class="admin-dot"></span>

                    <span class="admin-login-text">
                        Admin Login
                    </span>

                </a>

            </div>

        </nav>

    </div>


    <!-- =========================================================
         HERO
    ========================================================== -->

    <main class="hero">


        <!-- =====================================================
             LEFT CONTENT
        ====================================================== -->

        <section class="hero-copy">

            <div class="eyebrow">

                <span class="eyebrow-pulse"></span>

                NEXT-GENERATION ACADEMIC SCHEDULING

            </div>


            <h1 class="hero-title">

                <span class="hero-title-line">
                    Smarter routines.
                </span>

                <span class="hero-title-line hero-gradient">
                    Zero chaos.
                </span>

            </h1>


            <p class="hero-description">

                <strong>UniSched</strong> transforms academic
                scheduling into one intelligent ecosystem.

                Students access their official classes,
                faculty view their teaching schedules,
                while administrators build and publish
                conflict-protected routines from one
                powerful platform.

            </p>


            <div class="hero-actions">

                <a href="{{ route('public.routine') }}"
                   class="button button-primary">

                    Student Routine

                    <span class="button-arrow">
                        →
                    </span>

                </a>


                <a href="{{ route('public.faculty-routine') }}"
                   class="button button-secondary">

                    Faculty Routine

                    <span class="button-arrow">
                        →
                    </span>

                </a>

            </div>


            <div class="trust-row">

                <div class="trust-item">
                    <span class="trust-check">✓</span>
                    CONFLICT PROTECTED
                </div>

                <div class="trust-item">
                    <span class="trust-check">✓</span>
                    FACULTY AWARE
                </div>

                <div class="trust-item">
                    <span class="trust-check">✓</span>
                    ROOM OPTIMIZED
                </div>

                <div class="trust-item">
                    <span class="trust-check">✓</span>
                    PUBLISHED ONLY
                </div>

            </div>

        </section>


        <!-- =====================================================
             3D VISUAL
        ====================================================== -->

        <section class="visual"
                 id="visual">

            <div class="visual-scene"
                 id="visualScene">


                <!-- Energy Discs -->

                <div class="energy-disc
                            energy-disc-one"></div>

                <div class="energy-disc
                            energy-disc-two"></div>


                <!-- Outer Orbits -->

                <div class="orbit orbit-three">

                    <div class="orbital-node
                                node-cyan">
                    </div>

                </div>


                <div class="orbit orbit-two">

                    <div class="orbital-node
                                node-purple">
                    </div>

                </div>


                <div class="orbit orbit-one">

                    <div class="orbital-node">
                    </div>

                </div>


                <!-- Central 3D Sphere -->

                <div class="core">

                    <div class="core-content">

                        <div class="core-logo">
                            Uni<span>Sched</span>
                        </div>

                        <div class="core-subtitle">
                            SMART SCHEDULING CORE
                        </div>

                    </div>

                </div>


                <!-- Student Card -->

                <a href="{{ route('public.routine') }}"
                   class="portal-card student-card">

                    <div class="portal-card-top">

                        <div class="portal-icon">
                            ST
                        </div>

                        <div>

                            <div class="portal-name">
                                Student Portal
                            </div>

                            <div class="portal-caption">
                                Semester & section routine
                            </div>

                        </div>

                    </div>


                    <div class="portal-bottom">

                        <div class="portal-status">

                            <span class="status-dot"></span>

                            Published Schedule

                        </div>

                        <span class="portal-arrow">
                            →
                        </span>

                    </div>

                </a>


                <!-- Faculty Card -->

                <a href="{{ route('public.faculty-routine') }}"
                   class="portal-card faculty-card">

                    <div class="portal-card-top">

                        <div class="portal-icon">
                            FC
                        </div>

                        <div>

                            <div class="portal-name">
                                Faculty Portal
                            </div>

                            <div class="portal-caption">
                                Weekly teaching schedule
                            </div>

                        </div>

                    </div>


                    <div class="portal-bottom">

                        <div class="portal-status">

                            <span class="status-dot"></span>

                            Live Access

                        </div>

                        <span class="portal-arrow">
                            →
                        </span>

                    </div>

                </a>


                <!-- Admin Card -->

                <a href="{{ route('admin.login') }}"
                   class="portal-card admin-card">

                    <div class="portal-card-top">

                        <div class="portal-icon">
                            AD
                        </div>

                        <div>

                            <div class="portal-name">
                                Administration
                            </div>

                            <div class="portal-caption">
                                Manage academic scheduling
                            </div>

                        </div>

                    </div>


                    <div class="portal-bottom">

                        <div class="portal-status">

                            <span class="status-dot"></span>

                            Secure Access

                        </div>

                        <span class="portal-arrow">
                            →
                        </span>

                    </div>

                </a>


                <!-- Floating Data Chips -->

                <div class="data-chip
                            data-chip-one">

                    <span class="chip-light"></span>

                    SATURDAY — THURSDAY

                </div>


                <div class="data-chip
                            data-chip-two">

                    <span class="chip-light"></span>

                    REAL-TIME ROUTINE ACCESS

                </div>

            </div>

        </section>

    </main>


    <!-- =========================================================
         BOTTOM SYSTEM STRIP
    ========================================================== -->

    <section class="system-strip">

        <div class="system-item">

            <div class="system-value">
                Smart Scheduling
            </div>

            <div class="system-label">
                INTELLIGENT WORKFLOW
            </div>

        </div>


        <div class="system-item">

            <div class="system-value">
                Conflict Protection
            </div>

            <div class="system-label">
                FACULTY · ROOM · SECTION
            </div>

        </div>


        <div class="system-item">

            <div class="system-value">
                Public Access
            </div>

            <div class="system-label">
                STUDENT · FACULTY
            </div>

        </div>


        <div class="system-item">

            <div class="system-value">
                Print Ready
            </div>

            <div class="system-label">
                ROUTINE · PDF
            </div>

        </div>

    </section>

</div>


<script>
    /*
    |--------------------------------------------------------------------------
    | PARTICLE GENERATOR
    |--------------------------------------------------------------------------
    */

    const particleContainer =
        document.getElementById('particles');

    const particleCount = 32;

    for (
        let i = 0;
        i < particleCount;
        i++
    ) {

        const particle =
            document.createElement('span');

        particle.className =
            'particle';

        const left =
            Math.random() * 100;

        const top =
            50 + Math.random() * 70;

        const duration =
            10 + Math.random() * 15;

        const delay =
            Math.random() * -20;

        const size =
            1 + Math.random() * 2.5;

        particle.style.left =
            left + '%';

        particle.style.top =
            top + '%';

        particle.style.width =
            size + 'px';

        particle.style.height =
            size + 'px';

        particle.style.animationDuration =
            duration + 's';

        particle.style.animationDelay =
            delay + 's';

        particleContainer.appendChild(
            particle
        );
    }


    /*
    |--------------------------------------------------------------------------
    | MOUSE LIGHT
    |--------------------------------------------------------------------------
    */

    const mouseLight =
        document.getElementById(
            'mouseLight'
        );

    document.addEventListener(
        'mousemove',
        function (event) {

            mouseLight.style.opacity =
                '1';

            mouseLight.style.left =
                event.clientX + 'px';

            mouseLight.style.top =
                event.clientY + 'px';
        }
    );


    document.addEventListener(
        'mouseleave',
        function () {

            mouseLight.style.opacity =
                '0';
        }
    );


    /*
    |--------------------------------------------------------------------------
    | 3D MOUSE PARALLAX
    |--------------------------------------------------------------------------
    */

    const visual =
        document.getElementById(
            'visual'
        );

    const visualScene =
        document.getElementById(
            'visualScene'
        );


    function applySceneScale(
        rotateX = 0,
        rotateY = 0
    ) {

        let scale = 1;

        if (
            window.innerWidth <= 480
        ) {

            scale = .59;

        } else if (
            window.innerWidth <= 700
        ) {

            scale = .68;

        } else if (
            window.innerWidth <= 1200
        ) {

            scale = .86;
        }

        visualScene.style.transform =
            `
            scale(${scale})
            rotateX(${rotateX}deg)
            rotateY(${rotateY}deg)
            `;
    }


    if (
        window.matchMedia(
            '(pointer: fine)'
        ).matches
    ) {

        visual.addEventListener(
            'mousemove',
            function (event) {

                const rect =
                    visual.getBoundingClientRect();

                const x =
                    (
                        event.clientX
                        -
                        rect.left
                    )
                    /
                    rect.width;

                const y =
                    (
                        event.clientY
                        -
                        rect.top
                    )
                    /
                    rect.height;

                const rotateY =
                    (x - .5) * 10;

                const rotateX =
                    (y - .5) * -8;

                applySceneScale(
                    rotateX,
                    rotateY
                );
            }
        );


        visual.addEventListener(
            'mouseleave',
            function () {

                applySceneScale(
                    0,
                    0
                );
            }
        );
    }


    window.addEventListener(
        'resize',
        function () {

            applySceneScale(
                0,
                0
            );
        }
    );


    applySceneScale();


    /*
    |--------------------------------------------------------------------------
    | CARD MOUSE GLOW
    |--------------------------------------------------------------------------
    */

    const cards =
        document.querySelectorAll(
            '.portal-card'
        );

    cards.forEach(
        function (card) {

            card.addEventListener(
                'mousemove',
                function (event) {

                    const rect =
                        card.getBoundingClientRect();

                    const x =
                        event.clientX
                        -
                        rect.left;

                    const y =
                        event.clientY
                        -
                        rect.top;

                    card.style.background =
                        `
                        radial-gradient(
                            circle at
                            ${x}px
                            ${y}px,
                            rgba(
                                59,
                                130,
                                246,
                                .13
                            ),
                            rgba(
                                15,
                                23,
                                42,
                                .78
                            )
                            45%,
                            rgba(
                                7,
                                12,
                                24,
                                .62
                            )
                            100%
                        )
                        `;
                }
            );


            card.addEventListener(
                'mouseleave',
                function () {

                    card.style.background =
                        '';
                }
            );
        }
    );
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {

    const adminLoginButton = document.querySelector('.admin-login');

    if (adminLoginButton) {

        adminLoginButton.style.pointerEvents = 'auto';
        adminLoginButton.style.cursor = 'pointer';
        adminLoginButton.style.position = 'relative';
        adminLoginButton.style.zIndex = '999999';

        adminLoginButton.addEventListener('click', function (event) {

            event.preventDefault();
            event.stopPropagation();
            event.stopImmediatePropagation();

            window.location.href = "{{ route('admin.login') }}";

        }, true);
    }

});
</script>
</body>

</html>