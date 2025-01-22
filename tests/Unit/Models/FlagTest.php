<?php

declare(strict_types=1);

use App\Models\Entity;
use App\Models\Flag;

test('to array', function (): void {
    $flag = Flag::factory()->create()->refresh();

    expect(array_keys($flag->toArray()))->toBe([
        'id',
        'entity_id',
        'small',
        'big',
        'info',
        'created_at',
        'updated_at',
    ]);
});

it('belongs to an entity', function (): void {
    $flag = Flag::factory()->create()->refresh();

    expect($flag->entity)->toBeInstanceOf(Entity::class);
});
