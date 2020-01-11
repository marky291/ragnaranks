<?php

namespace App\Http\Controllers;

use App\Databases\Items\Item;
use App\Http\Resources\ItemResource;
use Illuminate\Http\Request;

/**
 * Class ItemDBController
 *
 * @package App\Http\Controllers
 */
class ItemDBController extends Controller
{
    /**
     * View the item DB
     */
    public function index()
    {
        return ItemResource::collection(Item::take(20)->get());
    }
}
