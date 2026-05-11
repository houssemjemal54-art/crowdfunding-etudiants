<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'FundCampus')</title>
    <style>
        :root {
            --bg: #f7f8fb;
            --panel: #ffffff;
            --ink: #18202f;
            --muted: #647084;
            --line: #dfe4ec;
            --brand: #0f766e;
            --brand-dark: #115e59;
            --accent: #b45309;
            --danger: #b42318;
        }

        * { box-sizing: border-box; }
        body {
            margin: 0;
            background: var(--bg);
            color: var(--ink);
            font-family: Arial, Helvetica, sans-serif;
            line-height: 1.5;
        }

        a { color: inherit; text-decoration: none; }
        img { display: block; max-width: 100%; }

        .container { width: min(1120px, calc(100% - 32px)); margin: 0 auto; }
        .topbar {
            background: var(--panel);
            border-bottom: 1px solid var(--line);
            position: sticky;
            top: 0;
            z-index: 10;
        }
        .nav {
            min-height: 68px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }
        .brand { font-size: 1.3rem; font-weight: 800; color: var(--brand-dark); }
        .links { display: flex; flex-wrap: wrap; gap: 8px; align-items: center; }
        .links a {
            padding: 8px 10px;
            border-radius: 6px;
            color: var(--muted);
            font-weight: 700;
        }
        .links a:hover, .links a.active { color: var(--brand-dark); background: #e7f6f4; }

        main { padding: 32px 0 56px; }
        .page-head {
            display: flex;
            justify-content: space-between;
            gap: 16px;
            align-items: flex-start;
            margin-bottom: 22px;
        }
        .eyebrow { margin: 0 0 6px; color: var(--brand-dark); font-weight: 800; }
        h1, h2, h3 { margin: 0; line-height: 1.2; }
        h1 { font-size: clamp(2rem, 4vw, 4rem); max-width: 820px; }
        h2 { font-size: 1.7rem; margin-bottom: 14px; }
        h3 { font-size: 1.05rem; }
        .lead { max-width: 760px; color: var(--muted); font-size: 1.08rem; }

        .hero {
            min-height: 390px;
            display: grid;
            align-items: center;
            padding: 54px 0;
            background:
                linear-gradient(90deg, rgba(8, 42, 40, .86), rgba(8, 42, 40, .52)),
                url('https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=1600&q=80') center/cover;
            color: #fff;
            margin: -32px 0 32px;
        }
        .hero .lead { color: #edf7f6; }
        .hero-actions { display: flex; flex-wrap: wrap; gap: 10px; margin-top: 24px; }

        .grid { display: grid; gap: 16px; }
        .grid-3 { grid-template-columns: repeat(3, minmax(0, 1fr)); }
        .grid-2 { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        .card {
            background: var(--panel);
            border: 1px solid var(--line);
            border-radius: 8px;
            padding: 18px;
            min-width: 0;
        }
        .stat { font-size: 2rem; font-weight: 800; color: var(--brand-dark); }
        .muted { color: var(--muted); }
        .toolbar {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            align-items: center;
            margin-bottom: 16px;
        }
        .search-input, .form-control {
            width: 100%;
            border: 1px solid var(--line);
            border-radius: 6px;
            padding: 11px 12px;
            font: inherit;
            background: #fff;
            color: var(--ink);
        }
        .toolbar .search-input { max-width: 340px; }
        .form-grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 16px; }
        .field label { display: block; font-weight: 800; margin-bottom: 6px; }
        .field.full { grid-column: 1 / -1; }
        .error { color: var(--danger); font-size: .92rem; margin-top: 4px; }
        .actions { display: flex; gap: 10px; flex-wrap: wrap; align-items: center; margin-top: 18px; }
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 40px;
            border: 1px solid transparent;
            border-radius: 6px;
            padding: 9px 14px;
            font-weight: 800;
            cursor: pointer;
            font: inherit;
        }
        .btn-primary { background: var(--brand); color: #fff; }
        .btn-primary:hover { background: var(--brand-dark); }
        .btn-secondary { background: #fff; color: var(--brand-dark); border-color: var(--line); }
        .btn-danger { background: #fff; color: var(--danger); border-color: #f2b8b5; }
        .badge {
            display: inline-flex;
            border-radius: 999px;
            padding: 4px 10px;
            font-size: .84rem;
            font-weight: 800;
            background: #edf2f7;
            color: #354052;
        }
        .badge.active { background: #dff6f0; color: #0f513d; }
        .badge.funded { background: #fff3cd; color: #6f4e00; }
        .badge.closed { background: #f8d7da; color: #842029; }
        .badge.draft { background: #e9ecef; color: #495057; }
        .progress { height: 10px; border-radius: 999px; background: #edf2f7; overflow: hidden; }
        .progress span { display: block; height: 100%; background: var(--accent); }
        .table-wrap { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; background: #fff; border: 1px solid var(--line); border-radius: 8px; overflow: hidden; }
        th, td { padding: 12px; border-bottom: 1px solid var(--line); text-align: left; vertical-align: top; }
        th { background: #f1f5f9; color: #334155; }
        .notice { border: 1px solid #b7eadf; background: #e7f8f5; color: #115e59; border-radius: 8px; padding: 12px 14px; margin-bottom: 16px; }
        .pagination nav { margin-top: 20px; }
        .footer { border-top: 1px solid var(--line); padding: 24px 0; color: var(--muted); background: #fff; }

        @media (max-width: 760px) {
            .nav, .page-head { align-items: stretch; flex-direction: column; }
            .grid-3, .grid-2, .form-grid { grid-template-columns: 1fr; }
            .hero { min-height: 430px; }
            h1 { font-size: 2.2rem; }
        }
    </style>
</head>
<body>
    <header class="topbar">
        <div class="container nav">
            <a class="brand" href="{{ route('home') }}">FundCampus</a>
            <nav class="links" aria-label="Navigation principale">
                <a @class(['active' => request()->routeIs('home')]) href="{{ route('home') }}">Accueil</a>
                <a @class(['active' => request()->routeIs('students.*')]) href="{{ route('students.index') }}">Etudiants</a>
                <a @class(['active' => request()->routeIs('campaigns.*')]) href="{{ route('campaigns.index') }}">Campagnes</a>
                <a @class(['active' => request()->routeIs('contributions.*')]) href="{{ route('contributions.index') }}">Contributions</a>
                <a @class(['active' => request()->routeIs('about')]) href="{{ route('about') }}">A propos</a>
                <a @class(['active' => request()->routeIs('contact')]) href="{{ route('contact') }}">Contact</a>
            </nav>
        </div>
    </header>

    <main>
        <div class="container">
            <x-alert />
        </div>
        @yield('content')
    </main>

    <footer class="footer">
        <div class="container">FundCampus - Projet Laravel MVC, CRUD, validation, recherche et pagination.</div>
    </footer>
</body>
</html>
