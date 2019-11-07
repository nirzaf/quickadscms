{OVERALL_HEADER}
<!-- Pricing Plans -->
<section class="bg-white py-8">

    <div class="container">

        <div class="section-title text-center mb-8 position-relative">
            <h1 class="font-weight-semibold">{LANG_MEMBERSHIPPLAN}</h1>
            <p class="font-weight-bold text-gray-600 quickad_lang_translator" data-quickad-lang="{LANG_ALL_PACKAGES}">{LANG_ALL_PACKAGES}</p>
        </div>

        <div class="owl-carousel pricing-plans-carousel" data-owl-items="3" data-owl-dots="3">
            {LOOP: SUB_TYPES}

                <div class="p-3">
                    <div class="pricing-plan recommended text-center border py-7 px-2 bg-light rounded-10">
                        IF("{SUB_TYPES.recommended}"=="1"){ <div class="ribbon"><i class="fa fa-star-o"></i></div> {:IF}
                        <h4 class="font-weight-bold text-gray-600 mb-4">{SUB_TYPES.title}</h4>
                        <p class="font-weight-bold font-size-20 mb-4">{CURRENCY_SIGN}<span class="price-text font-size-35 align-middle">{SUB_TYPES.cost}</span>/<span class="font-size-14">{SUB_TYPES.term}</span></p>

                        <ul class="list-unstyled mb-6">
                            <li class="mb-2">
                                <span class="icon-text yes"><i class="fa fa-check-circle mr-2"></i></span>
                                {LANG_AD_EXP_IN} : <span class="font-weight-bold">{SUB_TYPES.duration} </span> {LANG_DAYS}</li>
                            <li class="mb-2">
                                <span class="icon-text yes"><i class="fa fa-check-circle mr-2"></i></span>
                                {LANG_FEATURED_FEE} <span class="font-weight-bold">{CURRENCY_SIGN}{SUB_TYPES.featured_fee}</span></li>
                            <li class="mb-2">
                                <span class="icon-text yes"><i class="fa fa-check-circle mr-2"></i></span>
                                {LANG_URGENT_FEE} <span class="font-weight-bold">{CURRENCY_SIGN}{SUB_TYPES.urgent_fee}</span></li>
                            <li class="mb-2">
                                <span class="icon-text yes"><i class="fa fa-check-circle mr-2"></i></span>
                                {LANG_HIGHLIGHT_FEE} <span class="font-weight-bold">{CURRENCY_SIGN}{SUB_TYPES.highlight_fee}</span></li>
                            <li class="mb-2">
                                IF("{SUB_TYPES.top_search_result}"=="yes"){
                                <span class="icon-text yes"><i class="fa fa-check-circle mr-2"></i></span>
                                {:IF}
                                IF("{SUB_TYPES.top_search_result}"=="no"){
                                <span class="icon-text no"><i class="fa fa-times-circle mr-2"></i></span>
                                {:IF}
                                {LANG_TOP_SEARCH_RESULT}</li>
                            <li class="mb-2">
                                IF("{SUB_TYPES.show_on_home}"=="yes"){
                                <span class="icon-text yes"><i class="fa fa-check-circle mr-2"></i></span>
                                {:IF}
                                IF("{SUB_TYPES.show_on_home}"=="no"){
                                <span class="icon-text no"><i class="fa fa-times-circle mr-2"></i></span>
                                {:IF}
                                {LANG_SHOW_ON_HOME}</li>
                            <li class="mb-2">
                                IF("{SUB_TYPES.show_in_home_search}"=="yes"){
                                <span class="icon-text yes"><i class="fa fa-check-circle mr-2"></i></span>
                                {:IF}
                                IF("{SUB_TYPES.show_in_home_search}"=="no"){
                                <span class="icon-text no"><i class="fa fa-times-circle mr-2"></i></span>
                                {:IF}
                                {LANG_SHOW_IN_HOME_SEARCH}</li>
                        </ul>

                        <div class="position-relative">
                            IF("{SUB_TYPES.Selected}"=="0"){
                            <form name="form1" method="post" action="">
                                <input class="signup cursor" name="upgrade" type="hidden" value="{SUB_TYPES.id}">
                                <input type="submit" class="btn btn-dark" name="Submitup" value="{LANG_UPGRADE}">
                            </form>
                            {:IF}
                            IF("{SUB_TYPES.Selected}"=="1"){

                            <a href="#" class="btn btn-primary">
                                <i class="fa fa-paper-plane mr-2"></i>
                                {LANG_CURRENT_PLAN}
                            </a>
                            {:IF}
                        </div>

                    </div>
                </div>
            {/LOOP: SUB_TYPES}

        </div>

    </div>
</section>
<!-- END Pricing Plans -->
{OVERALL_FOOTER}

<script type="text/javascript">
    $(document).ready(function(){

        $.each($('.quickad_lang_translator'), function() {
            $lang = $(this).data('quickad-lang');
            $(this).html($lang);
            console.log($lang);
        });

    });
</script>
