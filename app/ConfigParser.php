<?php

namespace App;

use Illuminate\Support\Collection;

/**
 * Class ConfigParser.
 */
class ConfigParser
{
    /**
     * @var array
     */
    private $matches;

    /**
     * @var Collection
     */
    public $configs;

    /**
     * Only these will be returned.
     *
     * @var array
     */
    private $allowedKeys = [
        // drops.conf
        'item_drop_common',
        'item_drop_equip',
        'item_drop_card',
        'item_drop_common_boss',
        'item_drop_equip_boss',
        'item_drop_card_boss',
        'item_drop_treasure',
        'drops_by_luk',
    ];

    /**
     * Result will cast to boolean.
     *
     * @var array
     */
    private $booleanKeys = [
        'drops_by_luk',
    ];

    /**
     * ConfigParser constructor.
     *
     * @param Collection $collection
     */
    public function __construct(Collection $collection)
    {
        $this->configs = $collection;
    }

    public function convertToConfiguration(string $contents): Collection
    {
        preg_match_all('/\w+: \d+/', $contents, $this->matches);

        /*
         * first we get all the values into a readable format.
         */
        foreach (array_flatten($this->matches) as $line) {
            $segment = explode(': ', $line);
            $this->configs->put($segment[0], (int) $segment[1]);
        }

        /*
         * We compute the multiplier values based of _min & _max
         */
        $this->configs->each(function ($item, $key) {

            // Logic for multiplier
            if (str_contains($key, '_min')) {
                $config = str_replace_first('_min', '', $key);
                $rateMin = $this->configs->get($config.'_min');
                $rateMax = $this->configs->get($config.'_max');
                $this->configs->put($config, $rateMin * $rateMax / 10000);
            }

            // Logic for boolean value types.
            if (in_array($key, $this->booleanKeys, true)) {
                $this->configs->put($key, (bool) $item);
            }
        });

        /*
         * Only keep what we actually use :D
         */
        $this->configs = $this->configs->filter(function ($item, $key) {
            return in_array($key, $this->allowedKeys, true);
        });

        return $this->configs;
    }
}
