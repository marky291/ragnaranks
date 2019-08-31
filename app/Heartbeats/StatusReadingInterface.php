<?php


namespace App\Heartbeats;


use Illuminate\Http\JsonResponse;

interface StatusReadingInterface
{
    /**
     * Check if a status exists on this interface.
     *
     * @return boolean
     */
    public function exists(): bool;

    /**
     * Format the data to json response
     *
     * @return JsonResponse
     */
    public function formattedData();
}
