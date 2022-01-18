<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Industry
 *
 * @property int $id
 * @property string|null $name
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Industry newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Industry newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Industry query()
 * @method static \Illuminate\Database\Eloquent\Builder|Industry whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Industry whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Industry whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Industry whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Industry extends Model
{
    use HasFactory;
}
