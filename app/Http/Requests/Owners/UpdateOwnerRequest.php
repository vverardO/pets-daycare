<?php

namespace App\Http\Requests\Owners;

use App\Enums\GendersEnum;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class UpdateOwnerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'max:128'],
            'general_record' => [
                'sometimes',
                'digits:10',
                Rule::unique('owners', 'general_record')->ignore($this->general_record),
            ],
            'registration_physical_person' => [
                'sometimes',
                'size:11',
                Rule::unique('owners', 'registration_physical_person')->ignore($this->registration_physical_person),
            ],
            'birth_date' => ['sometimes', 'date:format,d/m/Y'],
            'gender' => ['sometimes', new Enum(GendersEnum::class)],
        ];
    }

    public function messages(): array
    {
        return [
            'name.max' => 'Tamanho excedido',
            'general_record.digits' => 'Tamanho excedido',
            'general_record.unique' => 'Registro já existe',
            'registration_physical_person.size' => 'Tamanho excedido',
            'registration_physical_person.unique' => 'Registro já existe',
            'birth_date.date' => 'Formato inválido',
            'gender' => 'Opção inválida',
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
