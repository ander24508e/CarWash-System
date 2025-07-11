<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmpleadosController extends Controller
{
    public function index()
    {
        return view("empleados.empleados")->with([
            'empleados'
        ]);
    }

    public function create()
    {
        return view('empleados.empleadosCreate');
    }
}
