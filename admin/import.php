<?php
require_once('includes.php');


if(isset($_POST['import'])){
    $csv_file =  $_FILES['csv_file']['tmp_name'];
    if (is_file($csv_file)) {
        $input = fopen($csv_file, 'a+');
        // if the csv file contain the table header leave this line
        $row = fgetcsv($input, 1024, ','); // here you got the header
        while ($row = fgetcsv($input, 1024, ',')) {
            $slug = create_post_slug($row[2]);
            // insert into the database
            $item_insrt = ORM::for_table($config['db']['pre'].'product')->create();
            $item_insrt->user_id = $row[1];
            $item_insrt->product_name = $row[2];
            $item_insrt->slug = $slug;
            $item_insrt->status = $row[3];
            $item_insrt->category = $row[4];
            $item_insrt->sub_category = $row[5];
            $item_insrt->description = $row[6];
            $item_insrt->price = $row[7];
            $item_insrt->phone = $row[8];
            $item_insrt->city = $row[9];
            $item_insrt->state = $row[10];
            $item_insrt->country = $row[11];
            $item_insrt->latlong = $row[12];
            $item_insrt->screen_shot = $row[13];
            $item_insrt->created_at = $row[14];
            $item_insrt->updated_at = $row[15];
            $item_insrt->expire_date = $row[16];
            $item_insrt->save();
        }
    }
}

?>

<style>
    * {
        margin: 0;
        padding: 0;
    }
    body {
        padding: 10px;
        background: #eaeaea;
        text-align: center;
        font-family: arial;
        font-size: 12px;
        color: #333333;
    }
    .container {
        width: 1000px;
        height: auto;
        background: #ffffff;
        border: 1px solid #cccccc;
        border-radius: 10px;
        margin: auto;
        text-align: left;
    }

    .main_title {
        background: #B91CF7;
        color: #EED02E;
        padding: 10px;
        font-size: 20px;
        line-height: 20px;
    }
    .content {
        padding: 10px;
        min-height: 100px;
    }
    .footer {
        padding: 10px;
        text-align: right;
    }
    .footer a {
        color: #999999;
        text-decoration: none;
    }
    .footer a:hover {
        text-decoration: underline;
    }
    /* Operations ************/
    .align_right {
        text-align: right;
    }
    .import {
        display: inline-block;
        background: url('assets/images/import.png') no-repeat left;
        background-size: auto 100%;
        line-height: 20px;
        padding-left: 25px;
        color: #F78825;
        font-size: 14px;
        font-weight: bold;
        text-decoration: none;
        margin-right: 20px;
        cursor: pointer;
    }
    .export {
        display: inline-block;
        background: url('assets/images/export.png') no-repeat left;
        background-size: auto 100%;
        line-height: 20px;
        padding-left: 25px;
        color: #F78825;
        font-size: 14px;
        font-weight: bold;
        text-decoration: none;
        border: none;
    }
    .import:hover, .export:hover {
        text-decoration: underline;
        color: #2F0FF1;
    }
    .field_container {
        padding: 10px;
        margin: 0 0 10px 0;
        border: 1px solid #cccccc;
        border-radius: 10px;
    }
    .field_container legend {
        padding: 0 5px 0 5px;
        font-size: 14px;
        font-weight: bold;
        width: auto;
        border-bottom: none;
    }
    /* users list ************/
    .table_list {
        width: 100%;
        border: 0;
    }
    .table_list td, .table_list th {
        padding: 2px;
    }
    .delete_m {
        color: #666666;
        text-decoration: none;
        font-weight: bold;
    }
    .delete_m:hover {
        color: #999999;
    }
    .delete_m img {
        height: 12px;
    }
    .bg_h {
        background: #2F0FF1;
        color: #ffffff;
        text-align: center;
    }
    .bg_1 {
        background: #DCD8F5;
        text-align: center;
    }
    .bg_2 {
        background: #BBB2F2;
        text-align: center;
    }
    #list_container {
        text-align: center;
    }
    /* popup --------------------------*/
    #popup_upload {
        position: fixed;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        background: rgba(0, 0 ,0, 0.7);
        z-index: 99;
        text-align: center;
        display: none;
        overflow: auto;
    }
    .form_upload {
        width: 300px;
        height: 140px;
        border: 1px solid #999999;
        border-radius: 10px;
        background: #ffffff;
        color: #666666;
        margin: auto;
        margin-top: 160px;
        padding: 10px;
        text-align: left;
        position: relative;
    }
    .form_upload h2 {
        border-bottom: 1px solid #999999;
        padding: 0 0 5px 0;
        margin: 0 0 20px 0;
    }
    .file_input {
        width: 97%;
        background: #eaeaea;
        border: 1px solid #999999;
        border-radius: 5px;
        color: #333333;
        padding: 1%;
        margin: 0 0 20px 0;
    }
    #upload_btn {
        background: #2F0FF1;
        color: #FFFFFF;
        border: 1px solid #999999;
        border-radius: 10px;
        float: right;
        line-height: 20px;
        font-size: 14px;
        font-weight: bold;
        font-family: arial;
        display: block;
        padding: 5px;
        cursor: pointer;
    }
    #upload_btn:hover {
        box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
    }
    .close {
        position: absolute;
        display: block;
        right: 10px;
        cursor: pointer;
        font-size: 20px;
        line-height: 16px;
        width: 18px;
        height: 18px;
        border: 1px solid #cccccc;
        border-radius: 5px;
        background: #F0F0F0;
        text-align: center;
        font-weight: bold;
    }
    .close:hover {
        background: #cccccc;
        color: #F00F0F
    }
    .dialog {
        color: #2F0FF1;
    }
</style>
<main class="app-layout-content">

    <div class="container">

        <h1 class="main_title">Import and Export CSV from MySQL in PHP</h1>
        <div class="content">
            <form action="exporter.php" method="post" enctype="multipart/form-data">
            <fieldset class="field_container align_right">
                <legend> <img src="assets/images/arrow.gif"> Operations</legend>
                <span class="import" onclick="show_popup('popup_upload')">Import CSV</span>
                <button class="export" type="submit" name="export">Export CSV</button>
            </fieldset>
            </form>
            <?php
            $rows = ORM::for_table($config['db']['pre'].'product')->limit(20)->find_many();
            ?>
            <fieldset class="field_container">
                <legend> <img src="assets/images/arrow.gif"> Post list </legend>
                <div id="list_container">
                    <table class="table_list" cellspacing="2" cellpadding="0">
                        <tr class="bg_h">
                            <th>id</th>
                            <th>user_id</th>
                            <th>product_name</th>
                            <th>status</th>
                            <th>category</th>
                            <th>sub_category</th>
                            <th width="10%">description</th>
                        </tr>
                        <?php
                        $bg = 'bg_1';
                        foreach ($rows as $rs) {
                            ?>
                            <tr class="<?php echo $bg; ?>">
                                <td><?php echo $rs['id']; ?></td>
                                <td><?php echo $rs['user_id']; ?></td>
                                <td><?php echo $rs['product_name']; ?></td>
                                <td><?php echo $rs['status']; ?></td>
                                <td><?php echo $rs['category']; ?></td>
                                <td><?php echo $rs['sub_category']; ?></td>
                                <td  width="10%"><?php echo $rs['description']; ?></td>
                            </tr>
                            <?php
                            if ($bg == 'bg_1') {
                                $bg = 'bg_2';
                            } else {
                                $bg = 'bg_1';
                            }
                        }
                        ?>
                    </table>
                </div><!-- list_container -->
            </fieldset>
        </div><!-- content --><!-- footer -->
    </div><!-- container -->

    <!-- The popup for upload a csv file -->
    <div id="popup_upload">
        <div class="form_upload">
            <span class="close" onclick="close_popup('popup_upload')">x</span>
            <h2 class="dialog">Upload CSV file</h2>
            <form action="#" method="post" enctype="multipart/form-data">
                <input type="file" name="csv_file" id="csv_file" class="file_input">
                <input type="hidden" name="import">
                <input type="submit" value="Upload file" id="upload_btn">
            </form>
        </div>
    </div>

</main>

<?php include("footer.php"); ?>
<script>
    // show_popup : show the popup
    function show_popup(id) {
        // show the popup
        $('#'+id).show();
    }

    // close_popup : close the popup
    function close_popup(id) {
        // hide the popup
        $('#'+id).hide();
    }
</script>