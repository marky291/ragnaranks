<?php

namespace App;

use App\Jobs\RoleAssignment;
use App\Notifications\WelcomeNotification;
use Carbon\Carbon;
use App\Listings\Listing;
use App\Interactions\Review;
use Gstt\Achievements\Achiever;
use Illuminate\Notifications\Notification;
use Illuminate\Validation\Rule;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Validator;
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
    /**
     * @link https://github.com/gstt/laravel-achievements#installation
     */
    use Notifiable, HasRoles, Achiever;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password',
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
     * @param array $data
     * @return mixed
     */
    public function validator(array $data)
    {
        return Validator::make($data, [
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($data['email'], 'email')],
            'password' => ['required', 'string', 'min:6', 'confirmed', 'sometimes'],
        ]);
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
