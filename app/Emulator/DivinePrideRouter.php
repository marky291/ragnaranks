<?php


namespace App\Emulator;


class DivinePrideRouter
{
    // API for connection
    public const API_KEY = '9debcdf07c4e3d1335f5e9271a534a63';

    // API web address
    public const API_LINK = 'https://www.divine-pride.net';

    /**
     * Join the main url with the request.
     *
     * @param string $request
     * @return string
     */
    private function link(string $request)
    {
        return self::API_LINK . $request;
    }

    /**
     * @param int $id
     * @return string
     */
    public function getItem(int $id)
    {
        return $this->link("/api/database/Item/{$id}?apiKey=".self::API_KEY);
    }

    public function getMonster(int $id)
    {
        return $this->link("/api/database/Monster/{$id}?apiKey=".self::API_KEY);
    }

    public function getItemIcon(int $id)
    {
        return $this->link("/images/items/item/{$id}.png");
    }

    public function getItemImage(int $id)
    {
        return $this->link("/images/items/collection/{$id}.png");
    }

    public function getMonsterImage(int $id)
    {
        return $this->link("/images/mobs/png/{$id}.png");
    }

    public function getMonsterSpritesheet(int $id)
    {
        return $this->link("/images/spritesheets/npc/{$id}.png");
    }
}
