<?php

if(!isset($_GET['page']))
    $_GET['page'] = 1;

$limit = 5;
$page = $_GET['page'];

if(checkloggedin()) {
    $item = array();
    $ses_userdata = get_user_data($_SESSION['user']['username']);
    $author_image = $ses_userdata['image'];

    $pagelimit = "";
    if($page != null && $limit != null){
        $limit = $limit;
        $offset = ($page-1)*$limit;
    }

    $total_item = ORM::for_table($config['db']['pre'].'favads')
        ->where('user_id', $_SESSION['user']['id'])
        ->count();

    $result = ORM::for_table($config['db']['pre'].'favads')
        ->select('product_id')
        ->where('user_id', $_SESSION['user']['id'])
        ->limit($limit)->offset($offset)
        ->find_many();
    if (count($result) > 0) {
        foreach ($result as $fav) {
            $info = ORM::for_table($config['db']['pre'].'product')->find_one($fav['product_id']);
            if (!empty($info)) {
                $item[$info['id']]['id'] = $info['id'];
                $item[$info['id']]['product_name'] = $info['product_name'];
                $item[$info['id']]['featured'] = $info['featured'];
                $item[$info['id']]['urgent'] = $info['urgent'];
                $item[$info['id']]['highlight'] = $info['highlight'];
                $item[$info['id']]['address'] = strlimiter($info['location'],20);
                $item[$info['id']]['location'] = get_cityName_by_id($info['city']);
                $item[$info['id']]['city'] = get_cityName_by_id($info['city']);
                $item[$info['id']]['state'] = get_stateName_by_id($info['state']);
                $item[$info['id']]['country'] = get_countryName_by_id($info['country']);
                $item[$info['id']]['status'] = $info['status'];
                $item[$info['id']]['created_at'] = timeago($info['created_at']);

                $item[$info['id']]['cat_id'] = $info['category'];
                $item[$info['id']]['sub_cat_id'] = $info['sub_category'];

                $get_main = get_maincat_by_id($info['category']);
                $get_sub = get_subcat_by_id($info['sub_category']);
                $item[$info['id']]['category'] = $get_main['cat_name'];
                $item[$info['id']]['sub_category'] = $get_sub['sub_cat_name'];

                $item[$info['id']]['favorite'] = check_product_favorite($info['id']);

                $tag = explode(',', $info['tag']);
                $tag2 = array();
                foreach ($tag as $val)
                {
                    //REMOVE SPACE FROM $VALUE ----
                    $val = trim($val);
                    $tag2[] = '<li><a href="listing?keywords='.$val.'">'.$val.'</a> </li>';
                }
                $item[$info['id']]['tag'] = implode('  ', $tag2);

                $picture     =   explode(',' ,$info['screen_shot']);
                $picture     =   $picture[0];
                $item[$info['id']]['picture'] = $picture;

                $price = price_format($info['price'],$info['country']);


                $item[$info['id']]['price'] = $price;

                $userinfo = get_user_data(null,$info['user_id']);

                $item[$info['id']]['username'] = $userinfo['username'];
                $author_url = create_slug($userinfo['username']);

                $item[$info['id']]['author_link'] = $config['site_url'].'profile/'.$author_url;

                $pro_url = create_slug($info['product_name']);
                $item[$info['id']]['link'] = $config['site_url'].'ad/' . $info['id'] . '/'.$pro_url;

                $cat_slug = create_slug($get_main['cat_name']);
                $item[$info['id']]['catlink'] = $config['site_url'].'category/'.$info['category'].'/'.$cat_slug;

                $subcat_slug = create_slug($get_sub['sub_cat_name']);
                $item[$info['id']]['subcatlink'] = $config['site_url'].'subcategory/'.$info['sub_category'].'/'.$subcat_slug;

                $city = create_slug($item[$info['id']]['city']);
                $item[$info['id']]['citylink'] = $config['site_url'].'city/'.$info['city'].'/'.$city;
            }


        }
    }


    $pagging = pagenav($total_item,$page,$limit,$link['FAVADS']);
    // Output to template
    $page = new HtmlTemplate ('templates/' . $config['tpl_name'] . '/ad-favourite.tpl');
    $page->SetParameter ('OVERALL_HEADER', create_header($lang['FAVOURITE_ADS']));
    $page->SetParameter ('RESUBMITADS', resubmited_ads_count($_SESSION['user']['id']));
    $page->SetParameter ('HIDDENADS', hidden_ads_count($_SESSION['user']['id']));
    $page->SetParameter ('PENDINGADS', pending_ads_count($_SESSION['user']['id']));
    $page->SetParameter ('FAVORITEADS', favorite_ads_count($_SESSION['user']['id']));
    $page->SetParameter ('EXPIREADS', expire_ads_count($_SESSION['user']['id']));
    $page->SetParameter ('MYADS', myads_count($_SESSION['user']['id']));
    $page->SetLoop ('ITEM', $item);
    $page->SetLoop ('PAGES', $pagging);
    $page->SetParameter ('TOTALITEM', $total_item);
    $page->SetParameter ('AUTHORUNAME', ucfirst($ses_userdata['username']));
    $page->SetParameter ('AUTHORNAME', ucfirst($ses_userdata['name']));
    $page->SetParameter ('AUTHORIMG', $author_image);
    $page->SetLoop ('HTMLPAGE', get_html_pages());
    $page->SetParameter('COPYRIGHT_TEXT', get_option("copyright_text"));
    $page->SetParameter ('OVERALL_FOOTER', create_footer());
    $page->CreatePageEcho();
}
else{
    error($lang['PAGE_NOT_FOUND'], __LINE__, __FILE__, 1);
    exit();
}
?>