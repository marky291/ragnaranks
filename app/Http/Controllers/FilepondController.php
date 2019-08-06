<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

/**
 * Class FilepondController
 *
 * @package App\Http\Controllers
 */
class FilepondController extends Controller
{

    public function fetch(Request $request)
    {
        if ($request->get('load')) {
            return Storage::get($request->get('load'));
        }

        return Storage::get($request->get('fetch'));
    }

    /**
     * Uploads the file to the temporary directory
     * and returns an encrypted path to the file
     *
     * @param Request $request
     * @return false|string
     */
    public function upload(Request $request)
    {
        return $request->file('file')->store('tmp');
    }

    /**
     * Takes the given encrypted filepath and deletes
     * it if it hasn't been tampered with
     *
     * @param Request $request
     * @return mixed
     */
    public function delete(Request $request)
    {
        return Storage::deleteDirectory($request->get('fetch'));
    }
}
