<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?></title>
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
            <a href="../../index2.html"><b>Tracer</b>Study</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">You are only one step a way from your new password, recover your password now.</p>

                <form action="<?= base_url('login/ubah_pass/' . $email) ?>" method="post">
                    <div class="input-group mb-3">
                        <?php
                        $isInvalidPass = (session()->getFlashdata('errPass')) ? 'is-invalid' : '';
                        ?>
                        <input type="password" class="form-control <?= $isInvalidPass ?>" name="pass" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        <?php
                        if (session()->getFlashdata('errPass')) {
                            echo '<div class="invalid-feedback">
                                ' . session()->getFlashdata('errPass') . '
                            </div>';
                        }
                        ?>
                    </div>
                    <div class="input-group mb-3">
                        <?php
                        $isInvalidRePass = (session()->getFlashdata('errRePass')) ? 'is-invalid' : '';
                        ?>
                        <input type="password" class="form-control <?= $isInvalidRePass ?>" name="confirm_pass" placeholder="Confirm Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        <?php
                        if (session()->getFlashdata('errRePass')) {
                            echo '<div class="invalid-feedback">
                                ' . session()->getFlashdata('errRePass') . '
                            </div>';
                        }
                        ?>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Change password</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <p class="mt-3 mb-1">
                    <a href="login.html">Login</a>
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
</body>

</html>