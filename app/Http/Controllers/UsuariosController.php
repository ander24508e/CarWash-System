<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UsuariosController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin']);
    }

    public function index(Request $request)
    {
        // Iniciar query
        $query = User::with('roles');

        // ✅ FILTRO POR ROL (NUEVO)
        if ($request->filled('rol') && $request->rol !== 'todos') {
            $query->role($request->rol);
        }

        // ✅ BÚSQUEDA (NUEVO)
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'LIKE', '%' . $request->search . '%')
                  ->orWhere('email', 'LIKE', '%' . $request->search . '%');
            });
        }

        $usuarios = $query->paginate(10)->appends($request->query());
        $roles = Role::all(); // ✅ PASAR ROLES A LA VISTA
        
        return view('administracion.usuarios.usuarios', compact('usuarios', 'roles'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('administracion.usuarios.usuariosCreate', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'rol' => 'required|exists:roles,name'
        ]);

        $usuario = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $usuario->assignRole($request->rol);

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario creado correctamente.');
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('searchTerm');

        $usuarios_buscar = User::with('roles');

        if ($searchTerm) {
            $usuarios_buscar->where(function ($query) use ($searchTerm) {
                $query->where('name', 'LIKE', '%' . $searchTerm . '%')
                      ->orWhere('email', 'LIKE', '%' . $searchTerm . '%');
            });
        }

        $usuarios_buscar = $usuarios_buscar->paginate(10);
        $roles = Role::all(); // ✅ AGREGAR ESTO

        return view('administracion.usuarios.usuariosSearch', compact('usuarios_buscar', 'roles'));
    }

    public function edit($id)
    {
        $usuario = User::with('roles')->findOrFail($id);
        $roles = Role::all();
        
        return view('administracion.usuarios.usuariosEdit', compact('usuario', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
            'rol' => 'required|exists:roles,name'
        ]);

        $usuario = User::findOrFail($id);
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        
        if ($request->filled('password')) {
            $usuario->password = Hash::make($request->password);
        }
        
        $usuario->save();
        $usuario->syncRoles([$request->rol]);

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario actualizado correctamente.');
    }

    public function destroy($id)
    {
        if (auth()->id() == $id) {
            return redirect()->route('usuarios.index')
                ->with('error', 'No puedes eliminar tu propia cuenta.');
        }
        
        $usuario = User::findOrFail($id);
        $usuario->delete();

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario eliminado correctamente.');
    }
}