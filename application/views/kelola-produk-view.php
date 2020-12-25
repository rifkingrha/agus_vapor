<?php $this->load->view('template-dashboard/header'); ?>
<!-- Modal Tambah -->
<div class="modal fade" id="modalProduk" tabindex="-1" role="dialog" aria-labelledby="modalProdukTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalProdukTitle">Data Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" class="form-horizontal form-input">
                    <input type="hidden" name="id_produk" id="id_produk">
                    <div class="form-group row">
                        <label for="nama_produk" class="col-sm-3 col-form-label">Nama Produk</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="nama_produk" id="nama_produk" placeholder="Nama Produk">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="harga" class="col-sm-3 col-form-label">Harga</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="harga" id="harga" placeholder="Harga">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="keterangan" class="col-sm-3 col-form-label">Keterangan</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="keterangan" id="keterangan" placeholder="Keterangan"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kategori" class="col-sm-3 col-form-label">Kategori</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="kategori" id="kategori">
                                <option value="">- Pilih Kategori -</option>
                                <?php foreach ($all_kat as $res) : ?>
                                    <option value="<?= $res['id_kategori'] ?>"><?= $res['nama_kategori'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="bekas_baru" class="col-sm-3 col-form-label">Baru/Bekas</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="bekas_baru" id="bekas_baru">
                                <option value="">- Baru/Bekas -</option>
                                <option value="0">Baru</option>
                                <option value="1">Bekas</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="image_produk" class="col-sm-3 col-form-label">Gambar Produk</label>
                        <div class="col-sm-9">
                            <input type="file" class="form-control" name="image_produk" id="image_produk" placeholder="Gambar Produk">
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
                    <h1 class="m-0 text-dark">Data Produk</h1>
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
                            <h3 class="card-title">Kelola Produk <?= $this->session->userdata('username') ?></h3>
                            <div class="card-toolbar">
                                <button class="btn btn-sm btn-dark float-right" data-toggle="modal" data-target="#modalProduk">Tambah Produk <i class="fas fa-plus"></i></button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="tabel_produk" class="table table-bordered table-hover text-center">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Produk</th>
                                        <th>Harga</th>
                                        <th>Keterangan</th>
                                        <th>Kategori</th>
                                        <th>Bekas/Baru</th>
                                        <th>Gambar Produk</th>
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
        $('#tabel_produk').DataTable({
            "responsive": true,
            'processing': true,
            'ajax': {
                'url': "<?php echo base_url('Kelola_produk/getDataProduk'); ?>",
                'dataSrc': function(json) {
                    return json;
                }
            },
            'columns': [{
                    "data": "nomor",
                    "className": "align-middle"
                },
                {
                    "data": "nama_produk",
                    "className": "align-middle"
                },
                {
                    "data": "harga",
                    render: function(data, type, row) {
                            data = mask_rupiah(row.harga);
                            return data;
                    },
                    "className": "align-middle"
                },
                {
                    "data": "keterangan",
                    "className": "align-middle"
                },
                {
                    "data": "nama_kategori",
                    "className": "align-middle"
                },
                {
                    "data": "bekas_baru",
                    render: function(data, type, row) {
                        if (row.bekas_baru == 0) {
                            data = 'baru';
                            return data;
                        } else {
                            data = 'bekas';
                            return data;
                        }
                    },
                    "className": "align-middle"
                },
                {
                    "data": "image_produk",
                    render: function(data, type, row) {
                        console.log(data)
                        data = '<img src="<?= base_url('assets/img/produk/'); ?>'+data+'?'+Date.now()+'"  style="widht:200px;height:200px" alt="">';
                        return data;
                    },
                    "className": "align-middle"
                },
                {
                    "data": "id_produk",
                    render: function(data, type, row) {
                        data = '<button class="btn btn-sm btn-primary btn-edit" data-toggle="modal" data-target="#modalProduk" data-edit="' + data + '"><i class="fas fa-edit"></i></button><button class="btn btn-sm btn-danger btn-delete" data-delete="' + data + '"><i class="fas fa-trash-alt"></i></button>';
                        return data;
                    },
                    "className": "align-middle"
                },
            ],
        });

        $(".form-input").on("submit", function(event) {
            event.preventDefault();
            var formData = new FormData($('.form-input')[0]);
            data_array = $(".form-input").serializeArray();
            id_produk = data_array[0].value;

            if (id_produk == null || id_produk == "") {
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('Kelola_produk/insertDataProduk'); ?>",
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        // $('.loading').show();
                    },
                }).done(function(result) {
                    // $('.loading').hide();
                    $('#modalProduk').modal('hide');
                    $("#tabel_produk").DataTable().ajax.reload(function() {
                        Swal.fire('Berhasil input data produk!', '', 'success');
                    });
                    $('.form-input').trigger('reset');
                });
            } else {
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('Kelola_produk/updateDataProduk'); ?>",
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        // $('.loading').show();
                    },
                }).done(function(result) {
                    // $('.loading').hide();
                    $('#modalProduk').modal('hide');
                    $("#tabel_produk").DataTable().ajax.reload(function() {
                        Swal.fire('Berhasil update data produk!', '', 'success');
                    });
                    $('.form-input').trigger('reset');
                });
            }
        });

        $('#tabel_produk').on('click', '.btn-edit', function() {
            var id_produk = $(this).data('edit');
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('Kelola_produk/getDataProduk'); ?>",
                data: {
                    'id_produk': id_produk
                },
                beforeSend: function() {
                    // $('.loading').show();
                },
            }).done(function(result) {
                // $('.loading').hide();
                var res = JSON.parse(result);
                $('#id_produk').val(res.id_produk);
                $('#nama_produk').val(res.nama_produk);
                $('#harga').val(res.harga);
                $('#keterangan').val(res.keterangan);
                $('#kategori').val(res.id_kategori);
                $('#bekas_baru').val(res.bekas_baru);
            });
        });

        $('#modalProduk').on('hidden.bs.modal', function(e) {
            $('.form-input').trigger('reset');
        })
    });

    $('#tabel_produk').on('click', '.btn-delete', function() {
        var id_produk = $(this).data('delete');
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Data yang sudah terhapus tidak dapat kembali!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('Kelola_produk/deleteDataProduk'); ?>",
                    data: {
                        id_produk: id_produk
                    },
                    beforeSend: function() {
                        // $('.loading').show();
                    },
                }).done(function(result) {
                    // $('.loading').hide();
                    $("#tabel_produk").DataTable().ajax.reload(function() {
                        Swal.fire('Berhasil hapus data produk!', '', 'success');
                    });
                });
            }
        });
    });
</script>