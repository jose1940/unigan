<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>UNIGAN - Sistema de Gestión Ganadera</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Figtree', sans-serif;
        }

        :root {
            --primary: #2e7d32;
            --primary-dark: #1b5e20;
            --primary-light: #4caf50;
            --accent: #eab308;
            --bg-light: #f8fafc;
            --text-dark: #0f172a;
            --text-muted: #64748b;
        }

        body {
            background-color: var(--bg-light);
            color: var(--text-dark);
            line-height: 1.6;
            overflow-x: hidden;
        }

        /* Navbar */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(12px);
            z-index: 1000;
            border-bottom: 1px solid rgba(226, 232, 240, 0.8);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
            transition: all 0.3s ease;
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0.9rem 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .brand-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            color: var(--primary-dark);
            font-size: 1.4rem;
            font-weight: 900;
            letter-spacing: 0.5px;
        }

        .brand-icon {
            background: linear-gradient(135deg, #2e7d32, #1b5e20);
            color: #ffffff;
            width: 38px;
            height: 38px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            box-shadow: 0 4px 10px rgba(46, 125, 50, 0.25);
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .nav-link {
            text-decoration: none;
            color: var(--text-dark);
            font-weight: 600;
            font-size: 0.95rem;
            transition: color 0.2s;
        }

        .nav-link:hover {
            color: var(--primary);
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 0.6rem 1.3rem;
            border-radius: 12px;
            font-weight: 700;
            font-size: 0.92rem;
            text-decoration: none;
            transition: all 0.25s ease;
            cursor: pointer;
            border: none;
        }

        .btn-outline {
            background: transparent;
            color: var(--primary);
            border: 1.5px solid var(--primary);
        }

        .btn-outline:hover {
            background: #e8f5e9;
            transform: translateY(-2px);
        }

        .btn-primary {
            background: linear-gradient(135deg, #2e7d32 0%, #1b5e20 100%);
            color: #ffffff;
            box-shadow: 0 4px 14px rgba(46, 125, 50, 0.35);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #388e3c 0%, #2e7d32 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(46, 125, 50, 0.45);
        }

        .btn-gold {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: #ffffff;
            box-shadow: 0 4px 14px rgba(217, 119, 6, 0.3);
        }

        .btn-gold:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(217, 119, 6, 0.4);
        }

        /* Hero Section */
        .hero {
            padding: 7.5rem 1.5rem 4.5rem;
            position: relative;
            background: linear-gradient(180deg, #e8f5e9 0%, #f8fafc 100%);
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: -10%;
            right: -5%;
            width: 550px;
            height: 550px;
            background: radial-gradient(circle, rgba(76, 175, 80, 0.15) 0%, transparent 70%);
            border-radius: 50%;
            z-index: 0;
        }

        .hero-container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1.1fr 0.9fr;
            align-items: center;
            gap: 3rem;
            position: relative;
            z-index: 1;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background-color: #dcfce7;
            color: #15803d;
            font-weight: 700;
            font-size: 0.85rem;
            padding: 6px 14px;
            border-radius: 30px;
            margin-bottom: 1.25rem;
            border: 1px solid #bbf7d0;
        }

        .hero-title {
            font-size: 3rem;
            font-weight: 900;
            line-height: 1.15;
            color: #0f172a;
            margin-bottom: 1.2rem;
            letter-spacing: -0.5px;
        }

        .hero-title span {
            color: var(--primary);
            position: relative;
        }

        .hero-description {
            font-size: 1.15rem;
            color: var(--text-muted);
            margin-bottom: 2rem;
            max-width: 540px;
        }

        .hero-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .hero-image-wrapper {
            position: relative;
            display: flex;
            justify-content: center;
        }

        .hero-card {
            background: #ffffff;
            border-radius: 24px;
            padding: 12px;
            box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.12);
            border: 1px solid #e2e8f0;
            width: 100%;
            max-width: 480px;
            transition: transform 0.3s ease;
        }

        .hero-card:hover {
            transform: translateY(-6px);
        }

        .hero-img {
            width: 100%;
            height: auto;
            border-radius: 18px;
            display: block;
            object-fit: cover;
        }

        .floating-stat {
            position: absolute;
            bottom: -20px;
            left: -10px;
            background: #ffffff;
            border-radius: 16px;
            padding: 12px 18px;
            display: flex;
            align-items: center;
            gap: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            border: 1px solid #e2e8f0;
        }

        .floating-stat-icon {
            background: #e0f2fe;
            color: #0284c7;
            font-size: 1.5rem;
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Features Section */
        .features {
            padding: 5rem 1.5rem;
            background-color: #ffffff;
        }

        .section-header {
            text-align: center;
            max-width: 700px;
            margin: 0 auto 3.5rem;
        }

        .section-subtitle {
            font-size: 0.85rem;
            font-weight: 800;
            color: var(--primary);
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-bottom: 0.5rem;
        }

        .section-title {
            font-size: 2.2rem;
            font-weight: 900;
            color: #0f172a;
            margin-bottom: 0.75rem;
        }

        .section-desc {
            font-size: 1.05rem;
            color: var(--text-muted);
        }

        .features-grid {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 1.75rem;
        }

        .feature-card {
            background: #f8fafc;
            border-radius: 20px;
            padding: 2rem 1.75rem;
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
            position: relative;
        }

        .feature-card:hover {
            transform: translateY(-6px);
            background: #ffffff;
            border-color: #bbf7d0;
            box-shadow: 0 15px 30px -5px rgba(46, 125, 50, 0.1);
        }

        .feature-icon-wrapper {
            width: 56px;
            height: 56px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.75rem;
            margin-bottom: 1.25rem;
        }

        .feature-title {
            font-size: 1.25rem;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 0.5rem;
        }

        .feature-text {
            font-size: 0.95rem;
            color: var(--text-muted);
            line-height: 1.5;
        }

        /* Banner Quote */
        .quote-banner {
            padding: 4.5rem 1.5rem;
            background: linear-gradient(135deg, #1b5e20 0%, #2e7d32 60%, #388e3c 100%);
            color: #ffffff;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .quote-banner::before {
            content: '🐄';
            position: absolute;
            font-size: 18rem;
            opacity: 0.05;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            pointer-events: none;
        }

        .quote-container {
            max-width: 800px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }

        .quote-text {
            font-size: 2.2rem;
            font-weight: 900;
            letter-spacing: -0.5px;
            margin-bottom: 1rem;
            font-style: italic;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }

        .quote-author {
            font-size: 1.1rem;
            color: #bbf7d0;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        /* Footer */
        .footer {
            background-color: #0f172a;
            color: #94a3b8;
            padding: 3rem 1.5rem 1.5rem;
        }

        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1.5rem;
            border-bottom: 1px solid #1e293b;
            padding-bottom: 2rem;
        }

        .footer-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #ffffff;
            font-size: 1.3rem;
            font-weight: 800;
            text-decoration: none;
        }

        .footer-links {
            display: flex;
            gap: 1.5rem;
        }

        .footer-link {
            color: #94a3b8;
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.2s;
        }

        .footer-link:hover {
            color: #ffffff;
        }

        .footer-bottom {
            max-width: 1200px;
            margin: 1.5rem auto 0;
            text-align: center;
            font-size: 0.85rem;
            color: #64748b;
        }

        /* Responsive */
        @media (max-width: 900px) {
            .hero-container {
                grid-template-columns: 1fr;
                text-align: center;
                gap: 2.5rem;
            }

            .hero-title {
                font-size: 2.4rem;
            }

            .hero-description {
                margin: 0 auto 2rem;
            }

            .hero-actions {
                justify-content: center;
            }

            .floating-stat {
                left: 50%;
                transform: translateX(-50%);
                bottom: -15px;
            }

            .nav-links {
                gap: 0.75rem;
            }

            .quote-text {
                font-size: 1.75rem;
            }
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <header class="navbar">
        <div class="nav-container">
            <a href="{{ url('/') }}" class="brand-logo">
                <div class="brand-icon">🐄</div>
                <span>UNIGAN</span>
            </a>

            <nav class="nav-links">
                <a href="#soluciones" class="nav-link">Soluciones</a>
                <a href="{{ url('/contacto') }}" class="nav-link">Contacto</a>

                @if (Route::has('login'))
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn btn-primary">
                            📊 Panel de Control
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline">
                            Iniciar Sesión
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-primary">
                                Registrarse
                            </a>
                        @endif
                    @endauth
                @endif
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <main>
        <section class="hero">
            <div class="hero-container">
                <div class="hero-content">
                    <div class="hero-badge">
                        🌾 Plataforma de Gestión Ganadera Inteligente
                    </div>
                    <h1 class="hero-title">
                        Control total de tu hato y recursos con <span>UNIGAN</span>
                    </h1>
                    <p class="hero-description">
                        Gestiona el ganado, monitorea tratamientos médicos, controla el inventario de insumos y agiliza la toma de decisiones con una solución pensada para el campo.
                    </p>
                    <div class="hero-actions">
                        @auth
                            <a href="{{ route('dashboard') }}" class="btn btn-primary" style="padding: 0.8rem 1.8rem; font-size: 1.05rem;">
                                🚀 Ir al Panel de Control
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary" style="padding: 0.8rem 1.8rem; font-size: 1.05rem;">
                                🔐 Acceder al Sistema
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn btn-gold" style="padding: 0.8rem 1.8rem; font-size: 1.05rem;">
                                    ✨ Crear Cuenta
                                </a>
                            @endif
                        @endauth
                    </div>
                </div>

                <div class="hero-image-wrapper">
                    <div class="hero-card">
                        <img src="{{ asset('images/WhatsApp Image 2026-05-08 at 2.42.29 PM.jpeg') }}" 
                             alt="UNIGAN - Gestión Ganadera" 
                             class="hero-img"
                             onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1500595046743-cd271d694d30?w=800&q=80';">
                    </div>
                    <div class="floating-stat">
                        <div class="floating-stat-icon">🌱</div>
                        <div>
                            <div style="font-size: 0.75rem; font-weight: 700; color: #64748b; text-transform: uppercase;">Productividad</div>
                            <div style="font-size: 1.1rem; font-weight: 800; color: #0f172a;">100% Campo Conectado</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section id="soluciones" class="features">
            <div class="section-header">
                <div class="section-subtitle">Módulos del Sistema</div>
                <h2 class="section-title">Soluciones diseñadas para potenciar tu ganadería</h2>
                <p class="section-desc">
                    Todo lo que necesitas para administrar tu finca de manera ordenada, segura y eficiente.
                </p>
            </div>

            <div class="features-grid">
                <!-- Card 1 -->
                <div class="feature-card">
                    <div class="feature-icon-wrapper" style="background: #e0f2fe; color: #0284c7;">
                        🐄
                    </div>
                    <h3 class="feature-title">Gestión de Animales</h3>
                    <p class="feature-text">
                        Registro de aretes, peso, compras, fechas de nacimiento y control genealógico para una trazabilidad completa de cada ejemplar.
                    </p>
                </div>

                <!-- Card 2 -->
                <div class="feature-card">
                    <div class="feature-icon-wrapper" style="background: #fef3c7; color: #d97706;">
                        📦
                    </div>
                    <h3 class="feature-title">Reportes de Insumos</h3>
                    <p class="feature-text">
                        Control de alimentos, medicamentos y materiales con semáforo inteligente de fechas de vencimiento y alertas de stock.
                    </p>
                </div>

                <!-- Card 3 -->
                <div class="feature-card">
                    <div class="feature-icon-wrapper" style="background: #dcfce7; color: #15803d;">
                        🩺
                    </div>
                    <h3 class="feature-title">Registros Médicos</h3>
                    <p class="feature-text">
                        Historial clínico de atenciones, diagnósticos, fechas de tratamiento y programación de próximas dosis sanitarias.
                    </p>
                </div>

                <!-- Card 4 -->
                <div class="feature-card">
                    <div class="feature-icon-wrapper" style="background: #f3e8ff; color: #7e22ce;">
                        🛡️
                    </div>
                    <h3 class="feature-title">Roles y Permisos</h3>
                    <p class="feature-text">
                        Seguridad granular adaptada a tu equipo: Super Administrador, Administrador, Veterinario y Trabajador de campo.
                    </p>
                </div>
            </div>
        </section>

        <!-- Quote / Banner Section -->
        <section class="quote-banner">
            <div class="quote-container">
                <p class="quote-text">
                    “La fuerza del campo está en la unión.”
                </p>
                <div class="quote-author">
                    UNIGAN • Innovación y Tradición Ganadera
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-container">
            <a href="{{ url('/') }}" class="footer-brand">
                <span>🐄</span> UNIGAN
            </a>

            <div class="footer-links">
                <a href="{{ url('/') }}" class="footer-link">Inicio</a>
                <a href="#soluciones" class="footer-link">Soluciones</a>
                <a href="{{ url('/contacto') }}" class="footer-link">Contacto</a>
                <a href="{{ route('login') }}" class="footer-link">Iniciar Sesión</a>
            </div>
        </div>

        <div class="footer-bottom">
            &copy; {{ date('Y') }} UNIGAN. Todos los derechos reservados. Impulsando la ganadería del futuro.
        </div>
    </footer>

</body>
</html>