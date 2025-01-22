<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Entity;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Relation>
 */
final class RelationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'contained_id' => Entity::factory(),
            'container_id' => Entity::factory(),
            'relation' => fake()->word(),
            'contained_level' => fake()->numberBetween(0, 5),
            'container_level' => fake()->numberBetween(0, 5),
        ];
    }
}
