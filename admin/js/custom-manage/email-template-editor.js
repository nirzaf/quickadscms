/*pageContent0*/
(function() {
    $(function() {
        var editor = new Simditor({
            textarea: $('#pageContent0')
            //optional options
        });
    });
}).call(this);
/*pageContent0*/

/*pageContent1*/
(function() {
    $(function() {
        var $preview, editor, mobileToolbar, toolbar, allowedTags;
        Simditor.locale = 'en-US';
        toolbar = [
            'title',
            'bold',
            'italic',
            'underline',
            'strikethrough',
            'fontScale',
            'color',
            'ol',
            'ul',
            'blockquote',
            'code',
            'table',
            'link',
            'image',
            'hr',
            'indent',
            'outdent',
            'alignment'
        ];
        mobileToolbar = ["bold", "italic", "underline", "ul", "ol"];
        if (mobilecheck()) {
            toolbar = mobileToolbar;
        }
        allowedTags = ['br','span','a','img','b','strong','i','strike','u','font','p','ul','ol','li','blockquote','pre','h1','h2','h3','h4','hr','table'];
        editor = new Simditor({
            textarea: $('#pageContent1'),
            placeholder: 'Message...',
            toolbar: toolbar,
            pasteImage: true,
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
/*pageContent1*/

/*pageContent2*/
(function() {
    $(function() {
        var $preview, editor, mobileToolbar, toolbar, allowedTags;
        Simditor.locale = 'en-US';
        toolbar = [
            'title',
            'bold',
            'italic',
            'underline',
            'strikethrough',
            'fontScale',
            'color',
            'ol',
            'ul',
            'blockquote',
            'code',
            'table',
            'link',
            'image',
            'hr',
            'indent',
            'outdent',
            'alignment'
        ];
        mobileToolbar = ["bold", "italic", "underline", "ul", "ol"];
        if (mobilecheck()) {
            toolbar = mobileToolbar;
        }
        allowedTags = ['br','span','a','img','b','strong','i','strike','u','font','p','ul','ol','li','blockquote','pre','h1','h2','h3','h4','hr','table'];
        editor = new Simditor({
            textarea: $('#pageContent2'),
            placeholder: 'Message...',
            toolbar: toolbar,
            pasteImage: true,
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
/*pageContent2*/

/*pageContent3*/
(function() {
    $(function() {
        var $preview, editor, mobileToolbar, toolbar, allowedTags;
        Simditor.locale = 'en-US';
        toolbar = [
            'title',
            'bold',
            'italic',
            'underline',
            'strikethrough',
            'fontScale',
            'color',
            'ol',
            'ul',
            'blockquote',
            'code',
            'table',
            'link',
            'image',
            'hr',
            'indent',
            'outdent',
            'alignment'
        ];
        mobileToolbar = ["bold", "italic", "underline", "ul", "ol"];
        if (mobilecheck()) {
            toolbar = mobileToolbar;
        }
        allowedTags = ['br','span','a','img','b','strong','i','strike','u','font','p','ul','ol','li','blockquote','pre','h1','h2','h3','h4','hr','table'];
        editor = new Simditor({
            textarea: $('#pageContent3'),
            placeholder: 'Message...',
            toolbar: toolbar,
            pasteImage: true,
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
/*pageContent3*/

/*pageContent4*/
(function() {
    $(function() {
        var $preview, editor, mobileToolbar, toolbar, allowedTags;
        Simditor.locale = 'en-US';
        toolbar = [
            'title',
            'bold',
            'italic',
            'underline',
            'strikethrough',
            'fontScale',
            'color',
            'ol',
            'ul',
            'blockquote',
            'code',
            'table',
            'link',
            'image',
            'hr',
            'indent',
            'outdent',
            'alignment'
        ];
        mobileToolbar = ["bold", "italic", "underline", "ul", "ol"];
        if (mobilecheck()) {
            toolbar = mobileToolbar;
        }
        allowedTags = ['br','span','a','img','b','strong','i','strike','u','font','p','ul','ol','li','blockquote','pre','h1','h2','h3','h4','hr','table'];
        editor = new Simditor({
            textarea: $('#pageContent4'),
            placeholder: 'Message...',
            toolbar: toolbar,
            pasteImage: true,
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
/*pageContent4*/

/*pageContent5*/
(function() {
    $(function() {
        var $preview, editor, mobileToolbar, toolbar, allowedTags;
        Simditor.locale = 'en-US';
        toolbar = [
            'title',
            'bold',
            'italic',
            'underline',
            'strikethrough',
            'fontScale',
            'color',
            'ol',
            'ul',
            'blockquote',
            'code',
            'table',
            'link',
            'image',
            'hr',
            'indent',
            'outdent',
            'alignment'
        ];
        mobileToolbar = ["bold", "italic", "underline", "ul", "ol"];
        if (mobilecheck()) {
            toolbar = mobileToolbar;
        }
        allowedTags = ['br','span','a','img','b','strong','i','strike','u','font','p','ul','ol','li','blockquote','pre','h1','h2','h3','h4','hr','table'];
        editor = new Simditor({
            textarea: $('#pageContent5'),
            placeholder: 'Message...',
            toolbar: toolbar,
            pasteImage: true,
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
/*pageContent5*/

/*pageContent6*/
(function() {
    $(function() {
        var $preview, editor, mobileToolbar, toolbar, allowedTags;
        Simditor.locale = 'en-US';
        toolbar = [
            'title',
            'bold',
            'italic',
            'underline',
            'strikethrough',
            'fontScale',
            'color',
            'ol',
            'ul',
            'blockquote',
            'code',
            'table',
            'link',
            'image',
            'hr',
            'indent',
            'outdent',
            'alignment'
        ];
        mobileToolbar = ["bold", "italic", "underline", "ul", "ol"];
        if (mobilecheck()) {
            toolbar = mobileToolbar;
        }
        allowedTags = ['br','span','a','img','b','strong','i','strike','u','font','p','ul','ol','li','blockquote','pre','h1','h2','h3','h4','hr','table'];
        editor = new Simditor({
            textarea: $('#pageContent6'),
            placeholder: 'Message...',
            toolbar: toolbar,
            pasteImage: true,
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
/*pageContent6*/

/*pageContent7*/
(function() {
    $(function() {
        var $preview, editor, mobileToolbar, toolbar, allowedTags;
        Simditor.locale = 'en-US';
        toolbar = [
            'title',
            'bold',
            'italic',
            'underline',
            'strikethrough',
            'fontScale',
            'color',
            'ol',
            'ul',
            'blockquote',
            'code',
            'table',
            'link',
            'image',
            'hr',
            'indent',
            'outdent',
            'alignment'
        ];
        mobileToolbar = ["bold", "italic", "underline", "ul", "ol"];
        if (mobilecheck()) {
            toolbar = mobileToolbar;
        }
        allowedTags = ['br','span','a','img','b','strong','i','strike','u','font','p','ul','ol','li','blockquote','pre','h1','h2','h3','h4','hr','table'];
        editor = new Simditor({
            textarea: $('#pageContent7'),
            placeholder: 'Message...',
            toolbar: toolbar,
            pasteImage: true,
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
/*pageContent7*/

/*pageContent8*/
(function() {
    $(function() {
        var $preview, editor, mobileToolbar, toolbar, allowedTags;
        Simditor.locale = 'en-US';
        toolbar = [
            'title',
            'bold',
            'italic',
            'underline',
            'strikethrough',
            'fontScale',
            'color',
            'ol',
            'ul',
            'blockquote',
            'code',
            'table',
            'link',
            'image',
            'hr',
            'indent',
            'outdent',
            'alignment'
        ];
        mobileToolbar = ["bold", "italic", "underline", "ul", "ol"];
        if (mobilecheck()) {
            toolbar = mobileToolbar;
        }
        allowedTags = ['br','span','a','img','b','strong','i','strike','u','font','p','ul','ol','li','blockquote','pre','h1','h2','h3','h4','hr','table'];
        editor = new Simditor({
            textarea: $('#pageContent8'),
            placeholder: 'Message...',
            toolbar: toolbar,
            pasteImage: true,
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
/*pageContent8*/