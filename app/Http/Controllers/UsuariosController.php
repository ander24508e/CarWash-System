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
        // Solo admin puede gestionar usuarios
        $this->middleware(['auth', 'role:admin']);
    }

    public function index()
    {
        // Obtener todos los usuarios con sus roles
        $usuarios = User::with('roles')->paginate(10);
        
        return view('administracion.usuarios.usuarios', compact('usuarios'));
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

        // Crear usuario
        $usuario = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Asignar rol
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

        return view('administracion.usuarios.usuariosSearch', compact('usuarios_buscar'));
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
        
        // Actualizar datos básicos
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        
        // Actualizar contraseña si se proporciona
        if ($request->filled('password')) {
            $usuario->password = Hash::make($request->password);
        }
        
        $usuario->save();
        
        // Sincronizar roles (eliminar todos y asignar el nuevo)
        $usuario->syncRoles([$request->rol]);

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario actualizado correctamente.');
    }

    public function destroy($id)
    {
        // No permitir eliminar al propio usuario admin
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