<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($this->user()->id)],
            'apellido' => ['nullable', 'string', 'max:255'],
            'telefono' => ['nullable', 'string', 'max:20'],
            'foto_perfil' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'foto_perfil.image' => 'El archivo debe ser una imagen válida.',
            'foto_perfil.mimes' => 'La imagen debe ser de tipo: jpeg, png, jpg o gif.',
            'foto_perfil.max' => 'La imagen no debe pesar más de 2MB.',
        ];
    }
}