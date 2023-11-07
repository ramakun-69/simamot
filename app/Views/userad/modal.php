<!-- Modal Import -->
<div class="modal fade" id="modalImport" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalToggleLabel">IMPORT Data User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- FORM IMPORT -->
                <form action="/userad/import" method="POST" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <div class="mb-3 row">
                        <label for="file" class="col-sm-3 col-form-label">File Excel</label>
                        <div class="col-sm-9">
                            <input type="file" class="form-control" name="file" accept=".xls,.xlsx">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="file" class="col-sm-3"></label>
                        <div class="col-sm-9">
                            <button class="btn btn-primary me-md-2" type="submit">Import</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <!-- Tambahkan tombol Close jika perlu -->
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
document.querySelector('#modalImportButtonUserad').addEventListener('click', function() {
    $('#modalImport').modal('show');
});

</script>