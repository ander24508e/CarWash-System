<?php

namespace App\Http\Controllers;

use App\Models\venta;
use Illuminate\Http\Request;

class VentasController extends Controller
{
    public function index()
    {
        $ventas = venta::with('user') // Carga la relación
            ->orderBy('id', direction: 'asc')
            ->paginate(10);

        return view("contabilidad.ventas.ventas", compact('ventas'));
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('searchTerm');

        $ventas_buscar = venta::query();

        if ($searchTerm) {
            $ventas_buscar->where(function ($query) use ($searchTerm) {
                $query->where('product', 'LIKE', '%' . $searchTerm . '%');
            });
        }

        $ventas_buscar = $ventas_buscar->paginate(10); // Mismo número que en el index

        return view('contabilidad.ventas.ventasSearch', compact('ventas_buscar'));
    }

        public function create()
    {
        $ventas = venta::all();
        return view('contabilidad.ventas.ventasCreate', compact('ventas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user' => 'required',
            'product' => 'required',
            'description' => 'required',
            'total' => 'required|numeric',
            'sale_date' => 'required|date'
        ]);

        $ventas = new ventas();
        $ventas->user = $request->user;
        $ventas->product = $request->product;
        $ventas->description = $request->description;
        $ventas->total = $request->total;
        $ventas->sale_date = $request->sale_date;
        $ventas->save();

        return redirect()->route('ventas.index')->with('success', 'Venta registrada exitosamente.');
    }





}
