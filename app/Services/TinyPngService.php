<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Http\UploadedFile;

final class TinyPngService implements ResizeImage
{
    public function resize_img(UploadedFile $file){

        $path = $file->path();
        $file_name =  md5(Carbon::now().(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)));
        try{
            \Tinify\setKey('G1wCkyHWsSCZ207M8lz1YRpsjYcf6P4F');
            $source = \Tinify\fromFile($path);
            $path_converted_file = public_path('storage/images/');
            $converted = $source->convert(array("type" => ["image/jpeg"]));
            $extension = $converted->result()->extension();
            $resized = $converted->resize(array(
                "method" => "cover",
                "width" => 70,
                "height" => 70
            ));
            $resized->toFile($path_converted_file. $file_name.'.' .$extension);
            $full_filename = $file_name.'.' .$extension;
            return $full_filename;

            } catch (\Tinify\AccountException $e) {
                return response()->json([
                    'message' => $e->getMessage()
                ]);
            } catch (\Tinify\ClientException $e) {
                return response()->json([
                    'message' => $e->getMessage()
                ]);
            } catch (\Tinify\ServerException $e) {
                return response()->json([
                    'message' => $e->getMessage()
                ]);
            } catch (\Tinify\ConnectionException $e) {
                return response()->json([
                    'message' => $e->getMessage()
                ]);
            }
        }

}
