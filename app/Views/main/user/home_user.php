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
                <li class="breadcrumb-item active">Dashboard</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-lg-6">
            <!-- small box -->
            <div class="small-box bg-gray">
              <div class="inner">
                <h3><?= $count['total'] ?></h3>

                <p>Kuesioner Belum Terjawab</p>
              </div>
              <div class="icon">
                <i class="fas fa-file"></i>
              </div>
              <a href="<?= base_url('kuesionerUsers') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?= $count1['total'] ?></h3>

                <p>Kuesioner Terjawab</p>
              </div>
              <div class="icon">
                <i class="fas fa-check"></i>
              </div>
              <a href="<?= base_url('hasilUsers') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>

        <div class="callout callout-warning">
          <h5>Hello... <b><?= session()->get('nama_lengkap') ?></b></h5>
          <p><?= $konten['isi_konten']; ?></p>
        </div>

      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->