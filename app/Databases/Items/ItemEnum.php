<?php


namespace App\Databases\Items;

/**
 * Class ItemEnum
 *
 * @package App\Databases\Items
 */
class ItemEnum
{
    public const IT_HEALING = 0;
    public const IT_USABLE = 1;
    public const IT_ETC = 3;
    public const IT_ARMOR = 4;
    public const IT_WEAPON = 5;
    public const IT_CARD = 6;
    public const IT_PET_EGG = 7;
    public const IT_PET_EQUIPMENT = 8;
    public const IT_AMMO = 10;
    public const IT_USABLE_DELAYED = 11;
    public const IT_SHADOW_EQUIPMENT = 12;

    /**
     * @param int $type
     * @return string
     */
    public static function TypeValueToString(int $type)
    {
        switch ($type) {
            case self::IT_HEALING:
                return 'consumable';
            default:
                return 'unknown';
        }
    }
}
