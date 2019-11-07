<?php
require_once('../datatable-json/includes.php');
?>
<header class="slidePanel-header overlay">
    <div class="overlay-panel overlay-background vertical-align">
        <div class="service-heading">
            <h2>Add Plan</h2>
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
                    <form name="form2"  class="form form-horizontal" method="post" data-ajax-action="addMembershipPlan" id="sidePanel_form">
                        <div class="form-body">

                            <div class="form-group">
                                <label class="col-sm-4 control-label">Plan Name</label>
                                <div class="col-sm-6">
                                    <input name="sub_title" type="Text" class="form-control" placeholder="Plan Name">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label">Choose Package</label>
                                <div class="col-sm-6">
                                    <select name="group_id" id="group_id" class="form-control">
                                        <?php
                                        $rows = ORM::for_table($config['db']['pre'].'usergroups')
                                            ->order_by_asc('group_name')
                                            ->find_many();
                                        foreach ($rows as $info2)
                                        {
                                            ?>
                                            <option value="<?php echo $info2['group_id'];?>"><?php echo stripslashes($info2['group_name']);?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label">Plan Term</label>
                                <div class="col-sm-6">
                                    <select name="sub_term" id="sub_term" class="form-control">
                                        <option value="DAILY">Daily</option>
                                        <option value="WEEKLY">Weekly</option>
                                        <option value="MONTHLY">Monthly</option>
                                        <option value="YEARLY">Yearly</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Payment Mode</label>
                                <div class="col-sm-6">
                                    <select name="pay_mode" id="pay_mode" class="form-control">
                                        <option value="one_time" selected>One Time Payment</option>
                                        <option value="recurring">Recurring Payment</option>
                                    </select>
                                    <p class="help-block">Reccuring payment option only availlable with paypal and stripe recurring payment plugin. If these plugin not installed then choose <b>One Time Payment</b>. Otherwise its create error.</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label">Plan Amount</label>
                                <div class="col-sm-6">
                                    <input name="sub_amount" type="Text" class="form-control" id="sub_amount" placeholder="Plan Amount" value="19">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label">Plan Image</label>
                                <div class="col-sm-6">
                                    <input name="sub_image" type="Text" class="form-control" id="sub_image" placeholder="Paste Image Url">
                                </div>
                            </div>

                            <div class="form-group hidden">
                                <label class="col-sm-4 control-label">Discount Badge</label>
                                <div class="col-sm-6">
                                    <input name="discount_badge" type="Text" class="form-control" id="discount_badge" placeholder="example : 25%">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Recommended</label>
                                <div class="col-sm-6">
                                    <label class="css-input css-checkbox css-checkbox-primary">
                                        <input type="checkbox" name="recommended" value="yes" checked><span></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Activate</label>
                                <div class="col-sm-6">
                                    <label class="css-input switch switch-sm switch-success">
                                        <input  name="active" type="checkbox" value="1" checked /><span></span>
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

