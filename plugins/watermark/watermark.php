<?php
/**
 * Quickad Classified Image Watermark - plugin
 * @author Bylancer
 * @version 1.0
 */
function watermark_image($target, $wtrmrk_file, $newcopy) {
    $watermark = imagecreatefrompng($wtrmrk_file);
    imagealphablending($watermark, false);
    imagesavealpha($watermark, true);
    $wtrmrk_w = imagesx($watermark);
    $wtrmrk_h = imagesy($watermark);

    $info = getimagesize($target);
    $ext = $info['mime'];


    switch( $ext ){
        case 'image/jpeg':
            $img = imagecreatefromjpeg($target);
            $img_w = imagesx($img);
            $img_h = imagesy($img);
            $dst_x = ($img_w / 1) - ($wtrmrk_w / 1); // For centering the watermark on any image
            $dst_y = ($img_h / 1) - ($wtrmrk_h / 1); // For centering the watermark on any image
            imagecopy($img, $watermark, $dst_x, $dst_y, 0, 0, $wtrmrk_w, $wtrmrk_h);
            imagejpeg($img, $newcopy, 100);
            imagedestroy($img);
            imagedestroy($watermark);
            break;

        case 'image/png':
            $img = imagecreatefrompng($target);
            $img_w = imagesx($img);
            $img_h = imagesy($img);
            $dst_x = ($img_w / 1) - ($wtrmrk_w / 1); // For centering the watermark on any image
            $dst_y = ($img_h / 1) - ($wtrmrk_h / 1); // For centering the watermark on any image
            imagecopy($img, $watermark, $dst_x, $dst_y, 0, 0, $wtrmrk_w, $wtrmrk_h);
            imagepng($img, $newcopy, 5);
            imagedestroy($img);
            imagedestroy($watermark);
            break;
    }
}
?>