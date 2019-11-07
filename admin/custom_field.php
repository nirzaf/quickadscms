<?php
require_once('includes.php');
?>
<link href="js/plugins/ladda/ladda.min.css" rel="stylesheet" />
<link href="js/plugins/jqueryui/jquery-ui.min.css" rel="stylesheet">

<!-- /.Language Translation modal -->
<div id="modal_LangTranslation" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Edit Language Translation</h4>
                </div>
                <div class="modal-body">
                    <div class="loader" style="text-align: center;">
                        <img src="../loading.gif"/>
                    </div>
                    <div class="form-horizontal" id="displayData">

                        <!--Dynamic form fields-->

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="saveEditLanguage">Save</button>
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.Language Translation modal -->
<!-- /.modal -->
<div id="Options_LangTranslation" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Edit Language Translation</h4>
                </div>
                <div class="modal-body">
                    <div class="loader" style="text-align: center;">
                        <img src="../loading.gif"/>
                    </div>
                    <div class="form-horizontal" id="displayData">

                        <!--Dynamic form fields-->

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="saveEditLanguage">Save</button>
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.modal -->
<!-- Page Content -->
<main class="app-layout-content">

    <!-- Page Content -->
    <div class="container-fluid p-y-md">
        <!-- Partial Table -->
        <div class="card">
            <div class="card-header">
                <h4>Custom Fields</h4>
            </div>
            <div class="card-block">
                <!-- /row -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <div>

                                <div id="quickad-tbs" class="wrap">
                                    <div class="quickad-tbs-body">
                                        <div class="panel panel-default quickad-main">
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">

                                                            <label for="quickad_custom_fields_per_service">Bind fields to categories</label>
                                                            <p class="help-block">When this setting is enabled you will be able to create category specific custom fields.</p>
                                                            <select class="form-control" name="quickad_custom_fields_per_service" id="quickad_custom_fields_per_service">
                                                                <option value="0">Disabled</option>
                                                                <option value="1" selected="selected">Enabled</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <hr>

                                                <ul id="quickad-custom-fields" class="ui-sortable" style="position: relative">

                                                </ul>

                                                <div id="quickad-js-add-fields">
                                                    <button class="btn btn-default quickad-margin-bottom-sm quickad-margin-right-sm" data-type="text-field"><i class="glyphicon glyphicon-plus"></i> Text Field</button>
                                                    <button class="btn btn-default quickad-margin-bottom-sm quickad-margin-right-sm" data-type="textarea"><i class="glyphicon glyphicon-plus"></i> Text Area</button>
                                                    <button class="btn btn-default quickad-margin-bottom-sm quickad-margin-right-sm" data-type="checkboxes"><i class="glyphicon glyphicon-plus"></i> Checkbox Group</button>
                                                    <button class="btn btn-default quickad-margin-bottom-sm quickad-margin-right-sm" data-type="radio-buttons"><i class="glyphicon glyphicon-plus"></i> Radio Button Group</button>
                                                    <button class="btn btn-default quickad-margin-bottom-sm quickad-margin-right-sm" data-type="drop-down"><i class="glyphicon glyphicon-plus"></i> Drop Down</button>
                                                </div>
                                                <p class="help-block">HTML allowed in textarea.</p>

                                                <ul id="quickad-templates" style="display:none">

                                                    <li data-type="text-field">
                                                        <div class="quickad-flexbox">
                                                            <div class="quickad-flex-cell">
                                                                <i title="Reorder" class="quickad-js-handle quickad-icon quickad-icon-draghandle quickad-margin-right-sm quickad-cursor-move"></i>
                                                            </div>
                                                            <div class="quickad-flex-cell" style="width: 100%">
                                                                <p><b>Text Field</b><a class="quickad-js-delete glyphicon glyphicon-trash text-danger quickad-margin-left-sm" href="#" title="Remove field"></a></p>
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <div class="input-group">
                                                                            <input class="quickad-label form-control" type="text" value="" placeholder="Enter a label">
                                                                            <label class="input-group-addon">
                                                                                <label class="css-input css-checkbox css-checkbox-default m-t-0 m-b-0">
                                                                                    <input type="checkbox" id="TextFieldReq" class="quickad-required"><span></span> Required field
                                                                                </label>
                                                                                <i class="visible-xs-inline-block glyphicon glyphicon-warning"></i>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <?php include('custom-field-category-dropdown.php') ?>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                    </li>

                                                    <li data-type="textarea">
                                                        <div class="quickad-flexbox">
                                                            <div class="quickad-flex-cell">
                                                                <i title="Reorder" class="quickad-js-handle quickad-icon quickad-icon-draghandle quickad-margin-right-sm quickad-cursor-move"></i>
                                                            </div>
                                                            <div class="quickad-flex-cell" style="width: 100%">
                                                                <p><b>Text Area</b><a class="quickad-js-delete glyphicon glyphicon-trash text-danger quickad-margin-left-sm" href="#" title="Remove field"></a></p>
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <div class="input-group">
                                                                            <input class="quickad-label form-control" type="text" value="" placeholder="Enter a label">
                                                                            <label class="input-group-addon">
                                                                                <label class="css-input css-checkbox css-checkbox-default m-t-0 m-b-0">
                                                                                    <input type="checkbox" id="TextAreaReq" class="quickad-required"><span></span> Required field
                                                                                </label>
                                                                                <i class="visible-xs-inline-block glyphicon glyphicon-warning"></i>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <?php include('custom-field-category-dropdown.php') ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                    </li>

                                                    <li data-type="checkboxes">
                                                        <div class="quickad-flexbox">
                                                            <div class="quickad-flex-cell">
                                                                <i title="Reorder" class="quickad-js-handle quickad-icon quickad-icon-draghandle quickad-margin-right-sm quickad-cursor-move"></i>
                                                            </div>
                                                            <div class="quickad-flex-cell" style="width: 100%">
                                                                <p><b>Checkbox Group</b><a class="quickad-js-delete glyphicon glyphicon-trash text-danger quickad-margin-left-sm" href="#" title="Remove field"></a></p>
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <div class="input-group">
                                                                            <input class="quickad-label form-control" type="text" value="" placeholder="Enter a label">
                                                                            <label class="input-group-addon">
                                                                                <label class="css-input css-checkbox css-checkbox-default m-t-0 m-b-0">
                                                                                    <input type="checkbox" id="CheckboxReq" class="quickad-required"><span></span> Required field
                                                                                </label>
                                                                                <i class="visible-xs-inline-block glyphicon glyphicon-warning"></i>
                                                                            </label>
                                                                        </div>

                                                                        <ul class="quickad-items quickad-margin-top-sm"></ul>
                                                                        <button class="btn btn-sm btn-default" data-type="checkboxes-item">
                                                                            <i class="glyphicon glyphicon-plus"></i> Checkbox </button>
                                                                    </div>
                                                                    <?php include('custom-field-category-dropdown.php') ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                    </li>

                                                    <li data-type="radio-buttons">
                                                        <div class="quickad-flexbox">
                                                            <div class="quickad-flex-cell">
                                                                <i title="Reorder" class="quickad-js-handle quickad-icon quickad-icon-draghandle quickad-margin-right-sm quickad-cursor-move"></i>
                                                            </div>
                                                            <div class="quickad-flex-cell" style="width: 100%">
                                                                <p><b>Radio Button Group</b><a class="quickad-js-delete glyphicon glyphicon-trash text-danger quickad-margin-left-sm" href="#" title="Remove field"></a></p>
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <div class="input-group">
                                                                            <input class="quickad-label form-control" type="text" value="" placeholder="Enter a label">
                                                                            <label class="input-group-addon">
                                                                                <label class="css-input css-checkbox css-checkbox-default m-t-0 m-b-0">
                                                                                    <input type="checkbox" id="RadioReq" class="quickad-required"><span></span> Required field
                                                                                </label>
                                                                                <i class="visible-xs-inline-block glyphicon glyphicon-warning"></i>
                                                                            </label>
                                                                        </div>

                                                                        <ul class="quickad-items quickad-margin-top-sm"></ul>
                                                                        <button class="btn btn-sm btn-default" data-type="radio-buttons-item">
                                                                            <i class="glyphicon glyphicon-plus"></i> Radio Button                                        </button>
                                                                    </div>
                                                                    <?php include('custom-field-category-dropdown.php') ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                    </li>

                                                    <li data-type="drop-down">
                                                        <div class="quickad-flexbox">
                                                            <div class="quickad-flex-cell">
                                                                <i title="Reorder" class="quickad-js-handle quickad-icon quickad-icon-draghandle quickad-margin-right-sm quickad-cursor-move"></i>
                                                            </div>
                                                            <div class="quickad-flex-cell" style="width: 100%">
                                                                <p><b>Drop Down</b><a class="quickad-js-delete glyphicon glyphicon-trash text-danger quickad-margin-left-sm" href="#" title="Remove field"></a></p>
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <div class="input-group">
                                                                            <input class="quickad-label form-control" type="text" value="" placeholder="Enter a label">
                                                                            <label class="input-group-addon">
                                                                                <label class="css-input css-checkbox css-checkbox-default m-t-0 m-b-0">
                                                                                    <input type="checkbox" id="DropDownReq" class="quickad-required"><span></span> Required field
                                                                                </label>
                                                                                <i class="visible-xs-inline-block glyphicon glyphicon-warning"></i>
                                                                            </label>
                                                                        </div>

                                                                        <ul class="quickad-items quickad-margin-top-sm"></ul>
                                                                        <button class="btn btn-sm btn-default" data-type="drop-down-item">
                                                                            <i class="glyphicon glyphicon-plus"></i> Option                                        </button>
                                                                    </div>
                                                                    <?php include('custom-field-category-dropdown.php') ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                    </li>

                                                    <li data-type="checkboxes-item">
                                                        <div class="quickad-flexbox">
                                                            <div class="quickad-flex-cell quickad-vertical-middle">
                                                                <i title="Reorder" class="quickad-js-handle quickad-icon quickad-icon-draghandle quickad-margin-right-sm quickad-cursor-move"></i>
                                                            </div>
                                                            <div class="quickad-flex-cell quickad-vertical-middle" style="width: 100%">
                                                                <input class="form-control" type="text" value="" placeholder="Enter a label">
                                                            </div>
                                                            <div class="quickad-flex-cell quickad-vertical-middle">
                                                                <?php
                                                                if(get_option("userlangsel") == '1'){
                                                                ?>
                                                                <a class="quickad_itmes_translation fa fa-language text-warning quickad-margin-left-sm" href="#" title="Language Translation item"></a>
                                                                <?php } ?>
                                                            </div>
                                                            <div class="quickad-flex-cell quickad-vertical-middle">
                                                                <a class="quickad-option-delete glyphicon glyphicon-trash text-danger quickad-margin-left-sm" href="#" title="Remove item"></a>
                                                            </div>
                                                        </div>
                                                    </li>

                                                    <li data-type="radio-buttons-item">
                                                        <div class="quickad-flexbox">
                                                            <div class="quickad-flex-cell quickad-vertical-middle">
                                                                <i title="Reorder" class="quickad-js-handle quickad-icon quickad-icon-draghandle quickad-margin-right-sm quickad-cursor-move"></i>
                                                            </div>
                                                            <div class="quickad-flex-cell quickad-vertical-middle" style="width: 100%">
                                                                <input class="form-control" type="text" value="" placeholder="Enter a label">
                                                            </div>
                                                            <div class="quickad-flex-cell quickad-vertical-middle">
                                                                <?php
                                                                if(get_option("userlangsel") == '1'){
                                                                    ?>
                                                                <a class="quickad_itmes_translation fa fa-language text-warning quickad-margin-left-sm" href="#" title="Language Translation item"></a>
                                                                <?php } ?>
                                                            </div>
                                                            <div class="quickad-flex-cell quickad-vertical-middle">
                                                                <a class="quickad-option-delete glyphicon glyphicon-trash text-danger quickad-margin-left-sm" href="#" title="Remove item"></a>
                                                            </div>
                                                        </div>
                                                    </li>

                                                    <li data-type="drop-down-item">
                                                        <div class="quickad-flexbox">
                                                            <div class="quickad-flex-cell quickad-vertical-middle">
                                                                <i title="Reorder" class="quickad-js-handle quickad-icon quickad-icon-draghandle quickad-margin-right-sm quickad-cursor-move"></i>
                                                            </div>
                                                            <div class="quickad-flex-cell quickad-vertical-middle" style="width: 100%">
                                                                <input class="form-control" type="text" value="" placeholder="Enter a label">
                                                            </div>
                                                            <div class="quickad-flex-cell quickad-vertical-middle">
                                                                <?php
                                                                if(get_option("userlangsel") == '1'){
                                                                ?>
                                                                <a class="quickad_itmes_translation fa fa-language text-warning quickad-margin-left-sm" href="#" title="Language Translation item"></a>
                                                                <?php } ?>
                                                            </div>
                                                            <div class="quickad-flex-cell quickad-vertical-middle">
                                                                <a class="quickad-option-delete glyphicon glyphicon-trash text-danger quickad-margin-left-sm" href="#" title="Remove item"></a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>

                                            <div class="panel-footer">
                                                <button id="ajax-send-custom-fields" type="submit" class="btn btn-lg btn-success ladda-button" data-style="zoom-in" data-spinner-size="40"><span class="ladda-label">Save</span><span class="ladda-spinner"></span><div class="ladda-progress" style="width: 0px;"></div></button>
                                                <button class="btn btn-lg btn-default" type="reset">Reset</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="quickad-alert" class="quickad-alert"></div>
                                </div>

                            </div>
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

<?php

$results = ORM::for_table($config['db']['pre'].'custom_fields')
    ->order_by_asc('custom_order')
    ->find_many();
$number = count($results);

$data = array();
$i = 0;
if(count($results) != 0){
    foreach($results as $result){
        $id = $result['custom_id'];
        $title = stripslashes($result['custom_title']);
        $type = $result['custom_type'];
        $options = $result['custom_options'];
        $category = $result['custom_subcatid'];

        $required = $result['custom_required'];
        $required = ($required === "0")? false : true ;

        if($type == "text"){
            $type = 'text-field';
        }
        elseif($type == "textarea"){
            $type = 'textarea';
        }
        elseif($type == "radio"){
            $type = 'radio-buttons';
        }
        elseif($type == "checkbox"){
            $type = 'checkboxes';
        }
        elseif($type == "select"){
            $type = 'drop-down';
        }

        $opt = array();
        if($options != ""){
            $options = explode(',',stripslashes($options));
            $j = 0;

            foreach($options as $opt_id){
                $info = ORM::for_table($config['db']['pre'].'custom_options')
                    ->where('option_id', $opt_id)
                    ->find_one();

                $option_id = $info['option_id'];
                $option_title = stripslashes($info['title']);

                $opt[$j]['id'] = $option_id;
                $opt[$j]['title']   = $option_title;

                $j++;
            }
        }

        $data[$i]['items'] = $opt;
        $data[$i]['type']   = $type;
        $data[$i]['label']  = $title;
        $data[$i]['required'] = $required;
        $data[$i]['id']     = $id;
        $data[$i]['services']     = $category;

        $i++;
    }
}
$fields = json_encode($data);

?>


<script type='text/javascript'>
    var quickadL10n = {
        "csrf_token":"12232412",
        "custom_fields":"<?php echo addslashes($fields); ?>",
        "selector":{
            "all_selected":"All Category",
            "nothing_selected":"No category selected"
        },
        "saved":"Custom fields saved"
    };
</script>
<?php include("footer.php"); ?>
<script src="js/plugins/jqueryui/jquery-ui.min.js"></script>
<script src="js/custom-manage/custom_fields.js"></script>
<script src="js/custom-manage/spin.min.js"></script>
<script src="js/plugins/ladda/ladda.min.js"></script>
<script src="js/custom-manage/alert.js"></script>
</body></html>