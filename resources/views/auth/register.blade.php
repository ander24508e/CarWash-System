<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- ✅ CAMBIO: Usar helper empresa_nombre() en el título --}}
    <title>Registro - {{ empresa_nombre() }}</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>

<body class="min-h-screen flex items-center justify-center bg-white">

    <!-- Ventana flotante compacta -->
    <div class="w-full max-w-sm bg-white bg-opacity-95 backdrop-blur-xl rounded-2xl shadow-2xl p-6">

        <!-- Logo -->
        <div class="text-center mb-3">
            {{-- ✅ CAMBIO: Usar helper empresa_logo() para el logo --}}
            <img src="{{ empresa_logo() }}" alt="{{ empresa_nombre() }}"
                class="w-20 h-20 mx-auto object-contain rounded-full shadow-md">
            <h1 class="text-base font-bold text-gray-700 mt-1">Registro de Usuario</h1>
        </div>

        <!-- FORMULARIO -->
        <form method="POST" action="{{ route('register') }}" class="space-y-4 mx-auto w-full max-w-xs">
            @csrf

            <!-- Nombre -->
            <div>
                <label for="name" class="block text-xs font-semibold text-gray-700 mb-1">
                    Nombre
                </label>
                <input id="name" type="text" name="name"
                    class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg" value="{{ old('name') }}"
                    required autofocus autocomplete="name">
                <x-input-error :messages="$errors->get('name')" class="text-red-500 text-xs mt-1" />
            </div>

            <!-- Apellido -->
            <div>
                <label for="apellido" class="block text-xs font-semibold text-gray-700 mb-1">
                    Apellido
                </label>
                <input id="apellido" type="text" name="apellido"
                    class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg" value="{{ old('apellido') }}"
                    required autocomplete="apellido">
                <x-input-error :messages="$errors->get('apellido')" class="text-red-500 text-xs mt-1" />
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-xs font-semibold text-gray-700 mb-1">
                    Correo Electrónico
                </label>
                <input id="email" type="email" name="email"
                    class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg" value="{{ old('email') }}"
                    required autocomplete="username">
                <x-input-error :messages="$errors->get('email')" class="text-red-500 text-xs mt-1" />
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-xs font-semibold text-gray-700 mb-1">
                    Contraseña
                </label>

                <div class="relative">
                    <input id="password" type="password" name="password"
                        class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg" required
                        autocomplete="new-password">

                    <i class="bi bi-eye-slash absolute right-3 top-2.5 text-gray-600 cursor-pointer"
                        onclick="togglePassword('password', this)"></i>
                </div>

                <x-input-error :messages="$errors->get('password')" class="text-red-500 text-xs mt-1" />
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="password_confirmation" class="block text-xs font-semibold text-gray-700 mb-1">
                    Confirmar Contraseña
                </label>

                <div class="relative">
                    <input id="password_confirmation" type="password" name="password_confirmation"
                        class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg" required
                        autocomplete="new-password">

                    <i class="bi bi-eye-slash absolute right-3 top-2.5 text-gray-600 cursor-pointer"
                        onclick="togglePassword('password_confirmation', this)"></i>
                </div>

                <x-input-error :messages="$errors->get('password_confirmation')" class="text-red-500 text-xs mt-1" />
            </div>

            <!-- Botones -->
            <button type="submit"
                class="w-full py-2 bg-red-600 text-white text-sm font-semibold rounded-lg shadow-md hover:bg-red-700 transition">
                Registrarse
            </button>

            @if (Route::has('login'))
                <p class="text-center text-xs text-gray-600">
                    ¿Ya tienes una cuenta?
                    <a href="{{ route('login') }}" class="text-red-600 font-semibold">Inicia sesión aquí</a>
                </p>
            @endif

        </form>
    </div>

</body>

<script>
    function togglePassword(id, icon) {
        const input = document.getElementById(id);

        if (input.type === "password") {
            input.type = "text";
            icon.classList.remove("bi-eye-slash");
            icon.classList.add("bi-eye");
        } else {
            input.type = "password";
            icon.classList.remove("bi-eye");
            icon.classList.add("bi-eye-slash");
        }
    }
</script>

</html>