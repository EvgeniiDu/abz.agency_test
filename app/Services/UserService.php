<?php

namespace App\Services;
use App\Models\User;
use Illuminate\Http\UploadedFile;

/**
 *
 */
class UserService
{
    public function __construct(public ResizeImage $resizeImage){}

    /**
     * @param UploadedFile $file
     * @return string
     */

    public function create(array $request){
        if($request['image']){
            $converted_filename = $this->resizeImage->resize_img($request['image']);
            $path_image_url = 'images/' . $converted_filename;
        }
        $user = new User();
        $user->name = $request['name'];
        $user->lastname = $request['lastname'];
        $user->phone = $request['phone'];
        $user->email = $request['email'];
        $user->image = $path_image_url;
        $user->save();
        return $user;
    }



}
