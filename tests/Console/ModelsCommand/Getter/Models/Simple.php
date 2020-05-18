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

    /**
     * @return int
     */
    protected function getProtectedAttributeWithIntReturnPhpdocAttribute()
    {
    }

    protected function getProtectedAttributeWithIntReturnTypeAttribute(): int
    {
    }

    /**
     * @return int
     */
    protected function getProtectedAttributeWithIntReturnTypeAndPhpdocAttribute(): int
    {
    }

    /**
     * @return string
     */
    protected function getProtectedAttributeWithIntReturnTypeAndButPhpdocStringAttribute(): int
    {
    }

    protected function getProtectedAttributeWithoutTypeAttribute()
    {
    }

    /**
     * @return what|ever|we-write/here
     */
    protected function getProtectedAttributeTakesPhpdocLiteralAttribute()
    {
    }

    protected function getProtectedAttributeReturnTypeIntOrNullAttribute(): ?int
    {
    }

    protected function getProtectedAttributeReturnsImportedClassAttribute(): DateTime
    {
    }

    protected function getProtectedAttributeReturnsFqnClassAttribute(): \Illuminate\Support\Facades\Date
    {
    }

    protected function getProtectedAttributeReturnsArrayAttribute(): array
    {
    }

    protected function getProtectedAttributeReturnsNullableArrayAttribute(): ?array
    {
    }

    protected function getProtectedAttributeReturnsStdClassAttribute(): \stdClass
    {
    }

    protected function getProtectedAttributeReturnsNullableStdClassAttribute(): ?\stdClass
    {
    }

    protected function getProtectedAttributeReturnsBoolAttribute(): bool
    {
    }

    protected function getProtectedAttributeReturnsNullableBoolAttribute(): ?bool
    {
    }

    protected function getProtectedAttributeReturnsFloatAttribute(): bool
    {
    }

    protected function getProtectedAttributeReturnsNullableFloatAttribute(): ?bool
    {
    }

    protected function getProtectedAttributeReturnsCallableAttribute(): callable
    {
    }

    protected function getProtectedAttributeReturnsNullableCallableAttribute(): ?callable
    {
    }

    /**
     * Doesn't make sense, but…
     */
    protected function getProtectedAttributeReturnsVoidAttribute(): void
    {
    }
}
