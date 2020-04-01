<?php declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Getter\Models;

use DateTime;
use Illuminate\Database\Eloquent\Model;

class Simple extends Model
{
    /**
     * @return int
     */
    public function getAttributeWithIntReturnPhpdocAttribute()
    {
    }

    public function getAttributeWithIntReturnTypeAttribute(): int
    {
    }

    /**
     * @return int
     */
    public function getAttributeWithIntReturnTypeAndPhpdocAttribute(): int
    {
    }

    /**
     * @return string
     */
    public function getAttributeWithIntReturnTypeAndButPhpdocStringAttribute(): int
    {
    }

    public function getAttributeWithoutTypeAttribute()
    {
    }

    /**
     * @return what|ever|we-write/here
     */
    public function getAttributeTakesPhpdocLiteralAttribute()
    {
    }

    public function getAttributeReturnTypeIntOrNullAttribute(): ?int
    {
    }

    public function getAttributeReturnsImportedClassAttribute(): DateTime
    {
    }

    public function getAttributeReturnsFqnClassAttribute(): \Illuminate\Support\Facades\Date
    {
    }

    public function getAttributeReturnsArrayAttribute(): array
    {
    }

    public function getAttributeReturnsNullableArrayAttribute(): ?array
    {
    }

    public function getAttributeReturnsStdClassAttribute(): \stdClass
    {
    }

    public function getAttributeReturnsNullableStdClassAttribute(): ?\stdClass
    {
    }

    public function getAttributeReturnsBoolAttribute(): bool
    {
    }

    public function getAttributeReturnsNullableBoolAttribute(): ?bool
    {
    }

    public function getAttributeReturnsFloatAttribute(): bool
    {
    }

    public function getAttributeReturnsNullableFloatAttribute(): ?bool
    {
    }

    public function getAttributeReturnsCallableAttribute(): callable
    {
    }

    public function getAttributeReturnsNullableCallableAttribute(): ?callable
    {
    }

    /**
     * Doesn't make sense, but…
     */
    public function getAttributeReturnsVoidAttribute(): void
    {
    }
}
