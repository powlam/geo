<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class Relation extends Model
{
    /** @use HasFactory<\Database\Factories\RelationFactory> */
    use HasFactory;

    public $fillable = ['contained_id', 'container_id', 'relation', 'contained_level', 'container_level', 'info'];

    /**
     * @return BelongsTo<Entity, $this>
     */
    public function contained(): BelongsTo
    {
        return $this->belongsTo(Entity::class, 'contained_id');
    }

    /**
     * @return BelongsTo<Entity, $this>
     */
    public function container(): BelongsTo
    {
        return $this->belongsTo(Entity::class, 'container_id');
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts()
    {
        return [
            'contained_level' => 'int',
            'container_level' => 'int',
        ];
    }
}
