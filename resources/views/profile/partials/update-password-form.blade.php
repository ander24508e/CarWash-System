<form method="post" action="{{ route('password.update') }}" class="profile-form">
    @csrf
    @method('put')

    <div class="form-group password-input-group">
        <label for="update_password_current_password" class="form-label">CONTRASEÑA ACTUAL</label>
        <div class="password-container">
            <input type="password" id="update_password_current_password" name="current_password" 
                   class="form-input password-field"
                   autocomplete="current-password" required placeholder="Ingresa tu contraseña actual">
            <i class="bi bi-eye-slash password-toggle" 
               onclick="togglePassword('update_password_current_password', this)"></i>
        </div>
        @error('current_password', 'updatePassword')
            <span class="error-message">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group password-input-group">
        <label for="update_password_password" class="form-label">NUEVA CONTRASEÑA</label>
        <div class="password-container">
            <input type="password" id="update_password_password" name="password" 
                   class="form-input password-field"
                   autocomplete="new-password" required placeholder="Ingresa tu nueva contraseña">
            <i class="bi bi-eye-slash password-toggle" 
               onclick="togglePassword('update_password_password', this)"></i>
        </div>
        @error('password', 'updatePassword')
            <span class="error-message">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group password-input-group">
        <label for="update_password_password_confirmation" class="form-label">CONFIRMAR CONTRASEÑA</label>
        <div class="password-container">
            <input type="password" id="update_password_password_confirmation" name="password_confirmation"
                   class="form-input password-field" 
                   autocomplete="new-password" required placeholder="Confirma tu nueva contraseña">
            <i class="bi bi-eye-slash password-toggle" 
               onclick="togglePassword('update_password_password_confirmation', this)"></i>
        </div>
        @error('password_confirmation', 'updatePassword')
            <span class="error-message">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group" style="grid-column: 1 / -1;">
        <button type="submit" class="btn-primary-custom save-button">
            <i class="bi bi-shield-lock button-icon"></i>
            {{ __('Actualizar Contraseña') }}
        </button>
    </div>
</form>

<script>
function togglePassword(inputId, iconElement) {
    const passwordInput = document.getElementById(inputId);
    const isPassword = passwordInput.type === 'password';
    
    // Cambiar tipo de input
    passwordInput.type = isPassword ? 'text' : 'password';
    
    // Cambiar icono
    if (isPassword) {
        iconElement.classList.remove('bi-eye-slash');
        iconElement.classList.add('bi-eye');
    } else {
        iconElement.classList.remove('bi-eye');
        iconElement.classList.add('bi-eye-slash');
    }
    
    // Mantener el foco en el input
    passwordInput.focus();
}
</script>