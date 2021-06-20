<?php

namespace App;

use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;

class ImageSizer
{
    public function halfSize(string $filename)
    {
        $path = UPLOAD_DIR.$filename;
        $percent = 0.5;

        // Get new dimensions
        list($width, $height) = getimagesize($path);
        $new_width = $width * $percent;
        $new_height = $height * $percent;

        // Resample
        $image_p = imagecreatetruecolor($new_width, $new_height);
        $image = imagecreatefrompng($path);
        imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

        // Save as file
        imagepng($image_p, $path);
    }
}
