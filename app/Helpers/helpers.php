 
<?php

use App\Models\Empresa;

if (!function_exists('empresa')) {
    /**
     * Obtener la empresa del sistema
     */
    function empresa()
    {
        return Empresa::first();
    }
}

if (!function_exists('empresa_logo')) {
    /**
     * Obtener la URL del logo de la empresa
     */
    function empresa_logo()
    {
        $empresa = Empresa::first();
        return $empresa ? $empresa->logo_url : asset('Images/lavadora-logo.jpg');
    }
}

if (!function_exists('empresa_nombre')) {
    /**
     * Obtener el nombre de la empresa
     */
    function empresa_nombre()
    {
        $empresa = Empresa::first();
        return $empresa ? $empresa->nombre : 'Nombre Empresa';
    }
}