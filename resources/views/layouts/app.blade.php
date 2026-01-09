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
            --primary-color: #2563eb;
            --primary-dark: #1d4ed8;
            --primary-light: #3b82f6;
            --primary-lighter: #60a5fa;
            --secondary-color: #7c3aed;
            --accent-color: #f59e0b;
            --success-color: #10b981;
            --danger-color: #ef4444;
            --warning-color: #f59e0b;
            --info-color: #06b6d4;
            --dark-color: #1e293b;
            --text-primary: #1e293b;
            --text-secondary: #64748b;
            --bg-primary: #f8fafc;
            --bg-secondary: #f1f5f9;
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
            background: linear-gradient(180deg, var(--dark-color) 0%, #0f172a 100%);
            box-shadow: 4px 0 24px rgba(0, 0, 0, 0.1);
        }

        .sidenav .user-view {
            padding: 28px 24px 20px;
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.15) 0%, rgba(124, 58, 237, 0.1) 100%);
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            margin-bottom: 8px;
        }

        .sidenav .user-view .user-avatar {
            width: 56px;
            height: 56px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            font-weight: 600;
            color: white;
            border-radius: 14px;
            margin-bottom: 14px;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        }

        .sidenav .user-view .user-name {
            color: white;
            font-weight: 600;
            font-size: 1rem;
            display: block;
            margin-bottom: 4px;
        }

        .sidenav .user-view .user-email {
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.85rem;
            display: block;
            margin-bottom: 8px;
        }

        .sidenav .user-view .user-role {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 4px 10px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.75rem;
            font-weight: 500;
        }

        .sidenav .menu-section {
            padding: 16px 20px 8px;
            color: rgba(255, 255, 255, 0.4);
            font-size: 0.7rem;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .sidenav li>a {
            color: rgba(255, 255, 255, 0.75);
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
            background: rgba(255, 255, 255, 0.08);
            color: white;
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
            background: linear-gradient(90deg, var(--primary-color), var(--primary-light));
            color: white;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        }

        .sidenav li>a.active>i {
            color: white;
        }

        .sidenav .divider {
            background: rgba(255, 255, 255, 0.06);
            margin: 8px 24px;
        }

        /* =============== NAVBAR =============== */
        nav {
            background: white;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            height: 64px;
            line-height: 64px;
        }

        nav .nav-wrapper {
            padding: 0 24px;
        }

        nav .brand-logo {
            font-weight: 700;
            font-size: 1.25rem;
            color: var(--text-primary);
            letter-spacing: -0.5px;
        }

        nav .sidenav-trigger {
            color: var(--text-primary);
        }

        nav .sidenav-trigger i {
            line-height: 64px;
            height: 64px;
        }

        nav ul li a {
            color: var(--text-secondary);
            font-weight: 500;
            font-size: 0.9rem;
        }

        nav ul li a:hover {
            background: transparent;
            color: var(--primary-color);
        }

        nav .dropdown-content {
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.12);
            border: 1px solid var(--border-color);
        }

        nav .dropdown-content li>a {
            color: var(--text-primary);
            font-size: 0.9rem;
        }

        /* =============== CARDS =============== */
        .card {
            border-radius: 16px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04), 0 4px 12px rgba(0, 0, 0, 0.04);
            border: 1px solid var(--border-color);
            transition: all 0.3s ease;
            background: white;
        }

        .card:hover {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.04), 0 10px 24px rgba(0, 0, 0, 0.08);
            transform: translateY(-2px);
        }

        .card .card-content {
            padding: 24px;
        }

        .card .card-title {
            font-weight: 700;
            font-size: 1.1rem;
            color: var(--text-primary);
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
            border: none;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.15);
        }

        .stats-card.blue-gradient {
            background: linear-gradient(135deg, #2563eb 0%, #3b82f6 100%);
        }

        .stats-card.green-gradient {
            background: linear-gradient(135deg, #059669 0%, #10b981 100%);
        }

        .stats-card.orange-gradient {
            background: linear-gradient(135deg, #d97706 0%, #f59e0b 100%);
        }

        .stats-card.purple-gradient {
            background: linear-gradient(135deg, #7c3aed 0%, #8b5cf6 100%);
        }

        .stats-card::before {
            content: '';
            position: absolute;
            top: -30%;
            right: -20%;
            width: 150px;
            height: 150px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }

        .stats-card::after {
            content: '';
            position: absolute;
            bottom: -40%;
            right: 10%;
            width: 100px;
            height: 100px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
        }

        .stats-card .stats-icon {
            width: 48px;
            height: 48px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 16px;
        }

        .stats-card .stats-icon i {
            font-size: 24px;
            color: white;
        }

        .stats-card .stats-number {
            font-size: 2rem;
            font-weight: 800;
            line-height: 1;
            margin-bottom: 4px;
        }

        .stats-card .stats-label {
            font-size: 0.85rem;
            opacity: 0.85;
            font-weight: 500;
        }

        /* =============== BUTTONS =============== */
        .btn {
            border-radius: 10px;
            text-transform: none;
            font-weight: 600;
            font-size: 0.9rem;
            letter-spacing: 0;
            padding: 0 24px;
            height: 42px;
            line-height: 42px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            transition: all 0.2s ease;
        }

        .btn:hover {
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.15);
            transform: translateY(-1px);
        }

        .btn.blue {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
        }

        .btn.green {
            background: linear-gradient(135deg, #059669, #10b981);
        }

        .btn.red {
            background: linear-gradient(135deg, #dc2626, #ef4444);
        }

        .btn.orange {
            background: linear-gradient(135deg, #d97706, #f59e0b);
        }

        .btn.purple {
            background: linear-gradient(135deg, #7c3aed, #8b5cf6);
        }

        .btn-flat {
            font-weight: 600;
            color: var(--primary-color);
            border-radius: 8px;
        }

        .btn-floating {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
            box-shadow: 0 4px 16px rgba(37, 99, 235, 0.3);
        }

        .btn-floating:hover {
            box-shadow: 0 6px 24px rgba(37, 99, 235, 0.4);
        }

        /* =============== TABLES =============== */
        table {
            border-collapse: separate;
            border-spacing: 0;
        }

        table thead {
            background: var(--bg-secondary);
        }

        table th {
            font-weight: 600;
            font-size: 0.8rem;
            color: var(--text-secondary);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 14px 16px;
            border-bottom: 1px solid var(--border-color);
        }

        table td {
            padding: 16px;
            border-bottom: 1px solid var(--border-color);
            font-size: 0.9rem;
            color: var(--text-primary);
        }

        table.striped>tbody>tr:nth-child(odd) {
            background-color: var(--bg-primary);
        }

        table tbody tr:hover {
            background-color: rgba(37, 99, 235, 0.03) !important;
        }

        /* =============== FORMS =============== */
        .input-field input,
        .input-field textarea {
            border: 2px solid var(--border-color) !important;
            border-radius: 10px !important;
            padding: 12px 16px !important;
            height: auto !important;
            box-sizing: border-box !important;
            font-size: 0.95rem !important;
            transition: all 0.2s ease !important;
            background: white !important;
        }

        .input-field input:focus,
        .input-field textarea:focus {
            border-color: var(--primary-color) !important;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1) !important;
        }

        .input-field label {
            font-size: 0.9rem;
            color: var(--text-secondary);
        }

        .input-field label.active {
            transform: translateY(-28px) scale(0.85);
            color: var(--primary-color);
        }

        .input-field .prefix {
            top: 12px;
            font-size: 22px;
            color: var(--text-secondary);
        }

        .input-field .prefix~input,
        .input-field .prefix~textarea {
            margin-left: 44px;
            width: calc(100% - 44px);
        }

        select {
            border: 2px solid var(--border-color) !important;
            border-radius: 10px !important;
            padding: 12px 16px !important;
            background: white !important;
        }

        /* =============== BADGES =============== */
        .badge-role {
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        .badge-super-admin {
            background: linear-gradient(135deg, #7c3aed, #8b5cf6);
            color: white;
        }

        .badge-editor {
            background: linear-gradient(135deg, #d97706, #f59e0b);
            color: white;
        }

        .badge-viewer {
            background: linear-gradient(135deg, #2563eb, #3b82f6);
            color: white;
        }

        .badge-active {
            background: linear-gradient(135deg, #059669, #10b981);
            color: white;
        }

        .badge-inactive {
            background: linear-gradient(135deg, #dc2626, #ef4444);
            color: white;
        }

        /* =============== PRODUCT CARDS =============== */
        .product-card {
            height: 100%;
            transition: all 0.3s ease;
        }

        .product-card .card-image {
            height: 200px;
            overflow: hidden;
            border-radius: 16px 16px 0 0;
        }

        .product-card .card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .product-card:hover .card-image img {
            transform: scale(1.08);
        }

        .product-card .card-image .card-title {
            background: linear-gradient(transparent, rgba(0, 0, 0, 0.8));
            padding: 60px 20px 16px;
            font-size: 1rem;
            font-weight: 600;
        }

        .product-price {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--primary-color);
        }

        /* =============== AUDIT BADGES =============== */
        .audit-action {
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 0.75rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .audit-create {
            background: #dcfce7;
            color: #166534;
        }

        .audit-update {
            background: #fef3c7;
            color: #92400e;
        }

        .audit-delete {
            background: #fee2e2;
            color: #991b1b;
        }

        /* =============== PAGE HEADER =============== */
        .page-header {
            margin-bottom: 28px;
        }

        .page-header h4 {
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--text-primary);
            margin: 0;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .page-header h4 i {
            color: var(--primary-color);
        }

        /* =============== ALERTS =============== */
        .alert {
            padding: 16px 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 500;
            font-size: 0.9rem;
        }

        .alert-success {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        .alert i {
            font-size: 22px;
        }

        /* =============== MODAL =============== */
        .modal {
            border-radius: 20px;
            max-width: 500px;
        }

        .modal .modal-content {
            padding: 32px;
        }

        .modal .modal-content h5 {
            font-weight: 700;
            font-size: 1.25rem;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .modal .modal-footer {
            padding: 16px 32px;
            border-top: 1px solid var(--border-color);
        }

        /* =============== FOOTER =============== */
        .page-footer {
            background: var(--dark-color);
            padding: 0;
        }

        .page-footer .footer-copyright {
            background: transparent;
            font-size: 0.85rem;
            padding: 20px 0;
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

    @auth
        <footer class="page-footer">
            <div class="footer-copyright">
                <div class="container">
                    <span style="opacity: 0.7;">&copy; {{ date('Y') }} Sistema de Gestión</span>
                    <span class="right" style="opacity: 0.5;">Laravel & Materialize CSS</span>
                </div>
            </div>
        </footer>
    @endauth

    <!-- Materialize JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            M.Sidenav.init(document.querySelectorAll('.sidenav'));
            M.Dropdown.init(document.querySelectorAll('.dropdown-trigger'), { coverTrigger: false, constrainWidth: false });
            M.Modal.init(document.querySelectorAll('.modal'));
            M.FormSelect.init(document.querySelectorAll('select'));
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