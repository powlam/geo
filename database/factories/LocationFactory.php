<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Entity;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Location>
 */
final class LocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'entity_id' => Entity::factory(),
            'centerLng' => fake()->randomFloat(min: -180.0, max: 180.0),
            'centerLat' => fake()->randomFloat(min: -90.0, max: 90.0),
            'minLng' => ($west = fake()->randomFloat(min: -180.0, max: 180.0)),
            'minLat' => ($south = fake()->randomFloat(min: -90.0, max: 90.0)),
            'maxLng' => fake()->randomFloat(min: $west, max: 180.0),
            'maxLat' => fake()->randomFloat(min: $south, max: 90.0),
        ];
    }
}
