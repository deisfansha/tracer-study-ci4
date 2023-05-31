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
                            <li class="breadcrumb-item active">Kuesioner</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card card-outline card-dark">
                <div class="card-header">
                    <h3 class="card-title"><a href="" type="button" class="btn btn-block btn-success btn-sm" data-toggle="modal" data-target="#modalAdd"><i class="fa fa-plus" aria-hidden="true"></i> Add</a></h3>

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
                                <th>Kuesioner</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Pertanyaan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 0;
                            foreach ($tampil_kuesioner as $row) :
                                $no++;
                            ?>
                                <tr>
                                    <td><?= $no; ?></td>
                                    <td><?= $row['nama_kuesioner'] ?></td>
                                    <td><?= $row['created_at'] ?></td>
                                    <td>
                                        <a href="" class="btn btn-warning btn-sm btn-block dropdown-toggle" data-toggle="dropdown"><i class="fas fa-clock"></i> Pending </a>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item btn-publish" href="<?= base_url('kuesioner/edit_publish/' . $row['id_kuesioner']) ?>">Publish</a>
                                        </div>
                                    </td>
                                    <td><a href="<?= base_url('kuesioner/add_question/' . $row['id_kuesioner']) ?>" class="btn btn-secondary btn-sm col-md-12"><i class="fas fa-dot-circle"></i> Pilih Pertanyaan </a>
                                    </td>
                                    <td class="text-center">
                                        <a href="<?= base_url('kuesioner/detail_kuesioner/' . base64_encode(base64_encode($row['id_kuesioner']))) ?>" class="btn btn-info btn-sm"><i class="fas fa-eye"></i> Detail </a>
                                        <button type=" button" class="btn btn-warning btn-sm btn-edit" data-toggle="modal" data-target="#edit<?= $row['id_kuesioner'] ?>">
                                            <i class="fas fa-pencil-alt"></i> Update
                                        </button>
                                        <a href="<?= base_url('kuesioner/delete_kuesioner/' . $row['id_kuesioner']) ?>" class="btn btn-danger btn-sm btn-hapus"><i class="fas fa-trash"></i> Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <i class="fa fa-question-circle"></i> Data Kuesioner
                </div>
                <!-- /.card-footer-->
            </div>
            <!-- /.card -->


            <!-- Default box -->
            <div class="card card-dark">
                <div class="card-header">
                    <h3 class="card-title">Data Publish</h3>

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
                                <th>Kuesioner</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 0;
                            foreach ($tampil_kuesioner_publish as $row) :
                                $no++;
                            ?>
                                <tr>
                                    <td><?= $no; ?></td>
                                    <td><?= $row['nama_kuesioner'] ?></td>
                                    <td><?= $row['total'] ?> Pertanyaan</td>
                                    <td><span class="badge badge-primary">Publish</span>
                                    </td>
                                    <td class="text-center">
                                        <a href="<?= base_url('kuesioner/detail_kuesioner/' . base64_encode(base64_encode($row['id_kuesioner']))) ?>" class="btn btn-info btn-sm"><i class="fas fa-eye"></i> Detail </a>
                                        <a href="<?= base_url('kuesioner/delete_kuesioner/' . $row['id_kuesioner']) ?>" class="btn btn-danger btn-sm btn-hapus"><i class="fas fa-trash"></i> Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <i class="fa fa-question-circle"></i> Data Kuesioner
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
                    <h4 class="modal-title">Add Kuesioner</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('kuesioner/add_kuesioner'); ?>" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Nama Kuesioner</label>
                            <?php
                            $isInvalidNama = (session()->getFlashdata('err_nama')) ? 'is-invalid' : '';
                            ?>
                            <input type="text" class="form-control <?= $isInvalidNama ?>" name="nama_kuesioner" required oninvalid="this.setCustomValidity('Tidak Boleh Kosong')" oninput="setCustomValidity('')" autocomplete="true">
                            <?php
                            if (session()->getFlashdata('err_nama')) {
                                echo '<div class="invalid-feedback">
                                ' . session()->getFlashdata('err_nama') . '
                                </div>';
                            }
                            ?>
                        </div>
                        <div class="form-group">
                            <label>Kode Kuesioner</label>
                            <?php
                            $isInvalidKode = (session()->getFlashdata('err_kd')) ? 'is-invalid' : '';
                            ?>
                            <input type="text" class="form-control <?= $isInvalidKode ?>" name="kd_kuesioner" required oninvalid="this.setCustomValidity('Tidak Boleh Kosong')" oninput="setCustomValidity('')" autocomplete="true">
                            <?php
                            if (session()->getFlashdata('err_kd')) {
                                echo '<div class="invalid-feedback">
                                ' . session()->getFlashdata('err_kd') . '
                                </div>';
                            }
                            ?>
                        </div>
                        <div class="form-group">
                            <label>Keterangan Kuesioner</label>
                            <textarea class="form-control" rows="4" name="keterangan" required placeholder="Enter ..." oninvalid="this.setCustomValidity('Tidak Boleh Kosong')" oninput="setCustomValidity('')"></textarea>
                        </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" name="add" class="btn btn-success"><i class="fas fa-save"></i> Save</button>
                </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <?php foreach ($tampil_kuesioner as $row) : ?>
        <div class="modal fade" id="edit<?= $row['id_kuesioner'] ?>">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Update Kuesioner</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('kuesioner/edit_kuesioner/' . $row['id_kuesioner']); ?>" method="POST" enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            <div class="form-group">
                                <label>Nama Kuesioner</label>
                                <input type="text" class="form-control" value="<?= $row['nama_kuesioner'] ?>" name="nama_kuesioner">
                            </div>
                            <div class="form-group">
                                <label>Keterangan Kuesioner</label>
                                <textarea class="form-control" rows="4" name="keterangan" placeholder="Enter ..."><?= $row['keterangan'] ?></textarea>
                            </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save Changes</button>
                    </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    <?php endforeach; ?>