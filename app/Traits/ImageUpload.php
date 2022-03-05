<?php

namespace App\Traits;


use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

Trait ImageUpload
{
    function uploadImage($image, $directory, $quality,  $width = false, $height = false): string
    {
        // making a name to the image
        $file_extension = $image->getClientOriginalExtension();
        $file_name = Str::random(20) . '.' . $file_extension;

        if (!is_dir('p9BY2gmfzZa6RgU2RuV8/uploaded/' . $directory)) {
            mkdir('p9BY2gmfzZa6RgU2RuV8/uploaded/' . $directory, 0777, true);
        }

        $new_image = Image::make($image->getRealPath());
        if ($width == true OR $height == true) {
            $new_image->resize($width, $height);
        }
        $new_image->save('p9BY2gmfzZa6RgU2RuV8/uploaded/' . $directory . '/' . $file_name, $quality);
        return 'p9BY2gmfzZa6RgU2RuV8/uploaded/' . $directory . '/'. $file_name;
    }

}
