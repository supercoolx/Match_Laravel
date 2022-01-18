<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Channel
 *
 * @property int $id
 * @property int|null $project_id
 * @property int|null $user_id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property int $deleted
 * @method static \Illuminate\Database\Eloquent\Builder|Channel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Channel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Channel query()
 * @method static \Illuminate\Database\Eloquent\Builder|Channel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Channel whereDeleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Channel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Channel whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Channel whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Channel whereUserId($value)
 * @mixin \Eloquent
 */
class Channel extends Model
{
    use HasFactory;

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('deleted', function (Builder $builder) {
            $builder->where('deleted', 0);
        });
    }

    protected $fillable = [
        'project_id',
        'user_id',
    ];
}
