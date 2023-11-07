<main><?= $this->extend('layout/template') ?>

    <?= $this->section('content') ?>
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Laporan Inventory </h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active"> Laporan Inventory</li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    <?= $title ?>
                </div>
                <div class="card-body">
                    <a class="btn btn-primary mb-3" id="btn-export-pdf" href="<?= site_url('report/exportpdf') ?>">Export PDF</a>
                    <a class="btn btn-primary mb-3" id="btn-export-akutansi" style="display: none;" href="<?= site_url('report/exportpdfAkutansi?id=') ?>">Export PDF</a>






                    <form method="post" id="filter-form">
                        <!-- Filter checkboxes -->
                        <div class="form-check">
                            <?php foreach ($divisiData as $divisi) { ?>
                                <input class="form-check-input" type="checkbox" name="divisi[]" value="<?= $divisi['master_category_id'] ?>">
                                <label class="form-check-label"><?= $divisi['nama_divisi'] ?></label> <br>
                            <?php } ?>
                        </div>
                        <!-- Tambahkan form checkboxes untuk filter lainnya di sini -->

                        <!-- Elemen input tersembunyi untuk menyimpan data filter divisi -->
                        <input type="hidden" id="selectedDivisions" name="selectedDivisions" value="[]">
                    </form>

                    <table id="datatablesSimple" class="table table-striped">
                        <thead>
                            <tr>
                                <th>No ID</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Nama Divisi</th>
                                <th>Nama User</th>
                                <th>IP Address</th>
                                <th>Serial Number</th>
                                <th>Computer Name</th>
                                <th>Monitor</th>
                                <th>Tipe Komputer</th>
                                <th>Status Komputer</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($result as $value) : ?>
                                <tr>
                                    <td><?= $value['no_id'] ?></td>
                                    <td><?= $value['created_at'] ?></td>
                                    <td><?= $value['updated_at'] ?></td>
                                    <td data-category-id="<?= $value['master_category_id'] ?>"><?= $divisiAssociations[$value['master_category_id']] ?></td>
                                    <td><?= $value['nama_user'] ?></td>
                                    <td><?= $value['ip_address'] ?></td>
                                    <td><?= $value['serial_number'] ?></td>
                                    <td><?= $value['computer_name'] ?></td>
                                    <td><?= $value['monitor'] ?></td>
                                    <td><?= $value['tipe_komputer'] ?></td>
                                    <td data-status-id="<?= $value['master_category_status_id'] ?>"><?= $statusAssociations[$value['master_category_status_id']] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </main>
    <?= $this->endSection() ?>