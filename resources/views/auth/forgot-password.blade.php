<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña - Lavadora Endara</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    @vite(['resources/scss/allStyles.scss'])
</head>

<body class="min-h-screen bg-white">

    <!-- Contenedor principal que ocupa toda la pantalla -->
    <div class="min-h-screen flex items-center justify-center p-4">
        <!-- Contenedor del formulario -->
        <div class="w-full max-w-md">
            <!-- Logo y título -->
            <div class="text-center mb-10">
                <div class="inline-flex items-center justify-center mb-6">
                    <img src="{{ asset('images/lavadora-logo.jpg') }}" alt="logo-endara" class="w-32 h-32 object-contain rounded-full shadow-lg">
                </div>
                <h1 class="text-3xl font-bold text-gray-800 mb-2">ENDARA</h1>
                <p class="text-lg text-gray-600">Recuperar Contraseña</p>
            </div>

            <!-- Tarjeta del formulario -->
            <div class="bg-white rounded-2xl p-8 shadow-2xl border border-gray-100">
                <!-- Mensaje informativo -->
                <div class="mb-6 p-4 bg-blue-50 border-l-4 border-blue-500 rounded-lg">
                    <div class="flex items-start">
                        <i class="bi bi-question-circle-fill text-blue-500 text-lg mr-3 mt-0.5"></i>
                        <p class="text-sm text-blue-700">
                            {{ __('¿Olvidaste tu contraseña? No hay problema. Solo dinos tu dirección de correo electrónico y te enviaremos un enlace para restablecer la contraseña que te permitirá elegir una nueva.') }}
                        </p>
                    </div>
                </div>

                <!-- Session Status -->
                @if (session('status'))
                    <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 rounded-lg">
                        <div class="flex items-start">
                            <i class="bi bi-check-circle-fill text-green-500 text-lg mr-3 mt-0.5"></i>
                            <p class="text-sm text-green-700 font-medium">
                                {{ session('status') }}
                            </p>
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="space-y-3 mb-6">
                        <label for="email" class="block text-sm font-semibold text-gray-700">
                            Correo Electrónico
                        </label>
                        <div class="relative">
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                                class="w-full px-4 py-4 text-base border border-gray-300 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200"
                                placeholder="tu@email.com">
                            <i class="bi bi-envelope absolute right-4 top-4 text-gray-400 text-lg"></i>
                        </div>
                        @error('email')
                            <p class="text-red-600 text-sm mt-2 flex items-center">
                                <i class="bi bi-exclamation-circle mr-2"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Botón Enviar Enlace -->
                    <div class="pt-4">
                        <button type="submit"
                            class="w-full py-4 bg-red-600 text-white font-bold text-lg rounded-xl shadow-lg hover:bg-red-700 transform hover:scale-105 transition-all duration-200 flex items-center justify-center space-x-3">
                            <i class="bi bi-envelope-arrow-up text-xl"></i>
                            <span>Enviar Enlace de Recuperación</span>
                        </button>
                    </div>

                    <!-- Enlaces de navegación -->
                    <div class="flex flex-col space-y-3 mt-6 text-center">
                        <a href="{{ route('login') }}" class="text-red-600 hover:text-red-800 font-medium transition-colors flex items-center justify-center space-x-2">
                            <i class="bi bi-arrow-left"></i>
                            <span>Volver al Inicio de Sesión</span>
                        </a>
                        
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="text-gray-600 hover:text-gray-800 font-medium transition-colors flex items-center justify-center space-x-2">
                                <i class="bi bi-person-plus"></i>
                                <span>¿No tienes cuenta? Regístrate</span>
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            <!-- Información adicional -->
            <div class="mt-6 p-4 bg-yellow-50 border-l-4 border-yellow-500 rounded-lg">
                <div class="flex items-start">
                    <i class="bi bi-info-circle-fill text-yellow-500 text-lg mr-3 mt-0.5"></i>
                    <p class="text-sm text-yellow-700">
                        El enlace de recuperación será enviado a tu correo electrónico y tendrá una validez limitada.
                    </p>
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