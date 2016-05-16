<?php


namespace Dialog\Utils;


use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;

class ImageUploader
{

    /**
     * @param $file
     * @param $destination
     * @return mixed
     *
     * Better to add resizing info
     */
    public function doUpload($file, $destination)
    {


        try {


            $filename = time() . str_random(16) . '.' . strtolower($file->getClientOriginalExtension());

            $file->move(public_path() . '/uploads/' . $destination, $filename);

            $uploadPath = '/uploads/' . $destination . '/' . $filename;

            return $uploadPath;


        } catch (\Exception $e) {

            return $e->getMessage();

        }

    }


}