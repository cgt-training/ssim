$(function() {
    jQuery('button#create_branch').on('click', function() {
        jQuery('div#create_branch_modal').find('div.modal-body').load(jQuery(this).val(), function(responseText, textStatus, XMLHttpRequest) {
            if (XMLHttpRequest.status == 200)
                jQuery('div.branches-create h1').remove();
            else
                jQuery('div#create_branch_modal').find('div.modal-body').html(responseText);
        }).end().modal('show');
    });

    jQuery('button#create_company').on('click', function() {
        jQuery('div#create_company_modal').find('div.modal-body').load(jQuery(this).val(), function(responseText, textStatus, XMLHttpRequest) {
            if (XMLHttpRequest.status == 200)
                jQuery('div.company-create h1').remove();
            else
                jQuery('div#create_company_modal').find('div.modal-body').html(responseText);
        }).end().modal('show');
    });

    jQuery('button#create_department').on('click', function() {
        jQuery('div#create_department_modal').find('div.modal-body').load(jQuery(this).val(), function(responseText, textStatus, XMLHttpRequest) {
            if (XMLHttpRequest.status == 200)
                jQuery('div.department-create h1').remove();
            else
                jQuery('div#create_department_modal').find('div.modal-body').html(responseText);
        }).end().modal('show');
    });
});