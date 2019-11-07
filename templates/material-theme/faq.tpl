{OVERALL_HEADER}


<div id="page-content">
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="{LINK_INDEX}">{LANG_HOME}</a></li>
            <li class="active">{LANG_FAQ}</li>
        </ol>
        <section class="page-title">
            <h1>{LANG_FAQ}</h1>
        </section>


        <section>
            {LOOP: FAQ}
            <div class="answer">
                <div class="box">
                    <h3>{FAQ.title}</h3>
                    <p>{FAQ.content}</p>
                </div>
                <figure class="hidden">Was this answer helpful? <a href="#">Yes<i class="fa fa-thumbs-up"></i></a> <a href="#">No<i class="fa fa-thumbs-down"></i></a></figure>
            </div>
            <!--end answer-->
            {/LOOP: FAQ}
        </section>
</div>
{OVERALL_FOOTER}