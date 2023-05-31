    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= base_url('home') ?>">Home</a></li>
                            <li class="breadcrumb-item active">Pertanyaan Kuesioner</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card card-dark card-outline">
                <div class="card-header">
                    <div style="vertical-align: middle;" class="d-inline ml-2">
                        <h4 class="d-inline"><?= $title ?></h4>
                    </div>
                    <div class="card-tools">
                        <a href="<?= base_url('kuesioner') ?>" type="button" class="btn btn-secondary btn-sm"><i class="fas fa-chevron-left"></i> Kembali</a>
                    </div>
                </div>
                <div class="card-body">
                    <table id="data" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Pilih</th>
                                <th>Kode</th>
                                <th>Jenis</th>
                                <th>Pertanyaan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($question as $row) {
                            ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td>
                                        <div class="icheck-success d-inline">
                                            <input type="checkbox" class="rule" id="checkboxSuccess<?= $no; ?>" id_quest="<?= $row['id_quest'] ?>" id_kuesioner="<?= $kuesioner['id_kuesioner'] ?>" <?php if (isset($row['kode_kuesioner'])) {
                                                                                                                                                                                                        echo "checked";
                                                                                                                                                                                                    } ?>>
                                            <label for="checkboxSuccess<?= $no; ?>"></label>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <?= $row['kode_pertanyaan'] ?>
                                    </td>
                                    <td><?= $row['tipe_pertanyaan'] ?></td>
                                    <td><?= $row['nama_quest'] ?></td>
                                </tr>
                            <?php
                            } ?>
                        </tbody>

                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">

                </div>
                <!-- /.card-footer-->
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->