<?php


namespace App\Emulator\Items;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ItemContains
 *
 * @property string internalType
 * @property int Type
 * @property int sourceId
 * @property string sourceName
 * @property int targetId
 * @property string targetName
 * @property int count
 * @property int totalOfSource
 * @property string summonType
 * @property int chance
 *
 * @package App\Emulator\Items
 */
class ItemContains extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'emulator_item_contains';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'internalType',
        'Type',
        'sourceId',
        'sourceName',
        'targetId',
        'targetName',
        'count',
        'totalOfSource',
        'summonType',
        'chance'
    ];
}
