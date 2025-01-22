<?php

declare(strict_types=1);

use App\Models\Entity;
use App\Models\EntityAbbreviation;

test('to array', function (): void {
    $entityAbbreviation = EntityAbbreviation::factory()->create()->refresh();

    expect(array_keys($entityAbbreviation->toArray()))->toBe([
        'id',
        'entity_id',
        'type',
        'abbreviation',
        'created_at',
        'updated_at',
    ]);
});

it('belongs to an entity', function (): void {
    $entityAbbreviation = EntityAbbreviation::factory()->create()->refresh();

    expect($entityAbbreviation->entity)->toBeInstanceOf(Entity::class);
});
