<?php

namespace App\Http\Controllers;

use App\Models\ModelVehiculo;
use Illuminate\Http\Request;
use App\Models\MarcaVehiculo;

class ModelVehiculoController extends Controller
{
    public function index()
    {
        $modelos = ModelVehiculo::with('MarcaVehiculo')
        ->orderBy('id', 'asc')
        ->paginate(10);
        
        return view("vehiculos.modelos.modelos", compact('modelos'));
    }

    public function create()
    {
        $marcas = MarcaVehiculo::all();
        return view('vehiculos.modelos.modelosCreate', compact('marcas'));
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
            'nameModel' => 'required',
            'nameMarca' => 'required'
        ]);
        // dd($request);

        $modelos = new ModelVehiculo();
        $modelos->name_model = $request->nameModel;
        $modelos->brand = $request->nameMarca;
        $modelos->save();

        return redirect()->route('modelos.index');
    }

    public function update(Request $request, $modelos_id)
    {
        $request->validate([
            'nameModel' => 'required',
            'nameMarca' => 'required'
        ]);
        // dd($request);

        $modelos_edit = ModelVehiculo::findOrFail($modelos_id);
        $modelos_edit->name_model = $request->nameModel;
        $modelos_edit->brand = $request->nameMarca;
        $modelos_edit->save();

        return redirect()->route("modelos.index");
    }

    public function edit(Request $request, int $modelos_edit)
    {
        $modelos = ModelVehiculo::findOrFail($modelos_edit);
        $marcas = MarcaVehiculo::all();
        return view('vehiculos.modelos.modelosEdit', compact('modelos', 'marcas'));
    }


    public function destroyer(ModelVehiculo $modelos_eliminar)
    {
        $modelos_eliminar->delete();
        return redirect()->route('modelos.index');
    }
}
