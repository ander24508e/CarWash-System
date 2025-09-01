<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use Illuminate\Http\Request;

class ClientesController extends Controller
{
    public function index()
    {
        $clientes = Clientes::orderBy('id', 'asc')->paginate(10);
        return view("contabilidad.clientes.clientes", compact('clientes'));
    }

    public function create()
    {
        return view('contabilidad.clientes.clientesCreate');
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('searchTerm');

        $clientes_buscar = Clientes::query();

        if ($searchTerm) {
            $clientes_buscar->where(function ($query) use ($searchTerm) {
                $query->where('name_customer', 'LIKE', '%' . $searchTerm . '%');
                $query->where('lastname_customer', 'LIKE', '%' . $searchTerm . '%');
                $query->where('identification', 'LIKE', '%' . $searchTerm . '%');
            });
        }

        $clientes_buscar = $clientes_buscar->paginate(5);

        return view('contabilidad.clientes.clientesSearch', compact('clientes_buscar'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'nameCustomer' => 'required',
            'lastnameCustomer' => 'required',
            'identification' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required'
        ]);

        $clientes = new Clientes();
        $clientes->name_customer = $request->nameCustomer;
        $clientes->lastname_customer = $request->lastnameCustomer;
        $clientes->identification = $request->identification;
        $clientes->email = $request->email;
        $clientes->phone = $request->phone;
        $clientes->address = $request->address;
        $clientes->save();

        return redirect()->route('clientes.index');
    }


    public function update(Request $request, $clientes_id)
    {
        $request->validate([
            'nameCustomer' => 'required',
            'lastnameCustomer' => 'required',
            'identification' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required'
        ]);

        $clientes = Clientes::findOrFail($clientes_id);
        $clientes->name_customer = $request->nameCustomer;
        $clientes->lastname_customer = $request->lastnameCustomer;
        $clientes->identification = $request->identification;
        $clientes->email = $request->email;
        $clientes->phone = $request->phone;
        $clientes->address = $request->address; 
        $clientes->save();

        return redirect()->route('clientes.index');
    }

    public function edit(Request $request, int $clientes_edit)
    {
        $clientes = Clientes::findOrFail($clientes_edit);
        return view('contabilidad.clientes.clientesEdit', compact('clientes'));
    }

    public function destroyer(Clientes $clientes_eliminar)
    {
        $clientes_eliminar->delete();
        return redirect()->route('clientes.index');
    }
}
