<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Week
 *
 * @property int $id
 * @property string|null $name
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Week newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Week newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Week query()
 * @method static \Illuminate\Database\Eloquent\Builder|Week whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Week whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Week whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Week whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Week extends Model
{
    use HasFactory;
}
