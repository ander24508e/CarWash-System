<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class EmpresaController extends Controller
{
    public function __construct()
    {
        // Solo admins pueden acceder
        $this->middleware(['auth', 'role:admin']);
    }

    public function edit()
    {
        // Obtener la empresa del sistema
        $empresa = Empresa::first();
        
        // Si no existe, crear objeto vacío para la vista
        if (!$empresa) {
            $empresa = new Empresa();
            $empresa->id = 1;
            $empresa->nombre = '';
            $empresa->direccion = '';
            $empresa->telefono = '';
            $empresa->logo = null;
        }
        
        return view('profile.empresa.empresaEdit', compact('empresa'));
    }

    public function update(Request $request)
    {
        // Validación
        $validated = $request->validate([
            'nombre'    => 'required|string|max:255',
            'direccion' => 'nullable|string|max:500',
            'telefono'  => 'nullable|string|max:20',
            'logo'      => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096'
        ]);

        try {
            // Datos para actualizar/crear
            $empresaData = [
                'nombre' => $request->nombre,
                'direccion' => $request->direccion ?? '',
                'telefono' => $request->telefono ?? ''
            ];

            // Buscar empresa actual para manejar el logo
            $empresaExistente = Empresa::find(1);

            // Manejo del logo
            if ($request->hasFile('logo') && $request->file('logo')->isValid()) {
                $file = $request->file('logo');
                
                // Borrar logo anterior si existe
                if ($empresaExistente && $empresaExistente->logo && 
                    Storage::disk('public')->exists($empresaExistente->logo)) {
                    Storage::disk('public')->delete($empresaExistente->logo);
                }

                // Guardar nuevo logo
                $fileName = 'logo-empresa-' . time() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('logos_empresa', $fileName, 'public');

                $empresaData['logo'] = $path;
            }

            // Actualizar o crear empresa
            Empresa::updateOrCreate(
                ['id' => 1], // Siempre ID 1 para la empresa principal
                $empresaData
            );

            // ✅ CAMBIO: Limpiar caché directamente (sin helper)
            Cache::forget('empresa_sistema');

            return redirect()->route('empresa.edit')
                ->with('status', 'empresa-updated')
                ->with('success', 'Información actualizada correctamente.');

        } catch (\Exception $e) {
            // Log del error
            Log::error('Error al guardar empresa: ' . $e->getMessage());
            
            return back()
                ->with('error', 'Error al guardar los cambios: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Eliminar logo de la empresa
     */
    public function deleteLogo()
    {
        try {
            $empresa = Empresa::first();
            
            if ($empresa && $empresa->logo) {
                // Eliminar archivo físico
                if (Storage::disk('public')->exists($empresa->logo)) {
                    Storage::disk('public')->delete($empresa->logo);
                }
                
                // Actualizar base de datos
                $empresa->logo = null;
                $empresa->save();
                
                // ✅ CAMBIO: Limpiar caché directamente (sin helper)
                Cache::forget('empresa_sistema');
                
                return back()->with('success', 'Logo eliminado correctamente.');
            }
            
            return back()->with('error', 'No hay logo para eliminar.');
            
        } catch (\Exception $e) {
            Log::error('Error al eliminar logo: ' . $e->getMessage());
            return back()->with('error', 'Error al eliminar el logo.');
        }
    }
}