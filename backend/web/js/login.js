jQuery('body').on('submit', 'form', function() {
    form = jQuery(this);

    if (form.find('.has-error').length) {
        return false;
    }

    jQuery.ajax({
        url: form.attr('action'),
        data: form.serialize(),
        type: 'post',
        success: function(response) {
            if (response.status == true) {
                location.href = response.redirect_url;
            } else {
                if (response.error != null) {
                    jQuery('div.login-box-body>p').after(response.error);
                }
            }
        },
        beforeSend: function() {
            jQuery('div.alert').remove();
        }
    });
    return false;
});

$('input').iCheck({
    checkboxClass: 'icheckbox_square-purple',
    radioClass: 'iradio_square-purple',
    increaseArea: '20%' // optional
});