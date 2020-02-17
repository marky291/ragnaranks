<?php


namespace App\Emulator;


class DivinePrideEnumConverter
{

    public static function CompositionId($id): string
    {
        switch ($id) {
            case 0: return 'weapon';
            case 4: return 'garment';
            case 16: return 'armor';
            case 32: return 'shield';
            case 64: return 'shoes';
            case 136: return 'accessory';
            case 769: return 'headgear';
            case 1021: return 'essence';
            case 65535: return 'enchant';
        }
    }

    public static function ItemTypeId(int $id): string
    {
        switch ($id) {
            case -1: return 'undocumented';
            case 0: return '-';
            case 1: return 'weapon';
            case 2: return 'armor';
            case 3: return 'consumable';
            case 4: return 'ammo';
            case 5: return 'etc';
            case 6: return 'card';
            case 7: return 'cash';
            case 9: return 'shadow weapon';
            case 10: return 'shadow armor';
            default: return 'unknown';
        }
    }

    public static function ItemSubTypeId(int $id): string
    {
        switch ($id) {
            case -1: return 'undocumented';
            case 0: return '-';
            case 256: return 'dagger';
            case 257: return 'sword';
            case 258: return 'two-handed sword';
            case 259: return 'spear';
            case 260: return 'two-handed spear';
            case 261: return 'axe';
            case 262: return 'two-handed axe';
            case 263: return 'mace';
            case 265: return 'rod';
            case 266: return 'two-handed rod';
            case 267: return 'bow';
            case 268: return 'fist weapon';
            case 269: return 'instrument';
            case 270: return 'whip';
            case 271: return 'book';
            case 272: return 'katar';
            case 273: return 'pistol';
            case 274: return 'rifle';
            case 275: return 'gatling gun';
            case 276: return 'shotgun';
            case 277: return 'grenade launcher';
            case 278: return 'shuriken';
            case 280: return 'shadow weapon';
            case 512: return 'headgear';
            case 513: return 'armor';
            case 514: return 'shield';
            case 515: return 'garment';
            case 516: return 'shoes';
            case 517: return 'accessory';
            case 518: return 'pet';
            case 519: return 'costume helm';
            case 522: return 'costume garment';
            case 526: return 'shadow armor';
            case 527: return 'shadow shield';
            case 528: return 'shadow shoes';
            case 529: return 'shadow acc. (right)';
            case 530: return 'shadow acc. (left)';
            case 531: return 'shadow accessory';
            case 768: return 'special';
            case 769: return 'regeneration';
            case 1024: return 'arrow';
            case 1025: return 'cannonball';
            case 1026: return 'throw weapon';
            case 1027: return 'ammo';
            case 1028: return 'taming item';
            default: return 'unknown';
        }
    }

    public static function LocationId($location, int $typecombo) {
        if ($location !== null) {
            switch($location) {
                case 'lower': return 'lower headgear';
                case 'middle': return 'middle headgear';
                case 'upper': return 'upper headgear';
                case 'middlelower': return 'middle/lower headgear';
                case 'middleupper': return 'upper/middle headgear';
                case 'upperlower': return 'upper/lower headgear';
                case 'uppermiddlelower': return 'upper/middle/lower headgear';
                default: return 'unknown';
            }
        }

        switch ($typecombo) {
            case 514: return 'upper headgear';
            case 517: return 'garment';
            case 518: return 'shoes';
            case 519: return 'accessory';
            default: return 'unknown';
        }
    }

    public static function ElementFromProperty($id)
    {
        switch ($id)
        {
            case 0: return 'neutral';
            case 1: return 'water';
            case 2: return 'earth';
            case 3: return 'fire';
            case 4: return 'wind';
            case 5: return 'poison';
            case 6: return 'holy';
            case 7: return 'shadow';
            case 8: return 'ghost';
            case 9: return 'undead';
        }
    }

    public static function RaceId($id)
    {
        switch($id)
        {
            case 0: return 'formless';
            case 1: return 'undead';
            case 2: return 'brute';
            case 3: return 'plant';
            case 4: return 'insect';
            case 5: return 'fish';
            case 6: return 'demon';
            case 7: return 'human';
            case 8: return 'angel';
            case 9: return 'dragon';
        }
    }

    public static function PropertyElementId($id)
    {
        switch ($id)
        {
            case 0:  return 'neutral';
            case 20:  return 'neutral 1';
            case 21: return 'water 1';
            case 22: return 'earth 1';
            case 23: return 'fire 1';
            case 24: return 'wind 1';
            case 25: return 'poison 1';
            case 26: return 'holy 1';
            case 27: return 'dark 1';
            case 28: return 'ghost 1';
            case 29: return 'undead 1';
            case 40: return 'neutral 2';
            case 41: return 'water 2';
            case 42: return 'earth 2';
            case 43: return 'fire 2';
            case 44: return 'wind 2';
            case 45: return 'poison 2';
            case 46: return 'holy 2';
            case 47: return 'dark 2';
            case 48: return 'ghost 2';
            case 49: return 'undead 2';
            case 60: return 'neutral 3';
            case 61: return 'water 3';
            case 62: return 'earth 3';
            case 63: return 'fire 3';
            case 64: return 'wind 3';
            case 65: return 'poison 3';
            case 66: return 'holy 3';
            case 67: return 'dark 3';
            case 68: return 'ghost 3';
            case 69: return 'undead 3';
            case 80: return 'neutral 4';
            case 81: return 'water 4';
            case 82: return 'earth 4';
            case 83: return 'fire 4';
            case 84: return 'wind 4';
            case 85: return 'poison 4';
            case 86: return 'holy 4';
            case 87: return 'dark 4';
            case 88: return 'ghost 4';
            case 89: return 'undead 4';
        }
    }

    public static function ScaleToSize($id)
    {
        switch ($id)
        {
            case 0: return 'small';
            case 1: return 'medium';
            case 2: return 'large';
        }
    }
}
