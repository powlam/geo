<?php

declare(strict_types=1);

namespace App\Http\Resources\V1;

use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Language
 */
final class LanguageResource extends JsonResource
{
    public function __construct(Language $resource)
    {
        parent::__construct($resource);
    }

    /**
     * Transform the resource into an array.
     *
     * @see jsonapi.org/format/#document-structure
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'language',
            'id' => $this->id,
            'attributes' => [
                'code' => $this->code,
                'name' => $this->name,
                'endonym' => $this->endonym,
                'createdAt' => $this->created_at,
                'updatedAt' => $this->updated_at,
            ],
            'links' => [
                'self' => route('languages.show', ['language' => $this->id]),
            ],
        ];
    }
}
