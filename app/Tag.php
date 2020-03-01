<?php

namespace App;

use Carbon\Carbon;
use App\Listings\Listing;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * Class Tags.
 *
 * @property int $id
 * @property string $name
 * @property string $label
 * @property Carbon $created_at
 *
 * @method static where(string $string, $tagName)
 * @method static whereName($int)
 */
class Tag extends Model
{
    /**
     * Disable updated_at column.
     */
    const UPDATED_AT = null;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'label'];

    /**
     * The servers that belongs to this tag.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function servers()
    {
        return $this->belongsToMany(Listing::class, 'listing_tags');
    }

    /**
     * @return string
     */
    public function getLabelAttribute()
    {
        if ($this->getOriginal('label')) {
            return ucwords($this->getOriginal('label'));
        }

        return ucwords(str_replace('-', ' ', $this->name));
    }
}
