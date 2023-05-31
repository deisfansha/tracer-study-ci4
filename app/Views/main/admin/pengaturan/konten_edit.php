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
                            <li class="breadcrumb-item active">Pengaturan</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card card-warning card-outline">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-edit"></i> Edit Konten</h3>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('konten/edit_konten_aksi/' . $tampil['id_konten']) ?>" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="form-group col-4">
                                <label>Nama</label>
                                <input type="text" class="form-control" name="nama_konten" value="<?= $tampil['nama_konten'] ?>" autocomplete="true">
                            </div>
                            <div class="form-group col-4">
                                <label>Nomor Telepon</label>
                                <input type="number" class="form-control" name="no_telp" value="<?= $tampil['no_telp'] ?>" autocomplete="true">
                            </div>
                            <div class="form-group col-4">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" value="<?= $tampil['email'] ?>" autocomplete="true">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea name="alamat" class="form-control"><?= $tampil['alamat'] ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Isi Konten</label>
                            <textarea id="summernote" name="isi_konten"><?= $tampil['isi_konten'] ?></textarea>
                        </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer text-right">
                    <a href="<?= base_url('konten') ?>" type="button" class="btn btn-secondary btn-sm"><i class="fas fa-chevron-left"></i> Kembali</a>
                    <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Save Changes</button>
                    </form>
                </div>
                <!-- /.card-footer-->
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->