    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Kuesioner</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= base_url('homeUsers') ?>">Home</a></li>
                            <li class="breadcrumb-item active">Kuesioner</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <?php foreach ($tampil as $row) { ?>
                        <div class="col-lg-3 col-6">
                            <!-- small card -->
                            <div class="small-box <?= ($row->status_pengisian == 'belum') ? 'bg-gray' : 'bg-success' ?>">
                                <div class="inner">
                                    <h3><?= $row->kd_kuesioner ?></h3>

                                    <p><?= $row->nama_kuesioner ?></p>
                                </div>
                                <div class="icon">
                                    <?= ($row->status_pengisian == 'belum') ? '<i class="nav-icon fas fa-file"></i>' : '<i class="fas fa-check"></i>' ?>
                                </div>
                                <a href="<?= base_url('kuesionerUsers/detail/' . $row->id_kuesioner) ?>" class="small-box-footer <?= ($row->status_pengisian == 'belum') ? '' : 'inactiveLink ' ?>">
                                    <?= ($row->status_pengisian == 'belum') ? 'Selengkapnya <i class="fas fa-arrow-circle-right"></i>' : 'Sudah Mengisi' ?>
                                </a>
                            </div>
                        </div>
                        <!-- ./col -->
                    <?php } ?>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->