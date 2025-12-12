<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use Illuminate\Http\Request;

class CategoriasController extends Controller
{
    public function index()
    {
        $categorias = Categorias::orderBy('id', 'asc')->paginate(10); 
        return view("inventario.categorias.categorias", compact('categorias'));
    }

    public function create()
    {
        return view('inventario.categorias.categoriasCreate');
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('searchTerm');
        $categorias_buscar = Categorias::query();

        if ($searchTerm) {
            $categorias_buscar->where('name_category', 'LIKE', '%' . $searchTerm . '%');
        }

        $categorias_buscar = $categorias_buscar->paginate(5);
        return view('inventario.categorias.categoriasSearch', compact('categorias_buscar'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nameCategory' => 'required',
        ]);

        Categorias::create([
            'name_category' => $request->nameCategory
        ]);

        return redirect()->route('categorias.index')
            ->with('success', 'Categoría creada exitosamente');
    }

    // ✅ CORREGIDO - Nombre del parámetro debe coincidir con la ruta
    public function edit($categoria)
    {
        $categorias = Categorias::findOrFail($categoria);
        return view('inventario.categorias.categoriasEdit', compact('categorias'));
    }

    // ✅ CORREGIDO - Nombre del parámetro debe coincidir con la ruta
    public function update(Request $request, $categoria)
    {
        $request->validate([
            'nameCategory' => 'required'
        ]);

        $categorias = Categorias::findOrFail($categoria);
        $categorias->name_category = $request->nameCategory;
        $categorias->save();

        return redirect()->route("categorias.index")
            ->with('success', 'Categoría actualizada exitosamente');
    }

    // ✅ CORREGIDO - Nombre del parámetro debe coincidir con la ruta
    public function destroy($categoria)
    {
        $categorias = Categorias::findOrFail($categoria);
        $categorias->delete();
        
        return redirect()->route('categorias.index')
            ->with('success', 'Categoría eliminada exitosamente');
    }
}