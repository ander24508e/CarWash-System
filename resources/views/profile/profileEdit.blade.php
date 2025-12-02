@extends('menu')

@section('contenido')
    @vite(['resources/scss/profile.scss'])

    @if(session('status') === 'profile-updated')
        <div class="notification-success">
            <div class="notification-content">
                <i class="bi bi-check-circle"></i>
                <span>{{ __('Perfil actualizado correctamente.') }}</span>
            </div>
            <button class="notification-close" onclick="this.parentElement.remove()">
                <i class="bi bi-x"></i>
            </button>
        </div>
    @endif

    @if(session('status') === 'password-updated')
        <div class="notification-success">
            <div class="notification-content">
                <i class="bi bi-check-circle"></i>
                <span>{{ __('Contraseña actualizada correctamente.') }}</span>
            </div>
            <button class="notification-close" onclick="this.parentElement.remove()">
                <i class="bi bi-x"></i>
            </button>
        </div>
    @endif

    {{-- **INICIO DE LA CORRECCIÓN:** Se añade 'content-body' para el margen superior --}}
    <div class="content-body">
        <div class="profile-container">
            <div class="profile-wrapper">
                <div class="profile-main-card">

                    <div class="profile-content">

                        <div class="profile-section">
                            <h2 class="profile-section-title">
                                <i class="bi bi-person-gear mr-2"></i>
                                Información Personal
                            </h2>
                            @include('profile.partials.update-profile-information-form')
                        </div>

                        <div class="section-divider"></div>

                        <div class="profile-section">
                            <h2 class="profile-section-title">
                                <i class="bi bi-shield-lock mr-2"></i>
                                Seguridad
                            </h2>
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const notifications = document.querySelectorAll('.notification-success');
            notifications.forEach(notification => {
                setTimeout(() => {
                    notification.style.opacity = '0';
                    notification.style.transform = 'translateY(-100%)';
                    setTimeout(() => notification.remove(), 300);
                }, 4000);
            });
        });
    </script>
@endsection