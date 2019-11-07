<?php
load_all_option_in_template($config);
$timezone = get_option("timezone");
date_default_timezone_set($timezone);
$date = new DateTime("now", new DateTimeZone($timezone));
$timenow = date('Y-m-d H:i:s');

if(isset($config['quickad_debug']) && $config['quickad_debug'] == 1){

    error_reporting(E_ALL);
    ini_set('display_errors', 1);

}else{

    error_reporting(E_ALL);
    ini_set('display_errors', 0);

}

function create_header($page_title='',$meta_desc = '',$meta_image = '',$meta_article = false)
{
    global $config,$lang,$link;
    $country_code = check_user_country();
    $countryName = get_countryName_by_sortname($country_code);

    $popular = array();
    $count = 1;

    $result = ORM::for_table($config['db']['pre'].'cities')
        ->select_many('id','asciiname')
        ->where(array(
                'country_code' => $country_code,
                'active' => '1'
            ))
        ->order_by_desc('population')
        ->limit(18)
        ->find_many();
    foreach ($result as $info) {
        $id = $info['id'];
        $name = $info['asciiname'];
        $popular[$count]['tpl'] =  '<li><a class="selectme" data-id="'.$id.'" data-name="'.$name.'" data-type="city"><span>'.$name.'</span></a></li>';
        $count++;
    }

    $states = array();
    $count = 1;

    $result = ORM::for_table($config['db']['pre'].'subadmin1')
        ->select_many('id','code','asciiname')
        ->where(array(
            'country_code' => $country_code,
            'active' => '1'
        ))
        ->order_by_asc('asciiname')
        ->find_many();

    foreach ($result as $info) {
        $states[$count]['tpl'] = "";
        $id = $info['id'];
        $code = $info['code'];
        $name = $info['asciiname'];
        if($count == 1){
            $states[$count]['tpl'] =  '<li class="selected"><a class="selectme" data-id="'.$country_code.'" data-name="'.$lang['ALL'].' '.$countryName.'" data-type="country"><strong>'.$lang['ALL'].' '.$countryName.'</strong></a></li>';
        }
        $states[$count]['tpl'] .= '<li class=""><a id="region'.$code.'" class="statedata" data-id="'.$code.'" data-name="'.$name.'"><span>'.$name.' <i class="fa fa-angle-right"></i></span></a></li>';
        $count++;
    }

    checkinstall();

    $countries = new Country();
    $country_list = $countries->transAll(get_country_list());

    $page = new HtmlTemplate ("templates/" . $config['tpl_name'] . "/overall_header.tpl");
    $page->SetLoop ('COUNTRYLIST',$country_list);
    $page->SetLoop ('POPULARCITY',$popular);
    $page->SetLoop ('STATELIST',$states);
    $page->SetParameter('WCHAT', (isset($config['wchat_on_off']))? $config['wchat_on_off']:"");
    $page->SetParameter('PAGE_TITLE', $page_title);
    $page->SetParameter('PAGE_LINK', $_SERVER['REQUEST_URI']);
    $page->SetParameter('PAGE_META_KEYWORDS', $config['meta_keywords']);
    $page->SetParameter('PAGE_META_DESCRIPTION', ($meta_desc == '')?$config['meta_description']:$meta_desc);
    $page->SetParameter('GMAP_KEY', $config['gmap_api_key']);
    if($meta_article){
        $page->SetParameter('META_CONTENT', 'article');
        $page->SetParameter('META_IMAGE', $meta_image);
    }else{
        $meta_image = $config['site_url'].'storage/logo/'.$config['site_logo'];
        $page->SetParameter('META_CONTENT', 'website');
        $page->SetParameter('META_IMAGE', $meta_image);

    }
    if(isset($_SESSION['user']['id']))
    {
        $get_userdata = get_user_data($_SESSION['user']['username']);
        $page->SetParameter ('USERSTATUS', $get_userdata['status']);
        $page->SetParameter ('USEREMAIL', $get_userdata['email']);
        $page->SetParameter ('FULLNAME', $get_userdata['name']);
        $page->SetParameter ('USERPIC', $get_userdata['image']);
        $page->SetParameter ('EMAILDOMAIN', get_domain($get_userdata['email']));

    }
    else
    {
        $page->SetParameter ('USEREMAIL', '');
    }

    $page->SetParameter ('LANG_SEL', $config['userlangsel']);
    $page->SetLoop ('LANGS', get_language_list('',$selected_text='selected',true));

    $page->SetParameter('USER_COUNTRY', strtolower($country_code));
    $page->SetParameter('DEFAULT_COUNTRY', $countryName);
    $page->SetParameter('DEFAULT_COUNTRY_ID', $country_code);
    $page->SetParameter('LANGUAGE_DIRECTION', get_current_lang_direction());
    return $page->CreatePageReturn($lang,$config,$link);
}

function create_footer()
{
    global $config,$lang,$link;

    $page = new HtmlTemplate ("templates/" . $config['tpl_name'] . "/overall_footer.tpl");
    if($config['tpl_name'] == "material-theme"){
        $items = get_items("","active",false,1,2,"id");
        $page->SetLoop ('ITEM', $items);
    }

    $page->SetLoop ('HTMLPAGE', get_html_pages());
    $page->SetParameter('SITE_TITLE', $config['site_title']);
    $page->SetParameter('ZECHAT', (isset($config['zechat_on_off']))? $config['zechat_on_off']:"");
    $page->SetParameter('SITE_LOGO', $config['site_logo']);
    $page->SetParameter('PHONE', $config['contact_phone']);
    $page->SetParameter('ADDRESS', $config['contact_address']);
    $page->SetParameter('EMAIL', $config['contact_email']);
    $page->SetParameter ('SWITCHER', $config['color_switcher']);

    if(isset($_SESSION['user']['id']))
    {
        $get_userdata = get_user_data($_SESSION['user']['username']);
        $page->SetParameter ('USEREMAIL', $get_userdata['email']);
        $page->SetParameter ('USERPIC', $get_userdata['image']);

        $userinfo = get_user_data($_SESSION['user']['id']);
        $page->SetLoop ('ZECHATCONTACT', $userinfo);

    }
    else
    {
        $page->SetParameter ('USEREMAIL', '');
        $page->SetLoop ('ZECHATCONTACT', "");
    }

    return $page->CreatePageReturn($lang,$config,$link);
}

function get_the_value($link){
    //If it's not empty
    if (!empty($link)) {
        //If it begins with https...
        if (preg_match('/^https/', $link)) {
            //...then we'll set the $url_prefix variable to https://
            $url_prefix = 'https://';
        } else {
            //If it does not begin with https we'll use http
            $url_prefix = 'http://';
        }
        //Get rid of the http:// or https://
        $link = str_replace(array('http://', 'https://'), '', $link);
        return check_www_in_url($link);
    }
    return $link;
}

function check_www_in_url($link){
    $params = array();
    //If it's not empty
    if (!empty($link)) {
        $params = explode('.', $link);

        if($params[0] == 'www') {
            // www exists
        }else{
            // non www
        }
        //Get rid of the www.
        return $link = str_replace("www.", '', $link);
    }
    return $link;
}

function get_site_url($site_url){
    //If it's not empty
    if (!empty($site_url)) {
        // Check if SSL enabled
        $protocol = isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] && $_SERVER["HTTPS"] != "off"
            ? "https://" : "http://";

        $link = get_the_value($site_url);

        $params = explode('.', $_SERVER["HTTP_HOST"]);

        if($params[0] == 'www') {
            // www exists
            $link = "www.".$link;
        }else{
            // non www
        }

        return $site_url = $protocol.$link;
    }
    return $site_url;
}

function load_all_option_in_template(&$config){

    $info = ORM::for_table($config['db']['pre'].'options')
        ->find_many();

    foreach ($info as $data){

        $key = $data['option_name'];
        $value = $data['option_value'];
        if($key == 'lang')
            $config['default_lang'] = $value;

        if($key == 'site_url'){
            $value = get_site_url($value);
        }
        if($key == 'app_url'){
            $site_url = get_site_url($value);
            $value = $site_url."php/";
        }
        $config[$key] = $value;
    }
}

function add_option($option, $value = '') {

    global $config;
    $option = trim($option);
    if ( empty($option) )
        return false;

    $option_id = ORM::for_table($config['db']['pre'].'options')->create();
    $option_id->option_name = $option;
    $option_id->option_value = $value;
    $option_id->save();

    return $option_id->id();
}

function get_option($option) {

    global $config;

    $option = trim($option);
    if(isset($config[$option])){
        return $config[$option];
    }else{
        load_all_option_in_template($config);
        if(!isset($config[$option])){
            return NULL;
        }
        return $config[$option];
    }
}

function check_option_exist($option) {

    global $config;
    $option = trim($option);
    if ( empty($option) )
        return false;

    $num_rows = ORM::for_table($config['db']['pre'].'options')
        ->where('option_name',$option)
        ->count();
    if($num_rows == 1)
        return true;
    else
        return false;
}

function update_option($option,$value) {

    global $config;
    $option = trim($option);
    if ( empty($option) )
        return false;

    if(check_option_exist($option )){
        $pdo = ORM::get_db();
        $data = [
            'option_value' => $value,
            'option_name' => $option
        ];
        $sql = "UPDATE ".$config['db']['pre']."options SET option_value=:option_value WHERE option_name=:option_name";
        $query_result = $pdo->prepare($sql)->execute($data);

        if (!$query_result)
            return false;
        else
            return true;
    }
    else{
        add_option($option,$value);
        return true;
    }
}

function delete_option($option) {

    global $config;
    $option = trim($option);
    if ( empty($option) )
        return false;

    $result = ORM::for_table($config['db']['pre'].'options')
        ->where_equal('option_name', $option)
        ->delete_many();

    if ( ! $result )
        return false;
    else
        return true;
}

function getLocationInfoByIp(){
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = @$_SERVER['REMOTE_ADDR'];
    $result  = array('country'=>'', 'city'=>'');
    if(filter_var($client, FILTER_VALIDATE_IP)){
        $ip = $client;
    }elseif(filter_var($forward, FILTER_VALIDATE_IP)){
        $ip = $forward;
    }else{
        $ip = $remote;
    }
    if($ip != "::1"){
        $ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip));
        if($ip_data && $ip_data->geoplugin_countryName != null){
            $result['countryCode'] = $ip_data->geoplugin_countryCode;
            $result['country'] = $ip_data->geoplugin_countryName;
            $result['city'] = $ip_data->geoplugin_city;
            $result['latitude'] = $ip_data->geoplugin_latitude;
            $result['longitude'] = $ip_data->geoplugin_longitude;
        }
    }
    else{
        $result['countryCode'] = "IN";
        $result['country'] = "India";
        $result['city'] = "Jodhpur";
        $result['latitude'] = "26.23894689999999";
        $result['longitude'] = "73.02430939999999";
    }

    return $result;
}

function checkinstall(){

    global $config;

    if(!isset($config['installed']))
    {
        $protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://';
        $site_url = $protocol . $_SERVER['HTTP_HOST'] . str_replace ("index.php", "", $_SERVER['PHP_SELF']);
        header("Location: ".$site_url."install/");
        exit;
    }

}

function checkpurchase(){

    global $config;

    if(isset($config['purchase_key']))
    {
        header("Location: ".$config['site_url']."install/");
        exit;
    }
    else{
        $purchase_data = verify_envato_purchase_code($config['purchase_key']);

        if( isset($purchase_data['verify-purchase']['item_id']) )
        {
            if($purchase_data['verify-purchase']['item_id'] == '19960675'){
                return true;
            }
        }
        else
        {
            $url = $config['site_url'];
            echo 'Invalid Purchase code Or Check Internet connection.';
            //echo '<script type="text/javascript"> window.location = "'.$url.'install/" </script>';
            exit;
        }
    }
}

function db_connect(){

    global $config;
    checkinstall();
    // Create connection in MYsqli
    $db_connection = new mysqli($config['db']['host'], $config['db']['user'], $config['db']['pass'], $config['db']['name']);
    // Check connection in MYsqli
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }

    return $db_connection;
}

function get_lang_list(){

    global $config;
    $langs = array();

    if ($handle = opendir('includes/lang/'))
    {
        while (false !== ($file = readdir($handle)))
        {
            if ($file != '.' && $file != '..')
            {
                $langv = str_replace('.php','',$file);
                $langv = str_replace('lang_','',$langv);

                $langs[]['value'] = $langv;
            }
        }
        closedir($handle);
    }

    sort($langs);

    foreach ($langs as $key => $value)
    {
        if($config['lang'] == $value['value'])
        {
            $langs[$key]['name'] = ucwords($value['value']);
            $langs[$key]['selected'] = 'selected';
        }
        else
        {
            $langs[$key]['name'] = ucwords($value['value']);
            $langs[$key]['selected'] = '';
        }
    }

    return $langs;
}

function getExtension($str)
{
    $i = strrpos($str, ".");
    if (!$i) {
        return "";
    }
    $l = strlen($str) - $i;
    $ext = substr($str, $i + 1, $l);
    return $ext;
}

function fileUpload($path,$files,$type_file,$title,$reqwid,$reqhei,$Anysize=false,$unlink=null){

    $target_dir = $path;
    $target_file = $target_dir . basename($files["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

    $random1 = rand(9999,100000);
    $random2 = rand(9999,200000);
    $image_title=$title.'_'.$random1.$random2.'.'.$imageFileType;

    $newname = $target_dir.$image_title;

    $error = "";
    if($type_file == "image"){
        list($width, $height) = getimagesize($files["tmp_name"]);
        if($Anysize){
            $uploadedfile = $files["tmp_name"];

            if( $imageFileType=="jpg" || $imageFileType=="jpeg" )
            {
                $src = imagecreatefromjpeg($uploadedfile);
            }
            else if($imageFileType=="png")
            {
                $src = imagecreatefrompng($uploadedfile);
            }
            else
            {
                $src = imagecreatefromgif($uploadedfile);
            }

            $thumb_width = $reqwid;
            $thumb_height = $reqhei;

            $width = imagesx($src);
            $height = imagesy($src);

            $original_aspect = $width / $height;
            $thumb_aspect = $thumb_width / $thumb_height;

            if ( $original_aspect >= $thumb_aspect )
            {
                // If image is wider than thumbnail (in aspect ratio sense)
                $new_height = $thumb_height;
                $new_width = $width / ($height / $thumb_height);
            }
            else
            {
                // If the thumbnail is wider than the image
                $new_width = $thumb_width;
                $new_height = $height / ($width / $thumb_width);
            }

            $thumb = imagecreatetruecolor( $thumb_width, $thumb_height );

            // Resize and crop
            imagecopyresampled($thumb,
                $src,
                0 - ($new_width - $thumb_width) / 2, // Center the image horizontally
                0 - ($new_height - $thumb_height) / 2, // Center the image vertically
                0, 0,
                $new_width, $new_height,
                $width, $height);

            $image_name =  "small_".$image_title;

            $filename = $target_dir . $image_name;

            imagejpeg($thumb, $filename, 80);

            imagedestroy($src);
            imagedestroy($thumb);

            //Moving file to uploads folder
            if ($filename) {
                if($unlink != null){
                    $filename = $target_dir.$unlink;
                    if(file_exists($filename)){
                        unlink($filename);
                    }
                }
                move_uploaded_file($files["tmp_name"], $newname);
                $success = "The file ". basename( $files["name"]). " has been uploaded.";
                return $image_title;
            } else {
                $error = "Sorry, there was an error uploading your file.";
                return "";
            }

        }
        else{
            //Check width height
            if($reqwid != $width && $reqhei != $height){
                $error = "Sorry, only dimension".$width."x".$height."files are allowed.";
                $uploadOk = 0;
            }
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            $error = "Sorry, only JPG, JPEG & PNG files are allowed.";
            $uploadOk = 0;
        }
    }
    elseif($type_file == "zip"){
        // Allow certain file formats
        if($imageFileType != "zip") {
            $error = "Sorry, only Zip file are allowed.";
            $uploadOk = 0;
        }
    }
    else{
    //Any type accepted
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $error = "Sorry, your file was not uploaded.";
        return 0;
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($files["tmp_name"], $newname)) {
            if($unlink != null){
                $filename = $target_dir.$unlink;
                unlink($filename);
            }
            $success = "The file ". basename( $files["name"]). " has been uploaded.";
            return $image_title;
        } else {
            $error = "Sorry, there was an error uploading your file.";
            return "";
        }
    }
}

//resize and crop image by center
function resize_crop_image($max_width, $max_height, $dst_dir, $source_file, $quality = 80){
    $imgsize = getimagesize($source_file);
    $width = $imgsize[0];
    $height = $imgsize[1];
    $mime = $imgsize['mime'];

    switch($mime){
        case 'image/gif':
            $image_create = "imagecreatefromgif";
            $image = "imagegif";
            break;

        case 'image/png':
            $image_create = "imagecreatefrompng";
            $image = "imagepng";
            $quality = 7;
            break;

        case 'image/jpeg':
            $image_create = "imagecreatefromjpeg";
            $image = "imagejpeg";
            $quality = 80;
            break;

        default:
            return false;
            break;
    }

    $dst_img = imagecreatetruecolor($max_width, $max_height);
    $src_img = $image_create($source_file);

    $width_new = $height * $max_width / $max_height;
    $height_new = $width * $max_height / $max_width;
    //if the new width is greater than the actual width of the image, then the height is too large and the rest cut off, or vice versa
    if($width_new > $width){
        //cut point by height
        $h_point = (($height - $height_new) / 2);
        //copy image
        imagecopyresampled($dst_img, $src_img, 0, 0, 0, $h_point, $max_width, $max_height, $width, $height_new);
    }else{
        //cut point by width
        $w_point = (($width - $width_new) / 2);
        imagecopyresampled($dst_img, $src_img, 0, 0, $w_point, 0, $max_width, $max_height, $width_new, $height);
    }

    $image($dst_img, $dst_dir, $quality);

    if($dst_img)imagedestroy($dst_img);
    if($src_img)imagedestroy($src_img);
    return true;
}

function resizeImage($newwidth, $filename, $uploadedfile) {
    $info = getimagesize($uploadedfile);
    $ext = $info['mime'];

    list($width,$height)=getimagesize($uploadedfile);

    $newheight=($height/$width)*$newwidth;
    $tmp=imagecreatetruecolor($newwidth,$newheight);

    switch( $ext ){
        case 'image/jpeg':
            $src = imagecreatefromjpeg($uploadedfile);
            @imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
            imagejpeg($tmp, $filename, 100);
            @imagedestroy($src);
            break;

        case 'image/png':
            $src = imagecreatefrompng( $uploadedfile );
            imagealphablending( $tmp, false );
            imagesavealpha( $tmp, true );
            imagecopyresampled( $tmp, $src, 0, 0, 0, 0, $newwidth,$newheight,$width,$height);
            imagepng($tmp, $filename, 5);
            @imagedestroy($src);
            break;
    }
    @imagedestroy($tmp);
    return true;
}

function timeAgo($timestamp){
    global $lang;
    //$time_now = mktime(date('h')+0,date('i')+30,date('s'));
    $datetime1=new DateTime("now");
    $datetime2=date_create($timestamp);
    $diff=date_diff($datetime1, $datetime2);
    $timemsg='';
    if($diff->y > 0){
        $timemsg = $diff->y .' '. ($diff->y > 1?$lang['YEARS']:$lang['YEAR']);
    }
    else if($diff->m > 0){
        $timemsg = $diff->m .' '. ($diff->m > 1?$lang['MONTHS']:$lang['MONTH']);
    }
    else if($diff->d > 0){
        $timemsg = $diff->d .' '. ($diff->d > 1?$lang['DAYS']:$lang['DAY']);
    }
    else if($diff->h > 0){
        $timemsg = $diff->h .' '. ($diff->h > 1 ? $lang['HOURS']:$lang['HOUR']);
    }
    else if($diff->i > 0){
        $timemsg = $diff->i .' '. ($diff->i > 1?$lang['MINUTES']:$lang['MINUTE']);
    }
    else if($diff->s > 0){
        $timemsg = $diff->s .' '. ($diff->s > 1?$lang['SECONDS']:$lang['SECONDS']);
    }
    if($timemsg == "")
        $timemsg = $lang['JUST_NOW'];
    else
        $timemsg = $timemsg.' '.$lang['AGO'];

    return $timemsg;
}

function time_elapsed_string($datetime, $full = false) {
    global $lang;
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : $lang['JUST_NOW'];
}

function pagenav($total,$page,$perpage,$url,$posts=0,$seo_url=false)
{
	$page_arr = array();
	$arr_count = 0;

	if($posts) 
	{
		$symb='&';
	}
	else
	{
		$symb='?';
	}
	$total_pages = ceil($total/$perpage);
	$llimit = 1;
	$rlimit = $total_pages;
	$window = 5;
	$html = '';
	if ($page<1 || !$page) 
	{
		$page=1;
	}
	
	if(($page - floor($window/2)) <= 0)
	{
		$llimit = 1;
		if($window > $total_pages)
		{
			$rlimit = $total_pages;
		}
		else
		{
			$rlimit = $window;
		}
	}
	else
	{
		if(($page + floor($window/2)) > $total_pages) 
		{
			if ($total_pages - $window < 0)
			{
				$llimit = 1;
			}
			else
			{
				$llimit = $total_pages - $window + 1;
			}
			$rlimit = $total_pages;
		}
		else
		{
			$llimit = $page - floor($window/2);
			$rlimit = $page + floor($window/2);
		}
	}
	if ($page>1)
	{
		$page_arr[$arr_count]['title'] = 'Prev';
        if($seo_url)
            $page_arr[$arr_count]['link'] = $url.'/'.($page-1);
        else
            $page_arr[$arr_count]['link'] = $url.$symb.'page='.($page-1);

		$page_arr[$arr_count]['current'] = 0;
		
		$arr_count++;
	}

	for ($x=$llimit;$x <= $rlimit;$x++) 
	{
		if ($x <> $page) 
		{
			$page_arr[$arr_count]['title'] = $x;
            if($seo_url)
                $page_arr[$arr_count]['link'] = $url.'/'.($x);
            else
                $page_arr[$arr_count]['link'] = $url.$symb.'page='.($x);


			$page_arr[$arr_count]['current'] = 0;
		} 
		else 
		{
			$page_arr[$arr_count]['title'] = $x;
            if($seo_url)
                $page_arr[$arr_count]['link'] = $url.'/'.($x);
            else
                $page_arr[$arr_count]['link'] = $url.$symb.'page='.($x);
			$page_arr[$arr_count]['current'] = 1;
		}
		
		$arr_count++;
	}
	
	if($page < $total_pages)
	{
		$page_arr[$arr_count]['title'] = 'Next';
        if($seo_url)
            $page_arr[$arr_count]['link'] = $url.'/'.($page+1);
        else
            $page_arr[$arr_count]['link'] = $url.$symb.'page='.($page+1);
		$page_arr[$arr_count]['current'] = 0;
		
		$arr_count++;
	}
	
	return $page_arr;
}

function error($msg, $line='', $file='', $formatted=0)
{
    global $config,$lang,$link;
    if($formatted == 0)
    {
        echo "Low Level Error: " . $msg." ".$file ." ".$line ;
    }
    else
    {
        if(!isset($lang['ERROR']))
        {
            $lang['ERROR'] = '';
        }

        $page = new HtmlTemplate ("templates/" . $config['tpl_name'] . "/error.tpl");
        $page->SetParameter ('OVERALL_HEADER', create_header($lang['ERROR']));
        $page->SetParameter ('MESSAGE', $msg);
        $page->SetParameter ('CONTENT', "");
        $page->SetParameter ('OVERALL_FOOTER', create_footer());
        $page->CreatePageEcho();
    }
    exit;
}

function error_content($msg, $content="")
{
    global $config,$lang,$link;

    if(!isset($lang['ERROR']))
    {
        $lang['ERROR'] = '';
    }

    $page = new HtmlTemplate ("templates/" . $config['tpl_name'] . "/error.tpl");
    $page->SetParameter ('OVERALL_HEADER', create_header($lang['ERROR']));
    $page->SetParameter ('MESSAGE', $msg);
    $page->SetParameter ('CONTENT', $content);
    $page->SetParameter ('OVERALL_FOOTER', create_footer());
    $page->CreatePageEcho();

    exit;
}

function email_template($template,$user_id=null,$password=null,$product_id=null,$item_title=null){
    global $config,$lang,$link;

    if($user_id != null){
        $userdata = get_user_data(null,$user_id);
        $username = $userdata['username'];
        $user_email = $userdata['email'];
        $user_fullname = $userdata['name'];
        $confirm_id =  $userdata['confirm'];
    }

    /*SEND ACCOUNT DETAILS EMAIL*/
    if($template == "signup_details"){
        $page = new HtmlTemplate();
        $page->html = $config['email_sub_signup_details'];
        $page->SetParameter ('USER_ID', $user_id);
        $page->SetParameter ('USERNAME', $username);
        $page->SetParameter ('EMAIL', $user_email);
        $page->SetParameter ('USER_FULLNAME', $user_fullname);
        $email_subject = $page->CreatePageReturn($lang,$config,$link);

        $page = new HtmlTemplate();
        $page->html = $config['email_message_signup_details'];
        $page->SetParameter ('USER_ID', $user_id);
        $page->SetParameter ('USERNAME', $username);
        $page->SetParameter ('EMAIL', $user_email);
        $page->SetParameter ('USER_FULLNAME', $user_fullname);
        $page->SetParameter ('PASSWORD', $password);
        $email_body = $page->CreatePageReturn($lang,$config,$link);

        email($user_email,$user_fullname,$email_subject,$email_body);

        /*Send 1 copy to admin*/
        //email($config['admin_email'],$config['site_title'],$email_subject,$email_body);
        return;
    }

    /*SEND CONFIRMATION EMAIL*/
    if($template == "signup_confirm"){
        $page = new HtmlTemplate();
        $page->html = $config['email_sub_signup_confirm'];
        $page->SetParameter ('USER_ID', $user_id);
        $page->SetParameter ('USERNAME', $username);
        $page->SetParameter ('EMAIL', $user_email);
        $page->SetParameter ('USER_FULLNAME', $user_fullname);
        $email_subject = $page->CreatePageReturn($lang,$config,$link);

        $confirmation_link = $link['SIGNUP']."?confirm=".$confirm_id."&user=".$user_id;
        $page = new HtmlTemplate();
        $page->html = $config['email_message_signup_confirm'];
        $page->SetParameter ('USER_ID', $user_id);
        $page->SetParameter ('USERNAME', $username);
        $page->SetParameter ('EMAIL', $user_email);
        $page->SetParameter ('USER_FULLNAME', $user_fullname);
        $page->SetParameter ('CONFIRMATION_LINK', $confirmation_link);
        $email_body = $page->CreatePageReturn($lang,$config,$link);

        email($user_email,$user_fullname,$email_subject,$email_body);
        return;
    }

    /*SEND AD APPROVE EMAIL*/
    if($template == "ad_approve"){

        $ad_link = $config['site_url']."ad/".$product_id;

        $page = new HtmlTemplate();
        $page->html = $config['email_sub_ad_approve'];
        $page->SetParameter ('ADTITLE', $item_title);
        $page->SetParameter ('SELLER_NAME', $user_fullname);
        $page->SetParameter ('SELLER_EMAIL', $user_email);
        $email_subject = $page->CreatePageReturn($lang,$config,$link);

        $page = new HtmlTemplate();
        $page->html = $config['email_message_ad_approve'];;
        $page->SetParameter ('ADTITLE', $item_title);
        $page->SetParameter ('ADLINK', $ad_link);
        $page->SetParameter ('SELLER_NAME', $user_fullname);
        $page->SetParameter ('SELLER_EMAIL', $user_email);
        $email_body = $page->CreatePageReturn($lang,$config,$link);

        email($user_email,$user_fullname,$email_subject,$email_body);
    }

    /*SEND RESUBMISSION AD APPROVE EMAIL*/
    if($template == "re_ad_approve"){
        $ad_link = $config['site_url']."ad/".$product_id;

        $page = new HtmlTemplate();
        $page->html = $config['email_sub_re_ad_approve'];
        $page->SetParameter ('ADTITLE', $item_title);
        $page->SetParameter ('ADLINK', $ad_link);
        $page->SetParameter ('SELLER_NAME', $user_fullname);
        $page->SetParameter ('SELLER_EMAIL', $user_email);
        $email_subject = $page->CreatePageReturn($lang,$config,$link);

        $page = new HtmlTemplate();
        $page->html = $config['email_message_re_ad_approve'];;
        $page->SetParameter ('ADTITLE', $item_title);
        $page->SetParameter ('ADLINK', $ad_link);
        $page->SetParameter ('SELLER_NAME', $user_fullname);
        $page->SetParameter ('SELLER_EMAIL', $user_email);
        $email_body = $page->CreatePageReturn($lang,$config,$link);

        email($user_email,$user_fullname,$email_subject,$email_body);
    }

    /*SEND CONTACT EMAIL TO SELLER*/
    if($template == "contact_seller"){
        $ad_link = $config['site_url']."ad/".$product_id;
        $page = new HtmlTemplate();
        $page->html = $config['email_sub_contact_seller'];
        $page->SetParameter ('ADTITLE', $item_title);
        $page->SetParameter ('ADLINK', $ad_link);
        $page->SetParameter ('SELLER_NAME', $user_fullname);
        $page->SetParameter ('SELLER_EMAIL', $user_email);
        $page->SetParameter('SENDER_NAME', $_POST['name']);
        $page->SetParameter('SENDER_EMAIL', $_POST['email']);
        $page->SetParameter('SENDER_PHONE', $_POST['phone']);
        $email_subject = $page->CreatePageReturn($lang,$config,$link);

        $page = new HtmlTemplate();
        $page->html = $config['email_message_contact_seller'];;
        $page->SetParameter ('ADTITLE', $item_title);
        $page->SetParameter ('ADLINK', $ad_link);
        $page->SetParameter ('SELLER_NAME', $user_fullname);
        $page->SetParameter ('SELLER_EMAIL', $user_email);
        $page->SetParameter('SENDER_NAME', $_POST['name']);
        $page->SetParameter('SENDER_EMAIL', $_POST['email']);
        $page->SetParameter('SENDER_PHONE', $_POST['phone']);
        $page->SetParameter('MESSAGE', $_POST['message']);
        $email_body = $page->CreatePageReturn($lang,$config,$link);

        email($user_email,$user_fullname,$email_subject,$email_body);
    }


    /*SEND CONTACT EMAIL TO ADMIN*/
    if($template == "contact"){
        $page = new HtmlTemplate();
        $page->html = $config['email_sub_contact'];
        $page->SetParameter ('CONTACT_SUBJECT', $_POST['subject']);
        $page->SetParameter ('NAME', $_POST['name']);
        $page->SetParameter ('EMAIL', $_POST['email']);
        $email_subject = $page->CreatePageReturn($lang,$config,$link);

        $page = new HtmlTemplate();
        $page->html = $config['email_message_contact'];
        $page->SetParameter ('NAME', $_POST['name']);
        $page->SetParameter ('EMAIL', $_POST['email']);
        $page->SetParameter ('CONTACT_SUBJECT', $_POST['subject']);
        $page->SetParameter ('MESSAGE', $_POST['message']);
        $email_body = $page->CreatePageReturn($lang,$config,$link);

        email($_POST['email'],$_POST['name'],$email_subject,$email_body);
        email($config['admin_email'],$config['site_title'],$email_subject,$email_body);
    }
    /*SEND FEEDBACK TO ADMIN */
    if($template == "feedback"){
        $page = new HtmlTemplate();
        $page->html = $config['email_sub_feedback'];
        $page->SetParameter ('FEEDBACK_SUBJECT', $_POST['subject']);
        $page->SetParameter ('NAME', $_POST['name']);
        $page->SetParameter ('EMAIL', $_POST['email']);
        $email_subject = $page->CreatePageReturn($lang,$config,$link);

        $page = new HtmlTemplate();
        $page->html = $config['email_message_feedback'];
        $page->SetParameter ('NAME', $_POST['name']);
        $page->SetParameter ('EMAIL', $_POST['email']);
        $page->SetParameter ('PHONE', $_POST['phone']);
        $page->SetParameter ('FEEDBACK_SUBJECT', $_POST['subject']);
        $page->SetParameter ('MESSAGE', $_POST['message']);
        $email_body = $page->CreatePageReturn($lang,$config,$link);

        email($_POST['email'],$_POST['name'],$email_subject,$email_body);
        email($config['admin_email'],$config['site_title'],$email_subject,$email_body);
    }
    /*SEND REPORT TO ADMIN*/
    if($template == "report"){
        $page = new HtmlTemplate();
        $page->html = $config['email_sub_report'];
        $page->SetParameter ('EMAIL', $_POST['email']);
        $page->SetParameter ('NAME', $_POST['name']);
        $page->SetParameter ('USERNAME', $_POST['username']);
        $page->SetParameter ('VIOLATION', $_POST['violation']);
        $email_subject = $page->CreatePageReturn($lang,$config,$link);

        $page = new HtmlTemplate();
        $page->html = $config['email_message_report'];
        $page->SetParameter ('EMAIL', $_POST['email']);
        $page->SetParameter ('NAME', $_POST['name']);
        $page->SetParameter ('USERNAME', $_POST['username']);
        $page->SetParameter ('USERNAME2', $_POST['username2']);
        $page->SetParameter ('VIOLATION', $_POST['violation']);
        $page->SetParameter ('URL', $_POST['url']);
        $page->SetParameter ('DETAILS', $_POST['details']);
        $email_body = $page->CreatePageReturn($lang,$config,$link);

        email($_POST['email'],$_POST['name'],$email_subject,$email_body);
        email($config['admin_email'],$config['site_title'],$lang['REPORTVIO'],$email_body);
    }
}

function email($email_to,$email_to_name,$email_subject,$email_body,$bcc=array(),$email_reply_to=null, $email_reply_to_name=null){

    global $config;

    include(dirname(__FILE__).DIRECTORY_SEPARATOR."../mail/".$config['email_engine']."/init.engine.php");

}

function message($heading,$message,$forward='',$back=true)
{
    global $config,$lang,$link;
    if($forward == '')
    {
        if($back)
        {
            $page = new HtmlTemplate ("templates/" . $config['tpl_name'] . "/message.tpl");
            $page->SetParameter ('OVERALL_HEADER', create_header($lang['MESSAGE']));
            $page->SetParameter ('HEADING', $heading);
            $page->SetParameter ('MESSAGE', $message);
            $page->SetParameter ('OVERALL_FOOTER', create_footer());
            $page->CreatePageEcho();
        }
        else
        {
            $page = new HtmlTemplate ("templates/" . $config['tpl_name'] . "/message_noback.tpl");
            $page->SetParameter ('OVERALL_HEADER', create_header($lang['MESSAGE']));
            $page->SetParameter ('HEADING', $heading);
            $page->SetParameter ('MESSAGE', $message);
            $page->SetParameter ('OVERALL_FOOTER', create_footer());
            $page->CreatePageEcho();
        }
    }
    else
    {
        $page = new HtmlTemplate ("templates/" . $config['tpl_name'] . "/message_forward.tpl");
        $page->SetParameter ('OVERALL_HEADER', create_header($lang['MESSAGE']));
        $page->SetParameter ('HEADING', $heading);
        $page->SetParameter ('MESSAGE', $message);
        $page->SetParameter ('FORWARD', $forward);
        $page->SetParameter ('OVERALL_FOOTER', create_footer());
        $page->CreatePageEcho();
    }
    exit;
}

function transfer($url,$msg,$page_title=''){

    global $config;
	if(!$config['transfer_filter'])
	{
		header("Location: ".$url);
		exit;
	}
	ob_start();
	echo "<html>\n";
	echo "<head>\n";
	echo "<title>\n";
	echo $page_title;
	echo "</title>\n";
	echo "<STYLE>\n";
	echo "<!--\n";
	echo "TABLE, TR, TD                { font-family:Verdana, Tahoma, Arial;font-size: 7.5pt; color:#000000}\n";
	echo "a:link, a:visited, a:active  { text-decoration:underline; color:#000000 }\n";
	echo "a:hover                      { color:#465584 }\n";
	echo "#alt1   { font-size: 16px; }\n";
	echo "body {\n";
	echo "	background-color: #e8ebf1\n";
    echo "	z-index: 99999\n";
	echo "}\n";
	echo "-->\n";
	echo "</STYLE>\n";
	echo "<script language=\"JavaScript\" type=\"text/javascript\">\n";
	echo "function changeurl(){\n";
	echo "window.location='" . $url . "';\n";
	echo "}\n";
	echo "</script>\n";
	echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\"></head>\n";
	echo "<body onload=\"window.setTimeout('changeurl();',2000);\">\n";
	echo "<table width='95%' height='85%' style='margin: 100px'>\n";
	echo "<tr>\n";
	echo "<td valign='middle'>\n";
	echo "<table align='center' border=\"0\" cellspacing=\"1\" cellpadding=\"0\" bgcolor=\"#fff\">\n";
	echo "<tr>\n";
	echo "<td id='mainbg'>";
	echo "<table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"12\">\n";
	echo "<tr>\n";
	echo "<td width=\"100%\" align=\"center\" id=alt1>\n";
	echo $msg . "<br><br>\n";
	echo "<div><img src=\"" . $config['site_url'] . "loading.gif\"/></div><br><br>\n";
	echo "(<a href='" . $url . "'>Or click here if you do not wish to wait</a>)</td>\n";
	echo "</tr>\n";
	echo "</table>\n";
	echo "</td>\n";
	echo "</tr>\n";
	echo "</table>\n";
	echo "</td>\n";
	echo "</tr>\n";
	echo "</table>\n";
	echo "</body></html>\n";
	ob_end_flush();
}

function get_domain($email){

    $domain = implode('.', array_slice( preg_split("/(\.|@)/", $email), -2));

    return strtolower($domain);
}

function encode_ip($server,$env){

    if( getenv('HTTP_X_FORWARDED_FOR') != '' )
    {
        $client_ip = ( !empty($_SERVER['REMOTE_ADDR']) ) ? $_SERVER['REMOTE_ADDR'] : ( ( !empty($HTTP_ENV_VARS['REMOTE_ADDR']) ) ? $_ENV['REMOTE_ADDR'] : $REMOTE_ADDR );

        $entries = explode(',', getenv('HTTP_X_FORWARDED_FOR'));
        reset($entries);
        while (list(, $entry) = each($entries))
        {
            $entry = trim($entry);
            if ( preg_match("/^([0-9]+\.[0-9]+\.[0-9]+\.[0-9]+)/", $entry, $ip_list) )
            {
                $private_ip = array('/^0\./', '/^127\.0\.0\.1/', '/^192\.168\..*/', '/^172\.((1[6-9])|(2[0-9])|(3[0-1]))\..*/', '/^10\..*/', '/^224\..*/', '/^240\..*/');
                $found_ip = preg_replace($private_ip, $client_ip, $ip_list[1]);

                if ($client_ip != $found_ip)
                {
                    $client_ip = $found_ip;
                    break;
                }
            }
        }
    }
    else
    {
        $client_ip = ( !empty($_SERVER['REMOTE_ADDR']) ) ? $_SERVER['REMOTE_ADDR'] : ( ( !empty($_ENV['REMOTE_ADDR']) ) ? $_ENV['REMOTE_ADDR'] : $REMOTE_ADDR );
    }

    return $client_ip;
}

function verify_envato_purchase_code($code_to_verify) {
    // Your Username
    $username = 'bylancer';

    // Set API Key
    $api_key = 'yuo2pufs90ptj6nsoqzo4l60tiyce8lj';

    // Open cURL channel
    $ch = curl_init();

    // Set cURL options
    curl_setopt($ch, CURLOPT_URL, "http://marketplace.envato.com/api/edge/". $username ."/". $api_key ."/verify-purchase:". $code_to_verify .".json");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    //Set the user agent
    $agent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)';
    curl_setopt($ch, CURLOPT_USERAGENT, $agent);
    // Decode returned JSON
    $output = json_decode(curl_exec($ch), true);

    // Close Channel
    curl_close($ch);

    // Return output
    return $output;
}

function validate_input($input,$strip_tags=false)
{
    global $config;
    $con = db_connect();

    if(get_magic_quotes_gpc())
    {
        if(ini_get('magic_quotes_sybase'))
        {
            $input = str_replace("''", "'", $input);
        }
        else
        {
            $input = stripslashes($input);
        }
    }

    if($strip_tags){
        $input = stripUnwantedTagsAndAttrs($input);
    }else{
        $input = strip_tags($input);
        $input = mysqli_real_escape_string($con,$input);
    }

    return $input;
}

function stripUnwantedTagsAndAttrs($html_str){
    $html_str = str_replace("&", "&amp;", $html_str);
    $xml = new DOMDocument('1.0','utf-8');
    //$xml->xmlEncoding('utf-8');
    //Suppress warnings: proper error handling is beyond scope of example
    libxml_use_internal_errors(true);
    //List the tags you want to allow here, NOTE you MUST allow html and body otherwise entire string will be cleared
    $allowed_tags = array("div", "h1", "h2", "h3", "h4", "h5", "b", "br", "em", "hr", "i", "p", "s", "a", "img", "span", "table", "tr", "td", "strong", "code", "pre", "ul", "li", "ol");
    //List the attributes you want to allow here
    $allowed_attrs = array ("href", "src");
    if (!strlen($html_str)){return false;}
    if ($xml->loadHTML(mb_convert_encoding($html_str, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD)){
        foreach ($xml->getElementsByTagName("*") as $tag){
            if (!in_array($tag->tagName, $allowed_tags)){
                $tag->parentNode->removeChild($tag);
            }else{
                foreach ($tag->attributes as $attr){
                    if (!in_array($attr->nodeName, $allowed_attrs)){
                        $tag->removeAttribute($attr->nodeName);
                    }
                }
            }
        }
    }
    return $xml->saveHTML();
}

function sanitize($text) {
    $text = htmlspecialchars($text, ENT_QUOTES);
    $text = str_replace("\n\r","\n",$text);
    $text = str_replace("\r\n","\n",$text);
    $text = str_replace("\n","<br>",$text);
    return $text;
}

function de_sanitize($text) {
    $text = str_replace("<br>","\n",$text);
    return $text;
}

function strlimiter($str,$limit){

    if (strlen($str) > $limit)
        $string = substr($str, 0, $limit) . '...';
    else
        $string = $str;

    return $string;
}

function redirect_parent($url,$close=false){

    echo "<script type='text/javascript'>";
    if ($close)
    {
        echo "window.close(); ";
        echo "window.opener.location.href='$url'";
    }
    else
    {
        echo "window.location.href='$url'";
    }
    echo "</script>";

}

function currencyConverter($from_Currency,$to_Currency,$amount) {
    $from_Currency = urlencode($from_Currency);
    $to_Currency = urlencode($to_Currency);
    $get = file_get_contents("https://finance.google.com/finance/converter?a=1&from=$from_Currency&to=$to_Currency");
    $get = explode("<span class=bld>",$get);
    $get = explode("</span>",$get[1]);
    $exchange_rate = preg_replace("/[^0-9\.]/", null, $get[0]);
    $converted_currency = $exchange_rate*$amount;
    return $converted_currency;


    // change amount according to your needs
    //$amount = 100;
    // change From Currency according to your needs
    //$from_Curr = "USD";
    // change To Currency according to your needs
    //$to_Curr = "INR";

    //$converted_currency = currencyConverter($from_Curr, $to_Curr, $amount);
    // Print outout
    //echo $converted_currency;
}

function rawFormat($number)
{
    if (is_numeric($number)) {
        return $number;
    }

    $number = trim($number);
    $number = strtr($number, array(' ' => ''));
    $number = preg_replace('/ +/', '', $number);
    $number = str_replace(',', '.', $number);
    $number = preg_replace('/[^0-9\.]/', '', $number);

    return $number;
}

function get_random_string($length = 10) {
    $key = '';
    $keys = array_merge(range(0, 9), range('a', 'z'));

    for ($i = 0; $i < $length; $i++) {
        $key .= $keys[array_rand($keys)];
    }

    return $key;
}

function get_extension($file) {
    $file_ext = explode(".", $file);
    $extension = end($file_ext);
    return $extension ? $extension : false;
}

function addhttp($url) {
    if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
        $url = "http://" . $url;
    }
    return $url;
}

function headerRedirect($url){
    header("Location: $url");
}

function log_adm_action($summary,$details)
{
    global $config;
    $now = time();
    $logs = ORM::for_table($config['db']['pre'].'logs')->create();
    $logs->log_date = $now;
    $logs->log_summary = $summary;
    $logs->log_details = $details;
    $logs->save();
}

function run_cron_job(){

    global $config,$lang,$link;
    $pdo = ORM::get_db();
    $cron_time = isset($config['cron_time']) ? $config['cron_time'] : 0;
    $cron_exec_time = isset($config['cron_exec_time']) ? $config['cron_exec_time'] : "300";

    if((time()-$cron_exec_time) > $cron_time) {

        ignore_user_abort(1);
        @set_time_limit(0);

        $start_time = time();
        update_option('cron_time',time());

        $ads_closed = ORM::for_table($config['db']['pre'].'product')
            ->where_any_is(array(
                array('status' => 'expire', 'expire_date' => $start_time)), array('expire_date' => '<'))
            ->count();


        $query = "UPDATE `".$config['db']['pre']."product` SET `status` = 'expire' WHERE `expire_date` < '" . time() . "' AND status='active'";
        $pdo->query($query);


        /**
         * DELETE EXPIRY AD IN 3 Days
         *
         */
        if($config['delete_expired'] == 1){

            $expiry_time = time()-259200;
            ORM::for_table($config['db']['pre'].'product')
                ->where_any_is(array(
                    array('status' => 'expire', 'expire_date' => $expiry_time)), array('expire_date' => '<'))
                ->delete_many();

        }

// DELETE EXPIRY AD

        /**
         * Update Online Status
         *
         */

        $query = "UPDATE `".$config['db']['pre']."user` SET `online` = '0' WHERE `online` = '1' AND `lastactive` < '".validate_input(time()-60)."'";
        $pdo->query($query);

// END UPDATE ONLINE STATUS

        /**
         * START REMOVE OLD PENDING TRANSACTIONS IN 3 Days
         *
         */
        $expiry_time = time()-259200;
        ORM::for_table($config['db']['pre'].'transaction')
            ->where_any_is(array(
                array('status' => 'pending', 'transaction_time' => $expiry_time)), array('transaction_time' => '<'))
            ->delete_many();
         // END REMOVE OLD PENDING TRANSACTIONS

        /**
         * START REMOVE EXPIRED UPGRADES IN 24 Hours
         *
         */
        $expire_membership = 0;
        $expiry_time = time()-86400;

        // END - CLOSE OLD ADS

        $query = "UPDATE `".$config['db']['pre']."product` SET `featured` = '0' WHERE `featured_exp_date` < '" . time() . "'";
        $pdo->query($query);

        $query = "UPDATE `".$config['db']['pre']."product` SET `urgent` = '0' WHERE `urgent_exp_date` < '" . time() . "'";
        $pdo->query($query);

        $query = "UPDATE `".$config['db']['pre']."product` SET `highlight` = '0' WHERE `highlight_exp_date` < '" . time() . "'";
        $pdo->query($query);

        $result = ORM::for_table($config['db']['pre'].'upgrades')
            ->select_many('upgrade_id','user_id')
            ->where_lt('upgrade_expires', $expiry_time)
            ->find_many();
        foreach ($result as $info)
        {
            $person_count = ORM::for_table($config['db']['pre'].'user')
                ->where('id', $info['user_id'])
                ->count();
            if($person_count){
                $person = ORM::for_table($config['db']['pre'].'user')->find_one($info['user_id']);
                $person->group_id = 1;
                $person->save();
            }
            ORM::for_table($config['db']['pre'].'upgrades')
                ->where_equal('upgrade_id', $info['upgrade_id'])
                ->delete_many();

            $expire_membership++;
        }
        // END REMOVE EXPIRED UPGRADES

        /**
         * Email Notification To user
         *
         */
        $email_q = 0;
        $pemail_ad = 0;

        $result = ORM::for_table($config['db']['pre'].'product')
            ->select_many('id','product_name','category')
            ->where(array(
                'status' => 'active',
                'emailed' => 0
            ))
            ->find_many();

        foreach ($result as $info)
        {
            $product = ORM::for_table($config['db']['pre'].'product')->find_one($info['id']);
            $product->emailed = 1;
            $product->save();

            $where = '';
            $cats = explode(',',$info['category']);
            $qemails = array();
            $pemail_ad++;

            foreach ($cats as $key => $value)
            {
                if($value != '')
                {
                    if($where == '')
                    {
                        $where = "cat_id='".$value."'";
                    }
                    else
                    {
                        $where.= " OR cat_id='".$value."'";
                    }
                }
            }

            if($where)
            {

                $ad_id = $info['id'];
                $ad_title = $info['product_name'];
                $ad_link = $config['site_url']."ad/".$ad_id;

                $page = new HtmlTemplate();
                $page->html = $config['email_sub_post_notification'];
                $page->SetParameter ('ADTITLE', $ad_title);
                $page->SetParameter ('ADLINK', $ad_link);
                $page->SetParameter ('ADID', $ad_id);
                $email_subject = $page->CreatePageReturn($lang,$config,$link);

                $page = new HtmlTemplate();
                $page->html = $config['email_message_post_notification'];;
                $page->SetParameter ('ADTITLE', $ad_title);
                $page->SetParameter ('ADLINK', $ad_link);
                $page->SetParameter ('ADID', $ad_id);
                $email_body = $page->CreatePageReturn($lang,$config,$link);



                $query2 = "SELECT * FROM ".$config['db']['pre']."notification WHERE ".$where;
                $query_result2 = $pdo->query($query2);
                while ($info2 = @mysqli_fetch_array($query_result2))
                {
                    $info3 = ORM::for_table($config['db']['pre'].'user')
                        ->select_many('name','username')
                        ->where(array(
                            'status' => 1,
                            'id' => $info2['user_id']
                        ))
                        ->find_one();

                    if(!empty($info3))
                    {
                        if($info3->name == "")
                            $name = $info3->username;
                        else
                            $name = $info3->name;

                        $insert_active = ORM::for_table($config['db']['pre'].'emailq')->create();
                        $insert_active->email = $info2['user_email'];
                        $insert_active->toname = $name;
                        $insert_active->subject = $email_subject;
                        $insert_active->body = $email_body;
                        $insert_active->save();
                    }
                }
            }
        }

        $emails_sent = 0;

        $result = ORM::for_table($config['db']['pre'].'emailq')
            ->order_by_asc('q_id')
            ->limit(60)
            ->find_many();
        foreach ($result as $info)
        {
            email($info['email'],$info['toname'],$info['subject'],$info['body']);

            ORM::for_table($config['db']['pre'].'emailq')
                ->where_equal('q_id', $info['q_id'])
                ->delete_many();

            $emails_sent++;
        }

        $end_time = (time()-$start_time);

        $cron_details = "Ads closed: ".$ads_closed."<br>";
        $cron_details.= "New ad: ".$pemail_ad."<br>";
        $cron_details.= "Expire membership: ".$expire_membership."<br>";
        $cron_details.= "Emails added to the queue: ".$email_q."<br>";
        $cron_details.= "Emails sent: ".$emails_sent."<br>";
        $cron_details.= "<br>";
        $cron_details.= "Cron Took: ".$end_time." seconds";

        log_adm_action('Cron Run',$cron_details);
    }
    else {
        return false;
    }
}

function parse_name_from_email($text)
{
    list($text) = explode('@', $text);
    $text = preg_replace('/[^a-z0-9]/i', '', $text);
    return $text;
}
?>