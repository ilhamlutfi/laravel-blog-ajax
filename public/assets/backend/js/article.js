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
        if (result.value) {
            startLoading();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "DELETE",
                url: "/admin/articles/" + id,
                dataType: "json",
                success: function (response) {
                    stopLoading();
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
