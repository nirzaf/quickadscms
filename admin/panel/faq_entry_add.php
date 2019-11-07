<header class="slidePanel-header overlay">
    <div class="overlay-panel overlay-background vertical-align">
        <div class="service-heading">
            <h2>Add FAQ Entry</h2>
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
                    <form name="form2"  class="form form-horizontal" method="post" data-ajax-action="addFAQentry" id="sidePanel_form">
                        <div class="form-body">
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <label>FAQ Title:</label>
                                    <input name="title" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-12">
                                    <label class="css-input switch switch-sm switch-success">
                                        <strong>Active</strong> <input  name="active" type="checkbox" value="1" checked=""/><span></span>
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-12">
                                    <label>FAQ Content:</label>
                                    <textarea name="content" id="pageContent" rows="6" type="text" class="form-control"></textarea>
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
<!-- CRUD FORM CONTENT - crud_fields_scripts stack -->
<link media="all" rel="stylesheet" type="text/css" href="assets/js/plugins/simditor/styles/simditor.css" />
<script src="assets/js/plugins/simditor/scripts/mobilecheck.js"></script>
<script src="assets/js/plugins/simditor/scripts/module.js"></script>
<script src="assets/js/plugins/simditor/scripts/uploader.js"></script>
<script src="assets/js/plugins/simditor/scripts/hotkeys.js"></script>
<script src="assets/js/plugins/simditor/scripts/simditor.js"></script>
<script>
    (function() {
        $(function() {
            var $preview, editor, mobileToolbar, toolbar, allowedTags;
            Simditor.locale = 'en-US';
            toolbar = ['bold','italic','underline','fontScale','|','ol','ul','blockquote','table','link'];
            mobileToolbar = ["bold", "italic", "underline", "ul", "ol"];
            if (mobilecheck()) {
                toolbar = mobileToolbar;
            }
            allowedTags = ['br','span','a','img','b','strong','i','strike','u','font','p','ul','ol','li','blockquote','pre','h1','h2','h3','h4','hr','table'];
            editor = new Simditor({
                textarea: $('#pageContent'),
                placeholder: 'Describe what makes your ad unique...',
                toolbar: toolbar,
                pasteImage: false,
                defaultImage: 'assets/js/plugins/simditor/images/image.png',
                upload: false,
                allowedTags: allowedTags
            });
            $preview = $('#preview');
            if ($preview.length > 0) {
                return editor.on('valuechanged', function(e) {
                    return $preview.html(editor.getValue());
                });
            }
        });
    }).call(this);
</script>
