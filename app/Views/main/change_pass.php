    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1><?= $title ?></h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= base_url('home') ?>">Home</a></li>
                            <li class="breadcrumb-item active">Change Password</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <?= form_open('password/ubah_password/' . session()->get('id_user')) ?>
                <?= csrf_field()  ?>
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <div class="text-center">
                            <h3 class="card-title"></h3>
                        </div>
                        <div class="card-tools">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Password Lama</label>
                            <?php
                            $isInvalPassLama = (session()->getFlashdata('err_password_lama')) ? 'is-invalid' : '';
                            ?>
                            <input type="password" class="form-control <?= $isInvalPassLama ?>" name="password_lama" autocomplete="true">
                            <?php
                            if (session()->getFlashdata('err_password_lama')) {
                                echo '<div class="invalid-feedback">
                                ' . session()->getFlashdata('err_password_lama') . '
                            </div>';
                            }
                            ?>
                        </div>
                        <div class="form-group">
                            <label for="">Password Baru</label>
                            <?php
                            $isInvalPassBaru = (session()->getFlashdata('err_password_baru')) ? 'is-invalid' : '';
                            ?>
                            <input type="password" class="form-control <?= $isInvalPassBaru ?>" name="password_baru" autocomplete="true">
                            <?php
                            if (session()->getFlashdata('err_password_baru')) {
                                echo '<div class="invalid-feedback">
                                ' . session()->getFlashdata('err_password_baru') . '
                            </div>';
                            }
                            ?>
                        </div>
                        <div class="form-group">
                            <label for="">Konfirmasi Password</label>
                            <?php
                            $isInvalPassConfirm = (session()->getFlashdata('err_password_confirm')) ? 'is-invalid' : '';
                            ?>
                            <input type="password" class="form-control <?= $isInvalPassConfirm ?>" name="password_confirm" autocomplete="true">
                            <?php
                            if (session()->getFlashdata('err_password_confirm')) {
                                echo '<div class="invalid-feedback">
                                ' . session()->getFlashdata('err_password_confirm') . '
                            </div>';
                            }
                            ?>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary btn-sm "><i class="fas fa-save"></i> Save Changes</button>
                    </div>
                    <?= form_close(); ?>
                    <!-- /.card-footer-->
                </div>
                <!-- /.card -->

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->