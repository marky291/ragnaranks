<?php


namespace App\Listings\Graphs;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;

/**
 * Class InteractionCollectionFormatter
 *
 * @package App\Listings\Graphs
 */
class GraphInteractionFormatter
{
    /**
     * @param Collection $collection
     * @return SupportCollection
     */
    public static function formatTotalWithDates(Collection $collection): SupportCollection
    {
        foreach ($collection as $key => $item) {
            $collection[$key]->day = Carbon::parse($item->date)->format('jS');
        }

        return $collection->pluck('total', 'day');
    }
}
