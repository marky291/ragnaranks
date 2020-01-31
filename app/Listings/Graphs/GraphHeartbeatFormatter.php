<?php


namespace App\Listings\Graphs;


use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;

/**
 * Class GraphPlayersFormatter
 *
 * @package App\Listings\Graphs
 */
class GraphHeartbeatFormatter
{
    /**
     * @param EloquentCollection $collection
     * @return Collection
     */
    public static function groupByCreationMapWithDate(EloquentCollection $collection)
    {
        $newCollection = collect($collection->groupBy(static function($heartbeat) {
            if ($heartbeat->created_at->isToday()) {
                return 'today';
            }
            return 'yesterday';
        }));

        foreach ($newCollection as $key => $item) {
            $newCollection[$key] = $item->mapWithKeys(static function($item) {
                return [$item->created_at->format('ga') => $item->players];
            });
        }

        return $newCollection;
    }
}
