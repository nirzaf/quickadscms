{OVERALL_HEADER}
<section id="main" class="clearfix contact-us">
    <div class="container">
        <div class="breadcrumb-section">
            <!-- breadcrumb -->
            <ol class="breadcrumb">
                <li><a href="{LINK_INDEX}"><i class="fa fa-home"></i> {LANG_HOME}</a></li>
                <li class="active">{LANG_CONTACT_US}</li>
                <div class="pull-right back-result"><a href="{LINK_LISTING}"><i class="fa fa-angle-double-left"></i>
                    {LANG_BACK_RESULT}</a></div>
            </ol>
            <!-- breadcrumb -->
            <h2 class="title">{LANG_CONTACT_US}</h2>
        </div>
        <!-- gmap -->
        <div class="map" id="map-contact" style="height: 300px; margin-bottom: 30px;"></div>
        <div class="business-info">
            <div class="row">
                <!-- Enquiry Form-->
                <div class="col-sm-8">
                    <div class="contactUs">
                        <h2>{LANG_CONTACT_US}</h2>

                        <form id="contact-form" class="contact-form" name="contact-form" method="post" action="#">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" required="required" placeholder="{LANG_YNAME}" name="name">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input type="email" class="form-control" required="required" placeholder="{LANG_YEMAIL}" name="email">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" required="required" placeholder="{LANG_SUBJECT}" name="subject">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <textarea name="message" id="message" required="required" class="form-control" rows="7" placeholder="{LANG_MESSAGE}"></textarea>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">

                                        IF("{RECAPTCHA_MODE}"=="1"){
                                        <div class="g-recaptcha" data-sitekey="{RECAPTCHA_PUBLIC_KEY}"></div>
                                        {:IF}

                                        <span style="color:red">IF("{RECAPTCH_ERROR}"!=""){ {RECAPTCH_ERROR} {:IF}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="Submit" class="btn btn-outline">{LANG_SEND_MESSAGE}</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Enquiry Form-->
                <!-- contact-detail -->
                <div class="col-sm-4">
                    <div class="contactUs-detail">
                        <h4 class="heading">{LANG_GET_TOUCH}</h4>

                        <p>{LANG_CONTACT_PAGE_TEXT}</p>
                        <hr>
                        <h4 class="heading">{LANG_CONTACT_INFORMATION}</h4>
                        <ul class="list-icons">
                            <li><i class="fa fa-map-marker"></i> <strong>{LANG_ADDRESS}:</strong> {ADDRESS}</li>
                            <li><i class="fa fa-phone"></i> <strong>{LANG_PHONE}:</strong> <a href="tel:{PHONE}">{PHONE}</a></li>
                            <li><i class="fa fa-envelope"></i> <strong>{LANG_EMAIL}:</strong> <a href="mailto:{EMAIL}">{EMAIL}</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- contact-detail -->
            </div>
            <!-- row -->
        </div>
    </div>
    <!-- container -->
</section>
<script src='https://www.google.com/recaptcha/api.js'></script>
<script>
    var _latitude = '{LATITUDE}';
    var _longitude = '{LONGITUDE}';
    var element = "map-contact";
    var path = '{SITE_URL}templates/{TPL_NAME}/';
    var getCity = false;
    var color = '{MAP_COLOR}';
    var site_url = '{SITE_URL}';
    simpleMap(_latitude, _longitude, element);
</script>
{OVERALL_FOOTER}