<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">
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
                        <li class="breadcrumb-item active">Status Alumni</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title"><i class="fa fa-users"></i> Data Pending</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <form action="<?= base_url('users/multiple_edit_status') ?>" method="POST">
                    <div class="row mb-3">
                        <div class="col-4">
                            <select name="pilihstatus" class="form-control" id="">
                                <option value="approved">Approved</option>
                                <option value="reject">Reject</option>
                            </select>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i> Update Status</button>
                        </div>
                    </div>
                    <!-- <a href="<?= base_url('users/edit_approved') ?>" class="btn btn-success btn-sm mb-3"><i class="fas fa-check"></i> Approved</a>
                    <a href="" class="btn btn-danger btn-sm mb-3"><i class="far fa-times-circle"></i> Reject</a> -->
                    <table class="table table-bordered table-hover" id="data">
                        <thead>
                            <tr>
                                <th>All <input id="selectAll" type="checkbox"></th>
                                <th>Nama Lengkap</th>
                                <th>Fakultas</th>
                                <th>Program Studi</th>
                                <th>Tahun Lulus</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($viewdata as $row) :
                            ?>
                                <tr>
                                    <td><input type="checkbox" name="pilih[]" value="<?= $row['id_user'] ?>"></td>
                                    <td><?= $row['nama_lengkap'] ?></td>
                                    <td><?= $row['nama_fakultas'] ?></td>
                                    <td><?= $row['nama_prodi'] ?></td>
                                    <td><?= $row['tahun_lulus'] ?></td>
                                    <td><?php if ($row['status'] == "pending") { ?>
                                            <a href="<?= base_url('users/edit_status/' . $row['id_user']) ?>" class="btn btn-warning btn-sm btn-block dropdown-toggle" data-toggle="dropdown"><i class="fas fa-clock"></i> Pending </a>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="<?= base_url('users/edit_approved/' . $row['id_user']) ?>">Approved</a>
                                                <a class="dropdown-item" href="<?= base_url('users/edit_reject/' . $row['id_user']) ?>">Rejected</a>
                                            </div>
                                            <?php } else {
                                            if ($row['status'] == "approved") { ?>
                                                <button class="btn btn-success btn-sm btn-block"><i class="fas fa-check"></i> Approved</button>
                                            <?php } else { ?>
                                                <button class="btn btn-danger btn-sm btn-block"><i class="fas fa-times"></i> Reject</button>
                                            <?php } ?>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#detail<?= $row['id_user'] ?>">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <a href="<?= base_url('users/delete/' . $row['id_user']) ?>" class="btn btn-danger btn-sm btn-hapus"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php
                            endforeach; ?>
                        </tbody>
                    </table>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
        <!-- Default box -->
        <div class="card card-danger collapsed-card">
            <div class="card-header">
                <h3 class="card-title"><i class="fa fa-users"></i> Data Rejected</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover" id="data">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Lengkap</th>
                            <th>Fakultas</th>
                            <th>Program Studi</th>
                            <th>Tahun Lulus</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($viewreject as $row) :
                        ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $row['nama_lengkap'] ?></td>
                                <td><?= $row['nama_fakultas'] ?></td>
                                <td><?= $row['nama_prodi'] ?></td>
                                <td><?= $row['tahun_lulus'] ?></td>
                                <td>
                                    <button class="btn btn-danger btn-sm btn-block"><i class="fas fa-times"></i> Reject</button>
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#detail<?= $row['id_user'] ?>">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <a href="<?= base_url('users/delete/' . $row['id_user']) ?>" class="btn btn-danger btn-sm btn-hapus"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php
                        endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
</div>


<!-- Modal Detail -->
<?php foreach ($viewdata as $row) : ?>
    <div class="modal fade" id="detail<?= $row['id_user'] ?>">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fas fa-eye"></i> Detail User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('users/edit/' . $row['id_user']); ?>" method="POST" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <table width="70%" margin="3">
                            <tr>
                                <td><label>Nama Lengkap</label></td>
                                <td>: <?= $row['nama_lengkap'] ?></td>
                            </tr>
                            <tr>
                                <td><label>Jenis Kelamin</label></td>
                                <td>: <?= $row['jenis_klm'] ?></td>
                            </tr>
                            <tr>
                                <td><label>Email</label> </td>
                                <td>: <?= $row['email'] ?></td>
                            </tr>
                            <tr>
                                <td><label>Nomor Handphone</label></td>
                                <td>: <?= $row['no_hp'] ?></td>
                            </tr>
                            <tr>
                                <td><label>Fakultas</label></td>
                                <td>: <?= $row['nama_fakultas'] ?></td>
                            </tr>
                            <tr>
                                <td><label>Program Studi</label></td>
                                <td>: <?= $row['nama_prodi'] ?></td>
                            </tr>
                            <tr>
                                <td><label>Tahun Lulus</label></td>
                                <td>: <?= $row['tahun_lulus'] ?></td>
                            </tr>
                        </table>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php endforeach; ?>