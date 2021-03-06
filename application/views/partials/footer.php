<footer class="main-footer">
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.0.5
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?= base_url('assets/plugins/jquery/jquery.min.js') ?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?= base_url('assets/plugins/jquery-ui/jquery-ui.min.js') ?>"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

<!-- DataTables -->
<script src="<?= base_url('assets/plugins/datatables/datatables.min.js') ?>"></script>

<script src="<?= base_url('assets/plugins/moment/moment.min.js') ?>"></script>
<!-- Select2 -->
<script src="<?= base_url('assets/plugins/select2/js/select2.full.min.js') ?>"></script>
<!-- ChartJS -->
<script src="<?= base_url('assets/plugins/chart.js/Chart.min.js') ?>"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?= base_url('assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') ?>"></script>
<!-- Summernote -->
<script src="<?= base_url('assets/plugins/summernote/summernote-bs4.min.js') ?>"></script>
<!-- overlayScrollbars -->
<script src="<?= base_url('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/inputmask/min/jquery.inputmask.bundle.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/daterangepicker/daterangepicker.js') ?>"></script>

<script src="<?= base_url('assets/plugins/sweetalert2/sweetalert2.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/toastr/toastr.min.js') ?>"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets/dist/js/adminlte.js') ?>"></script>

<!-- AdminLTE for demo purposes -->
<script src="<?= base_url('assets/dist/js/demo.js') ?>"></script>
<script src="<?= base_url('assets/dist/js/koperasi.js') ?>"></script>

<script type="text/javascript">
  $(function () {
    $('.select2').select2({
      theme: 'bootstrap4'
    });
    Inputmask.extendAliases({
      rupiah: {
                prefix: " Rp ",
                groupSeparator: ".",
                alias: "currency",
                placeholder: "0",
                autoGroup: !0,
                digits: 0,
                digitsOptional: !1,
                clearMaskOnLostFocus: !1,
                removeMaskOnSubmit: true,
                numericInput: true,
              autoUnmask: true,
            }
    });
    $('.currency').inputmask({ alias : "rupiah"});
    $('[data-mask]').inputmask({
      removeMaskOnSubmit: true,
      autoUnmask: true,
    });

    $('#logout').click(function() {
      Swal.fire({
        title: 'Logout',
        text: "Apakah Anda Yakin ingin Keluar ?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Logout!'
      }).then((result) => {
        if (result.value) {
          $.ajax({
            url: base_url+'Login/logout',
            type: 'POST',
            dataType:'json',
            success:function (response) {
              Swal.fire(
                'Berhasil!',
                'Anda Telah Keluar.',
                'success'
              );
                window.location.href = base_url+response.redirect; 
            }
          });
        }
      });
    });
  });
</script>
</body>
</html>
