<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\EntityType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;

final class Entity extends Model
{
    /** @use HasFactory<\Database\Factories\EntityFactory> */
    use HasFactory;

    public $fillable = ['slug', 'type', 'kml', 'note'];

    /**
     * @return HasOne<Flag, $this>
     */
    public function flag(): HasOne
    {
        return $this->hasOne(Flag::class);
    }

    /**
     * @return HasMany<Relation, $this>
     */
    public function upwardRelations(): HasMany
    {
        return $this->hasMany(Relation::class, 'contained_id');
    }

    /**
     * @return HasMany<Relation, $this>
     */
    public function downwardRelations(): HasMany
    {
        return $this->hasMany(Relation::class, 'container_id');
    }

    /**
     * @return HasManyThrough<Entity, Relation, $this>
     */
    public function upwardEntities(): HasManyThrough
    {
        return $this->hasManyThrough(self::class, Relation::class, 'contained_id', 'id', 'id', 'container_id');
    }

    /**
     * @return HasManyThrough<Entity, Relation, $this>
     */
    public function downwardEntities(): HasManyThrough
    {
        return $this->hasManyThrough(self::class, Relation::class, 'container_id', 'id', 'id', 'contained_id');
    }

    /**
     * @return HasOne<Location, $this>
     */
    public function location(): HasOne
    {
        return $this->hasOne(Location::class);
    }

    /**
     * @return HasMany<EntityAbbreviation, $this>
     */
    public function entityAbbreviations(): HasMany
    {
        return $this->hasMany(EntityAbbreviation::class);
    }

    /**
     * @return HasMany<EntityName, $this>
     */
    public function entityNames(): HasMany
    {
        return $this->hasMany(EntityName::class);
    }

    /**
     * @return HasMany<EntityLanguage, $this>
     */
    public function entityLanguages(): HasMany
    {
        return $this->hasMany(EntityLanguage::class);
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts()
    {
        return [
            'type' => EntityType::class,
        ];
    }
}
