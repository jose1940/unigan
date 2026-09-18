<?php

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Volt\Component;
use Spatie\Permission\Models\Role;

new class extends Component {

    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public string $rol = '';

    public function register(): void
    {
        $validated = $this->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
            'rol'      => ['required', 'exists:roles,name'],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);
        $user->assignRole($this->rol);

        event(new Registered($user));
        Auth::login($user);

        $this->redirect(RouteServiceProvider::HOME);
    }

}; ?>

<div class="reg-wrap">
    <style>
    .reg-wrap { display:flex; min-height:100vh; }
    .reg-left {
        width:40%;
        background:linear-gradient(160deg, #1a5c20 0%, #2e7d32 50%, #1b5e20 100%);
        display:flex; flex-direction:column; align-items:center; justify-content:center;
        padding:3rem 2rem; position:relative; overflow:hidden;
    }
    .reg-left::before {
        content:'🌾';
        font-size:200px;
        position:absolute; bottom:-40px; right:-20px;
        opacity:0.08; pointer-events:none;
    }
    .reg-right {
        flex:1; background:#111827;
        display:flex; align-items:center; justify-content:center; padding:2.5rem;
    }
    .reg-input {
        width:100%; box-sizing:border-box;
        background:#1f2937; border:1px solid #374151;
        border-radius:10px; padding:11px 16px;
        font-size:14px; color:#fff; outline:none;
    }
    .reg-input:focus { border-color:#4caf50; }
    .reg-btn {
        width:100%; background:#2e7d32; color:#fff;
        border:none; border-radius:10px; padding:13px;
        font-size:15px; font-weight:700; cursor:pointer;
        transition:background 0.2s;
    }
    .reg-btn:hover { background:#1b5e20; }
    .reg-select {
        width:100%; box-sizing:border-box;
        background:#1f2937; border:1px solid #374151;
        border-radius:10px; padding:11px 16px;
        font-size:14px; color:#fff; outline:none;
    }
    .reg-select:focus { border-color:#4caf50; }
    @media(max-width:768px){
        .reg-left{ display:none; }
        .reg-right{ padding:1.5rem; }
    }
    </style>

    {{-- Panel izquierdo --}}
    <div class="reg-left">
        <div style="font-size:75px; line-height:1; filter:drop-shadow(0 4px 8px rgba(0,0,0,0.3));">🐄</div>

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
                <span style="font-size:26px;">🐄</span>
                <span style="color:#e8f5e9; font-size:11px; font-weight:600; line-height:1.3;">Control de inventario</span>
            </div>
            <div style="background:#ffffff10; border:1px solid #ffffff20; border-radius:12px; padding:14px 10px; display:flex; flex-direction:column; align-items:center; gap:6px; text-align:center;">
                <span style="font-size:26px;">🩺</span>
                <span style="color:#e8f5e9; font-size:11px; font-weight:600; line-height:1.3;">Registro y salud animal</span>
            </div>
            
            <div style="background:#ffffff10; border:1px solid #ffffff20; border-radius:12px; padding:14px 10px; display:flex; flex-direction:column; align-items:center; gap:6px; text-align:center;">
                <span style="font-size:26px;">📊</span>
                <span style="color:#e8f5e9; font-size:11px; font-weight:600; line-height:1.3;">Reportes y estadísticas</span>
            </div>
            <div style="background:#4caf5022; border:1px solid #4caf5055; border-radius:12px; padding:14px 10px; display:flex; flex-direction:column; align-items:center; gap:6px; text-align:center;">
                <span style="font-size:26px;">🌾</span>
                <span style="color:#a5d6a7; font-size:11px; font-weight:600; line-height:1.3;">Administración completa de la finca</span>
            </div>
        </div>
    </div>

    {{-- Panel derecho --}}
    <div class="reg-right">
        <div style="width:100%; max-width:400px;">

            <div style="margin-bottom: 1.25rem;">
                <a href="{{ url('/') }}" style="display: inline-flex; align-items: center; gap: 6px; color: #9ca3af; text-decoration: none; font-size: 13px; font-weight: 600; transition: color 0.2s;" onmouseover="this.style.color='#ffffff';" onmouseout="this.style.color='#9ca3af';">
                    ← Volver al Inicio
                </a>
            </div>

            <div style="text-align:center; margin-bottom:1.75rem;">
                <div style="font-size:36px; margin-bottom:0.5rem;">🌿</div>
                <h2 style="font-size:24px; font-weight:800; color:#fff; margin:0 0 0.25rem;">Crear cuenta</h2>
                <p style="font-size:13px; color:#6b7280; margin:0;">Únete al sistema de gestión ganadera</p>
            </div>

          <form wire:submit.prevent="register">
                {{-- Nombre --}}
                <div style="margin-bottom:1rem;">
                    <label style="font-size:12px; color:#9ca3af; display:block; margin-bottom:5px; font-weight:500;">👤 Nombre completo</label>
                    <x-text-input wire:model="name" id="name" class="reg-input"
                        type="text" name="name" required autofocus
                        autocomplete="name" placeholder="José Pérez" />
                    <x-input-error :messages="$errors->get('name')" class="mt-1" />
                </div>

                {{-- Email --}}
                <div style="margin-bottom:1rem;">
                    <label style="font-size:12px; color:#9ca3af; display:block; margin-bottom:5px; font-weight:500;">📧 Correo electrónico</label>
                    <x-text-input wire:model="email" id="email" class="reg-input"
                        type="email" name="email" required
                        autocomplete="username" placeholder="usuario@unigan.com" />
                    <x-input-error :messages="$errors->get('email')" class="mt-1" />
                </div>

                {{-- Password --}}
                <div style="margin-bottom:1rem;">
                    <label style="font-size:12px; color:#9ca3af; display:block; margin-bottom:5px; font-weight:500;">🔒 Contraseña</label>
                    <x-text-input wire:model="password" id="password" class="reg-input"
                        type="password" name="password" required
                        autocomplete="new-password" placeholder="••••••••" />
                    <x-input-error :messages="$errors->get('password')" class="mt-1" />
                </div>

                {{-- Confirmar Password --}}
                <div style="margin-bottom:1rem;">
                    <label style="font-size:12px; color:#9ca3af; display:block; margin-bottom:5px; font-weight:500;">🔒 Confirmar contraseña</label>
                    <x-text-input wire:model="password_confirmation" id="password_confirmation" class="reg-input"
                        type="password" name="password_confirmation" required
                        autocomplete="new-password" placeholder="••••••••" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
                </div>

                {{-- Rol --}}
                <div style="margin-bottom:1.5rem;">
                    <label style="font-size:12px; color:#9ca3af; display:block; margin-bottom:5px; font-weight:500;">🎭 Rol en la finca</label>
                    <select wire:model="rol" id="rol" class="reg-select">
                        <option value="">-- Selecciona un rol --</option>
                       @foreach(\Spatie\Permission\Models\Role::whereNotIn('name', ['super admin', 'administrador'])->get() as $role)
                            <option value="{{ $role->name }}">{{ ucfirst($role->name) }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('rol')" class="mt-1" />
                </div>

                <button type="submit" class="reg-btn">
                    Crear cuenta →
                </button>

                <p style="text-align:center; font-size:13px; color:#4b5563; margin-top:1.25rem;">
                    ¿Ya tienes cuenta?
                    <a href="{{ route('login') }}" wire:navigate
                       style="color:#4caf50; font-weight:600; text-decoration:none;">
                        Inicia sesión aquí
                    </a>
                </p>

            </form>
        </div>
    </div>

</div>