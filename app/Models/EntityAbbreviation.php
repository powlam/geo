<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\AbbreviationType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class EntityAbbreviation extends Model
{
    /** @use HasFactory<\Database\Factories\EntityAbbreviationFactory> */
    use HasFactory;

    public $fillable = ['entity_id', 'type', 'abbreviation'];

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
            'type' => AbbreviationType::class,
        ];
    }
}
