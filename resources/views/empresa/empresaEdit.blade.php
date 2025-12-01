@extends('menu')

@section('contenido')
    @vite(['resources/scss/empresa.scss'])

    <!-- Notificación de éxito debajo del navbar -->
    @if(session('status') === 'empresa-updated')
        <div class="notification-success">
            <div class="notification-content">
                <i class="bi bi-check-circle"></i>
                <span>{{ __('Información actualizada correctamente.') }}</span>
            </div>
            <button class="notification-close" onclick="this.parentElement.remove()">
                <i class="bi bi-x"></i>
            </button>
        </div>
    @endif

    <div class="empresa-container">
        <div class="empresa-wrapper">
            <!-- Tarjeta Principal Extendida -->
            <div class="empresa-main-card">
                <!-- Contenido Extendido -->
                <div class="empresa-content">
                    <form method="post" action="{{ route('empresa.update') }}" class="empresa-form" enctype="multipart/form-data">
                        @csrf
                        @method('patch')

                        <!-- Sección Logo Extendida -->
                        <div class="empresa-logo-section">
                            <div class="logo-preview-container">
                                <div class="logo-preview-wrapper">
                                    <img src="{{ $empresa->logo_url }}" class="empresa-logo-preview"
                                        alt="Logo actual" id="current-logo-preview">
                                    <span class="logo-current-text">Logo actual</span>
                                </div>

                                <div class="logo-upload-section">
                                    <div class="modern-file-upload">
                                        <input type="file" id="logo" name="logo" accept="image/*" class="modern-file-input" onchange="previewLogo(this)">
                                        <label for="logo" class="modern-upload-label">
                                            <i class="bi bi-cloud-arrow-up modern-upload-icon"></i>
                                            <span class="modern-upload-main">Cambiar Logo</span>
                                        </label>
                                    </div>
                                    
                                    <p class="empresa-logo-hint">
                                        <i class="bi bi-info-circle"></i>
                                        JPG, PNG, SVG (Max: 4MB)
                                    </p>

                                    @error('logo')
                                        <span class="error-message">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Información Extendida -->
                        <div class="empresa-fields-grid">
                            <div class="form-group empresa-field-group">
                                <label for="nombre" class="form-label">NOMBRE DE LA EMPRESA</label>
                                <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $empresa->nombre) }}"
                                    class="form-input empresa-input" placeholder="Nombre de tu empresa" required autofocus>
                                @error('nombre')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group empresa-field-group">
                                <label for="telefono" class="form-label">TELÉFONO</label>
                                <input type="tel" id="telefono" name="telefono" value="{{ old('telefono', $empresa->telefono) }}"
                                    class="form-input empresa-input" placeholder="Número de la empresa" required>
                                @error('telefono')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group empresa-field-group full-width">
                                <label for="direccion" class="form-label">DIRECCIÓN</label>
                                <textarea id="direccion" name="direccion" class="form-input empresa-textarea"
                                    placeholder="Dirección de la empresa"
                                    rows="3">{{ old('direccion', $empresa->direccion) }}</textarea>
                                @error('direccion')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Botón Guardar Extendido -->
                        <div class="form-group save-section">
                            <button type="submit" class="btn-primary-custom save-button">
                                <i class="bi bi-check-lg button-icon"></i>
                                {{ __('Guardar Cambios') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewLogo(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('current-logo-preview').src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Auto-ocultar notificación después de 4 segundos
        document.addEventListener('DOMContentLoaded', function() {
            const notification = document.querySelector('.notification-success');
            if (notification) {
                setTimeout(() => {
                    notification.style.opacity = '0';
                    notification.style.transform = 'translateY(-100%)';
                    setTimeout(() => notification.remove(), 300);
                }, 4000); // 4 segundos
            }
        });
    </script>
@endsection