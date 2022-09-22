<?php

namespace App\Enum;

enum TipoEmail:string {
    case PESSOAL = 'Pessoal';
    case COMERCIAL   = 'Comercial';
    case OUTROS   = 'outros';
}
