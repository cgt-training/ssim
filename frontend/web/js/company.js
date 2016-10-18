   //submit company form
   jQuery('body').on('beforeSubmit', 'form#form_company', function() {
       var form = jQuery(this);

       if (form.find('.has-error').length) {
           return false;
       }
       var formData = new FormData($('form#form_company')[0]);
       jQuery.ajax({
           url: form.attr('action'),
           data: formData,
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
           },
           cache: false,
           contentType: false,
           processData: false
       });
       return false;
   });

   //on grid view load complete bind elements
   $(document).on('pjax:complete', function() {
       lateBinding();
   });

   //handle company delete request here
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
                           //success alert
                           bootbox.alert({
                               message: "Item deleted",
                               className: 'bootbox-success',
                               backdrop: true
                           });
                           //refresh gridview 
                           pjax_container = jQuery('div[data-pjax-container]').attr('id');
                           jQuery.pjax.reload({ container: '#' + pjax_container });
                       }
                   });
               }
           }
       });
   };

   //handle view load on action buttons click
   var handleViewLoad = function(e) {
       e.preventDefault();
       var el = jQuery(this);

       jQuery.post(el.attr('href'), {}, function(response) {
           jQuery('div#main_content').html(response);
           lateBinding();
       });
   }

   //bind elements after rendering
   lateBinding = function() {
       // create company button handler
       jQuery('button#create_company').on('click', function() {
           jQuery('div#create_company_modal').find('div.modal-body').load(jQuery(this).val(), function(responseText, textStatus, XMLHttpRequest) {
               if (XMLHttpRequest.status == 200)
                   jQuery('div.company-create h1').remove();
               else
                   jQuery('div#create_company_modal').find('div.modal-body').html(responseText);
           }).end().modal('show');
       });

       //back to grid view handler
       jQuery('button.back-button').on('click', function() {
           var el = jQuery(this);

           jQuery.post(el.attr('data-url'), {}, function(response) {
               jQuery('div#main_content').html(response);
               lateBinding();
           });
       });

       //view and update action button handler
       jQuery('table').on('click', 'a[title]', handleViewLoad);

       //handler for update  button in update view
       jQuery('a.update-company').on('click', handleViewLoad);

       //handler for company list button
       jQuery('a#company_list').on('click', handleViewLoad);

       //handler for delete action button in grid view
       jQuery('a.delete-company').on('click', handleDeleteRequest);

       //handler for delete button in update view
       jQuery('table').on('click', 'a.delete-request', handleDeleteRequest);
   }

   //on page load call to bind all
   lateBinding();