<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Halaman Login</title>
    <link rel="icon" href="<?= base_url() ?>/assets/img/unnur.png" type="image/x-icon">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url() ?>/template/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= base_url() ?>/template/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url() ?>/template/dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <div class="swal" data-swal="<?= session()->get('pesan'); ?>"></div>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body ">
                <P></P><br>
                <p class="login-box-msg"><img src="<?= base_url() ?>/assets/img/unnur.png" width="55%" alt=""><br>
                    <b>TRACER STUDY</b>
                </p>
                <?php
                if (session()->setFlashdata('pesan')) {
                    echo '<div class="alert alert-success" role="alert">';
                    echo session()->getFlashdata('pesan');
                    echo '</div>';
                }
                ?>
                <?= form_open('login/cekUser'); ?>
                <?= csrf_field(); ?>
                <div class="input-group mb-3">
                    <?php
                    $isInvalUsername = (session()->getFlashdata('errUsername')) ? 'is-invalid' : '';
                    ?>
                    <input type="text" name="user" class="form-control <?= $isInvalUsername ?>" placeholder="Username" autofocus autocomplete="true">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                    <?php
                    if (session()->getFlashdata('errUsername')) {
                        echo '<div class="invalid-feedback">
                                ' . session()->getFlashdata('errUsername') . '
                            </div>';
                    }
                    ?>
                </div>
                <div class="input-group mb-3">
                    <?php
                    $isInvalidPassword = (session()->getFlashdata('errPassword')) ? 'is-invalid' : '';
                    ?>
                    <input type="password" name="pass" class="form-control <?= $isInvalidPassword ?>" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    <?php
                    if (session()->getFlashdata('errPassword')) {
                        echo '<div id="validationServer03Feedback" class="invalid-feedback">
                                ' . session()->getFlashdata('errPassword') . '
                            </div>';
                    }
                    ?>
                </div>

                <div class="input-group mb-3">
                    <button type="submit" class="btn btn-block btn-primary btn-sm"><i class="fas fa-sign-in-alt"></i> Sign In</button>
                </div>
                <?= form_close(); ?>
                <p class="mb-1">
                    <a href="/login/register" class="text-center">Register a new membership</a>
                </p>
                <p class="mb-0">
                    <a href="<?= base_url('login/verif_email') ?>">I forgot my password</a>
                </p>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="<?= base_url() ?>/template/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url() ?>/template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url() ?>/template/dist/js/adminlte.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        <?php if (session()->getFlashdata('swal_icon')) { ?>
            Swal.fire({
                icon: '<?= session()->getFlashdata('swal_icon') ?>',
                title: '<?= session()->getFlashdata('swal_title') ?>',
                text: '<?= session()->getFlashdata('swal_text') ?>',
            })
        <?php } ?>
    </script>
</body>

</html>