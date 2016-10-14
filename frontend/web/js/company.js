    jQuery('body').on('beforeSubmit', 'form#form_company', function() {
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
                    if (jQuery('div.company-create').length) {
                        jQuery('div#create_company_modal').find('div.success-message').show();
                        form.find('input,select').val('');
                        jQuery.pjax.reload({ container: '#company_pjax' });
                    } else {
                        jQuery('div#main_content').html(response.view);
                    }
                    lateBinding();
                }
            }
        });
        return false;
    });

    $(document).on('pjax:complete', function() {
        lateBinding();
    });

    var handleDeleteRequest = function(e) {
        e.preventDefault();
        var el = jQuery(this);
        bootbox.confirm({
            message: "Are you sure you want to delete this item?",
            buttons: {
                confirm: {
                    label: 'Yes',
                    className: 'btn-success'
                },
                cancel: {
                    label: 'No',
                    className: 'btn-danger'
                }
            },
            callback: function(result) {
                if (result == true) {
                    $.post(el.attr('href'), {}, function(response) {
                        if (response.status == true) {
                            bootbox.alert({
                                message: "Item deleted",
                                className: 'bootbox-success',
                                backdrop: true
                            });
                            pjax_container = jQuery('div[data-pjax-container]').attr('id');
                            jQuery.pjax.reload({ container: '#' + pjax_container });
                        }
                    });
                }
            }
        });
    };

    lateBinding = function() {
        jQuery('button#create_company').on('click', function() {
            jQuery('div#create_company_modal').find('div.modal-body').load(jQuery(this).val(), function(responseText, textStatus, XMLHttpRequest) {
                if (XMLHttpRequest.status == 200)
                    jQuery('div.company-create h1').remove();
                else
                    jQuery('div#create_company_modal').find('div.modal-body').html(responseText);
            }).end().modal('show');
        });

        jQuery('button.back-button').on('click', function() {
            var el = jQuery(this);

            jQuery.post(el.attr('data-url'), {}, function(response) {
                jQuery('div#main_content').html(response);
                lateBinding();
            });
        });

        jQuery('table').on('click', 'a[title]', function(e) {
            e.preventDefault();
            var el = jQuery(this);

            jQuery.post(el.attr('href'), {}, function(response) {
                jQuery('div#main_content').html(response);
                lateBinding();
            });
        });

        jQuery('table').on('click', 'a.delete-request', handleDeleteRequest);
    }

    lateBinding();