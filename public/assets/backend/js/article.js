let submit_method;

$(document).ready(function () {
    tagTable();
});

// datatable serverside
function tagTable() {
    $('#yajra').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        // pageLength: 20, // set default records per page
        ajax: "/admin/articles/serverside",
        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex'
            },
            {
                data: 'title',
                name: 'title'
            },
            {
                data: 'category_id',
                name: 'category_id'
            },
            {
                data: 'tag_id',
                name: 'tag_id'
            },
            {
                data: 'views',
                name: 'views'
            },
            {
                data: 'published',
                name: 'published'
            },
            {
                data: 'action',
                name: 'action',
                orderable: true,
                searchable: true
            },
        ]
    });
};

// form create
const modalTag = () => {
    submit_method = 'create';
    resetForm('#formTag');
    resetValidation();
    $('#modalTag').modal('show');
    $('.modal-title').html('<i class="fa fa-plus"></i> Create Tag');
    $('.btnSubmit').html('<i class="fa fa-save"></i> Save');
}

// form edit
const editData = (e) => {
    let id = e.getAttribute('data-id');

    startLoading();
    resetForm('#formTag');
    resetValidation();

    $.ajax({
        type: "GET",
        url: "/admin/tags/" + id,
        success: function (response) {
            let parsedData = response.data;

            $('#id').val(parsedData.uuid);
            $('#name').val(parsedData.name);
            $('#modalTag').modal('show');
            $('.modal-title').html('<i class="fa fa-edit"></i> Edit Tag');
            $('.btnSubmit').html('<i class="fa fa-save"></i> Save');

            submit_method = 'edit';

            stopLoading();
        },
        error: function (jqXHR, response) {
            console.log(jqXHR.responseText);
            toastError(jqXHR.responseText);
        }
    });
}

const deleteData = (e) => {
    let id = e.getAttribute('data-id');

    Swal.fire({
        title: "Are you sure?",
        text: "Do you want to delete this tag?",
        icon: "question",
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Delete",
        cancelButtonText: "Cancel",
        allowOutsideClick: false,
        showCancelButton: true,
        showCloseButton: true
    }).then((result) => {
        startLoading();

        if (result.value) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "DELETE",
                url: "/admin/tags/" + id,
                dataType: "json",
                success: function (response) {
                    reloadTable();

                    toastSuccess(response.message);
                },
                error: function (response) {
                    console.log(response);
                }
            });
        }
    })
}

// save data
$('#formTag').on('submit', function (e) {
    e.preventDefault();

    startLoading();

    let url, method;
    url = '/admin/tags';
    method = 'POST';

    const inputForm = new FormData(this);

    if (submit_method == 'edit') {
        url = '/admin/tags/' + $('#id').val();
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
            $('#modalTag').modal('hide');
            reloadTable();
            resetValidation();
            stopLoading();
            toastSuccess(response.message);
        },
        error: function (jqXHR, response) {
            console.log(response.message);
            toastError(jqXHR.responseText);
        }
    });
})
