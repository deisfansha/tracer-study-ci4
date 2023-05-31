    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1></h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= base_url('home') ?>">Home</a></li>
                            <li class="breadcrumb-item"><a href="<?= base_url('kuesioner') ?>">Kuesioner</a></li>
                            <li class="breadcrumb-item active">Detail</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><?= $detail['nama_kuesioner'] ?></h3>

                    <div class="card-tools">
                        <a href="<?= base_url('kuesioner') ?>" type="button" class="btn btn-secondary btn-sm"><i class="fas fa-chevron-left"></i> Kembali</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="callout callout-info mb-5 mt-3">
                        <h5>Keterangan</h5>
                        <p><?= $detail['keterangan'] ?></p>
                    </div>
                    <table id="data" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Pertanyaan</th>
                                <th>Tipe Pertanyaan</th>
                            </tr>
                        </thead>
                        <?php foreach ($tampil_question as $row) { ?>
                            <tbody>
                                <tr>
                                    <td><?= $row['kode_pertanyaan'] ?></td>
                                    <td><?= $row['nama_quest'] ?></td>
                                    <td width="30%">
                                        <?php
                                        if ($row['tipe_pertanyaan'] == 'multiple') {
                                            $options = explode(',', $row['option']);
                                            foreach ($options as $option) {
                                        ?>
                                                <input type="text" class="form-control col-md-12 mt-2" value="<?= $option ?> " readonly>
                                        <?php }
                                        } else {
                                            echo 'Essay';
                                        }
                                        ?>
                                    </td>
                                </tr>
                            </tbody>
                        <?php } ?>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <i class="fas fa-eye"></i> Detail Kuesioner
                </div>
                <!-- /.card-footer-->
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Modal Tambah -->
    <div class="modal fade" id="modalAdd">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add question</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('kuesioner/add_kuesioner'); ?>" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Nama Kuesioner</label>
                            <input type="text" class="form-control" name="nama_kuesioner">
                        </div>
                        <div class="form-group">
                            <label>Keterangan Kuesioner</label>
                            <textarea class="form-control" rows="4" name="keterangan" placeholder="Enter ..."></textarea>
                        </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" name="add" class="btn btn-success">Save</button>
                </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>