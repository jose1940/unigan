<?php

use App\Livewire\Forms\LoginForm;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;

use function Livewire\Volt\form;
use function Livewire\Volt\layout;

layout('layouts.guest');

form(LoginForm::class);

$login = function () {
    $this->validate();
    $this->form->authenticate();
    Session::regenerate();
    $this->redirect('/dashboard');
};

?>

<div class="login-wrap">
    <style>
    .login-wrap { display:flex; min-height:100vh; }
    .login-left {
        width:42%;
        background:linear-gradient(160deg, #1a5c20 0%, #2e7d32 50%, #1b5e20 100%);
        display:flex; flex-direction:column; align-items:center; justify-content:center;
        padding:3rem 2rem; position:relative; overflow:hidden;
    }
    .login-left::before {
        content:'🌾'; font-size:200px;
        position:absolute; bottom:-40px; right:-20px;
        opacity:0.08; pointer-events:none;
    }
    .login-right {
        flex:1; background:#111827;
        display:flex; align-items:center; justify-content:center; padding:3rem;
    }
    .login-input {
        width:100%; box-sizing:border-box;
        background:#1f2937; border:1px solid #374151;
        border-radius:10px; padding:12px 16px;
        font-size:14px; color:#fff; outline:none;
    }
    .login-input::placeholder { color:#6b7280; }
    .login-input:focus { border-color:#4caf50; }
    .login-btn {
        width:100%; background:#2e7d32; color:#fff;
        border:none; border-radius:10px; padding:14px;
        font-size:15px; font-weight:700; cursor:pointer;
        transition:background 0.2s;
    }
    .login-btn:hover { background:#1b5e20; }
    @media(max-width:768px){
        .login-left{ display:none; }
        .login-right{ padding:1.5rem; }
    }
    </style>

    {{-- Panel izquierdo verde --}}
    <div class="login-left">
        <div style="font-size:80px; line-height:1; filter:drop-shadow(0 4px 12px rgba(0,0,0,0.4));">🐄</div>

        <h1 style="color:#fff; font-size:42px; font-weight:900; margin:0.5rem 0 0; letter-spacing:5px; text-shadow:0 2px 8px rgba(0,0,0,0.3);">
            UNIGAN
        </h1>

        <div style="background:#ffffff15; border-radius:10px; padding:10px 20px; text-align:center; margin:1rem 0;">
            <p style="color:#a5d6a7; font-size:13px; margin:0; font-style:italic; line-height:1.6;">
                "La fuerza del campo está en la unión."
            </p>
        </div>

        <div style="width:100%; display:grid; grid-template-columns:1fr 1fr; gap:10px; margin-top:0.5rem;">
            <div style="background:#ffffff10; border:1px solid #ffffff20; border-radius:12px; padding:16px 10px; display:flex; flex-direction:column; align-items:center; gap:6px; text-align:center;">
                <span style="font-size:28px;">🐄</span>
                <span style="color:#e8f5e9; font-size:11px; font-weight:600; line-height:1.3;">Control de inventario</span>
            </div>
            <div style="background:#ffffff10; border:1px solid #ffffff20; border-radius:12px; padding:16px 10px; display:flex; flex-direction:column; align-items:center; gap:6px; text-align:center;">
                <span style="font-size:28px;">🩺</span>
                <span style="color:#e8f5e9; font-size:11px; font-weight:600; line-height:1.3;">Registro y salud animal</span>
            </div>
            <div style="background:#ffffff10; border:1px solid #ffffff20; border-radius:12px; padding:16px 10px; display:flex; flex-direction:column; align-items:center; gap:6px; text-align:center;">
                <span style="font-size:28px;">👥</span>
                <span style="color:#e8f5e9; font-size:11px; font-weight:600; line-height:1.3;">Gestión de roles</span>
            </div>
            <div style="background:#ffffff10; border:1px solid #ffffff20; border-radius:12px; padding:16px 10px; display:flex; flex-direction:column; align-items:center; gap:6px; text-align:center;">
                <span style="font-size:28px;">📊</span>
                <span style="color:#e8f5e9; font-size:11px; font-weight:600; line-height:1.3;">Reportes y estadísticas</span>
            </div>
            <div style="background:#4caf5022; border:1px solid #4caf5055; border-radius:12px; padding:16px 10px; display:flex; flex-direction:column; align-items:center; gap:6px; text-align:center; grid-column:span 2;">
                <span style="font-size:28px;">🌾</span>
                <span style="color:#a5d6a7; font-size:11px; font-weight:600; line-height:1.3;">Administración completa de la finca</span>
            </div>
        </div>
    </div>

    {{-- Panel derecho oscuro --}}
    <div class="login-right">
        <div style="width:100%; max-width:400px;">

            <div style="text-align:center; margin-bottom:1.75rem;">
                <div style="font-size:36px; margin-bottom:0.5rem;">🌿</div>
                <h2 style="font-size:26px; font-weight:800; color:#fff; margin:0 0 0.25rem;">Iniciar Sesión</h2>
                <p style="font-size:13px; color:#6b7280; margin:0;">Ingresa tus credenciales para continuar</p>
            </div>

            <x-auth-session-status class="mb-4" :status="session('status')" />

          <form method="POST" wire:submit.prevent="login">
    @csrf

                <div style="margin-bottom:1rem;">
                    <label style="font-size:12px; color:#9ca3af; display:block; margin-bottom:5px; font-weight:500;">
                        📧 Correo electrónico
                    </label>
                    <x-text-input wire:model="form.email" id="email"
                        class="login-input"
                        type="email" name="email" required autofocus
                        autocomplete="username" placeholder="usuario@unigan.com" />
                    <x-input-error :messages="$errors->get('form.email')" class="mt-1" />
                </div>

                <div style="margin-bottom:1rem;">
                    <label style="font-size:12px; color:#9ca3af; display:block; margin-bottom:5px; font-weight:500;">
                        🔒 Contraseña
                    </label>
                    <x-text-input wire:model="form.password" id="password"
                        class="login-input"
                        type="password" name="password" required
                        autocomplete="current-password" placeholder="••••••••" />
                    <x-input-error :messages="$errors->get('form.password')" class="mt-1" />
                </div>

                <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:1.75rem;">
                    <label style="display:flex; align-items:center; gap:8px; font-size:13px; color:#6b7280; cursor:pointer;">
                        <input wire:model="form.remember" type="checkbox"
                               style="width:15px; height:15px; accent-color:#4caf50;" />
                        Recordarme
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" wire:navigate
                           style="font-size:12px; color:#4caf50; text-decoration:none;">
                            ¿Olvidaste tu contraseña?
                        </a>
                    @endif
                </div>

                <button type="submit" class="login-btn">
                    Ingresar al sistema →
                </button>

                <p style="text-align:center; font-size:13px; color:#4b5563; margin-top:1.5rem;">
                    ¿No tienes cuenta?
                    <a href="{{ route('register') }}" wire:navigate
                       style="color:#4caf50; font-weight:600; text-decoration:none;">
                        Regístrate aquí
                    </a>
                </p>

            </form>
        </div>
    </div>

</div>