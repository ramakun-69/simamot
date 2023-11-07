<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
    <div class="container-fluid px-4">
    <div class= "mb-4">
        <h1 class="col-9">DATA USER</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Pengelolaan Data USER</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                <?= $title ?>
            </div>
            <div class="card-body">
                <div class="card mb-4">
                    <div class="row lg-12">
                        <div class="col lg-12 md-8">
                            <div class="card-body">
                                <p class="card-text">Name:<?= $result->name ?></p>
                                <p class="card-text">Username:<?= $result->username ?></p>
                                <p class="card-text">Email: <?= $result->email ?></p>
                                <div class="d-grid gap-2 d-md-block">
                                    <a class="btn btn-success rounded-pill" type="button" href="/users">Kembali</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>

<?= $this->endSection() ?>