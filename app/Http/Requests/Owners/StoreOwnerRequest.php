<?php

namespace App\Http\Requests\Owners;

use App\Enums\GendersEnum;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rules\Enum;

class StoreOwnerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'max:128'],
            'general_record' => ['required', 'digits:10', 'unique:owners'],
            'registration_physical_person' => ['required', 'size:11', 'unique:owners'],
            'birth_date' => ['required', 'date_format:Y-m-d'],
            'gender' => ['required', new Enum(GendersEnum::class)],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Informe o nome',
            'name.max' => 'Tamanho excedido',
            'general_record.required' => 'Informe o RG',
            'general_record.digits' => 'Tamanho excedido',
            'general_record.unique' => 'Registro já existe',
            'registration_physical_person.required' => 'Informe o CPF',
            'registration_physical_person.size' => 'Tamanho excedido',
            'registration_physical_person.unique' => 'Registro já existe',
            'birth_date.required' => 'Informe a data de nascimento',
            'birth_date.date_format' => 'Formato inválido',
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
