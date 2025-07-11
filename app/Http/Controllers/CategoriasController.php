<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use SebastianBergmann\CodeUnit\FunctionUnit;

class CategoriasController extends Controller
{
    public function index()
    {
        $categorias = Categorias::orderBy('name_category', 'asc')->paginate(5);
        return view("categorias.categorias", compact('categorias'));
    }

    public function create()
    {
        return view('categorias.categoriasCreate');
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('searchTerm');

        $categorias_buscar = Categorias::query();

        if ($searchTerm) {
            $categorias_buscar->where(function ($query) use ($searchTerm) {
                $query->where('name_category', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('tipe_category', 'LIKE', '%' . $searchTerm . '%');
            });
        }

        $categorias_buscar = $categorias_buscar->paginate(5); 

        return view('categorias.categoriasSearch', compact('categorias_buscar')); 
    }

    public function store(Request $request)
    {
        $request->validate([
            'nameCategory' => 'required',
            'tipeCategory' => 'required'
        ]);

        $categorias = new Categorias();
        $categorias->name_category = $request->nameCategory;
        $categorias->tipe_category = $request->tipeCategory;
        $categorias->save();

        return redirect()->route('categorias.index');
    }

    public function edit(Request $request, int $categorias_edit)
    {
        $categorias = Categorias::findOrFail($categorias_edit);
        return view('categorias.categoriasEdit', compact('categorias'));
    }


    public function update(Request $request, $categorias_id)
    {
        $request->validate([
            'nameCategory' => 'required',
            'tipeCategory' => 'required'
        ]);

        $categorias_edit = Categorias::findOrFail($categorias_id);
        $categorias_edit->name_category = $request->nameCategory;
        $categorias_edit->tipe_category = $request->tipeCategory;
        $categorias_edit->save();

        return redirect()->route("categorias.index");
    }

    public function destroyer(Categorias $categorias_eliminar)
    {
        $categorias_eliminar->delete();
        return redirect()->route('categorias.index');
    }
}
