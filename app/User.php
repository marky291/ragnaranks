<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use phpDocumentor\Reflection\Types\Iterable_;

/**
 * Class User
 *
 * @property int $membership_id
 *
 * @property Server|\Countable|iterable $servers
 *
 * @property Carbon $membership_expiry
 *
 * @package App
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = [''];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [''];

    /**
     * A user can have many servers.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function servers()
    {
        return $this->hasMany(Server::class, 'user_id', 'id');
    }

}
