@extends('layouts.app')

@section('title', 'Categories')

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css">
@endpush

@push('js')
@endpush

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <x-card icon="list" title="Categories">

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-striped" id="yajra">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>

                </x-card>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('assets/backend/library/jquery/jquery-3.7.1.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>

    <script>
        $(document).ready(function() {
            categoryTable();
        });

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
                if (result.value) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "DELETE",
                        url: "/admin/categories/" + id,
                        dataType: "json",
                        success: function(response) {
                            alert('ok')
                        },
                        error: function(response) {
                            console.log(response);
                        }
                    });
                }
            })
        }
    </script>
@endpush
