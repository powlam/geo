<?php

declare(strict_types=1);

use App\Models\Language;
use Illuminate\Database\UniqueConstraintViolationException;

test('to array', function (): void {
    $language = Language::factory()->create()->refresh();

    expect(array_keys($language->toArray()))->toBe([
        'id',
        'code',
        'name',
        'endonym',
        'created_at',
        'updated_at',
    ]);
});

test('the language codes cannot be duplicated', function (): void {
    Language::factory()->create(['code' => 'abc']);
    Language::factory()->create(['code' => 'abc']);
})->throws(UniqueConstraintViolationException::class);
