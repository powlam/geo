<?php

declare(strict_types=1);

use App\Enums\AbbreviationType;
use App\Models\Entity;
use App\Models\EntityAbbreviation;
use App\Models\EntityLanguage;
use App\Models\EntityName;
use App\Models\Flag;
use App\Models\Language;
use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\UniqueConstraintViolationException;

test('to array', function (): void {
    $entity = Entity::factory()->create()->refresh();

    expect(array_keys($entity->toArray()))->toBe([
        'id',
        'slug',
        'type',
        'kml',
        'note',
        'created_at',
        'updated_at',
    ]);
});

it('may have one flag', function (): void {
    $entity = Entity::factory()->hasFlag()->create()->refresh();

    expect($entity->flag)->toBeInstanceOf(Flag::class);
});

it('may have relations and related entities', function (): void {
    $entity = Entity::factory()->hasDownwardRelations(3)->hasUpwardRelations(2)->create()->refresh();

    expect($entity->downwardRelations->count())->toBe(3);
    expect($entity->upwardRelations->count())->toBe(2);
    expect($entity->downwardEntities->count())->toBe(3);
    expect($entity->upwardEntities->count())->toBe(2);
});

it('may have a location', function (): void {
    $entity = Entity::factory()->hasLocation()->create()->refresh();

    expect($entity->location)->toBeInstanceOf(Location::class);
});

it('may have abbreviations', function (): void {
    $entity = Entity::factory()->hasEntityAbbreviations(3, new Sequence(
        ['type' => AbbreviationType::FIFA],
        ['type' => AbbreviationType::ISO1alfa2],
        ['type' => AbbreviationType::ISO1alfa3],
    ))->create()->refresh();

    expect($entity->entityAbbreviations->count())->toBe(3);
    expect($entity->entityAbbreviations)->toContainOnlyInstancesOf(EntityAbbreviation::class);
});

it('cannot have 2 abbreviations of the same type', function (): void {
    Entity::factory()->hasEntityAbbreviations(2, ['type' => AbbreviationType::FIFA])->create();
})->throws(UniqueConstraintViolationException::class);

it('does not allow the same abbreviation of the same type for different entities', function (): void {
    Entity::factory()->hasEntityAbbreviations(1, ['type' => AbbreviationType::FIFA, 'abbreviation' => 'test'])->create();
    Entity::factory()->hasEntityAbbreviations(1, ['type' => AbbreviationType::FIFA, 'abbreviation' => 'test'])->create();
})->throws(UniqueConstraintViolationException::class);

it('may have names', function (): void {
    $entity = Entity::factory()->hasEntityNames(3)->create()->refresh();

    expect($entity->entityNames->count())->toBe(3);
    expect($entity->entityNames)->toContainOnlyInstancesOf(EntityName::class);
});

it('may have languages', function (): void {
    $entity = Entity::factory()->hasEntityLanguages(3)->create()->refresh();

    expect($entity->entityLanguages->count())->toBe(3);
    expect($entity->entityLanguages)->toContainOnlyInstancesOf(EntityLanguage::class);
});

it('cannot be related twice with the same language', function (): void {
    $language = Language::factory()->create();
    Entity::factory()->hasEntityLanguages(2, ['language_id' => $language->id])->create();
})->throws(UniqueConstraintViolationException::class);
