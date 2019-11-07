<?php
/*
Copyright (c) 2015 Devendra Katariya (bylancer.com)
*/
require_once('includes.php');

// initilize all variable
$params = $columns = $totalRecords = $data = array();
$params = $_REQUEST;
if($params['draw'] == 1)
    $params['order'][0]['dir'] = "desc";

//define index of column
$columns = array(
    0 =>'id',
    1 =>'product_id',
    2 =>'u.username',
    3 =>'amount',
    4 =>'featured',
    5 =>'transaction_gatway',
    6 =>'status',
    7 =>'transaction_time'
);

$where = $sqlTot = $sqlRec = "";

// check search value exist
if( !empty($params['search']['value']) ) {
    $where .=" WHERE ";
    $where .=" ( amount LIKE '".$params['search']['value']."%' ";
    $where .=" OR transaction_gatway LIKE '".$params['search']['value']."%' ";
    $where .=" OR u.username LIKE '".$params['search']['value']."%' ";
    $where .=" OR status LIKE '".$params['search']['value']."%' )";
}

// getting total number records without any search
$sql = "SELECT t.*, u.username as username FROM `".$config['db']['pre']."transaction` as t
INNER JOIN `".$config['db']['pre']."user` as u ON u.id = t.seller_id ";
$sqlTot .= $sql;
$sqlRec .= $sql;
//concatenate search sql if value exist
if(isset($where) && $where != '') {

    $sqlTot .= $where;
    $sqlRec .= $where;
}


$sqlRec .=  " ORDER BY ". $columns[$params['order'][0]['column']]." ".$params['order'][0]['dir']." LIMIT ".$params['start']." ,".$params['length']." ";

$queryTot = $pdo->query($sqlTot);
$totalRecords = $queryTot->rowCount();
$queryRecords = $pdo->query($sqlRec);

//iterate on results row and create new index array of data
foreach ($queryRecords as $row) {
    //$data[] = $row;
    $id = $row['id'];
    $username = $row['username'];
    $ad_id = $row['product_id'];
    $ad_title = $row['product_name'];
    $amount = $row['amount'];
    $payment_method = $row['transaction_gatway'];
    $featured = $row['featured'];
    $urgent = $row['urgent'];
    $highlight = $row['highlight'];
    $t_status = $row['status'];
    $transaction_time = date('d M Y', $row['transaction_time']);
    $tans_link = '';
    $premium = '';
    if($row['transaction_method'] == 'Subscription'){

        $premium = '<span class="label label-default">'.$lang['MEMBERSHIP'].'</span>';
        $trans_link = $config['site_url'].'profile/'.$username;
    }else{
        $trans_link = $config['site_url'].'ad/'.$ad_id;
        $featured = $row['featured'];
        $urgent = $row['urgent'];
        $highlight = $row['highlight'];


        if ($featured == "1") {
            $premium = $premium . '<span class="label label-warning">Featured</span>';
        }

        if ($urgent == "1") {
            $premium = $premium . '<span class="label label-success">Urgent</span>';
        }

        if ($highlight == "1") {
            $premium = $premium . '<span class="label label-info">Highlight</span>';
        }
    }

    $status = '';
    if ($t_status == "success"){
        $status = '<span class="label label-success">Success</span>';
    }
    elseif($t_status == "pending") {
        $status = '<span class="label label-warning">Pending</span>';
    }
    elseif($t_status == "failed") {
        $status = '<span class="label label-danger">failed</span>';
    }else{
        $status = '<span class="label label-danger">cancel</span>';
    }

    $row0 = '<td>
                <label class="css-input css-checkbox css-checkbox-default">
                    <input type="checkbox" class="service-checker" value="'.$id.'" id="row_'.$id.'" name="row_'.$id.'"><span></span>
                </label>
            </td>';
    $row1 = '<td><a href="'.$trans_link.'" target="_blank">'.$ad_title.'</a></td>';
    $row2 = '<td><a href="'.$config['site_url'].'profile/'.$username.'" target="_blank">'.$username.'</a></td>';
    $row3 = '<td>'.$config['currency_sign'].' '.$amount.'</td>';
    $row4 = '<td>'.$premium.'</td>';
    $row5 = '<td>'.$status.'</td>';
    $row6 = '<td>'.$payment_method.'</td>';
    $row7 = '<td>'.$transaction_time.'</td>';
    $row8 = '<td class="text-center">
                <div class="btn-group">
                    <a href="#" data-url="panel/transaction_edit.php?id='.$id.'" data-toggle="slidePanel" class="btn btn-xs btn-default"> <i class="ion-edit"></i> Edit</a>
                    <a href="javacript:void(0)" class="btn btn-xs btn-danger item-js-delete" data-ajax-action="deleteTransaction"> <i class="ion-close"></i></a>
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
        6 => $row6,
        7 => $row7,
        8 => $row8
    );
    $data[] = $value;
}

$json_data = array(
    "draw"            => intval( $params['draw'] ),
    "recordsTotal"    => intval( $totalRecords ),
    "recordsFiltered" => intval($totalRecords),
    "data"            => $data   // total data array
);

echo json_encode($json_data);  // send data as json format
?>
