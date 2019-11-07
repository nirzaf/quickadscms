<?php

$countries = array();
$count = 1;

$row = ORM::for_table($config['db']['pre'].'countries')
    ->where('active',1)
    ->order_by_asc('asciiname')
    ->find_many();
$total = count($row);
$divide = intval($total/4)+1;
$col = "";
foreach ($row as $info)
{
    $countrylang = getLangFromCountry($info['languages']);
    $countries[$count]['tpl'] = "";
    if($count == 1 or $count == $col){
        $countries[$count]['tpl'] .= '<ul class="flag-list col-xs-3 ">';
        $checkEnd = $count+$divide-1;
        $col = $count+$divide;
        //echo "Start : ".$divide."<br>";
    }
    $countries[$count]['tpl'] .= '<li><span class="flag flag-'.strtolower($info['code']).'"></span><a href="'.$config['site_url'].'home/'.$countrylang.'/'.$info['code'].'" data-id="'.$info['id'].'" data-name="'.$info['asciiname'].'">'.$info['asciiname'].'</a></li>';


    if($count == $checkEnd or $count == $total){
        $countries[$count]['tpl'] .= '</ul>';
        //echo "end : ".$checkEnd."<br>";
    }
    $count++;
}


$title = "Free Local Classified Ads in the World";
$page = new HtmlTemplate ('templates/' . $config['tpl_name'] . '/countries.tpl');
$page->SetParameter ('OVERALL_HEADER', create_header($title));
$page->SetLoop ('COUNTRYLIST',$countries);
$page->SetParameter ('OVERALL_FOOTER', create_footer());
$page->CreatePageEcho();
?>