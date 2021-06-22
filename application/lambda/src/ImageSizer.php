<?php

namespace App;

use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;

class ImageSizer
{
    /**
     * @deprecated use resize() instead
     */
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

    public function resize(string $filename)
    {
        $path = UPLOAD_DIR.$filename;
        list($width, $height, $type) = getimagesize($path);
        $old_image = $this->load_avatar($path, $type);
        $new_avatar = $this->resize_avatar(100, 100, $old_image, $width, $height);
        $this->save_avatar($new_avatar, $path, $type = $type === 1 ? 'gif' : ($type === 2 ? 'jpeg' : 'png'), 75);
    }

    private function save_avatar($new_avatar, $new_filename, $new_type='jpeg', $quality=80) {
        if( $new_type == 'jpeg' ) {
            imagejpeg($new_avatar, $new_filename, $quality);
        }
        elseif( $new_type == 'png' ) {
            imagepng($new_avatar, $new_filename);
        }
        elseif( $new_type == 'gif' ) {
            imagegif($new_avatar, $new_filename);
        }
    }

    private function load_avatar($filename, $type) {
        if( $type == IMAGETYPE_JPEG ) {
            $avatar = imagecreatefromjpeg($filename);
        }
        elseif( $type == IMAGETYPE_PNG ) {
            $avatar = imagecreatefrompng($filename);
        }
        elseif( $type == IMAGETYPE_GIF ) {
            $avatar = imagecreatefromgif($filename);
        }
        return $avatar;
    }

    private function resize_avatar($new_width, $new_height, $avatar, $width, $height) {
        $new_avatar = imagecreatetruecolor($new_width, $new_height);
        imagecopyresampled($new_avatar, $avatar, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
        return $new_avatar;
    }
}
