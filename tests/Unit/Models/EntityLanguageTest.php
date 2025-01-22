<?php

declare(strict_types=1);

use App\Models\Entity;
use App\Models\EntityLanguage;
use App\Models\Language;

test('to array', function (): void {
    $entityLanguage = EntityLanguage::factory()->create()->refresh();

    expect(array_keys($entityLanguage->toArray()))->toBe([
        'id',
        'entity_id',
        'language_id',
        'created_at',
        'updated_at',
    ]);
});

it('belongs to an entity', function (): void {
    $entityLanguage = EntityLanguage::factory()->create()->refresh();

    expect($entityLanguage->entity)->toBeInstanceOf(Entity::class);
});

it('belongs to a language', function (): void {
    $entityLanguage = EntityLanguage::factory()->create()->refresh();

    expect($entityLanguage->language)->toBeInstanceOf(Language::class);
});
