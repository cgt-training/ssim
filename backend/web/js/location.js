    jQuery('body').on('beforeSubmit', 'form#form_location', function() {
        var form = jQuery(this);

        if (form.find('.has-error').length) {
            return false;
        }

        jQuery.ajax({
            url: form.attr('action'),
            data: form.serialize(),
            type: 'post',
            dataType: 'json',
            success: function(response) {
                if (response.status == true) {
                    jQuery('div#create_location_modal').find('div.success-message').show();
                    form.find('input,select').val('');
                    jQuery.pjax.reload({ container: '#location_pjax' });
                }
            }
        });
        return false;
    });

    jQuery('button#create_location').on('click', function() {
        jQuery('div#create_location_modal').find('div.modal-body').load(jQuery(this).val(), function(responseText, textStatus, XMLHttpRequest) {
            if (XMLHttpRequest.status == 200)
                jQuery('div.location-create h1').remove();
            else
                jQuery('div#create_location_modal').find('div.modal-body').html(responseText);
        }).end().modal('show');
    });