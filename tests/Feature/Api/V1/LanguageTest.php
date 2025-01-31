<?php

declare(strict_types=1);

use App\Models\Language;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

test('authentication required', function (): void {
    $response = $this->get('/api/v1/languages');

    $response->assertStatus(302);
});

it('returns all the languages (paginated)', function (): void {
    Language::factory(20)->create();
    Sanctum::actingAs(User::factory()->create());

    $response = $this->get('/api/v1/languages');

    $response->assertStatus(200);
    $jsonResponse = json_decode($response->content());
    expect(count($jsonResponse->data))->toBe(15); // max perPage
    expect($jsonResponse->links->next)->toContain('page=2');

    $response = $this->get($jsonResponse->links->next);

    $response->assertStatus(200);
    $jsonResponse = json_decode($response->content());
    expect(count($jsonResponse->data))->toBe(5); // the remaining 20 - 15
    expect($jsonResponse->links->next)->toBeNull();
});

it('returns the content of one language', function (): void {
    $language = Language::factory()->create()->refresh();
    Sanctum::actingAs(User::factory()->create());

    $response = $this->get('/api/v1/languages/'.$language->id);

    $response->assertStatus(200);
    $jsonResponse = json_decode($response->content());
    expect($jsonResponse->data->type)->toBe('language');
    expect($jsonResponse->data->id)->toBe($language->id);
});
