<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Server
 *
 * @property int $id
 * @property string $name
 * @property string $website
 * @property string $description
 * @property string $banner_url
 *
 * @property ServerMode $mode
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property User $owner
 * @property ServerVote|HasMany $votes
 * @property ServerClick|HasMany $clicks
 *
 * @package App
 */
class Server extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'servers';

    /**
     * A server has one configuration set.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function config()
    {
        return $this->hasOne(ServerConfig::class, 'server_id', 'id');
    }

    /**
     * A server has one available mode.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function mode()
    {
        return $this->hasOne(ServerMode::class, 'id', 'mode_id');
    }

    /**
     * A server can have many clicks.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function clicks()
    {
        return $this->hasMany(ServerClick::class, 'server_id', 'id');
    }

    /**
     * A server can have many votes.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function votes()
    {
        return $this->hasMany(ServerVote::class,'server_id', 'id');
    }

    /**
     * A server belongs to a single owner.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
