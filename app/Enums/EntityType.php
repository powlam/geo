<?php

declare(strict_types=1);

namespace App\Enums;

enum EntityType: int
{
    case Subentity = 1;
    case DoubtfulState = 2;
    case DependentState = 3;
    case State = 4;
    case Grouper = 5;
    case SpecificOrganism = 6;
    case RegionalOrganism = 7;
    case GlobalOrganism = 8;
    case Continent = 9;
}
