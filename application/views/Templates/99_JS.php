<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="<?= base_url('assets') ?>/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="<?= base_url('assets') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?= base_url('assets') ?>/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets') ?>/dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="<?= base_url('assets') ?>/dist/js/demo.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="<?= base_url('assets') ?>/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="<?= base_url('assets') ?>/plugins/raphael/raphael.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- Input Mask -->
<!-- <script src="<?= base_url('assets') ?>/plugins/moment/moment.min.js"></script> -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
<!-- ChartJS -->
<script src="<?= base_url('assets') ?>/plugins/chart.js/Chart.min.js"></script>
<!-- DataTables -->
<script src="<?= base_url('assets') ?>/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- PAGE SCRIPTS -->
<script src="<?= base_url('assets') ?>/dist/js/pages/dashboard2.js"></script>
<!-- date-range-picker -->
<!-- <script src="<?= base_url('assets') ?>/plugins/daterangepicker/daterangepicker.js"></script> -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/select2/js/select2.full.min.js"></script>

<script>
    $(function() {
        $("#tabel_pemasukan").DataTable({
            "responsive": true,
            "autoWidth": true
        });
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
<script>
    $(function() {
        $('input[name="date"]').daterangepicker({
            opens: 'left'
        }, function(start, end, label) {
            console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
        });
    });
</script>

<!-- <?php
        $jml_tanpa_akhir = $jml_hari_kosong['jml'];
        // var_dump($jml_hari_kosong['jml']);
        // die;
        for ($i = 0; $i < $jml_tanpa_akhir; $i++) {
        ?>
    <script type="text/javascript">
        $(window).on('load', function() {
            $('#sisamodal').modal('show');
        });
    </script>

    <div class="modal fade" id="sisamodal">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Peringatan <?= $i ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="#">
                    <div class="modal-body">
                        <h3>Sisa saldo kemarin adalah <?php echo $jml_tanpa_akhir ?></h3>
                        <h3 class="text-danger"><?= "Rp. " . number_format($sisa_kemarin['sisa'], 0, ',', '.') ?> </h3>
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="sisa" value="<?= $sisa_kemarin['sisa'] ?>">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Oke</button>
                        </div>
                    </div>
            </div>
        </div>
    </div>
<?php
        }
?> -->
</body>

</html>