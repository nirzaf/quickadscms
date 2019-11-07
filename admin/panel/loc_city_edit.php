<?php
require_once('../datatable-json/includes.php');

if(isset($_GET['id'])){
    $info = ORM::for_table($config['db']['pre'].'cities')->find_one($_GET['id']);
}else{
    exit('Error: 404 Page not found');
}
?>
<header class="slidePanel-header overlay">
    <div class="overlay-panel overlay-background vertical-align">
        <div class="service-heading">
            <h2>City Edit → <?php echo $info['asciiname'] ?></h2>
        </div>
        <div class="slidePanel-actions">
            <div class="btn-group-flat">
                <button type="button" class="btn btn-floating btn-warning btn-sm waves-effect waves-float waves-light margin-right-10" id="post_sidePanel_data"><i class="icon ion-android-done" aria-hidden="true"></i></button>
                <button type="button" class="btn btn-pure btn-inverse slidePanel-close icon ion-android-close font-size-20" aria-hidden="true"></button>
            </div>
        </div>
    </div>
</header>
<div class="slidePanel-inner">
    <div class="panel-body">
        <!-- /.row -->
        <div class="row">
            <div class="col-sm-12">

                <div class="white-box">
                    <div id="post_error"></div>
                    <form name="form2"  class="form form-horizontal" method="post" data-ajax-action="editCity" id="sidePanel_form">
                        <div class="form-body">
                            <input type="hidden" name="id" value="<?php echo $_GET['id']?>">
                            <input type="hidden" name="country_code" value="<?php echo $info['country_code']; ?>" class="form-control">
                            <input type="hidden" name="subadmin1_code" value="<?php echo $info['subadmin1_code']; ?>" class="form-control">
                            <input type="hidden" name="subadmin2_code" value="<?php echo $info['subadmin2_code']; ?>" class="form-control">

                            <div class="form-group">
                                <label class="col-sm-4 control-label">Local Name</label>
                                <div class="col-sm-6">
                                    <input type="text" name="name" value="<?php echo $info['name'] ?>" placeholder="Local Name" class="form-control" required>
                                </div>
                            </div>
                            <!-- text input -->
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Name</label>
                                <div class="col-sm-6">
                                    <input type="text" name="asciiname" value="<?php echo $info['asciiname'] ?>" placeholder="Enter the name (In English)" class="form-control" required>
                                </div>
                            </div>

                            <!-- text input -->
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Latitude</label>
                                <div class="col-sm-6">
                                    <input type="text" name="latitude" value="<?php echo $info['latitude'] ?>" placeholder="Latitude" class="form-control">
                                    <p class="help-block">In decimal degrees (wgs84)</p>
                                </div>
                            </div>
                            <!-- text input -->
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Longitude</label>
                                <div class="col-sm-6">
                                    <input type="text" name="longitude" value="<?php echo $info['longitude'] ?>" placeholder="Longitude" class="form-control">
                                    <p class="help-block">In decimal degrees (wgs84)</p>
                                </div>
                            </div>
                            <!-- text input -->
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Population</label>
                                <div class="col-sm-6">
                                    <input type="text" name="population" value="<?php echo $info['population'] ?>" placeholder="Population" class="form-control">
                                </div>
                            </div>
                            <!-- text input -->
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Time Zone ID</label>
                                <div class="col-sm-6">
                                    <input type="text" name="time_zone" value="<?php echo $info['time_zone'] ?>" placeholder="Enter the time zone ID (example: Europe/Paris)" class="form-control">
                                    <p class="help-block">Please check the TimeZoneId code format here: <a href="http://download.geonames.org/export/dump/timeZones.txt" target="_blank">http://download.geonames.org/export/dump/timeZones.txt</a></p>
                                </div>
                            </div>
                            <!-- text input -->
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Active</label>
                                <div class="col-sm-6">
                                    <label class="css-input switch switch-sm switch-success">
                                        <input name="active" type="checkbox" value="1" <?php if($info['active'] == '1') echo "checked"; ?> /><span></span>
                                    </label>
                                </div>

                            </div>
                            <input type="hidden" name="submit">

                        </div>

                    </form>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
</div>