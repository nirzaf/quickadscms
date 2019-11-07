<?php
/*
Copyright (c) 2015 Devendra Katariya (bylancer.com)
*/
require_once('includes.php');

// initilize all variable
$params = $columns = $totalRecords = $data = array();
$params = $_REQUEST;

//define index of column
$columns = array(
    0 =>'id',
    1 =>'code',
    2 =>'name',
    3 =>'asciiname'
);

$where = $sqlTot = $sqlRec = "";

// check search value exist
if( !empty($params['search']['value']) ) {
    $where .=" WHERE ";
    $where .=" ( code LIKE '".$params['search']['value']."%' ";
    $where .=" OR name LIKE '".$params['search']['value']."%' ";
    $where .=" OR asciiname LIKE '".$params['search']['value']."%')";
    $where .=" AND ( country_code = '".$_GET['code']."' )";
}

// getting total number records without any search
$sql = "SELECT * FROM `".$config['db']['pre']."subadmin1`";
$sqlTot .= $sql;
$sqlRec .= $sql;
//concatenate search sql if value exist
if(isset($where) && $where != '') {

    $sqlTot .= $where;
    $sqlRec .= $where;
}else{
    $where .=" Where ( country_code = '".$_GET['code']."' )";
    $sqlTot .= $where;
    $sqlRec .= $where;
}


$sqlRec .=  " ORDER BY ". $columns[$params['order'][0]['column']]."   ".$params['order'][0]['dir']." LIMIT ".$params['start']." ,".$params['length']." ";

$queryTot = $pdo->query($sqlTot);
$totalRecords = $queryTot->rowCount();
$queryRecords = $pdo->query($sqlRec);

//iterate on results row and create new index array of data
foreach ($queryRecords as $row) {
    //$data[] = $row;
    $id = $row['id'];
    $code = $row['code'];
    $name = $row['name'];
    $asciiname = $row['asciiname'];

    $status = $row['active'];

    if ($status == "1"){
        $status = '<span class="label label-success">Activated</span>';
    }
    elseif($status == "0")
    {
        $status = '<span class="label label-warning">Not Active</span>';
    }

    $row0 = '<td>
                <label class="css-input css-checkbox css-checkbox-default">
                    <input type="checkbox" class="service-checker" value="'.$code.'" id="row_'.$id.'" name="row_'.$id.'"><span></span>
                </label>
            </td>';
    $row1 = '<td>'.$code.'</td>';
    $row2 = '<td>'.$name.'</td>';
    $row3 = '<td>'.$asciiname.'
                <span style="float:right;padding-right: 40px">
                    <a class="btn btn-xs btn-primary" href="loc_district.php?code='.$code.'"><i class="fa fa-folder"></i> District</a>
                    <a class="btn btn-xs btn-primary" href="loc_cities.php?code='.$code.'&name='.$asciiname.'"><i class="fa fa-folder"></i> Cities</a>
                </span>
            </td>';
    $row4 = '<td>'.$status.'</td>';
    $row5 = '<td class="text-center">
                <div class="btn-group">
                    <a href="#" data-url="panel/loc_region_edit.php?code='.$code.'" data-toggle="slidePanel" class="btn btn-xs btn-default"> <i class="ion-edit"></i> Edit</a>
                    <a href="javacript:void(0)" class="btn btn-xs btn-danger item-js-delete" data-ajax-action="deleteState"> <i class="ion-close"></i></a>
                </div>
            </td>';

    $value = array(
        "DT_RowId" => $code,
        0 => $row0,
        1 => $row1,
        2 => $row2,
        3 => $row3,
        4 => $row4,
        5 => $row5
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
