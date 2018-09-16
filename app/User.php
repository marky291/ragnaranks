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
 * @property Membership $membership
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
    protected $with = ['membership'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'membership_id', 'membership_expiry',
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
    protected $dates = ['membership_expiry'];

    /**
     * A user has one membership.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function membership()
    {
        return $this->hasOne(Membership::class, 'id', 'membership_id');
    }

    /**
     * A user can have many servers.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function servers()
    {
        return $this->hasMany(Server::class, 'user_id', 'id');
    }

    /**
     * Check if the user is currently a gold member.
     *
     * @return bool
     */
    public function isGoldMember()
    {
        return $this->membership->id == Membership::TYPE_GOLD;
    }

    /**
     * Check if the user is currently a silver member.
     *
     * @return bool
     */
    public function isSilverMember()
    {
        return $this->membership->id == Membership::TYPE_SILVER;
    }

    /**
     * Subscribe the user to gold membership
     *
     * @return bool
     */
    public function subscribeGoldMembership()
    {
        return $this->subscribeMembership(Membership::TYPE_GOLD, Carbon::now()->addMonth()->toDateTimeString());
    }

    /**
     * Subscribe the user to silver membership.
     *
     * @return bool
     */
    public function subscribeSilverMembership()
    {
        return $this->subscribeMembership(Membership::TYPE_SILVER);
    }

    /**
     * Subscribe the user to a membership type.
     *
     * @param int $membershipID
     * @param null $membershipExpiry
     * @return bool
     */
    public function subscribeMembership(int $membershipID, $membershipExpiry = null)
    {
        return $this->update(['membership_id' => $membershipID, 'membership_expiry' => $membershipExpiry]);
    }


}
