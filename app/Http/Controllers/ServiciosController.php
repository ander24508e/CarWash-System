<?php

namespace App\Http\Controllers;

use App\Models\servicios;
use Illuminate\Http\Request;

class ServiciosController extends Controller
{
       public function index()
    {
        $servicios = servicios::orderBy('id', 'asc')->paginate(10);
        return view("servicios.servicios", compact('servicios'));
    }

    public function create()
    {
        $servicios = servicios::all();
        return view('servicios.serviciosCreate', compact('servicios'));
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('searchTerm');

        $servicios_buscar = servicios::query();

        if ($searchTerm) {
            $servicios_buscar->where(function ($query) use ($searchTerm) {
                $query->where('name_service', 'LIKE', '%' . $searchTerm . '%');
            });
        }

        $servicios_buscar = $servicios_buscar->paginate(5);

        return view('servicios.serviciosSearch', compact('servicios_buscar'));
    }
}
