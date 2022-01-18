<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ContractType
 *
 * @property int $id
 * @property string|null $name
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ContractType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractType query()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ContractType extends Model
{
    use HasFactory;
}
