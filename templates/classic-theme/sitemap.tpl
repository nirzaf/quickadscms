{OVERALL_HEADER}

<script>
    $(document).ready(function() {
        $(".jumper").on("click", function( e ) {

            e.preventDefault();

            $("body, html").animate({
                scrollTop: $( $(this).attr('href') ).offset().top
            }, 600);

        });
    });
</script>
<!-- main -->
<section id="main" class="clearfix page">
    <div class="container">
        <div class="breadcrumb-section"><!-- breadcrumb -->
            <ol class="breadcrumb">
                <li><a href="{LINK_INDEX}"><i class="fa fa-home"></i> {LANG_HOME}</a></li>
                <li>{LANG_SITE_MAP}</li>
                <div class="pull-right back-result"><a href="{LINK_LISTING}"><i class="fa fa-angle-double-left"></i>
                    {LANG_BACK_RESULT}</a></div>
                <h2 class="title">{LANG_SITE_MAP}</h2>
            </ol>
            <!-- breadcrumb --></div>
        <div class="section">
            <h2 class="text-center sitemap-h2">{LANG_LIST_CAT_SUBCAT}</h2>
            <hr>
            <div class="row cg-nav-wrapper cg-nav-wrapper-row-2" data-role="cg-nav-wrapper">
                {LOOP: CAT}
                <div style="width:20%;float: left">
                    <div class="anchor-wrap anchor{CAT.main_id}-wrap" data-role="anchor{CAT.main_id}">
                        <a class="anchor{CAT.main_id} jumper" data-role="cont" href="#anchor{CAT.main_id}">
                            <i class="caticon {CAT.icon}"></i>
                        <span class="desc">
                            {CAT.main_title}
                        </span>
                        </a>
                    </div>
                </div>
                {/LOOP: CAT}
            </div>
            <div class="cg-main">
                {LOOP: SUBCAT}
                <div class="item util-clearfix" data-spm="0">
                    <h3 class="big-title anchor{SUBCAT.main_id} anchor-agricuture" data-role="anchor{SUBCAT.main_id}-scroll">
                        <span id="anchor{SUBCAT.main_id}" class="anchor-subsitution"></span>
                        <i class="cg-icon {SUBCAT.icon}"></i>{SUBCAT.main_title}
                    </h3>
                    <div class="sub-item-wrapper util-clearfix">
                        <div class="sub-item">
                            <h4 class="sub-title">
                                <a href="{SUBCAT.catlink}">{SUBCAT.main_title}</a><span> ({SUBCAT.main_ads_count})</span>
                            </h4>
                            <div class="sub-item-cont-wrapper">
                                <ul class="sub-item-cont util-clearfix">
                                    {SUBCAT.sub_title}
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                {/LOOP: SUBCAT}
            </div>

        </div>
    </div>
    <!-- container -->
</section>
<!-- main -->
{OVERALL_FOOTER}