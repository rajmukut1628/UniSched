<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#020617">
    <title>Admin Login | UniSched</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root{
            --bg:#020617; --panel:rgba(7,13,28,.72); --line:rgba(148,163,184,.12);
            --text:#f8fafc; --muted:#77859b; --blue:#3b82f6; --cyan:#22d3ee;
            --violet:#8b5cf6; --green:#22c55e; --red:#ef4444;
        }
        *{box-sizing:border-box;margin:0;padding:0}
        html,body{min-height:100%}
        body{
            min-height:100vh; overflow-x:hidden; color:var(--text);
            font-family:Inter,ui-sans-serif,system-ui,-apple-system,BlinkMacSystemFont,"Segoe UI",sans-serif;
            background:#020617;
        }
        a{color:inherit;text-decoration:none}
        button,input{font:inherit}
        ::selection{background:#2563eb;color:#fff}

        /* ===== CINEMATIC LIVE BACKGROUND ===== */
        .universe{position:fixed;inset:0;overflow:hidden;z-index:-20;background:
            radial-gradient(circle at 82% 18%,rgba(37,99,235,.19),transparent 27%),
            radial-gradient(circle at 12% 84%,rgba(124,58,237,.16),transparent 29%),
            radial-gradient(circle at 50% 50%,rgba(6,182,212,.055),transparent 38%),
            linear-gradient(180deg,#020617,#030712 48%,#02040b)}
        .aurora{position:absolute;inset:-55%;opacity:.7;filter:blur(55px);
            background:conic-gradient(from 110deg,transparent,rgba(37,99,235,.07),transparent,rgba(168,85,247,.065),transparent,rgba(34,211,238,.05),transparent);
            animation:aurora 35s linear infinite}
        @keyframes aurora{to{transform:rotate(360deg)}}
        .grid{position:absolute;left:-15%;right:-15%;bottom:-39%;height:86%;
            background-image:linear-gradient(rgba(96,165,250,.055) 1px,transparent 1px),linear-gradient(90deg,rgba(96,165,250,.055) 1px,transparent 1px);
            background-size:68px 68px;transform:perspective(660px) rotateX(62deg);transform-origin:center top;
            mask-image:linear-gradient(to bottom,transparent,#000 23%,#000 68%,transparent);animation:gridMove 10s linear infinite}
        @keyframes gridMove{to{background-position:0 68px,68px 0}}
        .glow{position:absolute;border-radius:50%;filter:blur(110px);animation:floatGlow 13s ease-in-out infinite}
        .g1{width:520px;height:520px;right:-170px;top:-180px;background:rgba(37,99,235,.18)}
        .g2{width:480px;height:480px;left:-190px;bottom:-190px;background:rgba(124,58,237,.14);animation-delay:-6s}
        @keyframes floatGlow{50%{transform:translate3d(45px,-28px,0) scale(1.1)}}
        .beam{position:absolute;width:2px;height:55vh;top:-15%;opacity:.2;background:linear-gradient(transparent,#60a5fa,transparent);transform:rotate(26deg)}
        .b1{left:22%;animation:beam 11s ease-in-out infinite}.b2{right:20%;animation:beam 14s ease-in-out infinite -4s}
        @keyframes beam{50%{transform:translateX(100px) rotate(26deg);opacity:.05}}
        #particles{position:absolute;inset:0}
        .particle{position:absolute;border-radius:50%;background:#dbeafe;box-shadow:0 0 12px rgba(96,165,250,.8);animation:rise linear infinite}
        @keyframes rise{0%{opacity:0;transform:translateY(70px) scale(.35)}15%{opacity:.75}80%{opacity:.28}100%{opacity:0;transform:translateY(-110vh) scale(1.2)}}
        #mouseGlow{position:fixed;left:0;top:0;width:520px;height:520px;border-radius:50%;pointer-events:none;z-index:-3;opacity:0;
            transform:translate(-50%,-50%);background:radial-gradient(circle,rgba(59,130,246,.085),transparent 66%);transition:opacity .25s}

        /* ===== TOP BAR ===== */
        .topbar{position:relative;z-index:50;width:min(1460px,calc(100% - 42px));margin:auto;padding-top:20px}
        .nav{display:flex;align-items:center;justify-content:space-between;padding:10px 12px 10px 14px;border:1px solid rgba(255,255,255,.07);
            border-radius:18px;background:rgba(5,11,24,.56);backdrop-filter:blur(22px);box-shadow:0 18px 65px rgba(0,0,0,.2),inset 0 1px rgba(255,255,255,.035)}
        .brand{display:flex;align-items:center;gap:11px}
        .brand-mark{position:relative;width:43px;height:43px;display:grid;place-items:center;border-radius:13px;overflow:hidden;
            background:linear-gradient(135deg,#2563eb,#6d28d9);box-shadow:0 10px 32px rgba(37,99,235,.28);font-size:10px;font-weight:950}
        .brand-mark:before{content:"";position:absolute;width:70px;height:14px;background:rgba(255,255,255,.27);transform:rotate(-45deg) translateY(-52px);animation:shine 5s ease-in-out infinite}
        @keyframes shine{0%,60%{transform:rotate(-45deg) translateY(-52px)}80%,100%{transform:rotate(-45deg) translateY(54px)}}
        .brand-title{font-size:19px;font-weight:950;letter-spacing:-.6px}.brand-title span{color:#60a5fa}
        .brand-sub{margin-top:3px;color:#4f5e75;font-size:6.5px;font-weight:900;letter-spacing:1.25px}
        .home{display:flex;align-items:center;gap:8px;padding:10px 13px;border:1px solid rgba(255,255,255,.065);border-radius:10px;
            color:#94a3b8;background:rgba(255,255,255,.018);font-size:8px;font-weight:900;transition:.22s}
        .home:hover{color:#dbeafe;border-color:rgba(96,165,250,.25);transform:translateY(-2px)}

        /* ===== PAGE ===== */
        .page{position:relative;z-index:10;width:min(1460px,calc(100% - 42px));min-height:calc(100vh - 83px);margin:auto;
            display:grid;grid-template-columns:minmax(0,1.02fr) minmax(420px,.72fr);gap:70px;align-items:center;padding:48px 0 62px}
        .visual{position:relative;min-height:650px;display:grid;place-items:center;perspective:1500px;transform-style:preserve-3d}
        .scene{position:relative;width:600px;height:600px;transform-style:preserve-3d;transition:transform .12s ease-out}
        .halo{position:absolute;left:50%;top:50%;border-radius:50%;transform:translate(-50%,-50%)}
        .h1{width:360px;height:360px;background:radial-gradient(circle,rgba(59,130,246,.15),transparent 68%);filter:blur(16px);animation:halo 4s ease-in-out infinite}
        .h2{width:525px;height:525px;border:1px solid rgba(96,165,250,.05);box-shadow:0 0 100px rgba(37,99,235,.05)}
        @keyframes halo{50%{transform:translate(-50%,-50%) scale(1.1);opacity:.65}}
        .sphere{position:absolute;left:50%;top:50%;width:178px;height:178px;transform:translate(-50%,-50%);border-radius:50%;z-index:12;
            background:radial-gradient(circle at 31% 25%,#fff 0,#bfdbfe 4%,rgba(96,165,250,.55) 10%,rgba(59,130,246,.24) 29%,rgba(37,99,235,.1) 50%,rgba(2,6,23,.95) 76%);
            border:1px solid rgba(147,197,253,.2);box-shadow:inset -30px -30px 58px rgba(2,6,23,.92),0 0 58px rgba(37,99,235,.25),0 0 125px rgba(37,99,235,.12);
            animation:sphere 5s ease-in-out infinite}
        @keyframes sphere{50%{transform:translate(-50%,-50%) translateY(-10px) rotate(4deg)}}
        .sphere:before{content:"";position:absolute;inset:19px;border-radius:50%;border:1px solid rgba(147,197,253,.1);border-top-color:rgba(103,232,249,.4);animation:spin 7s linear infinite}
        .sphere:after{content:"";position:absolute;left:34px;top:25px;width:50px;height:18px;border-radius:50%;transform:rotate(-35deg);background:rgba(255,255,255,.24);filter:blur(6px)}
        @keyframes spin{to{transform:rotate(360deg)}}
        .sphere-copy{position:absolute;inset:0;z-index:2;display:flex;align-items:center;justify-content:center;flex-direction:column;text-align:center}
        .sphere-copy strong{font-size:25px;letter-spacing:-.8px}.sphere-copy strong span{color:#93c5fd}
        .sphere-copy small{margin-top:5px;color:#8ea0b8;font-size:6px;font-weight:900;letter-spacing:1.4px}
        .ring{position:absolute;left:50%;top:50%;border-radius:50%;border:1px solid rgba(96,165,250,.13);transform-style:preserve-3d}
        .r1{width:300px;height:300px;margin:-150px;transform:rotateX(68deg);animation:r1 10s linear infinite}
        .r2{width:420px;height:420px;margin:-210px;border-color:rgba(192,132,252,.11);transform:rotateX(74deg) rotateY(22deg);animation:r2 16s linear infinite reverse}
        .r3{width:540px;height:540px;margin:-270px;border-color:rgba(103,232,249,.08);transform:rotateX(60deg) rotateY(-18deg);animation:r3 24s linear infinite}
        @keyframes r1{to{transform:rotateX(68deg) rotateZ(360deg)}}@keyframes r2{to{transform:rotateX(74deg) rotateY(22deg) rotateZ(360deg)}}@keyframes r3{to{transform:rotateX(60deg) rotateY(-18deg) rotateZ(360deg)}}
        .node{position:absolute;left:50%;top:-7px;width:14px;height:14px;margin-left:-7px;border-radius:50%;
            background:radial-gradient(circle at 35% 30%,#fff,#60a5fa 25%,#2563eb 60%,#172554);box-shadow:0 0 18px rgba(59,130,246,.9)}
        .purple{background:radial-gradient(circle at 35% 30%,#fff,#c084fc 25%,#7c3aed 60%,#2e1065);box-shadow:0 0 18px rgba(168,85,247,.85)}
        .cyan{background:radial-gradient(circle at 35% 30%,#fff,#67e8f9 25%,#0891b2 60%,#083344);box-shadow:0 0 18px rgba(34,211,238,.75)}
        .tag{position:absolute;z-index:20;padding:9px 11px;border:1px solid rgba(255,255,255,.07);border-radius:999px;background:rgba(5,11,24,.68);
            backdrop-filter:blur(15px);color:#65738a;font-size:6.5px;font-weight:900;letter-spacing:.35px;box-shadow:0 16px 40px rgba(0,0,0,.2)}
        .tag:before{content:"";display:inline-block;width:5px;height:5px;margin-right:7px;border-radius:50%;background:#22c55e;box-shadow:0 0 10px rgba(34,197,94,.7)}
        .t1{left:40px;top:115px;animation:tagFloat 6s ease-in-out infinite}.t2{right:15px;top:190px;animation:tagFloat 7s ease-in-out infinite -2s}.t3{left:70px;bottom:90px;animation:tagFloat 6.5s ease-in-out infinite -4s}
        @keyframes tagFloat{50%{transform:translateY(-12px)}}
        .visual-copy{position:absolute;left:20px;bottom:20px;max-width:420px}
        .visual-copy .kicker{color:#60a5fa;font-size:7px;font-weight:950;letter-spacing:1.7px}
        .visual-copy h2{margin-top:9px;font-size:35px;line-height:1.03;letter-spacing:-1.8px}
        .visual-copy p{margin-top:11px;color:#64748b;font-size:9px;line-height:1.7}

        /* ===== LOGIN CARD ===== */
        .login-side{position:relative;display:flex;justify-content:center;perspective:1200px}
        .card-wrap{width:min(100%,475px);transform-style:preserve-3d;transition:transform .12s ease-out}
        .card{position:relative;overflow:hidden;padding:32px;border:1px solid rgba(255,255,255,.085);border-radius:24px;
            background:linear-gradient(145deg,rgba(12,20,39,.82),rgba(5,10,23,.72));backdrop-filter:blur(28px);
            box-shadow:0 35px 100px rgba(0,0,0,.4),0 0 0 1px rgba(59,130,246,.02),inset 0 1px rgba(255,255,255,.045)}
        .card:before{content:"";position:absolute;inset:-1px;border-radius:24px;padding:1px;background:linear-gradient(130deg,rgba(96,165,250,.35),transparent 28%,transparent 70%,rgba(168,85,247,.22));
            -webkit-mask:linear-gradient(#000 0 0) content-box,linear-gradient(#000 0 0);-webkit-mask-composite:xor;mask-composite:exclude;pointer-events:none}
        .card-light{position:absolute;width:260px;height:260px;border-radius:50%;pointer-events:none;opacity:.5;transform:translate(-50%,-50%);
            background:radial-gradient(circle,rgba(59,130,246,.13),transparent 68%);left:50%;top:0}
        .security{display:flex;align-items:center;justify-content:space-between;margin-bottom:26px}
        .secure-pill{display:flex;align-items:center;gap:7px;padding:7px 9px;border:1px solid rgba(34,197,94,.12);border-radius:999px;background:rgba(34,197,94,.04);
            color:#86efac;font-size:6.5px;font-weight:900;letter-spacing:.8px}.secure-pill i{width:5px;height:5px;border-radius:50%;background:#22c55e;box-shadow:0 0 9px #22c55e}
        .code{color:#39475d;font-size:6.5px;font-weight:900;letter-spacing:1px}
        .heading{margin-bottom:26px}.heading .eyebrow{color:#60a5fa;font-size:7px;font-weight:950;letter-spacing:1.6px}
        .heading h1{margin-top:9px;font-size:32px;letter-spacing:-1.4px}.heading p{margin-top:8px;color:#718096;font-size:9px;line-height:1.6}

        .alert{position:relative;padding:11px 12px;margin-bottom:15px;border-radius:11px;font-size:8px;line-height:1.55;font-weight:700}
        .alert-success{color:#86efac;border:1px solid rgba(34,197,94,.18);background:rgba(34,197,94,.07)}
        .alert-error{color:#fca5a5;border:1px solid rgba(239,68,68,.2);background:rgba(239,68,68,.075)}

        .field{margin-bottom:16px}.field-head{display:flex;align-items:center;justify-content:space-between;margin-bottom:7px}
        .field label{color:#aab6c8;font-size:7.5px;font-weight:900;letter-spacing:.45px}
        .field-icon{color:#40506a;font-size:7px;font-weight:900}
        .input-shell{position:relative}
        .input-shell input{width:100%;height:49px;padding:0 44px 0 14px;border:1px solid rgba(255,255,255,.075);border-radius:11px;outline:none;
            background:rgba(2,6,23,.5);color:#f8fafc;font-size:9px;font-weight:700;transition:.23s;box-shadow:inset 0 1px 8px rgba(0,0,0,.18)}
        .input-shell input::placeholder{color:#344258}
        .input-shell input:focus{border-color:rgba(96,165,250,.45);background:rgba(3,8,20,.72);box-shadow:0 0 0 4px rgba(59,130,246,.075),0 12px 30px rgba(0,0,0,.16)}
        .input-shell:focus-within:after{content:"";position:absolute;left:12px;right:12px;bottom:0;height:1px;background:linear-gradient(90deg,transparent,#60a5fa,transparent)}
        .input-end{position:absolute;right:12px;top:50%;transform:translateY(-50%);color:#53637a;font-size:7px;font-weight:900}
        .eye{border:0;background:transparent;color:#607089;cursor:pointer;padding:6px;transition:.2s}.eye:hover{color:#bfdbfe}

        .options{display:flex;align-items:center;justify-content:space-between;gap:14px;margin:3px 0 20px}
        .remember{display:flex;align-items:center;gap:8px;color:#66758c;font-size:7.5px;font-weight:800;cursor:pointer}
        .remember input{appearance:none;width:15px;height:15px;border:1px solid rgba(255,255,255,.13);border-radius:4px;background:rgba(2,6,23,.6);display:grid;place-items:center;cursor:pointer}
        .remember input:checked{background:linear-gradient(135deg,#2563eb,#7c3aed);border-color:transparent}
        .remember input:checked:after{content:"✓";font-size:9px;color:white;font-weight:950}
        .forgot{color:#7da9ed;font-size:7.5px;font-weight:900;transition:.2s}.forgot:hover{color:#bfdbfe}

        .submit{position:relative;overflow:hidden;width:100%;height:51px;border:0;border-radius:11px;color:#fff;cursor:pointer;
            background:linear-gradient(135deg,#2563eb,#4f46e5,#7c3aed);box-shadow:0 15px 40px rgba(37,99,235,.22);font-size:8.5px;font-weight:950;letter-spacing:.4px;transition:.25s}
        .submit:hover{transform:translateY(-2px);box-shadow:0 20px 48px rgba(37,99,235,.3)}
        .submit:before{content:"";position:absolute;top:-50px;left:-100px;width:60px;height:150px;background:rgba(255,255,255,.18);transform:rotate(24deg);filter:blur(5px);transition:left .65s}
        .submit:hover:before{left:125%}.submit span{position:relative;z-index:2}.submit .arrow{display:inline-block;margin-left:7px;font-size:12px;transition:.2s}.submit:hover .arrow{transform:translateX(4px)}

        .divider{display:flex;align-items:center;gap:10px;margin:22px 0 17px;color:#334155;font-size:6px;font-weight:900;letter-spacing:1px}
        .divider:before,.divider:after{content:"";height:1px;flex:1;background:rgba(255,255,255,.055)}
        .back{display:flex;align-items:center;justify-content:center;gap:7px;color:#56657b;font-size:7.5px;font-weight:850;transition:.2s}.back:hover{color:#94a3b8}
        .footer{margin-top:22px;padding-top:17px;border-top:1px solid rgba(255,255,255,.05);display:flex;align-items:center;justify-content:space-between;color:#344258;font-size:6px;font-weight:850;letter-spacing:.5px}
        .footer span:last-child{display:flex;align-items:center;gap:5px}.footer i{width:5px;height:5px;border-radius:50%;background:#22c55e;box-shadow:0 0 8px rgba(34,197,94,.7)}

        @media(max-width:1050px){
            .page{grid-template-columns:1fr;padding-top:60px}.visual{min-height:520px}.scene{transform:scale(.8)}
            .visual-copy{left:50%;bottom:0;transform:translateX(-50%);text-align:center;width:100%}.login-side{padding-bottom:70px}
        }
        @media(max-width:650px){
            .topbar,.page{width:min(100% - 24px,1460px)}.brand-sub{display:none}.page{gap:20px;padding-top:30px}
            .visual{min-height:420px}.scene{transform:scale(.62)}.visual-copy{bottom:-15px}.visual-copy h2{font-size:28px}
            .card{padding:24px 20px;border-radius:20px}.heading h1{font-size:28px}.options{align-items:flex-start;flex-direction:column}
        }
        @media(max-width:430px){.home span{display:none}.visual{min-height:360px}.scene{transform:scale(.52)}}
        @media(prefers-reduced-motion:reduce){*,*:before,*:after{animation-duration:.01ms!important;animation-iteration-count:1!important;scroll-behavior:auto!important}}
    </style>
</head>
<body>
<div class="universe">
    <div class="aurora"></div><div class="grid"></div>
    <div class="glow g1"></div><div class="glow g2"></div>
    <div class="beam b1"></div><div class="beam b2"></div>
    <div id="particles"></div>
</div>
<div id="mouseGlow"></div>

<header class="topbar">
    <nav class="nav">
        <a href="{{ route('home') }}" class="brand">
            <div class="brand-mark">US</div>
            <div>
                <div class="brand-title">Uni<span>Sched</span></div>
                <div class="brand-sub">INTELLIGENT ACADEMIC SCHEDULING</div>
            </div>
        </a>
        <a href="{{ route('home') }}" class="home">← <span>Back to Home</span></a>
    </nav>
</header>

<main class="page">
    <section class="visual" id="visual">
        <div class="scene" id="scene">
            <div class="halo h1"></div><div class="halo h2"></div>
            <div class="ring r3"><span class="node cyan"></span></div>
            <div class="ring r2"><span class="node purple"></span></div>
            <div class="ring r1"><span class="node"></span></div>

            <div class="sphere">
                <div class="sphere-copy">
                    <strong>Uni<span>Sched</span></strong>
                    <small>ADMIN CORE</small>
                </div>
            </div>

            <div class="tag t1">SECURE ADMIN ACCESS</div>
            <div class="tag t2">SCHEDULING CONTROL</div>
            <div class="tag t3">SYSTEM ONLINE</div>
        </div>

        <div class="visual-copy">
            <div class="kicker">UNISCHED ADMINISTRATION</div>
            <h2>Control the academic schedule from one intelligent workspace.</h2>
            <p>Secure access for routine creation, faculty availability, room allocation, course assignment and publishing.</p>
        </div>
    </section>

    <section class="login-side">
        <div class="card-wrap" id="cardWrap">
            <div class="card" id="loginCard">
                <div class="card-light" id="cardLight"></div>

                <div class="security">
                    <div class="secure-pill"><i></i> SECURE SESSION</div>
                    <div class="code">ADMIN / AUTH</div>
                </div>

                <div class="heading">
                    <div class="eyebrow">ADMINISTRATIVE ACCESS</div>
                    <h1>Welcome back.</h1>
                    <p>Authenticate with your registered administrator credentials to enter the UniSched control center.</p>
                </div>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if(session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif

                @if($errors->any())
                    <div class="alert alert-error">{{ $errors->first() }}</div>
                @endif

                <form method="POST" action="{{ route('admin.login.submit') }}">
                    @csrf

                    <div class="field">
                        <div class="field-head">
                            <label for="email">ADMIN EMAIL</label>
                            <span class="field-icon">IDENTITY</span>
                        </div>
                        <div class="input-shell">
                            <input id="email" type="email" name="email" value="{{ old('email') }}"
                                   placeholder="Enter registered admin email" required autofocus autocomplete="email">
                            <span class="input-end">@</span>
                        </div>
                    </div>

                    <div class="field">
                        <div class="field-head">
                            <label for="password">PASSWORD</label>
                            <span class="field-icon">ENCRYPTED</span>
                        </div>
                        <div class="input-shell">
                            <input id="password" type="password" name="password"
                                   placeholder="Enter your password" required autocomplete="current-password">
                            <button type="button" class="input-end eye" id="togglePassword" aria-label="Show password">SHOW</button>
                        </div>
                    </div>

                    <div class="options">
                        <label class="remember">
                            <input type="checkbox" name="remember" value="1" {{ old('remember') ? 'checked' : '' }}>
                            Remember this session
                        </label>

                        <a href="{{ route('admin.password.request') }}" class="forgot">Forgot Password?</a>
                    </div>

                    <button type="submit" class="submit" id="submitBtn">
                        <span>Sign In to Dashboard <b class="arrow">→</b></span>
                    </button>
                </form>

                <div class="divider">UNISCHED SECURE GATEWAY</div>
                <a href="{{ route('home') }}" class="back">← Return to public portal</a>

                <div class="footer">
                    <span>Academic Scheduling Administration</span>
                    <span><i></i> SYSTEM ONLINE</span>
                </div>
            </div>
        </div>
    </section>
</main>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const fine = window.matchMedia('(pointer:fine)').matches;

    const particles = document.getElementById('particles');
    if (!reduced && particles) {
        for (let i = 0; i < 38; i++) {
            const p = document.createElement('span');
            p.className = 'particle';
            const s = 1 + Math.random() * 2.2;
            p.style.cssText = `left:${Math.random()*100}%;top:${48+Math.random()*62}%;width:${s}px;height:${s}px;animation-duration:${11+Math.random()*15}s;animation-delay:${Math.random()*-22}s;`;
            particles.appendChild(p);
        }
    }

    const mouseGlow = document.getElementById('mouseGlow');
    if (fine && mouseGlow) {
        document.addEventListener('mousemove', e => {
            mouseGlow.style.opacity = '1';
            mouseGlow.style.left = e.clientX + 'px';
            mouseGlow.style.top = e.clientY + 'px';
        });
        document.addEventListener('mouseleave', () => mouseGlow.style.opacity = '0');
    }

    const visual = document.getElementById('visual');
    const scene = document.getElementById('scene');

    function sceneScale(){
        if (innerWidth <= 430) return .52;
        if (innerWidth <= 650) return .62;
        if (innerWidth <= 1050) return .8;
        return 1;
    }
    function setScene(rx=0, ry=0){
        if(scene) scene.style.transform = `scale(${sceneScale()}) rotateX(${rx}deg) rotateY(${ry}deg)`;
    }
    if (visual && scene && fine && !reduced) {
        visual.addEventListener('mousemove', e => {
            const r = visual.getBoundingClientRect();
            const x = (e.clientX-r.left)/r.width, y=(e.clientY-r.top)/r.height;
            setScene((y-.5)*-8,(x-.5)*10);
        });
        visual.addEventListener('mouseleave',()=>setScene());
    }
    addEventListener('resize',()=>setScene());
    setScene();

    const wrap = document.getElementById('cardWrap');
    const card = document.getElementById('loginCard');
    const light = document.getElementById('cardLight');
    if (wrap && card && fine && !reduced) {
        card.addEventListener('mousemove', e => {
            const r = card.getBoundingClientRect();
            const x=(e.clientX-r.left)/r.width, y=(e.clientY-r.top)/r.height;
            wrap.style.transform=`rotateX(${(y-.5)*-4}deg) rotateY(${(x-.5)*5}deg)`;
            light.style.left=(e.clientX-r.left)+'px';
            light.style.top=(e.clientY-r.top)+'px';
        });
        card.addEventListener('mouseleave',()=>{wrap.style.transform='rotateX(0) rotateY(0)';light.style.left='50%';light.style.top='0';});
    }

    const password = document.getElementById('password');
    const toggle = document.getElementById('togglePassword');
    if(password && toggle){
        toggle.addEventListener('click',()=>{
            const hidden=password.type==='password';
            password.type=hidden?'text':'password';
            toggle.textContent=hidden?'HIDE':'SHOW';
            toggle.setAttribute('aria-label',hidden?'Hide password':'Show password');
        });
    }

    const form = document.querySelector('form');
    const submit = document.getElementById('submitBtn');
    if(form && submit){
        form.addEventListener('submit',()=>{
            submit.disabled=true;
            submit.querySelector('span').innerHTML='Authenticating...';
        });
    }
});
</script>
</body>
</html>
