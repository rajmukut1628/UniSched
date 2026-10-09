<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#020617">
    <title>UniSched | Intelligent Academic Scheduling</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root{
            --bg:#020617;--panel:rgba(8,15,31,.64);--line:rgba(148,163,184,.12);
            --text:#f8fafc;--muted:#8190a8;--blue:#3b82f6;--cyan:#22d3ee;
            --violet:#8b5cf6;--pink:#d946ef;--green:#22c55e;
        }
        *{box-sizing:border-box;margin:0;padding:0}
        html{scroll-behavior:smooth}
        body{
            min-height:100vh;overflow-x:hidden;color:var(--text);
            font-family:Inter,ui-sans-serif,system-ui,-apple-system,BlinkMacSystemFont,"Segoe UI",sans-serif;
            background:#020617;
        }
        a{color:inherit;text-decoration:none}
        button{font:inherit}
        ::selection{background:#2563eb;color:#fff}
        body::-webkit-scrollbar{width:7px}
        body::-webkit-scrollbar-track{background:#020617}
        body::-webkit-scrollbar-thumb{background:linear-gradient(#2563eb,#8b5cf6);border-radius:10px}

        /* ===== CINEMATIC BACKGROUND ===== */
        .world{position:relative;min-height:100vh;isolation:isolate;overflow:hidden}
        .space{position:fixed;inset:0;z-index:-30;overflow:hidden;pointer-events:none;
            background:
            radial-gradient(circle at 80% 18%,rgba(37,99,235,.22),transparent 27%),
            radial-gradient(circle at 12% 82%,rgba(124,58,237,.17),transparent 28%),
            radial-gradient(circle at 50% 55%,rgba(6,182,212,.07),transparent 35%),
            linear-gradient(180deg,#020617 0%,#030712 45%,#02040b 100%)}
        .aurora{position:absolute;inset:-50%;opacity:.55;filter:blur(40px);
            background:conic-gradient(from 120deg,transparent,rgba(37,99,235,.07),transparent,rgba(168,85,247,.06),transparent,rgba(34,211,238,.05),transparent);
            animation:auroraSpin 34s linear infinite}
        @keyframes auroraSpin{to{transform:rotate(360deg)}}
        .grid{position:absolute;left:-15%;right:-15%;bottom:-36%;height:85%;
            background-image:linear-gradient(rgba(96,165,250,.06) 1px,transparent 1px),linear-gradient(90deg,rgba(96,165,250,.06) 1px,transparent 1px);
            background-size:68px 68px;transform:perspective(650px) rotateX(62deg);
            transform-origin:center top;mask-image:linear-gradient(to bottom,transparent 0%,#000 22%,#000 70%,transparent 100%);
            animation:gridFlow 9s linear infinite}
        @keyframes gridFlow{to{background-position:0 68px,68px 0}}
        .beam{position:absolute;width:2px;height:48vh;top:-12%;opacity:.28;filter:blur(.2px);
            background:linear-gradient(transparent,#60a5fa,transparent);transform:rotate(24deg)}
        .beam.b1{left:18%;animation:beamMove 9s ease-in-out infinite}
        .beam.b2{right:22%;animation:beamMove 12s ease-in-out infinite -4s}
        @keyframes beamMove{50%{transform:translateX(90px) rotate(24deg);opacity:.08}}
        .glow{position:absolute;border-radius:50%;filter:blur(110px);animation:glowFloat 12s ease-in-out infinite}
        .g1{width:520px;height:520px;right:-130px;top:-160px;background:rgba(37,99,235,.17)}
        .g2{width:460px;height:460px;left:-180px;bottom:-170px;background:rgba(124,58,237,.13);animation-delay:-5s}
        .g3{width:330px;height:330px;left:43%;top:40%;background:rgba(34,211,238,.055);animation-delay:-8s}
        @keyframes glowFloat{50%{transform:translate3d(35px,-30px,0) scale(1.12)}}
        #particles{position:absolute;inset:0}
        .particle{position:absolute;border-radius:50%;background:#bfdbfe;box-shadow:0 0 14px rgba(59,130,246,.8);animation:particleUp linear infinite}
        @keyframes particleUp{0%{opacity:0;transform:translateY(80px) scale(.3)}15%{opacity:.8}80%{opacity:.35}100%{opacity:0;transform:translateY(-110vh) scale(1.25)}}
        .mouse-light{position:fixed;width:520px;height:520px;left:0;top:0;z-index:-4;border-radius:50%;
            transform:translate(-50%,-50%);background:radial-gradient(circle,rgba(59,130,246,.075),transparent 65%);
            pointer-events:none;opacity:0;transition:opacity .25s}

        /* ===== NAV ===== */
        .nav-wrap{position:relative;z-index:1000;width:min(1500px,calc(100% - 48px));margin:auto;padding-top:20px}
        .nav{display:flex;align-items:center;justify-content:space-between;gap:20px;padding:11px 12px 11px 15px;
            border:1px solid rgba(255,255,255,.075);border-radius:19px;background:rgba(5,11,24,.60);
            backdrop-filter:blur(24px);box-shadow:0 20px 70px rgba(0,0,0,.22),inset 0 1px rgba(255,255,255,.04)}
        .brand{display:flex;align-items:center;gap:12px}
        .logo{position:relative;width:46px;height:46px;display:grid;place-items:center;border-radius:14px;overflow:hidden;
            background:linear-gradient(135deg,#2563eb,#6d28d9);box-shadow:0 12px 36px rgba(37,99,235,.28);font-size:11px;font-weight:950}
        .logo:before{content:"";position:absolute;width:80px;height:16px;background:rgba(255,255,255,.28);transform:rotate(-45deg) translateY(-55px);animation:shine 5s ease-in-out infinite}
        @keyframes shine{0%,60%{transform:rotate(-45deg) translateY(-55px)}78%,100%{transform:rotate(-45deg) translateY(58px)}}
        .brand-name{font-size:22px;font-weight:950;letter-spacing:-.8px}.brand-name span{color:#60a5fa}
        .brand-sub{margin-top:5px;color:#52627b;font-size:7px;font-weight:850;letter-spacing:1.45px}
        .navlinks{display:flex;align-items:center;gap:3px}
        .navlink{padding:10px 12px;border-radius:10px;color:#718096;font-size:9px;font-weight:850;transition:.2s}
        .navlink:hover{color:#dbeafe;background:rgba(255,255,255,.04)}
        .login{position:relative;overflow:hidden;display:inline-flex;align-items:center;gap:8px;padding:11px 16px;margin-left:5px;
            border:1px solid rgba(96,165,250,.2);border-radius:11px;background:linear-gradient(135deg,rgba(37,99,235,.17),rgba(124,58,237,.1));
            color:#dbeafe;font-size:9px;font-weight:900;box-shadow:inset 0 1px rgba(255,255,255,.04);transition:.25s}
        .login:hover{transform:translateY(-2px);border-color:rgba(96,165,250,.4);box-shadow:0 14px 36px rgba(37,99,235,.14)}
        .live-dot{width:6px;height:6px;border-radius:50%;background:#60a5fa;box-shadow:0 0 12px #3b82f6}

        /* ===== HERO ===== */
        .hero{position:relative;z-index:10;width:min(1500px,calc(100% - 48px));min-height:calc(100vh - 88px);margin:auto;
            display:grid;grid-template-columns:minmax(0,1.03fr) minmax(520px,.97fr);gap:36px;align-items:center;padding:45px 0 92px}
        .copy{position:relative;z-index:20;max-width:780px}
        .eyebrow{display:inline-flex;align-items:center;gap:9px;padding:7px 12px;margin-bottom:22px;border:1px solid rgba(96,165,250,.14);
            border-radius:999px;background:rgba(37,99,235,.06);color:#93c5fd;font-size:8px;font-weight:900;letter-spacing:1.45px}
        .pulse{position:relative;width:6px;height:6px;border-radius:50%;background:#60a5fa}
        .pulse:after{content:"";position:absolute;inset:-5px;border:1px solid rgba(96,165,250,.55);border-radius:50%;animation:pulse 2s ease-out infinite}
        @keyframes pulse{from{opacity:.8;transform:scale(.4)}to{opacity:0;transform:scale(1.6)}}
        h1{font-size:clamp(50px,6vw,88px);line-height:.95;letter-spacing:clamp(-5px,-.4vw,-2px);font-weight:950}
        h1 .line{display:block}
        .gradient-text{display:inline-block;color:transparent;background:linear-gradient(100deg,#60a5fa,#818cf8,#c084fc,#67e8f9,#60a5fa);
            background-size:300% 100%;background-clip:text;-webkit-background-clip:text;animation:textFlow 7s linear infinite}
        @keyframes textFlow{to{background-position:300% center}}
        .desc{max-width:665px;margin-top:26px;color:#8491a8;font-size:13px;line-height:1.85}
        .desc strong{color:#d1d9e6}
        .actions{display:flex;flex-wrap:wrap;gap:10px;margin-top:30px}
        .btn{position:relative;overflow:hidden;display:inline-flex;align-items:center;justify-content:center;gap:9px;min-height:48px;padding:0 19px;
            border-radius:12px;font-size:9px;font-weight:900;transition:.25s}
        .btn:hover{transform:translateY(-3px)}
        .primary{background:linear-gradient(135deg,#2563eb,#4f46e5,#7c3aed);box-shadow:0 16px 48px rgba(37,99,235,.24)}
        .primary:before{content:"";position:absolute;width:70px;height:160px;top:-55px;left:-120px;transform:rotate(25deg);background:rgba(255,255,255,.18);filter:blur(5px);transition:left .6s}
        .primary:hover:before{left:125%}
        .secondary{border:1px solid rgba(255,255,255,.08);background:rgba(255,255,255,.025);color:#cbd5e1;backdrop-filter:blur(10px)}
        .secondary:hover{border-color:rgba(96,165,250,.22);box-shadow:0 12px 36px rgba(0,0,0,.22)}
        .arrow{font-size:14px;transition:.2s}.btn:hover .arrow{transform:translateX(4px)}
        .trust{display:flex;flex-wrap:wrap;gap:8px;margin-top:28px}
        .trust span{display:flex;align-items:center;gap:6px;padding:7px 9px;border:1px solid rgba(255,255,255,.05);border-radius:8px;
            background:rgba(255,255,255,.018);color:#58667d;font-size:7px;font-weight:850;letter-spacing:.45px}
        .trust b{color:#60a5fa}

        /* ===== 3D COMMAND CORE ===== */
        .visual{position:relative;min-height:650px;display:grid;place-items:center;perspective:1450px;transform-style:preserve-3d;pointer-events:none}
        .scene{position:relative;width:610px;height:610px;transform-style:preserve-3d;transition:transform .14s ease-out}
        .halo{position:absolute;left:50%;top:50%;border-radius:50%;transform:translate(-50%,-50%);pointer-events:none}
        .halo.h1{width:390px;height:390px;background:radial-gradient(circle,rgba(59,130,246,.16),transparent 67%);filter:blur(16px);animation:haloPulse 4s ease-in-out infinite}
        .halo.h2{width:520px;height:520px;border:1px solid rgba(96,165,250,.05);box-shadow:0 0 100px rgba(37,99,235,.05)}
        @keyframes haloPulse{50%{transform:translate(-50%,-50%) scale(1.1);opacity:.65}}
        .core{position:absolute;left:50%;top:50%;width:190px;height:190px;transform:translate(-50%,-50%);border-radius:50%;z-index:10;
            background:radial-gradient(circle at 31% 26%,#fff 0%,#bfdbfe 4%,rgba(96,165,250,.52) 10%,rgba(59,130,246,.25) 27%,rgba(37,99,235,.12) 48%,rgba(2,6,23,.94) 75%);
            border:1px solid rgba(147,197,253,.2);box-shadow:inset -32px -32px 64px rgba(2,6,23,.9),inset 20px 20px 45px rgba(96,165,250,.08),0 0 55px rgba(37,99,235,.25),0 0 130px rgba(37,99,235,.13);
            animation:coreFloat 5s ease-in-out infinite}
        @keyframes coreFloat{50%{transform:translate(-50%,-50%) translateY(-11px) rotate(3deg)}}
        .core:before{content:"";position:absolute;inset:20px;border-radius:50%;border:1px solid rgba(147,197,253,.1);border-top-color:rgba(103,232,249,.35);animation:spin 7s linear infinite}
        .core:after{content:"";position:absolute;width:52px;height:20px;left:37px;top:27px;border-radius:50%;transform:rotate(-35deg);background:rgba(255,255,255,.24);filter:blur(6px)}
        @keyframes spin{to{transform:rotate(360deg)}}
        .core-copy{position:absolute;inset:0;display:flex;align-items:center;justify-content:center;flex-direction:column;text-align:center;z-index:3}
        .core-name{font-size:27px;font-weight:950;letter-spacing:-1px}.core-name span{color:#93c5fd}
        .core-small{margin-top:5px;color:#94a3b8;font-size:6px;font-weight:900;letter-spacing:1.5px}
        .ring{position:absolute;left:50%;top:50%;border-radius:50%;border:1px solid rgba(96,165,250,.13);transform-style:preserve-3d}
        .r1{width:315px;height:315px;margin:-157.5px;transform:rotateX(68deg);animation:r1 10s linear infinite}
        .r2{width:435px;height:435px;margin:-217.5px;border-color:rgba(192,132,252,.11);transform:rotateX(74deg) rotateY(22deg);animation:r2 16s linear infinite reverse}
        .r3{width:555px;height:555px;margin:-277.5px;border-color:rgba(103,232,249,.08);transform:rotateX(60deg) rotateY(-18deg);animation:r3 24s linear infinite}
        @keyframes r1{to{transform:rotateX(68deg) rotateZ(360deg)}}@keyframes r2{to{transform:rotateX(74deg) rotateY(22deg) rotateZ(360deg)}}@keyframes r3{to{transform:rotateX(60deg) rotateY(-18deg) rotateZ(360deg)}}
        .node{position:absolute;left:50%;top:-7px;width:14px;height:14px;margin-left:-7px;border-radius:50%;
            background:radial-gradient(circle at 35% 30%,#fff,#60a5fa 25%,#2563eb 60%,#172554);box-shadow:0 0 18px rgba(59,130,246,.9),0 0 42px rgba(59,130,246,.3)}
        .purple{background:radial-gradient(circle at 35% 30%,#fff,#c084fc 25%,#7c3aed 60%,#2e1065);box-shadow:0 0 18px rgba(168,85,247,.85)}
        .cyan{background:radial-gradient(circle at 35% 30%,#fff,#67e8f9 25%,#0891b2 60%,#083344);box-shadow:0 0 18px rgba(34,211,238,.75)}
        .dash{position:absolute;left:50%;top:50%;border-radius:50%;pointer-events:none}
        .d1{width:250px;height:250px;margin:-125px;border:1px dashed rgba(96,165,250,.12);animation:spin 13s linear infinite}
        .d2{width:280px;height:280px;margin:-140px;border:1px dotted rgba(192,132,252,.11);animation:spin 19s linear infinite reverse}

        /* ===== FLOATING PORTALS ===== */
        .portal{position:absolute;z-index:30;width:198px;padding:14px;border:1px solid rgba(255,255,255,.08);border-radius:16px;
            background:linear-gradient(145deg,rgba(15,23,42,.82),rgba(5,11,24,.65));backdrop-filter:blur(20px);
            box-shadow:0 22px 65px rgba(0,0,0,.24),inset 0 1px rgba(255,255,255,.04);pointer-events:auto;transition:border-color .25s,box-shadow .25s}
        .portal:hover{border-color:rgba(96,165,250,.3);box-shadow:0 24px 70px rgba(0,0,0,.3),0 0 35px rgba(37,99,235,.08)}
        .student{left:3px;top:105px;animation:float1 6s ease-in-out infinite}
        .faculty{right:-4px;top:184px;animation:float2 7s ease-in-out infinite}
        .admin{left:47px;bottom:84px;animation:float3 7.5s ease-in-out infinite}
        @keyframes float1{50%{transform:translate3d(0,-14px,55px) rotateY(3deg)}}@keyframes float2{50%{transform:translate3d(0,14px,65px) rotateY(-3deg)}}@keyframes float3{50%{transform:translate3d(12px,-10px,50px) rotateX(-2deg)}}
        .portal-top{display:flex;align-items:center;gap:9px}.picon{width:36px;height:36px;display:grid;place-items:center;border-radius:10px;
            background:linear-gradient(145deg,rgba(37,99,235,.18),rgba(124,58,237,.09));border:1px solid rgba(96,165,250,.09);color:#bfdbfe;font-size:8px;font-weight:950}
        .pname{font-size:9px;font-weight:900;color:#e2e8f0}.pcap{margin-top:3px;color:#59677e;font-size:6.5px;line-height:1.4}
        .portal-bottom{display:flex;align-items:center;justify-content:space-between;margin-top:11px;padding-top:9px;border-top:1px solid rgba(255,255,255,.05)}
        .status{display:flex;align-items:center;gap:5px;color:#68768c;font-size:6px;font-weight:850}.status i{width:5px;height:5px;border-radius:50%;background:#22c55e;box-shadow:0 0 8px rgba(34,197,94,.75)}
        .parrow{color:#60a5fa;font-size:12px;transition:.2s}.portal:hover .parrow{transform:translateX(4px)}
        .chip{position:absolute;z-index:18;display:flex;align-items:center;gap:7px;padding:8px 10px;border:1px solid rgba(255,255,255,.065);
            border-radius:999px;background:rgba(5,11,24,.68);backdrop-filter:blur(15px);color:#65738a;font-size:6.5px;font-weight:850;white-space:nowrap}
        .chip:before{content:"";width:5px;height:5px;border-radius:50%;background:#60a5fa;box-shadow:0 0 10px rgba(96,165,250,.8)}
        .c1{right:52px;bottom:66px;animation:chip 5s ease-in-out infinite}.c2{right:35px;top:78px;animation:chip 6s ease-in-out infinite -2s}
        @keyframes chip{50%{transform:translateY(-10px)}}

        /* ===== BOTTOM ===== */
        .strip{position:relative;z-index:20;width:min(1500px,calc(100% - 48px));margin:-58px auto 30px;display:grid;grid-template-columns:repeat(4,1fr);
            border:1px solid rgba(255,255,255,.06);border-radius:17px;overflow:hidden;background:rgba(5,11,24,.55);backdrop-filter:blur(20px);box-shadow:0 22px 65px rgba(0,0,0,.15)}
        .strip-item{padding:16px 19px;border-right:1px solid rgba(255,255,255,.05)}.strip-item:last-child{border-right:0}
        .strip-value{font-size:10px;font-weight:900;color:#cbd5e1}.strip-label{margin-top:4px;color:#46536a;font-size:6.5px;font-weight:850;letter-spacing:.7px}

        /* ===== RESPONSIVE ===== */
        @media(max-width:1200px){.hero{grid-template-columns:minmax(0,1fr) 500px}.scene{transform:scale(.86)}}
        @media(max-width:1020px){
            .navlink{display:none}.hero{grid-template-columns:1fr;gap:18px;padding-top:76px}.copy{max-width:850px;margin:auto;text-align:center}
            .desc{margin-left:auto;margin-right:auto}.actions,.trust{justify-content:center}.visual{min-height:620px}.strip{margin-top:0}
        }
        @media(max-width:700px){
            .nav-wrap,.hero,.strip{width:min(100% - 26px,1500px)}.nav{border-radius:15px}.brand-sub{display:none}.brand-name{font-size:19px}
            .hero{padding-top:58px}.hero h1{font-size:clamp(44px,14vw,68px);letter-spacing:-3px}.desc{font-size:11px}.visual{min-height:520px}
            .scene{width:610px;height:610px;transform:scale(.68)}.strip{grid-template-columns:1fr 1fr}.strip-item:nth-child(2){border-right:0}
            .strip-item:nth-child(-n+2){border-bottom:1px solid rgba(255,255,255,.05)}
        }
        @media(max-width:480px){.login{padding:10px 11px}.login-text{display:none}.visual{min-height:470px}.scene{transform:scale(.59)}.btn{flex:1 1 100%}}
        @media(prefers-reduced-motion:reduce){*,*:before,*:after{animation-duration:.01ms!important;animation-iteration-count:1!important;scroll-behavior:auto!important}}
    </style>
</head>
<body>
<div class="world">
    <div class="space">
        <div class="aurora"></div><div class="grid"></div>
        <div class="beam b1"></div><div class="beam b2"></div>
        <div class="glow g1"></div><div class="glow g2"></div><div class="glow g3"></div>
        <div id="particles"></div>
    </div>
    <div class="mouse-light" id="mouseLight"></div>

    <header class="nav-wrap">
        <nav class="nav">
            <a class="brand" href="{{ route('home') }}">
                <div class="logo">US</div>
                <div>
                    <div class="brand-name">Uni<span>Sched</span></div>
                    <div class="brand-sub">INTELLIGENT ACADEMIC SCHEDULING</div>
                </div>
            </a>

            <div class="navlinks">
                <a class="navlink" href="{{ route('home') }}">Home</a>
                <a class="navlink" href="{{ route('public.routine') }}">Student Routine</a>
                <a class="navlink" href="{{ route('public.faculty-routine') }}">Faculty Routine</a>
                <a class="login" href="{{ route('admin.login') }}">
                    <span class="live-dot"></span><span class="login-text">Admin Login</span><span>→</span>
                </a>
            </div>
        </nav>
    </header>

    <main>
        <section class="hero">
            <div class="copy">
                <div class="eyebrow"><span class="pulse"></span> NEXT-GENERATION ACADEMIC SCHEDULING</div>

                <h1>
                    <span class="line">Academic scheduling.</span>
                    <span class="line gradient-text">Reimagined.</span>
                </h1>

                <p class="desc">
                    <strong>UniSched</strong> brings courses, faculty availability, sections, rooms and time slots into one intelligent scheduling environment—built to reduce conflicts and make published routines instantly accessible.
                </p>

                <div class="actions">
                    <a class="btn primary" href="{{ route('public.routine') }}">View Student Routine <span class="arrow">→</span></a>
                    <a class="btn secondary" href="{{ route('public.faculty-routine') }}">Faculty Schedule <span class="arrow">→</span></a>
                </div>

                <div class="trust">
                    <span><b>✓</b> Conflict Protection</span>
                    <span><b>✓</b> Faculty Availability</span>
                    <span><b>✓</b> Room & Lab Control</span>
                    <span><b>✓</b> Published Routine Access</span>
                </div>
            </div>

            <div class="visual" id="visual">
                <div class="scene" id="scene">
                    <div class="halo h1"></div><div class="halo h2"></div>

                    <div class="ring r3"><span class="node cyan"></span></div>
                    <div class="ring r2"><span class="node purple"></span></div>
                    <div class="ring r1"><span class="node"></span></div>
                    <div class="dash d1"></div><div class="dash d2"></div>

                    <div class="core">
                        <div class="core-copy">
                            <div class="core-name">Uni<span>Sched</span></div>
                            <div class="core-small">SCHEDULING CORE</div>
                        </div>
                    </div>

                    <a class="portal student" href="{{ route('public.routine') }}">
                        <div class="portal-top"><div class="picon">ST</div><div><div class="pname">Student Routine</div><div class="pcap">Semester & section schedule</div></div></div>
                        <div class="portal-bottom"><div class="status"><i></i> Published Schedule</div><span class="parrow">→</span></div>
                    </a>

                    <a class="portal faculty" href="{{ route('public.faculty-routine') }}">
                        <div class="portal-top"><div class="picon">FC</div><div><div class="pname">Faculty Portal</div><div class="pcap">Weekly teaching schedule</div></div></div>
                        <div class="portal-bottom"><div class="status"><i></i> Live Access</div><span class="parrow">→</span></div>
                    </a>

                    <a class="portal admin" href="{{ route('admin.login') }}">
                        <div class="portal-top"><div class="picon">AD</div><div><div class="pname">Administration</div><div class="pcap">Manage academic scheduling</div></div></div>
                        <div class="portal-bottom"><div class="status"><i></i> Secure Access</div><span class="parrow">→</span></div>
                    </a>

                    <div class="chip c1">SATURDAY — THURSDAY</div>
                    <div class="chip c2">REAL-TIME ROUTINE ACCESS</div>
                </div>
            </div>
        </section>
    </main>

    <section class="strip">
        <div class="strip-item"><div class="strip-value">Smart Scheduling</div><div class="strip-label">INTELLIGENT WORKFLOW</div></div>
        <div class="strip-item"><div class="strip-value">Conflict Protection</div><div class="strip-label">FACULTY · ROOM · SECTION</div></div>
        <div class="strip-item"><div class="strip-value">Public Access</div><div class="strip-label">STUDENT · FACULTY</div></div>
        <div class="strip-item"><div class="strip-value">Print Ready</div><div class="strip-label">ROUTINE · PDF</div></div>
    </section>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const particles = document.getElementById('particles');
    const reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    if (!reduced && particles) {
        for (let i = 0; i < 42; i++) {
            const p = document.createElement('span');
            p.className = 'particle';
            const size = 1 + Math.random() * 2.4;
            p.style.cssText = `
                left:${Math.random()*100}%;
                top:${48 + Math.random()*65}%;
                width:${size}px;
                height:${size}px;
                animation-duration:${10 + Math.random()*16}s;
                animation-delay:${Math.random()*-22}s;
                opacity:${.25 + Math.random()*.55};
            `;
            particles.appendChild(p);
        }
    }

    const mouseLight = document.getElementById('mouseLight');
    if (mouseLight && window.matchMedia('(pointer:fine)').matches) {
        document.addEventListener('mousemove', e => {
            mouseLight.style.opacity = '1';
            mouseLight.style.left = e.clientX + 'px';
            mouseLight.style.top = e.clientY + 'px';
        });
        document.addEventListener('mouseleave', () => mouseLight.style.opacity = '0');
    }

    const visual = document.getElementById('visual');
    const scene = document.getElementById('scene');

    function scaleForWidth() {
        if (innerWidth <= 480) return .59;
        if (innerWidth <= 700) return .68;
        if (innerWidth <= 1200) return .86;
        return 1;
    }
    function transformScene(rx = 0, ry = 0) {
        if (!scene) return;
        scene.style.transform = `scale(${scaleForWidth()}) rotateX(${rx}deg) rotateY(${ry}deg)`;
    }

    if (visual && scene && window.matchMedia('(pointer:fine)').matches && !reduced) {
        visual.addEventListener('mousemove', e => {
            const r = visual.getBoundingClientRect();
            const x = (e.clientX-r.left)/r.width;
            const y = (e.clientY-r.top)/r.height;
            transformScene((y-.5)*-8,(x-.5)*10);
        });
        visual.addEventListener('mouseleave', () => transformScene());
    }

    window.addEventListener('resize', () => transformScene());
    transformScene();

    document.querySelectorAll('.portal').forEach(card => {
        card.addEventListener('mousemove', e => {
            const r = card.getBoundingClientRect();
            card.style.background = `radial-gradient(circle at ${e.clientX-r.left}px ${e.clientY-r.top}px,rgba(59,130,246,.14),rgba(15,23,42,.82) 45%,rgba(5,11,24,.68) 100%)`;
        });
        card.addEventListener('mouseleave', () => card.style.background = '');
    });
});
</script>
</body>
</html>
