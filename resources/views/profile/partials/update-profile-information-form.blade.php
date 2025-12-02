<form method="post" action="{{ route('profile.update') }}" class="profile-form" enctype="multipart/form-data"
    style="width: 100%;">
    @csrf
    @method('patch')
    <div class="profile-fields-grid">
        <!-- Foto de perfil extendida -->
        <div class="form-group" style="grid-column: 1 / -1;">
            <label class="form-label">FOTO DE PERFIL</label>
            <div class="profile-photo-section">
                <div class="photo-preview-container">
                    <div class="photo-preview-wrapper">
                        <img src="{{ Auth::user()->foto_perfil_url }}" class="profile-photo-preview" alt="Foto actual"
                            id="current-photo-preview">
                        <span class="photo-current-text">Foto actual</span>
                    </div>

                    <div class="photo-upload-section">
                        <div class="modern-file-upload">
                            <input type="file" id="foto_perfil" name="foto_perfil" accept="image/*"
                                class="modern-file-input" onchange="previewImage(this)">
                            <label for="foto_perfil" class="modern-upload-label">
                                <i class="bi bi-cloud-arrow-up modern-upload-icon"></i>
                                <span class="modern-upload-main">Cambiar Foto</span>
                            </label>
                        </div>

                        <p class="profile-photo-hint">
                            <i class="bi bi-info-circle"></i>
                            JPG, PNG (Max: 4MB)
                        </p>

                        @error('foto_perfil')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="name" class="form-label">NOMBRE</label>
            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" class="form-input" required
                autofocus autocomplete="name" placeholder="Tu nombre">
            @error('name')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="apellido" class="form-label">APELLIDO</label>
            <input type="text" id="apellido" name="apellido" value="{{ old('apellido', $user->apellido) }}"
                class="form-input" autocomplete="family-name" placeholder="Tu apellido">
            @error('apellido')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="email" class="form-label">EMAIL</label>
            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" class="form-input"
                required autocomplete="email" placeholder="tu@email.com">
            @error('email')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="telefono" class="form-label">TELÉFONO</label>
            <input type="tel" id="telefono" name="telefono" value="{{ old('telefono', $user->telefono) }}"
                class="form-input" autocomplete="tel" placeholder="Número de teléfono">
            @error('telefono')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <!-- Verificación de email -->
        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
            <div class="form-group" style="grid-column: 1 / -1;">
                <div class="verification-alert">
                    <i class="bi bi-envelope-exclamation"></i>
                    <div>
                        <strong>Email no verificado</strong>
                        <p>Tu dirección de email no ha sido verificada.</p>
                        <button form="send-verification" class="verification-link">
                            {{ __('Click aquí para reenviar el email de verificación.') }}
                        </button>
                    </div>
                </div>

                @if (session('status') === 'verification-link-sent')
                    <div class="notification-success">
                        <div class="notification-content">
                            <i class="bi bi-check-circle"></i>
                            <span>{{ __('Se ha enviado un nuevo enlace de verificación a tu email.') }}</span>
                        </div>
                    </div>
                @endif
            </div>
        @endif

        <div class="form-group" style="grid-column: 1 / -1;">
            <button type="submit" class="btn-primary-custom save-button">
                <i class="bi bi-check-lg button-icon"></i>
                {{ __('Guardar Cambios') }}
            </button>
        </div>
    </div>
</form>

<form id="send-verification" method="post" action="{{ route('verification.send') }}">
    @csrf
</form>

<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById('current-photo-preview').src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>