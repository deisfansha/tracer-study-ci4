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
                            <li class="breadcrumb-item active">Pengaturan</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card">
                <div class="card-header d-flex p-0">
                    <h3 class="card-title p-3"><a href="<?= base_url('konten/edit_konten/' . $tampil['id_konten']) ?>" type="button" class="btn btn-block btn-warning btn-sm"><i class="fas fa-edit"></i> Edit Konten</a></h3>
                    <ul class="nav nav-pills ml-auto p-2">
                        <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Fungsi</a></li>
                        <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">Contact</a></li>
                    </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <?= $tampil['isi_konten'] ?>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_2">
                            <table class="table">
                                <tr>
                                    <th width="200px">Nama</th>
                                    <th width="50px">:</th>
                                    <td><?= $tampil['nama_konten'] ?></td>
                                </tr>
                                <tr>
                                    <th width="200px">Email</th>
                                    <th width="50px">:</th>
                                    <td><?= $tampil['email'] ?></td>
                                </tr>
                                <tr>
                                    <th width="200px">Nomor Telepon</th>
                                    <th width="50px">:</th>
                                    <td><?= $tampil['no_telp'] ?></td>
                                </tr>
                                <tr>
                                    <th width="200px">Alamat</th>
                                    <th width="50px">:</th>
                                    <td><?= $tampil['alamat'] ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <!-- /.tab-content -->
                </div><!-- /.card-body -->
            </div>
            <!-- ./card -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->