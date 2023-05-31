<?php
$db = \Config\Database::connect();
$konten = $db->table('konten')->get()->getRowArray();
$user = $db->table('user')->where(
  'id_user',
  session()->get('id_user')
)->join(
  "level",
  "level.id_level=user.level"
)->get()->getRowArray();
?>
<footer class="main-footer">
  <div class="float-right d-none d-sm-block">
    <?php
    if ($user['level'] == 2) {
      echo '   <i class="fas fa-envelope"></i> :  ' . $konten['email'] . '   ';
      echo '<i class="fas fa-phone"></i> :' . $konten['no_telp'] . '';
    }
    ?>
  </div>
  <strong>Copyright &copy; <?= date('Y') ?> <a href="<?= base_url() ?>">Tracer Study</a>
  </strong>
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?= base_url() ?>/template/plugins/jquery/jquery.min.js"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<!-- Bootstrap 4 -->
<script src="<?= base_url() ?>/template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url() ?>/template/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url() ?>/template/dist/js/demo.js"></script>
<script src="<?= base_url() ?>/template/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>/template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>/template/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url() ?>/template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>/template/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url() ?>/template/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>/template/plugins/jszip/jszip.min.js"></script>
<script src="<?= base_url() ?>/template/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?= base_url() ?>/template/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?= base_url() ?>/template/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url() ?>/template/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?= base_url() ?>/template/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- <script src="<?= base_url() ?>/assets/jquery/jquery.min.js"></script> -->
<script src="<?= base_url() ?>/assets//jquery/bootstrap.bundle.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="<?= base_url() ?>/template/plugins/select2/js/select2t.full.min.js"></script>
<!-- DataTable -->
<script type="text/javascript" src="<?= base_url() ?>/datatable/js/datatables.min.js"></script>
<!-- Summernote -->
<script src="<?= base_url() ?>/template/plugins/summernote/summernote-bs4.min.js"></script>
<!-- BS-Stepper -->
<script src="<?= base_url() ?>/template/plugins/bs-stepper/js/bs-stepper.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?= base_url() ?>/template/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="<?= base_url() ?>/assets/app.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>

<script>
  <?php if (session()->getFlashdata('swal_icon')) { ?>
    Swal.fire({
      icon: '<?= session()->getFlashdata('swal_icon') ?>',
      title: '<?= session()->getFlashdata('swal_title') ?>',
      text: '<?= session()->getFlashdata('swal_text') ?>',
    })
  <?php } ?>
</script>

<script>
  $(document).on('click', '.btn-hapus', function(e) {
    e.preventDefault();
    const href = $(this).attr('href');
    Swal.fire({
      title: 'Yakin mau menghapus data ini?',
      text: "Sekali dihapus tidak terulang lagi",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, Hapus Data Ini'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = href
      }
    })
  })
</script>
<script>
  $("#selectAll").click(function() {
    $("input[type=checkbox]").prop("checked", $(this).prop("checked"));
  });

  $("input[type=checkbox]").click(function() {
    if (!$(this).prop("checked")) {
      $("#selectAll").prop("checked", false);
    }
  });
</script>
<script>
  $(document).on('click', '.btn-publish', function(e) {
    e.preventDefault();
    const href = $(this).attr('href');
    Swal.fire({
      title: 'Yakin Ingin Mengubah Status?',
      text: "Jika status kuesioner sudah di publish maka anda tidak akan bisa menambah pertanyaan dan mengubah data kuesioner",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Saya Menyetujui'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = href
      }
    })
  })
</script>

<script>
  $(document).on('click', '.btn-confirm', function(e) {
    e.preventDefault();
    const href = $(this).attr('href');
    Swal.fire({
      title: 'Yakin Merubah Status Alumni?',
      text: "",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = href
      }
    })
  })
</script>

<script>
  $(document).on('click', '.btn-reset', function(e) {
    e.preventDefault();
    var id_user = $(this).attr('id_user');
    var passElement = $(this).parent().parent().find('.passReset');
    Swal.fire({
      title: 'Reset Password',
      html: 'Yakin id user ' + id_user + ' ini di reset password?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Saya Reset'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          type: "post",
          url: "/Users/resetPassword",
          data: {
            id_user: id_user
          },
          dataType: "json",
          success: function(response) {
            if (response.sukses == '') {
              $('.viewResetPassword').show();
              passElement.text(response.passwordBaru);
              // console.log(passElement);
            }
          }
        })
      }
    })
  })
</script>

<script type="text/javascript">
  $(function() {
    $("#example1").DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

<script type="text/javascript">
  $(document).ready(function() {
    $('#fakultas').change(function() {
      var id_fakultas = $('#fakultas').val();

      var action = 'get_prodi';

      if (id_fakultas != '') {
        $.ajax({
          url: "<?php echo base_url('/Login/action'); ?>",
          method: "POST",
          data: {
            id_fakultas: id_fakultas,
            action: action
          },
          dataType: "JSON",
          success: function(data) {
            console.log(data);
            var html = '<option value="">Program Studi</option>';

            for (var count = 0; count < data.length; count++) {

              html += '<option value="' + data[count].id_prodi + '">' + data[count].nama_prodi + '</option>';

            }

            $('#prodi').html(html);
          },
          error: function(xhr, ajaxOptions, thrownError) {
            console.log(thrownError);
          },
        });
      } else {
        $('#prodi').val('');
      }
    });
  });
</script>

</body>

</html>
<script>
  $("#datepicker").datepicker({
    format: "yyyy",
    viewMode: "years",
    minViewMode: "years",
    autoclose: true //to close picker once year is selected
  });
</script>
<script>
  $("#datepicker2").datepicker({
    format: "dd/mm/yyyy",
    autoclose: true //to close picker once year is selected
  });
</script>

<script>
  $(document).ready(function() {
    $('#data').DataTable();
  });
</script>

<script>
  $(document).ready(function() {
    $(document).on('click', '.rule', function() {
      var question = $(this).attr("id_quest");
      var kuesioner = $(this).attr("id_kuesioner");

      $.ajax({
        url: '<?= base_url('Kuesioner/add_question_aksi') ?>',
        type: 'POST',
        data: {
          kode_quest: question,
          kode_kuesioner: kuesioner
        },
        dataType: "JSON",
        success: function(data) {
          console.log(data);
        },
        error: function(err) {
          console.log(err);
        }
      });
    });
  });
</script>

<script>
  $(function() {
    // Summernote
    $('#summernote').summernote()

    // CodeMirror
    CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
      mode: "htmlmixed",
      theme: "monokai"
    });
  })

  // BS-Stepper Init
  document.addEventListener('DOMContentLoaded', function() {
    window.stepper = new Stepper(document.querySelector('.bs-stepper'))
  })
</script>