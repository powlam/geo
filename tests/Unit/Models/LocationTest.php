<?php

declare(strict_types=1);

use App\Models\Entity;
use App\Models\Location;
use Powlam\Coordinates\LatLng;
use Powlam\Coordinates\LatLngBounds;

test('to array', function (): void {
    $location = Location::factory()->create()->refresh();

    expect(array_keys($location->toArray()))->toBe([
        'id',
        'entity_id',
        'centerLng',
        'centerLat',
        'minLng',
        'minLat',
        'maxLng',
        'maxLat',
        'created_at',
        'updated_at',
    ]);
});

it('belongs to an entity', function (): void {
    $location = Location::factory()->create()->refresh();

    expect($location->entity)->toBeInstanceOf(Entity::class);
});

it('returns its center as a LatLng', function (): void {
    $location = Location::factory()->create()->refresh();

    expect($location->center)->toBeInstanceOf(LatLng::class);
});

it('returns its bounds as a LatLngBounds', function (): void {
    $location = Location::factory()->create()->refresh();

    expect($location->bounds)->toBeInstanceOf(LatLngBounds::class);
});

it('does not return its center or bounds if it is unknown', function (): void {
    $location = Location::factory()->create(['centerLng' => null, 'minLng' => null])->refresh();

    expect($location->center)->toBeNull();
    expect($location->bounds)->toBeNull();
});
