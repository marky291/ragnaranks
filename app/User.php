<?php

namespace App;

use Carbon\Carbon;
use App\Listings\Listing;
use App\Interactions\Review;
use App\Jobs\RoleAssignment;
use Gstt\Achievements\Achiever;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User.
 *
 * @property int id
 * @property Listing|iterable $listings
 * @property Listing|iterable $reviews
 * @property int $membership_id
 * @property Carbon $membership_expiry
 * @property mixed achievements
 */
class User extends Authenticatable implements MustVerifyEmail
{
    /*
     * @link https://github.com/gstt/laravel-achievements#installation
     */
    use Notifiable, HasRoles, Achiever;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'avatarUrl',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Boot logic of the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::created(static function (User $user) {
            RoleAssignment::dispatchNow($user, 'member');
        });
    }

    /**
     * A user can have many servers.
     *
     * @return HasMany
     */
    public function listings()
    {
        return $this->hasMany(Listing::class, 'user_id');
    }

    /**
     * A user can have many reviews.
     *
     * @return HasMany
     */
    public function reviews()
    {
        return $this->hasMany(Review::class, 'publisher_id');
    }
}
