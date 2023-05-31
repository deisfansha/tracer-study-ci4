    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1><?= $detail['nama_fakultas'] ?></h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= base_url('home') ?>">Home</a></li>
                            <li class="breadcrumb-item"><a href="<?= base_url('fakultas') ?>">Fakultas</a></li>
                            <li class="breadcrumb-item active">Program Studi</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card card-primary card-outline">
                <div class="card-header d-flex p-0">
                    <h3 class="card-title p-3">
                        <a href="" type="button" class="btn btn-block btn-success btn-sm" data-toggle="modal" data-target="#modalAdd"><i class="fa fa-plus" aria-hidden="true"></i> Add Program Studi</a>
                        <a href="<?= base_url('fakultas') ?>" type="button" class="btn btn-block btn-secondary btn-sm"><i class="fas fa-chevron-left"></i> Kembali</a>
                    </h3>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <table id="data" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Program Studi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 0;
                            foreach ($tampil as $row) :
                                $no++;
                            ?>
                                <tr>
                                    <td><?= $no; ?></td>
                                    <td><?= $row['nama_prodi'] ?></td>
                                    <td class="text-center">
                                        <button type=" button" class="btn btn-warning btn-sm btn-edit" data-toggle="modal" data-target="#edit<?= $row['id_prodi'] ?>">
                                            <i class="fas fa-pencil-alt"></i> Update
                                        </button>
                                        <!-- <a href="<?= base_url('fakultas/delete_prodi/' . $detail['id_fakultas'] .  '/' . $row['id_prodi']) ?>" class="btn btn-danger btn-sm btn-hapus"><i class="fas fa-trash"></i> Delete</a> -->
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div><!-- /.card-body -->
                <div class="card-footer">
                    <i class="fas fa-landmark"></i> Data Program Studi
                </div>
                <!-- /.card-footer-->
            </div>
            <!-- ./card -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Modal Tambah -->
    <div class="modal fade" id="modalAdd">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Program Studi</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('fakultas/tambah_prodi/' . $detail['id_fakultas']); ?>" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Nama Program Studi</label>
                            <input type="text" class="form-control" name="nama_prodi" required oninvalid="this.setCustomValidity('Tidak Boleh Kosong')" oninput="setCustomValidity('')">
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

    <!-- Modal Edit -->
    <?php foreach ($tampil as $row) : ?>
        <div class="modal fade" id="edit<?= $row['id_prodi'] ?>">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Update Data Prodi</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('fakultas/edit_prodi/' . $detail['id_fakultas'] . '/' . $row['id_prodi']); ?>" method="POST" enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            <div class="form-group">
                                <label>Nama Program Studi</label>
                                <input type="text" class="form-control" name="nama_prodi" value="<?= $row['nama_prodi'] ?>">
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