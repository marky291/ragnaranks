<?php

namespace App\Listings;

use App\Tag;
use App\Mode;
use App\User;
use Carbon\Carbon;
use App\Interactions\Vote;
use App\Interactions\Click;
use App\Interactions\Review;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * Class Listings.
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $points
 * @property string $website
 * @property float $rating
 * @property string $description
 * @property string $background
 * @property float $episode
 * @property string $accent
 * @property Mode $mode
 * @property string $expRateTitle
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property User $user
 * @property int $user_id
 * @property int $mode_id
 * @property Collection $tags
 * @property Collection|HasMany $reviews
 * @property Vote|HasMany $votes
 * @property Click|HasMany $clicks
 * @property-read string $exp_rate_title
 */
class Listing extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

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
     * Generate a default slug for the column.
     *
     * @return string
     */
    public function generateDefaultSlug()
    {
        return $this->slug = str_slug($this->name);
    }

    /**
     * Scope a query to with all of its relations eager loaded.
     *
     * @param Builder $builder
     * @return Builder
     */
    public function scopeRelations(Builder $builder): Builder
    {
        return $builder->with(['mode', 'tags', 'screenshots', 'language']);
    }

    /**
     * A listing has one available mode.
     *
     * @return HasOne
     */
    public function mode(): HasOne
    {
        return $this->hasOne(Mode::class, 'id', 'mode_id');
    }

    /**
     * Get the ranking table shit.
     *
     * @return HasOne
     */
    public function ranking(): HasOne
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
     * @return HasMany
     */
    public function votes()
    {
        return $this->hasMany(Vote::class)->whereDate('created_at', '>=', ' DATE_SUB(NOW(), INTERVAL 7 DAY)');
    }

    /**
     * A listing can have many clicks.
     *
     * @return HasMany|\Illuminate\Database\Query\Builder
     */
    public function clicks()
    {
        return $this->hasMany(Click::class)->whereDate('created_at', '>=', ' DATE_SUB(NOW(), INTERVAL 7 DAY)');
    }

    /**
     * A listing has many reviews.
     *
     * @return MorphToMany|Review
     */
    public function reviews()
    {
        return $this->morphedByMany(Review::class, 'interaction');
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * Create a new Eloquent Collection instance.
     *
     * @param  array  $models
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function newCollection(array $models = [])
    {
        return new ListingCollection($models);
    }

    /**
     * Get the rating of this listing, based on average review scores.
     *
     * @return mixed
     */
    public function getRatingAttribute()
    {
        return 5; // @TODO, use sql to get real rating attribute.
        //return $this->reviews()->selectRaw("round((sum(content_score+hosting_score+support_score+event_score+item_score+class_score+update_score+donation_score) / (count(donation_score) * 8) / 2), 1) as rating")->first()->rating;
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
        return round($this->votes()->count() * 6 + $this->clicks()->count(), 0);
    }

    /**
     * Get the EXP group that the listing belongs to.
     *
     * @return string
     */
    public function getExpRateTitleAttribute()
    {
        $baseEXP = $this->configs['base_exp_rate'];

        if ($baseEXP < config('filter.exp.low-rate.min')) {
            return 'Official Rate';
        }
        if ($baseEXP <= config('filter.exp.low-rate.max')) {
            return 'Low Rate';
        }
        if ($baseEXP <= config('filter.exp.mid-rate.max')) {
            return 'Mid Rate';
        }
        if ($baseEXP <= config('filter.exp.high-rate.max')) {
            return 'High Rate';
        }

        return 'Super High Rate';
    }
}
