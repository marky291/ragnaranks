<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ServerReport
 *
 * @property int vote_count
 * @property int click_count
 *
 * @package App
 */
class ServerReport extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'servers_reports';

    /**
     * The vote belongs to a server.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function server()
    {
        return $this->belongsTo(Server::class);
    }
}
