function quickadAlert(alert) {
    var types = {
        success : 'alert-success',
        error   : 'alert-danger'
    };

    // Check if there are messages in alert.
    var not_empty = false;
    for (var type in alert) {
        if (types.hasOwnProperty(type) && alert[type].length) {
            not_empty = true;
            break;
        }
    }

    if (not_empty) {
        var $container = jQuery('#quickad-alert');
        if ($container.length == 0) {
            $container = jQuery('<div id="quickad-alert" class="quickad-alert"></div>').appendTo('#quickad-tbs');
        }
        for (var type in alert) {
            var class_name;
            if (types.hasOwnProperty(type)) {
                class_name = types[type];
            } else {
                continue;
            }
            alert[type].forEach(function (message) {
                var $alert = jQuery('<div class="alert"><i class="alert-icon"></i><button type="button" class="close" data-dismiss="alert"></button></div>');
                $alert
                    .addClass(class_name)
                    .append('<b class="quickad-margin-left-sm quickad-vertical-middle">' + message + '</b>')
                    .appendTo($container);

                if (type == 'success') {
                    setTimeout(function() {
                        $alert.remove();
                    }, 5000);
                }
            });
        }
    }
}