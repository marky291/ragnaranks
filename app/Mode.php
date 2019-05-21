<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ServerModes
 *
 * @property int $id
 * @property string $tag
 * @property string $name
 * @property string $description
 * @property Carbon $updated_at
 * @property Carbon $created_at
 * @package App
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Mode newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Mode newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Mode query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Mode whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Mode whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Mode whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Mode whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Mode whereTag($value)
 * @mixin \Eloquent
 */
class Mode extends Model
{
    /**
     * The name of the "updated at" column.
     *
     * @var string
     */
    const UPDATED_AT = null;
}
