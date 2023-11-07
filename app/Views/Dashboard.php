<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>

<div class="container-fluid px-4">

<div class="col-lg-12 mb-4 md-4">
    <div class="card shadow mb-4" style="width: 100%; margin: 0;"> <!-- Setel lebar 100% dan hilangkan margin -->
        <style>
            .carousel-item {
                height: 35rem;
                background: #000;
                color: white;
                position: relative;
            }

            .container {
                position: absolute;
                bottom: 0;
                left: 0;
                right: 0.5;
                padding-bottom: 50px;
            }

            .overlay-image {
                position: absolute;
                bottom: 0;
                left: 0;
                right: 0;
                top: 0;
                background-image: center;
                background-size: cover;
                opacity: 0.5;
            }
        </style>

        <div id="myCarousel" class="carousel slide carousel-fade" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active" data-interval="2000">
                    <div class="overlay-image" style="background-image:url(img/kom1.webp);"></div>
                    <div class="container">
                        <h1>Dashboard</h1>
                        <p> Inventory  Krakatau Baja Konstruksi</p>
                    </div>
                </div>
                <div class="carousel-item" data-interval="2000">
                    <div class="overlay-image" style="background-image:url(img/kom2.jpg);"></div>
                    <div class="container">
                        <h1>Dashboard</h1>
                        <p> Inventory  Krakatau Baja Konstruksi</p>
                    </div>
                </div>
                <div class="carousel-item" data-interval="2000">
                <div class="overlay-image" style="background-image:url(img/kom3.jpg);"></div>
                    <div class="container">
                        <h1>Dashboard</h1>
                        <p> Inventory  Krakatau Baja Konstruksi</p>
                    </div>
                </div>
            </div>
            <a href="#myCarousel" class="carousel-control-prev" role="button" data-slide="prev">
                <span class="sr-only">Previous</span>
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            </a>
            <a href="#myCarousel" class="carousel-control-next" role="button" data-slide="next">
                <span class="sr-only">Next</span>
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
            </a>
        </div>
    </div>
</div>

    <!-- Content Row -->
    <div class="row">
       
    <div class="col-lg-6 mb-4">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> </h6>
        </div>
        
        <div class="card-body">
        <div class="text-center">
            <div class="inner">
                <h5 class="card-title">
                    <i class="fas fa-user"></i> <!-- Ikon pengguna -->
                    <?= $title ?>
                </h5>
                <h1 class="text-primary"><?= $jumlahNamaUser ?></h1>
                <p>User</p>
                <a href="akutansi" class="btn btn-primary">Lihat Detail</a>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="col-lg-6 mb-4">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> </h6>
        </div>
        <div class="card l-bg-cherry">
        <div class="card-body">
        <div class="text-center">
            <div class="inner">
                <h5 class="card-title">
                    <i class="fas fa-user"></i> <!-- Ikon pengguna -->
                    <?= $title ?>
                </h5>
                <h1 class="text-primary"><?= $jumlahNamaUser ?></h1>
                <p>Total Jumlah User Dari Divisi Akutansi</p>
                <a href="akutansi" class="btn btn-primary">Lihat Detail</a>
                </div>
            </div>
        </div>
    </div>
</div>






</script>

<?= $this->endSection() ?>