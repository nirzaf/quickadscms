<?php
require_once('../datatable-json/includes.php');

$success = "";
$error = "";

if(!isset($_GET['code']))
{
    exit('Error: 404 Page not found');
}
?>
<header class="slidePanel-header overlay">
    <div class="overlay-panel overlay-background vertical-align">
        <div class="service-heading">
            <h2>Region Add → <?php echo get_countryName_by_id($_GET['code']); ?></h2>
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
                    <form name="form2"  class="form form-horizontal" method="post" data-ajax-action="addState" id="sidePanel_form">
                        <div class="form-body">
                            <input type="hidden" name="code" value="<?php echo $_GET['code']?>">
                            <!-- text input -->
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
                                <label class="col-sm-4 control-label">Active</label>
                                <div class="col-sm-6">
                                    <label class="css-input switch switch-sm switch-success">
                                        <input  name="active" type="checkbox" value="1" /><span></span>
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

