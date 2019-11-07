<?php
require_once('plugins/watermark/watermark.php');

if(isset($match['params']['country'])) {
    if ($match['params']['country'] != ""){
        change_user_country($match['params']['country']);
    }
}

if (isset($_GET['action'])) {
    if ($_GET['action'] == "edit_ad") {
        ajax_edit_advertise();
    }
}

function ajax_edit_advertise(){

    global $config, $lang, $link;
    $item_screen = "";
    if (!checkloggedin()) {
        return false;
    }

    if(!check_valid_author($_POST['product_id'])){
        return false;
    }

    if(isset($_POST['submit'])) {
        $errors = array();

        if (empty($_POST['subcatid']) or empty($_POST['catid'])) {
            $errors[]['message'] = $lang['CAT_REQ'];
        }
        if (empty($_POST['title'])) {
            $errors[]['message'] = $lang['ADTITLE_REQ'];
        }
        if (empty($_POST['content'])) {
            $errors[]['message'] = $lang['DESC_REQ'];
        }
        if (empty($_POST['city'])) {
            $errors[]['message'] = $lang['CITY_REQ'];
        }
        if (!empty($_POST['price'])) {
            if (!is_numeric($_POST['price'])) {
                $errors[]['message'] = $lang['PRICE_MUST_NO'];
            }
        }

        /*IF : USER GO TO PEMIUM POST*/
        $urgent = isset($_POST['urgent']) ? 1 : 0;
        $featured = isset($_POST['featured']) ? 1 : 0;
        $highlight = isset($_POST['highlight']) ? 1 : 0;

        /*$payment_req = "";
        if (isset($_POST['urgent'])) {
            if (!isset($_POST['payment_id'])) {
                $payment_req = $lang['PAYMENT_METHOD_REQ'];
            }
        }
        if (isset($_POST['featured'])) {
            if (!isset($_POST['payment_id'])) {
                $payment_req = $lang['PAYMENT_METHOD_REQ'];
            }
        }
        if (isset($_POST['highlight'])) {
            if (!isset($_POST['payment_id'])) {
                $payment_req = $lang['PAYMENT_METHOD_REQ'];
            }
        }
        if (!empty($payment_req))
            $errors[]['message'] = $payment_req;*/

        /*IF : USER GO TO PREMIUM POST*/

        if (!count($errors) > 0) {
            if (isset($_POST['item_screen']) && count($_POST['item_screen']) > 0) {
                $valid_formats = array("jpg", "jpeg", "png"); // Valid image formats
                $countScreen = 0;
                $item_screen = "";
                foreach ($_POST['item_screen'] as $name) {
                    $filename = stripslashes($name);
                    $ext = getExtension($filename);
                    $ext = strtolower($ext);
                    if (!empty($filename)) {
                        //File extension check
                        if (in_array($ext, $valid_formats)) {
                            //Valid File extension check

                        } else {
                            $errors[]['message'] = $lang['ONLY_JPG_ALLOW'];
                        }
                        if ($countScreen == 0)
                            $item_screen = $filename;
                        elseif ($countScreen >= 1)
                            $item_screen = $item_screen . "," . $filename;
                        $countScreen++;
                    }
                }
            }
        }


        if (!count($errors) > 0) {

            if (checkloggedin()) {
                $price = $_POST['price'];
                $phone = $_POST['phone'];
                $price = isset($_POST['price']) ? $_POST['price'] : 0;
                $phone = isset($_POST['phone']) ? $_POST['phone'] : 0;

                if(empty($_POST['price'])){
                    $price = 0;
                }
                $negotiable = isset($_POST['negotiable']) ? 1 : 0;
                $hide_phone = isset($_POST['hide_phone']) ? 1 : 0;
                $cityid = $_POST['city'];

                if($config['post_desc_editor'] == 1)
                    $description = addslashes($_POST['content']);
                else
                    $description = validate_input($_POST['content']);

                $timenow = date('Y-m-d H:i:s');
                $citydata = get_cityDetail_by_id($cityid);
                $country = $citydata['country_code'];
                $state = $citydata['subadmin1_code'];
                if(isset($_POST['tags'])){
                    $tags = $_POST['tags'];
                }else{
                    $tags = '';
                }
                if(isset($_POST['location'])){
                    $location = $_POST['location'];
                }else{
                    $location = '';
                }
                $mapLat = $_POST['latitude'];
                $mapLong = $_POST['longitude'];
                $latlong = $mapLat . "," . $mapLong;
                $slug = create_post_slug($_POST['title']);

                $info = ORM::for_table($config['db']['pre'].'product')
                    ->select_many('status', 'screen_shot')
                    ->find_one($_POST['product_id']);

                $item_status = $info['status'];
                $screen_shot = $info['screen_shot'];

                if($item_status == "pending" or $config['post_auto_approve'] == 1)
                {
                    $item_edit = ORM::for_table($config['db']['pre'].'product')->find_one($_POST['product_id']);
                    $item_edit->set('product_name', $_POST['title']);
                    $item_edit->set('slug', $slug);
                    $item_edit->set('category', $_POST['catid']);
                    $item_edit->set('sub_category', $_POST['subcatid']);
                    $item_edit->set('description', $description);
                    $item_edit->set('price', $price);
                    $item_edit->set('negotiable', $negotiable);
                    $item_edit->set('phone', $phone);
                    $item_edit->set('hide_phone', $hide_phone);
                    $item_edit->set('location', $location);
                    $item_edit->set('city', $cityid);
                    $item_edit->set('state', $state);
                    $item_edit->set('country', $country);
                    $item_edit->set('latlong', $latlong);
                    $item_edit->set('screen_shot', $item_screen);
                    $item_edit->set('tag', $tags);
                    $item_edit->set('updated_at', $location);
                    $item_edit->save();
                }
                elseif($item_status == "active" or $item_status == "softreject" or $item_status == "expire")
                {
                    $item_insrt = ORM::for_table($config['db']['pre'].'product_resubmit')->create();
                    $item_insrt->product_id = $_POST['product_id'];
                    $item_insrt->user_id = $_SESSION['user']['id'];
                    $item_insrt->product_name = $_POST['title'];
                    $item_insrt->category = $_POST['catid'];
                    $item_insrt->sub_category = $_POST['subcatid'];
                    $item_insrt->description = $description;
                    $item_insrt->price = $price;
                    $item_insrt->negotiable = $negotiable;
                    $item_insrt->phone = $phone;
                    $item_insrt->hide_phone = $hide_phone;
                    $item_insrt->location = $location;
                    $item_insrt->city = $_POST['city'];
                    $item_insrt->state = $state;
                    $item_insrt->country = $country;
                    $item_insrt->latlong = $latlong;
                    $item_insrt->screen_shot = $item_screen;
                    $item_insrt->tag = $tags;
                    $item_insrt->created_at = $timenow;
                    $item_insrt->comments = $_POST['comments'];
                    $item_insrt->save();
                }

                $product_id = $_POST['product_id'];

                add_post_customField_data($_POST['catid'], $_POST['subcatid'],$product_id);

                $amount = 0;
                $trans_desc = $lang['PACKAGE'];

                // Get usergroup details
                $group_id = get_user_group();
                if($group_id > 0) {
                    // Get membership details
                    $group_get_info = get_usergroup_settings($group_id);
                }else{
                    $group_get_info = get_usergroup_settings(1);
                }
                $urgent_project_fee = $group_get_info['urgent_project_fee'];
                $featured_project_fee = $group_get_info['featured_project_fee'];
                $highlight_project_fee = $group_get_info['highlight_project_fee'];
                $urgent_duration = $group_get_info['urgent_duration'];
                $featured_duration = $group_get_info['featured_duration'];
                $highlight_duration = $group_get_info['highlight_duration'];
                $premium_tpl = "";

                if ($featured == 1) {
                    $amount = $featured_project_fee;
                    $trans_desc = $trans_desc ." ". $lang['FEATURED'];
                    $premium_tpl .= ' <div class="ModalPayment-paymentDetails">
                                            <div class="ModalPayment-label">'.$lang['FEATURED'].'</div>
                                            <div class="ModalPayment-price">
                                                <span class="ModalPayment-totalCost-price">'.$config['currency_sign'].$featured_project_fee.'</span>
                                            </div>
                                        </div>';
                }
                if ($urgent == 1) {
                    $amount = $amount + $urgent_project_fee;
                    $trans_desc = $trans_desc ." ". $lang['URGENT'];
                    $premium_tpl .= ' <div class="ModalPayment-paymentDetails">
                                            <div class="ModalPayment-label">'.$lang['URGENT'].'</div>
                                            <div class="ModalPayment-price">
                                                <span class="ModalPayment-totalCost-price">'.$config['currency_sign'].$urgent_project_fee.'</span>
                                            </div>
                                        </div>';
                }
                if ($highlight == 1) {
                    $amount = $amount + $highlight_project_fee;
                    $trans_desc = $trans_desc ." ". $lang['HIGHLIGHT'];
                    $premium_tpl .= ' <div class="ModalPayment-paymentDetails">
                                            <div class="ModalPayment-label">'.$lang['HIGHLIGHT'].'</div>
                                            <div class="ModalPayment-price">
                                                <span class="ModalPayment-totalCost-price">'.$config['currency_sign'].$highlight_project_fee.'</span>
                                            </div>
                                        </div>';
                }

                if ($amount > 0) {
                    $premium_tpl .= ' <div class="ModalPayment-totalCost">
                                            <span class="ModalPayment-totalCost-label">'.$lang['TOTAL'].': </span>
                                            <span class="ModalPayment-totalCost-price">'.$config['currency_sign'].$amount." ".$config['currency_code'].'</span>
                                        </div>';


                    /*These details save in session and get on payment sucecess*/
                    $title = $_POST['title'];
                    $payment_type = "premium";
                    $access_token = uniqid();

                    $_SESSION['quickad'][$access_token]['name'] = $title;
                    $_SESSION['quickad'][$access_token]['amount'] = $amount;
                    $_SESSION['quickad'][$access_token]['payment_type'] = $payment_type;
                    $_SESSION['quickad'][$access_token]['trans_desc'] = $trans_desc;
                    $_SESSION['quickad'][$access_token]['product_id'] = $product_id;
                    $_SESSION['quickad'][$access_token]['featured'] = $featured;
                    $_SESSION['quickad'][$access_token]['urgent'] = $urgent;
                    $_SESSION['quickad'][$access_token]['highlight'] = $highlight;
                    /*End These details save in session and get on payment sucecess*/

                    $url = $link['PAYMENT']."/" . $access_token;
                    $response = array();
                    $response['status'] = "success";
                    $response['ad_type'] = "package";
                    $response['redirect'] = $url;
                    $response['tpl'] = $premium_tpl;
                    unset($_POST);
                    echo json_encode($response, JSON_UNESCAPED_SLASHES);
                    die();
                } else {
                    unset($_POST);
                    $ad_link = $link['AD-DETAIL'] . "/" . $product_id;

                    $json = '{"status" : "success","ad_type" : "free","redirect" : "' . $ad_link . '"}';
                    echo $json;
                    die();
                }
            } else {
                $status = "error";
                $errors[]['message'] = $lang['POST_SAVE_ERROR'];
            }


        } else {
            $status = "error";
        }

        $json = '{"status" : "' . $status . '","errors" : ' . json_encode($errors, JSON_UNESCAPED_SLASHES) . '}';
        echo $json;
        die();
    }
}

if(checkloggedin()) {

    $status = check_item_status($_GET['id']);

    $header_text = "";
    $header_note = "";
    $resubmit = "";
    if($status == "pending"){
        $header_text = $lang['EDIT_AD'];
        $resubmit = 0;
    }
    elseif($status == "active" or $status == "softreject" or $status == "hide" or $status == "expire")
    {
        if(check_valid_resubmission($_GET['id'])){
            $header_text = $lang['RE_SUBISSION'];
            $header_note = $lang['RE_SUBISSION_TEXT'];
            $resubmit = 1;
        }else{
            message($lang['ALREADY_EXIST'],$lang['RESUMIT_EXIST_TEXT'],'',false);
            exit;
        }

    }else {
        error($lang['PAGE_NOT_FOUND'], __LINE__, __FILE__, 1);
        exit;
    }


    if(check_valid_author($_GET['id'])){

        global $errors, $custom_fields, $catid,$catName, $subcatid,$subcatName, $title, $description, $price, $negotiable, $phone, $hide_phone, $tags, $cityid, $mapLat, $mapLong, $seller_name, $seller_email;

        if(isset($_GET['country'])) {
            if ($_GET['country'] != ""){
                change_user_country($_GET['country']);
            }
        }

        $country_code = check_user_country();

        $currency_info = set_user_currency($country_code);
        $currency_sign = $currency_info['html_entity'];

        $info = ORM::for_table($config['db']['pre'].'product')->find_one($_GET['id']);
        $total[0] = count($info);
        if ($total[0] > 0) {
            // output data of each row
            $item_id = $info['id'];
            $item_featured = $info['featured'];
            $item_urgent = $info['urgent'];
            $item_highlight = $info['highlight'];
            $catid          = $info['category'];
            $subcatid       = $info['sub_category'];
            $title          = $info['product_name'];
            $description    = de_sanitize($info['description']);
            $price          = $info['price'];
            $phone          = $info['phone'];
            $negotiable     = $info['negotiable'];
            $hide_phone     = $info['hide_phone'];
            $tags           = $info['tag'];
            $cityid         = $info['city'];

            $latlong = $info['latlong'];
            $map = explode(',', $latlong);
            $mapLat = $map[0];
            $mapLong = $map[1];

            $item_featured = $info['featured'];
            $item_urgent = $info['urgent'];
            $item_highlight = $info['highlight'];

            $maincat = get_maincat_by_id($catid);
            $catName = $maincat['cat_name'];
            $subcat = get_subcat_by_id($subcatid);
            $subcatName = $subcat['sub_cat_name'];

            $custom_fields = array();
            $custom_data = array();

            $customdata = ORM::for_table($config['db']['pre'].'custom_data')
                ->select_many('field_id','field_data')
                ->where('product_id',$item_id)
                ->find_many();

            foreach ($customdata as $array){
                $custom_fields[] = $array['field_id'];
                $custom_data[] = $array['field_data'];
            }

            $custom_fields = get_customFields_by_catid($catid, $subcatid,false, $custom_fields, $custom_data);

            foreach ($custom_fields as $key => $value) {
                if ($value['userent']) {
                    $custom_db_fields[$value['id']] = $value['title'];
                    $custom_db_data[$value['id']] = str_replace(',', '&#44;', $value['default']);
                }
            }

            $imagesCount = 0;
            $maxImgLength = 5;
            $screen = "";
            if($info['screen_shot'] != "")
            {
                $screen = explode(',', $info['screen_shot']);

                foreach ($screen as $value) {
                    //REMOVE SPACE FROM $VALUE ----
                    $value = trim($value);
                    if($imagesCount == 0)
                        $screen2[] = "'$value'";
                    else
                        $screen2[] = ",'$value'";
                    $imagesCount++;
                }
                $maxImgLength = 5 - $imagesCount;
                $screen = implode(' ', $screen2);
            }


            // Get usergroup details
            $group_id = get_user_group();
            if($group_id > 0) {
                // Get membership details
                $group_get_info = get_usergroup_settings($group_id);
            }else{
                $group_get_info = get_usergroup_settings(1);
            }
            $urgent_project_fee = $group_get_info['urgent_project_fee'];
            $featured_project_fee = $group_get_info['featured_project_fee'];
            $highlight_project_fee = $group_get_info['highlight_project_fee'];
            $urgent_duration = $group_get_info['urgent_duration'];
            $featured_duration = $group_get_info['featured_duration'];
            $highlight_duration = $group_get_info['highlight_duration'];

            // Output to template
            $page = new HtmlTemplate ('templates/' . $config['tpl_name'] . '/ad-edit.tpl');
            $page->SetParameter ('OVERALL_HEADER', create_header($header_text));
            $page->SetParameter('ITEM_ID', $item_id);
            $page->SetLoop ('HTMLPAGE', get_html_pages());
            $page->SetLoop ('COUNTRYLIST',get_country_list());
            $page->SetLoop ('CATEGORY',get_maincategory($catid));
            $page->SetLoop ('SUBCATEGORY',get_subcat_of_maincat($catid,false,$subcatid));
            $page->SetLoop ('CUSTOMFIELDS',$custom_fields);
            $page->SetParameter ('SHOWCUSTOMFIELD', (count($custom_fields) > 0) ? 1 : 0);
            $page->SetParameter ('CATID', $catid);
            $page->SetParameter ('SUBCATID', $subcatid);
            $page->SetParameter ('CATEGORY', $catName);
            $page->SetParameter ('SUBCATEGORY', $subcatName);
            $page->SetParameter ('TITLE', $title);
            $page->SetParameter ('DESCRIPTION', $description);
            $page->SetParameter ('PRICE', $price);
            $page->SetParameter ('PHONE', $phone);
            $page->SetParameter ('NEGOTIABLE', $negotiable);
            $page->SetParameter ('HIDEPHONE', $hide_phone);
            $page->SetParameter ('TAGS', $tags);
            $page->SetParameter ('CITY', $cityid);
            $page->SetParameter ('CITYNAME', get_cityName_by_id($cityid));
            $page->SetParameter ('LATITUDE', $mapLat);
            $page->SetParameter ('LONGITUDE', $mapLong);
            $page->SetParameter ('USER_COUNTRY', strtolower($country_code));
            $page->SetParameter ('SELLER_NAME', $seller_name);
            $page->SetParameter ('SELLER_EMAIL', $seller_email);
            $page->SetParameter ('USER_CURRENCY_SIGN', $currency_sign);
            $page->SetParameter('ITEM_SCREENS', $screen);
            $page->SetParameter('IMGCOUNT', $imagesCount);
            $page->SetParameter('MAXIMGLNT', $maxImgLength);
            $page->SetParameter('HEADER_TEXT', $header_text);
            $page->SetParameter('HEADER_NOTE', $header_note);
            $page->SetParameter('RESUBMIT', $resubmit);
            $page->SetParameter('FEATURED', $item_featured);
            $page->SetParameter('URGENT', $item_urgent);
            $page->SetParameter('HIGHLIGHT', $item_highlight);
            $page->SetParameter('FEATURED_FEE', $featured_project_fee);
            $page->SetParameter('URGENT_FEE', $urgent_project_fee);
            $page->SetParameter('HIGHLIGHT_FEE', $highlight_project_fee);
            $page->SetParameter('FEATURED_DURATION', $featured_duration);
            $page->SetParameter('URGENT_DURATION', $urgent_duration);
            $page->SetParameter('HIGHLIGHT_DURATION', $highlight_duration);
            $page->SetParameter ('PAGE_TITLE', $lang['POST_AD']);
            $page->SetParameter('LANGUAGE_DIRECTION', get_current_lang_direction());
            $page->SetParameter ('OVERALL_FOOTER', create_footer());
            $page->CreatePageEcho();
        }
        else {
            error($lang['PAGE_NOT_FOUND'], __LINE__, __FILE__, 1);
            exit;
        }


    }
    else{
        error($lang['PAGE_NOT_FOUND'], __LINE__, __FILE__, 1);
        exit;
    }
}
else{
    header("Location: ".$config['site_url']."login?ref=dashboard");
    exit();
}
?>