<?php

namespace App\Http\Controllers\Api\Frontend;

use App\Handlers\ImageUploadHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ImageRequest;
use App\Http\Resources\ImageResource;
use App\Models\Images;
use Illuminate\Support\Str;

class ImagesController extends Controller
{
    public function store(ImageRequest $request, ImageUploadHandler $uploader, Images $image)
    {
        $user           = $request->user();
        $result         = $uploader->save($request->image, Str::plural($request->type), $user->id);
        $image->path    = $result['path'];
        $image->type    = $request->type;
        $image->user_id = $user->id;
        $image->save();

        return new ImageResource($image);
    }
}
