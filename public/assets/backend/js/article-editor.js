let submit_method;

$(document).ready(function () {
     // select 2
     $('.select-multi').select2({
         theme: "bootstrap-5",
         width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
         placeholder: $(this).data('placeholder'),
         closeOnSelect: false,
         allowClear: true,
     });

    $('.select-single').select2({
        theme: "bootstrap-5",
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
        placeholder: $(this).data('placeholder'),
    });
 });


 // save data
 $('#formArticle').on('submit', function (e) {
     e.preventDefault();

     startLoading();

     let url, method;
     url = '/admin/articles';
     method = 'POST';

     const inputForm = new FormData(this);

     if (submit_method == 'edit') {
         url = '/admin/articles/' + $('#id').val();
         inputForm.append('_method', 'PUT');
     }

     $.ajax({
         headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         type: method,
         url: url,
         data: inputForm,
         contentType: false,
         processData: false,
         success: function (response) {
             resetValidation();
             stopLoading();

             Swal.fire({
                 icon: 'success',
                 title: "Success!",
                 text: response.message,
             }).then(result => {
                 if (result.isConfirmed) {
                     window.location.href = '/admin/articles';
                 }
             })
         },
         error: function (jqXHR, response) {
             console.log(response.message);
             toastError(jqXHR.responseText);
         }
     });
 })
