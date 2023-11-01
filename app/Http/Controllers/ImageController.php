<?php

namespace App\Http\Controllers;

use Illuminate\Http\File;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImageController extends Controller
{
    public function index(Request $request)
    {
        try {
            $request->validate([
                'url' => 'required|string',
                'format' => 'required|string',
            ]);

            $image = file_get_contents(urldecode($request->get('url')));
            return Image::make($image)->encode($request->get('format'))->response();

        } catch (\Throwable $th) {
            abort(500, $th->getMessage());
        }
    }
}
