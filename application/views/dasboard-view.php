<?php $this->load->view('template-dashboard/header');?>
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-4 col-4">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?= $countProduk ?></h3>

                <p>Produk</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="<?= site_url('Kelola_produk') ?>" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-4">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?= $countPesananMasuk ?></h3>

                <p>Pesanan Masuk</p>
              </div>
              <div class="icon">
                <i class="fa fa-cart-arrow-down"></i>
              </div>
              <a href="<?= site_url('Kelola_pesanan/pesanan_masuk') ?>" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-4">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?= $countPesananSelesai ?></h3>

                <p>Pesanan Selesai</p>
              </div>
              <div class="icon">
                <i class="fa fa-shopping-cart"></i>
              </div>
              <a href="<?= site_url('Kelola_pesanan/pesanan_selesai') ?>" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        
        <!-- /.row -->
        <div class="row">
          <div class="col-12 col-lg-12">
            <div class="card">
              <div class="card-header">
                Rekap data tahun <span id="tahun_header"></span>
              </div>
              <div class="card-body">
                <canvas id="chart_dashboard"></canvas>
              </div>
            </div>
          </div>
        </div>

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php $this->load->view('template-dashboard/footer');?>
<script>
var ctx = document.getElementById('chart_dashboard').getContext('2d');
    tahun = moment().format("YYYY");
    bulan = moment().format("MM");
    pesanan_masuk = {
        label: 'Pesanan Masuk',
        data: <?= json_encode($chart_pesanan_masuk); ?>,
        backgroundColor: "rgba(14, 240, 32, 0.64)",
        borderWidth: 1
    };
    pesanan_selesai = {
        label: 'Pesanan Selesai',
        data: <?= json_encode($chart_pesanan_selesai); ?>,
        backgroundColor: "rgba(255, 153, 0, 0.64)",
        borderWidth: 1
    };
    chart_surat = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni','Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
        datasets: [pesanan_masuk,pesanan_selesai]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true,
                }
            }]
          }
        }
    });
$(document).ready(function(){
  $('#tahun_header').append(tahun);
});
</script>