<?php

namespace App;

use Carbon\Carbon;
use App\Listings\Listing;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use App\Reviews\Review;
use App\Jobs\AssignRoleToUser;
use Gstt\Achievements\Achiever;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User.
 *
 * @property int $id
 * @property string $username
 * @property string $email
 * @property string $coins
 * @property Listing|iterable $listings
 * @property Listing|iterable $reviews
 * @property int $membership_id
 * @property Carbon $membership_expiry
 * @property mixed achievements
 * @property string email_preference
 * @property bool isSubscribedImportantEmails
 * @property bool isSubscribedAllEmails
 * @property string api_token
 * @method static first()
 * @method static Builder role(string $string)
 */
class User extends Authenticatable implements MustVerifyEmail
{
    /*
     * @link https://github.com/gstt/laravel-achievements#installation
     * @link https://laravel.com/docs/6.x/passport#frontend-quickstart
     */
    use Notifiable, HasRoles, Achiever, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'avatarUrl', 'email_preference', 'api_token',
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

        static::created(static function (self $user) {
            AssignRoleToUser::dispatchNow($user, 'member');
        });
    }

    /**
     * A user can have many servers.
     *
     * @return HasMany
     */
    public function listings(): HasMany
    {
        return $this->hasMany(Listing::class);
    }

    /**
     * A user can have many reviews.
     *
     * @return HasMany
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * @return bool
     */
    public function getIsSubscribedAllEmailsAttribute(): bool
    {
        return $this->email_preference == 'all';
    }

    /**
     * Set a new api token to the user.
     *
     * @return User
     */
    public function refreshApiToken(): self
    {
        return $this->setAttribute('api_token', hash('sha256', Str::random(60)));
    }

    /**
     * @return bool
     */
    public function getIsSubscribedImportantEmailsAttribute(): bool
    {
        return $this->email_preference == 'important';
    }

    public function isAdmin()
    {
        return $this->hasRole('admin');
    }
}
