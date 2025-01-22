<?php

declare(strict_types=1);

namespace App\Enums;

enum NameType: int
{
    case Short = 1;
    case Long = 2;
    case Formal = 3;
    case Popular = 4;
}
