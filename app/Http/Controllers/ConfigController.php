<?php

namespace App\Http\Controllers;

use App\ConfigParser;
use App\Http\Requests\ParseConfigRequest;

/**
 * Class ConfigController.
 */
class ConfigController extends Controller
{
    public function parse(ParseConfigRequest $request, ConfigParser $parser)
    {
        $contents = file_get_contents($request->file('file')->getRealPath());

        return response()->json($parser->convertToConfiguration($contents), 200);
    }
}
