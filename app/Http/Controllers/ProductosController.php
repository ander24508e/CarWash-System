<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use App\Models\Productos;
use Illuminate\Http\Request;

class ProductosController extends Controller
{
    public function index()
    {
        $productos = Productos::orderBy('id', 'asc')->paginate(5);
        return view("inventario.productos.productos", compact('productos'));
    }

    public function create()
    {
        $categorias = Categorias::all();
        return view('inventario.productos.productosCreate', compact('categorias'));
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('searchTerm');

        $productos_buscar = Productos::query();

        if ($searchTerm) {
            $productos_buscar->where(function ($query) use ($searchTerm) {
                $query->where('name_product', 'LIKE', '%' . $searchTerm . '%');
            });
        }

        $productos_buscar = $productos_buscar->paginate(5);

        return view('inventario.productos.productosSearch', compact('productos_buscar'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nameProduct' => 'required',
            'nameCategoria' => 'required',
            'stock' => 'required',
            'presentation' => 'required',
            'description' => 'required',
            'brand' => 'required',
            'supplier' => 'required',
            'precio_compra' => 'required|numeric',
            'precio_venta' => 'required|numeric'
        ]);

        $productos = new Productos();
        $productos->name_product = $request->nameProduct;
        $productos->name_categoria = $request->nameCategoria;
        $productos->stock = $request->stock;
        $productos->presentation = $request->presentation;
        $productos->description = $request->description;
        $productos->brand = $request->brand;
        $productos->supplier = $request->supplier;
        $productos->precio_compra = $request->precio_compra;
        $productos->precio_venta = $request->precio_venta;
        $productos->save();

        return redirect()->route('productos.index');
    }

    public function update(Request $request, $productos_id)
    {
        $request->validate([
            'nameProduct' => 'required',
            'nameCategoria' => 'required',
            'stock' => 'required',
            'presentation' => 'required',
            'description' => 'required',
            'brand' => 'required',
            'supplier' => 'required',
            'precio_compra' => 'required|numeric',
            'precio_venta' => 'required|numeric'
        ]);

        $productos = Productos::findOrFail($productos_id);
        $productos->name_product = $request->nameProduct;
        $productos->name_categoria = $request->nameCategoria;
        $productos->stock = $request->stock;
        $productos->presentation = $request->presentation;
        $productos->description = $request->description;
        $productos->brand = $request->brand;
        $productos->supplier = $request->supplier;
        $productos->precio_compra = $request->precio_compra;
        $productos->precio_venta = $request->precio_venta;
        $productos->save();

        return redirect()->route('productos.index');
    }

    public function edit(Request $request, int $productos_edit)
    {
        $productos = Productos::findOrFail($productos_edit);
        $categorias = Categorias::all();
        return view('inventario.productos.productosEdit', compact('productos', 'categorias'));
    }

    public function destroyer(Productos $productos_eliminar)
    {
        $productos_eliminar->delete();
        return redirect()->route('productos.index');
    }
}