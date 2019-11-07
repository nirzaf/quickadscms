<?php
/*
Copyright (c) 2015 Devendra Katariya (bylancer.com)
*/
require_once('includes.php');

// initilize all variable
$params = $columns = $totalRecords = $data = array();
$params = $_REQUEST;
if($params['draw'] == 1){
    $params['order'][0]['column'] = 3;
    $params['order'][0]['dir'] = "asc";
}
//define index of column
$columns = array(
    0 =>'payment_id',
    1 =>'payment_id',
    2 =>'payment_title',
    3 =>'payment_install'
);
$where = $sqlTot = $sqlRec = "";

// check search value exist
if( !empty($params['search']['value']) ) {
    $where .=" WHERE ";
    $where .=" ( payment_title LIKE '".$params['search']['value']."%' ";
    $where .=" OR payment_install LIKE '".$params['search']['value']."%' )";
}

// getting total number records without any search
$sql = "SELECT * FROM `".$config['db']['pre']."payments` ";
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
    $id = $row['payment_id'];
    $name = $row['payment_title'];
    $folder = $row['payment_folder'];
    if($row['payment_install'] == 1)
        $install = '<span class="label label-info">Installed</span>';
    else
        $install = '<span class="label label-warning">Uninstall</span>';

    if($row['payment_install'] == 1) {

        $install_button = '<a href="#"  class="btn btn-xs btn-warning uninstall-payment" data-ajax-action="uninstallPayment"><i class="fa fa-close"></i> Uninstall</a>';
    }
    else{
        $install_button = '<a href="#"  class="btn btn-xs btn-success install-payment" data-ajax-action="installPayment"><i class="fa fa-download"></i> Install</a>';
    }

    $row0 = '<td>
                <label class="css-input css-checkbox css-checkbox-default">
                    <input type="checkbox" class="service-checker" value="'.$id.'" id="row_'.$id.'" name="row_'.$id.'"><span></span>
                </label>
            </td>';
    $row1 = '<td><img src="'.$config['site_url'].'includes/payments/'.$folder.'/logo/logo.png" height="40px"/></td>';
    $row2 = '<td>'.$name.'</td>';
    $row3 = '<td>'.$install.'</td>';
    $row4 = '<td class="text-center">
                <div class="btn-group">
                    <a href="#" data-url="panel/payment_edit.php?id='.$id.'" data-toggle="slidePanel" class="btn btn-xs btn-default"> <i class="ion-edit"></i> Edit</a>
                   '.$install_button.'
                </div>
            </td>';

    $value = array(
        "DT_RowId" => $id,
        0 => $row0,
        1 => $row1,
        2 => $row2,
        3 => $row3,
        4 => $row4
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
