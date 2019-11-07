<?php
if(!isset($_GET['page']))
    $page = 1;
else
    $page = $_GET['page'];


if(!isset($_GET['order']))
    $order = "DESC";
else{
    if($_GET['order'] == ""){
        $order = "DESC";
    }else{
        $order = $_GET['order'];
    }
}

if(!isset($_GET['sort']))
    $sort = "id";
elseif($_GET['sort'] == "title")
    $sort = "product_name";
elseif($_GET['sort'] == "price")
    $sort = "price";
elseif($_GET['sort'] == "date")
    $sort = "created_at";
else
    $sort = "id";

$limit = isset($_GET['limit']) ? $_GET['limit'] : 6;
$sorting = isset($_GET['sort']) ? $_GET['sort'] : "Newest";

if(isset($_GET['username'])){

    $keywords = isset($_GET['keywords']) ? str_replace("-"," ",$_GET['keywords']) : "";

    $category = "";
    $subcat = "";

    if(isset($_GET['subcat']) && !empty($_GET['subcat'])){

        if(is_numeric($_GET['subcat'])){
            if(check_sub_category_exists($_GET['subcat'])){
                $subcat = $_GET['subcat'];
            }
        }else{
            $subcat = get_subcategory_id_by_slug($_GET['subcat']);
        }
    }elseif(isset($_GET['cat']) && !empty($_GET['cat'])){
        if(is_numeric($_GET['cat'])){
            if(check_category_exists($_GET['cat'])){
                $category = $_GET['cat'];
            }
        }else{
            $category = get_category_id_by_slug($_GET['cat']);
        }
    }

    $where = '';
    $order_by_keyword = '';
    if(isset($_GET['keywords']) && !empty($_GET['keywords'])){
        $where.= "AND (product_name LIKE '%$keywords%' or tag LIKE '%$keywords%') ";
        $order_by_keyword = "(CASE
    WHEN product_name = '$keywords' THEN 1
    WHEN product_name LIKE '$keywords%' THEN 2
    WHEN product_name LIKE '%$keywords%' THEN 3
    WHEN tag = '$keywords' THEN 4
    WHEN tag LIKE '$keywords%' THEN 5
    WHEN tag LIKE '%$keywords%' THEN 6
    ELSE 7
  END),";
    }

    if(isset($category) && !empty($category)){
        $where.= "AND (category = '$category') ";
    }

    if(isset($_GET['subcat']) && !empty($_GET['subcat'])){
        $where.= "AND (sub_category = '$subcat') ";
    }

    if(isset($_GET['city']) && !empty($_GET['city']))
    {
        $where.= "AND (city = '".$_GET['city']."') ";
    }
    elseif(isset($_GET['location']) && !empty($_GET['location']))
    {
        $placetype = $_GET['placetype'];
        $placeid = $_GET['placeid'];

        if($placetype == "country"){
            $where.= "AND (country = '$placeid') ";
        }elseif($placetype == "state"){
            $where.= "AND (state = '$placeid') ";
        }else{
            $where.= "AND (city = '$placeid') ";
        }
    }
    else{
        $country_code = check_user_country();
        $where.= "AND (country = '$country_code') ";
    }

    $get_userdata = get_user_data($_GET['username']);
    if(is_array($get_userdata)){

        $user_id = $get_userdata['id'];

        update_profileview($user_id);

        $user_view = $get_userdata['view'];
        $user_name = $get_userdata['name'];
        $user_tagline = $get_userdata['tagline'];
        $user_about = $get_userdata['description'];
        $user_sex = $get_userdata['sex'];
        $user_city = $get_userdata['city'];
        $user_address = $get_userdata['address'];
        $user_website = $get_userdata['website'];
        $user_image = $get_userdata['image'];
        $created = date('d M Y', strtotime($get_userdata['created_at']));
        $lastactive = date('d M Y', strtotime($get_userdata['lastactive']));

        if($config['contact_validation'] == '1'){
            $user_email = (checkloggedin()) ? $get_userdata['email'] : "Login to see";
            $user_phone = (checkloggedin()) ? $get_userdata['phone'] : "Login to see";
        }else{
            $user_email = $get_userdata['email'];
            $user_phone = $get_userdata['phone'];
        }

        $sql = "SELECT *
FROM `".$config['db']['pre']."product`
 WHERE status = 'active' AND hide = '0' AND user_id = $user_id ";
        /*$q = "$sql $where";
        $totalWithoutFilter = mysqli_num_rows(mysqli_query($mysqli, $q));*/
        $total = mysqli_num_rows(mysqli_query($mysqli, "SELECT 1 FROM ".$config['db']['pre']."product as p where status = 'active' and hide = '0' and user_id = '$user_id' $where"));
        $query = "$sql $where ORDER BY $sort LIMIT ".($page-1)*$limit.",$limit";

        $result = ORM::for_table($config['db']['pre'].'product')->raw_query($query)->find_many();

        $item = array();
        if ($result) {
            foreach ($result as $info)
            {
                $item[$info['id']]['id'] = $info['id'];
                $item[$info['id']]['product_name'] = $info['product_name'];
                $item[$info['id']]['cat_id'] = $info['category'];
                $item[$info['id']]['sub_cat_id'] = $info['sub_category'];
                $item[$info['id']]['price'] = $info['price'];
                $item[$info['id']]['featured'] = $info['featured'];
                $item[$info['id']]['urgent'] = $info['urgent'];
                $item[$info['id']]['highlight'] = $info['highlight'];
                $item[$info['id']]['highlight_bgClr'] = ($info['highlight'] == 1)? "highlight-premium-ad" : "";

                $cityname = get_cityName_by_id($info['city']);
                $item[$info['id']]['location'] = $cityname;
                $item[$info['id']]['city'] = $cityname;
                $item[$info['id']]['status'] = $info['status'];
                $item[$info['id']]['hide'] = $info['hide'];

                $item[$info['id']]['created_at'] = timeAgo($info['created_at']);
                $expire_date_timestamp = $info['expire_date'];
                $expire_date = date('d-M-y', $expire_date_timestamp);
                $item[$info['id']]['expire_date'] = $expire_date;

                $item[$info['id']]['cat_id'] = $info['category'];
                $item[$info['id']]['sub_cat_id'] = $info['sub_category'];
                $get_main = get_maincat_by_id($info['category']);
                $get_sub = get_subcat_by_id($info['sub_category']);
                $item[$info['id']]['category'] = $get_main['cat_name'];
                $item[$info['id']]['sub_category'] = $get_sub['sub_cat_name'];

                $item[$info['id']]['favorite'] = check_product_favorite($info['id']);

                if($info['tag'] != ''){
                    $item[$info['id']]['showtag'] = "1";
                    $tag = explode(',', $info['tag']);
                    $tag2 = array();
                    foreach ($tag as $val)
                    {
                        //REMOVE SPACE FROM $VALUE ----
                        $val = preg_replace("/[\s_]/","-", trim($val));
                        $tag2[] = '<li><a href="'.$config['site_url'].'listing?keywords='.$val.'">'.$val.'</a> </li>';
                    }
                    $item[$info['id']]['tag'] = implode('  ', $tag2);
                }else{
                    $item[$info['id']]['tag'] = "";
                    $item[$info['id']]['showtag'] = "0";
                }

                $picture     =   explode(',' ,$info['screen_shot']);
                $item[$info['id']]['pic_count'] = count($picture);

                if($picture[0] != ""){
                    $item[$info['id']]['picture'] = $picture[0];
                }else{
                    $item[$info['id']]['picture'] = "default.png";
                }

                $price = price_format($info['price'],$info['country']);
                $item[$info['id']]['price'] = $price;

                $userinfo = get_user_data(null,$info['user_id']);

                $item[$info['id']]['username'] = $userinfo['username'];
                $author_url = create_slug($userinfo['username']);

                $item[$info['id']]['author_link'] = $config['site_url'].'profile/'.$author_url;

                if(check_user_upgrades($info['user_id']))
                {
                    $sub_info = get_user_membership_detail($info['user_id']);
                    $item[$info['id']]['sub_title'] = $sub_info['sub_title'];
                    $item[$info['id']]['sub_image'] = $sub_info['sub_image'];
                }else{
                    $item[$info['id']]['sub_title'] = '';
                    $item[$info['id']]['sub_image'] = '';
                }
                $pro_url = create_slug($info['product_name']);
                $item[$info['id']]['link'] = $config['site_url'].'ad/' . $info['id'] . '/'.$pro_url;
                $item[$info['id']]['catlink'] = $config['site_url'].'category/'.$get_main['slug'];
                $item[$info['id']]['subcatlink'] = $config['site_url'].'category/'.$get_main['slug'].'/'.$get_sub['slug'];

                $city = create_slug($item[$info['id']]['city']);
                $item[$info['id']]['citylink'] = $config['site_url'].'city/'.$info['city'].'/'.$city;

            }
        }

        //Again make loop for grid view
        $item2 = array();
        $item2 = $item;

        $total_item = get_items_count($user_id,"active");
        $total_Premium_item = get_items_count($user_id,"active",true);

        $Pagelink = "";
        if(count($_GET) >= 1){
            $get = http_build_query($_GET);
            $Pagelink .= "?".$get;

            $pagging = pagenav($total,$page,$limit,$link['PROFILE'].$Pagelink,1);
        }else{
            $pagging = pagenav($total,$page,$limit,$link['PROFILE']);
        }

        $GetCategory = get_maincategory();
        $cat_dropdown = get_categories_dropdown($lang);
        // Output to template
        $page = new HtmlTemplate ('templates/' . $config['tpl_name'] . '/profile.tpl');
        $page->SetParameter ('OVERALL_HEADER', create_header($_GET['username']." ".$lang['PROFILE']));
        $page->SetParameter ('CAT_DROPDOWN',$cat_dropdown);
        $page->SetParameter ('PROFILEVISIT', $user_view);
        $page->SetParameter ('FULLNAME', $user_name);
        $page->SetParameter ('EMAIL', $user_email);
        $page->SetParameter ('CITY', $user_city);
        $page->SetParameter ('TAGLINE', $user_tagline);
        $page->SetParameter ('ABOUT', $user_about);
        $page->SetParameter ('USERIMAGE', $user_image);
        $page->SetParameter ('PHONE', $user_phone);
        $page->SetParameter ('ADDRESS', $user_address);
        $page->SetParameter('WEBSITE', $user_website);
        $page->SetParameter ('CREATED', $created);
        $page->SetParameter ('LASTACTIVE', $lastactive);
        $page->SetParameter ('USERNAME', $_GET['username']);
        $page->SetParameter('FACEBOOK', $get_userdata['facebook']);
        $page->SetParameter('TWITTER', $get_userdata['twitter']);
        $page->SetParameter('GPLUS', $get_userdata['googleplus']);
        $page->SetParameter('LINKEDIN', $get_userdata['linkedin']);
        $page->SetParameter('INSTAGRAM', $get_userdata['instagram']);
        $page->SetParameter('YOUTUBE', $get_userdata['youtube']);
        $page->SetParameter ('USERADS', $total_item);
        $page->SetParameter ('USERPREMIUMADS', $total_Premium_item);
        $page->SetParameter ('ADSFOUND', $total);
        $page->SetLoop ('ITEM', $item);
        $page->SetLoop ('ITEM2', $item2);
        $page->SetLoop ('PAGES', $pagging);
        $page->SetParameter ('LIMIT', $limit);
        $page->SetParameter ('SORT', $sorting);
        $page->SetParameter ('ORDER', $order);
        $page->SetParameter ('MAINCAT', $category);
        $page->SetParameter ('SUBCAT', $subcat);
        $page->SetParameter ('KEYWORDS', $keywords);
        if(check_user_upgrades($user_id))
        {
            $sub_info = get_user_membership_detail($user_id);
            $page->SetParameter('SUB_TITLE', $sub_info['sub_title']);
            $page->SetParameter('SUB_IMAGE', $sub_info['sub_image']);
        }else{
            $page->SetParameter('SUB_TITLE','');
            $page->SetParameter('SUB_IMAGE', '');
        }

        $advertise_left = get_advertise("left_sidebar");
        $advertise_right = get_advertise("right_sidebar");

        $page->SetParameter('LEFT_ADSCODE', $advertise_left['tpl']);
        $page->SetParameter('LEFT_ADSTATUS', $advertise_left['status']);
        $page->SetParameter('RIGHT_ADSCODE', $advertise_right['tpl']);
        $page->SetParameter('RIGHT_ADSTATUS', $advertise_right['status']);

        if($advertise_left['status'] == 1 && $advertise_right['status'] == 1){
            $category_column = "col-md-8";
        }else if($advertise_left['status'] == 0 && $advertise_right['status'] == 1){
            $category_column = "col-md-10";
        }else if($advertise_left['status'] == 1 && $advertise_right['status'] == 0){
            $category_column = "col-md-10";
        }else{
            $category_column = "col-md-12";
        }
        $page->SetParameter('CATEGORY_COLUMN', $category_column);

        $page->SetParameter ('OVERALL_FOOTER', create_footer());
        $page->CreatePageEcho();
        exit();
    }
    else{
        error($lang['PAGE_NOT_FOUND'], __LINE__, __FILE__, 1);
        exit();
    }
}
else{
    error($lang['PAGE_NOT_FOUND'], __LINE__, __FILE__, 1);
    exit();
}
?>