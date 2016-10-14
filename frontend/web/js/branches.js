    jQuery('body').on('beforeSubmit', 'form#form_branches', function() {
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
                    jQuery('div#create_branch_modal').find('div.success-message').show();
                    form.find('input,select').val('');
                    jQuery.pjax.reload({ container: '#branches_pjax' });
                }
            }
        });
        return false;
    });

    jQuery('button#create_branch').on('click', function() {
        jQuery('div#create_branch_modal').find('div.modal-body').load(jQuery(this).val(), function(responseText, textStatus, XMLHttpRequest) {
            if (XMLHttpRequest.status == 200)
                jQuery('div.branches-create h1').remove();
            else
                jQuery('div#create_branch_modal').find('div.modal-body').html(responseText);
        }).end().modal('show');
    });