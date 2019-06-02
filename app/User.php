<?php

namespace App;

use Carbon\Carbon;
use App\Listings\Listing;
use App\Interactions\Review;
use Illuminate\Validation\Rule;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

/**
 * Class User.
 *
 * @property int id
 * @property Listing|iterable $listings
 * @property Listing|iterable $reviews
 * @property int $membership_id
 * @property Carbon $membership_expiry
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, HasRoles;

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
