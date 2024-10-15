let submit_method;

$(document).ready(function () {
    categoryTable();
});

// datatable serverside
function categoryTable() {
    $('#yajra').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        // pageLength: 20, // set default records per page
        ajax: "/admin/categories/serverside",
        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex'
            },
            {
                data: 'name',
                name: 'name'
            },
            {
                data: 'slug',
                name: 'slug'
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
const modalCategory = () => {
    resetForm('#formCategory');
    resetValidation();
    $('#modalCategory').modal('show');
    $('.modal-title').html('<i class="fa fa-plus"></i> Create Category');
    $('.btnSubmit').html('<i class="fa fa-save"></i> Save');
}

// form edit
const editData = (e) => {
    let id = e.getAttribute('data-id');

    startLoading();
    resetForm('#formCategory');
    resetValidation();

    $.ajax({
        type: "GET",
        url: "/admin/categories/" + id,
        success: function (response) {
            let parsedData = response.data;

            $('#id').val(parsedData.uuid);
            $('#name').val(parsedData.name);
            $('#modalCategory').modal('show');
            $('.modal-title').html('<i class="fa fa-edit"></i> Edit Category');
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
        text: "Do you want to delete this category?",
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
                url: "/admin/categories/" + id,
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
$('#formCategory').on('submit', function (e) {
    e.preventDefault();

    startLoading();

    let url, method;
    url = '/admin/categories';
    method = 'POST';

    const inputForm = new FormData(this);

    if (submit_method == 'edit') {
        url = '/admin/categories/' + $('#id').val();
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
            $('#modalCategory').modal('hide');
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
