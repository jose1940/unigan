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

    <div style="padding: 2rem 0; background-color: #f8fafc; min-height: calc(100vh - 120px);">
        <div style="max-width: 1000px; margin: 0 auto; padding: 0 1rem;">

            <div style="background: #ffffff; border-radius: 12px; border: 1px solid #e2e8f0; padding: 1.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.03);">
                
                <h3 style="font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.8px; color: #94a3b8; margin: 0 0 1rem 0;">
                    Módulos Principales
                </h3>

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1rem;">

                    @can('ver animales')
                    <a href="{{ route('animales.index') }}" 
                       style="text-decoration: none; padding: 1rem; border-radius: 10px; border: 1px solid #e2e8f0; background-color: #ffffff; display: flex; align-items: center; gap: 12px; transition: all 0.2s;"
                       onmouseover="this.style.borderColor='#2e7d32'; this.style.backgroundColor='#f0fdf4';"
                       onmouseout="this.style.borderColor='#e2e8f0'; this.style.backgroundColor='#ffffff';">
                        <div style="width: 40px; height: 40px; border-radius: 8px; background-color: #f1f5f9; display: flex; align-items: center; justify-content: center; font-size: 18px; flex-shrink: 0;">
                            🐄
                        </div>
                        <div>
                            <h4 style="margin: 0; font-size: 14px; font-weight: 700; color: #1e293b;">Animales</h4>
                            <p style="margin: 2px 0 0 0; font-size: 11px; color: #64748b;">Gestión y control de bovinos</p>
                        </div>
                    </a>
                    @endcan

                    @can('ver inventario')
                    <a href="{{ route('inventario.index') }}" 
                       style="text-decoration: none; padding: 1rem; border-radius: 10px; border: 1px solid #e2e8f0; background-color: #ffffff; display: flex; align-items: center; gap: 12px; transition: all 0.2s;"
                       onmouseover="this.style.borderColor='#2e7d32'; this.style.backgroundColor='#f0fdf4';"
                       onmouseout="this.style.borderColor='#e2e8f0'; this.style.backgroundColor='#ffffff';">
                        <div style="width: 40px; height: 40px; border-radius: 8px; background-color: #f1f5f9; display: flex; align-items: center; justify-content: center; font-size: 18px; flex-shrink: 0;">
                            📦
                        </div>
                        <div>
                            <h4 style="margin: 0; font-size: 14px; font-weight: 700; color: #1e293b;">Inventario</h4>
                            <p style="margin: 2px 0 0 0; font-size: 11px; color: #64748b;">Control de insumos y recursos</p>
                        </div>
                    </a>
                    @endcan

                    @can('ver registros medicos')
                    <a href="{{ route('registros-medicos.index') }}" 
                       style="text-decoration: none; padding: 1rem; border-radius: 10px; border: 1px solid #e2e8f0; background-color: #ffffff; display: flex; align-items: center; gap: 12px; transition: all 0.2s;"
                       onmouseover="this.style.borderColor='#2e7d32'; this.style.backgroundColor='#f0fdf4';"
                       onmouseout="this.style.borderColor='#e2e8f0'; this.style.backgroundColor='#ffffff';">
                        <div style="width: 40px; height: 40px; border-radius: 8px; background-color: #f1f5f9; display: flex; align-items: center; justify-content: center; font-size: 18px; flex-shrink: 0;">
                            🩺
                        </div>
                        <div>
                            <h4 style="margin: 0; font-size: 14px; font-weight: 700; color: #1e293b;">Registros Médicos</h4>
                            <p style="margin: 2px 0 0 0; font-size: 11px; color: #64748b;">Historial sanitario y controles</p>
                        </div>
                    </a>
                    @endcan

                </div>
            </div>

        </div>
    </div>
</x-app-layout>