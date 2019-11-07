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
    3 =>'asciiname',
    4 =>'active'
);

$where = $sqlTot = $sqlRec = "";

// check search value exist
if( !empty($params['search']['value']) ) {
    $where .=" WHERE ";
    $where .=" ( code LIKE '".$params['search']['value']."%' ";
    $where .=" OR name LIKE '".$params['search']['value']."%' ";
    $where .=" OR asciiname LIKE '".$params['search']['value']."%' ";

    $where .=" OR active LIKE '".$params['search']['value']."%' )";
}

// getting total number records without any search
$sql = "SELECT * FROM `".$config['db']['pre']."countries`";
$sqlTot .= $sql;
$sqlRec .= $sql;
//concatenate search sql if value exist
if(isset($where) && $where != '') {

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

    $install_button = "";

    if ($status == "1"){
        $status = '<span class="label label-success">Activated</span>';
        $install_button = '<a href="javacript:void(0)" data-toggle="tooltip" data-original-title="Uninstall" class="btn btn-xs btn-warning uninstall-country" data-ajax-action="uninstallCountry"> <i class="fa fa-close"></i> Uninstall</a>';
    }
    elseif($status == "0")
    {
        $status = '<span class="label label-warning">Not Active</span>';
        $install_button = '<a href="javacript:void(0)" data-toggle="tooltip" data-original-title="Install" class="btn btn-xs btn-success  install-country"  data-ajax-action="installCountry"> <i class="fa fa-download"></i> Install</a>';
    }



    $row0 = '<td>
                <label class="css-input css-checkbox css-checkbox-default">
                    <input type="checkbox" class="service-checker" value="'.$code.'"  id="row_'.$id.'" name="row_'.$id.'"><span></span>
                </label>
            </td>';
    $row1 = '<td>'.$code.'</td>';
    $row2 = '<td>'.$name.'</td>';
    $row3 = '<td>'.$asciiname.'
                <span style="float:right;padding-right: 40px">
                    <a class="btn btn-xs btn-info" href="loc_region.php?code='.$code.'"><i class="fa fa-folder"></i> Regions(State)</a>
                    <a class="btn btn-xs btn-info" href="loc_cities.php?code='.$code.'&name='.$asciiname.'"><i class="fa fa-folder"></i> Cities</a>
                </span>
            </td>';
    $row4 = '<td>'.$status.'</td>';
    $row5 = '<td class="text-center">
                <div class="btn-group">
                    '.$install_button.'
                    <a href="#" data-url="panel/loc_country_edit.php?code='.$code.'" data-toggle="slidePanel" class="btn btn-xs btn-default"> <i class="ion-edit"></i> Edit</a>
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
