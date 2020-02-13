<?php


namespace App\Emulator;


class DivinePrideEnumConverter
{

    public static function CompositionId($id): string
    {
        switch ($id) {
            case 0: return 'Weapon';
            case 4: return 'Garment';
            case 16: return 'Armor';
            case 32: return 'Shield';
            case 64: return 'Shoes';
            case 136: return 'Accessory';
            case 769: return 'Headgear';
            case 1021: return 'Essence';
            case 65535: return 'Enchant';
            default: return '-';
        }
    }

    public static function ItemTypeId(int $id): string
    {
        switch ($id) {
            case -1: return 'Undocumented';
            case 0: return '-';
            case 1: return 'Weapon';
            case 2: return 'Armor';
            case 3: return 'Consumable';
            case 4: return 'Ammo';
            case 5: return 'Etc';
            case 6: return 'Card';
            case 7: return 'Cash';
            case 9: return 'Shadow Weapon';
            case 10: return 'Shadow Armor';
            default: return 'Unknown';
        }
    }

    public static function ItemSubTypeId(int $id): string
    {
        switch ($id) {
            case -1: return 'Undocumented';
            case 0: return '-';
            case 256: return 'Dagger';
            case 257: return 'Sword';
            case 258: return 'Two-handed Sword';
            case 259: return 'Spear';
            case 260: return 'Two-handed Spear';
            case 261: return 'Axe';
            case 262: return 'Two-handed Axe';
            case 263: return 'Mace';
            case 265: return 'Rod';
            case 266: return 'Two-handed Rod';
            case 267: return 'Bow';
            case 268: return 'Fist Weapon';
            case 269: return 'Instrument';
            case 270: return 'Whip';
            case 271: return 'Book';
            case 272: return 'Katar';
            case 273: return 'Pistol';
            case 274: return 'Rifle';
            case 275: return 'Gatling Gun';
            case 276: return 'Shotgun';
            case 277: return 'Grenade Launcher';
            case 278: return 'Shuriken';
            case 280: return 'Shadow Weapon';
            case 512: return 'Headgear';
            case 513: return 'Armor';
            case 514: return 'Shield';
            case 515: return 'Garment';
            case 516: return 'Shoes';
            case 517: return 'Accessory';
            case 518: return 'Pet';
            case 519: return 'Costume Helm';
            case 522: return 'Costume Garment';
            case 526: return 'Shadow Armor';
            case 527: return 'Shadow Shield';
            case 528: return 'Shadow Shoes';
            case 529: return 'Shadow Acc. (Right)';
            case 530: return 'Shadow Acc. (Left)';
            case 531: return 'Shadow Accessory';
            case 768: return 'Special';
            case 769: return 'Regeneration';
            case 1024: return 'Arrow';
            case 1025: return 'Cannonball';
            case 1026: return 'Throw Weapon';
            case 1027: return 'Ammo';
            case 1028: return 'Taming item';
            default: return 'Unknown';
        }
    }

    public static function LocationId($location, int $typecombo) {
        if ($location !== null) {
            switch($location) {
                case 'Lower': return 'Lower Headgear';
                case 'Middle': return 'Middle Headgear';
                case 'Upper': return 'Upper Headgear';
                case 'MiddleLower': return 'Middle/Lower Headgear';
                case 'MiddleUpper': return 'Upper/Middle Headgear';
                case 'UpperLower': return 'Upper/Lower Headgear';
                case 'UpperMiddleLower': return 'Upper/Middle/Lower Headgear';
                default: return 'Unknown';
            }
        }

        switch ($typecombo) {
            case 514: return 'Upper Headgear';
            case 517: return 'Garment';
            case 518: return 'Shoes';
            case 519: return 'Accessory';
            default: return 'Unknown';
        }
    }
}
