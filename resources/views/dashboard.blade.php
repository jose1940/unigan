<x-app-layout>
    <x-slot name="header">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <h2 style="font-size: 1.25rem; font-weight: 800; color: #0f172a; margin: 0;">
                    Panel de Control
                </h2>
                <p style="font-size: 13px; color: #64748b; margin: 2px 0 0 0;">
                    Bienvenido, <strong style="color: #1e293b;">{{ auth()->user()->name }}</strong>
                </p>
            </div>
            <span style="background-color: #e2e8f0; color: #334155; font-size: 11px; font-weight: 700; padding: 4px 12px; border-radius: 20px; text-transform: uppercase;">
                Rol: {{ ucfirst(auth()->user()->getRoleNames()->first() ?? 'Administrador') }}
            </span>
        </div>
    </x-slot>

    <div style="
        min-height: calc(100vh - 120px);
        background-image: url('https://images.unsplash.com/photo-1500595046743-cd271d694d30?w=1600&q=80');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 3rem 1rem;
    ">
        <div style="position: absolute; inset: 0; background: rgba(0,0,0,0.55);"></div>

        <div style="position: relative; z-index: 1; width: 100%; max-width: 900px;">

            <div style="text-align: center; margin-bottom: 2.5rem;">
                <div style="font-size: 56px; margin-bottom: 0.5rem;">🐄</div>
                <h1 style="font-size: 2.5rem; font-weight: 900; color: #ffffff; margin: 0; letter-spacing: 4px; text-shadow: 0 2px 10px rgba(0,0,0,0.5);">
                    UNIGAN
                </h1>
                <p style="font-size: 14px; color: #a5d6a7; margin: 8px 0 0; font-style: italic;">
                    "La fuerza del campo está en la unión."
                </p>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1.25rem;">

                @can('ver animales')
                <a href="{{ route('animales.index') }}"
                   style="text-decoration: none; background: rgba(255,255,255,0.12); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.25); border-radius: 20px; padding: 2rem 1.5rem; display: flex; flex-direction: column; align-items: center; gap: 14px; text-align: center;"
                   onmouseover="this.style.background='rgba(46,125,50,0.5)'; this.style.borderColor='#4caf50'; this.style.transform='translateY(-4px)';"
                   onmouseout="this.style.background='rgba(255,255,255,0.12)'; this.style.borderColor='rgba(255,255,255,0.25)'; this.style.transform='translateY(0)';">
                    <div style="width: 64px; height: 64px; border-radius: 16px; background: rgba(255,255,255,0.15); display: flex; align-items: center; justify-content: center; font-size: 32px;">
                        🐄
                    </div>
                    <div>
                        <h4 style="margin: 0; font-size: 17px; font-weight: 800; color: #ffffff;">Animales</h4>
                        <p style="margin: 4px 0 0; font-size: 12px; color: #cbd5e1;">Gestión y control del ganado</p>
                    </div>
                </a>
                @endcan

                @can('ver inventario')
                <a href="{{ route('inventario.index') }}"
                   style="text-decoration: none; background: rgba(255,255,255,0.12); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.25); border-radius: 20px; padding: 2rem 1.5rem; display: flex; flex-direction: column; align-items: center; gap: 14px; text-align: center;"
                   onmouseover="this.style.background='rgba(46,125,50,0.5)'; this.style.borderColor='#4caf50'; this.style.transform='translateY(-4px)';"
                   onmouseout="this.style.background='rgba(255,255,255,0.12)'; this.style.borderColor='rgba(255,255,255,0.25)'; this.style.transform='translateY(0)';">
                    <div style="width: 64px; height: 64px; border-radius: 16px; background: rgba(255,255,255,0.15); display: flex; align-items: center; justify-content: center; font-size: 32px;">
                        📦
                    </div>
                    <div>
                        <h4 style="margin: 0; font-size: 17px; font-weight: 800; color: #ffffff;">Reportes</h4>
                        <p style="margin: 4px 0 0; font-size: 12px; color: #cbd5e1;">Control de insumos y recursos</p>
                    </div>
                </a>
                @endcan

                @can('ver registros medicos')
                <a href="{{ route('registros-medicos.index') }}"
                   style="text-decoration: none; background: rgba(255,255,255,0.12); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.25); border-radius: 20px; padding: 2rem 1.5rem; display: flex; flex-direction: column; align-items: center; gap: 14px; text-align: center;"
                   onmouseover="this.style.background='rgba(46,125,50,0.5)'; this.style.borderColor='#4caf50'; this.style.transform='translateY(-4px)';"
                   onmouseout="this.style.background='rgba(255,255,255,0.12)'; this.style.borderColor='rgba(255,255,255,0.25)'; this.style.transform='translateY(0)';">
                    <div style="width: 64px; height: 64px; border-radius: 16px; background: rgba(255,255,255,0.15); display: flex; align-items: center; justify-content: center; font-size: 32px;">
                        🩺
                    </div>
                    <div>
                        <h4 style="margin: 0; font-size: 17px; font-weight: 800; color: #ffffff;">Registros Médicos</h4>
                        <p style="margin: 4px 0 0; font-size: 12px; color: #cbd5e1;">Historial sanitario y controles</p>
                    </div>
                </a>
                @endcan

            </div>
        </div>
    </div>
</x-app-layout>