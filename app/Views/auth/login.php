<?= $this->extend('auth/templates/index') ?>
<?= $this->section('content') ?>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-lg-8">
      <div class="card-group d-block d-md-flex row">
        <div class="card col-md-7 p-4 mb-0">
          <div class="card-body">

            <?= view('Myth\Auth\Views\_message_block') ?>

            <form action="<?= route_to('login') ?>" method="post" class="user">
              <?= csrf_field() ?>

              <h1><?= lang('Auth.loginTitle') ?></h1>
              <p class="text-medium-emphasis">Sign In to your account</p>

              <?php if ($config->validFields === ['email']) : ?>
                <div class="input-group mb-3"><span class="input-group-text">
                    <svg class="icon">
                      <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-user"></use>
                    </svg></span>
                  <input type="Email" class="form-control form-control-lg" <?php if (session('errors.login')) : ?>is-invalid<?php endif ?> name="login" placeholder="<?= lang('Auth.email') ?>">
                  <div class="invalid-feedback">
                    <?= session('errors.login') ?>
                  </div>
                </div>

              <?php else : ?>
                <div class="input-group mb-3"><span class="input-group-text">
                    <svg class="icon">
                      <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-user"></use>
                    </svg></span>
                  <input class="form-control form-control-lg" <?php if (session('errors.login')) : ?>is-invalid<?php endif ?> type="text" name="login" placeholder="<?= lang('Auth.emailOrUsername') ?>">
                  <div class="invalid-feedback">
                    <?= session('errors.login') ?>
                  </div>
                </div>

              <?php endif; ?>
              <div class="input-group mb-4"><span class="input-group-text">
                  <svg class="icon">
                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-lock-locked"></use>
                  </svg></span>
                <input class="form-control form-control-lg" <?php if (session('errors.password')) : ?>is-invalid<?php endif ?> type="password" name="password" placeholder="<?= lang('Auth.password') ?>">
                <div class="invalid-feedback">
                  <?= session('errors.password') ?>
                </div>
              </div>
              <?php if ($config->allowRemembering) : ?>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" name="remember" <?php if (old('remember')) : ?> checked <?php endif ?> class="form-check-input">
                    <?= lang('Auth.rememberMe') ?>
                  </label>
                </div>
              <?php endif; ?>

              <style>
              .btn-primary {
                  background-color: #00A1D1;
                  color: #fff;
                  border: 1px solid #00A1D1; /* Warna garis tepi awal */
              }

              .btn-primary:hover {
                  border: 1px solid #00A1D1; /* Warna garis tepi saat kursor diarahkan */
              }

              .btn-primary:active {
                  border: 1px solid #00A1D1; /* Warna garis tepi saat tombol diklik */
              }
              </style>

              <div class="row">
                <div class="col-6">
                  <button type="submit" class="btn btn-block btn-primary"><?= lang('Auth.loginAction') ?></button>
                </div>



              </div>
          </div>
        </div>

        <div class="card col-md-5 text-white bg-white py-5">
  <div class="card-body text-center">
    <div>

    </div>
  </div>
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