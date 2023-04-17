<?php

namespace App\Http\Requests\Pets;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StorePetRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'max:64'],
            'description' => ['sometimes'],
            'pet_type_id' => ['required', 'exists:pet_types,id'],
            'owner_id' => ['required', 'exists:owners,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Informe o nome',
            'name.max' => 'Tamanho excedido',
            'pet_type_id.required' => 'Informe um tipo de pet',
            'pet_type_id.exists' => 'Tipo do pet inexistente',
            'owner_id.required' => 'Informe um dono',
            'owner_id.exists' => 'Dono inexistente',
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
