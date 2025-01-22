<?php

declare(strict_types=1);

use App\Models\Entity;
use App\Models\EntityName;
use App\Models\Language;

test('to array', function (): void {
    $entityName = EntityName::factory()->create()->refresh();

    expect(array_keys($entityName->toArray()))->toBe([
        'id',
        'entity_id',
        'name',
        'language_id',
        'type',
        'isLocal',
        'created_at',
        'updated_at',
    ]);
});

it('belongs to an entity', function (): void {
    $entityName = EntityName::factory()->create()->refresh();

    expect($entityName->entity)->toBeInstanceOf(Entity::class);
});

it('belongs to a language', function (): void {
    $entityName = EntityName::factory()->create()->refresh();

    expect($entityName->language)->toBeInstanceOf(Language::class);
});
