<?php

namespace App\Http\Controllers;

use App\Models\ModelVehiculo;
use Illuminate\Http\Request;

class ModelVehiculoController extends Controller
{
    public function index()
    {
        $modelos = ModelVehiculo::orderBy('id', 'asc')->paginate(5);
        return view("vehiculos.modelos.modelos", compact('modelos'));
    }

    public function create()
    {
        return view('vehiculos.modelos.modelosCreate');
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('searchTerm');

        $modelos_buscar = ModelVehiculo::query();

        if ($searchTerm) {
            $modelos_buscar->where(function ($query) use ($searchTerm) {
                $query->where('name_model', 'LIKE', '%' . $searchTerm . '%');
            });
        }

        $modelos_buscar = $modelos_buscar->paginate(5);

        return view('vehiculos.modelos.modelosSearch', compact('modelos_buscar'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_model' => 'required',
            'brand' => 'required'
        ]);

        $modelos = new ModelVehiculo();
        $modelos->name_model = $request->nameModel;
        $modelos->brand = $request->nameMarca;
        $modelos->save();

        return redirect()->route('modelos.index');
    }

    public function edit(Request $request, int $modelos_edit)
    {
        $modelos_edit = ModelVehiculo::findOrFail($modelos_edit);
        return view('vehiculos.modelos.modelosEdit', compact('modelos'));
    }


    public function update(Request $request, $modelos_id)
    {
        $request->validate([
            'name_model' => 'required',
            'brand' => 'required'
        ]);

        $modelos_edit = ModelVehiculo::findOrFail($modelos_id);
        $modelos_edit->name_model = $request->nameModel;
        $modelos_edit->brand = $request->nameMarca;
        $modelos_edit->save();

        return redirect()->route("categorias.index");
    }

    public function destroyer(ModelVehiculo $modelos_eliminar)
    {
        $modelos_eliminar->delete();
        return redirect()->route('modelos.index');
    }
}
