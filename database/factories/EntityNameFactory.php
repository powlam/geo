<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\NameType;
use App\Models\Entity;
use App\Models\Language;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EntityName>
 */
final class EntityNameFactory extends Factory
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
            'name' => fake()->word(),
            'language_id' => Language::factory(),
            'type' => fake()->randomElement(NameType::cases()),
            'isLocal' => fake()->boolean(),
        ];
    }
}
