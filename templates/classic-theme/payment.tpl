{OVERALL_HEADER}
<!-- Payment-Method-page -->
<section id="main" class="clearfix  ad-profile-page">
    <div class="container">
        <div class="breadcrumb-section">
            <!-- breadcrumb -->
            <ol class="breadcrumb">
                <li><a href="{LINK_INDEX}"><i class="fa fa-home"></i> {LANG_HOME}</a></li>
                <li class="active">{LANG_PAYMENT_METHOD}</li>
                <div class="pull-right back-result"><a href="{LINK_LISTING}"><i class="fa fa-angle-double-left"></i>
                        {LANG_BACK_RESULT}</a></div>
            </ol>
            <!-- breadcrumb -->
        </div>
        <!-- Main Content -->
        <div class="row">
            <!-- Page-Content -->
            <div class="col-lg-8 col-md-8 page-content">
                <div class="">

                    <h2 class="margin-top-55 margin-bottom-30">{LANG_PAYMENT_METHOD}</h2>

                    <!-- Payment Methods Accordion -->
                    <form id="subscribeForm" method="POST" novalidate="novalidate">
                        <div class="payment">
                            {LOOP: PAYMENT_TYPES}
                                <!-- Paypal Payment Method Check -->
                                IF("{PAYMENT_TYPES.folder}"=="paypal"){
                                <div class="payment-tab payment-tab-active">
                                    <div class="payment-tab-trigger">
                                        <input name="payment_method_id" checked class="payment_method_id" id="{PAYMENT_TYPES.folder}" type="radio" value="{PAYMENT_TYPES.id}" data-name="paypal">
                                        <label for="{PAYMENT_TYPES.folder}">{PAYMENT_TYPES.title}</label>
                                        <img class="payment-logo {PAYMENT_TYPES.folder}" src="{SITE_URL}storage/payments/{PAYMENT_TYPES.folder}/logo.png" alt="">
                                    </div>

                                    <div class="payment-tab-content">
                                        <p>{LANG_REDIRECT_PAYPAL}</p>
                                    </div>
                                </div>

                            {:IF}

                                <!-- Paypal Payment Method Check -->
                                IF("{PAYMENT_TYPES.folder}"=="paystack"){
                                <div class="payment-tab">
                                    <div class="payment-tab-trigger">
                                        <input name="payment_method_id" class="payment_method_id" id="{PAYMENT_TYPES.folder}" type="radio" value="{PAYMENT_TYPES.id}" data-name="paystack">
                                        <label for="{PAYMENT_TYPES.folder}">{PAYMENT_TYPES.title}</label>
                                        <img class="payment-logo {PAYMENT_TYPES.folder}" src="{SITE_URL}storage/payments/{PAYMENT_TYPES.folder}/logo.png" alt="">
                                    </div>

                                    <div class="payment-tab-content">
                                        <p>{LANG_REDIRECT_PAYSTACK}</p>
                                    </div>
                                </div>

                            {:IF}

                                <!-- Stripe Payment Method Check -->
                                IF("{PAYMENT_TYPES.folder}"=="stripe"){

                                <div class="payment-tab">

                                    <div class="payment-tab-trigger">
                                        <input name="payment_method_id" class="payment_method_id" id="creditCart" type="radio" value="{PAYMENT_TYPES.id}"  data-name="stripe">
                                        <label for="creditCart">{LANG_CREDIT_DEBIT_CARD}</label>
                                        <img class="payment-logo" src="{SITE_URL}storage/payments/{PAYMENT_TYPES.folder}/logo.png" alt="">
                                    </div>
                                    <div class="payment-tab-content">

                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="card-label form-group">
                                                    <label for="stripeCardNumber">{LANG_CARD_NUMBER}</label>
                                                    <input type="text" class="form-control" name="stripeCardNumber" placeholder="{LANG_VAILD_CARD_NUMBER}" autocomplete="cc-number" required autofocus/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-7 col-md-7">
                                                <div class="card-label form-group">
                                                    <label for="stripeCardExpiry"><span class="hidden-xs">{LANG_EXPIRATION}</span><span class="visible-xs-inline">{LANG_EXP}</span> {LANG_DATE_CAP}</label>
                                                    <input type="tel" class="form-control" name="stripeCardExpiry" placeholder="MM / YY" autocomplete="cc-exp" required/>
                                                </div>
                                            </div>
                                            <div class="col-xs-5 col-md-5 pull-right">
                                                <div class="card-label form-group">
                                                    <label for="stripeCardCVC">{LANG_CV_CODE}</label>
                                                    <input type="tel" class="form-control" name="stripeCardCVC" placeholder="CVC" autocomplete="cc-csc" required/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            {:IF}

                                <!-- 2checkout Payment Method Check -->
                                IF("{PAYMENT_TYPES.folder}"=="2checkout"){
                                <div class="payment-tab">
                                    <div class="payment-tab-trigger">
                                        <input name="payment_method_id" class="payment_method_id" id="{PAYMENT_TYPES.folder}" type="radio" value="{PAYMENT_TYPES.id}" data-name="2checkout">
                                        <label for="{PAYMENT_TYPES.folder}">{PAYMENT_TYPES.title}</label>
                                        <img class="payment-logo {PAYMENT_TYPES.folder}" src="{SITE_URL}storage/payments/{PAYMENT_TYPES.folder}/logo.png" alt="">
                                    </div>
                                    <div class="payment-tab-content">
                                        <!-- CREDIT CARD FORM STARTS HERE -->
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="card-label form-group">
                                                    <label for="checkoutCardNumber">{LANG_CARD_NUMBER}</label>
                                                    <input type="text" class="form-control" name="checkoutCardNumber" placeholder="{LANG_VAILD_CARD_NUMBER}" autocomplete="cc-number" required autofocus/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-7 col-md-7">
                                                <div class="card-label form-group">
                                                    <label for="checkoutCardExpiry"><span class="hidden-xs">{LANG_EXPIRATION}</span><span class="visible-xs-inline">{LANG_EXP}</span> {LANG_DATE_CAP}</label>
                                                    <input type="tel" class="form-control" name="checkoutCardExpiry" placeholder="MM / YYYY" autocomplete="cc-exp" required="" aria-required="true" aria-invalid="false">
                                                </div>
                                            </div>
                                            <div class="col-xs-5 col-md-5 pull-right">
                                                <div class="card-label form-group">
                                                    <label for="checkoutCardCVC">{LANG_CV_CODE}</label>
                                                    <input type="tel" class="form-control" name="checkoutCardCVC" placeholder="CVC" autocomplete="cc-csc" required/>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- name -->
                                        <div class="row">
                                            <div class="col-xs-7 col-md-7">
                                                <div class="card-label form-group">
                                                    <label for="checkoutCardFirstName">{LANG_FIRST_NAME}</label>
                                                    <input
                                                            type="tel"
                                                            class="form-control"
                                                            name="checkoutCardFirstName"
                                                            placeholder="{LANG_FIRST_NAME}"
                                                            required
                                                            />
                                                </div>
                                            </div>
                                            <div class="col-xs-5 col-md-5 pull-right">
                                                <div class="card-label form-group">
                                                    <label for="checkoutCardLastName">{LANG_LAST_NAME}</label>
                                                    <input
                                                            type="text"
                                                            class="form-control"
                                                            name="checkoutCardLastName"
                                                            placeholder="{LANG_LAST_NAME}"
                                                            required
                                                            />
                                                </div>
                                            </div>
                                        </div>

                                        <!-- city -->
                                        <div class="row">
                                            <div class="col-xs-7 col-md-7">
                                                <div class="card-label form-group">
                                                    <label for="checkoutBillingAddress">{LANG_ADDRESS}</label>
                                                    <input
                                                            type="text"
                                                            class="form-control"
                                                            name="checkoutBillingAddress"
                                                            placeholder="{LANG_ADDRESS}"
                                                            required
                                                            />
                                                </div>
                                            </div>
                                            <div class="col-xs-5 col-md-5 pull-right">
                                                <div class="card-label form-group">
                                                    <label for="checkoutBillingCity">{LANG_CITY}</label>
                                                    <input
                                                            type="text"
                                                            class="form-control"
                                                            name="checkoutBillingCity"
                                                            placeholder="{LANG_CITY}"
                                                            required
                                                            />
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Country -->
                                        <div class="row">
                                            <div class="col-xs-4 col-md-4">
                                                <div class="card-label form-group">
                                                    <label for="checkoutBillingState">{LANG_STATE}</label>
                                                    <input
                                                            type="text"
                                                            class="form-control"
                                                            name="checkoutBillingState"
                                                            placeholder="{LANG_STATE}"
                                                            required
                                                            />
                                                </div>
                                            </div>
                                            <div class="col-xs-4 col-md-4 pull-right">
                                                <div class="card-label form-group">
                                                    <label for="checkoutBillingZipcode">{LANG_ZIPCODE}</label>
                                                    <input
                                                            type="text"
                                                            class="form-control"
                                                            name="checkoutBillingZipcode"
                                                            placeholder="{LANG_ZIPCODE}"
                                                            required
                                                            />
                                                </div>
                                            </div>
                                            <div class="col-xs-4 col-md-4 pull-right">
                                                <div class="card-label form-group">
                                                    <label for="checkoutBillingCountry">{LANG_COUNTRY}</label>
                                                    <input
                                                            type="text"
                                                            class="form-control"
                                                            name="checkoutBillingCountry"
                                                            placeholder="{LANG_COUNTRY}"
                                                            required
                                                            />
                                                </div>
                                            </div>

                                            <div id="checkoutPaymentErrors" style="display:none;">
                                                <div class="col-xs-12">
                                                    <p class="payment-errors"></p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- CREDIT CARD FORM ENDS HERE -->

                                    </div>

                                </div>
                            {:IF}

                                <!-- Offline Payment Method Check -->
                                IF("{PAYMENT_TYPES.folder}"=="wire_transfer"){
                                <div class="payment-tab">
                                    <div class="payment-tab-trigger">
                                        <input name="payment_method_id" class="payment_method_id" id="{PAYMENT_TYPES.folder}" type="radio" value="{PAYMENT_TYPES.id}" data-name="offlinepayment">
                                        <label for="{PAYMENT_TYPES.folder}">{LANG_BANK_DEPOST_OFF_PAY}</label>
                                        <img class="payment-logo {PAYMENT_TYPES.folder}" src="{SITE_URL}storage/payments/{PAYMENT_TYPES.folder}/logo.png" alt="">
                                    </div>

                                    <div class="payment-tab-content">
                                        <div class="quickad-template">
                                            <table class="default-table table-alt-row PaymentMethod-infoTable">
                                                <tbody>
                                                <tr>
                                                    <td>
                                                        <h5 class="PaymentMethod-heading">{LANG_BANK_ACCOUNT_DETAILS}</h5>
                                                        <span class="PaymentMethod-info">{BANK_INFO}</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h5 class="PaymentMethod-heading">{LANG_REFERENCE}</h5>
                                                        <span class="PaymentMethod-info">
                                                            {LANG_MEMBERSHIPPLAN} : {ORDER_TITLE}<br>
                                                            {LANG_USERNAME}: {USERNAME}<br><br>
                                                            {LANG_OFFLINE_CREDIT_NOTE}
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h5 class="PaymentMethod-heading">{LANG_AMOUNT_TO_SEND}</h5>
                                                        <span class="PaymentMethod-info">{CURRENCY_SIGN}{AMOUNT}</span>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>

                                        </div>

                                    </div>
                                </div>
                            {:IF}





                            {/LOOP: PAYMENT_TYPES}
                        </div>
                        <!-- Payment Methods Accordion / End -->
                        <input type="hidden" name="token" value="{TOKEN}" />
                        <input type="hidden" name="upgrade" value="{UPGRADE}" />
                        <button type="submit" name="Submit" class="btn btn-primary margin-top-55 subscribeNow" id="subscribeNow">{LANG_CONFIRM_PAY}</button>
                    </form>

                </div>
                <!-- user-pro-edit -->
            </div>
            <!-- # End Page-Content -->

            <div class="col-lg-4 col-md-4 margin-top-55 margin-bottom-30">

                <!-- Booking Summary -->

                <div class="boxed-widget opening-hours summary margin-top-0">
                    <h3><i class="fa fa-calendar-check-o"></i> {LANG_PACKAGE_SUMMARY}</h3>
                    <ul>
                        <li>{LANG_TITLE} <span>{ORDER_TITLE}</span></li>
                        <li>{LANG_ORDER} <span>{ORDER_DESC}</span></li>
                        <li class="total-costs">{LANG_TOTAL_COST} <span>{CURRENCY_SIGN}{AMOUNT} {CURRENCY_CODE}</span></li>
                    </ul>

                </div>
                <!-- Booking Summary / End -->

            </div>
        </div>
        <!-- row -->
    </div>
    <!-- container -->
</section>
<!-- Payment-Method-page -->


{OVERALL_FOOTER}

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/jquery.validate.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.payment/1.2.3/jquery.payment.min.js"></script>

<script>

    var packagePrice = 1;
    var LANG_CONFIRM_PAY = "{LANG_CONFIRM_PAY}";
    var LANG_PROCCESSING = "{LANG_PROCCESSING}";
    var LANG_VALIDATING = "{LANG_VALIDATING}";
    var LANG_TRY_AGAIN = "{LANG_TRY_AGAIN}";
    var LANG_INV_EXP_DATE = "{LANG_INV_EXP_DATE}";
    var LANG_INV_CVV = "{LANG_INV_CVV}";
    var LANG_FIELD_REQ = "{LANG_FIELD_REQ}";
    var LANG_CODE = "{LANG_CODE}";



    $(document).ready(function ()
    {
        /* Show price & Payment Methods */
        var paymentMethod = $('input[name="payment_method_id"]:checked').data("name");

        /* Select a Payment Method */
        $('.payment_method_id').on('change', function () {
            paymentMethod = $(this).data('name');
        });

        /* Form Default Submission */
        $('#subscribeNow').on('click', function (e) {
            e.preventDefault();

            if (packagePrice <= 0) {
                $('#subscribeForm').submit();
            }

            return false;
        });
    });

</script>

<!-- Offline Payment Payment Method Check -->

<script>
    $(document).ready(function ()
    {
        var paymentMethod = $('input[name="payment_method_id"]:checked').data("name");

        /* Check Payment Method */
        checkPaymentMethodForOfflinePayment(paymentMethod,packagePrice);

        $('.payment_method_id').on('change', function () {
            paymentMethod = $(this).data('name');
            checkPaymentMethodForOfflinePayment(paymentMethod,packagePrice);
        });


        /* Send Payment Request */
        $('#subscribeNow').on('click', function (e)
        {
            e.preventDefault();

            paymentMethod = $('input[name="payment_method_id"]:checked').data("name");

            if (paymentMethod != 'offlinepayment') {
                return false;
            }

            $('#subscribeForm').submit();

            /* Prevent form from submitting */
            return false;
        });
    });

    function checkPaymentMethodForOfflinePayment(paymentMethod,packagePrice)
    {
        if (paymentMethod == 'offlinepayment' && packagePrice > 0) {
            $('#offlinePayment').show();
        } else {
            $('#offlinePayment').hide();
        }
    }
</script>

<!-- Paystack Payment Method Check -->
<script src="https://js.paystack.co/v1/inline.js"></script>
<script>

    $(document).ready(function ()
    {
        var paymentMethod = $('input[name="payment_method_id"]:checked').data("name");

        $('.payment_method_id').on('change', function () {
            paymentMethod = $(this).data('name');
        });

        /* Send Payment Request */
        $('#subscribeNow').on('click', function (e)
        {
            var $form = $('#subscribeForm');
            $form.find('#subscribeNow').html(LANG_PROCCESSING+' <i class="fa fa-spinner fa-pulse"></i>');
            e.preventDefault();

            paymentMethod = $('input[name="payment_method_id"]:checked').data("name");

            if (paymentMethod != 'paystack' || packagePrice <= 0) {
                return false;
            }
            /* Call the reference request function */
            payWithPaystack();

            /* Prevent form from submitting */
            return false;
        });
    });

    function payWithPaystack() {
        var amount = '{AMOUNT}';
        amount = 100 * amount;
        var $form = $('#subscribeForm');
        $form.find('#subscribeNow').html(LANG_PROCCESSING);

        var handler = PaystackPop.setup({
                            key: '{PAYSTACK_PUBLIC_KEY}',
                            email: '{EMAIL}',
                            amount: amount,
                            metadata: {
                                custom_fields: [
                                    {
                                        display_name: "Blank",
                                        product_id: "Blank",
                                        value: "Blank"
                                    }
                                ]
                            }
                            ,
                            callback: function (response) {
                                var paystackReference = response.reference;
                                /* Insert the token into the form so it gets submitted to the server */
                                $form.append($('<input type="hidden" name="paystackReference" />').val(paystackReference));
                                $form.submit();
                            }
                            ,
                            onClose: function () {;
                                $form.find('#subscribeNow').html(LANG_CONFIRM_PAY);
                            }
                        }
                )
                ;
        handler.openIframe();
    }
</script>

<!-- 2Checkout Payment Method Check -->

<script type="text/javascript" src="https://www.2checkout.com/checkout/api/2co.min.js"></script>
<script>
    $(document).ready(function ()
    {
        var paymentMethod = $('input[name="payment_method_id"]:checked').data("name");

        /* Check Payment Method */
        checkPaymentMethodForCheckout(paymentMethod, packagePrice);

        $('#paymentMethodId').on('change', function () {
            paymentMethod = $(this).data('name');
            checkPaymentMethodForCheckout(paymentMethod, packagePrice);
        });


        /* Fancy restrictive input formatting via jQuery.payment library */
        $('input[name=checkoutCardNumber]').payment('formatCardNumber');
        $('input[name=checkoutCardCVC]').payment('formatCardCVC');
        $('input[name=checkoutCardExpiry]').payment('formatCardExpiry');


        /* Pull in the public encryption key for our environment */
        TCO.loadPubKey('sandbox');


        /* Send Payment Request */
        $('#subscribeNow').on('click', function (e)
        {
            e.preventDefault();

            var paymentMethod = $('input[name="payment_method_id"]:checked').data("name");

            if (paymentMethod != '2checkout' || packagePrice <= 0) {
                return false;
            }

            if (!ccFormValidationForCheckout()) {
                return false;
            }

            /* Call the token request function */
            payWithCheckout();

            /* Prevent form from submitting */
            return false;
        });
    });


    /* Check the Payment Method */
    function checkPaymentMethodForCheckout(paymentMethod, packagePrice)
    {
        var $form = $('#subscribeForm');

        $form.find('#subscribeNow').html(LANG_CONFIRM_PAY).prop('disabled', false);

        /* Hide errors on the form */
        $form.find('#checkoutPaymentErrors').hide();
        $form.find('#checkoutPaymentErrors').find('.payment-errors').text('');

        if (paymentMethod == 'checkout' && packagePrice > 0) {
            $('#checkoutPayment').show();
        } else {
            $('#checkoutPayment').hide();
        }
    }

    /* Pay with the Payment Method */
    function payWithCheckout()
    {
        var $form = $('#subscribeForm');

        /* Visual feedback */
        $form.find('#subscribeNow').html(LANG_VALIDATING+' <i class="fa fa-spinner fa-pulse"></i>').prop('disabled', true);

        /* Setup token request arguments */
        var checkoutCardExpiry = $('input[name=checkoutCardExpiry]').val().split('/');

        var args = {
            sellerId: "{CHECKOUT_ACCOUNT_NUMBER}",
            publishableKey: "{CHECKOUT_PUBLIC_KEY}",
            ccNo: $('input[name=checkoutCardNumber]').val().replace(/\s/g,''),
            cvv: $('input[name=checkoutCardCVC]').val(),
            expMonth: (0 in checkoutCardExpiry) ? checkoutCardExpiry[0].replace(/\s/g,'') : '',
            expYear: (1 in checkoutCardExpiry) ? checkoutCardExpiry[1].replace(/\s/g,'') : ''
        };

        /* Make the token request */
        TCO.requestToken(function(data)
        {
            /* Visual feedback */
            $form.find('#subscribeNow').html(LANG_PROCCESSING+' <i class="fa fa-spinner fa-pulse"></i>');

            /* Hide Stripe errors on the form */
            $form.find('#checkoutPaymentErrors').hide();
            $form.find('#checkoutPaymentErrors').find('.payment-errors').text('');

            /* Set the token as the value for the token input */
            var checkoutToken = data.response.token.token;
            $form.append($('<input type="hidden" name="2checkoutToken" />').val(checkoutToken));

            /* IMPORTANT: Here we call `submit()` on the form element directly instead of using jQuery to prevent and infinite token request loop. */
            $form.submit();

        }, function(data)
        {
            if (data.errorCode === 200)
            {
                tokenRequest();
            }
            else
            {
                /* Visual feedback */
                $form.find('#subscribeNow').html(LANG_TRY_AGAIN).prop('disabled', false);

                /* Show errors on the form */
                $form.find('#checkoutPaymentErrors').find('.payment-errors').text(data.errorMsg);
                $form.find('#checkoutPaymentErrors').show();
            }
        }, args);
    }

    function ccFormValidationForCheckout()
    {
        var $form = $('#subscribeForm');

        /* Form validation */
        /*jQuery.validator.addMethod('checkoutCardExpiry', function(value, element) {
         *//* Regular expression to match Credit Card expiration date *//*
     var reg = new RegExp('^(0[1-9]|1[0-2])\\s?\/\\s?([0-9]|[0-9])$');
     return this.optional(element) || reg.test(value);
     }, "Invalid expiration date");*/

        jQuery.validator.addMethod(
                "checkoutCardExpiry",
                function(value, element, params) {
                    var minMonth = new Date().getMonth() + 1;
                    var minYear = new Date().getFullYear();

                    var checkoutCardExpiry = $('input[name=checkoutCardExpiry]').val().split('/');
                    var $month =  (0 in checkoutCardExpiry) ? checkoutCardExpiry[0].replace(/\s/g,'') : '';
                    var $year = (1 in checkoutCardExpiry) ? checkoutCardExpiry[1].replace(/\s/g,'') : '';

                    var month = parseInt($month, 10);
                    var year = parseInt($year, 10);

                    if ((year > minYear) || ((year === minYear) && (month >= minMonth))) {
                        return true;
                    } else {
                        return false;
                    }
                }
                ,
                LANG_INV_EXP_DATE);

        jQuery.validator.addMethod('checkoutCardCVC', function(value, element) {
            /* Regular expression matching a 3 or 4 digit CVC (or CVV) of a Credit Card */
            var reg = new RegExp('^[0-9]{3,4}$');
            return this.optional(element) || reg.test(value);
        }, LANG_INV_CVV);

        var validator = $form.validate({
            lang: '{LANG_CODE}',
            rules: {
                checkoutCardNumber: {
                    required: true
                },
                checkoutCardExpiry: {
                    required: true,
                    checkoutCardExpiry: true
                },
                checkoutCardCVC: {
                    required: true,
                    checkoutCardCVC: true
                },
                checkoutCardHolderFirstName: {
                    required: true
                },
                checkoutCardHolderLastName: {
                    required: true
                },
                checkoutBillingAddress: {
                    required: true
                },
                checkoutBillingCity: {
                    required: true
                },
                checkoutBillingState: {
                    required: true
                },
                checkoutBillingZipcode: {
                    required: true
                },
                checkoutBillingCountry: {
                    required: true
                }
            },
            highlight: function(element) {
                $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
            },
            unhighlight: function(element) {
                $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
            },
            errorPlacement: function(error, element) {
                $(element).closest('.form-group').append(error);
            }
        });

        paymentFormReady = function() {
            if ($form.find('[name=checkoutCardNumber]').closest('.form-group').hasClass('has-success') &&
                    $form.find('[name=checkoutCardExpiry]').closest('.form-group').hasClass('has-success') &&
                    $form.find('[name=checkoutCardCVC]').val().length > 1) {
                return true;
            } else {
                return false;
            }
        };
        $form.find('#subscribeNow').html(LANG_CONFIRM_PAY).prop('disabled', true);
        var readyInterval = setInterval(function() {
            if (paymentFormReady()) {
                $form.find('#subscribeNow').prop('disabled', false);
                clearInterval(readyInterval);
            }
        }, 250);

        /* Abort if invalid form data */
        if (!validator.form()) {
            return false;
        } else {
            return true;
        }
    }

</script>

<!-- Stripe Payment Method Check -->

<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script>
    $(document).ready(function ()
    {
        var paymentMethod = $('input[name="payment_method_id"]:checked').data("name");

        /* Check Payment Method */
        checkPaymentMethodForStripe(paymentMethod, packagePrice);

        $('.payment_method_id').on('change', function () {
            paymentMethod = $(this).data('name');
            checkPaymentMethodForStripe(paymentMethod, packagePrice);
        });


        /* Fancy restrictive input formatting via jQuery.payment library */
        $('input[name=stripeCardNumber]').payment('formatCardNumber');
        $('input[name=stripeCardCVC]').payment('formatCardCVC');
        $('input[name=stripeCardExpiry]').payment('formatCardExpiry');


        /* Send Payment Request */
        $('#subscribeNow').on('click', function (e)
        {
            e.preventDefault();

            paymentMethod = $('input[name="payment_method_id"]:checked').data("name");

            if (paymentMethod != 'stripe' || packagePrice <= 0) {
                return false;
            }

            if (!ccFormValidationForStripe()) {
                return false;
            }

            /* Call the token request function */
            payWithStripe();

            /* Prevent form from submitting */
            return false;
        });
    });


    /* Check the Payment Method */
    function checkPaymentMethodForStripe(paymentMethod, packagePrice)
    {
        var $form = $('#subscribeForm');

        $form.find('#subscribeNow').html(LANG_CONFIRM_PAY).prop('disabled', false);

        /* Hide errors on the form */
        $form.find('#stripePaymentErrors').hide();
        $form.find('#stripePaymentErrors').find('.payment-errors').text('');

        if (paymentMethod == 'stripe' && packagePrice > 0) {
            $('#stripePayment').show();
        } else {
            $('#stripePayment').hide();
        }
    }

    /* Pay with the Payment Method */
    function payWithStripe()
    {
        var $form = $('#subscribeForm');

        /* Visual feedback */
        $form.find('#subscribeNow').html(LANG_VALIDATING+' <i class="fa fa-spinner fa-pulse"></i>').prop('disabled', true);

        var PublishableKey = '{STRIPE_PUBLISHABLE_KEY}';
        Stripe.setPublishableKey(PublishableKey);

        /* Create token */
        var expiry = $form.find('[name=stripeCardExpiry]').payment('cardExpiryVal');
        var ccData = {
            number: $form.find('[name=stripeCardNumber]').val().replace(/\s/g,''),
            cvc: $form.find('[name=stripeCardCVC]').val(),
            exp_month: expiry.month,
            exp_year: expiry.year
        };

        Stripe.card.createToken(ccData, function stripeResponseHandler(status, response)
        {
            if (response.error)
            {
                /* Visual feedback */
                $form.find('#subscribeNow').html(LANG_TRY_AGAIN).prop('disabled', false);

                /* Show errors on the form */
                $form.find('#stripePaymentErrors').find('.payment-errors').text(response.error.message);
                $form.find('#stripePaymentErrors').show();
            }
            else
            {
                /* Visual feedback */
                $form.find('#subscribeNow').html(LANG_PROCCESSING+' <i class="fa fa-spinner fa-pulse"></i>');

                /* Hide Stripe errors on the form */
                $form.find('#stripePaymentErrors').hide();
                $form.find('#stripePaymentErrors').find('.payment-errors').text('');

                /* Response contains id and card, which contains additional card details */
                var stripeToken = response.id;

                /* Insert the token into the form so it gets submitted to the server */
                $form.append($('<input type="hidden" name="stripeToken" />').val(stripeToken));
                $form.append($('<input type="hidden" name="exp_month" />').val(response.card.exp_month));
                $form.append($('<input type="hidden" name="exp_year" />').val(response.card.exp_year));

                /* and submit */
                $form.submit();
            }
        });
    }

    function ccFormValidationForStripe()
    {
        var $form = $('#subscribeForm');

        /* Form validation using Stripe client-side validation helpers */
        jQuery.validator.addMethod('stripeCardNumber', function(value, element) {
            return this.optional(element) || Stripe.card.validateCardNumber(value);
        }, "Please specify a valid credit card number");

        jQuery.validator.addMethod('stripeCardExpiry', function(value, element) {
            /* Parsing month/year uses jQuery.payment library */
            value = $.payment.cardExpiryVal(value);
            return this.optional(element) || Stripe.card.validateExpiry(value.month, value.year);
        }, LANG_INV_EXP_DATE);

        jQuery.validator.addMethod('stripeCardCVC', function(value, element) {
            return this.optional(element) || Stripe.card.validateCVC(value);
        }, LANG_INV_CVV);

        var validator = $form.validate({
            rules: {
                stripeCardNumber: {
                    required: true,
                    stripeCardNumber: true
                },
                stripeCardExpiry: {
                    required: true,
                    stripeCardExpiry: true
                },
                stripeCardCVC: {
                    required: true,
                    stripeCardCVC: true
                }
            },
            highlight: function(element) {
                $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
            },
            unhighlight: function(element) {
                $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
            },
            errorPlacement: function(error, element) {
                $(element).closest('.form-group').append(error);
            }
        });

        paymentFormReady = function() {
            if ($form.find('[name=stripeCardNumber]').closest('.form-group').hasClass('has-success') &&
                    $form.find('[name=stripeCardExpiry]').closest('.form-group').hasClass('has-success') &&
                    $form.find('[name=stripeCardCVC]').val().length > 1) {
                return true;
            } else {
                return false;
            }
        };

        $form.find('#subscribeNow').prop('disabled', true);
        var readyInterval = setInterval(function() {
            if (paymentFormReady()) {
                $form.find('#subscribeNow').prop('disabled', false);
                clearInterval(readyInterval);
            }
        }, 250);

        /* Abort if invalid form data */
        if (!validator.form()) {
            return false;
        } else {
            return true;
        }
    }

</script>

<!-- Paypal Payment Method Check -->

<script>
    $(document).ready(function ()
    {
        var paymentMethod = $('input[name="payment_method_id"]:checked').data("name");

        $('.payment_method_id').on('change', function () {
            paymentMethod = $(this).data('name');
        });

        /* Send Payment Request */
        $('#subscribeNow').on('click', function (e)
        {
            e.preventDefault();

            paymentMethod = $('input[name="payment_method_id"]:checked').data("name");

            if (paymentMethod != 'paypal' || packagePrice <= 0) {
                return false;
            }

            $('#subscribeForm').submit();

            /* Prevent form from submitting */
            return false;
        });
    });

</script>



<script>
    var radios = document.querySelectorAll('.payment-tab-trigger > input.payment_method_id');
    for (var i = 0; i < radios.length; i++) {
        radios[i].addEventListener('change', expandAccordion);
    }
    function expandAccordion(event) {
        var allTabs = document.querySelectorAll('.payment-tab');
        for (var i = 0; i < allTabs.length; i++) {
            allTabs[i].classList.remove('payment-tab-active');
            var doc = allTabs[i];
            var notes = null;
            for (var x = 0; x < doc.childNodes.length; x++) {
                if (doc.childNodes[x].className == "payment-tab-content") {
                    notes = doc.childNodes[x];

                    notes.style.display = "none";
                }
            }
        }
        event.target.parentNode.parentNode.classList.add('payment-tab-active');
        event.target.parentNode.nextSibling.nextSibling.style.display = "block";

    }
</script>