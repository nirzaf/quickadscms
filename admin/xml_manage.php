<?php
require_once('includes.php');

$message = "";
if(isset($_POST['update']))
{
    if(!check_allow()){
        ?>
        <script src="plugins/bower_components/jquery/dist/jquery.min.js"></script>
        <script>
            $(document).ready(function(){
                $('#sa-title').trigger('click');
            });
        </script>
    <?php

    }
    else {
        $xml_latest = isset($_POST['xml_latest']) ? 1 : 0;
        $xml_featured = isset($_POST['xml_featured']) ? 1 : 0;

        update_option("xml_latest",$xml_latest);
        update_option("xml_featured",$xml_featured);

        $message = '<span style="color:green;">( XML Options Updated )</span>';

        transfer('xml_manage.php','XML Options Updated','Manage XML Feeds');
        exit;
    }
}

?>



<main class="app-layout-content">

    <!-- Page Content -->
    <div class="container-fluid p-y-md">
        <!-- Partial Table -->
        <div class="card">
            <div class="card-header">
                <h4>Manage XML Feeds</h4>
            </div>
            <div class="card-block">
                <!-- /row -->
                <div class="row">
                    <div class="col-sm-6">
                        <div class="white-box">
                            <div>
                                <div class="text-left"><h3 class="box-title">XML Links</h3></div>
                            </div>
                            <div class="table-responsive">
                                <table cellspacing="1" cellpadding="1" class="table">
                                    <form action="" method="post" name="f1" id="f1">
                                        <thead>
                                        <tr>
                                            <th>Feed Name</th>
                                            <th>Stauts</th>
                                            <th>Link</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Latest Ads</td>
                                                <td><?php if(get_option("xml_latest")== 1){ echo "Enabled"; } ELSE { echo "Disabled"; } ?></td>
                                                <td><a target="_new" href="<?php echo $config['site_url']; ?>sitemap.xml"><?php echo $config['site_url']; ?>sitemap.xml</a></td>
                                            </tr>
                                            <tr>
                                                <td>Premium Ads</td>
                                                <td><?php if(get_option("xml_featured") == 1){ echo "Enabled"; } ELSE { echo "Disabled"; } ?></td>
                                                <td><a target="_new" href="<?php echo $config['site_url']; ?>sitemap.xml?t=premiumads"><?php echo $config['site_url']; ?>sitemap.xml?t=premiumads</a></td>
                                            </tr>
                                        </tbody>
                                        <table width="99%"  border="0" align="center" cellpadding="2" cellspacing="0">
                                            <tr>
                                                <td width="200" valign="middle">&nbsp;</td>
                                                <td valign="middle"><div align="center"><span class="style5 style6">Showing 1-2 of 2 result(s)</span></div></td>
                                                <td width="200" valign="middle">&nbsp;</td>
                                            </tr>
                                        </table>
                                    </form>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="white-box">
                            <form class="form form-horizontal" action="xml_manage.php" method="post">
                                <div>
                                    <div class="text-left"><h3 class="box-title">XML Setting <?php echo $message; ?></h3></div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Latest Ads</label>
                                    <div class="col-sm-8">
                                        <label class="css-input switch switch-sm switch-success">
                                            <input  name="xml_latest" type="checkbox" value="1" <?php if(get_option("xml_latest") == '1'){ echo "checked"; } ?>/><span></span>
                                        </label>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Premium Ads</label>
                                    <div class="col-sm-8">
                                        <label class="css-input switch switch-sm switch-success">
                                            <input  name="xml_featured" type="checkbox" value="1" <?php if(get_option("xml_featured") == '1'){ echo "checked"; } ?> /><span></span>
                                        </label>
                                    </div>
                                </div>

                                <!--Default Horizontal Form-->
                                <div class="form-group">
                                    <label class="col-sm-4 control-label"></label>
                                    <div class="col-sm-6">
                                        <input name="update" type="submit" class="btn btn-primary btn-radius" value="Update">
                                    </div>
                                </div>
                                <!--Default Horizontal Form-->

                            </form>
                        </div>
                    </div>

                </div>
                <!-- /.row -->
            </div>
            <!-- .card-block -->
        </div>
        <!-- .card -->
        <!-- End Partial Table -->

    </div>
    <!-- .container-fluid -->
    <!-- End Page Content -->

</main>




<?php include("footer.php"); ?>