<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SIPS | Login</title>

    <!-- Bootstrap -->
    <link href="<?= base_url()?>template/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?= base_url()?>template/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?= base_url()?>template/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="<?= base_url()?>template/vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?= base_url()?>template/build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      
      <div class="login_wrapper">
        <div class="animate form login_form" style="border: 0 solid rgba(0,0,0,.125); border-radius:0.25rem; padding: 15px; background-color: #fff;">
          <?php validation_list_errors() ?>
          <section class="login_content" style="padding-top: 5px;">
          <?php if(session()->getFlashdata('gagal')) : ?>
            <div class="alert alert-danger alert-dismissible " role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <strong>Gagal!</strong> <?= session()->getFlashdata('gagal'); ?>.
            </div>
        <?php endif; ?>
            <form method="POST" action="<?= base_url('/auth/mahasiswa/proses'); ?>">
            <?= csrf_field(); ?>
            <div>
              <img src="<?=base_url('template/');?>src/img/unpkopsuratm.jpg" alt="logo" width="50" class="shadow-light rounded-circle mb-1 mt-2" >
            </div>
            <h1>Login E-Office FIP</h1>
              <div>
                <input type="text" class="form-control <?= validation_show_error('username') ?  'is-invalid' : null; ?>"  <?= validation_show_error("username") ? "style=border-color:red;margin-bottom:0;" : null; ?>  placeholder="Username/ NIM"  name="username"/>
                <div class="invalid-feedback" style="text-align: left;">
                  <?= validation_show_error('username'); ?>
                </div>
              </div>
              <div>
                <input type="password" class="form-control <?= validation_show_error('password') ?  'is-invalid' : null; ?>" <?= validation_show_error("password") ? "style=border-color:red;margin-bottom:0;" : null; ?> name="password" placeholder="Password" />
                <div class="invalid-feedback" style="text-align: left;">
                  <?= validation_show_error('password'); ?>
                </div>
              </div>
              <div style="margin-top: 20px; text-align: start;">
                <button class="btn btn-primary" type="submit"><i class="fa fa-sign-in" style="margin-right: 5px;"></i>Log in</button>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <div class="clearfix"></div>
                <br />

               
              </div>
            </form>
          </section>
        </div>

      </div>
    </div>
  </body>
</html>
