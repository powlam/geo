<?php

declare(strict_types=1);

namespace App\Permissions\V1;

use App\Models\User;

final class Abilities
{
    // The asterisk (*) automatically grants access to all abilities.
    public const ALL = '*';

    /**
     * @return array<int, string>
     */
    public static function getAbilities(User $user): array
    {
        return [];
    }
}
