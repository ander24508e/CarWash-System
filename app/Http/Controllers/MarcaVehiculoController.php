<?php

namespace App\Http\Controllers;

use App\Models\MarcaVehiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MarcaVehiculoController extends Controller
{
    public function index()
    {
        $marcas = MarcaVehiculo::orderBy('name_brand', 'asc')->paginate(5);
        return view("vehiculos.marcas.marcas", compact('marcas'));
    }

    public function create()
    {
        return view('vehiculos.marcas.marcasCreate');
    }

        public function search(Request $request)
    {
        $searchTerm = $request->input('searchTerm');

        $marcas_buscar = MarcaVehiculo::query();

        if ($searchTerm) {
            $marcas_buscar->where(function ($query) use ($searchTerm) {
                $query->where('name_brand', 'LIKE', '%' . $searchTerm . '%');
            });
        }

        $marcas_buscar = $marcas_buscar->paginate(5);

        return view('vehiculos.marcas.marcasSearch', compact('marcas_buscar'));
    }

    public function store(Request $request)
    {
        $request->validate([

            'name_brand' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);


        $extension = $request->file('image')->getClientOriginalExtension();
        $imageName = Str::slug($request->name_brand) . '-' . time() . '.' . $extension;
        $imagePath = $request->file('image')->storeAs('', $imageName, 'marcas');

        // ❗ Aquí es donde faltaba guardar en DB
        MarcaVehiculo::create([
            'name_brand' => $request->name_brand,
            'image' => $imagePath,
        ]);

        return redirect()->route('marcas.index')
            ->with('success', 'Marca creada exitosamente');

        try {
            $extension = $request->file('image')->getClientOriginalExtension();
            $imageName = Str::slug($request->name_brand) . '-' . time() . '.' . $extension;
            $imagePath = $request->file('image')->storeAs('', $imageName, 'marcas');

            MarcaVehiculo::create([
                'name_brand' => $request->name_brand,
                'image' => $imagePath,
            ]);

            return redirect()->route('marcas.index')
                ->with('success', 'Marca creada exitosamente');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Error al subir la imagen: ' . $e->getMessage());
        }
    }


    public function edit($id)
    {
        $marca = MarcaVehiculo::findOrFail($id);
        return view('vehiculos.marcas.marcasEdit', compact('marca'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name_brand' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        try {
            $marca = MarcaVehiculo::findOrFail($id);
            $data = ['name_brand' => $request->name_brand];

            if ($request->hasFile('image')) {
                // Eliminar imagen anterior
                if ($marca->image && Storage::disk('public')->exists($marca->image)) {
                    Storage::disk('public')->delete($marca->image);
                }

                // Subir nueva imagen
                $imageName = Str::slug($request->name_brand) . '-' . time() . '.' . $request->image->extension();
                $data['image'] = $request->image->storeAs('marcas', $imageName, 'public');
            }

            $marca->update($data);

            return redirect()->route('marcas.index')
                ->with('success', 'Marca actualizada exitosamente');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Error al actualizar: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $marca = MarcaVehiculo::findOrFail($id);

            // Eliminar imagen asociada
            if ($marca->image && Storage::disk('public')->exists($marca->image)) {
                Storage::disk('public')->delete($marca->image);
            }

            $marca->delete();

            return redirect()->route('marcas.index')
                ->with('success', 'Marca eliminada exitosamente');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al eliminar: ' . $e->getMessage());
        }
    }
}
