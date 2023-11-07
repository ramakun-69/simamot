<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-6">DATA USERS</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Pengelolaan Data User</li>
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
            <div class="card-body">
                <div class="table-responsive">
                    <a class="btn btn-primary mv-3" type="button" href="/users/create">Tambah User</a>
                    <table class="table table-bordered" id="datatablesSimple" width="100%" cellspacing="0">
                        <thead class="thead-dark">
                            </div>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($result as $row) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $row->name ?></td>
                                    <td><?= $row->username  ?></td>
                                    <td><?= $row->email  ?></td>
                                    <td>
                                        <a class="btn btn-primary rounded-pill" href="<?= base_url(); ?>/users/<?= $row->id ?>" role="button">Detail </a>
                                        <a href="<?= base_url(); ?>/users/edit/<?= $row->id ?>" class="btn btn-warning rounded-pill" title="Ubah Password" >Ubah</a>
                                        <form action="/users/<?= $row->id ?>" method="post" class="d-inline">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-danger rounded-pill" role="button" onclick="return confirm('Apakah anda yakin?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</main>

<?= $this->endSection() ?>