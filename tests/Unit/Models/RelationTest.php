<?php

declare(strict_types=1);

use App\Models\Entity;
use App\Models\Relation;

test('to array', function (): void {
    $relation = Relation::factory()->create()->refresh();

    expect(array_keys($relation->toArray()))->toBe([
        'id',
        'contained_id',
        'container_id',
        'relation',
        'contained_level',
        'container_level',
        'created_at',
        'updated_at',
    ]);
});

it('belongs to 2 entities: contained and container', function (): void {
    $relation = Relation::factory()->create()->refresh();

    expect($relation->contained)->toBeInstanceOf(Entity::class);
    expect($relation->container)->toBeInstanceOf(Entity::class);
});

test('the contained entity sees UPWARD the relation and the container entity', function (): void {
    $relation = Relation::factory()->create()->refresh();

    expect($relation->contained->upwardRelations->pluck('id'))->toContain($relation->id);
    expect($relation->contained->upwardEntities->pluck('id'))->toContain($relation->container->id);
});

test('the container entity sees DOWNWARD the relation and the contained entity', function (): void {
    $relation = Relation::factory()->create()->refresh();

    expect($relation->container->downwardRelations->pluck('id'))->toContain($relation->id);
    expect($relation->container->downwardEntities->pluck('id'))->toContain($relation->contained->id);
});
