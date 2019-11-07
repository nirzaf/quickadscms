<?php
/*
Copyright (c) 2015 Devendra Katariya (bylancer.com)
*/
require_once('includes.php');

// initilize all variable
$params = $columns = $order = $totalRecords = $data = array();
$params = $_REQUEST;
if($params['draw'] == 1)
    $params['order'][0]['dir'] = "desc";
//define index of column
$columns = array(
    0 =>'p.id',
    1 =>'p.product_name',
    2 =>'u.username',
    3 =>'c.name',
    4 =>'p.created_at',
    5 =>'p.status'
);

$where = $sqlTot = $sqlRec = "";

// check search value exist
if( !empty($params['search']['value']) ){
    if(isset($_GET['status'])) {
        $where .=" WHERE ";
        $where .=" ( p.product_name LIKE '%".$params['search']['value']."%' ";
        $where .=" OR u.username LIKE '%".$params['search']['value']."%' ";
        $where .=" OR c.name LIKE '".$params['search']['value']."%' ";
        $where .=" OR cat.cat_name LIKE '".$params['search']['value']."%' ) ";

        $where .=" AND ( p.status = '".$_GET['status']."' )";
    }else{
        $where .=" WHERE ";
        $where .=" ( p.product_name LIKE '%".$params['search']['value']."%' ";
        $where .=" OR u.username LIKE '%".$params['search']['value']."%' ";
        $where .=" OR c.name LIKE '".$params['search']['value']."%' ";
        $where .=" OR cat.cat_name LIKE '".$params['search']['value']."%' )";
    }
}


// getting total number records without any search
$sql = "SELECT p.id,p.product_name,p.created_at,p.status,p.screen_shot,p.featured,p.urgent,p.highlight, c.name as cityname, cat.cat_name as catname, u.username as username
FROM `".$config['db']['pre']."product` as p
INNER JOIN `".$config['db']['pre']."user` as u ON u.id = p.user_id
INNER JOIN `".$config['db']['pre']."cities` as c ON c.id = p.city
INNER JOIN `".$config['db']['pre']."catagory_main` as cat ON cat.cat_id = p.category ";
$sqlTot .= $sql;
$sqlRec .= $sql;
//concatenate search sql if value exist
if(isset($where) && $where != '') {
    $sqlTot .= $where;
    $sqlRec .= $where;
}else{
    if(isset($_GET['status'])){
        $where .=" Where ( p.status = '".$_GET['status']."' )";
        $sqlTot .= $where;
        $sqlRec .= $where;
    }
}

$sqlRec .=  " ORDER BY ". $columns[$params['order'][0]['column']]." ".$params['order'][0]['dir']." LIMIT ".$params['start']." ,".$params['length']." ";
//echo $sqlRec;

$queryTot = $pdo->query($sqlTot);
$totalRecords = $queryTot->rowCount();
$queryRecords = $pdo->query($sqlRec);

//iterate on results row and create new index array of data
foreach ($queryRecords as $row) {
    $id = $row['id'];
    $username = $row['username'];
    $title = htmlspecialchars($row['product_name']);
    $ad_created_at  = timeAgo($row['created_at']);
    $ad_category = htmlspecialchars($row['catname']);
    $ad_status    = $row['status'];
    $picture     =   explode(',' ,$row['screen_shot']);
    $featured = $row['featured'];
    $urgent = $row['urgent'];
    $highlight = $row['highlight'];

    if($picture[0] != ""){
        $image = $picture[0];
    }else{
        $image = "default.png";
    }


    $premium = '';
    if ($featured == "1"){
        $premium = $premium.'<span class="badge fs-12">featured</span>';
    }

    if($urgent == "1")
    {
        $premium = $premium.'<span class="badge btn-danger fs-12">Urgent</span>';
    }

    if($highlight == "1")
    {
        $premium = $premium.'<span class="badge btn-primary fs-12">Highlight</span>';
    }

    $status = '';
    if ($ad_status == "active"){
        $status = '<span class="label label-success">Approved</span>';
    }
    elseif($ad_status == "pending")
    {
        $status = '<span class="label label-warning">Pending</span>';
    }
    elseif($ad_status == "expire")
    {
        $status = '<span class="label label-danger">Expire</span>';
    }
    else{
        $status = '<span class="label label-danger">Rejected</span>';
    }

    if($ad_status == "pending"){

        $approved_button = '<a href="#"  class="btn btn-xs btn-success item-approve" data-ajax-action="approveitem"><i class="ion-android-done"></i></a>';
    }
    else{
        $approved_button = "";
    }

    $row0 = '<td>
                <label class="css-input css-checkbox css-checkbox-default">
                    <input type="checkbox" class="service-checker" value="'.$id.'" id="row_'.$id.'" name="row_'.$id.'"><span></span>
                </label>
            </td>';
    $row1 = '<td class="text-center">
                <div class="pull-left m-r"><img class="img-avatar img-avatar-48" src="../storage/products/thumb/'.$image.'"></div>
                <p class="font-500 m-b-0"><a href="post_detail.php?id='.$id.'" target="_blank">'.$title.'</a>'.$premium.'</p>
                <p class="text-muted m-b-0">'.$ad_category.'</p>
            </td>';
    $row2 = '<td class="hidden-xs">'.$username.'</td>';
    $row3 = '<td class="hidden-xs">'.$row['cityname'].'</td>';
    $row4 = '<td class="hidden-xs hidden-sm">'.$ad_created_at.'</td>';
    $row5 = '<td class="hidden-xs hidden-sm">'.$status.'</td>';

    $row6 = '<td class="text-center">
                <div class="btn-group">
                '.$approved_button.'
                    <a href="post_detail.php?id='.$id.'" title="View Ad" class="btn btn-xs btn-default"><i class="ion-eye"></i></a>
                    <a href="#" data-url="panel/post_edit.php?id='.$id.'" data-toggle="slidePanel"  title="Edit" class="btn btn-xs btn-default"> <i class="ion-edit"></i> </a>
                    <a href="#" title="Delete" class="btn btn-xs btn-default item-js-delete" data-ajax-action="deleteads"><i class="ion-close"></i></a>
                </div>
            </td>';
    $value = array(
        "DT_RowId" => $id,
        0 => $row0,
        1 => $row1,
        2 => $row2,
        3 => $row3,
        4 => $row4,
        5 => $row5,
        6 => $row6
    );
    $data[] = $value;

    //print_r($value);

}

$json_data = array(
    "draw"            => intval( $params['draw'] ),
    "recordsTotal"    => intval( $totalRecords ),
    "recordsFiltered" => intval($totalRecords),
    "data"            => $data   // total data array
);

echo json_encode($json_data);  // send data as json format
?>
