<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-6">Data Inventory Divisi  i</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Pengelolaan Data Inventory Divisi   K</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                <?= $title ?>
            </div>
            <div class="card-body">
                <!-- Form Tambah SDM -->
                <form action="/userad/create" method="POST" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <div class="mb-3 row">
                        <label for="master_category_id" class="col-sm-2 col-form-label">Nama Divisi</label>
                        <div class="col-sm-5">
                            <select type="text" class="form-control" id="master_category_id" name="master_category_id">
                                <?php foreach ($kategori as $value) : ?>
                                    <option value="<?= $value['master_category_id'] ?>">
                                        <?= $value['nama_divisi'] ?> 
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="nama_user" class="col-sm-2 col-form-label">Nama User</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control <?= $validation->hasError('nama_user') ? 'is-invalid' : '' ?>" id="nama_user" name="nama_user" value="<?= old('nama_user') ?>">
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $validation->getError('nama_user') ?>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="ip_address" class="col-sm-2 col-form-label">Ip Address</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control <?= $validation->hasError('ip_address') ? 'is-invalid' : '' ?>" id="ip_address" name="ip_address" value="<?= old('ip_address') ?>">
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $validation->getError('ip_address') ?>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="serial_number" class="col-sm-2 col-form-label">Serial Number PC</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control <?= $validation->hasError('serial_number') ? 'is-invalid' : '' ?>" id="serial_number" name="serial_number" value="<?= old('serial_number') ?>">
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $validation->getError('serial_number') ?>
                            </div>
                        </div>
                        <label for="computer_name" class="col-sm-2 col-form-label">Computer Name</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control <?= $validation->hasError('computer_name') ? 'is-invalid' : '' ?>" id="computer_name" name="computer_name" value="<?= old('computer_name') ?>">
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $validation->getError('computer_name') ?>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="monitor" class="col-sm-2 col-form-label">Monitor</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control <?= $validation->hasError('monitor') ? 'is-invalid' : '' ?>" id="monitor" name="monitor" value="<?= old('monitor') ?>">
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $validation->getError('monitor') ?>
                            </div>
                        </div>
                        <label for="tipe_komputer" class="col-sm-2 col-form-label">Tipe Komputer</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control <?= $validation->hasError('tipe_komputer') ? 'is-invalid' : '' ?>" id="tipe_komputer" name="tipe_komputer" value="<?= old('tipe_komputer') ?>">
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $validation->getError('tipe_komputer') ?>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="master_category_status_id" class="col-sm-2 col-form-label">Status Komputer</label>
                        <div class="col-sm-5">
                            <select type="text" class="form-control" id="master_category_status_id" name="master_category_status_id">
                                <?php foreach ($status as $value) : ?>
                                    <option value="<?= $value['master_category_status_id'] ?>">
                                        <?= $value['nama_kategori'] ?> 
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                                            <div class="mb-3 row">
                            <label for="catatan" class="col-sm-2 col-form-label"> Catatan </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="catatan" name="catatan" value="<?= old('catatan') ?>">
                            </div>
                        </div>
                                        
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button class="btn btn-primary me-md-2 rounded-pill" type="submit">Simpan</button>
                        <button class="btn btn-danger rounded-pill" type="reset">Batal</button>
                        <a class="btn btn-dark rounded-pill" type="button" href="/userad">Kembali</a>
                    </div>
                </form>
                <!-- -->
            </div>
        </div>
    </div>
</main>
<?= $this->endSection() ?>
