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
    1 =>'code',
    2 =>'name',
    3 =>'direction',
    4 =>'active'
);

$where = $sqlTot = $sqlRec = "";

// check search value exist
if( !empty($params['search']['value']) ) {
    $where .=" WHERE ";
    $where .=" ( code LIKE '".$params['search']['value']."%' ";
    $where .=" OR name LIKE '".$params['search']['value']."%' ";
    $where .=" OR direction LIKE '".$params['search']['value']."%' ";
    $where .=" OR active LIKE '".$params['search']['value']."%' )";
}

// getting total number records without any search
$sql = "SELECT * FROM `".$config['db']['pre']."languages` ";
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
    $id = $row['id'];
    $code = $row['code'];
    $name = $row['name'];
    $file_name = $row['file_name'];
    $direction = $row['direction'];
    $active = $row['active'];

    if ($active == "1"){
        $active = '<span class="label label-info">Active</span>';
    }
    else{
        $active = '<span class="label label-warning">Deactivate</span>';
    }

    $row0 = '<td>
                <label class="css-input css-checkbox css-checkbox-default">
                    <input type="checkbox" class="service-checker" value="'.$id.'" id="row_'.$id.'" name="row_'.$id.'"><span></span>
                </label>
            </td>';
    $row1 = '<td>'.$code.'</td>';
    $row2 = '<td>'.$name.'<a href="language_file.php?file='.$file_name.'" class="btn btn-xs btn-default font-12"> <i class="ion-edit"></i> Edit '.$file_name.' file</a></td>';
    $row3 = '<td>'.$direction.'</td>';
    $row4 = '<td>'.$active.'</td>';
    $row5 = '<td class="text-center">
                <div class="btn-group">
                    <a href="#" data-url="panel/language_edit.php?id='.$id.'" data-toggle="slidePanel" class="btn btn-xs btn-default"> <i class="ion-edit"></i> Edit</a>
                    <a href="#" class="btn btn-xs btn-danger item-js-delete" data-ajax-action="deleteLanguage"> <i class="ion-close"></i></a>
                </div>
            </td>';

    $value = array(
        "DT_RowId" => $id,
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
