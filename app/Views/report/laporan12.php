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

                </div>
            </div>
        </div>

    </main>
    <?= $this->endSection() ?>