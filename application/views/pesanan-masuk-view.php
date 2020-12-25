<?php $this->load->view('template-dashboard/header'); ?>
<!-- Modal Tambah -->
<div class="modal fade" id="modalStatus" tabindex="-1" role="dialog" aria-labelledby="modalStatusTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalStatusTitle">Status Pesanan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" class="form-horizontal form-input">
                    <input type="hidden" name="id_detail_transaksi" id="id_detail_transaksi">
                    <div class="form-group row">
                        <label for="status_pesanan" class="col-sm-3 col-form-label">Status Pesanan</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="status_pesanan" id="status_pesanan">
                                <option value="">- Status Pesanan -</option>
                                <option value="0">Belum diproses</option>
                                <option value="1">Diproses</option>
                                <option value="2">Selesai</option>
                                <option value="3">Dibatalkan</option>
                            </select>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <?php echo $this->session->flashdata('message'); ?>
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Data Pesanan</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-custom card-stretch gutter-b">
                        <div class="card-header">
                            <h3 class="card-title">Pesanan Masuk <?= $this->session->userdata('username') ?></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="tabel_pesanan_masuk" class="table table-bordered table-hover text-center">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No Transaksi</th>
                                        <th>Tanggal Order</th>
                                        <th>Nama Produk</th>
                                        <th>Gambar Produk</th>
                                        <th>Harga</th>
                                        <th>Kuantitas</th>
                                        <th>Total Harga</th>
                                        <th>Nama Pemesan</th>
                                        <th>No Telepon</th>
                                        <th>Alamat Pemesan</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php $this->load->view('template-dashboard/footer'); ?>
<script>
    $(document).ready(function() {
        $('#tabel_pesanan_masuk').DataTable({
            "responsive": true,
            'processing': true,
            'ajax': {
                'url': "<?php echo base_url('Kelola_pesanan/getPesananMasuk'); ?>",
                'dataSrc': function(json) {
                    return json;
                }
            },
            'columns': [{
                    "data": "nomor",
                    "className": "align-middle"
                },
                {
                    "data": "no_transaksi",
                    "className": "align-middle"
                },
                {
                    "data": "tanggal_order",
                    "className": "align-middle"
                },
                {
                    "data": "nama_produk",
                    "className": "align-middle"
                },
                {
                    "data": "image_produk",
                    render: function(data, type, row) {
                        data = '<img src="<?= base_url('assets/img/produk/'); ?>'+data+'?'+Date.now()+'"  style="widht:200px;height:200px" alt="">';
                        return data;
                    },
                    "className": "align-middle"
                },
                {
                    "data": "harga_produk",
                    render: function(data, type, row) {
                            data = mask_rupiah(row.harga_produk);
                            return data;
                    },
                    "className": "align-middle"
                },
                {
                    "data": "kuantitas_produk",
                    "className": "align-middle"
                },
                {
                    "data": "total_harga",
                    render: function(data, type, row) {
                            data = mask_rupiah(row.total_harga);
                            return data;
                    },
                    "className": "align-middle"
                },
                {
                    "data": "nama_pembeli",
                    "className": "align-middle"
                },
                {
                    "data": "no_telp_pembeli",
                    "className": "align-middle"
                },
                {
                    "data": "alamat1",
                    "className": "align-middle"
                },
                {
                    "data": "status_penyelesaian",
                    render: function(data, type, row) {
                        if (row.status_penyelesaian == 0) {
                            data = 'Belum diproses';
                            return data;
                        } else if (row.status_penyelesaian == 1){
                            data = 'Diproses';
                            return data;
                        } else if (row.status_penyelesaian == 2){
                            data = 'Selesai';
                            return data;
                        } else {
                            data = 'Dibatalkan';
                            return data;
                        }
                    },
                    "className": "align-middle"
                },
                {
                    "data": "id_detail_transaksi",
                    render: function(data, type, row) {
                        data = '<button class="btn btn-sm btn-primary btn-edit" data-toggle="modal" data-target="#modalStatus" data-edit="' + data + '"><i class="fas fa-edit"></i> Ubah Status Pesanan</button>';
                        return data;
                    },
                    "className": "align-middle"
                },
            ],
        });

        $(".form-input").on("submit", function(event) {
            event.preventDefault();
            var formData = new FormData($('.form-input')[0]);
            
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('Kelola_pesanan/updateStatusPesanan'); ?>",
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function() {
                    // $('.loading').show();
                },
            }).done(function(result) {
                // $('.loading').hide();
                $('#modalStatus').modal('hide');
                $("#tabel_pesanan_masuk").DataTable().ajax.reload(function() {
                    Swal.fire('Berhasil ubah status pesanan!', '', 'success');
                });
                $('.form-input').trigger('reset');
            });
            
        });

        $('#tabel_pesanan_masuk').on('click', '.btn-edit', function() {
            var id_detail_transaksi = $(this).data('edit');
            console.log(id_detail_transaksi)
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('Kelola_pesanan/getPesananMasuk'); ?>",
                data: {
                    'id_detail_transaksi': id_detail_transaksi
                },
                beforeSend: function() {
                    // $('.loading').show();
                },
            }).done(function(result) {
                // $('.loading').hide();
                var res = JSON.parse(result);
                $('#id_detail_transaksi').val(res.id_detail_transaksi);
                $('#status_pesanan').val(res.status_penyelesaian);
            });
        });

        $('#modalStatus').on('hidden.bs.modal', function(e) {
            $('.form-input').trigger('reset');
        })
    });
</script>