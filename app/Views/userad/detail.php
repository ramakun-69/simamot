<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-6">Data Inventory Divisi </h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Pengelolaan Data Inventory Divisi ksi</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                <?= $title ?>
            </div>
            <div class="card-body">
                <!-- Isi Detail -->
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <!-- Tambahkan gambar atau QR Code di sini jika diperlukan -->
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title"><?= $result['nama_user'] ?></h5>
                                <p class="card-text"><i class="fas fa-user"></i> Nama Divisi: <?= $result['nama_divisi'] ?></p>
                                <p class="card-text"><i class="fas fa-globe"></i> IP Address: <?= $result['ip_address'] ?></p>
                                <p class="card-text"><i class="fas fa-desktop"></i> Computer Name: <?= $result['computer_name'] ?></p>
                                <p class="card-text"><i class="fas fa-desktop"></i> Monitor: <?= $result['monitor'] ?></p>
                                <p class="card-text"><i class="fas fa-laptop"></i> Tipe Komputer: <?= $result['tipe_komputer'] ?></p>
                                <p class="card-text"><i class="fas fa-check-circle"></i> Status: <?= $result['nama_kategori'] ?></p>
                                <p class="card-text"><i class="fas fa-desktop"></i> Catatan : <?= $result['catatan'] ?></p>
                                <div class="d-grid gap-2 d-md-block">
                                    <a class="btn btn-dark" type="button" href="/userad">Kembali</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- -->
            </div>
        </div>
    </div>
</main>
<?= $this->endSection() ?>
