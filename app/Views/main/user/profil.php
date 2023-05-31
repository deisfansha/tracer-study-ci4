    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Profile Alumni</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= base_url('home') ?>">Home</a></li>
                            <li class="breadcrumb-item active">Profil Alumni</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <?php
                                    if ($profil['foto'] == null) {
                                        echo '<img src="
                                            ' . base_url('assets/img/avatar.png') . ' 
                                        " class="img-fluid" alt="User profile picture" width="150px">';
                                    } else {
                                        echo '<img src="
                                            ' . base_url('assets/img/' . $profil['foto']) . ' 
                                        " class="img-fluid" alt="User profile picture" width="150px">';
                                    }
                                    ?>
                                    <!-- <img class="img-fluid" src="<?= base_url('assets/img/' . $profil['foto']) ?>" alt="User profile picture" width="150px"> -->
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <div class="col-md-9">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <div class="text-center">
                                    <h3 class="card-title">Data <?= $profil['nama_lengkap'] ?></h3>
                                </div>
                                <div class="card-tools">
                                    <a href="#" class="btn btn-info btn-flat btn-sm" data-toggle="modal" data-target="#edit"><i class="fas fa-pencil-alt"></i> <b>Edit Profile</b></a>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <tr>
                                        <th width="200px">Nama Lengkap</th>
                                        <th width="50px">:</th>
                                        <td><?= $profil['nama_lengkap'] ?></td>
                                    </tr>
                                    <tr>
                                        <th width="200px">NIM</th>
                                        <th width="50px">:</th>
                                        <td><?= $profil['nim'] ?></td>
                                    </tr>
                                    <tr>
                                        <th width="200px">NIK</th>
                                        <th width="50px">:</th>
                                        <td><?= $profil['nik'] ?></td>
                                    </tr>
                                    <tr>
                                        <th width="200px">Email</th>
                                        <th width="50px">:</th>
                                        <td><?= $profil['email'] ?></td>
                                    </tr>
                                    <tr>
                                        <th width="200px">Jenis Kelamin</th>
                                        <th width="50px">:</th>
                                        <td><?= $profil['jenis_klm'] ?></td>
                                    </tr>
                                    <tr>
                                        <th width="200px">Nomor Handphone</th>
                                        <th width="50px">:</th>
                                        <td><?= $profil['no_hp'] ?></td>
                                    </tr>
                                    <tr>
                                        <th width="200px">Fakultas</th>
                                        <th width="50px">:</th>
                                        <td><?= $profil['nama_fakultas'] ?></td>
                                    </tr>
                                    <tr>
                                        <th width="200px">Program Studi</th>
                                        <th width="50px">:</th>
                                        <td><?= $profil['nama_prodi'] ?></td>
                                    </tr>
                                    <tr>
                                        <th width="200px">Tahun Lulus</th>
                                        <th width="50px">:</th>
                                        <td><?= $profil['tahun_lulus'] ?></td>
                                    </tr>
                                    <tr>
                                        <th width="200px">Tempat Tanggal Lahir</th>
                                        <th width="50px">:</th>
                                        <td><?= $profil['tempat_lahir'] ?>, <?= $profil['tgl_lahir'] ?></td>
                                    </tr>
                                    <tr>
                                        <th width="200px">Alamat Rumah</th>
                                        <th width="50px">:</th>
                                        <td><?= $profil['alamat_rmh'] ?></td>
                                    </tr>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <div class="modal fade" id="edit">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Update Data Alumni</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- <form action="<?= base_url('profil/edit/' . $profil['id_user']); ?>" method="POST"> -->
                    <?php echo form_open_multipart('profil/edit/' . $profil['id_user']) ?>
                    <?= csrf_field() ?>
                    <div class="row">
                        <div class="form-group col-6">
                            <label>Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Masukan Email" value="<?= $profil['email'] ?>">
                        </div>
                        <div class="form-group col-6">
                            <label>Nomor Handphone</label>
                            <input type="number" name="no_hp" id="no_hp" class="form-control" placeholder="Masukan Nomor Handphone" value="<?= $profil['no_hp'] ?>">
                        </div>
                        <div class="form-group col-6">
                            <label>NIK</label>
                            <input type="number" name="nik" id="nik" class="form-control" placeholder="Masukan NIK" value="<?= $profil['nik'] ?>">
                        </div>
                        <div class="form-group col-6">
                            <label>Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" placeholder="Masukan Tempat Lahir" value="<?= $profil['tempat_lahir'] ?>">
                        </div>
                        <div class="form-group col-6">
                            <label>Alamat Rumah</label>
                            <textarea name="alamat" id="" cols="30" rows="10" class="form-control"><?= $profil['alamat_rmh'] ?></textarea>
                        </div>
                        <div class="form-group col-6">
                            <label>Tanggal Lahir</label>
                            <input type="text" name="tgl_lahir" class="form-control" id="datepicker2" value="<?= $profil['tgl_lahir'] ?>" />
                        </div>
                        <div class="form-group col-6">
                            <label>Upload Foto</label><br>
                            <?php
                            if ($profil['foto'] == null) {
                                echo '<img src="
                                            ' . base_url('assets/img/avatar.png') . ' 
                                        " class="img-fluid" alt="User profile picture" width="80px">';
                            } else {
                                echo '<img src="
                                            ' . base_url('assets/img/' . $profil['foto']) . ' 
                                        " class="img-fluid" alt="User profile picture" width="80px">';
                            }
                            ?>
                            <input type="file" name="foto" id="foto" class="form-control mt-2" value="<?= $profil['foto'] ?>">
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" name="add" class="btn btn-primary">Save Changes</button>
                </div>
                <!-- </form> -->
                <?php
                echo form_close();
                ?>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>