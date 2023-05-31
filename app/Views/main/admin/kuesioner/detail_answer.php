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
                            <li class="breadcrumb-item"><a href="<?= base_url('hasil') ?>">Hasil Kuesioner</a></li>
                            <li class="breadcrumb-item"><a href="<?= base_url('hasil/detail_hasil/' . $nama['id_kuesioner']) ?>"> Detail</a></li>
                            <li class="breadcrumb-item active">Jawaban</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-3">
                    <div class="card card-navy card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="img-fluid" src="<?= base_url('assets/img/' . $user_data['foto']) ?>" alt="User profile picture" width="150px">
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-md-9">
                    <div class="card card-navy card-outline">
                        <div class="card-header">
                            <div class="text-center">
                                <h3 class="card-title">Data <?= $user_data['nama_lengkap'] ?></h3>
                            </div>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-plus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <tr>
                                    <th width="200px">Nama Lengkap</th>
                                    <th width="50px">:</th>
                                    <td><?= $user_data['nama_lengkap'] ?></td>
                                </tr>
                                <tr>
                                    <th width="200px">NIK</th>
                                    <th width="50px">:</th>
                                    <td><?= $user_data['nik'] ?></td>
                                </tr>
                                <tr>
                                    <th width="200px">Email</th>
                                    <th width="50px">:</th>
                                    <td><?= $user_data['email'] ?></td>
                                </tr>
                                <tr>
                                    <th width="200px">Jenis Kelamin</th>
                                    <th width="50px">:</th>
                                    <td><?= $user_data['jenis_klm'] ?></td>
                                </tr>
                                <tr>
                                    <th width="200px">Nomor Handphone</th>
                                    <th width="50px">:</th>
                                    <td><?= $user_data['no_hp'] ?></td>
                                </tr>
                                <tr>
                                    <th width="200px">Fakultas</th>
                                    <th width="50px">:</th>
                                    <td><?= $user_data['nama_fakultas'] ?></td>
                                </tr>
                                <tr>
                                    <th width="200px">Program Studi</th>
                                    <th width="50px">:</th>
                                    <td><?= $user_data['nama_prodi'] ?></td>
                                </tr>
                                <tr>
                                    <th width="200px">Tahun Lulus</th>
                                    <th width="50px">:</th>
                                    <td><?= $user_data['tahun_lulus'] ?></td>
                                </tr>
                                <tr>
                                    <th width="200px">Tempat Tanggal Lahir</th>
                                    <th width="50px">:</th>
                                    <td><?= $user_data['tempat_lahir'] ?>, <?= $user_data['tgl_lahir'] ?></td>
                                </tr>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- Default box -->
            <div class="card card-navy">
                <div class="card-header">
                    <h3 class="card-title">Jawaban <?= $nama['nama_kuesioner'] ?></h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <table id="data" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Pertanyaan</th>
                                <th>Jawaban</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 0;
                            foreach ($answer as $row) :
                                $no++;
                            ?>
                                <tr>
                                    <td><?= $no; ?></td>
                                    <td><?= $row['nama_quest'] ?></td>
                                    <td><?= $row['answer'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->