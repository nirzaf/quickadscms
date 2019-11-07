{OVERALL_HEADER}

<div id="page-content" style="transform: translateY(0px);">
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="{LINK_INDEX}">{LANG_HOME}</a></li>
            <li class="active">404 {LANG_ERROR}</li>
        </ol>
        <!--end breadcrumb-->
        <section class="page-title center error">
            <h1>404</h1>
            <h2>{LANG_ERROR}</h2>

            IF("{CONTENT}"==""){
            <p>{LANG_NOT_FIND_PAGE}.</p>
            {:IF}
            IF("{CONTENT}"!=""){
            <p>{CONTENT}.</p>
            {:IF}
        </section>
        <!--end page-title-->
        <div class="row">
            <div class="col-md-4 col-sm-4 col-md-offset-4 col-sm-offset-4">
                <form class="form inputs-underline">
                    <div class="form-group center">
                        <a href="{LINK_INDEX}" class="btn btn-primary ju-btn-default btn-filled rounded">{LANG_GO_HOME}</a>
                    </div><!-- /input-group -->
                </form>
                <!--end form-->
            </div>
        </div>
    </div>
    <!--end container-->
</div>

{OVERALL_FOOTER}
