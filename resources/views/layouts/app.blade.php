<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Sistema de Gestión') - {{ config('app.name') }}</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Materialize CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" rel="stylesheet">

    <style>
        :root {
            /* Gold & Black Theme */
            --primary-color: #D4AF37;
            /* Metallic Gold */
            --primary-dark: #B4941F;
            --primary-light: #F4C430;
            --primary-lighter: #FCE68A;
            --secondary-color: #000000;
            /* Pure Black */
            --accent-color: #D4AF37;

            --success-color: #10b981;
            --danger-color: #ef4444;
            --warning-color: #f59e0b;
            --info-color: #06b6d4;

            --dark-color: #000000;
            --text-primary: #1e293b;
            --text-secondary: #64748b;
            --text-on-dark: #FFD700;
            /* Gold text on black backgrounds */

            --bg-primary: #f8fafc;
            --bg-secondary: #ffffff;
            --border-color: #e2e8f0;
            --sidebar-width: 280px;
        }

        * {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        }

        body {
            display: flex;
            min-height: 100vh;
            flex-direction: column;
            background: var(--bg-primary);
            color: var(--text-primary);
        }

        main {
            flex: 1 0 auto;
            padding: 24px 0;
        }

        /* =============== SIDEBAR =============== */
        .sidenav {
            width: var(--sidebar-width);
            background: linear-gradient(180deg, #000000 0%, #1a1a1a 100%);
            box-shadow: 4px 0 24px rgba(0, 0, 0, 0.4);
            border-right: 1px solid rgba(212, 175, 55, 0.2);
        }

        .sidenav .user-view {
            padding: 28px 24px 20px;
            background: linear-gradient(135deg, rgba(212, 175, 55, 0.1) 0%, rgba(0, 0, 0, 0.4) 100%);
            border-bottom: 1px solid rgba(212, 175, 55, 0.3);
            margin-bottom: 8px;
        }

        .sidenav .user-view .user-avatar {
            width: 56px;
            height: 56px;
            background: linear-gradient(135deg, var(--primary-color), #FCE68A);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            font-weight: 700;
            color: black;
            border-radius: 14px;
            margin-bottom: 14px;
            box-shadow: 0 4px 12px rgba(212, 175, 55, 0.4);
        }

        .sidenav .user-view .user-name {
            color: var(--primary-color);
            font-weight: 600;
            font-size: 1rem;
            display: block;
            margin-bottom: 4px;
        }

        .sidenav .user-view .user-email {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.85rem;
            display: block;
            margin-bottom: 8px;
        }

        .sidenav .user-view .user-role {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 4px 10px;
            background: rgba(212, 175, 55, 0.15);
            border: 1px solid rgba(212, 175, 55, 0.3);
            border-radius: 20px;
            color: var(--primary-color);
            font-size: 0.75rem;
            font-weight: 500;
        }

        .sidenav .menu-section {
            padding: 16px 20px 8px;
            color: rgba(212, 175, 55, 0.8);
            font-size: 0.7rem;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .sidenav li>a {
            color: rgba(255, 255, 255, 0.8);
            font-weight: 500;
            font-size: 0.9rem;
            padding: 0 24px;
            height: 48px;
            line-height: 48px;
            margin: 2px 12px;
            border-radius: 10px;
            transition: all 0.2s ease;
        }

        .sidenav li>a:hover {
            background: rgba(212, 175, 55, 0.1);
            color: var(--primary-color);
        }

        .sidenav li>a>i {
            color: rgba(255, 255, 255, 0.5);
            margin-right: 16px;
            font-size: 20px;
            line-height: 48px;
            height: 48px;
            width: 24px;
        }

        .sidenav li>a.active {
            background: linear-gradient(90deg, var(--primary-color), var(--primary-dark));
            color: black;
            box-shadow: 0 4px 12px rgba(212, 175, 55, 0.3);
            font-weight: 600;
        }

        .sidenav li>a.active>i {
            color: black;
        }

        .sidenav .divider {
            background: rgba(212, 175, 55, 0.2);
            margin: 8px 24px;
        }

        /* =============== NAVBAR =============== */
        nav {
            background: black;
            box-shadow: 0 1px 10px rgba(0, 0, 0, 0.2);
            height: 64px;
            line-height: 64px;
            border-bottom: 1px solid rgba(212, 175, 55, 0.3);
        }

        nav .nav-wrapper {
            padding: 0 24px;
        }

        nav .brand-logo {
            font-weight: 700;
            font-size: 1.25rem;
            color: var(--primary-color);
            letter-spacing: -0.5px;
        }

        nav .sidenav-trigger {
            color: white;
        }

        nav .sidenav-trigger i {
            line-height: 64px;
            height: 64px;
        }

        nav ul li a {
            color: white;
            font-weight: 500;
            font-size: 0.9rem;
        }

        nav ul li a:hover {
            background: rgba(255, 255, 255, 0.1);
            color: var(--primary-color);
        }

        nav .dropdown-content {
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5);
            background: #1a1a1a;
            border: 1px solid var(--primary-dark);
        }

        nav .dropdown-content li>a {
            color: var(--primary-color);
            font-size: 0.9rem;
        }

        nav .dropdown-content li:hover {
            background-color: #2a2a2a;
        }

        /* =============== CARDS =============== */
        .card {
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            /* Softer shadow */
            border: 1px solid var(--border-color);
            transition: all 0.3s ease;
            background: white;
        }

        .card:hover {
            box-shadow: 0 8px 24px rgba(212, 175, 55, 0.15);
            /* Gold glow on hover */
            transform: translateY(-2px);
            border-color: rgba(212, 175, 55, 0.3);
        }

        .card .card-content {
            padding: 24px;
        }

        .card .card-title {
            font-weight: 700;
            font-size: 1.1rem;
            color: black;
        }

        .card .card-action {
            border-top: 1px solid var(--border-color);
            padding: 16px 24px;
            border-radius: 0 0 16px 16px;
        }

        /* =============== STATS CARDS =============== */
        .stats-card {
            border-radius: 16px;
            padding: 24px;
            position: relative;
            overflow: hidden;
            color: white;
            /* Text is white on colored cards */
            border: none;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.2);
        }

        .stats-card.blue-gradient {
            background: linear-gradient(135deg, #000000 0%, #1a1a1a 100%);
            border: 1px solid #333;
        }

        .stats-card.blue-gradient .stats-number,
        .stats-card.blue-gradient .stats-icon i {
            color: var(--primary-color);
        }

        .stats-card.green-gradient {
            background: linear-gradient(135deg, #000000 0%, #1a1a1a 100%);
            border: 1px solid #333;
        }

        .stats-card.green-gradient .stats-number,
        .stats-card.green-gradient .stats-icon i {
            color: var(--success-color);
        }

        .stats-card.orange-gradient {
            background: linear-gradient(135deg, #000000 0%, #1a1a1a 100%);
            border: 1px solid #333;
        }

        .stats-card.orange-gradient .stats-number,
        .stats-card.orange-gradient .stats-icon i {
            color: var(--warning-color);
        }

        .stats-card.purple-gradient {
            background: linear-gradient(135deg, #000000 0%, #1a1a1a 100%);
            border: 1px solid #333;
        }

        .stats-card.purple-gradient .stats-number,
        .stats-card.purple-gradient .stats-icon i {
            color: #a855f7;
        }

        /* =============== BUTTONS =============== */
        .btn {
            border-radius: 4px;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 700;
            font-size: 0.8rem;
            padding: 0 24px;
            height: 42px;
            line-height: 42px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
            border: 1px solid transparent;
            /* default */
        }

        .btn:hover {
            box-shadow: 0 6px 16px rgba(212, 175, 55, 0.4);
            transform: translateY(-1px);
        }

        /* Primary Action (formerly Blue) -> Solid Gold */
        .btn.blue {
            background: linear-gradient(135deg, #D4AF37, #F4C430);
            color: black;
            border: 1px solid #B4941F;
        }

        .btn.blue:hover {
            background: linear-gradient(135deg, #F4C430, #FFD700);
        }

        /* Success (formerly Green) -> Black with Green Accent */
        .btn.green {
            background: #000000;
            color: #10b981;
            border: 1px solid #10b981;
        }

        .btn.green:hover {
            background: #10b981;
            color: white;
        }

        /* Danger (formerly Red) -> Black with Red Accent */
        .btn.red {
            background: #000000;
            color: #ef4444;
            border: 1px solid #ef4444;
        }

        .btn.red:hover {
            background: #ef4444;
            color: white;
        }

        /* Warning (formerly Orange) -> Black with Gold Accent */
        .btn.orange {
            background: #000000;
            color: #F59E0B;
            border: 1px solid #F59E0B;
        }

        .btn.orange:hover {
            background: #F59E0B;
            color: white;
        }

        /* Info/Other (formerly Purple) -> Black with Purple Accent */
        .btn.purple {
            background: #000000;
            color: #a855f7;
            border: 1px solid #a855f7;
        }

        .btn.purple:hover {
            background: #a855f7;
            color: white;
        }

        .btn-flat {
            font-weight: 600;
            color: var(--primary-dark);
            border-radius: 4px;
        }

        .btn-flat:hover {
            background-color: rgba(212, 175, 55, 0.1);
        }

        .btn-floating {
            background: linear-gradient(135deg, #D4AF37, #F4C430);
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.4);
        }

        .btn-floating:hover {
            box-shadow: 0 6px 24px rgba(212, 175, 55, 0.5);
            background: linear-gradient(135deg, #F4C430, #FFD700);
        }

        /* Overrides for specific floating button colors to ensure they stick to theme or look premium */
        .btn-floating.blue {
            background: linear-gradient(135deg, #D4AF37, #F4C430) !important;
        }

        .btn-floating.red {
            background: #000000 !important;
            border: 1px solid #ef4444;
        }

        .btn-floating.red i {
            color: #ef4444;
        }

        /* Materialize Text Helpers Overrides */
        .red-text {
            color: #ef4444 !important;
        }

        .blue-text {
            color: #D4AF37 !important;
        }

        /* Blue text becomes Gold */
        .green-text {
            color: #10b981 !important;
        }

        /* Modal tweaks for dark/gold theme if needed */
        .modal {
            border: 1px solid #D4AF37;
            background-color: white; /* Ensure readability */
        }

        /* =============== TABLES =============== */
        table thead {
            background: black;
        }

        table th {
            color: var(--primary-color);
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-bottom: 2px solid var(--primary-color);
        }

        table.striped>tbody>tr:nth-child(odd) {
            background-color: #fafafa;
        }

        /* =============== FOOTER =============== */
        .page-footer {
            background: black;
            padding: 0;
            border-top: 1px solid var(--primary-dark);
            margin-top: auto;
            /* Push to bottom */
        }

        .page-footer .footer-copyright {
            background: transparent;
            font-size: 0.9rem;
            padding: 20px 0;
            color: #888;
        }

        .page-footer .footer-copyright .container {
            display: flex;
            justify-content: center;
        }

        .author-text {
            color: var(--primary-color);
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        /* =============== FLOATING ACTION BUTTON =============== */
        .fixed-action-btn {
            bottom: 32px;
            right: 32px;
        }

        .fixed-action-btn .btn-floating.btn-large {
            width: 60px;
            height: 60px;
            line-height: 60px;
        }

        .fixed-action-btn .btn-floating.btn-large i {
            line-height: 60px;
            font-size: 28px;
        }

        /* =============== EMPTY STATE =============== */
        .empty-state {
            padding: 60px 20px;
            text-align: center;
        }

        .empty-state i {
            font-size: 80px;
            color: var(--border-color);
            margin-bottom: 16px;
        }

        .empty-state h5 {
            font-weight: 600;
            color: var(--text-secondary);
            margin-bottom: 8px;
        }

        .empty-state p {
            color: var(--text-secondary);
            margin-bottom: 24px;
        }

        /* =============== USER AVATAR =============== */
        .user-avatar-sm {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 14px;
        }

        /* =============== RESPONSIVE =============== */
        @media only screen and (max-width: 992px) {
            main {
                padding-left: 0 !important;
            }

            nav {
                padding-left: 0 !important;
            }

            .sidenav {
                transform: translateX(-105%);
            }
        }

        @media only screen and (min-width: 993px) {
            main {
                padding-left: var(--sidebar-width);
            }

            nav {
                padding-left: var(--sidebar-width);
            }
        }

        /* =============== ANIMATIONS =============== */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fadeIn 0.4s ease forwards;
        }

        /* Stagger animation for cards */
        .row .col:nth-child(1) {
            animation-delay: 0.05s;
        }

        .row .col:nth-child(2) {
            animation-delay: 0.1s;
        }

        .row .col:nth-child(3) {
            animation-delay: 0.15s;
        }

        .row .col:nth-child(4) {
            animation-delay: 0.2s;
        }
    </style>
    @stack('styles')
</head>

<body>
    @auth
        <!-- Navbar -->
        <nav>
            <div class="nav-wrapper">
                <a href="#" data-target="sidenav" class="sidenav-trigger show-on-large">
                    <i class="material-icons">menu</i>
                </a>
                <a href="{{ route('dashboard') }}" class="brand-logo center">
                    <span style="display: flex; align-items: center; gap: 8px;">
                        <i class="material-icons" style="color: var(--primary-color);">dashboard</i>
                        Sistema de Gestión
                    </span>
                </a>
                <ul class="right hide-on-med-and-down">
                    <li>
                        <a href="#!" class="dropdown-trigger" data-target="user-dropdown">
                            <i class="material-icons left">account_circle</i>
                            {{ Auth::user()->name }}
                            <i class="material-icons right">arrow_drop_down</i>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- User Dropdown -->
        <ul id="user-dropdown" class="dropdown-content">
            <li><a href="#!"><i class="material-icons">person</i>Mi Perfil</a></li>
            <li class="divider"></li>
            <li>
                <a href="#!" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="material-icons">exit_to_app</i>Cerrar Sesión
                </a>
            </li>
        </ul>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>

        <!-- Sidenav -->
        <ul id="sidenav" class="sidenav sidenav-fixed">
            <li>
                <div class="user-view">
                    <div class="user-avatar">{{ substr(Auth::user()->name, 0, 1) }}</div>
                    <span class="user-name">{{ Auth::user()->name }}</span>
                    <span class="user-email">{{ Auth::user()->email }}</span>
                    <span class="user-role">
                        <i class="material-icons" style="font-size: 14px;">verified_user</i>
                        {{ Auth::user()->role_name }}
                    </span>
                </div>
            </li>

            <li><span class="menu-section">Principal</span></li>
            <li>
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="material-icons">dashboard</i>Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('products.index') }}" class="{{ request()->routeIs('products.*') ? 'active' : '' }}">
                    <i class="material-icons">inventory_2</i>Productos
                </a>
            </li>

            @if(Auth::user()->isSuperAdmin())
                <li>
                    <div class="divider"></div>
                </li>
                <li><span class="menu-section">Administración</span></li>
                <li>
                    <a href="{{ route('users.index') }}" class="{{ request()->routeIs('users.*') ? 'active' : '' }}">
                        <i class="material-icons">people</i>Usuarios
                    </a>
                </li>
                <li>
                    <a href="{{ route('audit.index') }}" class="{{ request()->routeIs('audit.*') ? 'active' : '' }}">
                        <i class="material-icons">history</i>Auditoría
                    </a>
                </li>
            @endif

            <li>
                <div class="divider"></div>
            </li>
            <li><span class="menu-section">Cuenta</span></li>
            <li>
                <a href="#!" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="material-icons">exit_to_app</i>Cerrar Sesión
                </a>
            </li>
        </ul>
    @endauth

    <main>
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success animate-fade-in">
                    <i class="material-icons">check_circle</i>
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-error animate-fade-in">
                    <i class="material-icons">error</i>
                    {{ session('error') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-error animate-fade-in">
                    <i class="material-icons">error</i>
                    <ul style="margin: 0; padding-left: 20px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </div>
    </main>



    <footer class="page-footer">
        <div class="footer-copyright">
            <div class="container">
                <span class="author-text">Hecho por Abrahan Taborda Echavarria - Coder Riwi 2026</span>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var sidenavs = document.querySelectorAll('.sidenav');
            M.Sidenav.init(sidenavs);

            var dropdowns = document.querySelectorAll('.dropdown-trigger');
            M.Dropdown.init(dropdowns, {
                constrainWidth: false,
                coverTrigger: false
            });

            var selects = document.querySelectorAll('select');
            M.FormSelect.init(selects);
            M.Modal.init(document.querySelectorAll('.modal'));
            M.Tooltip.init(document.querySelectorAll('.tooltipped'));
            M.FloatingActionButton.init(document.querySelectorAll('.fixed-action-btn'));
            M.Datepicker.init(document.querySelectorAll('.datepicker'), {
                format: 'yyyy-mm-dd',
                i18n: {
                    months: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                    monthsShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                    weekdays: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
                    weekdaysShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb'],
                    weekdaysAbbrev: ['D', 'L', 'M', 'M', 'J', 'V', 'S'],
                    cancel: 'Cancelar',
                    done: 'Aceptar'
                }
            });
        });
    </script>
    @stack('scripts')
</body>

</html>