<?php

$count = 0;
$faq = array();
$rows = ORM::for_table($config['db']['pre'].'faq_entries')
    ->select_many('faq_id','faq_title','faq_content')
    ->where(array(
        'translation_lang' => $config['lang_code'],
        'active' => 1
    ))
    ->order_by_asc('faq_id')
    ->find_many();

foreach ($rows as $info)
{
    $count++;

    $faq[$count]['id'] = $info['faq_id'];
    $faq[$count]['title'] = stripslashes($info['faq_title']);
    $faq[$count]['content'] = stripslashes($info['faq_content']);
}

$advertise_top = get_advertise("top");


$page = new HtmlTemplate ("templates/" . $config['tpl_name'] . "/faq.tpl");
$page->SetParameter ('OVERALL_HEADER', create_header($lang['FAQ']));
$page->SetLoop ('FAQ', $faq);
if(checkloggedin()) {
    $page->SetParameter('USER_ID', $_SESSION['user']['id']);
}else{
    $page->SetParameter('USER_ID', "");
}
/*Advertisement Fetching*/
$page->SetParameter('TOP_ADSCODE', $advertise_top['tpl']);
$page->SetParameter('TOP_ADSTATUS', $advertise_top['status']);
/*Advertisement Fetching*/
$page->SetParameter ('OVERALL_FOOTER', create_footer());
$page->CreatePageEcho();
?>