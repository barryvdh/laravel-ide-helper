<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdocCamel\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdocCamel\Models\Post
 *
 * @property integer $id
 * @property string|null $charNullable
 * @property string $charNotNullable
 * @property string|null $stringNullable
 * @property string $stringNotNullable
 * @property string|null $textNullable
 * @property string $textNotNullable
 * @property string|null $mediumTextNullable
 * @property string $mediumTextNotNullable
 * @property string|null $longTextNullable
 * @property string $longTextNotNullable
 * @property integer|null $integerNullable
 * @property integer $integerNotNullable
 * @property integer|null $tinyIntegerNullable
 * @property integer $tinyIntegerNotNullable
 * @property integer|null $smallIntegerNullable
 * @property integer $smallIntegerNotNullable
 * @property integer|null $mediumIntegerNullable
 * @property integer $mediumIntegerNotNullable
 * @property integer|null $bigIntegerNullable
 * @property integer $bigIntegerNotNullable
 * @property integer|null $unsignedIntegerNullable
 * @property integer $unsignedIntegerNotNullable
 * @property integer|null $unsignedTinyIntegerNullable
 * @property integer $unsignedTinyIntegerNotNullable
 * @property integer|null $unsignedSmallIntegerNullable
 * @property integer $unsignedSmallIntegerNotNullable
 * @property integer|null $unsignedMediumIntegerNullable
 * @property integer $unsignedMediumIntegerNotNullable
 * @property integer|null $unsignedBigIntegerNullable
 * @property integer $unsignedBigIntegerNotNullable
 * @property float|null $floatNullable
 * @property float $floatNotNullable
 * @property float|null $doubleNullable
 * @property float $doubleNotNullable
 * @property string|null $decimalNullable
 * @property string $decimalNotNullable
 * @property string|null $unsignedDecimalNullable
 * @property string $unsignedDecimalNotNullable
 * @property integer|null $booleanNullable
 * @property integer $booleanNotNullable
 * @property string|null $enumNullable
 * @property string $enumNotNullable
 * @property string|null $jsonNullable
 * @property string $jsonNotNullable
 * @property string|null $jsonbNullable
 * @property string $jsonbNotNullable
 * @property string|null $dateNullable
 * @property string $dateNotNullable
 * @property string|null $datetimeNullable
 * @property string $datetimeNotNullable
 * @property string|null $datetimetzNullable
 * @property string $datetimetzNotNullable
 * @property string|null $timeNullable
 * @property string $timeNotNullable
 * @property string|null $timetzNullable
 * @property string $timetzNotNullable
 * @property string|null $timestampNullable
 * @property string $timestampNotNullable
 * @property string|null $timestamptzNullable
 * @property string $timestamptzNotNullable
 * @property integer|null $yearNullable
 * @property integer $yearNotNullable
 * @property mixed|null $binaryNullable
 * @property mixed $binaryNotNullable
 * @property string|null $uuidNullable
 * @property string $uuidNotNullable
 * @property string|null $ipaddressNullable
 * @property string $ipaddressNotNullable
 * @property string|null $macaddressNullable
 * @property string $macaddressNotNullable
 * @property \Illuminate\Support\Carbon|null $createdAt
 * @property \Illuminate\Support\Carbon|null $updatedAt
 * @method static \Illuminate\Database\Eloquent\Builder|Post newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Post newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Post query()
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereId($value)
 * @mixin \Eloquent
 */
class Post extends Model
{
}
