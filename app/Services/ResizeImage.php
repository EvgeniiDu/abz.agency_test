<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;

interface ResizeImage
{
    public function resize_img(UploadedFile $path_image);
}
