<?php $status = $this->session->flashdata('status'); ?>
<!-- <?php $now = date('Y-m-d') . " 00:00:00"; ?> -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?= $judul ?></h1>
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
                            <div class="row">
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col-6">
                                            <form action="<?= base_url('Rincian/search') ?>" method="POST">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="far fa-calendar-alt"></i>
                                                            </span>
                                                        </div>
                                                        <input type="text" class="form-control float-right" id="date-range" name="date" value="<?= date('m/d/Y') ?> - <?= date('m/d/Y') ?>">
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="col-6">
                                            <button type="submit" class="btn btn-info">Cari</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <a href="#" class="btn btn-success float-right text-bold" data-target="#modal-lg-tambah" data-toggle="modal">Tambah &nbsp;<i class="fas fa-plus"></i> </a>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="tabel_pemasukan" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Keterangan</th>
                                        <th>Kode (D)</th>
                                        <th>Nama (D)</th>
                                        <th>Nominal</th>
                                        <th>Kode (K)</th>
                                        <th>Nama (K)</th>
                                        <th>Nominal</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $total = 0; ?>
                                    <?php foreach ($rincian as $data) : ?>
                                        <tr>
                                            <td><?= date("d M Y", strtotime($data['tanggal_rincian'])) ?></td>
                                            <td><?= $data['keterangan_rincian'] ?></td>
                                            <td><?= $data['debit_rincian'] ?></td>
                                            <td><?= $data['nama_kode'] ?></td>
                                            <td>Rp. <?= number_format($data['nominal_rincian'], 0, ',', ',') ?></td>
                                            <td><?php
                                                foreach ($data['detail'] as $item) {
                                                    echo '<li>' . $item['kode'] . '</li>';
                                                }
                                                ?></td>
                                            <td><?php
                                                foreach ($data['detail'] as $item) {
                                                    echo '<li>' . $item['nama_kode'] . '</li>';
                                                }
                                                ?></td>
                                            <td><?php
                                                foreach ($data['detail'] as $item) {
                                                    echo '<li> Rp. ' . number_format($item['nominal'], 0, ',', ',') . '</li>';
                                                }
                                                ?></td>
                                            <td>
                                                <a href="<?php echo base_url('Rincian/delete/') . $data['kode_rincian'] ?>" class="btn btn-danger remove"><i class=" fas fa-trash"></i></a>
                                                <a href="#" class="btn btn-warning" data-target="#modal-lg-edit<?php echo $data['id_rincian'] ?>" data-toggle="modal"><i class="fas fa-edit"></i></a>
                                            </td>
                                        </tr>
                                        <?php $total = $total + $data['nominal_rincian']; ?>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="8">Total</th>
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

            <!-- modal untuk tambah data -->
            <?php $tgl = date('Y-m-d'); ?>
            <form action=" <?php echo base_url('Rincian/add') ?>" method="post">
                <div class="modal fade" id="modal-lg-tambah">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Tambah Rincian Harian</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label class="col-form-label">Tanggal :</label>
                                    <input type="date" value="<?php echo  $tgl ?>" class="form-control text-dark" name="tanggal" id="tgl1">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Keterangan</label>
                                    <input type="text" class="form-control" name="keterangan_1" autocomplete="off" placeholder="Keterangan...">
                                </div>
                                <div id="keterangan">

                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Kode Akun (D)</label>
                                    <select name="debit" id="debit" class="form-control">
                                        <option name="kode_kredit">Pilih Kode</option>
                                        <?php foreach ($kode_akun as $data) : ?>
                                            <option value="<?= $data['kode_akun'] ?>"><?= $data['nama_kode'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group" id="kredit_r">
                                    <label class="col-form-label">Kode Akun (K)</label>
                                    <select name="kredit_1" id="kredit" class="form-control">
                                        <option name="kode_kredit">Pilih Kode</option>
                                        <?php foreach ($kode_akun as $data) : ?>
                                            <option value="<?= $data['kode_akun'] ?>"><?= $data['nama_kode'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Nominal</label>
                                    <input type="text" class="form-control" name="nominal_d1" data-inputmask="'alias': 'currency' " data-mask>
                                </div>
                                <div id="kredit_t">

                                </div>
                                <div id="nominal_k">

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>

                                    <button type="submit" name="btnSubmit" class="btn btn-primary"><i class="fa fa-spinner fa-spin loading" style="display:none"></i> Simpan</button>
                                    <? $asu = 0; ?>
                                    <button id="tambah" type="button" onclick="addNominal(this.value)" value="2">Form Nominal</button>
                                    <script>
                                        function addNominal(val) {
                                            document.getElementById('nominal_k').innerHTML +=
                                                `<div class="form-group">
                                                <label class="col-form-label">Nominal (K) ${val}</label>
                                                <input type="text" class="form-control" name="nominal_d${val}" data-inputmask="'alias': 'currency' " data-mask>
                                                </div>`;
                                            const newEl = document.getElementById('kredit_r')
                                            document.getElementById('kredit_t').appendChild(newEl.cloneNode(true))
                                            const el = document.getElementsByName('kredit_1')
                                            el[el.length - 1].setAttribute('name', 'kredit_' + val)
                                            const result = document.getElementById('tambah');
                                            result.value = result.value ? parseInt(result.value) + 1 : parseInt(val)
                                            $(function() {
                                                // format angka rupiah
                                                $('[data-mask]').inputmask("currency", {
                                                    prefix: " Rp. ",
                                                    digitsOptional: true
                                                })
                                            });
                                        }
                                    </script>
                                </div>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
            </form>

            <!-- modal untuk edit data -->
            <?php $tgl = date('Y-m-d'); ?>
            <?php foreach ($rincian as $data) :
            ?>

                <form action="<?php echo base_url('Rincian/edit'); ?>" method="post">
                    <div class="modal fade" id="modal-lg-edit<?= $data['id_rincian'] ?>" tabindex="-1">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Edit Rincian <?php echo $data['id_rincian']; ?></h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="id_detail" value="<?= join(',', array_column($data['detail'], 'id_dr')) ?>">
                                    <input type="hidden" name="id_rincian" value="<?= $data['id_rincian'] ?>">
                                    <input type="hidden" name="kode_rincian" value="<?= $data['kode_rincian'] ?>">
                                    <div class="form-group">
                                        <label class="col-form-label">Tanggal :</label>
                                        <input type="date" value="<?= date("Y-m-d", strtotime($data['tanggal_rincian'])) ?>" class=" form-control text-dark" name="tanggal" id="tgl1">
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label">Keterangan</label>
                                        <input type="text" class="form-control" name="keterangan" autocomplete="off" value="<?= $data['keterangan_rincian'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label">Kode Akun (D)</label>
                                        <select name="debit" id="debit_edit" class="form-control">
                                            <option name="kode_kredit">Pilih Kode</option>
                                            <?php foreach ($kode_akun as $data2) : ?>
                                                <option <?php if ($data2['kode_akun'] == $data['debit_rincian']) {
                                                            echo 'selected="selected"';
                                                        } ?> value="<?php echo $data2['kode_akun'] ?>"><?php echo $data2['nama_kode'] ?> </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <?php $kode = 0;
                                    foreach ($data['detail'] as $item) {
                                        $kode++;
                                    ?><div class="form-group">
                                            <label class="col-form-label">Kode Akun (K) <?= $kode ?></label>
                                            <select name="kredit <?= $kode ?>" id="kredit_edit" class="form-control">
                                                <option name="kode_kredit">Pilih Kode</option>
                                                <?php foreach ($kode_akun as $data2) :  ?>
                                                    <option <?php if ($data2['kode_akun'] == $data['kredit_rincian'] || $data2['nama_kode'] == $item['nama_kode']) {
                                                                echo 'selected="selected"';
                                                            } ?> value="<?php echo $data2['kode_akun'] ?>"><?php echo $data2['nama_kode'] ?> </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    <?php } ?>
                                    <?php $nominal = 0;
                                    foreach ($data['detail'] as $item) {
                                        $nominal++;
                                    ?> <div class="form-group">
                                            <label class="col-form-label">Nominal (K) <?= $nominal ?></label>
                                            <input type="text" class="form-control" name="nominal <?= $nominal ?>" .$nominal value="<?= $item['nominal'] ?>" data-inputmask="'alias': 'currency' " data-mask>
                                        </div>
                                    <?php } ?>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>

                                        <button type="submit" name="btnEdit" class="btn btn-primary"><i class="fa fa-spinner fa-spin loading" style="display:none"></i> Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            <?php endforeach; ?>



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