<?php

namespace App\Http\Requests\Users;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'max:128'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:6'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Informe o nome',
            'name.max' => 'Tamanho excedido',
            'email.required' => 'Informe o email',
            'email.email' => 'Email inválido',
            'email.unique' => 'Registro já existe',
            'password.required' => 'Informe a senha',
            'password.min' => 'Necessário no mínimo :min dígitos',
        ];
    }

    public function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(
            response()->json([
                'success' => false,
                'message' => 'Revise os campos',
                'data' => $validator->errors(),
            ])
        );
    }
}
