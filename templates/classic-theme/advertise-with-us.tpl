{OVERALL_HEADER}

<section id="main" class="clearfix page">
    <div class="container">
        <div class="breadcrumb-section"><!-- breadcrumb -->
            <ol class="breadcrumb">
                <li><a href="{LINK_INDEX}"><i class="fa fa-home"></i> {LANG_HOME}</a></li>
                <li>{LANG_ADVERTISE_WITH_US}</li>
            </ol>
            <!-- breadcrumb -->
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="userccount">
                    <h5>{LANG_ADVERTISE_WITH_US}</h5>
                    <form method="POST" action="#" accept-charset="UTF-8" enctype="multipart/form-data">
                        <div class="formpanel">

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="formrow"> <input class="form-control" id="name" placeholder="Your Name" required="required" name="name" type="text" value="">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="formrow"> <input class="form-control" id="email" placeholder="Email" required="required" name="email" type="text" value="">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="formrow"> <input class="form-control" id="phone" placeholder="Phone" required="required" name="phone" type="text" value="">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="formrow"> <input class="form-control" id="country" placeholder="Country" required="required" autocomplete="off" name="country" type="text" value="Saudi Arabia">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="formrow"> <input class="form-control" id="state" placeholder="State" required="required" autocomplete="off" name="state" type="text" value="">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="formrow"> <input class="form-control" id="city" placeholder="City" required="required" autocomplete="off" name="city" type="text" value="">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="formrow">
                                        <h5>Choose Your Ad Slot</h5>
                                        <ul class="chooseads">
                                            <li>
                                                <input class="form-control" id="slot_id_11" name="slot_id" type="radio" value="11">
                                                <label for="slot_id_11">720 x 90</label>
                                                <span>Above Footer</span> <strong>$3 /per day</strong> </li>
                                            <li>
                                                <input class="form-control" id="slot_id_12" name="slot_id" type="radio" value="12">
                                                <label for="slot_id_12">160 x 600</label>
                                                <span>Listing Page</span> <strong>$2 /per day</strong> </li>
                                            <li>
                                                <input class="form-control" id="slot_id_13" name="slot_id" type="radio" value="13">
                                                <label for="slot_id_13">160 x 600</label>
                                                <span>Ad Detail Page</span> <strong>$3 /per day</strong> </li>
                                            <li>
                                                <input class="form-control" id="slot_id_14" name="slot_id" type="radio" value="14">
                                                <label for="slot_id_14">336 x 280</label>
                                                <span>Ad Detail Page</span> <strong>$5 /per day</strong> </li>
                                            <li>
                                                <input class="form-control" id="slot_id_15" name="slot_id" type="radio" value="15">
                                                <label for="slot_id_15">728 x 90</label>
                                                <span>CMS Page</span> <strong>$1 /per day</strong> </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="formrow">
                                        <select class="form-control" id="duration_id" name="duration_id">
                                            <option value="">Select Duration</option>
                                            <option value="3">1 week(s)</option>
                                            <option value="4">2 week(s)</option>
                                            <option value="5">3 week(s)</option>
                                            <option value="6">1 month(s)</option>
                                            <option value="7">2 month(s)</option>
                                            <option value="8">3 month(s)</option>
                                            <option value="10">4 month(s)</option>
                                            <option value="11">5 month(s)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="formrow">
                                        <div class="file-upload-previews"></div>
                                        <div class="file-upload">
                                            <input type="file" name="item_screen[]" class="file-upload-input with-preview" maxlength="1" accept="jpg|jpeg|png" id="img">
                                            <span><strong>Upload your Ad photo</strong></span>
                                        </div>
                                        <p class="help-block">Make sure it is the same size of ad slot</p>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="formrow">
                                        <textarea class="form-control" id="message_to_admin" placeholder="Message to admin" name="message_to_admin"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="formrow">
                                        <label>Select Payment Method</label>
                                        <select class="form-control" name="payment_method" id="payment_method" onchange="changePaymentMethod();">
                                            <option value=" ">Select Payment Method</option>
                                            <option value="paypal">PayPal</option>
                                            <option value="bank_transfer">Bank Transfer</option>
                                        </select>
                                    </div>
                                    <div class="bankdetail payment_method_cls" id="bank_detail_div" style="display: none;"> <h5><span style="vertical-align: inherit;"><span style="vertical-align: inherit;">Detalhes bancários</span></span></h5>
                                        <br>
                                        <p><span style="vertical-align: inherit;"><span style="vertical-align: inherit;">Lorem ipsum dolor sit amet, </span></span><br><br><span style="vertical-align: inherit;"><span style="vertical-align: inherit;">consectetur adipiscing elit.</span></span></p>
                                        <br>
                                        <p><strong><span style="vertical-align: inherit;"><span style="vertical-align: inherit;">Número de conta:</span></span></strong><span style="vertical-align: inherit;"><span style="vertical-align: inherit;"> 123456789130</span></span></p>
                                        <br>
                                        <p><strong><span style="vertical-align: inherit;"><span style="vertical-align: inherit;">Código de ramificação:</span></span></strong><span style="vertical-align: inherit;"><span style="vertical-align: inherit;"> 123456789130</span></span></p>
                                        <br>
                                        <p><strong><span style="vertical-align: inherit;"><span style="vertical-align: inherit;">Nome do Banco:</span></span></strong><span style="vertical-align: inherit;"><span style="vertical-align: inherit;"> Bank of America</span></span></p>
                                        <br>
                                        <p><strong><span style="vertical-align: inherit;"><span style="vertical-align: inherit;">Endereço do banco:</span></span></strong><span style="vertical-align: inherit;"><span style="vertical-align: inherit;"> Nova York</span></span></p> </div>
                                    <div class="formrow payment_method_cls" id="paypal_div" style="display: none;"><img src="http://sharjeelanjum.com/demos/postbuy/public/images/payments.jpg"></div>
                                </div>
                            </div>
                            <br>
                            <input type="submit" id="post_ad_btn" class="btn" value="Post An Ad">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- container -->
</section>
<script type='text/javascript' src='{SITE_URL}templates/{TPL_NAME}/js/jQuery.MultiFile.min.js'></script>
{OVERALL_FOOTER}