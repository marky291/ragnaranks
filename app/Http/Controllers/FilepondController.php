<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

/**
 * Class FilepondController
 *
 * @package App\Http\Controllers
 */
class FilepondController extends Controller
{
    /**
     * Uploads the file to the temporary directory
     * and returns an encrypted path to the file
     *
     * @param Request $request
     * @return Response
     */
    public function upload(Request $request)
    {
        $filename = $request->file('file')->store('tmp');

        return Storage::url($filename);
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
        //
    }
}
