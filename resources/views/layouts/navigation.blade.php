<nav style="background-color: #2e7d32; padding: 0.85rem 2rem; border-bottom: 1px solid #1b5e20;">
    <div style="max-width: 1100px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center;">
        
       
        <a href="{{ route('dashboard') }}" style="display: flex; align-items: center; gap: 8px; text-decoration: none; color: #ffffff; font-weight: 800; font-size: 1.2rem; letter-spacing: 0.5px;">
            <span style="font-size: 1.3rem;">🐄</span> UNIGAN
        </a>

      
        <div style="display: flex; align-items: center; gap: 1.5rem;">
            <a href="{{ route('dashboard') }}" 
               style="color: #ffffff; text-decoration: none; font-size: 14px; font-weight: 600; opacity: 0.95;">
                Panel
            </a>

            @can('ver animales')
            <a href="{{ route('animales.index') }}" 
               style="color: #ffffff; text-decoration: none; font-size: 14px; font-weight: 500; opacity: 0.85;">
                Animales
            </a>
            @endcan

            @can('ver inventario')
            <a href="{{ route('inventario.index') }}" 
               style="color: #ffffff; text-decoration: none; font-size: 14px; font-weight: 500; opacity: 0.85;">
                Inventario
            </a>
            @endcan

            @can('ver registros medicos')
            <a href="{{ route('registros-medicos.index') }}" 
               style="color: #ffffff; text-decoration: none; font-size: 14px; font-weight: 500; opacity: 0.85;">
                Salud
            </a>
            @endcan

            <span style="color: rgba(255,255,255,0.3); font-size: 12px;">|</span>

            <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                @csrf
                <button type="submit" 
                        style="background: transparent; border: none; color: #ffffff; font-size: 14px; font-weight: 500; opacity: 0.85; cursor: pointer; padding: 0;">
                    Cerrar sesión
                </button>
            </form>
        </div>

    </div>
</nav>