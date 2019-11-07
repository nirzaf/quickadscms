{OVERALL_HEADER}
<!-- Choose-category-page -->
<section id="main" class="clearfix ad-post-page">
    <div class="container">
        <div class="breadcrumb-section">
            <!-- breadcrumb -->
            <ol class="breadcrumb">
                <li><a href="{LINK_INDEX}">{LANG_HOME}</a></li>
                <li class="active">{LANG_CHOOSE_CATEGORY}</li>
                <div class="pull-right back-result"><a href="{LINK_LISTING}"><i class="fa fa-angle-double-left"></i>
                    {LANG_BACK_RESULT}</a></div>
            </ol>
            <!-- breadcrumb -->
        </div>
        <div id="quickad-post">
            <div class="row category-tab" id="js-category-list">
                <div class="col-md-4 col-sm-6">
                    <div class="section cat-option select-category post-option">
                        <h4>{LANG_SELECT_CATEGORY}</h4>
                        <ul role="tablist">
                            {LOOP: CATEGORY}
                            <li class="" aria-controls="cat{CATEGORY.id}" role="tab" data-toggle="tab"
                                aria-expanded="false" data-ajax-catid="{CATEGORY.id}"
                                data-ajax-action="getsubcatbyidList"><a href="#cat{CATEGORY.id}"><span class="select"><i
                                    class="{CATEGORY.icon} fa20"></i></span>{CATEGORY.name}</a></li>
                            {/LOOP: CATEGORY}
                        </ul>
                    </div>
                </div>
                <!-- Tab panes -->
                <div class="col-md-4 col-sm-6">
                    <div class="section tab-content subcategory post-option">
                        <h4>{LANG_SELECT-SUBCATEGORY}</h4>
                        <ul id="sub_category"></ul>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="section next-stap post-option">
                        <h2>{LANG_POSTAD_JUST} <span>30 {LANG_SECONDS}</span></h2>
                        <p>{LANG_CATEGORY_NOTE}</p>

                        <form method="post">
                            <div class="btn-section">
                                <input type="hidden" id="input-catid" name="catid" value="">
                                <input type="hidden" id="input-subcatid" name="subcatid" value="">
                                <button type="submit" name="choose-category" id="next-btn" class="btn btn-primary" disabled>{LANG_NEXT}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- next-stap -->
            </div>
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2 text-center">
                    <div class="quickad-section">{TOP_ADSCODE}</div>
                </div>
            </div>
            <!-- row -->
        </div>
    </div>
    <!-- container -->
</section>
<!-- Choose-category-page -->
{OVERALL_FOOTER}

<script>
    // -------------------------------------------------------------
    //  select-category Change
    // -------------------------------------------------------------
    $('.select-category.post-option ul li').on('click', function () {
        $('.select-category.post-option ul li.link-active').removeClass('link-active');
        $(this).closest('li').addClass('link-active');

        var catid = $(this).data('ajax-catid');
        var action = $(this).data('ajax-action');
        var data = {action: action, catid: catid};

        getsubcat(catid, action, "");

        $('button').prop('disabled', true);
    });

    $('#js-category-list').on('click', '#sub_category li', function (e) {

        var $item = $(this).closest('li');
        $('#sub_category li.link-active').removeClass('link-active active');
        $item.addClass('link-active');
        var subcatid = $item.data('ajax-subcatid');
        $('#input-subcatid').val(subcatid);

        $('button').prop('disabled', false);
    });

    jQuery(function ($) {
        getsubcat("{CATID}", "getsubcatbyidList", "{SUBCATID}")
    });

    function getsubcat(catid, action, selectid) {
        var data = {action: action, catid: catid, selectid: selectid};
        $.ajax({
            type: "POST",
            url: ajaxurl + '?action=' + action,
            data: data,
            success: function (result) {
                $("#sub_category").html(result);
            }
        });
        $('*[data-ajax-catid=' + catid + ']').addClass('link-active active');

        $('#input-catid').val(catid);
        $('#input-subcatid').val(selectid);

        $('button').prop('disabled', false);
    }
</script>