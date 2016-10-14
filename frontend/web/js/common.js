$(function() {

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

    jQuery('table').on('click', 'a.delete-request', handleDeleteRequest);

    $(document).on('pjax:complete', function() {
        jQuery('table').on('click', 'a.delete-request', handleDeleteRequest);
    });

    $(document).ajaxStart(function() {
        jQuery('div.loader').show();
    });

    $(document).ajaxComplete(function() {
        jQuery('div.loader').hide();
    });

    $(document).ajaxError(function() {
        jQuery('div.loader').hide();
    });

});