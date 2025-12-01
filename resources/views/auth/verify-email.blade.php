<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificar Email - Lavadora Endara</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    @vite(['resources/scss/allStyles.scss'])
</head>

<body class="min-h-screen bg-white">

    <!-- Contenedor principal que ocupa toda la pantalla -->
    <div class="min-h-screen flex items-center justify-center p-4">
        <!-- Contenedor del contenido -->
        <div class="w-full max-w-md">
            <!-- Logo y título -->
            <div class="text-center mb-10">
                <div class="inline-flex items-center justify-center mb-6">
                    <img src="{{ asset('images/lavadora-logo.jpg') }}" alt="logo-endara" class="w-32 h-32 object-contain rounded-full shadow-lg">
                </div>
                <h1 class="text-3xl font-bold text-gray-800 mb-2">ENDARA</h1>
                <p class="text-lg text-gray-600">Verificación de Email</p>
            </div>

            <!-- Tarjeta de verificación -->
            <div class="bg-white rounded-2xl p-8 shadow-2xl border border-gray-100">
                <!-- Mensaje informativo -->
                <div class="mb-6 p-4 bg-blue-50 border-l-4 border-blue-500 rounded-lg">
                    <div class="flex items-start">
                        <i class="bi bi-info-circle-fill text-blue-500 text-lg mr-3 mt-0.5"></i>
                        <p class="text-sm text-blue-700">
                            {{ __('¡Gracias por registrarte! Antes de comenzar, ¿podrías verificar tu dirección de correo electrónico haciendo clic en el enlace que acabamos de enviarte? Si no recibiste el correo, con gusto te enviaremos otro.') }}
                        </p>
                    </div>
                </div>

                <!-- Mensaje de éxito -->
                @if (session('status') == 'verification-link-sent')
                    <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 rounded-lg">
                        <div class="flex items-start">
                            <i class="bi bi-check-circle-fill text-green-500 text-lg mr-3 mt-0.5"></i>
                            <p class="text-sm text-green-700 font-medium">
                                {{ __('Se ha enviado un nuevo enlace de verificación a la dirección de correo electrónico que proporcionaste durante el registro.') }}
                            </p>
                        </div>
                    </div>
                @endif

                <!-- Botones de acción -->
                <div class="space-y-4">
                    <!-- Reenviar email de verificación -->
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit"
                            class="w-full py-4 bg-red-600 text-white font-bold text-lg rounded-xl shadow-lg hover:bg-red-700 transform hover:scale-105 transition-all duration-200 flex items-center justify-center space-x-3">
                            <i class="bi bi-envelope-arrow-up text-xl"></i>
                            <span>Reenviar Email de Verificación</span>
                        </button>
                    </form>

                    <!-- Cerrar sesión -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" 
                            class="w-full py-3 bg-gray-100 text-gray-700 font-semibold rounded-xl hover:bg-gray-200 transition-all duration-200 flex items-center justify-center space-x-3 border border-gray-300">
                            <i class="bi bi-box-arrow-left"></i>
                            <span>Cerrar Sesión</span>
                        </button>
                    </form>
                </div>

                <!-- Información adicional -->
                <div class="mt-6 p-4 bg-yellow-50 border-l-4 border-yellow-500 rounded-lg">
                    <div class="flex items-start">
                        <i class="bi bi-exclamation-triangle-fill text-yellow-500 text-lg mr-3 mt-0.5"></i>
                        <p class="text-sm text-yellow-700">
                            Si no encuentras el email de verificación, revisa tu carpeta de spam o correo no deseado.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="text-center mt-8">
                <p class="text-xs text-gray-500">
                    &copy; {{ date('Y') }} Lavadora y Lubricadora Endara
                </p>
                <p class="text-xs text-gray-500 mt-1">
                    Todos los derechos reservados
                </p>
            </div>
        </div>
    </div>

</body>
</html>