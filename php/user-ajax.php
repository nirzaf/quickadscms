<?php
require_once('../includes/config.php');
require_once('../includes/sql_builder/idiorm.php');
require_once('../includes/db.php');
require_once('../includes/classes/class.template_engine.php');
require_once('../includes/classes/class.country.php');
require_once('../includes/functions/func.global.php');
require_once('../includes/functions/func.sqlquery.php');
require_once('../includes/functions/func.users.php');
require_once('../includes/lang/lang_'.$config['lang'].'.php');
require_once('../includes/seo-url.php');

sec_session_start();
if (isset($_GET['action'])){
    if ($_GET['action'] == "email_contact_seller") { email_contact_seller(); }
    if ($_GET['action'] == "deleteMyAd") { deleteMyAd(); }
    if ($_GET['action'] == "deleteResumitAd") { deleteResumitAd(); }

    if ($_GET['action'] == "openlocatoionPopup") { openlocatoionPopup(); }
    if ($_GET['action'] == "getlocHomemap") { getlocHomemap(); }
    if ($_GET['action'] == "searchCityFromCountry") {searchCityFromCountry();}
}

if(isset($_POST['action'])){
    if ($_POST['action'] == "removeImage") { removeImage(); }
    if ($_POST['action'] == "hideItem") { hideItem(); }
    if ($_POST['action'] == "removeAdImg") { removeAdImg(); }
    if ($_POST['action'] == "setFavAd") {setFavAd();}
    if ($_POST['action'] == "removeFavAd") {removeFavAd();}
    if ($_POST['action'] == "getsubcatbyidList") { getsubcatbyidList(); }
    if ($_POST['action'] == "getsubcatbyid") {getsubcatbyid();}
    if ($_POST['action'] == "getCustomFieldByCatID") {getCustomFieldByCatID();}

    if ($_POST['action'] == "getStateByCountryID") {getStateByCountryID();}
    if ($_POST['action'] == "getCityByStateID") {getCityByStateID();}
    if ($_POST['action'] == "getCityidByCityName") {getCityidByCityName();}
    if ($_POST['action'] == "ModelGetStateByCountryID") {ModelGetStateByCountryID();}
    if ($_POST['action'] == "ModelGetCityByStateID") {ModelGetCityByStateID();}
    if ($_POST['action'] == "searchStateCountry") {searchStateCountry();}
    if ($_POST['action'] == "searchCityStateCountry") {searchCityStateCountry();}
    if ($_POST['action'] == "ajaxlogin") {ajaxlogin();}
    if ($_POST['action'] == "email_verify") {email_verify();}
    if ($_POST['action'] == "quickad_ajax_home_search") {quickad_ajax_home_search();}
}

function ajaxlogin(){
    global $config,$lang;
    $loggedin = userlogin($_POST['username'], $_POST['password']);

    if(!is_array($loggedin))
    {
        echo $lang['USERNOTFOUND'];
    }
    elseif($loggedin['status'] == 2)
    {
        echo $lang['ACCOUNTBAN'];
    }
    else
    {
        $user_browser = $_SERVER['HTTP_USER_AGENT']; // Get the user-agent string of the user.
        $user_id = preg_replace("/[^0-9]+/", "", $loggedin['id']); // XSS protection as we might print this value
        $_SESSION['user']['id']  = $user_id;
        $username = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $loggedin['username']); // XSS protection as we might print this value
        $_SESSION['user']['username'] = $username;
        $_SESSION['user']['login_string'] = hash('sha512', $loggedin['password'] . $user_browser);

        update_lastactive();

        echo "success";
    }
    die();

}

function email_verify(){
    global $config,$lang;

    if(checkloggedin())
    {
        /*SEND CONFIRMATION EMAIL*/
        email_template("signup_confirm",$_SESSION['user']['id']);

        $respond = $lang['SENT'];
        echo '<a class="uiButton uiButtonLarge resend" style="box-sizing:content-box;"><span class="uiButtonText">'.$respond.'</span></a>';
        die();

    }
    else
    {
        header("Location: ".$config['site_url']."login");
        exit;
    }
}

function removeImage(){
    global $config;
    if(isset($_POST['product_id'])){
        $id = $_POST['product_id'];
        $info = ORM::for_table($config['db']['pre'].'product')->select('screen_shot')->find_one($_POST['product_id']);

        $screnshots = explode(',',$info['screen_shot']);
        if($key = array_search($_POST['imagename'],$screnshots) != -1){
            unset($screnshots[$key]);
            $screens = implode(',',$screnshots);
            $product = ORM::for_table($config['db']['pre'].'product')->find_one($id);
            $product->screen_shot = $screens;
            $product->save();
        }
    }

}

function email_contact_seller(){
    global $config,$lang,$link;
    if (isset($_POST['sendemail'])) {

        $item_id = $_POST['id'];
        $iteminfo = get_item_by_id($item_id);

        $item_title = $iteminfo['title'];
        $item_author_name = $iteminfo['author_name'];
        $item_author_email = $iteminfo['author_email'];

        $ad_link = $config['site_url']."ad/".$item_id;
        $page = new HtmlTemplate();
        $page->html = $config['email_sub_contact_seller'];
        $page->SetParameter ('ADTITLE', $item_title);
        $page->SetParameter ('ADLINK', $ad_link);
        $page->SetParameter ('SELLER_NAME', $item_author_name);
        $page->SetParameter ('SELLER_EMAIL', $item_author_email);
        $page->SetParameter('SENDER_NAME', $_POST['name']);
        $page->SetParameter('SENDER_EMAIL', $_POST['email']);
        $page->SetParameter('SENDER_PHONE', $_POST['phone']);
        $email_subject = $page->CreatePageReturn($lang,$config,$link);

        $page = new HtmlTemplate();
        $page->html = $config['email_message_contact_seller'];;
        $page->SetParameter ('ADTITLE', $item_title);
        $page->SetParameter ('ADLINK', $ad_link);
        $page->SetParameter ('SELLER_NAME', $item_author_name);
        $page->SetParameter ('SELLER_EMAIL', $item_author_email);
        $page->SetParameter('SENDER_NAME', $_POST['name']);
        $page->SetParameter('SENDER_EMAIL', $_POST['email']);
        $page->SetParameter('SENDER_PHONE', $_POST['phone']);
        $page->SetParameter('MESSAGE', $_POST['message']);
        $email_body = $page->CreatePageReturn($lang,$config,$link);

        email($item_author_email,$item_author_name,$email_subject,$email_body);

        echo 'success';
        die();
    }else{
        echo 0;
        die();
    }
}

function getStateByCountryID()
{
    global $config;
    $country_code = isset($_POST['id']) ? $_POST['id'] : 0;
    $selectid = isset($_POST['selectid']) ? $_POST['selectid'] : "";

    $rows = ORM::for_table($config['db']['pre'].'subadmin1')
        ->select_many('id','code','name')
        ->where(array(
            'country_code' => $country_code,
            'active' => 1
        ))
        ->order_by_desc('name')
        ->find_many();

    if (count($rows) > 0) {

        $list = '<option value="">Select State</option>';
        foreach ($rows as $info) {
            $name = $info['name'];
            $state_id = $info['id'];
            $state_code = $info['code'];
            if($selectid == $state_code){
                $selected_text = "selected";
            }
            else{
                $selected_text = "";
            }
            $list .= '<option value="'.$state_code.'" '.$selected_text.'>'.$name.'</option>';
        }

        echo $list;
    }
}

function getCityByStateID()
{
    global $config;
    $state_id = isset($_POST['id']) ? $_POST['id'] : 0;
    $selectid = isset($_POST['selectid']) ? $_POST['selectid'] : "";

    $rows = ORM::for_table($config['db']['pre'].'cities')
        ->select_many('id','name')
        ->where(array(
            'subadmin1_code' => $state_id,
            'active' => 1
        ))
        ->find_many();

    if (count($rows) > 0) {

        $list = '<option value="">Select City</option>';
        foreach ($rows as $info) {
            $name = $info['name'];
            $id = $info['id'];
            if($selectid == $id){
                $selected_text = "selected";
            }
            else{
                $selected_text = "";
            }
            $list .= '<option value="'.$id.'" '.$selected_text.'>'.$name.'</option>';
        }
        echo $list;
    }
}

function getCityidByCityName()
{
    global $config;
    $country_code = isset($_POST['country']) ? $_POST['country'] : "";
    $state = isset($_POST['state']) ? $_POST['state'] : "";
    $city_name = isset($_POST['city']) ? $_POST['city'] : "";

    $info = ORM::for_table($config['db']['pre'].'subadmin1')
        ->select('code')
        ->where('active', '1')
        ->where_raw('(`name` = ? OR `asciiname` = ?)', array($state, $state))
        ->find_one();

    $state_code = $info['code'];

    $info2 = ORM::for_table($config['db']['pre'].'cities')
        ->select('id')
        ->where(array(
            'subadmin1_code' => $state_code,
            'country_code' => $country_code,
            'active' => 1
        ))
        ->where_raw('(`name` = ? OR `asciiname` = ?)', array($city_name, $city_name))
        ->find_one();
    if ($info2['id']) {
        echo $id = $info2['id'];
    }


    die();
}

function ModelGetStateByCountryID()
{
    global $config,$lang;
    $country_code = isset($_POST['id']) ? $_POST['id'] : 0;
    $countryName = get_countryName_by_id($country_code);

    $result = ORM::for_table($config['db']['pre'].'subadmin1')
        ->select_many('id','code','asciiname')
        ->where(array(
            'country_code' => $country_code,
            'active' => 1
        ))
        ->order_by_desc('asciiname')
        ->find_many();


    $list = '<ul class="column col-md-12 col-sm-12 cities">';
    $count = 1;
    if (count($result) > 0) {
        foreach ($result as $row) {
            $name = $row['asciiname'];
            $id = $row['code'];

            if($count == 1)
            {
                $list .=  '<li class="selected"><a class="selectme" data-id="'.$country_code.'" data-name="'.$lang['ALL'].' '.$countryName.'" data-type="country"><strong>'.$lang['ALL'].' '.$countryName.'</strong></a></li>';
            }
            $list .= '<li class=""><a id="region'.$id.'" class="statedata" data-id="'.$id.'" data-name="'.$name.'"><span>'.$name.' <i class="fa fa-angle-right"></i></span></a></li>';

            $count++;
        }
        echo $list."</ul>";
    }
}

function ModelGetCityByStateID()
{
    global $config,$lang;
    $state_id = isset($_POST['id']) ? $_POST['id'] : '0';
    $stateName = get_stateName_by_id($state_id);
    //$state_code = substr($state_id,3);
    $country_code = substr($state_id,0,2);

    $result = ORM::for_table($config['db']['pre'].'cities')
        ->select_many('id','asciiname')
        ->where(array(
            'subadmin1_code' => $state_id,
            'country_code' => $country_code,
            'active' => 1
        ))
        ->order_by_asc('asciiname')
        ->find_many();

    //echo ORM::get_last_query();

    if($result){
        $total = count($result);
        $list = '<ul class="column col-md-12 col-sm-12 cities">';
        $count = 1;
        if ($total > 0) {
            foreach ($result as $row) {
                $name = $row['asciiname'];
                $id = $row['id'];
                if($count == 1)
                {
                    $list .=  '<li class="selected"><a id="changeState"><strong><i class="fa fa-arrow-left"></i>'.$lang['CHANGE_REGION'].'</strong></a></li>';
                    $list .=  '<li class="selected"><a class="selectme" data-id="'.$state_id.'" data-name="'.$stateName.', '.$lang['REGION'].'" data-type="state"><strong>'.$lang['WHOLE'].' '.$stateName.'</strong></a></li>';
                }

                $list .= '<li class=""><a id="region'.$id.'" class="selectme" data-id="'.$id.'" data-name="'.$name.', '.$lang['CITY'].'" data-type="city"><span>'.$name.' <i class="fa fa-angle-right"></i></span></a></li>';
                $count++;
            }

            echo $list."</ul>";
        }

    }else{
        echo '<ul class="column col-md-12 col-sm-12 cities">
            <li class="selected"><a id="changeState"><strong><i class="fa fa-arrow-left"></i>'.$lang['CHANGE_REGION'].'</strong></a></li>
            <li><a> '.$lang['NO-CITY_AVAILABLE'].'</a></li>
            </ul>';
    }

}

function searchCityFromCountry()
{
    global $config;
    $dataString = isset($_GET['q']) ? $_GET['q'] : "";
    $sortname = check_user_country();

    $perPage = 10;
    $page = isset($_GET['page']) ? $_GET['page'] : "1";
    $start = ($page-1)*$perPage;
    if($start < 0) $start = 0;

    $total = ORM::for_table($config['db']['pre'].'cities')
        ->where(array(
            'country_code' => 'sortname',
            'active' => 1
        ))
        ->where_like('asciiname', ''.$dataString.'%')
        ->count();

    $sql = "SELECT c.id, c.asciiname, c.latitude, c.longitude, c.subadmin1_code, s.name AS statename
FROM `".$config['db']['pre']."cities` AS c
INNER JOIN `".$config['db']['pre']."subadmin1` AS s ON s.code = c.subadmin1_code and s.active = 1
 WHERE (c.name like '%$dataString%' or c.asciiname like '%$dataString%') and c.country_code = '$sortname' and c.active = 1
 ORDER BY
  CASE
    WHEN c.name = '$dataString' THEN 1
    WHEN c.name LIKE '$dataString%' THEN 2
    ELSE 3
  END ";
    $query =  $sql . " limit " . $start . "," . $perPage;
    $pdo = ORM::get_db();
    $rows = $pdo->query($query);
    if(empty($_GET["rowcount"])) {
        $pdo = ORM::get_db();
        $_GET["rowcount"] = $rowcount = count($pdo->query($sql));
    }

    $pages  = ceil($_GET["rowcount"]/$perPage);

    $items = '';
    $i = 0;
    $MyCity = array();

    foreach ($rows as $row) {
        $cityid = $row['id'];
        $cityname = $row['asciiname'];
        $latitude = $row['latitude'];
        $longitude = $row['longitude'];
        $statename = $row['statename'];

        $MyCity[$i]["id"]   = $cityid;
        $MyCity[$i]["text"] = $cityname.", ".$statename;
        $MyCity[$i]["latitude"]   = $latitude;
        $MyCity[$i]["longitude"]   = $longitude;
        $i++;
    }

    echo $json = '{"items" : '.json_encode($MyCity, JSON_UNESCAPED_SLASHES).',"totalEntries" : '.$total.'}';
    die();
}

function searchStateCountry()
{
    global $config,$lang;
    $dataString = isset($_POST['dataString']) ? $_POST['dataString'] : "";
    $sortname = check_user_country();
    $query = "SELECT c.id, c.asciiname, c.subadmin1_code, s.name AS statename
FROM `".$config['db']['pre']."cities` AS c
INNER JOIN `".$config['db']['pre']."subadmin1` AS s ON s.code = c.subadmin1_code and s.active = 1
 WHERE (c.name like '%$dataString%' or c.asciiname like '%$dataString%') and c.country_code = '$sortname' and c.active = 1
 ORDER BY
  CASE
    WHEN c.name = '$dataString' THEN 1
    WHEN c.name LIKE '$dataString%' THEN 2
    WHEN c.name LIKE '%$dataString' THEN 4
    ELSE 3
  END
 LIMIT 20";

    $pdo = ORM::get_db();
    $result = $pdo->query($query);
    $total = count($result);
    $list = '<ul class="searchResgeo"><li><a href="#" class="title selectme" data-id="" data-name="" data-type="">'.$lang['ANY_CITY'].'</span></a></li>';
    if ($total > 0) {
        foreach ($result as $row) {
            $cityid = $row['id'];
            $cityname = $row['asciiname'];
            $stateid = $row['subadmin1_code'];
            $statename = $row['statename'];

            $list .= '<li><a href="#" class="title selectme" data-id="'.$cityid.'" data-name="'.$cityname.'" data-type="city">'.$cityname.', <span class="color-9">'.$statename.'</span></a></li>';
        }
        $list .= '</ul>';
        echo $list;
    }
    else{
        echo '<ul class="searchResgeo"><li><span class="noresult">'.$lang['NO_RESULT_FOUND'].'</span></li>';
    }
}

function searchCityStateCountry()
{
    global $config,$lang;
    $dataString = isset($_POST['dataString']) ? $_POST['dataString'] : "";
    $sortname = check_user_country();

    $query = "SELECT c.id, c.asciiname, c.subadmin1_code, s.name AS statename
FROM `".$config['db']['pre']."cities` AS c
INNER JOIN `".$config['db']['pre']."subadmin1` AS s ON s.code = c.subadmin1_code and s.active = 1
 WHERE c.name like '%$dataString%' and c.country_code = '$sortname' and c.active = 1
 ORDER BY
  CASE
    WHEN c.name = '$dataString' THEN 1
    WHEN c.name LIKE '$dataString%' THEN 2
    WHEN c.name LIKE '%$dataString' THEN 4
    ELSE 3
  END
 LIMIT 20";
    $pdo = ORM::get_db();
    $result = $pdo->query($query);
    $total = count($result);
    $list = '<ul class="searchResgeo">';
    if ($total > 0) {
        foreach ($result as $row) {
            $cityid = $row['id'];
            $cityname = $row['asciiname'];
            $stateid = $row['subadmin1_code'];
            $countryid = $sortname;
            $statename = $row['statename'];

            $list .= '<li><a href="#" class="title selectme" data-cityid="'.$cityid.'" data-stateid="'.$stateid.'"data-countryid="'.$countryid.'" data-name="'.$cityname.', '.$statename.'">'.$cityname.', <span class="color-9">'.$statename.'</span></a></li>';
        }
        $list .= '</ul>';
        echo $list;
    }
    else{
        echo '<ul class="searchResgeo"><li><span class="noresult">'.$lang['NO_RESULT_FOUND'].'</span></li>';
    }
}

function hideItem()
{
    global $config;
    $id = $_POST['id'];
    if (trim($id) != '') {
        $info = ORM::for_table($config['db']['pre'].'product')
            ->select('hide')
            ->find_one($id);
        $status = $info['hide'];
        $pdo = ORM::get_db();
        if($status == "0"){
            $query = "UPDATE `".$config['db']['pre']."product` set hide='1' WHERE `id` = '".$id."' and `user_id` = '".$_SESSION['user']['id']."' ";
            $query_result = $pdo->query($query);
            echo 1;
        }else{
            $query = "UPDATE `".$config['db']['pre']."product` set hide='0' WHERE `id` = '".$id."' and `user_id` = '".$_SESSION['user']['id']."' ";
            $query_result = $pdo->query($query);
            echo 2;
        }
        die();
    } else {
        echo 0;
        die();
    }

}

function removeAdImg(){
    global $config;
    $id = $_POST['id'];
    $img = $_POST['img'];

    $info = ORM::for_table($config['db']['pre'].'product')->select('screen_shot')->find_one($id);

    if (!empty($info)) {
        $screen = "";
        $uploaddir =  "storage/products/";
        $screen_sm = explode(',',$info['screen_shot']);
        $count = 0;
        foreach ($screen_sm as $value)
        {
            $value = trim($value);

            if($value == $img){
                //Delete Image From Storage ----
                $filename1 = $uploaddir.$value;
                if(file_exists($filename1)){
                    $filename1 = $uploaddir.$value;
                    $filename2 = $uploaddir."small_".$value;
                    unlink($filename1);
                    unlink($filename2);
                }
            }
            else{
                if($count == 0){
                    $screen .= $value;
                }else{
                    $screen .= ",".$value;
                }
                $count++;
            }
        }
        $product = ORM::for_table($config['db']['pre'].'product')->find_one($id);
        $product->screen_shot = $screen;
        $product->save();

        echo 1;
        die();
    }
    else{
        echo 0;
        die();
    }
}

function setFavAd()
{
    global $config;
    $num_rows = ORM::for_table($config['db']['pre'].'favads')
        ->where(array(
            'user_id' => $_POST['userId'],
            'product_id' => $_POST['id']
        ))
        ->count();

    if ($num_rows == 0) {
        $insert_favads = ORM::for_table($config['db']['pre'].'favads')->create();
        $insert_favads->user_id = $_POST['userId'];
        $insert_favads->product_id = $_POST['id'];
        $insert_favads->save();

        if ($insert_favads->id())
            echo 1;
        else
            echo 0;
    }
    else{
        $result = ORM::for_table($config['db']['pre'].'favads')
            ->where(array(
                'user_id' => $_POST['userId'],
                'product_id' => $_POST['id'],
            ))
            ->delete_many();
        if ($result)
            echo 2;
        else
            echo 0;
    }
    die();
}

function removeFavAd()
{
    global $config;
    $result = ORM::for_table($config['db']['pre'].'favads')
        ->where(array(
            'user_id' => $_POST['userId'],
            'product_id' => $_POST['id'],
        ))
        ->delete_many();

    if ($result)
        echo 1;
    else
        echo 0;

    die();
}

function deleteMyAd()
{
    global $config;
    if(isset($_POST['id']))
    {
        $row = ORM::for_table($config['db']['pre'].'product')
            ->select('screen_shot')
            ->where(array(
                'id' => $_POST['id'],
                'user_id' => $_SESSION['user']['id'],
            ))
            ->find_one();


        if (!empty($row)) {
            $uploaddir =  "storage/products/";
            $screen_sm = explode(',',$row['screen_shot']);
            foreach ($screen_sm as $value)
            {
                $value = trim($value);
                //Delete Image From Storage ----
                $filename1 = $uploaddir.$value;
                if(file_exists($filename1)){
                    $filename1 = $uploaddir.$value;
                    $filename2 = $uploaddir."small_".$value;
                    unlink($filename1);
                    unlink($filename2);
                }
            }

            ORM::for_table($config['db']['pre'].'product')
                ->where(array(
                    'id' => $_POST['id'],
                    'user_id' => $_SESSION['user']['id'],
                ))
                ->delete_many();
        }

        echo 1;
        die();
    }else {
        echo 0;
        die();
    }

}

function deleteResumitAd()
{
    global $config;
    if(isset($_POST['id']))
    {
        $info = ORM::for_table($config['db']['pre'].'product')
            ->select('screen_shot')
            ->where(array(
                'id' => $_POST['id'],
                'user_id' => $_SESSION['user']['id'],
            ))
            ->find_one();

        $info1 = ORM::for_table($config['db']['pre'].'product_resubmit')
            ->select('screen_shot')
            ->where(array(
                'id' => $_POST['id'],
                'user_id' => $_SESSION['user']['id'],
            ))
            ->find_one();

        if (!empty($info)) {

            $uploaddir =  "storage/products/";
            $screen_sm = explode(',',$info['screen_shot']);
            $re_screen = explode(',',$info1['screen_shot']);

            $arr = array_diff($re_screen,$screen_sm);

            foreach ($arr as $value)
            {
                $value = trim($value);

                //Delete Image From Storage ----
                $filename1 = $uploaddir.$value;
                if(file_exists($filename1)){
                    $filename1 = $uploaddir.$value;
                    $filename2 = $uploaddir."small_".$value;
                    unlink($filename1);
                    unlink($filename2);
                }
            }

            ORM::for_table($config['db']['pre'].'product_resubmit')
                ->where(array(
                    'product_id' => $_POST['id'],
                    'user_id' => $_SESSION['user']['id'],
                ))
                ->delete_many();
        }

        echo 1;
        die();
    }else {
        echo 0;
        die();
    }

}

function getsubcatbyid()
{
    global $config;
    $id = isset($_POST['catid']) ? $_POST['catid'] : 0;
    $selectid = isset($_POST['selectid']) ? $_POST['selectid'] : "";

    $rows = ORM::for_table($config['db']['pre'].'catagory_sub')
        ->where('main_cat_id',$id)
        ->find_many();

    if (count($rows) > 0) {

        foreach ($rows as $info) {
            $name = $info['sub_cat_name'];
            $sub_id = $info['sub_cat_id'];
            $photo_show = $info['photo_show'];
            $price_show = $info['price_show'];
            if($selectid == $sub_id){
                $selected_text = "selected";
            }
            else{
                $selected_text = "";
            }
            echo '<option value="'.$sub_id.'" data-photo-show="'.$photo_show.'" data-price-show="'.$price_show.'" '.$selected_text.'>'.$name.'</option>';
        }
    }else{
        echo 0;
    }
    die();
}

function getsubcatbyidList()
{
    global $config;
    $id = isset($_POST['catid']) ? $_POST['catid'] : 0;
    $selectid = isset($_POST['selectid']) ? $_POST['selectid'] : "";

    $rows = ORM::for_table($config['db']['pre'].'catagory_sub')
        ->where('main_cat_id',$id)
        ->find_many();

    if (count($rows) > 0) {

        foreach ($rows as $info) {

            $name = $info['sub_cat_name'];
            $sub_id = $info['sub_cat_id'];
            $photo_show = $info['photo_show'];
            $price_show = $info['price_show'];
            if($selectid == $sub_id){
                $selected_text = "link-active";
            }
            else{
                $selected_text = "";
            }

            if($config['lang_code'] != 'en' && $config['userlangsel'] == '1'){
                $subcat = get_category_translation("sub",$info['sub_cat_id']);
                $name = $subcat['title'];
            }else{
                $name = $info['sub_cat_name'];
            }

            echo '<li data-ajax-subcatid="'.$sub_id.'" data-photo-show="'.$photo_show.'" data-price-show="'.$price_show.'" class="'.$selected_text.'"><a href="#">'.$name.'</a></li>';
        }

    }else{
        echo 0;
    }
    die();
}

function getCustomFieldByCatID()
{
    global $config,$lang;
    $maincatid = isset($_POST['catid']) ? $_POST['catid'] : 0;
    $subcatid = isset($_POST['subcatid']) ? $_POST['subcatid'] : 0;

    if ($maincatid > 0) {
        $custom_fields = get_customFields_by_catid($maincatid,$subcatid);
        $showCustomField = (count($custom_fields) > 0) ? 1 : 0;
    } else {
        die();
    }
    $tpl = '';
    if ($showCustomField) {
        foreach ($custom_fields as $row) {
            $id = $row['id'];
            $name = $row['title'];
            $type = $row['type'];
            $required = $row['required'];

            if($type == "text-field"){
                $lookFront = $row['textbox'];
                $tpl .= '<div class="row form-group">
                            <label class="col-sm-3 label-title">'.$name.' '.($required === "1" ? '<span class="required">*</span>' : "").'</label>
                            <div class="col-sm-9">
                                '.$lookFront.'
                            </div>
                        </div>';
            }
            elseif($type == "textarea"){
                $lookFront = $row['textarea'];
                $tpl .= '<div class="row form-group">
                                <label class="col-sm-3 label-title">'.$name.' '.($required === "1" ? '<span class="required">*</span>' : "").'</label>
                                <div class="col-sm-9">
                                    '.$lookFront.'
                                </div>
                            </div>';
            }
            elseif($type == "radio-buttons"){
                $lookFront = $row['radio'];
                $tpl .= '<div class="row form-group">
                                <label class="col-sm-3 label-title">'.$name.' '.($required === "1" ? '<span class="required">*</span>' : "").'</label>
                                <div class="col-sm-9">'.$lookFront.'</div>
                            </div>';
            }
            elseif($type == "checkboxes"){
                $lookFront = $row['checkboxBootstrap'];
                $tpl .= '<div class="row form-group">
                                <label class="col-sm-3 label-title">'.$name.' '.($required === "1" ? '<span class="required">*</span>' : "").'</label>
                                <div class="col-sm-9">'.$lookFront.'</div>
                            </div>';
            }
            elseif($type == "drop-down"){
                $lookFront = $row['selectbox'];
                $tpl .= '<div class="row form-group">
                                <label class="col-sm-3 label-title">'.$name.' '.($required === "1" ? '<span class="required">*</span>' : "").'</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="custom['.$id.']" '.$required.'>
                                        <option value="" selected>'.$lang['SELECT'].' '.$name.'</option>
                                        '.$lookFront.'
                                    </select>
                                </div>
                            </div>';
            }
        }
        echo $tpl;
        die();
    } else {
        echo 0;
        die();
    }
}

function getlocHomemap()
{
    global $config;
    $appr = 'active';
    $country = check_user_country();

    if(isset($_GET['serachStr'])){
        $serachStr = $_GET['serachStr'];
    }
    else{
        $serachStr = '';
    }

    if(isset($_GET['state'])){
        $state = $_GET['state'];
    }
    else{
        $state = '';
    }
    if(!empty($_GET['city'])){
        $city = $_GET['city'];
    }
    else{
        if(!empty($_GET['locality'])){
            $city = $_GET['locality'];
        }else{
            $city = '';
        }
    }
    if(isset($_GET['searchBox'])){
        $searchBox = $_GET['searchBox'];
    }
    else{
        $searchBox = '';
    }

    if(isset($_GET['catid'])){
        $catid = $_GET['catid'];
    }
    else{
        $catid = '';
    }


    $where = "";



    if ($city != '') {

        if ($serachStr != '') {
            $where .= " product_name LIKE '%".validate_input($serachStr)."%'";
        }

        if ($searchBox != '') {
            $where .= " category = '".validate_input($searchBox)."'";
        }

        if ($catid != '') {
            $where .= " sub_category = '".validate_input($catid)."'";
        }

        if ($country != '') {
            $where .= " country = '".validate_input($country)."'";
        }

        /*$query = "SELECT p.*,c.id AS cityid
        FROM `".$config['db']['pre']."cities` AS c
        INNER JOIN `".$config['db']['pre']."product` AS p ON p.city = c.id Where (c.name like '%$city%' or c.asciiname like '%$city%') AND p.status = 'active' $where";*/

    }
    else{

        if ($serachStr != '') {
            $where .= " product_name LIKE '%".validate_input($serachStr)."%'";
        }

        if ($searchBox != '') {
            $where .= " category = '".validate_input($searchBox)."'";
        }

        if ($catid != '') {
            $where .= " sub_category = '".validate_input($catid)."'";
        }

        if ($country != '') {
            $where .= " country = '".validate_input($country)."'";
        }


    }

    $results = ORM::for_table($config['db']['pre'].'product')
        ->where('status', $appr)
        ->where_raw($where)
        ->find_many();

    $data = array();
    $i = 0;
    if (count($results) > 0) {

        foreach($results as $result){
            $id = $result['id'];
            $featured = $result['featured'];
            $urgent = $result['urgent'];
            $highlight = $result['highlight'];
            $title = $result['product_name'];
            $cat = $result['category'];
            $price = $result['price'];
            $pics = $result['screen_shot'];
            $location = $result['location'];
            $latlong = $result['latlong'];
            $desc = $result['description'];
            $url = $config['site_url'].$id;

            $fetch = ORM::for_table($config['db']['pre'].'catagory_main')
                ->where('cat_id',$cat)
                ->find_one();

            $catIcon = $fetch['icon'];
            $catname = $fetch['cat_name'];

            $map = explode(',', $latlong);
            $lat = $map[0];
            $long = $map[1];

            $p = explode(',', $pics);
            $pic = $p[0];
            $pic = $config['site_url'].'storage/products/'.$pic;

            $data[$i]['id'] = $id;
            $data[$i]['latitude'] = $lat;
            $data[$i]['longitude'] = $long;
            $data[$i]['featured'] = $featured;
            $data[$i]['title'] = $title;
            $data[$i]['location'] = $location;
            $data[$i]['category'] = $catname;
            $data[$i]['cat_icon'] = $catIcon;
            $data[$i]['marker_image'] = $pic;
            $data[$i]['url'] = $url;
            $data[$i]['description'] = $desc;

            $i++;
        }
        echo json_encode($data);
    } else {
        echo '0';
    }
    die();
}

function openlocatoionPopup()
{
    global $config;
    $rows = ORM::for_table($config['db']['pre'].'product')->find_one($_POST['id']);

    $data = array();
    $i = 0;
    if (!empty($rows)) {
        foreach ($rows as $result) {
            $id = $result['id'];
            $featured = $result['featured'];
            $urgent = $result['urgent'];
            $highlight = $result['highlight'];
            $title = $result['product_name'];
            $cat = $result['category'];
            $price = $result['price'];
            $pics = $result['screen_shot'];
            $location = $result['location'];
            $city_id = $result['city'];
            $cityname = get_cityName_by_id($result['city']);
            $country = get_countryName_by_id($result['country']);

            $location = $cityname.", ".$country;

            $latlong = $result['latlong'];
            $desc = $result['description'];
            $url = $config['site_url']."ad/".$id;

            $fetch = ORM::for_table($config['db']['pre'].'catagory_main')
                ->where('cat_id',$cat)
                ->find_one();
            $catIcon = $fetch['icon'];
            $catname = $fetch['cat_name'];

            $map = explode(',', $latlong);
            $lat = $map[0];
            $long = $map[1];


            $picture = explode(',', $pics);
            $pic_count = count($picture);
            if($picture[0] != ""){
                $pic = $picture[0];
                $pic = $config['site_url'].'storage/products/thumb/'.$pic;
                $pic = '<img class="activator" src="' . $pic . '">';
            }else{
                $pic = "";
            }



            echo '<div class="item gmapAdBox" data-id="' . $id . '" style="margin-bottom: 0px;">
                    <a href="' . $url . '" style="display: block;position: relative;">
                     <div class="card small">
                        <div class="card-image waves-effect waves-block waves-light">
                          ' . $pic . '
                        </div>
                        <div class="card-content">
                            <div class="label label-default">' . $catname . '</div>
                          <span class="card-title activator grey-text text-darken-4 mapgmapAdBoxTitle">' . $title . '</span>
                          <p class="mapgmapAdBoxLocation">' . $location . '</p>
                        </div>
                      </div>

                    </a>
                </div>';

        }
    } else {
        echo false;
    }
    die();
}

function quickad_ajax_home_search()
{
    global $config,$lang,$link,$cats;
    $pdo = ORM::get_db();
    $searchmode = "titlematch";
    $qString      = '';
    $qString      = $_POST['tagID'];
    $qString      = strtolower($qString);
    $output       = array();
    $TAGOutput    = array();
    $CATOutput    = array();
    $TagCatOutput = array();
    $TitleOutput  = array();
    $lpsearchMode = "titlematch";
    $catIcon_type = "icon";

    if( isset($searchmode) ){
        if( !empty($searchmode) && $searchmode=="keyword" ){
            $lpsearchMode = "keyword";
        }
    }

    if (empty($qString)) {

        $categories = get_maincategory();
        $catIcon    = '';
        foreach ($categories as $cat) {
            $catIcon = $cat['icon'];
            if (!empty($catIcon)) {
                if($catIcon_type == "image")
                    $catIcon = '<img src="' . $catIcon . '" />';
                else
                    $catIcon = '<i class="' . $catIcon . '" ></i>';
            }
            $cats[$cat['id']] = '<li class="lp-default-cats" data-catid="' . $cat['id'] . '">' . $catIcon . '<span class="qucikad-as-cat">' . $cat['name'] . '</span></li>';
        }
        $output           = array(
            'tag' => '',
            'cats' => $cats,
            'tagsncats' => '',
            'titles' => '',
            'more' => ''
        );
        $query_suggestion = json_encode(array(
            "tagID" => $qString,
            "suggestions" => $output
        ));
        die($query_suggestion);
    }
    else {
        //$catTerms = get_maincategory();


        if( $lpsearchMode == "keyword" ){

            $sql = "SELECT DISTINCT *
FROM `".$config['db']['pre']."catagory_main`
 WHERE cat_name like '%$qString%'
 ORDER BY
  CASE
    WHEN cat_name = '$qString' THEN 1
    WHEN cat_name LIKE '$qString%' THEN 2
    ELSE 3
  END ";
        }else{

            $sql = "SELECT DISTINCT *
FROM `".$config['db']['pre']."catagory_main`
 WHERE cat_name like '$qString%'
 ORDER BY
  CASE
    WHEN cat_name = '$qString' THEN 1
    WHEN cat_name LIKE '$qString%' THEN 2
    ELSE 3
  END ";

        }

        $rows = $pdo->query($sql);
        foreach ($rows as $info) {
            $catTerms[$info['cat_id']]['id'] = $info['cat_id'];
            $catTerms[$info['cat_id']]['icon'] = $info['icon'];

            if ($config['lang_code'] != 'en' && $config['userlangsel'] == '1') {
                $maincat = get_category_translation("main", $info['cat_id']);
                $catTerms[$info['cat_id']]['name'] = $maincat['title'];
                $catTerms[$info['cat_id']]['slug'] = $maincat['slug'];
            } else {
                $catTerms[$info['cat_id']]['name'] = $info['cat_name'];
                $catTerms[$info['cat_id']]['slug'] = $info['slug'];
            }
        }


        if( $lpsearchMode == "keyword" ){

            $sql = "SELECT DISTINCT *
FROM `".$config['db']['pre']."catagory_sub`
 WHERE sub_cat_name like '%$qString%'
 ORDER BY
  CASE
    WHEN sub_cat_name = '$qString' THEN 1
    WHEN sub_cat_name LIKE '$qString%' THEN 2
    ELSE 3
  END ";
        }else{

            $sql = "SELECT DISTINCT *
FROM `".$config['db']['pre']."catagory_sub`
 WHERE sub_cat_name like '$qString%'
 ORDER BY
  CASE
    WHEN sub_cat_name = '$qString' THEN 1
    WHEN sub_cat_name LIKE '$qString%' THEN 2
    ELSE 3
  END ";

        }
        $rows = $pdo->query($sql);
        foreach ($rows as $info) {
            $subcatTerms[$info['sub_cat_id']]['id'] = $info['sub_cat_id'];

            if($config['lang_code'] != 'en' && $config['userlangsel'] == '1'){
                $subcategory = get_category_translation("sub",$info['sub_cat_id']);

                $subcatTerms[$info['sub_cat_id']]['name'] = $subcategory['title'];
                $subcatTerms[$info['sub_cat_id']]['slug'] = $subcategory['slug'];
            }else{
                $subcatTerms[$info['sub_cat_id']]['name'] = $info['sub_cat_name'];
                $subcatTerms[$info['sub_cat_id']]['slug'] =  $info['slug'];
            }

            $get_main = get_maincat_by_id($info['main_cat_id']);
            $subcatTerms[$info['sub_cat_id']]['main_cat_name'] = $get_main['cat_name'];
            $subcatTerms[$info['sub_cat_id']]['main_cat_icon'] = $get_main['icon'];
            $subcatTerms[$info['sub_cat_id']]['main_cat_id'] = $info['main_cat_id'];
        }
        //$subcatTerms = get_subcategories();

        $catName  = '';
        $catIcon  = '';
        if (!empty($catTerms) && !empty($subcatTerms)) {
            foreach ($catTerms as $cat) {
                $catIcon = $cat['icon'];
                if (!empty($catIcon)) {
                    if($catIcon_type == "image")
                        $catIcon = '<img src="' . $catIcon . '" />';
                    else
                        $catIcon = '<i class="' . $catIcon . '" ></i>';
                }

                $catTermMatch = false;

                $catTernName  = $cat['name'];
                $catTernName  = strtolower($catTernName);
                if( $lpsearchMode == "keyword" ){
                    preg_match("/[$qString]/", "$catTernName", $lpMatches, PREG_OFFSET_CAPTURE);
                    $lpresCnt = count($lpMatches);
                    if( $lpresCnt > 0 ){
                        $catTermMatch = true;
                    }

                }else{
                    $catTermMatch = strpos($catTernName, $qString);
                }

                if ( $catTermMatch !== false ) {
                    $CATOutput[$cat['id']] = '<li class="qucikad-ajaxsearch-li-cats" data-catid="' . $cat['id'] . '">' . $catIcon . '<span class="qucikad-as-cat">' . $cat['name'] . '</span></li>';
                }
            }
            foreach ($subcatTerms as $subcat) {

                $tagTermMatch = false;
                $tagTernName  = strtolower($subcat['name']);

                if( $lpsearchMode == "keyword" ){
                    preg_match("/[$qString]/", "$tagTernName", $lpMatches, PREG_OFFSET_CAPTURE);
                    $lpresCnt = count($lpMatches);
                    if( $lpresCnt > 0 ){
                        $tagTermMatch = true;
                    }
                }else{
                    $tagTermMatch = strpos($tagTernName, $qString);
                }

                if ( $tagTermMatch !== false ) {
                    $TAGOutput[$subcat['id']] = '<li class="qucikad-ajaxsearch-li-tags" data-tagid="' . $subcat['id'] . '"><span class="qucikad-as-tag">' . $subcat['name'] . '</span></li>';
                }
            }

        }
        else {

            if( !empty($catTerms) ){
                foreach ($catTerms as $cat) {

                    $catIcon = $cat['icon'];
                    if (!empty($catIcon)) {
                        if($catIcon_type == "image")
                            $catIcon = '<img src="' . $catIcon . '" />';
                        else
                            $catIcon = '<i class="' . $catIcon . '" ></i>';
                    }

                    $catTermMatch = false;

                    $catTernName  = $cat['name'];
                    $catTernName  = strtolower($catTernName);
                    if( $lpsearchMode == "keyword" ){
                        preg_match("/[$qString]/", "$catTernName", $lpMatches, PREG_OFFSET_CAPTURE);
                        $lpresCnt = count($lpMatches);
                        if( $lpresCnt > 0 ){
                            $catTermMatch = true;
                        }

                    }else{
                        $catTermMatch = strpos($catTernName, $qString);
                    }

                    if ( $catTermMatch !== false ) {
                        $CATOutput[$cat['id']] = '<li class="qucikad-ajaxsearch-li-cats" data-catid="' . $cat['id'] . '">' . $catIcon . '<span class="qucikad-as-cat">' . $cat['name'] . '</span></li>';
                    }
                }
            }

            if( !empty($subcatTerms) ) {

                foreach ($subcatTerms as $subcat) {

                    $catIcon = $subcat['main_cat_icon'];
                    if (!empty($catIcon)) {
                        if($catIcon_type == "image")
                            $catIcon = '<img class="qucikad-as-caticon" src="' . $catIcon . '" />';
                        else
                            $catIcon = '<i class="qucikad-as-caticon ' . $catIcon . '"  ></i>';
                    }
                    $tagTermMatch = false;
                    $tagTernName  = strtolower($subcat['name']);

                    if( $lpsearchMode == "keyword" ){
                        preg_match("/[$qString]/", "$tagTernName", $lpMatches, PREG_OFFSET_CAPTURE);
                        $lpresCnt = count($lpMatches);
                        if( $lpresCnt > 0 ){
                            $tagTermMatch = true;
                        }
                    }else{
                        $tagTermMatch = strpos($tagTernName, $qString);
                    }

                    if ( $tagTermMatch !== false ) {
                        //$TAGOutput[$subcat['id']]    = '<li class="qucikad-ajaxsearch-li-tags" data-tagid="' . $subcat['id'] . '"><span class="qucikad-as-tag">' . $subcat['name'] . '</span></li>';

                        $TagCatOutput[] = '<li class="cats-n-tags" data-tagid="' . $subcat['id'] . '" data-catid="' . $subcat['main_cat_id'] . '">' . $catIcon . '<span class="qucikad-as-tag">' . $subcat['name'] . '</span><span> in </span><span class="qucikad-as-cat">' . $subcat['main_cat_name'] . '</span></li>';
                    }
                }

            }
        }

        $machTitles = false;
        $country_code = check_user_country();

        if( $lpsearchMode == "keyword" ){

            $sql = "SELECT DISTINCT p.*,u.group_id,g.show_in_home_search
FROM `".$config['db']['pre']."product` as p
LEFT JOIN `".$config['db']['pre']."user` as u ON u.id = p.user_id
LEFT JOIN `".$config['db']['pre']."usergroups` as g ON g.group_id = u.group_id
 WHERE p.product_name like '%$qString%' and p.status = 'active' and p.hide = '0' and p.country = '".$country_code."' and g.show_in_home_search = 'yes'
 ORDER BY
  CASE
    WHEN p.product_name = '$qString' THEN 1
    WHEN p.product_name LIKE '$qString%' THEN 2
    ELSE 3
  END ";
        }else{

            $sql = "SELECT DISTINCT p.*,u.group_id,g.show_in_home_search
FROM `".$config['db']['pre']."product` as p
INNER JOIN `".$config['db']['pre']."user` as u ON u.id = p.user_id
INNER JOIN `".$config['db']['pre']."usergroups` as g ON g.group_id = u.group_id
 WHERE p.product_name like '$qString%' and p.status = 'active' and p.hide = '0' and p.country = '".$country_code."' and g.show_in_home_search = 'yes'
 ORDER BY
  CASE
    WHEN p.product_name = '$qString' THEN 1
    WHEN p.product_name LIKE '$qString%' THEN 2
    ELSE 3
  END ";

        }

        $result = $pdo->query($sql);
        if (count($result) > 0) {
            $machTitles = true;      // output data of each row
            foreach ($result as $info) {
                $listTitle  = $info['product_name'];
                $listTitle  = strtolower($listTitle);
                $pro_url = create_slug($info['product_name']);
                $permalink = $config['site_url'].'ad/' . $info['id'] . '/'.$pro_url;
                $cityname = get_cityName_by_id($info['city']);

                if(check_user_upgrades($info['user_id']))
                {
                    $sub_info = get_user_membership_detail($info['user_id']);
                    $sub_title = $sub_info['sub_title'];
                    $sub_image = $sub_info['sub_image'];
                    $premium_badge = "<img src='".$sub_image."' alt='".$sub_title."' width='20px'/>";
                }else{
                    $sub_title = '';
                    $sub_image = '';
                    $premium_badge = '';
                }


                $listThumb = '';
                $picture =   explode(',' ,$info['screen_shot']);
                if (!empty($picture[0])) {
                    if(file_exists("../storage/products/thumb/".$picture[0])){
                        $image = $config['site_url']."storage/products/thumb/" . $picture[0];
                    }else{
                        $image = $config['site_url']."storage/products/thumb/default.png";
                    }
                    $listThumb = "<img src='".$image."' width='50' height='50'/>";
                } else {
                    $listThumb = '<img src="'.$config['site_url'].'storage/products/thumb/default.png" alt="" width="50" height="50">';
                }

                $TitleOutput[] = '<li class="qucikad-ajaxsearch-li-title" data-url="' . $permalink . '">' . $listThumb . '<span class="qucikad-as-title"><a href="' . $permalink . '">' . $listTitle . ' '.
                    $premium_badge.' <span class="lp-loc">' . $cityname . '</span></a></span></li>';

            }
        }

        $TAGOutput    = array_unique($TAGOutput);
        $CATOutput    = array_unique($CATOutput);
        $TagCatOutput = array_unique($TagCatOutput);
        $TitleOutput  = array_unique($TitleOutput);
        if ((!empty($TAGOutput) && count($TAGOutput) > 0) || (!empty($CATOutput) && count($CATOutput) > 0) || (!empty($TagCatOutput) && count($TagCatOutput) > 0) || (!empty($TitleOutput) && count($TitleOutput) > 0)) {
            $output = array(
                'tag' => $TAGOutput,
                'cats' => $CATOutput,
                'tagsncats' => $TagCatOutput,
                'titles' => $TitleOutput,
                'more' => '',
                'matches' => $machTitles
            );
        } else {
            $moreResult = array();
            $mResults   = '<strong>' . $lang['MORE_RESULTS_FOR'] . '</strong>';
            $mResults .= $qString;
            $moreResult[] = '<li class="qucikad-ajaxsearch-li-more-results" data-moreval="' . $qString . '">' . $mResults . '</li>';
            $output       = array(
                'tag' => '',
                'cats' => '',
                'tagsncats' => '',
                'titles' => '',
                'more' => $moreResult
            );
        }
        $query_suggestion = json_encode(array(
            "tagID" => $qString,
            "suggestions" => $output
        ));
        die($query_suggestion);
    }
}
?>