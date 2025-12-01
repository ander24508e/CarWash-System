<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecer Contraseña - Lavadora Endara</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    @vite(['resources/scss/allStyles.scss'])
</head>

<body class="min-h-screen bg-white">

    <!-- Contenedor principal que ocupa toda la pantalla -->
    <div class="min-h-screen flex items-center justify-center p-4">
        <!-- Contenedor del formulario -->
        <div class="w-full max-w-md">
            <!-- Logo y título con más espacio -->
            <div class="text-center mb-10">
                <div class="inline-flex items-center justify-center mb-6">
                    <img src="{{ asset('images/lavadora-logo.jpg') }}" alt="logo-endara" class="w-32 h-32 object-contain rounded-full shadow-lg">
                </div>
                <h1 class="text-3xl font-bold text-gray-800 mb-2">ENDARA</h1>
                <p class="text-lg text-gray-600">Restablecer Contraseña</p>
            </div>

            <!-- Tarjeta del formulario -->
            <div class="bg-white rounded-2xl p-8 shadow-2xl border border-gray-100">
                <form method="POST" action="{{ route('password.store') }}">
                    @csrf

                    <!-- Password Reset Token -->
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <!-- Email Address -->
                    <div class="space-y-3 mb-6">
                        <label for="email" class="block text-sm font-semibold text-gray-700">
                            Correo Electrónico
                        </label>
                        <div class="relative">
                            <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username"
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

                    <!-- Password -->
                    <div class="space-y-3 mb-6">
                        <label for="password" class="block text-sm font-semibold text-gray-700">
                            Nueva Contraseña
                        </label>
                        <div class="relative">
                            <input id="password" type="password" name="password" required autocomplete="new-password"
                                class="w-full px-4 py-4 text-base border border-gray-300 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200"
                                placeholder="••••••••">
                            <i class="bi bi-lock absolute right-4 top-4 text-gray-400 text-lg"></i>
                        </div>
                        @error('password')
                            <p class="text-red-600 text-sm mt-2 flex items-center">
                                <i class="bi bi-exclamation-circle mr-2"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="space-y-3 mb-6">
                        <label for="password_confirmation" class="block text-sm font-semibold text-gray-700">
                            Confirmar Contraseña
                        </label>
                        <div class="relative">
                            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                                class="w-full px-4 py-4 text-base border border-gray-300 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200"
                                placeholder="••••••••">
                            <i class="bi bi-lock-fill absolute right-4 top-4 text-gray-400 text-lg"></i>
                        </div>
                        @error('password_confirmation')
                            <p class="text-red-600 text-sm mt-2 flex items-center">
                                <i class="bi bi-exclamation-circle mr-2"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Botón Restablecer -->
                    <div class="pt-4">
                        <button type="submit"
                            class="w-full py-4 bg-red-600 text-white font-bold text-lg rounded-xl shadow-lg hover:bg-red-700 transform hover:scale-105 transition-all duration-200 flex items-center justify-center space-x-3">
                            <i class="bi bi-key-fill text-xl"></i>
                            <span>Restablecer Contraseña</span>
                        </button>
                    </div>

                    <!-- Enlace para volver al login -->
                    <div class="text-center mt-6">
                        <a href="{{ route('login') }}" class="text-red-600 hover:text-red-800 font-medium transition-colors flex items-center justify-center space-x-2">
                            <i class="bi bi-arrow-left"></i>
                            <span>Volver al Inicio de Sesión</span>
                        </a>
                    </div>
                </form>
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