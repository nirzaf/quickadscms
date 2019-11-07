{OVERALL_HEADER}
<section id="main" class="clearfix page">
    <div class="container">
        <div class="breadcrumb-section">
            <!-- breadcrumb -->
            <ol class="breadcrumb">
                <li><a href="{LINK_INDEX}"><i class="fa fa-home"></i> {LANG_HOME}</a></li>
                <li>{LANG_FAQ}</li>
                <div class="pull-right back-result">
                    <a href="{LINK_LISTING}"><i class="fa fa-angle-double-left"></i>
                    {LANG_BACK_RESULT}</a>
                </div>
                <h2 class="title">{LANG_FAQ}</h2>
            </ol>
            <!-- breadcrumb -->
        </div>
        <div class="faq-page section">
            {LOOP: FAQ}
            <dl class="faq-list">
                <dt class="faq-list_h">
                    <h4 class="marker">Q?</h4>
                    <h5 class="marker_head">{FAQ.title}</h5>
                </dt>
                <dd>
                    <h4 class="marker1">A.</h4>
                    <div class="m_13"> {FAQ.content}</div>
                </dd>
            </dl>
            {/LOOP: FAQ}
        </div>
        <!-- faq-page -->
    </div>
    <!-- container -->
</section>
{OVERALL_FOOTER}