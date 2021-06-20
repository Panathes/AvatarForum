<?php
function resize($filename) {

    function load_avatar($filename, $type) {
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
    
    function resize_avatar($new_width, $new_height, $avatar, $width, $height) {
        $new_avatar = imagecreatetruecolor($new_width, $new_height);
        imagecopyresampled($new_avatar, $avatar, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
        return $new_avatar;
    }
    
    function save_avatar($new_avatar, $new_filename, $new_type='jpeg', $quality=80) {
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

    list($width, $height, $type) = getimagesize($filename);
    $old_image = load_avatar($filename, $type);
    $new_avatar = resize_avatar(100, 100, $old_image, $width, $height);
    save_avatar($new_avatar, "pathname-to-modify/resized-".basename($filename), 'jpeg', 75);

}
// locale Testing
// $test = "wallpapers/test.jpg";
// resize($test);
