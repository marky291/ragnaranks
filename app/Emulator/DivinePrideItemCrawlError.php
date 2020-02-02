<?php

namespace App\Emulator;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DivinePrideItemCrawlError
 *
 * @property int $item_id
 * @property string $message
 * @property string $link
 *
 * @package App\Emulator
 * @method static firstOrCreate(array $array, array $array1)
 */
class DivinePrideItemCrawlError extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'emulator_crawler_errors';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'item_id',
        'message',
        'link',
    ];
}
