<?php

namespace App;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;

/**
 * Class ConfigParser
 *
 * @package App
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
     * ConfigParser constructor.
     *
     * @param string $contents
     */
    public function __construct(string $contents)
    {
        $this->configs = new Collection;

        $this->convertToConfiguration($contents);
    }

    public function convertToConfiguration(string $contents): Collection
    {
        preg_match_all('/\w+: \d+/', $contents, $this->matches);

        foreach (array_flatten($this->matches) as $line) {
            $segment = explode(': ', $line);
            $this->configs->put($segment[0], (int)$segment[1]);
        }

        return $this->configs;
    }
}