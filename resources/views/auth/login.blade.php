<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Sistema de Gestión</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Materialize CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" rel="stylesheet">

    <style>
        * {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 50%, #1e1b4b 100%);
            position: relative;
            overflow: hidden;
        }

        /* Animated background */
        .bg-shapes {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 0;
        }

        .bg-shapes::before {
            content: '';
            position: absolute;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(37, 99, 235, 0.15) 0%, transparent 70%);
            top: -20%;
            left: -10%;
            animation: float 20s infinite ease-in-out;
        }

        .bg-shapes::after {
            content: '';
            position: absolute;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(124, 58, 237, 0.15) 0%, transparent 70%);
            bottom: -20%;
            right: -10%;
            animation: float 25s infinite ease-in-out reverse;
        }

        @keyframes float {

            0%,
            100% {
                transform: translate(0, 0) scale(1);
            }

            50% {
                transform: translate(30px, -30px) scale(1.1);
            }
        }

        .login-container {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 440px;
            padding: 20px;
        }

        .login-card {
            background: white;
            border-radius: 24px;
            padding: 48px 40px;
            box-shadow: 0 25px 80px rgba(0, 0, 0, 0.4);
            animation: slideUp 0.6s ease forwards;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-header {
            text-align: center;
            margin-bottom: 36px;
        }

        .login-header .icon-wrapper {
            width: 88px;
            height: 88px;
            border-radius: 24px;
            background: linear-gradient(135deg, #2563eb, #7c3aed);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px;
            box-shadow: 0 12px 32px rgba(37, 99, 235, 0.35);
        }

        .login-header .icon-wrapper i {
            font-size: 40px;
            color: white;
        }

        .login-header h4 {
            color: #1e293b;
            font-weight: 700;
            font-size: 1.75rem;
            margin: 0 0 8px;
        }

        .login-header p {
            color: #64748b;
            margin: 0;
            font-size: 0.95rem;
        }

        .input-group {
            margin-bottom: 24px;
        }

        .input-group label {
            display: block;
            font-size: 0.85rem;
            font-weight: 600;
            color: #475569;
            margin-bottom: 8px;
        }

        .input-group .input-wrapper {
            position: relative;
        }

        .input-group .input-wrapper i {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 20px;
            transition: color 0.2s ease;
        }

        .input-group input {
            width: 100%;
            padding: 16px 16px 16px 52px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 1rem;
            color: #1e293b;
            transition: all 0.2s ease;
            outline: none;
        }

        .input-group input:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
        }

        .input-group input:focus+i,
        .input-group .input-wrapper:focus-within i {
            color: #2563eb;
        }

        .input-group input::placeholder {
            color: #94a3b8;
        }

        .remember-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 28px;
        }

        .remember-row label {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            color: #64748b;
            font-size: 0.9rem;
        }

        .remember-row input[type="checkbox"] {
            width: 18px;
            height: 18px;
            accent-color: #2563eb;
        }

        .btn-login {
            width: 100%;
            padding: 16px;
            border: none;
            border-radius: 12px;
            background: linear-gradient(135deg, #2563eb, #3b82f6);
            color: white;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: all 0.3s ease;
            box-shadow: 0 8px 24px rgba(37, 99, 235, 0.35);
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 32px rgba(37, 99, 235, 0.45);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .btn-login i {
            font-size: 20px;
        }

        .error-alert {
            background: #fef2f2;
            border: 1px solid #fecaca;
            border-radius: 12px;
            padding: 14px 16px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 12px;
            animation: shake 0.5s ease;
        }

        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            20%,
            60% {
                transform: translateX(-5px);
            }

            40%,
            80% {
                transform: translateX(5px);
            }
        }

        .error-alert i {
            color: #dc2626;
            font-size: 22px;
        }

        .error-alert span {
            color: #991b1b;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .footer-text {
            text-align: center;
            margin-top: 32px;
            color: rgba(255, 255, 255, 0.5);
            font-size: 0.85rem;
        }

        @media (max-width: 480px) {
            .login-card {
                padding: 36px 24px;
            }
        }
    </style>
</head>

<body>
    <div class="bg-shapes"></div>

    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <div class="icon-wrapper">
                    <i class="material-icons">lock</i>
                </div>
                <h4>¡Bienvenido!</h4>
                <p>Ingresa tus credenciales para continuar</p>
            </div>

            @if($errors->any())
                <div class="error-alert">
                    <i class="material-icons">error_outline</i>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="input-group">
                    <label for="email">Correo Electrónico</label>
                    <div class="input-wrapper">
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                            placeholder="tu@correo.com" required autofocus>
                        <i class="material-icons">email</i>
                    </div>
                </div>

                <div class="input-group">
                    <label for="password">Contraseña</label>
                    <div class="input-wrapper">
                        <input type="password" id="password" name="password" placeholder="••••••••" required>
                        <i class="material-icons">lock_outline</i>
                    </div>
                </div>

                <div class="remember-row">
                    <label>
                        <input type="checkbox" name="remember">
                        Recordar sesión
                    </label>
                </div>

                <button type="submit" class="btn-login">
                    <i class="material-icons">login</i>
                    Iniciar Sesión
                </button>
            </form>
        </div>

        <p class="footer-text">
            Sistema de Gestión &copy; {{ date('Y') }}
        </p>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>

</html>