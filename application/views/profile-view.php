<?php $this->load->view('template-dashboard/header-pembeli'); ?>
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Pilih foto profile</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="<?= site_url('Profile/updateProfilePict') ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id_customer" value="<?= $profile['id_customer']; ?>">
            <input type="file" name="profile_image" accept="image/*">        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
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
                    <h1 class="m-0 text-dark">Profile</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle" src="<?= base_url("assets/img/profile/" . $profile['profile_image']); ?>" alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center"><?= $profile['nama_lengkap']; ?></h3>

                            <p class="text-muted text-center"><?= $profile['username']; ?></p>

                            <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#exampleModalCenter">
                                <b>Ubah Foto Profile</b>
                            </button>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <h4>Ubah Profile</h4>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="<?= site_url('Profile/updateProfile') ?>" method="post" class="form-horizontal">
                            <input type="hidden" name="id_customer" value="<?= $profile['id_customer']; ?>">
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-3 col-form-label">Nama Lengkap</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="<?= $profile['nama_lengkap']; ?>" name="nama_lengkap" id="nama_lengkap" placeholder="Nama Lengkap">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-3 col-form-label">Tanggal Lahir</label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control" value="<?= $profile['tanggal_lahir']; ?>" name="tanggal_lahir" id="tanggal_lahir" placeholder="Tanggal Lahir">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="no_telp" class="col-sm-3 col-form-label">Nomor Telepon</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="<?= $profile['no_telp']; ?>" name="no_telp" id="no_telp" placeholder="Nomor Telepon">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control" value="<?= $profile['email']; ?>" name="email" id="email" placeholder="Email">
                                </div>
                            </div>
                        </div><!-- /.card-body -->
                    </div>
                    <div class="card">
                        <div class="card-header p-2">
                            <h4>Alamat</h4>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <h5>Alamat 1</h5>
                            <hr>
                            <div class="form-group row">
                                <label for="kota_kecamatan1" class="col-sm-3 col-form-label">Kota/Kecamatan</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="<?= $profile['kota_kecamatan1']; ?>" name="kota_kecamatan1" id="kota_kecamatan1" placeholder="Kota/Kecamatan">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="kode_pos1" class="col-sm-3 col-form-label">Kode Pos</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="<?= $profile['kode_pos1']; ?>" name="kode_pos1" id="kode_pos1" placeholder="Kode Pos">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="alamat1" class="col-sm-3 col-form-label">Alamat</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" name="alamat1" id="alamat1" placeholder="Alamat"><?= $profile['alamat1']; ?></textarea>
                                </div>
                            </div>
                            <h5>Alamat 2</h5>
                            <hr>
                            <div class="form-group row">
                                <label for="kota_kecamatan2" class="col-sm-3 col-form-label">Kota/Kecamatan</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="<?= $profile['kota_kecamatan2']; ?>" name="kota_kecamatan2" id="kota_kecamatan2" placeholder="Kota/Kecamatan">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="kode_pos2" class="col-sm-3 col-form-label">Kode Pos</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="<?= $profile['kode_pos2']; ?>" name="kode_pos2" id="kode_pos2" placeholder="Kode Pos">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="alamat2" class="col-sm-3 col-form-label">Alamat</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" name="alamat2" id="alamat2" placeholder="Alamat"><?= $profile['alamat2']; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="offset-sm-4 col-sm-8">
                                    <button type="submit" class="btn btn-danger btn-lg">Simpan Perubahan</button>
                                </div>
                            </div>
                            </form>
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.nav-tabs-custom -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php $this->load->view('template-dashboard/footer-pembeli'); ?>