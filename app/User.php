<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 *
 * @property int $membership_id
 *
 * @property Membership $membership
 *
 * @property Carbon $membership_expiry
 *
 * @package App
 */
class User extends Authenticatable
{
    use Notifiable;

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
     * @return bool
     */
    public function isSilverMember()
    {
        return $this->membership->id == Membership::TYPE_SILVER;
    }

    /**
     * Set the subscription of the user to gold.
     */
    public function subscribeGoldMembership()
    {
        $this->update([
            'membership_id' => Membership::TYPE_GOLD,
            'membership_expiry' => Carbon::now()->addMonth()->toDateTimeString()
        ]);
    }

    public function subscribeSilverMembership()
    {
        $this->update([
            'membership_id' => Membership::TYPE_SILVER,
            'membership_expiry' => NULL,
        ]);
    }


}
