$(function() {
    $('.input-daterange input').each(function() {
        $(this).datepicker({
            format: 'yyyy-mm-dd'
        });
    })

    $('#generatePassword').click(function() {
        var $this = $(this);

        $.ajax({
            url: $(this).parents('form').attr('action'),
            type: 'get',
            data: {
                generatePassword: 1
            },
            dataType: 'text',
            success: function(response) {
                $this.prev().val(response);
            }
        });
    });

    $('#changePassword').change(function() {
        if ($(this).is(':checked')) {
            $('#passwordField').show();
        } else {
            $('#passwordField').hide();
        }
    }).change();
});