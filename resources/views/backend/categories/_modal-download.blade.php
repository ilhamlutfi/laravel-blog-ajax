<!-- Modal -->
<div class="modal fade" id="modalImport" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Import Data Category</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('admin.categories.import') }}" method="POST" id="formImport" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="file_import">File <small>(csv, xls, xlsx)</small></label>
                <input type="file" name="file_import" id="file_import" class="form-control">
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" form="formImport" class="btn btn-primary btnSubmit">Submit</button>
      </div>
    </div>
  </div>
</div>
