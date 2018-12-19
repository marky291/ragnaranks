<?php
/**
 * Created by PhpStorm.
 * User: markhester
 * Date: 18/12/2018
 * Time: 17:21
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

/**
 * Class ServerInteractions
 * @package App
 */
class Interactable extends Model
{
    /**
     * The name of the "updated at" column.
     *
     * @var string
     */
    const UPDATED_AT = null;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function votes()
    {
        return $this->morphMany(Vote::class, 'interaction');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function clicks()
    {
        return $this->morphMany(Click::class, 'interaction');
    }
}