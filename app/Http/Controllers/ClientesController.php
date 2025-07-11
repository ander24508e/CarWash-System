<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientesController extends Controller
{
    public function index()
    {
        // $servicios = Productos::orderBy('name_provincia', 'asc')->paginate(5);
        return view("clientes.clientes")->with([
            "clientes"
        ]);
    }

    public function create()
    {
        return view('clientes.clientesCreate');
    }
}
