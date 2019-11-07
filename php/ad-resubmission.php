<?php
if(!isset($_GET['page']))
    $_GET['page'] = 1;

$limit = 5;

if(checkloggedin()) {
    $ses_userdata = get_user_data($_SESSION['user']['username']);
    $author_image = $ses_userdata['image'];

    $total_item = resubmited_ads_count($_SESSION['user']['id']);

    $items = get_resubmited_items($_SESSION['user']['id'],"",$_GET['page'],$limit);

    $pagging = pagenav($total_item,$_GET['page'],$limit,$link['RESUBMITADS']);
    // Output to template
    $page = new HtmlTemplate ('templates/' . $config['tpl_name'] . '/ad-resubmission.tpl');
    $page->SetParameter ('OVERALL_HEADER', create_header($lang['RESUBMITED_ADS']));
    $page->SetParameter ('RESUBMITADS', $total_item);
    $page->SetParameter ('HIDDENADS', hidden_ads_count($_SESSION['user']['id']));
    $page->SetParameter ('PENDINGADS', pending_ads_count($_SESSION['user']['id']));
    $page->SetParameter ('FAVORITEADS', favorite_ads_count($_SESSION['user']['id']));
    $page->SetParameter ('EXPIREADS', expire_ads_count($_SESSION['user']['id']));
    $page->SetParameter ('MYADS', myads_count($_SESSION['user']['id']));
    $page->SetLoop ('ITEM', $items);
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