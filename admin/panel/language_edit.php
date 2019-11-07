<?php
require_once('../datatable-json/includes.php');

$info = get_language_by_id($_GET['id']);
?>

<header class="slidePanel-header overlay">
    <div class="overlay-panel overlay-background vertical-align">
        <div class="service-heading">
            <h2>Edit Language</h2>
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
                    <form name="form2"  class="form form-horizontal" method="post" data-ajax-action="editLanguage" id="sidePanel_form">
                        <div class="form-body">
                            <input type="hidden" name="id" value="<?php echo $_GET['id']?>">

                            <div class="form-group">
                                <label class="col-sm-4 control-label">Language name *</label>
                                <div class="col-sm-6">
                                    <input type="text" name="name" value="<?php echo $info['name']; ?>" placeholder="Language name" class="form-control" required="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Code (ISO 639-1)*</label>
                                <div class="col-sm-6">
                                    <input type="text" name="code" value="<?php echo $info['code']; ?>" placeholder="Code (ISO 639-1)" class="form-control" required="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label">Direction *</label>
                                <div class="col-sm-6">
                                    <select name="direction" class="form-control">
                                        <option value="ltr" <?php echo ($info['direction'] == "ltr")? "selected" : ""?>>ltr</option>
                                        <option value="rtl" <?php echo ($info['direction'] == "rtl")? "selected" : ""?>>rtl</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Activated</label>
                                <div class="col-sm-6">
                                    <label class="css-input switch switch-sm switch-success">
                                        <input  name="active" type="checkbox" value="1" <?php if($info['active'] == '1') echo "checked"; ?> /><span></span>
                                    </label>
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

