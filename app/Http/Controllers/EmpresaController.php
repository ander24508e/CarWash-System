<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmpresaController extends Controller
{
    public function edit(Request $request)
    {
        // USAR el método seguro que crea empresa si no existe
        $empresa = $request->user()->getEmpresaOrCreate();

        return view('empresa.empresaEdit', compact('empresa'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'nombre'    => 'required|string|max:255',
            'direccion' => 'nullable|string|max:500',
            'telefono'  => 'nullable|string|max:20',
            'logo'      => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096' // ← Más específico
        ]);

        $empresa = $request->user()->getEmpresaOrCreate();

        // Actualizar datos
        $empresa->nombre = $request->nombre;
        $empresa->direccion = $request->direccion;
        $empresa->telefono = $request->telefono;

        // Manejo del logo MEJORADO
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            
            if ($file->isValid()) {
                // Borrar logo anterior si existe
                if ($empresa->logo && Storage::disk('public')->exists($empresa->logo)) {
                    Storage::disk('public')->delete($empresa->logo);
                }

                // Guardar nuevo logo
                $fileName = 'logo-' . $empresa->id . '-' . time() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('logos_empresa', $fileName, 'public'); // ← Carpeta específica

                $empresa->logo = $path;
            }
        }

        $empresa->save();

        return back()->with('status', 'empresa-updated');
    }
}