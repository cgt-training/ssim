    jQuery('body').on('beforeSubmit', 'form#form_department', function() {
        var form = jQuery(this);

        if (form.find('.has-error').length) {
            return false;
        }

        jQuery.ajax({
            url: form.attr('action'),
            data: form.serialize(),
            type: 'post',
            success: function(response) {
                if (response.status == true) {
                    jQuery('div#create_department_modal').find('div.success-message').show();
                    form.find('input,select').val('');
                    jQuery.pjax.reload({ container: '#department_pjax' });
                }
            }
        });
        return false;
    });

    jQuery('button#create_department').on('click', function() {
        jQuery('div#create_department_modal').find('div.modal-body').load(jQuery(this).val(), function(responseText, textStatus, XMLHttpRequest) {
            if (XMLHttpRequest.status == 200)
                jQuery('div.department-create h1').remove();
            else
                jQuery('div#create_department_modal').find('div.modal-body').html(responseText);
        }).end().modal('show');
    });