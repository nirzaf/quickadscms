<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if(!isset($_REQUEST['path'])) exit;

$dirback_calc = str_replace('/', '../', preg_replace("#[^\/]#", '', trim($_REQUEST['path'], '/')));
$dirback = $dirback_calc != '' ? '../'.$dirback_calc : "../";

$main_path = $dirback.$_REQUEST["main_path"];
$thumbnail_path = $dirback.$_REQUEST["thumbnail_path"];

if(isset($_GET['delete']))
{
    unlink($main_path."/".$_GET['delete']);
    unlink($thumbnail_path."/".$_GET['delete']);
    if(file_exists($main_path."/cache/".$_GET['delete'])) unlink($main_path."/cache/".$_GET['delete']);
    if(file_exists($thumbnail_path."/cache/".$_GET['delete'])) unlink($thumbnail_path."/cache/".$_GET['delete']);
    exit;
}

elseif(isset($_GET['rotate']))
{
    rotateImage($_GET['rotate'], $main_path, $_GET['degree_lvl']);
    rotateImage($_GET['rotate'], $thumbnail_path, $_GET['degree_lvl']);
    echo $_GET['rotate'];
    exit;
}

function hyphenize($string) {
    $dict = array(
        "I'm"      => "I am",
        "thier"    => "their",
        // Add your own replacements here
    );
    return strtolower(
        preg_replace(
            array( '#[\\s-]+#', '#[^A-Za-z0-9\. -]+#' ),
            array( '-', '' ),
            // the full cleanString() can be downloaded from http://www.unexpectedit.com/php/php-clean-string-of-utf8-chars-convert-to-similar-ascii-char
            cleanString(
                str_replace( // preg_replace can be used to support more complicated replacements
                    array_keys($dict),
                    array_values($dict),
                    urldecode($string)
                )
            )
        )
    );
}

function cleanString($text) {
    $utf8 = array(
        '/[áàâãªä]/u'   =>   'a',
        '/[ÁÀÂÃÄ]/u'    =>   'A',
        '/[ÍÌÎÏ]/u'     =>   'I',
        '/[íìîï]/u'     =>   'i',
        '/[éèêë]/u'     =>   'e',
        '/[ÉÈÊË]/u'     =>   'E',
        '/[óòôõºö]/u'   =>   'o',
        '/[ÓÒÔÕÖ]/u'    =>   'O',
        '/[úùûü]/u'     =>   'u',
        '/[ÚÙÛÜ]/u'     =>   'U',
        '/ç/'           =>   'c',
        '/Ç/'           =>   'C',
        '/ñ/'           =>   'n',
        '/Ñ/'           =>   'N',
        '/–/'           =>   '-', // UTF-8 hyphen to "normal" hyphen
        '/[’‘‹›‚]/u'    =>   ' ', // Literally a single quote
        '/[“”«»„]/u'    =>   ' ', // Double quote
        '/ /'           =>   ' ', // nonbreaking space (equiv. to 0x160)
    );
    return preg_replace(array_keys($utf8), array_values($utf8), $text);
}

$filename = time().'_'.strtolower(hyphenize($_GET['filename']));
$filename = preg_replace("#\\s+#", "_", $filename);

$cyr = array(
    'ж',  'ч',  'щ',   'ш',  'ю',  'а', 'б', 'в', 'г', 'д', 'е', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ъ', 'ь', 'я',
    'Ж',  'Ч',  'Щ',   'Ш',  'Ю',  'А', 'Б', 'В', 'Г', 'Д', 'Е', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ъ', 'Ь', 'Я');
$lat = array(
    "l", "s",
    'zh', 'ch', 'sht', 'sh', 'yu', 'a', 'b', 'v', 'g', 'd', 'e', 'z', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'c', 'y', 'x', 'q',
    'Zh', 'Ch', 'Sht', 'Sh', 'Yu', 'A', 'B', 'V', 'G', 'D', 'E', 'Z', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'H', 'c', 'Y', 'X', 'Q');

$filename = str_replace($cyr, $lat, $filename);
$filename = normalizeChars($filename);
$bytes = file_put_contents(
    $main_path.'/'.($filename),
    file_get_contents('php://input')
);

$imgsize = @getimagesize($main_path.'/'.$filename);

if(!isset($imgsize) || !isset($imgsize['mime']) || !in_array($imgsize['mime'], array('image/jpeg', 'image/png')))
{
    unlink($main_path.'/'.($filename));
    exit;
}

if($_REQUEST["resize_to"] > 0)
{
    $width = $imgsize[0];
    $height = $imgsize[1];
    if ($width > $_REQUEST["resize_to"]) createThumbnail($main_path, $filename, $main_path, $_REQUEST["resize_to"], 100);
}

if($bytes > 8) {
    if((int)$_REQUEST["thumbnail_size"] > 0) createThumbnail($main_path, $filename, $thumbnail_path, $_REQUEST["thumbnail_size"], 100);
} else exit;

function createThumbnail($imageDirectory, $imageName, $thumbDirectory, $thumbWidth, $quality = 100)
{
    $image_extension = @end(explode(".", $imageName));
    switch($image_extension)
    {
        case "jpg":
            @$srcImg = imagecreatefromjpeg("$imageDirectory/$imageName");
            break;
        case "jpeg":
            @$srcImg = imagecreatefromjpeg("$imageDirectory/$imageName");
            break;
        case "png":
            $srcImg = imagecreatefrompng("$imageDirectory/$imageName");
            break;
    }

    if(!$srcImg) exit;
    $origWidth = imagesx($srcImg);
    $origHeight = imagesy($srcImg);
    $ratio = $origHeight/ $origWidth;
    $thumbHeight = $thumbWidth * $ratio;

    $thumbImg = imagecreatetruecolor($thumbWidth, $thumbHeight);

    if($image_extension == 'png')
    {
        $background = imagecolorallocate($thumbImg, 0, 0, 0);
        imagecolortransparent($thumbImg, $background);
        imagealphablending($thumbImg, false);
        imagesavealpha($thumbImg, true);
    }

    imagecopyresampled($thumbImg, $srcImg, 0, 0, 0, 0, $thumbWidth, $thumbHeight, $origWidth, $origHeight);

    switch($image_extension)
    {
        case "jpg":
            imagejpeg($thumbImg, "$thumbDirectory/$imageName", $quality);
            break;
        case "jpeg":
            imagejpeg($thumbImg, "$thumbDirectory/$imageName", $quality);
            break;
        case "png":
            imagepng($thumbImg, "$thumbDirectory/$imageName");
            break;
    }

}

function normalizeChars($s) {
    $replace = array(
        'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'Ae', 'Å'=>'A', 'Æ'=>'A', 'Ă'=>'A', 'Ą' => 'A', 'ą' => 'a',
        'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'ae', 'å'=>'a', 'ă'=>'a', 'æ'=>'ae',
        'þ'=>'b', 'Þ'=>'B',
        'Ç'=>'C', 'ç'=>'c', 'Ć' => 'C', 'ć' => 'c',
        'È'=>'E', 'É'=>'E', 'Ê'=>'E', 'Ë'=>'E', 'Ę' => 'E', 'ę' => 'e',
        'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e',
        'Ğ'=>'G', 'ğ'=>'g',
        'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'İ'=>'I', 'ı'=>'i', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i',
        'Ł' => 'L', 'ł' => 'l',
        'Ñ'=>'N', 'Ń' => 'N', 'ń' => 'n',
        'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'Oe', 'Ø'=>'O', 'ö'=>'oe', 'ø'=>'o',
        'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o',
        'Š'=>'S', 'š'=>'s', 'Ş'=>'S', 'ș'=>'s', 'Ș'=>'S', 'ş'=>'s', 'ß'=>'ss', 'Ś' => 'S', 'ś' => 's',
        'ț'=>'t', 'Ț'=>'T',
        'Ù'=>'U', 'Ú'=>'U', 'Û'=>'U', 'Ü'=>'Ue',
        'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ü'=>'ue',
        'Ý'=>'Y',
        'ý'=>'y', 'ý'=>'y', 'ÿ'=>'y',
        'Ž'=>'Z', 'ž'=>'z', 'Ż' => 'Z', 'ż' => 'z', 'Ź' => 'Z', 'ź' => 'z'
    );
    return strtr($s, $replace);
}

function rotateImage($image_name, $path, $degree_lvl)
{
    if($degree_lvl == 4)
    {
        unlink($path."/".$image_name);
        rename($path."/cache/".$image_name, $path."/".$image_name);
        return $image_name;
    }

    if(!file_exists($path."/cache/".$image_name)) {
        @mkdir($path."/cache", 0777);
        copy($path."/".$image_name, $path."/cache/".$image_name);
        unlink($path."/".$image_name);
    }

    $image_extension = @end(explode(".", $image_name));

    switch($image_extension)
    {
        case "jpg":
            @$image = imagecreatefromjpeg($path."/cache/".$image_name);
            break;
        case "jpeg":
            @$image = imagecreatefromjpeg($path."/cache/".$image_name);
            break;
        case "png":
            $image = imagecreatefrompng($path."/cache/".$image_name);
            break;
    }

    $transColor = imagecolorallocatealpha($image, 255, 255, 255, 270);
    $rotated_image = imagerotate($image, -90*$degree_lvl, $transColor);


    switch($image_extension)
    {
        case "jpg":
            header('Content-type: image/jpeg');
            imagejpeg($rotated_image, "$path/$image_name", 100);
            break;
        case "jpeg":
            header('Content-type: image/jpeg');
            imagejpeg($rotated_image, "$path/$image_name", 100);
            break;
        case "png":
            header('Content-type: image/png');
            imagepng($rotated_image, "$path/$image_name");
            break;
    }
    return $image_name;
}


function addWatermark($watermark, $imageDirectory, $imageName, $x = 0, $y = 0)
{
    if(file_exists($watermark))
    {
        $marge_right  = 0;
        $marge_bottom = 0;

        $stamp = imagecreatefrompng($watermark);

        $image_extension = @end(explode(".", $imageName));
        switch($image_extension)
        {
            case "jpg":
                $im = imagecreatefromjpeg("$imageDirectory/$imageName");
                break;
            case "jpeg":
                $im = imagecreatefromjpeg("$imageDirectory/$imageName");
                break;
            case "png":
                $im = imagecreatefrompng("$imageDirectory/$imageName");
                break;
        }

        $imageSize = getimagesize("$imageDirectory/$imageName");
        $watermark_o_width = imagesx($stamp);
        $watermark_o_height = imagesy($stamp);

        $newWatermarkWidth = $imageSize[0];
        $newWatermarkHeight = $watermark_o_height * $newWatermarkWidth / $watermark_o_width;


        if((int)$x <= 0)
            $x = $imageSize[0]/2 - $newWatermarkWidth/2;
        if((int)$y <= 0)
            $y = $imageSize[1]/2 - $newWatermarkHeight/2;

        imagecopyresized($im, $stamp, $x, $y, 0, 0, $newWatermarkWidth, $newWatermarkHeight, imagesx($stamp), imagesy($stamp));

        switch($image_extension)
        {
            case "jpg":
                header('Content-type: image/jpeg');
                imagejpeg($im, "$imageDirectory/$imageName", 100);
                break;
            case "jpeg":
                header('Content-type: image/jpeg');
                imagejpeg($im, "$imageDirectory/$imageName", 100);
                break;
            case "png":
                header('Content-type: image/png');
                imagepng($im, "$imageDirectory/$imageName");
                break;
        }
    }
}

if(isset($_REQUEST["watermark"]) && $_REQUEST["watermark"] != '')
{
    addWatermark($dirback.$_REQUEST["watermark"], $main_path, $filename);
    addWatermark($dirback.$_REQUEST["watermark"], $thumbnail_path, $filename);
}

function crop($max_width, $max_height, $source_file, $dst_dir)
{
    $imgsize = getimagesize($source_file);
    $width = $imgsize[0];
    $height = $imgsize[1];
    $mime = $imgsize['mime'];

    switch($mime){
        case 'image/png':
            $image_create = "imagecreatefrompng";
            $image = "imagepng";
            break;

        case 'image/jpeg':
            $image_create = "imagecreatefromjpeg";
            $image = "imagejpeg";
            break;

        default:
            return false;
            break;
    }

    $dst_img = imagecreatetruecolor($max_width, $max_height);

    if($mime == 'image/png')
    {
        $background = imagecolorallocate($dst_img, 0, 0, 0);
        imagecolortransparent($dst_img, $background);
        imagealphablending($dst_img, false);
        imagesavealpha($dst_img, true);
    }

    $src_img = $image_create($source_file);

    $width_new = $height * $max_width / $max_height;
    $height_new = $width * $max_height / $max_width;

    if($width_new > $width){
        $h_point = (($height - $height_new) / 2);
        imagecopyresampled($dst_img, $src_img, 0, 0, 0, $h_point, $max_width, $max_height, $width, $height_new);
    } else{
        $w_point = (($width - $width_new) / 2);
        imagecopyresampled($dst_img, $src_img, 0, 0, $w_point, 0, $max_width, $max_height, $width_new, $height);
    }

    if($mime == 'image/jpeg')
        $image($dst_img, $dst_dir, 100);
    else
        $image($dst_img, $dst_dir);

    if($dst_img)imagedestroy($dst_img);
    if($src_img)imagedestroy($src_img);
}


$crop_to_width = isset($_REQUEST['orakuploader_crop_to_width']) ? (int)$_REQUEST['orakuploader_crop_to_width'] : 0;
$crop_to_height = isset($_REQUEST['orakuploader_crop_to_height']) ? (int)$_REQUEST['orakuploader_crop_to_height'] : 0;

$crop_thumb_to_width = isset($_REQUEST['orakuploader_crop_thumb_to_width']) ? (int)$_REQUEST['orakuploader_crop_thumb_to_width'] : 0;
$crop_thumb_to_height = isset($_REQUEST['orakuploader_crop_thumb_to_height']) ? (int)$_REQUEST['orakuploader_crop_thumb_to_height'] : 0;

if($crop_thumb_to_width > 0 && $crop_thumb_to_height > 0)
{
    crop($crop_thumb_to_width, $crop_thumb_to_height, $main_path.'/'.$filename, $thumbnail_path.'/'.$filename);
}

if($crop_to_width > 0 && $crop_to_height > 0)
{
    crop($crop_to_width, $crop_to_height, $main_path.'/'.$filename, $main_path.'/'.$filename);
}

echo $filename;
?>