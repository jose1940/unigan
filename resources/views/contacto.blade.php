<x-app-layout>
    <div style="min-height: 80vh; background-color: #f8fafc; padding: 3rem 1.5rem; display: flex; align-items: center; justify-content: center;">
        <div style="background: #ffffff; width: 100%; max-width: 600px; border-radius: 24px; padding: 2.5rem; box-shadow: 0 10px 25px rgba(0,0,0,0.05); border: 1px solid #e2e8f0; text-align: center;">
            <div style="width: 64px; height: 64px; border-radius: 18px; background: #e8f5e9; color: #2e7d32; display: flex; align-items: center; justify-content: center; font-size: 32px; margin: 0 auto 1.5rem;">
                🌾
            </div>
            <h1 style="font-size: 2rem; font-weight: 900; color: #0f172a; margin: 0 0 0.5rem;">Contacto UNIGAN</h1>
            <p style="color: #64748b; font-size: 1.05rem; margin-bottom: 2rem;">
                ¿Tienes dudas o necesitas asistencia con la plataforma de gestión ganadera?
            </p>

            <div style="display: flex; flex-direction: column; gap: 1rem; text-align: left; margin-bottom: 2rem;">
                <div style="background: #f8fafc; padding: 1rem 1.25rem; border-radius: 14px; border: 1px solid #e2e8f0; display: flex; align-items: center; gap: 14px;">
                    <div style="font-size: 24px;">📧</div>
                    <div>
                        <div style="font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase;">Correo Electrónico</div>
                        <div style="font-weight: 700; color: #0f172a; font-size: 15px;">soporte@unigan.test</div>
                    </div>
                </div>

                <div style="background: #f8fafc; padding: 1rem 1.25rem; border-radius: 14px; border: 1px solid #e2e8f0; display: flex; align-items: center; gap: 14px;">
                    <div style="font-size: 24px;">📱</div>
                    <div>
                        <div style="font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase;">Atención al Ganadero</div>
                        <div style="font-weight: 700; color: #0f172a; font-size: 15px;">+57 (300) 000-0000</div>
                    </div>
                </div>

                <div style="background: #f8fafc; padding: 1rem 1.25rem; border-radius: 14px; border: 1px solid #e2e8f0; display: flex; align-items: center; gap: 14px;">
                    <div style="font-size: 24px;">📍</div>
                    <div>
                        <div style="font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase;">Ubicación</div>
                        <div style="font-weight: 700; color: #0f172a; font-size: 15px;">Sede Administrativa & Campo Experimental</div>
                    </div>
                </div>
            </div>

            <a href="{{ url('/') }}" style="display: inline-block; background: #2e7d32; color: #ffffff; text-decoration: none; font-weight: 700; padding: 12px 28px; border-radius: 12px; font-size: 14px; box-shadow: 0 4px 12px rgba(46,125,50,0.25);">
                ← Volver al Inicio
            </a>
        </div>
    </div>
</x-app-layout>