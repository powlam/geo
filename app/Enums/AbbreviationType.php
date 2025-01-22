<?php

declare(strict_types=1);

namespace App\Enums;

enum AbbreviationType: string
{
    case ISO1num = 'ISO1num';
    case ISO1alfa2 = 'ISO1alfa2';
    case ISO2 = 'ISO2';
    case ISO1alfa3 = 'ISO1alfa3';
    case IOC = 'IOC';
    case FIFA = 'FIFA';
}
