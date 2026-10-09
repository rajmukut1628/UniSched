<style>
    .sidebar.unisched-sidebar {
        height: 100vh;
        height: 100dvh;
        overflow-y: auto;
    }

    .unisched-brand {
        display: block;
        margin-bottom: 28px;
        color: #f8fafc;
        font-size: 25px;
        font-weight: 800;
        text-decoration: none;
    }

    .unisched-brand span { color: #60a5fa; }

    .unisched-nav-group {
        margin: 22px 10px 10px;
        color: #94a3b8;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    .unisched-nav-link {
        display: block;
        padding: 12px 14px;
        margin-bottom: 5px;
        border-radius: 10px;
        color: #94a3b8;
        font-size: 14px;
        text-decoration: none;
    }

    .unisched-nav-link:hover,
    .unisched-nav-link.active {
        background: rgba(59,130,246,.12);
        color: #93c5fd;
    }

    .unisched-nav-link:focus-visible,
    .unisched-brand:focus-visible,
    .unisched-logout:focus-visible,
    .unisched-mobile-navigation summary:focus-visible {
        outline: 2px solid #60a5fa;
        outline-offset: 2px;
    }

    .unisched-account {
        margin-top: 24px;
        padding-top: 16px;
        border-top: 1px solid rgba(255,255,255,.07);
        font-size: 13px;
        overflow-wrap: anywhere;
    }

    .unisched-account-email { margin-top: 5px; color: #94a3b8; }

    .unisched-logout {
        width: 100%;
        margin-top: 14px;
        padding: 10px;
        border: 0;
        border-radius: 9px;
        background: rgba(239,68,68,.10);
        color: #fca5a5;
        cursor: pointer;
    }

    .unisched-mobile-navigation { display: none; }

    @media(max-width: 1000px) {
        .sidebar.unisched-sidebar { display: none; }
        .layout > .main { margin-left: 0; }

        .unisched-mobile-navigation {
            display: block;
            padding: 14px 20px;
            background: #0b1120;
            border-bottom: 1px solid rgba(255,255,255,.07);
        }

        .unisched-mobile-navigation summary {
            padding: 8px 0;
            color: #f8fafc;
            font-weight: 700;
            cursor: pointer;
        }

        .unisched-mobile-navigation summary span {
            float: right;
            color: #93c5fd;
        }

        .unisched-mobile-navigation nav {
            max-height: 65vh;
            max-height: 65dvh;
            overflow-y: auto;
            padding: 0 4px 8px;
        }
    }
</style>
