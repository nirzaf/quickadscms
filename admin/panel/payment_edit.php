<?php
require_once('../datatable-json/includes.php');

$info = ORM::for_table($config['db']['pre'].'payments')
    ->where('payment_id',$_GET['id'])
    ->find_one();
$status = $info['payment_install'];
$folder = $info['payment_folder'];
?>

<header class="slidePanel-header overlay">
    <div class="overlay-panel overlay-background vertical-align">
        <div class="service-heading">
            <h2><?php echo ucfirst($folder);?> - Settings</h2>
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
                    <form name="form2"  class="form form-horizontal" method="post" data-ajax-action="paymentEdit" id="sidePanel_form">
                        <div class="form-body">
                            <input type="hidden" name="id" value="<?php echo $_GET['id']?>">

                            <div class="form-group">
                                <label class="col-sm-4 control-label">Title:</label>
                                <div class="col-sm-6">
                                    <input name="title" type="text" class="form-control" value="<?php echo $info['payment_title']?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label">Turn On/Off</label>
                                <div class="col-sm-6">
                                    <select name="install" id="install" class="form-control">
                                        <option value="1" <?php if($status == '1') echo "selected"; ?>>Enable</option>
                                        <option value="0" <?php if($status == '0') echo "selected"; ?>>Disable</option>
                                    </select>
                                </div>
                            </div>

                            <?php
                            if($folder == "paypal"){
                                ?>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Sandbox Mode On/Off </label>
                                    <div class="col-sm-6">
                                        <select name="paypal_sandbox_mode"  class="form-control">
                                            <option value="Yes" <?php if(get_option('paypal_sandbox_mode') == 'Yes') echo "selected"; ?>>Yes</option>
                                            <option value="No" <?php if(get_option('paypal_sandbox_mode') == 'No') echo "selected"; ?>>No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Paypal API Username:</label>
                                    <div class="col-sm-6">
                                        <input name="paypal_api_username" type="text" class="form-control" placeholder="Enter your Paypal API Username" value="<?php echo get_option('paypal_api_username')?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Paypal API Password:</label>
                                    <div class="col-sm-6">
                                        <input name="paypal_api_password" type="text" class="form-control" placeholder="Enter your Paypal API Password" value="<?php echo get_option('paypal_api_password')?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Paypal API Secret:</label>
                                    <div class="col-sm-6">
                                        <input name="paypal_api_signature" type="text" class="form-control" placeholder="Enter your Paypal API Secret" value="<?php echo get_option('paypal_api_signature')?>">
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                            <?php
                            if($folder == "stripe"){
                                ?>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Stripe Publishable Key:</label>
                                    <div class="col-sm-6">
                                        <input name="stripe_publishable_key" type="text" class="form-control" placeholder="Enter your Stripe Publishable Key" value="<?php echo get_option('stripe_publishable_key')?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Stripe Secret Key:</label>
                                    <div class="col-sm-6">
                                        <input name="stripe_secret_key" type="text" class="form-control" placeholder="Enter your Stripe Secret Key" value="<?php echo get_option('stripe_secret_key')?>">
                                    </div>
                                </div>
                            <?php
                            }
                            ?>

                            <?php
                            if($folder == "paytm"){
                                ?>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Paytm ENVIRONMENT:</label>
                                    <div class="col-sm-6">
                                        <input name="PAYTM_ENVIRONMENT" type="text" class="form-control" placeholder="Environment for TEST or PRODUCTION mode" value="<?php echo get_option('PAYTM_ENVIRONMENT')?>">
                                        <code class="help-block">Use PAYTM_ENVIRONMENT as 'PROD' if you wanted to do transaction in production environment else 'TEST' for doing transaction in testing environment.</code>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Paytm Merchant key:</label>
                                    <div class="col-sm-6">
                                        <input name="PAYTM_MERCHANT_KEY" type="text" class="form-control" placeholder="Enter your Merchant key" value="<?php echo get_option('PAYTM_MERCHANT_KEY')?>">
                                        <code class="help-block">Change this constant's value with Merchant key downloaded from portal</code>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Paytm Merchant ID:</label>
                                    <div class="col-sm-6">
                                        <input name="PAYTM_MERCHANT_MID" type="text" class="form-control" placeholder="Enter your MID (Merchant ID)" value="<?php echo get_option('PAYTM_MERCHANT_MID')?>">
                                        <code class="help-block">Change this constant's value with MID (Merchant ID) received from Paytm</code>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Paytm Website name:</label>
                                    <div class="col-sm-6">
                                        <input name="PAYTM_MERCHANT_WEBSITE" type="text" class="form-control" placeholder="Enter your Website name" value="<?php echo get_option('PAYTM_MERCHANT_WEBSITE')?>">
                                        <code class="help-block">Change this constant's value with Website name received from Paytm</code>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>

                            <?php
                            if($folder == "paystack"){
                                ?>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Paystack Secret Key:</label>
                                    <div class="col-sm-6">
                                        <input name="paystack_secret_key" type="password" class="form-control" placeholder="Enter your Paystack Secret Key" value="<?php echo get_option('paystack_secret_key')?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Paystack Public Key:</label>
                                    <div class="col-sm-6">
                                        <input name="paystack_public_key" type="text" class="form-control" placeholder="Enter your Paystack Public Key" value="<?php echo get_option('paystack_public_key')?>">
                                    </div>
                                </div>
                            <?php
                            }
                            ?>

                            <?php
                            if($folder == "2checkout"){
                                ?>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">2Checkout Account Number:</label>
                                    <div class="col-sm-6">
                                        <input name="checkout_account_number" type="text" class="form-control" placeholder="Enter your 2Checkout Account Number" value="<?php echo get_option('checkout_account_number')?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Publishable Key:</label>
                                    <div class="col-sm-6">
                                        <input name="checkout_public_key" type="text" class="form-control" placeholder="Enter your 2Checkout Publishable Key." value="<?php echo get_option('checkout_public_key')?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Private API Key:</label>
                                    <div class="col-sm-6">
                                        <input name="checkout_private_key" type="password" class="form-control" placeholder="Enter your 2Checkout Private Key" value="<?php echo get_option('checkout_private_key')?>">
                                    </div>
                                </div>
                            <?php
                            }
                            ?>

                            <?php
                            if($folder == "moneybookers"){
                                ?>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Skrill Merchant Id:</label>
                                    <div class="col-sm-6">
                                        <input name="skrill_merchant_id" type="text" class="form-control" placeholder="Enter your skrill(moneybookers) merchant id" value="<?php echo get_option('skrill_merchant_id')?>">
                                    </div>
                                </div>
                            <?php
                            }
                            ?>

                            <?php
                            if($folder == "nochex"){
                                ?>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">NoChex Merchant Id:</label>
                                    <div class="col-sm-6">
                                        <input name="nochex_merchant_id" type="text" class="form-control" placeholder="Enter your NoChex Merchant Id" value="<?php echo get_option('nochex_merchant_id')?>">
                                    </div>
                                </div>
                            <?php
                            }
                            ?>

                            <?php
                            if($folder == "wire_transfer"){
                                ?>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Bank Information :</label>
                                    <div class="col-sm-6">
                                        <textarea name="company_bank_info" rows="6" type="text" placeholder="Write Information about Bank transfer" class="form-control"><?php echo get_option('company_bank_info')?></textarea>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                            <?php
                            if($folder == "cheque"){
                                ?>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Cheque Information:</label>
                                    <div class="col-sm-6">
                                        <textarea name="company_cheque_info" rows="6" type="text" placeholder="Write Cheque Information" class="form-control"><?php echo get_option('company_cheque_info')?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Cheque Payable To:</label>
                                    <div class="col-sm-6">
                                        <input name="cheque_payable_to" type="text" class="form-control" placeholder="Payable To" value="<?php echo get_option('cheque_payable_to')?>">
                                    </div>
                                </div>
                            <?php
                            }
                            ?>

                        </div>

                    </form>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
</div>

