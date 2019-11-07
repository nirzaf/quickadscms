<?php

/**
 * Wchat - Fully Responsive PHP AJAX Chat Script
 * @author Bylancer
 * @version 1.5
 * @url https://codecanyon.net/item/wchat-fully-responsive-phpajax-chat/18047319
 * @Copyright (c) 2015-18 Devendra Katariya (bylancer.com)
 */
require_once('../includes/config.php');
require_once('../includes/sql_builder/idiorm.php');
require_once('../includes/db.php');
require_once('../includes/functions/func.global.php');
require_once('../includes/functions/func.users.php');
$con = db_connect();
sec_session_start();


if(isset($_SESSION['user']['id'])){
    $sesUsername    = $_SESSION['user']['username'];
    $sesId          = $_SESSION['user']['id'];
}
else{
    exit();
}

// Make sure file is not cached (as it happens for example on iOS devices)
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

/* 
// Support CORS
header("Access-Control-Allow-Origin: *");
// other CORS headers if any...
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
	exit; // finish preflight CORS requests here
}
*/

// 5 minutes execution time
@set_time_limit(5 * 60);

// Uncomment this one to fake upload time
// usleep(5000);

// Settings
//$targetDir = ini_get("upload_tmp_dir") . DIRECTORY_SEPARATOR . "plupload";
$targetDir = '../storage/user_files';
$uploaddir = '../storage/user_files/';
$uploaddirpath = $config['site_url'].'storage/user_files/';
$cleanupTargetDir = false; // Remove old files
$maxFileAge = 5 * 3600; // Temp file age in seconds

//$to_id = isset($_GET["toid"]) ? $_GET["toid"] : 0;
$tun = isset($_GET["tun"]) ? $_GET["tun"] : 0;
$from_user_id = $GLOBALS['sesId'];
$from_username = $GLOBALS['sesUsername'];

// Create target dir
if (!file_exists($targetDir)) {
	@mkdir($targetDir);
}

// Get a file name
if (isset($_REQUEST["name"])) {
	$fileName = $_REQUEST["name"];
} elseif (!empty($_FILES)) {
	$fileName = $_FILES["file"]["name"];
} else {
	$fileName = uniqid("file_");
}



$extensions = explode(".",$fileName);
$extension = $extensions[count($extensions)-1];
//$uniqueName = basename(uniqid().".".$extension);
$uniqueName = $fileName;
$uploadfilepath = $uploaddirpath.$uniqueName;

$filePath = $targetDir . DIRECTORY_SEPARATOR . $uniqueName;

$file_type = "file";


// Chunking might be enabled
$chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
$chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 0;


// Remove old temp files	
if ($cleanupTargetDir) {
	if (!is_dir($targetDir) || !$dir = opendir($targetDir)) {
		die('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "Failed to open temp directory."}, "id" : "id"}');
	}

	while (($file = readdir($dir)) !== false) {
		$tmpfilePath = $targetDir . DIRECTORY_SEPARATOR . $file;

		// If temp file is current file proceed to the next
		if ($tmpfilePath == "{$filePath}.part") {
			continue;
		}

		// Remove temp file if it is older than the max age and is not the current file
		if (preg_match('/\.part$/', $file) && (filemtime($tmpfilePath) < time() - $maxFileAge)) {
			@unlink($tmpfilePath);
		}
	}
	closedir($dir);
}	


// Open temp file
if (!$out = @fopen("{$filePath}.part", $chunks ? "ab" : "wb")) {
	die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
}

if (!empty($_FILES)) {
	if ($_FILES["file"]["error"] || !is_uploaded_file($_FILES["file"]["tmp_name"])) {
		die('{"jsonrpc" : "2.0", "error" : {"code": 103, "message": "Failed to move uploaded file."}, "id" : "id"}');
	}

	// Read binary input stream and append it to temp file
	if (!$in = @fopen($_FILES["file"]["tmp_name"], "rb")) {
		die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
	}
} else {	
	if (!$in = @fopen("php://input", "rb")) {
		die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
	}
}

while ($buff = fread($in, 4096)) {
	fwrite($out, $buff);
}

@fclose($out);
@fclose($in);

if ($extension=="jpg" || $extension=="jpeg" || $extension=="gif" || $extension == "png") {
    $file_type = "image";
    $size=filesize($_FILES['file']['tmp_name']);

    $image =$_FILES["file"]["name"];
    $uploadedfile = $_FILES['file']['tmp_name'];

    if ($image)
    {
        if($extension=="jpg" || $extension=="jpeg" )
        {
            $uploadedfile = $_FILES['file']['tmp_name'];
            $src = imagecreatefromjpeg($uploadedfile);
        }
        else if($extension=="png")
        {
            $uploadedfile = $_FILES['file']['tmp_name'];
            $src = imagecreatefrompng($uploadedfile);
        }
        else
        {
            $src = imagecreatefromgif($uploadedfile);
        }

        list($width,$height)=getimagesize($uploadedfile);

        $newwidth=225;
        $newheight=($height/$width)*$newwidth;
        $tmp=imagecreatetruecolor($newwidth,$newheight);

        imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);

        $filename = $uploaddir . "small" .$uniqueName;

        imagejpeg($tmp,$filename,100);

        imagedestroy($src);
        imagedestroy($tmp);
    }
}
elseif ($extension=="mp4" || $extension=="MP4" || $extension=="flv") {
    $file_type = "video";
}
elseif($extension=="doc" || $extension=="pdf") {
    $file_type = "document";
}
$result = array("file_name"=>$uniqueName,"file_path"=>$uploadfilepath,"file_type"=>$file_type);

// Check if file has been uploaded
if (!$chunks || $chunk == $chunks - 1) {
	// Strip the temp .part suffix off 
	rename("{$filePath}.part", $filePath);

    $from_user_id = $GLOBALS['sesId'];
    $message_content = json_encode($result);
    //$to_id = isset($_GET["toid"]) ? $_GET["toid"] : 0;
    $tun = isset($_GET["tun"]) ? $_GET["tun"] : 0;
    //$fun = isset($_GET["fun"]) ? $_GET["fun"] : 0;

    $query = mysqli_query($con, "select id from `".$config['db']['pre']."user` where username = '".$_GET["tun"]."' LIMIT 1 ");
    $fetch = mysqli_fetch_assoc($query);
    $to_id = $fetch['id'];

    $query = "insert into `".$config['db']['pre']."messages` (message_date,from_id,to_id,to_uname,from_uname,message_content,message_type) values ".
        "('".$GLOBALS['timenow']."', $from_user_id, $to_id, '".$_GET["tun"]."', '$from_username', '".mysqli_real_escape_string($con,$message_content)."','file')";
    $con->query($query);
    $last_id = $con->insert_id;
    $query1 = "SELECT * FROM `".$config['db']['pre']."user` where id = '".$GLOBALS['sesId']."' LIMIT 1";
    $result1 = $con->query($query1);
    $row1 = mysqli_fetch_assoc($result1);
    $sesUname = $row1['username'];
    $sesuserpic = $row1['image'];

    if($sesuserpic == "")
        $sesuserpic = "avatar_default.png";
    //echo $uploadfilepath;

}


// Return Success JSON-RPC response
die('{
"id" : "'.$last_id.'",
"toName" : "'.$_GET["tun"].'",
"username" : "'.$sesUname.'",
"picname" : "'.$sesuserpic.'",
"file_name" : "'.$uniqueName.'",
"file_path" : "'.$uploadfilepath.'",
"file_type" : "'.$file_type.'"
}');

exit();