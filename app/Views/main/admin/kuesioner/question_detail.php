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
                            <li class="breadcrumb-item active">Pertanyaan</li>
                            <li class="breadcrumb-item active">Option</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="card card-info card-outline">
                        <div class="card-header">
                            <h3 class="card-title"><?= $detail->nama_quest ?></h3>
                            <div class="card-tools">

                            </div>
                        </div>
                        <!-- /.card-header -->
                        <form action="<?= base_url('question/add/' . $detail->id_quest); ?>" method="POST" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-8">
                                        <label>Option</label>
                                        <?php
                                        $isInvalOption = (session()->getFlashdata('err_nama_option')) ? 'is-invalid' : '';
                                        ?>
                                        <input class="form-control form-control-sm <?= $isInvalOption ?>" type="text" name="nama" required autocomplete="true" oninvalid="this.setCustomValidity('Tidak Boleh Kosong')" oninput="setCustomValidity('')">
                                        <?php
                                        if (session()->getFlashdata('err_nama_option')) {
                                            echo '<div class="invalid-feedback">
                                            ' . session()->getFlashdata('err_nama_option') . '
                                            </div>';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <!-- /.card-footer -->
                            <div class="card-footer text-right">
                                <a href="<?= base_url('question') ?>" type="button" class="btn btn-secondary btn-sm"><i class="fas fa-chevron-left"></i> Kembali</a>
                                <button type="submit" class="btn btn-success btn-sm">
                                    <i class="fas fa-save"></i> Save
                                </button>
                            </div>
                            <!-- /.card-footer -->
                        </form>
                    </div>
                </div>
                <!--/.col (left) -->
                <div class="col-md-6">
                    <!--/.col (right) -->
                    <!-- Default box -->
                    <div class="card card-warning card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Data Option</h3>

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
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Option</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 0;
                                    foreach ($option as $row) :
                                        $no++;
                                    ?>
                                        <tr>
                                            <td><?= $no; ?></td>
                                            <td><?= $row->nama ?></td>
                                            <td class="text-center">
                                                <a href="<?= base_url('question/delete_option/' . $row->kode_quest . '/' . $row->id_select) ?>" class="btn btn-danger btn-sm btn-hapus col-md-12"><i class="fas fa-trash"></i> Delete</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- right column -->
                </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Modal Edit -->
    <?php foreach ($option as $row) : ?>
        <div class="modal fade" id="edit_option<?= $row->id_select ?>">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Update Option</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('question/edit_option/' . $row->id_select); ?>" method="POST">
                            <?= csrf_field() ?>
                            <div class="row">
                                <div class="form-group col-6">
                                    <label>Option</label>
                                    <input type="text" name="nama" class="form-control data-namaDpn" placeholder="Masukan Nama Depan" value="<?= $row->nama ?>" required>
                                </div>
                                <div class="form-group col-6">
                                    <label>Value</label>
                                    <input type="text" name="nilai" class="form-control" placeholder="Masukan Nama Belakang" value="<?= $row->nilai ?>">
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" name="add" class="btn btn-primary">Save Changes</button>
                    </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    <?php endforeach; ?>