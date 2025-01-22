<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Entity;
use App\Models\Language;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EntityLanguage>
 */
final class EntityLanguageFactory extends Factory
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
            'language_id' => Language::factory(),
        ];
    }
}
