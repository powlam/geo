<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Powlam\Coordinates\LatLng;
use Powlam\Coordinates\LatLngBounds;

final class Location extends Model
{
    /** @use HasFactory<\Database\Factories\LocationFactory> */
    use HasFactory;

    public $fillable = ['entity_id', 'centerLng', 'centerLat', 'minLng', 'minLat', 'maxLng', 'maxLat'];

    /**
     * @return BelongsTo<Entity, $this>
     */
    public function entity(): BelongsTo
    {
        return $this->belongsTo(Entity::class);
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts()
    {
        return [
            'centerLng' => 'float',
            'centerLat' => 'float',
            'minLng' => 'float',
            'minLat' => 'float',
            'maxLng' => 'float',
            'maxLat' => 'float',
        ];
    }

    /**
     * @return Attribute<?LatLng, array{centerLng: float, centerLat: float}>
     */
    protected function center(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => (! is_array($attributes) || $attributes['centerLat'] === null || $attributes['centerLng'] === null || ! is_float($attributes['centerLat']) || ! is_float($attributes['centerLng'])) ? null : new LatLng($attributes['centerLat'], $attributes['centerLng']),
            set: fn (LatLng $center) => [
                'centerLat' => $center->getLatitude(),
                'centerLng' => $center->getLongitude(),
            ],
        );
    }

    /**
     * @return Attribute<LatLngBounds, array{minLng: float, minLat: float, maxLng: float, maxLat: float}>
     */
    protected function bounds(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => (! is_array($attributes) || $attributes['minLat'] === null || $attributes['minLng'] === null || $attributes['maxLat'] === null || $attributes['maxLng'] === null || ! is_float($attributes['minLat']) || ! is_float($attributes['minLng']) || ! is_float($attributes['maxLat']) || ! is_float($attributes['maxLng'])) ? null : new LatLngBounds(
                new LatLng($attributes['minLat'], $attributes['minLng']),
                new LatLng($attributes['maxLat'], $attributes['maxLng'])
            ),
            set: fn (LatLngBounds $bounds) => [
                'minLat' => $bounds->getSouth(),
                'minLng' => $bounds->getWest(),
                'maxLat' => $bounds->getNorth(),
                'maxLng' => $bounds->getEast(),
            ],
        );
    }
}
