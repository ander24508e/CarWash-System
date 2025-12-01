<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.profileEdit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        
        // Llenar datos validados (excepto foto)
        $user->fill($request->safe()->except('foto_perfil'));

        // Manejar subida de foto - CORREGIDO
        if ($request->hasFile('foto_perfil')) {
            $file = $request->file('foto_perfil');
            
            // Verificar que el archivo es válido
            if ($file && $file->isValid()) {
                // Eliminar foto anterior si existe
                if ($user->foto_perfil && Storage::disk('public')->exists($user->foto_perfil)) {
                    Storage::disk('public')->delete($user->foto_perfil);
                }

                // Crear nombre único para el archivo
                $fileName = 'profile-' . $user->id . '-' . time() . '.' . $file->getClientOriginalExtension();
                
                // Guardar y asignar directamente - SINTAXIS CORRECTA
                $path = $file->storeAs('fotos_perfil', $fileName, 'public');
                $user->foto_perfil = $path;
            }
        }

        // Invalidar verificación de email si cambió
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        // Eliminar foto de perfil si existe
        if ($user->foto_perfil) {
            Storage::disk('public')->delete($user->foto_perfil);
        }

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}