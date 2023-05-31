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
                           <li class="breadcrumb-item active">Data Alumni</li>
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
                   <h3 class="card-title">
                       <a href="" type="button" class="btn  btn-success btn-sm" data-toggle="modal" data-target="#modalAdd"><i class="fa fa-plus" aria-hidden="true"></i> Add</a>
                       <?php
                        $request = \Config\Services::request();
                        $keyword = $request->getVar('keyword');
                        if ($keyword != '') {
                            $param = "?keyword=" . $keyword;
                        } else {
                            $param = "";
                        }
                        ?>
                       <a href="<?= base_url('users/export' . $param) ?>" type="button" class="btn btn-secondary btn-sm"><i class="fas fa-file-excel"></i> Export</a>
                       <a href="" type="button" class="btn btn-warning btn-sm" data-target="#modalImport" data-toggle="modal"><i class="fas fa-database"></i> Import</a>
                   </h3>
                   <div class="card-tools">

                       <form action="" method="Get">
                           <div class="input-group input-group-sm">
                               <div class="search">
                                   <input type="text" class="form-control" name="keyword" value="<?= $request->getGet('keyword'); ?>" placeholder="Search..." class="input">
                                   <button type="submit" class="button">
                                       <i class="fas fa-search"></i>
                                   </button>
                               </div>
                           </div>
                       </form>

                   </div>
               </div>
               <div class="card-body">
                   <table class="table table-bordered table-hover">
                       <thead>
                           <tr>
                               <th>No</th>
                               <th>Nama Lengkap</th>
                               <th>NIM</th>
                               <th>Fakultas</th>
                               <th>Program Studi</th>
                               <th>Tahun Lulus</th>
                               <th>Aksi</th>
                           </tr>
                       </thead>
                       <tbody>
                           <?php
                            $no = 1 + (7 * ($currentPage - 1));
                            foreach ($datauser as $row) :
                            ?>
                               <tr>
                                   <td><?= $no++; ?></td>
                                   <td><?= $row['nama_lengkap'] ?></td>
                                   <td><?= $row['nim'] ?></td>
                                   <td><?= $row['nama_fakultas'] ?></td>
                                   <td><?= $row['nama_prodi'] ?></td>
                                   <td><?= $row['tahun_lulus'] ?></td>
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
                   <div class="float-left mt-2">
                       <i>Showing <?= 1 + (7 * ($currentPage - 1)) ?> to <?= $no - 1 ?> of <?= $pager->getPageCount() ?> entries</i>
                   </div>
                   <div class="float-right mt-2">
                       <?= $pager->links('user', 'user_pagination'); ?>
                   </div>
               </div>
               <!-- /.card-body -->
               <div class="card-footer">
                   <i class="fa fa-users"></i> Data Alumni
               </div>
               <!-- /.card-footer-->
           </div>
           <!-- /.card -->

       </section>
       <!-- /.content -->
   </div>

   <!-- Modal Delete -->
   <?php foreach ($detail as $row) : ?>
       <div class="modal fade" id="delete<?= $row['id_user'] ?>">
           <div class="modal-dialog modal-lg">
               <div class="modal-content">
                   <div class="modal-header">
                       <h4 class="modal-title"><i class="fas fa-eye"></i> <?= $row['nama_lengkap'] ?></h4>
                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                       </button>
                   </div>
                   <div class="modal-body">
                       <label for="">Apakah Anda Yakin ingin menghapus data ini?</label>
                   </div>
                   <div class="modal-footer justify-content-between">
                       <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                       <a href="<?= base_url('users/delete/' . $row['id_user']) ?>" type="submit" class="btn btn-danger">Delete</a>
                   </div>
                   </form>
               </div>
               <!-- /.modal-content -->
           </div>
           <!-- /.modal-dialog -->
       </div>
   <?php endforeach; ?>

   <!-- Modal Detail -->
   <?php foreach ($detail as $row) : ?>
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
                           <table class="table">
                               <th rowspan="8">
                                   <?php
                                    if ($row['foto'] == null) {
                                        echo '<img class="img-fluid" src="
                                        ' . base_url('assets/img/avatar.png') . ' 
                                        " alt="User profile picture" width="150px">';
                                    } else {
                                        echo '<img class="img-fluid" src="
                                        ' . base_url('assets/img/' . $row['foto']) . ' 
                                        " alt="User profile picture" width="150px">';
                                    }
                                    ?>
                               </th>
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
                           <div class="form-group viewResetPassword" style="display: none;">
                               <label for="">Password Baru Anda</label>
                               <br>
                               <h3 class="passReset"></h3>
                           </div>
                   </div>
                   <div class="modal-footer justify-content-between">
                       <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                       <button type="submit" class="btn btn-dark btn-reset" id_user="<?= $row['id_user'] ?>"><i class="fas fa-recycle"></i> Reset Password</button>
                   </div>
                   </form>
               </div>
               <!-- /.modal-content -->
           </div>
           <!-- /.modal-dialog -->
       </div>
   <?php endforeach; ?>

   <!-- Modal Tambah -->
   <div class="modal fade" id="modalAdd">
       <div class="modal-dialog modal-lg">
           <div class="modal-content">
               <div class="modal-header">
                   <h4 class="modal-title">Add User</h4>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                   </button>
               </div>
               <div class="modal-body">
                   <form action="<?= base_url('users/addUser'); ?>" method="POST" enctype="multipart/form-data">
                       <div class="row">
                           <div class="form-group col-6">
                               <label>Nama Lengkap</label>
                               <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control" placeholder="Masukan Nama Depan" required oninvalid="this.setCustomValidity('Tidak Boleh Kosong')" oninput="setCustomValidity('')">
                           </div>
                           <div class="form-group col-6">
                               <label>Username</label>
                               <input type="text" name="username" id="username" class="form-control" placeholder="Masukan Username" required oninvalid="this.setCustomValidity('Tidak Boleh Kosong')" oninput="setCustomValidity('')">
                           </div>
                           <div class="form-group col-6">
                               <label>Fakultas</label>
                               <select class="form-control" id="fakultas" name="fakultas">
                                   <option value="0">Fakultas</option>
                                   <?php foreach ($tampilfakultas as $fk) : ?>
                                       <option value="<?= $fk['id_fakultas'] ?>"><?= $fk['nama_fakultas'] ?></option>
                                   <?php endforeach; ?>
                               </select>
                           </div>
                           <div class="form-group col-6">
                               <label>Program Studi</label>
                               <select class="form-control" name="prodi" id="prodi">
                                   <option value="">Program Studi</option>
                               </select>
                           </div>
                           <div class="form-group col-6">
                               <label>Jenis Kelamin</label>
                               <select class="form-control" name="jenis_klm">
                                   <option value="0">Jenis Kelamin</option>
                                   <option value="Laki-Laki">Laki-Laki</option>
                                   <option value="Perempuan">Perempuan</option>
                               </select>
                           </div>
                           <div class="form-group col-6">
                               <label>Tahun Lulus</label>
                               <input class="form-control" name="tahun_lulus" id="datepicker" placeholder="Tahun Lulus" required oninvalid="this.setCustomValidity('Tidak Boleh Kosong')" oninput="setCustomValidity('')" autocomplete="true">
                           </div>
                           <div class="form-group col-6">
                               <label>Email</label>
                               <input type="email" name="email" id="email" class="form-control" placeholder="Masukan Email" required oninvalid="this.setCustomValidity('Tidak Boleh Kosong')" oninput="setCustomValidity('')">
                           </div>
                           <div class="form-group col-6">
                               <label>Nomor Handphone</label>
                               <input type="text" name="no_hp" id="no_hp" class="form-control" placeholder="Masukan Nomor Handphone" required oninvalid="this.setCustomValidity('Tidak Boleh Kosong')" oninput="setCustomValidity('')">
                           </div>
                           <div class="form-group col-6">
                               <label>Password</label>
                               <input type="password" name="password" id="password" class="form-control" placeholder="Masukan Password" required oninvalid="this.setCustomValidity('Tidak Boleh Kosong')" oninput="setCustomValidity('')">
                           </div>
                       </div>
               </div>
               <div class="modal-footer justify-content-between">
                   <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                   <button type="submit" name="add" class="btn btn-primary">Save</button>
               </div>
               </form>
           </div>
           <!-- /.modal-content -->
       </div>
       <!-- /.modal-dialog -->
   </div>

   <!-- Modal Tambah -->
   <div class="modal fade" id="modalImport">
       <div class="modal-dialog modal-sm">
           <div class="modal-content">
               <div class="modal-header">
                   <h4 class="modal-title">Import Data</h4>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                   </button>
               </div>
               <div class="modal-body">
                   <form action="<?= base_url('users/upload'); ?>" method="POST" enctype="multipart/form-data">
                       <label>Import Excel</label>
                       <input type="file" name="fileimport" class="form-control">
                       <!-- <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control" placeholder="Masukan Nama Depan" required oninvalid="this.setCustomValidity('Tidak Boleh Kosong')" oninput="setCustomValidity('')"> -->
               </div>
               <div class="modal-footer justify-content-between">
                   <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                   <button type="submit" name="add" class="btn btn-primary">Save</button>
               </div>
               </form>
           </div>
           <!-- /.modal-content -->
       </div>
       <!-- /.modal-dialog -->
   </div>
   <!-- /.content-wrapper -->