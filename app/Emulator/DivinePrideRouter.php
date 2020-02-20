<?php


namespace App\Emulator;


class DivinePrideRouter
{
    // API for connection
    public const API_KEY = '9debcdf07c4e3d1335f5e9271a534a63';

    // API web address
    public const API_LINK = 'https://www.divine-pride.net';
    public const CDN_LINK = 'https://static.divine-pride.net';

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

    private function linkToCdn(string $request)
    {
        return self::CDN_LINK . $request;
    }

    private function linkToApi(string $request)
    {
        return self::API_LINK . $request . '?apiKey=' . self::API_KEY;
    }

    /**
     * @param int $id
     * @return string
     */
    public function getItem(int $id)
    {
        return $this->linkToApi("/api/database/Item/{$id}");
    }

    public function getMap(string $mapname)
    {
        return $this->linkToApi("/api/database/Map/{$mapname}");
    }

    public function getMonster(int $id)
    {
        return $this->linkToApi("/api/database/Monster/{$id}");
    }

    public function getItemIcon(int $id)
    {
        return $this->link("/images/items/item/{$id}.png");
    }

    public function getMapOriginal(string $mapname)
    {
        return $this->link("/img/map/original/{$mapname}");
    }

    public function getMapRaw(string $mapname)
    {
        return $this->link("/img/map/raw/{$mapname}");
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
    
    public function getSkillImage(int $skillId)
    {
        return $this->linkToCdn("/images/skill/{$skillId}.png");
    }

    public function getNpcImage($id)
    {
        return $this->getMonsterImage($id);
    }
}
