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
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-olive">
                            <div class="inner">
                                <h3><?= $total_alumni['total'] ?></h3>

                                <p>Alumni</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <a href="<?= base_url('users') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-navy">
                            <div class="inner">
                                <h3><?= $total_kuesioner['total'] ?></h3>

                                <p>Kuesioner</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-file"></i>
                            </div>
                            <a href="<?= base_url('kuesioner') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3><?= $total_pending['total']; ?></h3>
                                <p>Data Pending</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <a href="<?= base_url('users/viewstatus') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-maroon">
                            <div class="inner">
                                <h3><?= $total_question ?></h3>

                                <p>Pertanyaan</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-file-alt"></i>
                            </div>
                            <a href="<?= base_url('question') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>
                <!-- STACKED BAR CHART -->
                <div class="card card-lightblue">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-chart-bar"></i> Chart</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <select name="prodi" class="form-control" id="dashboard-select-prodi">
                                <option value="">All</option>
                                <?php foreach ($getprodi as $gp) { ?>
                                    <option value="<?= $gp['id_prodi'] ?>"><?= $gp['nama_prodi'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <!-- /.row -->
                        <div class="row">
                            <div class="col-6">
                                <!-- STACKED BAR CHART -->
                                <div class="card card-purple">
                                    <div class="card-header">
                                        <h3 class="card-title">Tahun Lulus</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <canvas id="tahunlulus"></canvas>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                            <div class="col-6">
                                <!-- STACKED BAR CHART -->
                                <div class="card card-teal">
                                    <div class="card-header">
                                        <h3 class="card-title">Responden Kuesioner</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <canvas id="respondenkuesioner"></canvas>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <script src="<?= base_url() ?>/chartjs/Chart.bundle.min.js"></script>
    <script src="<?= base_url() ?>/template/plugins/jquery/jquery.min.js"></script>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <!-- Diagram dashboard -->
    <script>
        $(document).ready(function() {
            var tahunlulus = document.getElementById('tahunlulus');
            var data_tahun_lulus = [];
            var label_tahun_lulus = [];
            <?php foreach ($thn_lulus as $t) : ?>
                data_tahun_lulus.push(<?= $t['total'] ?>);
                label_tahun_lulus.push('<?= $t['tahun_lulus'] ?>');
            <?php endforeach; ?>

            var data_tahun_lulus_user = {
                datasets: [{
                    label: 'jumlah',
                    data: data_tahun_lulus,
                    backgroundColor: 'rgb(192, 128, 255)'
                }],
                labels: label_tahun_lulus,
            }

            var chart_tahunlulus = new Chart(tahunlulus, {
                type: 'bar',
                data: data_tahun_lulus_user
            });

            var responden_kuesioner = document.getElementById('respondenkuesioner');
            var data_responden = [];
            var label_responden = [];
            <?php foreach ($responden as $t) : ?>
                data_responden.push(<?= $t['total'] ?>);
                label_responden.push('<?= $t['nama_kuesioner'] ?>');
            <?php endforeach; ?>

            var data_jumlah_responden = {
                datasets: [{
                    label: 'jumlah',
                    data: data_responden,
                    backgroundColor: [
                        'rgb(147, 255, 216)',
                        'rgb(84, 140, 255)',
                        'rgb(277, 255, 220)'
                    ],
                }],
                labels: label_responden,
            }

            var chart_responden = new Chart(respondenkuesioner, {
                type: 'doughnut',
                data: data_jumlah_responden
            });

            $("#dashboard-select-prodi").change(function() {
                let prodi = $("#dashboard-select-prodi").val();
                $.ajax({
                    url: "<?php echo base_url('/home/getTahunLulusByProdi'); ?>",
                    method: "POST",
                    data: {
                        prodi: prodi
                    },
                    dataType: "JSON",
                    success: function(data) {
                        var tahunlulus = document.getElementById('tahunlulus');
                        let data_tahun_luluss = [];
                        let label_tahun_luluss = [];
                        for (var i = 0; i < data.length; i++) {
                            data_tahun_luluss.push(data[i].total);
                            label_tahun_luluss.push(data[i].tahun_lulus);
                        }

                        var data_tahun_lulus_user = {
                            datasets: [{
                                label: 'jumlah',
                                data: data_tahun_luluss,
                                backgroundColor: 'rgb(192, 128, 255)'
                            }],
                            labels: label_tahun_luluss,
                        }
                        chart_tahunlulus.destroy();
                        chart_tahunlulus = new Chart(tahunlulus, {
                            type: 'bar',
                            data: data_tahun_lulus_user
                        });
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        console.log(thrownError);
                    },
                });

                $.ajax({
                    url: "<?php echo base_url('/home/getKuesionerByProdi'); ?>",
                    method: "POST",
                    data: {
                        prodi: prodi
                    },
                    dataType: "JSON",
                    success: function(data) {
                        var responden_kuesioner = document.getElementById('respondenkuesioner');
                        let data_respondenn = [];
                        let label_respondenn = [];
                        for (var i = 0; i < data.length; i++) {
                            data_respondenn.push(data[i].total);
                            label_respondenn.push(data[i].nama_kuesioner);
                        }

                        var data_jumlah_responden = {
                            datasets: [{
                                label: 'jumlah',
                                data: data_respondenn,
                                backgroundColor: [
                                    'rgb(147, 255, 216)',
                                    'rgb(84, 140, 255)',
                                    'rgb(277, 255, 220)'
                                ],
                            }],
                            labels: label_responden,
                        }
                        chart_responden.destroy();
                        chart_responden = new Chart(respondenkuesioner, {
                            type: 'doughnut',
                            data: data_jumlah_responden
                        });
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        console.log(thrownError);
                    },
                });
            });
        });
    </script>

    <script>
        <?php if (session()->getFlashdata('swal_icon')) { ?>
            Swal.fire({
                icon: '<?= session()->getFlashdata('swal_icon') ?>',
                title: '<?= session()->getFlashdata('swal_title') ?>',
                text: '<?= session()->getFlashdata('swal_text') ?>',
            })
        <?php } ?>
    </script>