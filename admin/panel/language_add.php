<header class="slidePanel-header overlay">
    <div class="overlay-panel overlay-background vertical-align">
        <div class="service-heading">
            <h2>Add Language (Process take 5-10 minutes.)</h2>
        </div>
        <div class="slidePanel-actions">
            <div class="btn-group-flat">
                <button type="button" class="btn btn-floating btn-warning btn-sm waves-effect waves-float waves-light margin-right-10" id="post_sidePanel_data"><i class="icon ion-android-done" aria-hidden="true"></i></button>
                <button type="button" class="btn btn-pure btn-inverse slidePanel-close icon ion-android-close font-size-20" aria-hidden="true"></button>
            </div>
        </div>
    </div>
</header>
<div class="slidePanel-inner">
    <div class="panel-body">
        <!-- /.row -->
        <div class="row">
            <div class="col-sm-12">

                <div class="white-box">
                    <div id="post_error"></div>
                    <form name="form2"  class="form form-horizontal" method="post" data-ajax-action="addLanguage" id="sidePanel_form">
                        <div class="form-body">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Language name *</label>
                                <div class="col-sm-7">
                                    <input type="text" name="name" value="" placeholder="Language name" class="form-control" required="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Code (ISO 639-1)*</label>
                                <div class="col-sm-7">
                                    <input type="text" name="code" value="" placeholder="Code (ISO 639-1)" class="form-control" required="">
                                    <p class="help-block"><a href="https://en.wikipedia.org/wiki/List_of_ISO_639-1_codes" target="_blank">https://en.wikipedia.org/wiki/List_of_ISO_639-1_codes</a> </p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label">Direction *</label>
                                <div class="col-sm-7">
                                    <select name="direction" class="form-control">
                                        <option value="ltr" selected="">ltr</option>
                                        <option value="rtl">rtl</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label">Active</label>
                                <div class="col-sm-7">
                                    <label class="css-input switch switch-sm switch-success">
                                        <input  name="active" type="checkbox" value="1" checked=""/><span></span>
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label">Auto Google Translate</label>
                                <div class="col-sm-7">
                                    <label class="css-input switch switch-sm switch-success">
                                        <input  name="auto_tran" type="checkbox" value="1" checked=""/><span></span>
                                    </label>
                                </div>
                            </div>

                            <input type="hidden" name="submit">

                        </div>

                    </form>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
</div>

