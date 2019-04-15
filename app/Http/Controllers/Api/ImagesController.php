<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\ImageResource;
use App\Models\Image;
use Illuminate\Http\Request;

class ImagesController extends Controller
{
    /**
     * @param Request $request
     * @return ImageResource
     * @throws \Illuminate\Validation\ValidationException
     */
    public function upload(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|image',
            'section' => 'required'
        ]);

        $image = new Image();

        $image->upload($request->file, $request->section);

        return new ImageResource($image);
    }
}