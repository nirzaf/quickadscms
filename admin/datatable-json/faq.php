<?php
/*
Copyright (c) 2015 Devendra Katariya (bylancer.com)
*/
require_once('includes.php');

// initilize all variable
$params = $columns = $totalRecords = $data = array();
$params = $_REQUEST;

if(isset($_POST['action'])){
    if ($_POST['action'] == "get_translation_faq") { get_translation_faq(); }
}

function get_translation_faq()
{
    global $config, $lang;
    $con = db_connect();

    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        $sql = "SELECT id,code,name FROM `".$config['db']['pre']."languages` where active = '1' and code != 'en'";
        $query = mysqli_query($con,$sql);
        mysqli_num_rows($query);
        $child_tpl = '<div class="container m-t-10 m-b-10">
    <div class="row">
        <div class="col-md-12">
            <p>Translations of this faq entry:</p>
                <table class="table table-condensed table-bordered" style="m-t-10">
                    <thead>
                        <tr>
                            <th>Language</th>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Active</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>';

        while($fetch = mysqli_fetch_array($query)){
            $sql2 = "SELECT * FROM `".$config['db']['pre']."faq_entries` where translation_lang = '".$fetch['code']."' and translation_of = '$id' LIMIT 1";
            $query2 = mysqli_query($con,$sql2);
            $info = @mysqli_fetch_assoc($query2);
            $faqid = $info['faq_id'];
            $active = $info['active'];
            if ($active == "0")
                $active = '<span class="label label-warning">Not Active</span>';
            else
                $active = '<span class="label label-info">Active</span>';
            $child_tpl .= '<tr id="'.$faqid.'">
                                <td>'.$fetch['name'].'</td>
                                <td>'.$info['faq_id'].'</td>
                                <td>'.$info['faq_title'].'</td>
                                <td>'.$active.'</td>
                                <td>
                                    <a href="#" data-url="panel/faq_entry_edit.php?id='.$faqid.'" data-toggle="slidePanel" class="btn btn-xs btn-default"> <i class="ion-edit"></i> Edit</a>
                    <a href="javacript:void(0)" class="btn btn-xs btn-danger item-js-delete" data-ajax-action="deleteStaticPage"> <i class="ion-close"></i> Delete</a>
                                </td>
                            </tr>';
        }
        $child_tpl .= '</tbody>
                </table>
            </div>
        </div>
    </div>';
        echo $child_tpl;
    }
    die();
}

//define index of column
$columns = array(
    0 =>'faq_id',
    1 =>'faq_id',
    2 =>'faq_title'
);
$where = $sqlTot = $sqlRec = "";

// check search value exist
if( !empty($params['search']['value']) ) {
    $where .=" WHERE ";
    $where .=" ( faq_id LIKE '".$params['search']['value']."%' ";
    $where .=" OR faq_title LIKE '".$params['search']['value']."%' ) AND translation_lang = 'en'";
}

// getting total number records without any search
$sql = "SELECT * FROM `".$config['db']['pre']."faq_entries` ";
$sqlTot .= $sql;
$sqlRec .= $sql;
//concatenate search sql if value exist
if(isset($where) && $where != '') {

    $sqlTot .= $where;
    $sqlRec .= $where;
}else{
    $where .=" Where ( translation_lang = 'en' )";
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
    $id = $row['faq_id'];
    $title = $row['faq_title'];

    $row0 = '<td>
                <label class="css-input css-checkbox css-checkbox-default">
                    <input type="checkbox" class="service-checker" value="'.$id.'" id="row_'.$id.'" name="row_'.$id.'"><span></span>
                </label>
            </td>';
    $row1 = '<td><i class="fa fa-plus-square-o details-row-button cursor-pointer" data-entry-id="'.$id.'" data-entry-action="get_translation_faq"></i> &nbsp; '.$id.'</td>';
    $row2 = '<td>'.$title.'</td>';
    $row3 = '<td class="text-center">
                <div class="btn-group">
                    <a href="#" data-url="panel/faq_entry_edit.php?id='.$id.'" data-toggle="slidePanel" class="btn btn-xs btn-default"> <i class="ion-edit"></i> Edit</a>
                    <a href="javacript:void(0)" class="btn btn-xs btn-danger item-js-delete" data-ajax-action="deletefaq"> <i class="ion-close"></i></a>
                </div>
            </td>';

    $value = array(
        "DT_RowId" => $id,
        0 => $row0,
        1 => $row1,
        2 => $row2,
        3 => $row3
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
