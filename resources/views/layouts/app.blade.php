<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'UNIGAN') }}</title>

     
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

        
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased" style="background-color: #f1f5f9; color: #1e293b;">
        <div class="min-h-screen">

        
            <nav style="background: linear-gradient(135deg, #1e7d32 0%, #145a23 100%); padding: 0.9rem 2rem; box-shadow: 0 4px 12px rgba(0,0,0,0.08); border-bottom: 1px solid rgba(255,255,255,0.1);">
                <div style="max-width: 1100px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center;">
                    
                 
                    <a href="{{ route('dashboard') }}" style="display: flex; align-items: center; gap: 10px; text-decoration: none; color: #ffffff; font-weight: 800; font-size: 1.25rem; letter-spacing: 0.5px;">
                        <span style="background: rgba(255,255,255,0.2); padding: 4px 8px; border-radius: 8px; font-size: 1.1rem;">🐄</span> 
                        <span>UNIGAN</span>
                    </a>

                    <div style="display: flex; align-items: center; gap: 1.25rem;">
                        @guest
                            <a href="{{ route('login') }}" style="color: #ffffff; text-decoration: none; font-size: 14px; font-weight: 600;">Iniciar Sesión</a>
                            <span style="color: rgba(255,255,255,0.3); font-size: 12px;">|</span>
                            <a href="{{ route('register') }}" style="color: #ffffff; text-decoration: none; font-size: 14px; font-weight: 600;">Registrarse</a>
                        @endguest

                        @auth
                            <a href="{{ route('dashboard') }}" 
                               style="color: #ffffff; text-decoration: none; font-size: 14px; font-weight: 600; background: rgba(255,255,255,0.15); padding: 6px 14px; border-radius: 20px; transition: all 0.2s;">
                                Panel
                            </a>
                            
                            <span style="color: rgba(255,255,255,0.2); font-size: 12px;">|</span>

                            <form method="POST" action="{{ route('logout') }}" style="margin: 0; display: inline;">
                                @csrf
                                <button type="submit" 
                                        style="color: #e2e8f0; background: none; border: none; cursor: pointer; padding: 0; font-size: 14px; font-weight: 500; opacity: 0.9; transition: opacity 0.2s;"
                                        onmouseover="this.style.opacity='1'; this.style.color='#ffffff';" 
                                        onmouseout="this.style.opacity='0.9'; this.style.color='#e2e8f0';">
                                    Cerrar sesión
                                </button>
                            </form>
                        @endauth
                    </div>

                </div>
            </nav>

           
            @if (isset($header))
                <header style="background-color: #ffffff; border-bottom: 1px solid #e2e8f0; box-shadow: 0 1px 2px rgba(0,0,0,0.02);">
                    <div style="max-width: 1100px; margin: 0 auto; padding: 1.25rem 1rem;">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <main>
                {{ $slot }}
            </main>

        </div>
    </body>
</html>