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
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active"><?= $title ?></li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card card-navy">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="nav-icon fas fa-edit"></i>
                        <?= $detail['nama_kuesioner'] ?> - <?= $user['nama_lengkap'] ?>
                    </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form id="formquest" method="POST" enctype="multipart/form-data">
                        <?php
                        $no = 0;
                        $kode = 1;
                        $answer = 1;
                        foreach ($details as $row) {
                            $no++; ?>
                            <div class="form-group">
                                <dl>
                                    <dt class="mb-2"><?= $no ?>. <?= $row['nama_quest'] ?></dt>
                                    <fieldset>
                                        <?php if ($row['tipe_pertanyaan'] == "multiple") { ?>
                                            <input type="text" hidden name="kode_quest_<?= $kode++ ?>" value="<?= $row['kode_quest'] ?>">
                                            <?php $options = explode(',', $row['option']);

                                            foreach ($options as $option) { ?>
                                                <div class="options">
                                                    <div class="input">
                                                        <input type="radio" name="answer_<?= $answer ?>" class="ml-3" value="<?= $option ?>" />
                                                        <label for="<?= $option ?>"><?= $option ?></label> <br />
                                                    </div>
                                                </div>
                                            <?php }
                                            $answer++; ?>
                                    </fieldset>
                                </dl>
                            </div>
                        <?php } else { ?>
                            <div class="form-group">
                                <input type="text" hidden name="kode_quest_<?= $kode++ ?>" value="<?= $row['kode_quest'] ?>">
                                <input type="text" class="form-control" name="answer_<?= $answer++ ?>">
                            </div>
                        <?php } ?>
                    <?php } ?>
                    <input type="text" hidden name="total_quest" value="<?= $no ?>">
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" name="add" class="btn btn-success btn-cek"><i class="fas fa-save"></i> Save</button>
                </div>
                </form>
                <!-- /.card-body -->

            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <script src="<?= base_url() ?>/template/plugins/jquery/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#formquest').submit(function(e) {
                e.preventDefault()
                total_quest = $('input[name=total_quest]').val()
                semua_data = {
                    "data": []
                }
                for (i = 0; i < total_quest; i++) {
                    kode_quest = $('input[name=kode_quest_' + (i + 1) + ']').val()
                    answer = $('input[name=answer_' + (i + 1) + ']').val()

                    data_quest = {
                        "kode_quest": kode_quest,
                        "answer": answer
                    }
                    semua_data.data.push(data_quest)
                }
                $.ajax({
                    url: "<?php echo base_url('/KuesionerUsers/insert_answer/' . $detail['id_kuesioner']); ?>",
                    method: "POST",
                    data: semua_data,
                    dataType: "JSON",
                    success: function(data) {
                        // Swal.fire({
                        //     icon: 'success',
                        //     title: 'Jawaban Kuesioner',
                        //     text: 'Data Berhasil Disimpan!!!',
                        // })
                        document.location = '<?= base_url('KuesionerUsers') ?>'
                    }
                });
                // console.log(semua_data)
            })
        })
    </script>