<?php
header('Content-type: text/xml');

function text_replace_for_xml($text){
    $text = str_replace("&","&amp;",stripslashes($text));
    $text = str_replace('<','&lt;',$text);
    $text = str_replace('>','&gt;',$text);
    return $text;
}

if($config['xml_latest'] == 1){
    echo '<?xml version="1.0" encoding="UTF-8"?>';
    echo '<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1" xmlns:video="http://www.google.com/schemas/sitemap-video/1.1" xmlns:news="http://www.google.com/schemas/sitemap-news/0.9" xmlns:mobile="http://www.google.com/schemas/sitemap-mobile/1.0" xmlns:pagemap="http://www.google.com/schemas/sitemap-pagemap/1.0" xmlns:xhtml="http://www.w3.org/1999/xhtml" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';

    $rows = ORM::for_table($config['db']['pre'].'catagory_main')
        ->select_many('cat_id','slug')
        ->order_by_asc('cat_order')
        ->find_many();

    foreach ($rows as $info)
    {
        $slug = text_replace_for_xml($info['slug']);
        $catlink = $config['site_url'].'category/'.$slug;

        echo '<url>';
        echo '<loc>' . $catlink . '</loc>';
        echo '<changefreq>monthly</changefreq>';
        echo '<priority>1</priority>';
        echo '</url>';

        $rows1 = ORM::for_table($config['db']['pre'].'catagory_sub')
            ->select('slug')
            ->where('main_cat_id', $info['cat_id'])
            ->find_many();

        foreach ($rows1 as $info1)
            $sub_slug = text_replace_for_xml($info1['slug']);
        $subcatlink = $config['site_url'].'category/'.$slug.'/'.$sub_slug;
        echo '<url>';
        echo '<loc>' . $subcatlink . '</loc>';
        echo '<changefreq>monthly</changefreq>';
        echo '<priority>1</priority>';
        echo '</url>';

    }


    $rows = ORM::for_table($config['db']['pre'].'product')
        ->select_many('id','product_name','created_at','updated_at','featured','urgent','highlight')
        ->order_by_asc('id')
        ->find_many();

    foreach ($rows as $info)
    {

        $premium = 0;
        if ($info['featured'] == "1"){
            $premium = 1;
        }

        if($info['urgent'] == "1")
        {
            $premium = 1;
        }

        if($info['highlight'] == "1")
        {
            $premium = 1;
        }

        $pro_url = create_slug($info['product_name']);
        $item_link = $config['site_url'].'ad/' . $info['id'] . '/'.$pro_url;
        $item_created_at = date('Y-m-d', strtotime($info['created_at']));
        $item_updated_at = date('Y-m-d', strtotime($info['updated_at']));
        echo '<url>';
        echo '<loc>' . $item_link . '</loc>';
        //echo '<lastmod>'.$item_updated_at.'</lastmod>';
        echo '<changefreq>daily</changefreq>';
        if($premium == 1){
            echo '<priority>1</priority>';
        }
        echo '</url>';
    }
    $rows = ORM::for_table($config['db']['pre'].'user')
        ->select_many('username','created_at','updated_at')
        ->order_by_asc('id')
        ->find_many();
    foreach ($rows as $info)
    {
        $url = create_slug($info['username']);
        $user_link = $config['site_url'].'profile/'.$url;
        $created_at = date('Y-m-d', strtotime($info['created_at']));
        $updated_at = date('Y-m-d', strtotime($info['updated_at']));
        echo '<url>';
        echo '<loc>' . $user_link . '</loc>';
        //echo '<lastmod>'.$updated_at.'</lastmod>';
        echo '<changefreq>daily</changefreq>';
        if($premium == 1){
            echo '<priority>1</priority>';
        }
        echo '</url>';
    }


    echo '</urlset>';
}
?>