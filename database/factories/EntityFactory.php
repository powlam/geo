<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\EntityType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Entity>
 */
final class EntityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'slug' => fake()->slug(),
            'type' => fake()->randomElement(EntityType::cases()),
            'kml' => fake()->filePath(),
            'note' => fake()->text(),
        ];
    }
}
