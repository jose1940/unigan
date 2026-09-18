<?php

use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;

use function Livewire\Volt\layout;
use function Livewire\Volt\rules;
use function Livewire\Volt\state;

layout('layouts.guest');

state(['email' => '']);

rules(['email' => ['required', 'string', 'email']]);

$sendPasswordResetLink = function () {
    $this->validate();

    $status = Password::sendResetLink(
        $this->only('email')
    );

    if ($status != Password::RESET_LINK_SENT) {
        $this->addError('email', __($status));
        return;
    }

    $this->reset('email');
    Session::flash('status', __($status));
};

?>

<div style="display:flex; min-height:100vh;">
    <style>
    .fp-left {
        width:40%;
        background:linear-gradient(160deg, #1a5c20 0%, #2e7d32 50%, #1b5e20 100%);
        display:flex; flex-direction:column; align-items:center; justify-content:center;
        padding:3rem 2rem; position:relative; overflow:hidden;
    }
    .fp-left::before {
        content:'🌾';
        font-size:200px;
        position:absolute; bottom:-40px; right:-20px;
        opacity:0.08; pointer-events:none;
    }
    .fp-right {
        flex:1; background:#111827;
        display:flex; align-items:center; justify-content:center; padding:2.5rem;
    }
    .fp-input {
        width:100%; box-sizing:border-box;
        background:#1f2937; border:1px solid #374151;
        border-radius:10px; padding:11px 16px;
        font-size:14px; color:#fff; outline:none;
    }
    .fp-input:focus { border-color:#4caf50; }
    .fp-btn {
        width:100%; background:#2e7d32; color:#fff;
        border:none; border-radius:10px; padding:13px;
        font-size:15px; font-weight:700; cursor:pointer;
    }
    .fp-btn:hover { background:#1b5e20; }
    @media(max-width:768px){
        .fp-left{ display:none; }
        .fp-right{ padding:1.5rem; }
    }
    </style>

    {{-- Panel izquierdo --}}
    <div class="fp-left">
        <div style="font-size:75px; line-height:1;">🐄</div>
        <h1 style="color:#fff; font-size:38px; font-weight:900; margin:0.75rem 0 0; letter-spacing:4px; text-shadow:0 2px 8px rgba(0,0,0,0.3);">
            UNIGAN
        </h1>
        <div style="background:#ffffff15; border-radius:10px; padding:10px 18px; text-align:center; margin:1rem 0;">
            <p style="color:#a5d6a7; font-size:13px; margin:0; font-style:italic; line-height:1.6;">
                "La fuerza del campo<br>está en la unión."
            </p>
        </div>
        <div style="width:100%; display:grid; grid-template-columns:1fr 1fr; gap:10px; margin-top:0.5rem;">
            <div style="background:#ffffff10; border:1px solid #ffffff20; border-radius:12px; padding:14px 10px; display:flex; flex-direction:column; align-items:center; gap:6px; text-align:center;">
                <span style="font-size:26px;">🔒</span>
                <span style="color:#e8f5e9; font-size:11px; font-weight:600;">Acceso seguro</span>
            </div>
            <div style="background:#ffffff10; border:1px solid #ffffff20; border-radius:12px; padding:14px 10px; display:flex; flex-direction:column; align-items:center; gap:6px; text-align:center;">
                <span style="font-size:26px;">📧</span>
                <span style="color:#e8f5e9; font-size:11px; font-weight:600;">Recupera tu cuenta</span>
            </div>
        </div>
    </div>

    {{-- Panel derecho --}}
    <div class="fp-right">
        <div style="width:100%; max-width:400px;">

            <div style="margin-bottom: 1.25rem;">
                <a href="{{ url('/') }}" style="display: inline-flex; align-items: center; gap: 6px; color: #9ca3af; text-decoration: none; font-size: 13px; font-weight: 600; transition: color 0.2s;" onmouseover="this.style.color='#ffffff';" onmouseout="this.style.color='#9ca3af';">
                    ← Volver al Inicio
                </a>
            </div>

            <div style="text-align:center; margin-bottom:1.75rem;">
                <div style="font-size:40px; margin-bottom:0.5rem;">🔑</div>
                <h2 style="font-size:24px; font-weight:800; color:#fff; margin:0 0 0.5rem;">¿Olvidaste tu contraseña?</h2>
                <p style="font-size:13px; color:#6b7280; margin:0; line-height:1.6;">
                    Ingresa tu correo y te enviaremos un enlace para restablecer tu contraseña.
                </p>
            </div>

            @if (session('status'))
                <div style="background:#d1fae5; color:#065f46; padding:12px 16px; border-radius:10px; margin-bottom:1.25rem; font-size:14px; font-weight:600; text-align:center;">
                    ✅ {{ session('status') }}
                </div>
            @endif

            <form wire:submit="sendPasswordResetLink">
                <div style="margin-bottom:1.25rem;">
                    <label style="font-size:12px; color:#9ca3af; display:block; margin-bottom:5px; font-weight:500;">📧 Correo electrónico</label>
                    <input wire:model="email" id="email" type="email" name="email" required autofocus
                           class="fp-input" placeholder="usuario@unigan.com">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <button type="submit" class="fp-btn">
                    Enviar enlace de recuperación →
                </button>

                <p style="text-align:center; font-size:13px; color:#4b5563; margin-top:1.25rem;">
                    ¿Recuerdas tu contraseña?
                    <a href="{{ route('login') }}" wire:navigate
                       style="color:#4caf50; font-weight:600; text-decoration:none;">
                        Inicia sesión aquí
                    </a>
                </p>
            </form>
        </div>
    </div>
</div>