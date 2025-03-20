<?php

namespace App\Enums;

enum Themes: String
{
    case technology = 'Tecnologia';
    case cultural = 'Cultura';
    case musical = 'Música';
    case art = 'Arte';
    case sports = 'Esportes';
    case gastronomy = 'Gastronomia';
    case health = 'Saúde e Bem-estar';

    public static function toArray(): array {
        return array_column(self::cases(), 'value');
    }

}
