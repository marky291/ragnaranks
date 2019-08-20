<?php

namespace App\Listings;

use App\Tag;
use App\User;
use Carbon\Carbon;
use App\Interactions\Vote;
use App\Interactions\Click;
use App\Interactions\Review;
use App\Interactions\Interaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

/**
 * Class Listings.
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property int $points
 * @property string $website
 * @property int $average_score
 * @property string $description
 * @property string $background
 * @property float $episode
 * @property string $accent
 * @property string $mode
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property User $user
 * @property int $user_id
 * @property Collection $tags
 * @property Collection|HasMany $reviews
 * @property Vote|HasMany $votes
 * @property Click|HasMany $clicks
 * @property ListingConfiguration $configuration
 * @property ListingRanking ranking
 * @property string space
 * @method static create(array $validated)
 * @method static make(array $validated)
 * @method static whereName(string $name)
 * @method static Builder orderBy(string $string)
 * @method static Builder withCount(array $array)
 * @method static count()
 * @method static Builder latest()
 */
class Listing extends Model
{
    /*
     * Allow users to soft delete entries, rather than full deletion
     * this allows users to restore if they ever choose to, or provide
     * a history of previous servers made by a single user to an
     * admin or moderator.
     */
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'background', 'mode', 'description', 'accent', 'website', 'episode',
    ];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Get the space directory of this listing.
     *
     * @return string
     */
    public function getSpaceAttribute() : string
    {
        return "listing/{$this->attributes['space']}";
    }

    /**
     * Scope a query to with all of its relations eager loaded.
     *
     * @param Builder $builder
     * @return Builder
     */
    public function scopeRelations(Builder $builder): Builder
    {
        return $builder->with(['configuration', 'tags', 'ranking', 'language']);
    }

    /**
     * Get the ranking table shit.
     *
     * @return HasOne|ListingRanking
     */
    public function ranking()
    {
        return $this->hasOne(ListingRanking::class);
    }

    /**
     * A ranking has one ton of configuration.
     *
     * @return HasOne
     */
    public function configuration(): HasOne
    {
        return $this->hasOne(ListingConfiguration::class);
    }

    /**
     * A listing can have many clicks.
     *
     * @return HasMany|Vote
     */
    public function votes()
    {
        return $this->hasMany(Vote::class)->whereDate('created_at', '>=', ' DATE_SUB(NOW(), INTERVAL 7 DAY)');
    }

    /**
     * A listing can have many clicks.
     *
     * @return HasMany|\Illuminate\Database\Query\Builder|Interaction
     */
    public function clicks()
    {
        return $this->hasMany(Click::class)->whereDate('created_at', '>=', ' DATE_SUB(NOW(), INTERVAL 7 DAY)');
    }

    /**
     * A listing has many reviews.
     *
     * @return HasMany
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * A listing can upload and have many url screenshots.
     *
     * @return HasMany
     */
    public function screenshots(): HasMany
    {
        return $this->hasMany(ListingScreenshot::class);
    }

    /**
     * A listing belongs to a country language.
     *
     * @return BelongsTo|ListingLanguage
     */
    public function language() : BelongsTo
    {
        return $this->belongsTo(ListingLanguage::class);
    }

    /**
     * A listing belongs to a single owner.
     *
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The tags that belong to this listing.
     *
     * @return BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * Create a new Eloquent Collection instance.
     *
     * @deprecated
     *
     * @param  array  $models
     *
     * @return Collection
     */
    public function newCollection(array $models = [])
    {
        return new ListingCollection($models);
    }

    /**
     * Get the total points of the listing.
     *
     * Used for ranking servers against others.
     *
     * @return float|int
     */
    public function getPointsAttribute()
    {
        return round(($this->votes()->count() * config('action.vote.value')) + ($this->clicks()->count() * config('action.click.value')), 0);
    }
}
