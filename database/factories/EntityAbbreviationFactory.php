<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\AbbreviationType;
use App\Models\Entity;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EntityAbbreviation>
 */
final class EntityAbbreviationFactory extends Factory
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
            'type' => fake()->randomElement(AbbreviationType::cases()),
            'abbreviation' => fake()->text(5),
        ];
    }
}
