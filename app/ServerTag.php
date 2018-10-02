<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ServerTags
 *
 * @package App
 */
class ServerTag extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'servers_tags';

    /**
     * The name of the "updated at" column.
     *
     * @var string
     */
    const UPDATED_AT = null;
}
