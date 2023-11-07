<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-6">Data Inventory </h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Pengelolaan Data Inventory Ki</li>
        </ol>
        <!-- Start Flash Data -->
        <?php if (session()->getFlashdata('msg')) : ?>
            <div class="alert alert-success" role="alert">
                <?= session()->getFlashdata('msg') ?>
            </div>
        <?php endif; ?>
        <!-- End Flash Data -->
        <div class="card md-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                <?= $title ?>
            </div>


            <a class="btn btn-primary mb-3" type="button" href="/userad/create">Tambah Data Inventory</a>
            <div class="input-group mb-2">
                <!-- Filter Divisi -->
                <div class="input-group-prepend">
                    <label class="input-group-text" for="filterDivisi"> Divisi</label>
                </div>
                <select class="custom-select" id="filterDivisi" name="filterDivisi">
                    <option value="all">Semua</option>
                    <option value="1">Divisi Akuntansi</option>
                    <option value="2">Divisi Sekper</option>
                    <option value="3">Divisi Keuangan</option>
                    <option value="4">Divisi SDM</option>
                    <option value="5">Divisi Komersial</option>
                    <option value="6">Divisi Perencanaan Bisnis</option>
                </select>

                <!-- Filter Status -->
                <div class="input-group-prepend">
                    <label class="input-group-text" for="filterStatus"> Status</label>
                </div>
                <select class="custom-select" id="filterStatus" name="filterStatus">
                    <option value="all">Semua</option>
                    <option value="1">Normal</option>
                    <option value="2">Rusak</option>

                </select>

                <div class="input-group-append">
                    <button class="btn btn-primary" id="filterButton" type="button">Filter</button>
                </div>
            </div>
        </div>



        <table class="table table-bordered" id="datatablesSimple" cellspacing="0">
            <thead class="thead-white">
                <tr>
                    <th>No ID</th>
                    <th>Nama Divisi</th>
                    <th>Nama User</th>
                    <th>IP Address</th>
                    <th>Serial Number</th>
                    <th>Computer Name</th>
                    <th>Monitor</th>
                    <th>Tipe Komputer</th>
                    <th> Status Komputer</th>
                    <th>QR</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($result as $value) : ?>
                    <tr>
                        <td><?= $value['no_id'] ?></td>
                        <td data-category-id="<?= $value['master_category_id'] ?>"><?= $divisiAssociations[$value['master_category_id']] ?></td>
                        <td><?= $value['nama_user'] ?></td>
                        <td><?= $value['ip_address'] ?></td>
                        <td><?= $value['serial_number'] ?></td>
                        <td><?= $value['computer_name'] ?></td>
                        <td><?= $value['monitor'] ?></td>
                        <td><?= $value['tipe_komputer'] ?></td>
                        <td data-status-id="<?= $value['master_category_status_id'] ?>"><?= $statusAssociations[$value['master_category_status_id']] ?></td>
                        <td><img src="<?= base_url() ?>qr-code/<?= $value['no_id'] ?>_qrcode.png" alt="" width="90%"></td>
                        <td>
                            <a class="btn btn-primary rounded-pill" href="/userad/<?= $value['slug'] ?>" role="button"><i class="fas fa-eye"></i></a>
                            <a class="btn btn-warning rounded-pill" href="/userad/edit/<?= $value['slug'] ?>" role="button"><i class="fas fa-pencil-alt"></i></a>
                            <form action="/userad/<?= $value['no_id'] ?>" method="post" class="d-inline">
                                <?= csrf_field() ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger rounded-pill" role="button" onclick="return confirm('Apakah anda yakin akan menghapus data komputer?')"><i class="fas fa-trash-alt"></i></button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>


    </div>
    </div>
    </div>
    </div>

</main>
<?= $this->include('userad/modal') ?>
<?= $this->endSection() ?>