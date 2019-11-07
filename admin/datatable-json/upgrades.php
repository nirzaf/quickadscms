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
    0 =>'upgrade_id',
    1 =>'sub_id',
    2 =>'user_id'
);

$where = $sqlTot = $sqlRec = "";

// check search value exist
if( !empty($params['search']['value']) ) {
    $where .=" WHERE ";
    $where .=" ( upgrade_id LIKE '".$params['search']['value']."%' )";
}

// getting total number records without any search
$sql = "SELECT * FROM `".$config['db']['pre']."upgrades` ";
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
    $id = $row['upgrade_id'];
    $start_date = date("d-m-Y",$row['upgrade_lasttime']);
    $end_date = date("d-m-Y",$row['upgrade_expires']);

    $username = 'Removed';
    $info = ORM::for_table($config['db']['pre'].'user')
        ->select('username')
        ->where('id',$row['user_id'])
        ->find_one();

    $user_info = count($info);
    $username = $info['username'];

    $sub_info = ORM::for_table($config['db']['pre'].'subscriptions')
        ->select_many('sub_title','sub_term')
        ->where('sub_id',$row['sub_id'])
        ->find_one();

    $sub_title = stripslashes($sub_info['sub_title']);
    $sub_term = stripslashes($sub_info['sub_term']);
    if($sub_term == 'DAILY')
    {
        $term = $lang['DAILY'];
    }
    elseif($sub_term == 'WEEKLY') {
        $term = $lang['WEEKLY'];
    }
    elseif($sub_term == 'MONTHLY')
    {
        $term = $lang['MONTHLY'];
    }
    elseif($sub_term == 'YEARLY')
    {
        $term = $lang['YEARLY'];
    }

    $row0 = '<td>
                <label class="css-input css-checkbox css-checkbox-default">
                    <input type="checkbox" class="service-checker" value="'.$id.'" id="row_'.$id.'" name="row_'.$id.'"><span></span>
                </label>
            </td>';
    $row1 = '<td><a href="'.$config['site_url'].'profile/'.$username.'" target="_blank">'.$username.'</a></td>';
    $row2 = '<td>'.$sub_title.'</td>';
    $row3 = '<td>'.$term.'</td>';
    $row4 = '<td>'.$start_date.' / '.$end_date.'</td>';

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
