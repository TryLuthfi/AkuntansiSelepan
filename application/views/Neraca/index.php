<?php $status = $this->session->flashdata('status'); ?>
<!-- <?php $now = date('Y-m-d') . " 00:00:00"; ?> -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Neraca Aset</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Barang</a></li>
                        <li class="breadcrumb-item active">Index</li>
                        <!-- <?php echo $now ?> -->
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row">
                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>

                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Aset Lancar</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Saldo Tunai</th>
                                        <th>Piutang Gaji</th>
                                        <th>Piutang Penjualan</th>
                                        <th>Piutang Informent</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Rp. <?= number_format($kas, 0, ',', ',') ?></td>
                                        <td>Rp. <?= number_format($piutanggaji, 0, ',', ',') ?></td>
                                        <td>Rp. <?= number_format($piutangpenjualan, 0, ',', ',') ?></td>
                                        <td>Rp. <?= number_format($piutanginforment, 0, ',', ',') ?></td>
                                    </tr>
                                </tbody>
                                <?php $total_asetlancar = $kas + $piutanggaji + $piutangpenjualan + $piutanginforment ?>
                                <tfoot>
                                    <tr>
                                        <th colspan="3">Total</th>
                                        <th><?= number_format($total_asetlancar, 0, ',', '.') ?></th>
                                        <!-- <th>Aksi</th> -->
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>

                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Aset Tetap</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Bahan Bangunan</th>
                                        <th>Peralatan Pabrik</th>
                                        <th>Sewa bayar dimuka</th>
                                        <th>Perlengkapan Pabrik</th>
                                        <th>Biaya Lain-Lain</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Rp. <?= number_format($kas, 0, ',', ',') ?></td>
                                        <td>Rp. <?= number_format($piutanggaji, 0, ',', ',') ?></td>
                                        <td>Rp. <?= number_format($piutangpenjualan, 0, ',', ',') ?></td>
                                        <td>Rp. <?= number_format($piutanginforment, 0, ',', ',') ?></td>
                                        <td>Rp. <?= number_format($piutanginforment, 0, ',', ',') ?></td>
                                    </tr>
                                </tbody>
                                <?php $total_beban = $kas + $piutanggaji + $piutangpenjualan + $piutanginforment ?>
                                <tfoot>
                                    <tr>
                                        <th colspan="4">Total</th>
                                        <th><?= number_format($total_beban, 0, ',', '.') ?></th>
                                        <!-- <th>Aksi</th> -->
                                    </tr>
                                </tfoot>

                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>

            </div>
            <!-- /.row -->

            <!-- COBA PANGGIL DATA MSQL -->
            <div class="row">
                <!-- ISI -->
            </div>

        </div>
        <!--/. container-fluid -->
    </section>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Neraca Modal & Kewajiban</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Barang</a></li>
                        <li class="breadcrumb-item active">Index</li>
                        <!-- <?php echo $now ?> -->
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row">
                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>

                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Kewajiban</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Hutang Usaha</th>
                                        <th>Hutang Pembayaran</th>
                                        <th>Hutang Opr Harian</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Rp. <?= number_format($kas, 0, ',', ',') ?></td>
                                        <td>Rp. <?= number_format($piutanggaji, 0, ',', ',') ?></td>
                                        <td>Rp. <?= number_format($piutangpenjualan, 0, ',', ',') ?></td>
                                    </tr>
                                </tbody>
                                <?php $total = $kas + $piutanggaji + $piutangpenjualan ?>
                                <tfoot>
                                    <tr>
                                        <th colspan="2">Total</th>
                                        <th><?= number_format($total, 0, ',', '.') ?></th>
                                        <!-- <th>Aksi</th> -->
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>

                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Modal</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Modal</th>
                                        <th>L/R</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Rp. <?= number_format($kas, 0, ',', ',') ?></td>
                                        <td>Rp. <?= number_format($kas, 0, ',', ',') ?></td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="1">Total</th>
                                        <th><?= number_format($total, 0, ',', '.') ?></th>
                                        <!-- <th>Aksi</th> -->
                                    </tr>
                                    <tr>
                                        <th colspan="1">Laba/Rugi</th>
                                        <th><?= number_format($total, 0, ',', '.') ?></th>
                                        <!-- <th>Aksi</th> -->
                                    </tr>
                                </tfoot>

                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>

            </div>
            <!-- /.row -->

            <!-- COBA PANGGIL DATA MSQL -->
            <div class="row">
                <!-- ISI -->
            </div>

        </div>
        <!--/. container-fluid -->
    </section>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Neraca Aset</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Barang</a></li>
                        <li class="breadcrumb-item active">Index</li>
                        <!-- <?php echo $now ?> -->
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row">
                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>

                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Neraca Aset Lancar</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Saldo Tunai</th>
                                        <th>Piutang Gaji</th>
                                        <th>Piutang Penjualan</th>
                                        <th>Piutang Informent</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Rp. <?= number_format($kas, 0, ',', ',') ?></td>
                                        <td>Rp. <?= number_format($piutanggaji, 0, ',', ',') ?></td>
                                        <td>Rp. <?= number_format($piutangpenjualan, 0, ',', ',') ?></td>
                                        <td>Rp. <?= number_format($piutanginforment, 0, ',', ',') ?></td>
                                    </tr>
                                </tbody>
                                <?php $total_asetlancar = $kas + $piutanggaji + $piutangpenjualan + $piutanginforment ?>
                                <tfoot>
                                    <tr>
                                        <th colspan="3">Total</th>
                                        <th><?= number_format($total_asetlancar, 0, ',', '.') ?></th>
                                        <!-- <th>Aksi</th> -->
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>

                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Beban</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Pembelian Gabah</th>
                                        <th>Bahan Pembantu</th>
                                        <th>Beban Operasional</th>
                                        <th>Gaji</th>
                                        <th>Transportasi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Rp. <?= number_format($kas, 0, ',', ',') ?></td>
                                        <td>Rp. <?= number_format($piutanggaji, 0, ',', ',') ?></td>
                                        <td>Rp. <?= number_format($piutangpenjualan, 0, ',', ',') ?></td>
                                        <td>Rp. <?= number_format($piutanginforment, 0, ',', ',') ?></td>
                                        <td>Rp. <?= number_format($piutanginforment, 0, ',', ',') ?></td>
                                    </tr>
                                </tbody>
                                <?php $total_beban = $kas + $piutanggaji + $piutangpenjualan + $piutanginforment ?>
                                <tfoot>
                                    <tr>
                                        <th colspan="4">Total</th>
                                        <th><?= number_format($total_beban, 0, ',', '.') ?></th>
                                        <!-- <th>Aksi</th> -->
                                    </tr>
                                </tfoot>

                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>

            </div>
            <!-- /.row -->

            <!-- COBA PANGGIL DATA MSQL -->
            <div class="row">
                <!-- ISI -->
            </div>

        </div>
        <!--/. container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>

<script>
    $('#1').datepicker({
        inputs: $('input[name=tanggal_berangkat]'),
        format: 'dd/mm/yyyy'
    })
    $('#2').datepicker({
        inputs: $('input[name=utanggal_berangkat]'),
        format: 'dd/mm/yyyy'
    })
</script>
<script type="text/javascript">
    $(function() {

        // format angka rupiah
        $('[data-mask]').inputmask("currency", {
            prefix: " Rp. ",
            digitsOptional: true
        })

        // notifikasi allert sukses atau tidak
        <?php if ($status == 'sukses') { ?>
            swal("Success!", "Berhasil menambah data rincian!", "success");
        <?php } else if ($status == 'gagal') { ?>
            swal("Gagal!", "Gagal menambah data rincian!", "warning");
        <?php } else { ?>
        <?php } ?>

    });
</script>