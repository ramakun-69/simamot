<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<main>
    <div class="container-fluid">
        <h1 class="mt-4">DATA USER</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Pengelolaan Data User</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                <?= $title ?>
            </div>
            <div class="card-body">
                <!-- Form Tambah Buku -->
                <?= view('Myth\Auth\Views\_message_block') ?>
                <form action="<?= route_to('register') ?>" method="post">
                    <?= csrf_field() ?>
                    
                            <div class="form-floating mb-3">
                                <input class="form-control <?php if (session('errors.name')) : ?>is-invalid<?php
                                 endif ?>" name="name" type="text" placeholder="Enter Your Name" value="<?=
                                 old('name') ?>" />
                                <label for="inputName"></label>
                            </div>
                        
                    <div class="form-floating mb-3">
                        <input class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php
                        endif ?>" name="email" type="email" placeholder="<?= lang('Auth.email') ?>" value="<?=
                        old('email') ?>" />
                        <label for="inputEmail"></label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control <?php if (session('errors.username')) : ?>is-invalid<?php
                        endif ?>" name="username" placeholder="<?= lang('Auth.username') ?>" value="<?=
                        old('username') ?>" />
                        <label for="inputEmail"></label>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-floating mb-3 md-md-0">
                                <input type="password" name="password" class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.password') ?>" autocomplete="off" />
                                <label for="inputPassword"></label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3 mb-md-0">
                                <input type="password" name="pass_confirm" class="form-control <?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>" placeholder="<?=lang('Auth.repeatPassword') ?>" autocomplete="off" />
                                <label for="inputPasswordConfirm"></label>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 mb-0">
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-block" href="login.html"><?= lang('Auth.register') ?></button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-footer text-center py-3">
                <div class="small"><?= lang('Auth.alreadyRegistered') ?> <a href="<?= route_to('login') ?>"><?=lang('Auth.signIn') ?></a></div>
                <!-- -->
            </div>
        </div>
    </div>
</main>
<?= $this->endSection() ?>