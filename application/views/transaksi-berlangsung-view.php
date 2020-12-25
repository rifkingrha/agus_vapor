<?php $this->load->view('template-dashboard/header-pembeli'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <?php echo $this->session->flashdata('message'); ?>
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Transaksi Berlangsung</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Transaksi yang sedang berlangsung</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div id="accordion">
                        <?php $i = 0; ?>
                        <?php foreach ($transaksi_berlangsung as $res) : ?>
                            <div class="card card-primary">
                                <div class="card-header">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?= $i ?>">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <span class="text-md-left float-md-left"><?= strftime("%A / %d-%B-%Y, %H:%M", strtotime($res['tanggal_order'])); ?></span>
                                            </div>
                                            <div class="col-md-4">
                                                <span class="text-md-right float-md-right"><?= $res['nama_produk'] ?></span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div id="collapse<?= $i ?>" class="panel-collapse collapse">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <dl class="row">
                                                    <dt class="col-sm-4">Produk yang dibeli</dt>
                                                    <dd class="col-sm-8"><?= $res['nama_produk'] ?></dd>
                                                    <dt class="col-sm-4">Harga</dt>
                                                    <dd class="col-sm-8"><?= maskrupiah($res['harga']) ?></dd>
                                                    <dt class="col-sm-4">Jumlah</dt>
                                                    <dd class="col-sm-8"><?= $res['kuantitas_produk'] ?></dd>
                                                    <dt class="col-sm-4">Penjual</dt>
                                                    <dd class="col-sm-8"><?= $res["nama_penjual"] ?></dd>
                                                    <dt class="col-sm-4">No Telepon Penjual</dt>
                                                    <dd class="col-sm-8"><?= $res["no_telp_penjual"] ?></dd>
                                                    <dt class="col-sm-4">Tanggal Pemesanan</dt>
                                                    <dd class="col-sm-8"><?= strftime("%A / %d-%B-%Y, %H:%M", strtotime($res['tanggal_order'])); ?></dd>
                                                    <dt class="col-sm-4">Jumlah yang harus dibayar</dt>
                                                    <dd class="col-sm-8"><?= maskrupiah($res["total_harga"]) ?></dd>
                                                    <dt class="col-sm-4">Status pesanan</dt>
                                                    <dd class="col-sm-8"><?php 
                                                        if ($res["status_penyelesaian"] == 0) {
                                                            echo "Belum diproses";
                                                        } elseif ($res["status_penyelesaian"] == 1) {
                                                            echo "Diproses";
                                                        } elseif ($res["status_penyelesaian"] == 2) {
                                                            echo "Selesai";
                                                        } else{
                                                            echo "Dibatalkan";
                                                        }
                                                    ?></dd>
                                                </dl>
                                            </div>
                                            <div class="col-md-4">
                                                <img src="<?= base_url("assets/img/produk/" . $res['image_produk']) ?>" alt="" style="widht:200px;height:200px">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                            $i++;
                        endforeach;
                        ?>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php $this->load->view('template-dashboard/footer-pembeli'); ?>