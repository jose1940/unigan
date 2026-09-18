<x-app-layout>
    <x-slot name="header">
        <div style="display: flex; justify-content: space-between; align-items: center; width: 100%; flex-wrap: wrap; gap: 10px;">
            <div style="display: flex; align-items: center; gap: 12px;">
                <a href="{{ route('dashboard') }}"
                   style="display: inline-flex; align-items: center; gap: 6px; padding: 8px 14px; border-radius: 10px; background: #ffffff; border: 1px solid #cbd5e1; color: #475569; font-weight: 600; font-size: 13px; text-decoration: none; box-shadow: 0 1px 2px rgba(0,0,0,0.05); transition: all 0.2s;"
                   onmouseover="this.style.background='#f1f5f9'; this.style.color='#1e293b';"
                   onmouseout="this.style.background='#ffffff'; this.style.color='#475569';">
                    ← Volver al Panel
                </a>
                <h2 style="font-size: 1.5rem; font-weight: 700; color: #1f2937; margin: 0; display: flex; align-items: center; gap: 8px;">
                    👤 Perfil de Usuario
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <livewire:profile.update-profile-information-form />
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <livewire:profile.update-password-form />
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <livewire:profile.delete-user-form />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
