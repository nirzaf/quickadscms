<?php
require_once('../datatable-json/includes.php');

$info = ORM::for_table($config['db']['pre'].'adsense')->find_one($_GET['id']);

$status = $info['status'];
?>

<header class="slidePanel-header overlay">
    <div class="overlay-panel overlay-background vertical-align">
        <div class="service-heading">
            <h2>Edit Advertise <?php echo $info['slug']; ?></h2>
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
                    <form name="form2"  class="form form-horizontal" method="post" data-ajax-action="editAdvertise" id="sidePanel_form">
                        <div class="form-body">
                            <input type="hidden" name="id" value="<?php echo $_GET['id']?>">

                            <div class="form-group">
                                <label class="col-sm-4 control-label">Provider name:</label>
                                <div class="col-sm-6">
                                    <input name="provider_name" type="text" class="form-control" value="<?php echo $info['provider_name']; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Status on/off</label>
                                <div class="col-sm-6">
                                    <label class="css-input switch switch-success">
                                        <input  name="status" type="checkbox" value="1" <?php if($status == '1') echo "checked"; ?> /><span></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Tracking Code (Large Format):</label>
                                <div class="col-sm-6">
                                    <textarea name="large_track_code" rows="6" type="text" class="form-control"><?php echo $info['large_track_code']; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Tracking Code (Tablet  Format):</label>
                                <div class="col-sm-6">
                                    <textarea name="tablet_track_code" rows="6" type="text" class="form-control"><?php echo $info['tablet_track_code']; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Tracking Code (Phone Format):</label>
                                <div class="col-sm-6">
                                    <textarea name="phone_track_code" rows="6" type="text" class="form-control"><?php echo $info['phone_track_code']; ?></textarea>
                                </div>
                            </div>

                        </div>

                    </form>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
</div>

