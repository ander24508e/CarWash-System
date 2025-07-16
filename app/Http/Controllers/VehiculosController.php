<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use App\Models\vehiculos;
use Illuminate\Http\Request;

class VehiculosController extends Controller
{

    public function index()
    {
        $vehiculos = vehiculos::orderBy('id', 'asc')->paginate(5);
        return view("vehiculos.vehiculos", compact('vehiculos'));
    }

    public function create()
    {
        $clientes = Clientes::all();
        return view('vehiculos.vehiculosCreate', compact('clientes'));
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('searchTerm');

        $vehiculos_buscar = vehiculos::query();

        if ($searchTerm) {
            $vehiculos_buscar->where(function ($query) use ($searchTerm) {
                $query->where('placa', 'LIKE', '%' . $searchTerm . '%');
                $query->where('customer', 'LIKE', '%' . $searchTerm . '%');
                $query->where('brand_vehicle', 'LIKE', '%' . $searchTerm . '%');
                $query->where('model_vehicle', 'LIKE', '%' . $searchTerm . '%');
            });
        }

        $vehiculos_buscar = $vehiculos_buscar->paginate(5);

        return view('vehiculos.vehiculosSearch', compact('vehiculos_buscar'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'numberPlaca' => 'required',
            'nameCustomer' => 'required',
            'brandVehicle' => 'required',
            'modelVehicle' => 'required',
            'color' => 'required'
        ]);

        $vehiculos = new vehiculos();
        $vehiculos->placa = $request->numberPlaca;
        $vehiculos->customer = $request->nameCustomer;
        $vehiculos->brand_vehicle = $request->brandVehicle;
        $vehiculos->model_vehicle = $request->modelVehicle;
        $vehiculos->color = $request->color;
        $vehiculos->save();

        return redirect()->route('vehiculos.index');
    }

    public function update(Request $request, $vehiculos_id)
    {
        $request->validate([
            'numberPlaca' => 'required',
            'nameCustomer' => 'required',
            'brandVehicle' => 'required',
            'modelVehicle' => 'required',
            'color' => 'required'
        ]);

        $vehiculos = vehiculos::findOrFail($vehiculos_id);
        $vehiculos->placa = $request->nameProduct;
        $vehiculos->customer = $request->nameCategoria;
        $vehiculos->brand_vehicle = $request->stock;
        $vehiculos->model_vehicle = $request->presentation;
        $vehiculos->color = $request->description;
        $vehiculos->save();

        return redirect()->route('vehiculos.index');
    }

    public function edit(Request $request, int $vehiculos_edit)
    {
        $vehiculos = vehiculos::findOrFail($vehiculos_edit);
        $clientes = Clientes::all();
        return view('vehiculos.vehiculosEdit', compact('vehiculos', 'clientes'));
    }

    public function destroyer(vehiculos $vehiculos_eliminar)
    {
        $vehiculos_eliminar->delete();
        return redirect()->route('vehiculos.index');
    }
}
