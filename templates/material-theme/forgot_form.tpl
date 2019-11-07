{OVERALL_HEADER}



<style type="text/css">
input,select{ width:95%}

.bg-green, .callout.callout-success, .alert-success, .label-success, .modal-success .modal-body {
    background-color: #00a65a !important;
}
.bg-red, .bg-yellow, .bg-aqua, .bg-blue, .bg-light-blue, .bg-green, .bg-navy, .bg-teal, .bg-olive, .bg-lime, .bg-orange, .bg-fuchsia, .bg-purple, .bg-maroon, .bg-black, .bg-red-active, .bg-yellow-active, .bg-aqua-active, .bg-blue-active, .bg-light-blue-active, .bg-green-active, .bg-navy-active, .bg-teal-active, .bg-olive-active, .bg-lime-active, .bg-orange-active, .bg-fuchsia-active, .bg-purple-active, .bg-maroon-active, .bg-black-active, .callout.callout-danger, .callout.callout-warning, .callout.callout-info, .callout.callout-success, .alert-success, .alert-danger, .alert-error, .alert-warning, .alert-info, .label-danger, .label-info, .label-warning, .label-primary, .label-success, .modal-primary .modal-body, .modal-primary .modal-header, .modal-primary .modal-footer, .modal-warning .modal-body, .modal-warning .modal-header, .modal-warning .modal-footer, .modal-info .modal-body, .modal-info .modal-header, .modal-info .modal-footer, .modal-success .modal-body, .modal-success .modal-header, .modal-success .modal-footer, .modal-danger .modal-body, .modal-danger .modal-header, .modal-danger .modal-footer {
    color: #fff !important;
}
.callout.callout-success {
    border-color: #00733e;
}
.callout {
    border-left: 5px solid #eee;
    border-radius: 3px;
    margin: 0 0 20px;
    padding: 15px 30px 15px 15px;
}
</style>

<div id="page-content">
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="{LINK_INDEX}">{LANG_HOME}</a></li>
            <li><a href="{LINK_LOGIN}">{LANG_LOGIN}</a></li>
            <li class="active">{LANG_FORGOTPASS}</li>
        </ol>
        <!--end breadcrumb-->
        IF("{SUCCESS}"!=""){
        <div class="container" style="padding-top:20px">
            <div class="callout callout-success">
                <h4>{LANG_CONFIRMATION_MAIL_SENT}</h4>
                <p>{SUCCESS}</p>
            </div>
        </div>
        {:IF}
        <div class="row">
            <div class="col-md-6 col-sm-8 col-md-offset-3 col-sm-offset-2">
                <div class="middle-dabba">

                    <h1>{LANG_REQ_PASS}</h1>
                    <p class="modal-title">{LANG_SENDLINK_NEWPASS}.</p>
                    <div id="post-form" style="padding:0 10px 10px">


                        <form name="form1" method="post" action="{LINK_LOGIN}" id="send">
                            <div class="input-field">
                                IF("{LOGIN_ERROR}"!=""){
                                    <article class="byMsg byMsgError" id="formErrors" style="width:92%">! {LOGIN_ERROR}</article>
                                {:IF}
                            </div>

                            <div class="input-field">
                                <label for="email">{LANG_ENTER_MAIL}</label>
                                <input type="email" name="email" id="email" required="required"/>
                            </div>


                            <div class="input-field">
                                <input name="Submit" type="hidden" id="Submit">
                                <button class="btn btn-primary waves-effect" type="submit" name="Submit" ><span>{LANG_REQ_PASS}</span></button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--end row-->
    </div>
    <!--end container-->
</div>
<!--end page-content-->









                               
{OVERALL_FOOTER}
			