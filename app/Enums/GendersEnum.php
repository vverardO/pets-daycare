<?php

namespace App\Enums;

enum GendersEnum: string
{
    case Male = 'male';
    case Female = 'female';
    case Uninformed = 'uninformed';

    public function getName(string $case)
    {
        return match ($case) {
            'male' => 'Homem',
            'female' => 'Mulher',
            'uninformed' => 'Não informado'
        };
    }
}
