<?php
require_once('../datatable-json/includes.php');

$info = ORM::for_table($config['db']['pre'].'time_zones')->find_one($_GET['id']);
?>

<header class="slidePanel-header overlay">
    <div class="overlay-panel overlay-background vertical-align">
        <div class="service-heading">
            <h2>Edit Timezone</h2>
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
                    <form name="form2"  class="form form-horizontal" method="post" data-ajax-action="editTimezone" id="sidePanel_form">
                        <div class="form-body">
                            <input type="hidden" name="id" value="<?php echo $_GET['id']?>">

                            <div class="form-group">
                                <label class="col-sm-4 control-label">Country *</label>
                                <div class="col-sm-6">
                                    <select class="form-control js-select2" name="country_code" required="">
                                        <?php $country = get_country_list($info['country_code'],"selected",false);

                                        foreach ($country as $value){
                                            echo '<option value="'.$value['code'].'" '.$value['selected'].'>'.$value['name'].'</option>';
                                        }

                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Time Zone *</label>
                                <div class="col-sm-6">
                                    <input type="text" name="time_zone_id" value="<?php echo $info['time_zone_id']; ?>" placeholder="Enter the TimeZone (ISO)" class="form-control" required="">
                                    <p class="help-block">Please check the TimeZoneId code format here: <a href="http://download.geonames.org/export/dump/timeZones.txt" target="_blank">http://download.geonames.org/export/dump/timeZones.txt</a></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">GMT *</label>
                                <div class="col-sm-6">
                                    <input type="text" name="gmt" value="<?php echo $info['gmt']; ?>" placeholder="Enter the GMT value (ISO)" class="form-control" required="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">DST *</label>
                                <div class="col-sm-6">
                                    <input type="text" name="dst" value="<?php echo $info['dst']; ?>" placeholder="Enter the DST value (ISO)" class="form-control" required="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">RAW</label>
                                <div class="col-sm-6">
                                    <input type="text" name="raw" value="<?php echo $info['raw']; ?>" placeholder="Enter the RAW value (ISO)" class="form-control">
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
<script>
    $(function()
    {
        // Init page helpers (BS Datepicker + BS Colorpicker + Select2 + Masked Input + Tags Inputs plugins)
        App.initHelpers('select2');
    });
</script>
