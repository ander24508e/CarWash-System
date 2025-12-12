<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmpresaController extends Controller
{
    public function __construct()
    {
        // Solo admins pueden acceder
        $this->middleware(['auth', 'role:admin']);
    }

    public function edit()
    {
        // Obtener LA empresa del sistema (solo una)
        $empresa = Empresa::firstOrCreate(
            ['id' => 1],
            [
                'nombre' => 'CarWash System',
                'direccion' => 'Dirección no configurada',
                'telefono' => '0999999999',
                'logo' => null
            ]
        );
        
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
            // Obtener o crear LA empresa
            $empresa = Empresa::firstOrCreate(['id' => 1]);

            // Actualizar datos básicos usando fill()
            $empresa->fill([
                'nombre' => $request->nombre,
                'direccion' => $request->direccion,
                'telefono' => $request->telefono
            ]);

            // Manejo del logo
            if ($request->hasFile('logo')) {
                $file = $request->file('logo');
                
                if ($file->isValid()) {
                    // Borrar logo anterior si existe
                    if ($empresa->logo && Storage::disk('public')->exists($empresa->logo)) {
                        Storage::disk('public')->delete($empresa->logo);
                    }

                    // Guardar nuevo logo
                    $fileName = 'logo-empresa-' . time() . '.' . $file->getClientOriginalExtension();
                    $path = $file->storeAs('logos_empresa', $fileName, 'public');

                    $empresa->logo = $path;
                }
            }

            // Guardar cambios
            $empresa->save();

            return redirect()->route('empresa.edit')
                ->with('status', 'empresa-updated');

        } catch (\Exception $e) {
            return back()
                ->with('error', 'Error al guardar: ' . $e->getMessage())
                ->withInput();
        }
    }
}