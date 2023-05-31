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
                            <li class="breadcrumb-item"><a href="<? base_url('home') ?>">Home</a></li>
                            <li class="breadcrumb-item active">Pertanyaan</li>
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
                    <h3 class="card-title p-3"><a href="" type="button" class="btn btn-block btn-success" data-toggle="modal" data-target="#modalAdd"><i class="fa fa-plus" aria-hidden="true"></i> Add</a></h3>
                    <ul class="nav nav-pills ml-auto p-2">
                        <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Pilihan Ganda</a></li>
                        <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">Essay</a></li>
                    </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <table id="data" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode</th>
                                        <th>Pertanyaan</th>
                                        <th>Option</th>
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
                                            <td><?= $row->kode_pertanyaan ?></td>
                                            <td><?= $row->nama_quest ?></td>
                                            <td width="30%">
                                                <a href="<?= base_url('question/add_option/' . $row->id_quest) ?>" class="btn btn-secondary btn-sm col-md-12"><i class="fas fa-clock"></i> Atur Jawaban </a>
                                                <?php
                                                $options = explode(',', $row->option);
                                                foreach ($options as $option) {
                                                ?>
                                                    <input type="text" class="form-control col-md-12 mt-2" value="<?= $option ?>" readonly>
                                                <?php
                                                }
                                                ?>
                                            </td>
                                            <td class="text-center" width="20%">
                                                <button type=" button" class="btn btn-warning btn-sm btn-edit" data-toggle="modal" data-target="#edit<?= $row->id_quest ?>">
                                                    <i class="fas fa-pencil-alt"></i> Update
                                                </button>
                                                <a href="<?= base_url('question/delete_quest/' . $row->id_quest) ?>" class="btn btn-danger btn-sm btn-hapus"><i class="fas fa-trash"></i> Delete</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_2">
                            <table id="data" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode</th>
                                        <th>Pertanyaan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 0;
                                    foreach ($essay as $row) :
                                        $no++;
                                    ?>
                                        <tr>
                                            <td><?= $no; ?></td>
                                            <td><?= $row->kode_pertanyaan ?></td>
                                            <td><?= $row->nama_quest ?></td>
                                            <td class="text-center" width="20%">
                                                <button type=" button" class="btn btn-warning btn-sm btn-edit" data-toggle="modal" data-target="#edit<?= $row->id_quest ?>">
                                                    <i class="fas fa-pencil-alt"></i> Update
                                                </button>
                                                <a href="<?= base_url('question/delete_quest/' . $row->id_quest) ?>" class="btn btn-danger btn-sm btn-hapus"><i class="fas fa-trash"></i> Delete</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
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
                    <form action="<?= base_url('question/addQuest'); ?>" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Kode Pertanyaan</label>
                            <input type="text" class="form-control" name="kode_pertanyaan" placeholder="Masukan Kode Pertanyaan" required oninvalid="this.setCustomValidity('Tidak Boleh Kosong')" oninput="setCustomValidity('')">
                        </div>
                        <div class="form-group">
                            <label>Pertanyaan</label>
                            <textarea class="form-control" rows="4" name="nama_quest" required oninvalid="this.setCustomValidity('Tidak Boleh Kosong')" oninput="setCustomValidity('')" placeholder=" Enter ..."></textarea>
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="tipe_pertanyaan" required>
                                <option value="essay">Essay</option>
                                <option value="multiple">Pilihan Ganda</option>
                            </select>
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

    <!-- Modal Edit -->
    <?php foreach ($edit as $row) : ?>
        <div class="modal fade" id="edit<?= $row->id_quest ?>">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Update Pertanyaan</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('question/edit_quest/' . $row->id_quest); ?>" method="POST" enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            <div class="form-group">
                                <label>Kode Pertanyaan</label>
                                <input type="text" class="form-control" name="kode_pertanyaan" placeholder="Masukan Kode Pertanyaan" value="<?= $row->kode_pertanyaan ?>">
                            </div>
                            <div class="form-group">
                                <label>Pertanyaan</label>
                                <textarea class="form-control" rows="4" name="nama_quest" placeholder="Enter ..."> <?= $row->nama_quest ?></textarea>
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