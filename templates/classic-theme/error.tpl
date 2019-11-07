{OVERALL_HEADER}
<section id="main" class="clearfix text-center">
    <div class="container">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <div class="found-section section">
                    <h1 style="display: none">404</h1>

                    <h2>{MESSAGE}</h2>
                    IF("{CONTENT}"==""){
                        <p>{LANG_NOT_FIND_PAGE}.</p>
                    {:IF}
                    IF("{CONTENT}"!=""){
                        <p>{CONTENT}.</p>
                    {:IF}

                    <a href="{LINK_INDEX}" class="btn btn-primary">{LANG_GO_HOME}</a></div>
            </div>
        </div>
    </div>
    <!-- container -->
</section>
<!-- main -->
{OVERALL_FOOTER}