<?php
/*
Copyright (c) 2015 Devendra Katariya (bylancer.com)
*/
require_once('includes.php');

// initilize all variable
$params = $columns = $totalRecords = $data = array();
$params = $_REQUEST;
if($params['draw'] == 1){
    $params['order'][0]['column'] = 2;
    $params['order'][0]['dir'] = "asc";
}

//define index of column
$columns = array(
    0 =>'id',
    1 =>'country_code',
    2 =>'time_zone_id',
    3 =>'gmt',
    4 =>'dst',
    5 =>'raw'
);

$where = $sqlTot = $sqlRec = "";

// check search value exist
if( !empty($params['search']['value']) ) {
    $where .=" WHERE ";
    $where .=" ( country_code LIKE '".$params['search']['value']."%' ";
    $where .=" OR time_zone_id LIKE '".$params['search']['value']."%' ";
    $where .=" OR gmt LIKE '".$params['search']['value']."%' ";
    $where .=" OR dst LIKE '".$params['search']['value']."%' ";
    $where .=" OR raw LIKE '".$params['search']['value']."%' )";
}

// getting total number records without any search
$sql = "SELECT * FROM `".$config['db']['pre']."time_zones` ";
$sqlTot .= $sql;
$sqlRec .= $sql;
//concatenate search sql if value exist
if(isset($where) && $where != '') {

    $sqlTot .= $where;
    $sqlRec .= $where;
}


$sqlRec .=  " ORDER BY ". $columns[$params['order'][0]['column']]."   ".$params['order'][0]['dir']."  LIMIT ".$params['start']." ,".$params['length']." ";

$queryTot = $pdo->query($sqlTot);
$totalRecords = $queryTot->rowCount();
$queryRecords = $pdo->query($sqlRec);

//iterate on results row and create new index array of data
foreach ($queryRecords as $row) {
    //$data[] = $row;
    $id                 = $row['id'];
    $country_code       = $row['country_code'];
    $time_zone_id       = $row['time_zone_id'];
    $gmt                = $row['gmt'];
    $dst                = $row['dst'];
    $raw                = $row['raw'];

    $row0 = '<td>
                <label class="css-input css-checkbox css-checkbox-default">
                    <input type="checkbox" class="service-checker" value="'.$id.'" id="row_'.$id.'" name="row_'.$id.'"><span></span>
                </label>
            </td>';
    $row1 = '<td>'.$country_code.'</td>';
    $row2 = '<td>'.$time_zone_id.'</td>';
    $row3 = '<td>'.$gmt.'</td>';
    $row4 = '<td>'.$dst.'</td>';
    $row5 = '<td>'.$raw.'</td>';
    $row6 = '<td class="text-center">
                <div class="btn-group">
                    <a href="#" data-url="panel/timezone_edit.php?id='.$id.'" data-toggle="slidePanel" class="btn btn-xs btn-default"> <i class="ion-edit"></i> Edit</a>
                    <a href="javacript:void(0)" class="btn btn-xs btn-danger item-js-delete" data-ajax-action="deleteTimezone"> <i class="ion-close"></i></a>
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
}

$json_data = array(
    "draw"            => intval( $params['draw'] ),
    "recordsTotal"    => intval( $totalRecords ),
    "recordsFiltered" => intval($totalRecords),
    "data"            => $data   // total data array
);

echo json_encode($json_data);  // send data as json format
?>
