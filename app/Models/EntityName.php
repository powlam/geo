<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\NameType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class EntityName extends Model
{
    /** @use HasFactory<\Database\Factories\EntityNameFactory> */
    use HasFactory;

    public $fillable = ['entity_id', 'name', 'language_id', 'type', 'isLocal'];

    /**
     * @return BelongsTo<Entity, $this>
     */
    public function entity(): BelongsTo
    {
        return $this->belongsTo(Entity::class);
    }

    /**
     * @return BelongsTo<Language, $this>
     */
    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts()
    {
        return [
            'type' => NameType::class,
            'isLocal' => 'bool',
        ];
    }
}
