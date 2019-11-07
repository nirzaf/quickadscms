<?php
require_once('../datatable-json/includes.php');

$success = "";
$error = "";
if(!isset($_GET['code']))
{
    exit('Error: 404 Page not found');
}
else{
    $country = "";
    $subadmin1 = "";
    $subadmin2 = "";
    $statecode = "";
    $districtcode = "";
    $code = $_GET['code'];
    $pieces = explode(".", $code);
    $code_count = count($pieces);
    if($code_count == 1){
        $country = $pieces[0];
        $in_name = get_countryName_by_id($country);
    }
    elseif($code_count == 2){
        $country = $pieces[0];
        $subadmin1 = $pieces[1];
        $statecode =  $country.".".$subadmin1;
        $in_name = get_stateName_by_id($_GET['code']). ", ". get_countryName_by_id($country);
    }
    elseif($code_count == 3){
        $country = $pieces[0];
        $subadmin1 = $pieces[1];
        $subadmin2 = $pieces[2];
        $districtcode = $country.".".$subadmin1.".".$subadmin2;

        $statecode =  $country.".".$subadmin1;
        $in_name = get_district_by_code($_GET['code']).", ".get_stateName_by_id($statecode). ", ".  get_countryName_by_id($country);
    }
}
?>
<header class="slidePanel-header overlay">
    <div class="overlay-panel overlay-background vertical-align">
        <div class="service-heading">
            <h2>City Add in → <?php echo $in_name ?></h2>
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
                    <form name="form2"  class="form form-horizontal" method="post" data-ajax-action="addCity" id="sidePanel_form">
                        <div class="form-body">
                            <input type="hidden" name="country_code" value="<?php echo $country; ?>" class="form-control">

                            <?php
                            if($statecode == ""){
                                ?>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Region (Admin1 Code)</label>
                                    <div class="col-sm-6">
                                        <select name="subadmin1_code" id="statetoDistrict" data-ajax-action="getDistrictSelectedforCityAdd" class="form-control js-select2" data-placeholder="Select Region.." data-country="<?php echo $country; ?>">
                                            <option value="">Select Region...</option>
                                        </select>
                                    </div>
                                </div>
                            <?php
                            }else{
                                ?>
                                <input type="hidden" name="subadmin1_code" value="<?php echo $statecode; ?>" class="form-control">
                            <?php
                            }
                            ?>

                            <?php
                            if($districtcode == ""){
                                ?>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">District (Admin2 Code)</label>
                                    <div class="col-sm-6">
                                        <select name="subadmin2_code" id="district" class="form-control">
                                            <option value="">Select District...</option>
                                        </select>
                                    </div>
                                </div>
                            <?php
                            }else{
                                ?>
                                <input type="hidden" name="subadmin2_code" value="<?php echo $districtcode; ?>" class="form-control">
                            <?php
                            }
                            ?>


                            <div class="form-group">
                                <label class="col-sm-4 control-label">Local Name</label>
                                <div class="col-sm-6">
                                    <input type="text" name="name" value="" placeholder="Local Name" class="form-control" required>
                                </div>
                            </div>
                            <!-- text input -->
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Name</label>
                                <div class="col-sm-6">
                                    <input type="text" name="asciiname" value="" placeholder="Enter the name (In English)" class="form-control" required>
                                </div>
                            </div>

                            <!-- text input -->
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Latitude</label>
                                <div class="col-sm-6">
                                    <input type="text" name="latitude" value="" placeholder="Latitude" class="form-control">
                                    <p class="help-block">In decimal degrees (wgs84)</p>
                                </div>
                            </div>
                            <!-- text input -->
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Longitude</label>
                                <div class="col-sm-6">
                                    <input type="text" name="longitude" value="" placeholder="Longitude" class="form-control">
                                    <p class="help-block">In decimal degrees (wgs84)</p>
                                </div>
                            </div>
                            <!-- text input -->
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Population</label>
                                <div class="col-sm-6">
                                    <input type="text" name="population" value="" placeholder="Population" class="form-control">
                                </div>
                            </div>
                            <!-- text input -->
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Time Zone ID</label>
                                <div class="col-sm-6">
                                    <input type="text" name="time_zone" value="" placeholder="Enter the time zone ID (example: Europe/Paris)" class="form-control">
                                    <p class="help-block">Please check the TimeZoneId code format here: <a href="http://download.geonames.org/export/dump/timeZones.txt" target="_blank">http://download.geonames.org/export/dump/timeZones.txt</a></p>
                                </div>
                            </div>
                            <!-- text input -->
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Active</label>
                                <div class="col-sm-6">
                                    <label class="css-input switch switch-sm switch-success">
                                        <input name="active" type="checkbox" value="1" /><span></span>
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

<script>

    $("#statetoDistrict").change(function () {
        var id = $(this).val();
        var action = $(this).data('ajax-action');
        var data = {action: action, id: id};
        $.ajax({
            type: "POST",
            url: ajaxurl,
            data: data,
            success: function (result) {
                $("#district").html(result);
                $("#district").select2();
            }
        });
    });
    jQuery(function ($) {
        var country = '<?php echo $country; ?>';
        var state = '<?php echo $statecode; ?>';
        var districtcode = '<?php echo $districtcode; ?>';
        if(state == ""){
            getStateSelected(country,"getStateByCountryIDforCityAdd",state);
            $("#statetoDistrict").select2();
        }

        if(districtcode == "" && state != ""){
            getDistrictSelected(state,"getDistrictSelectedforCityAdd",districtcode);
            $("#district").select2();
        }

    });

<!-- Page JS Code -->

    $(function()
    {
        // Init page helpers (BS Datepicker + BS Colorpicker + Select2 + Masked Input + Tags Inputs plugins)
        App.initHelpers('select2');
    });
</script>