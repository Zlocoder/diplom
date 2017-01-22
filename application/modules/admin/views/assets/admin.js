var cssFiles = [];
var jsFiles = [];

function initContent() {
    $('.form-group .generate-password').click(function() {
        var text = "";
        var chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!?.,;:@#$%^&*+-=/\\()[]<>`~";

        for( var i=0; i < 8; i++ ) {
            text += chars.charAt(Math.floor(Math.random() * chars.length));
        }

        $(this).siblings('.password').val(text).blur();
    });

    $('.form-group .change-password').click(function() {
        $(this).addClass('hidden').siblings('.password').removeClass('hidden').siblings('.generate-password').removeClass('hidden');
    });

    $('.form-group .file-deletable').on('fileclear', function(event) {
        $(this).parents('form').find('.file-deleter').val('1');
    });
}

$(function() {
    $('head link[rel=stylesheet]').each(function() {
        if (!$.inArray())
    });

    $(document).on('pjax:start', function() {
        $('body').addClass('loading');
    });

    $(document).on('pjax:beforeReplace', function() {
       return false;
    });

    $(document).on('pjax:end', function() {
        $('body').removeClass('loading');

        initContent();
    });

    initContent();
});
