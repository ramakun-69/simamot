<?= $this->extend('auth/templates/index'); ?>
<?= $this->section('content'); ?>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card mb-4 mx-4">
        <div class="card-body">

          <?= view('Myth\Auth\Views\_message_block') ?>

          <form action="<?= route_to('register') ?>" method="post" class="user">
            <?= csrf_field() ?>

            <h1><?= lang('Auth.register') ?></h1>
            <p class="text-medium-emphasis">Create your account</p>
            <div class="input-group mb-3"><span class="input-group-text">
                <svg class="icon">
                  <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-envelope-open"></use>
                </svg></span>
              <input class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" type="email" name="email" placeholder="<?= lang('Auth.email') ?>" value="<?= old('email') ?>">
            </div>

            <div class="input-group mb-3"><span class="input-group-text">
                <svg class="icon">
                  <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-user"></use>
                </svg></span>
              <input class="form-control <?php if (session('errors.username')) : ?>is-invalid<?php endif 
              ?>" type="text" name="username" placeholder="<?= lang('Auth.username') ?>" value="<?= old('username') ?>">
            </div>

            <div class="input-group mb-3"><span class="input-group-text">
                <svg class="icon">
                  <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-user"></use>
                </svg></span>
              <input class="form-control <?php if (session('errors.name')) : ?>is-invalid<?php endif ?>" type="text" name="name" placeholder="<?= lang('Your Name') ?>" value="<?= old('name') ?>">
            </div>

            <div class="input-group mb-3"><span class="input-group-text">
                <svg class="icon">
                  <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-lock-locked"></use>
                </svg></span>
              <input type="password" class="form-control form-control-user <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" name="password" placeholder="<?= lang('Auth.password') ?>" autocomplete="off">
            </div>
            <div class="input-group mb-4"><span class="input-group-text">
                <svg class="icon">
                  <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-lock-locked"></use>
                </svg></span>
              <input type="password" name="pass_confirm" class="form-control <?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.repeatPassword') ?>" autocomplete="off">
            </div>
            <button type="submit" class="btn btn-block btn-success"><?= lang('Create Account') ?></button>
            <p><a class="small" href="<?= route_to('login') ?>"><?= lang('Auth.alreadyRegistered') ?> <?= lang('Auth.signIn') ?></a>
        </div>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>