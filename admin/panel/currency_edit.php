<?php
require_once('../datatable-json/includes.php');

$info = ORM::for_table($config['db']['pre'].'currencies')->find_one($_GET['id']);

$code = $info['code'];
?>
<header class="slidePanel-header overlay">
    <div class="overlay-panel overlay-background vertical-align">
        <div class="service-heading">
            <h2>Edit Currency</h2>
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
                    <form name="form2"  class="form form-horizontal" method="post" data-ajax-action="editCurrency" id="sidePanel_form">
                        <div class="form-body">
                            <input type="hidden" name="id" value="<?php echo $_GET['id']?>">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Currency Code</label>
                                <div class="col-sm-8">
                                    <input type="text" name="code" value="<?php echo $info['code']; ?>" placeholder="Enter the currency code (ISO Code)" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Name</label>
                                <div class="col-sm-8">
                                    <input type="text" name="name" value="<?php echo $info['name']; ?>" placeholder="Name" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Html Entity</label>
                                <div class="col-sm-8">
                                    <input type="text" name="html_entity" value="<?php echo $info['html_entity']; ?>" placeholder="Enter the html entity code" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Font Arial</label>
                                <div class="col-sm-8">
                                    <input type="text" name="font_arial" value="<?php echo $info['font_arial']; ?>" placeholder="Enter the font arial code" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Font Code2000</label>
                                <div class="col-sm-8">
                                    <input type="text" name="font_code2000" value="<?php echo $info['font_code2000']; ?>" placeholder="Enter the font code2000 code" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Unicode Decimal</label>
                                <div class="col-sm-8">
                                    <input type="text" name="unicode_decimal" value="<?php echo $info['unicode_decimal']; ?>" placeholder="Enter the unicode decimal code" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Unicode Hex</label>
                                <div class="col-sm-8">
                                    <input type="text" name="unicode_hex" value="<?php echo $info['unicode_hex']; ?>" placeholder="Enter the unicode hex code" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Symbol in left</label>
                                <div class="col-sm-8">
                                    <label class="css-input switch switch-sm switch-success">
                                        <input  name="in_left" type="checkbox" value="1"  <?php echo ($info['in_left'] == 1)? "checked" : ""?>/><span></span>
                                    </label>
                                </div>

                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Decimal Places</label>
                                <div class="col-sm-8">
                                    <input type="text" name="decimal_places" value="<?php echo $info['decimal_places']; ?>" placeholder="Enter the decimal places" class="form-control">
                                    <p class="help-block">Number after decimal. Ex: 2 =&gt; 150.00 [or] 3 =&gt; 150.000</p>
                                </div>
                            </div>
                            <!-- text input -->
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Decimal Separator</label>
                                <div class="col-sm-8">
                                    <input type="text" name="decimal_separator" value="<?php echo $info['decimal_separator']; ?>" placeholder="Enter the decimal separator" maxlength="1" class="form-control">
                                    <p class="help-block">Ex: "." =&gt; 100.00 [or] "," =&gt; 100,00</p>
                                </div>
                            </div>

                            <!-- text input -->
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Thousand Separator</label>
                                <div class="col-sm-8">
                                    <input type="text" name="thousand_separator" value="<?php echo $info['thousand_separator']; ?>" placeholder="Enter the thousand separator" maxlength="1" class="form-control">
                                    <p class="help-block">Ex: "," =&gt; 100,000.00 [or] whitespace =&gt; 100 000.000</p>
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

