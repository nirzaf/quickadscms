<?php

$info = ORM::for_table($config['db']['pre'].'pages')
    ->select('translation_of')
    ->where(array(
        'slug' => $_GET['id'],
        'active' => 1
    ))
    ->find_one();

$info2 = ORM::for_table($config['db']['pre'].'pages')
    ->where(array(
        'translation_lang' => $config['lang_code'],
        'translation_of' => $info['translation_of'],
        'active' => 1
    ))
    ->find_one();
if (count($info2) > 0)
{
    $html = stripslashes($info2['content']);
    $name = stripslashes($info2['name']);
    $title = stripslashes($info2['title']);
    $type = $info2['type'];
}

if(!isset($title))
{
	message("Error",$lang['PAGENOTEXIST']);
}

if($type == 1)
{
	if(!isset($_SESSION['user']['id']))
	{
		message("Login to view",$lang['MUSTLOGINVIEWPAGE']);
	}
}

if(isset($_GET['basic']))
{
	$page = new HtmlTemplate ('templates/' . $config['tpl_name'] . '/html_content_no.tpl');
}
else
{
	$page = new HtmlTemplate ('templates/' . $config['tpl_name'] . '/html_content.tpl');
}
$page->SetParameter ('OVERALL_HEADER', create_header($name));
$page->SetParameter ('SITE_TITLE', $config['site_title']);
$page->SetParameter ('NAME', $name);
$page->SetParameter ('TITLE', $title);
$page->SetParameter ('HTML', $html);
$page->SetParameter ('OVERALL_FOOTER', create_footer());
$page->CreatePageEcho();
?>