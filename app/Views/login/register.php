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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">
</head>

<body class="hold-transition register-page">
    <div class="register-logo">
    </div>

    <div class="card">
        <div class="card-body register-card-body">
            <p class="login-box-msg"><b>REGISTRASI</b></p>
            <form action="/login/save_register" method="POST" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="input-group mb-3">
                    <?php
                    $isInvalidNama_lengkap = (session()->getFlashdata('errNama_lengkap')) ? 'is-invalid' : '';
                    ?>
                    <input name="nama_lengkap" class="form-control <?= $isInvalidNama_lengkap ?>" placeholder="Nama Lengkap" autocomplete="true">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                    <?php
                    if (session()->getFlashdata('errNama_lengkap')) {
                        echo '<div class="invalid-feedback">
                                ' . session()->getFlashdata('errNama_lengkap') . '
                            </div>';
                    }
                    ?>
                </div>
                <div class="input-group mb-3">
                    <?php
                    $isInvalidNIM = (session()->getFlashdata('errnim')) ? 'is-invalid' : '';
                    ?>
                    <input name="nim" class="form-control <?= $isInvalidNIM ?>" placeholder="Nomor Induk Mahasiswa" autocomplete="true">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                    <?php
                    if (session()->getFlashdata('errnim')) {
                        echo '<div class="invalid-feedback">
                                ' . session()->getFlashdata('errnim') . '
                            </div>';
                    }
                    ?>
                </div>
                <div class="input-group mb-3">

                    <?php
                    $isInvalidUsername = (session()->getFlashdata('errUsername')) ? 'is-invalid' : '';
                    ?>
                    <input name="username" class="form-control <?= $isInvalidUsername ?>" placeholder="Username" autocomplete="true">
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
                    <div class="input-group-text col-6">
                        <select class="form-control" id="fakultas" name="fakultas">
                            <option value="0">Fakultas</option>
                            <?php foreach ($tampilfakultas as $fk) : ?>
                                <option value="<?= $fk['id_fakultas'] ?>"><?= $fk['nama_fakultas'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="input-group-text col-6">
                        <select class="form-control" name="prodi" id="prodi">
                            <option value="">Program Studi</option>
                        </select>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-text col-6">
                        <select class="form-control" name="jenis_klm" required>
                            <option>Jenis Kelamin</option>
                            <option value="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="input-group-text col-6">
                        <input class="form-control" name="tahun_lulus" id="datepicker" placeholder="Tahun Lulus" autocomplete="true">
                    </div>
                </div>
                <div class="input-group mb-3">
                    <?php
                    $isInvalidEmail = (session()->getFlashdata('errEmail')) ? 'is-invalid' : '';
                    ?>
                    <input type="text" name="email" class="form-control <?= $isInvalidEmail ?>" placeholder="Email" autocomplete="true">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div><br>
                    <?php
                    if (session()->getFlashdata('errEmail')) {
                        echo '<div class="invalid-feedback">
                                ' . session()->getFlashdata('errEmail') . '
                            </div>';
                    }
                    ?>
                </div>
                <div class="input-group mb-3">
                    <?php
                    $isInvalidNoHp = (session()->getFlashdata('errNoHp')) ? 'is-invalid' : '';
                    ?>
                    <input type="text" class="form-control <?= $isInvalidNoHp ?>" name="no_handphone" required oninvalid="this.setCustomValidity('Tidak Boleh Kosong')" oninput="setCustomValidity('')" placeholder="Nomor Handphone">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-phone"></span>
                        </div>
                    </div>
                    <?php
                    if (session()->getFlashdata('errNoHp')) {
                        echo '<div class="invalid-feedback">
                                ' . session()->getFlashdata('errNoHp') . '
                            </div>';
                    }
                    ?>
                </div>

                <div class="input-group mb-3">
                    <?php
                    $isInvalidPass = (session()->getFlashdata('errPass')) ? 'is-invalid' : '';
                    ?>
                    <input type="password" name="password" class="form-control <?= $isInvalidPass ?>" placeholder="Password">
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
                    <input type="password" name="repassword" class="form-control <?= $isInvalidRePass ?>" placeholder="Ulangi password">
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
                <div class="input-group mb-3">
                    <div class="custom-file">
                        <?php
                        $isInvalidFoto = (session()->getFlashdata('errFoto')) ? 'is-invalid' : '';
                        ?>
                        <input type="file" class="custom-file-input <?= $isInvalidFoto ?>" id="customFile" name="foto">
                        <label class="custom-file-label" for="customFile">Pilih Foto</label>
                        <?php
                        if (session()->getFlashdata('errFoto')) {
                            echo '<div class="invalid-feedback">
                                ' . session()->getFlashdata('errFoto') . '
                            </div>';
                        }
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Register</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <a href="/login/index" class="text-center">Kembali Login</a>
        </div>
        <!-- /.form-box -->
    </div><!-- /.card -->
    <!-- /.register-box -->

    <!-- jQuery -->
    <script src="<?= base_url() ?>/template/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url() ?>/template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url() ?>/template/dist/js/adminlte.min.js"></script>
    <script src="<?= base_url() ?>/assets/sweetalert/sweetalert2.all.js"></script>
    <!-- bs-custom-file-input -->
    <script src="<?= base_url() ?>/template/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="https://netdna.bootstrapcdn.com/bootstrap/2.3.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#fakultas').change(function() {

                var id_fakultas = $('#fakultas').val();

                var action = 'get_prodi';

                if (id_fakultas != '') {
                    $.ajax({
                        url: "<?php echo base_url('/login/action'); ?>",
                        method: "POST",
                        data: {
                            id_fakultas: id_fakultas,
                            action: action
                        },
                        dataType: "JSON",
                        success: function(data) {
                            var html = '<option value="">Program Studi</option>';

                            for (var count = 0; count < data.length; count++) {

                                html += '<option value="' + data[count].id_prodi + '">' + data[count].nama_prodi + '</option>';

                            }

                            $('#prodi').html(html);
                        }
                    });
                } else {
                    $('#prodi').val('');
                }
            });
        });
    </script>
    <script>
        $("#datepicker").datepicker({
            format: "yyyy",
            viewMode: "years",
            minViewMode: "years",
            autoclose: true //to close picker once year is selected
        });
    </script>
    <script>
        <?php if (session()->getFlashdata('swal_icon')) { ?>
            Swal.fire({
                icon: '<?= session()->getFlashdata('swal_icon') ?>',
                title: '<?= session()->getFlashdata('swal_title') ?>',
                text: '<?= session()->getFlashdata('swal_text') ?>',
            })
        <?php } ?>
    </script>
    <script>
        $(function() {
            bsCustomFileInput.init();
        });
    </script>
</body>

</html>