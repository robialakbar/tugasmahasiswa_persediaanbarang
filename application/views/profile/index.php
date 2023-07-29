<div class="result" data-hasil="<?php echo $this->session->flashdata('h'); ?>" data-tindakan="<?php echo $this->session->flashdata('t'); ?>" data-jenis="<?php echo $this->uri->segment(1); ?>"></div>

<div class="container-fluid">
    <?php if ($this->session->flashdata('error')) : ?>
      <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        Gagal memperbarui foto profile!
      </div>
    <?php endif; ?>
  <div class="row">
    <div class="col-md-3">
      

      <!-- Profile Image -->
      <div class="card card-primary card-outline">
        <div class="card-body box-profile">
          <div class="text-center">
            <img class="profile-user-img img-fluid img-circle" width="200" height="100"
                 src="<?php echo base_url('assets/img/user/'.$user['image']); ?>"
                 alt="User profile picture">
          </div>

          <h3 class="profile-username text-center"><?php echo $user['nama'] ?></h3>

          <p class="text-muted text-center"><?php echo $user['namarole']; ?></p>
          <hr>
          
          <button class="reset-foto btn btn-sm btn-primary float-right" data-reset="profile">Reset Foto</button>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->
    <div class="col-md-9">
      <div class="card card-primary card-outline">
        <div class="card-header pt-1 pl-1">
          <ul class="nav nav-pills">
            <li class="nav-item"><a class="nav-link active" href="#identitas" data-toggle="tab">Identitas</a></li>
            <li class="nav-item"><a class="nav-link" href="#edit" data-toggle="tab">Edit Profile</a></li>
            <li class="nav-item"><a class="nav-link" href="#password" data-toggle="tab">Ubah Password</a></li>
          </ul>
        </div><!-- /.card-header -->
        <div class="card-body">
          <div class="tab-content">
            <div class="active tab-pane" id="identitas">

              <!-- Post -->
              <div class="post">
                  <strong><i class="fas fa-envelope mr-1"></i> Email</strong>

                  <p class="text-muted pb-1 mb-1"><?php echo $user['email']; ?></p>
                  <hr class="mt-0 mb-1">
                  <strong><i class="fas fa-map-marker-alt mr-1"></i> Alamat</strong>
                  <p class="text-muted pb-1 mb-1"><?php echo $user['alamat']; ?></p>
                  <hr class="mt-0 mb-1">
                  <strong><i class="fas fa-pencil-alt mr-1"></i> Dibuat</strong>
                  <p class="text-muted pb-1 mb-1"><?php echo date('d F Y',  $user['tgl_dibuat']); ?></p>
                  <hr class="mt-0">
              </div>
              <!-- /.post -->
            </div>
            <!-- /.tab-pane -->

            <div class="tab-pane" id="edit">
              <?php echo form_open_multipart(base_url('profile'), ['class'=>'form-horizontal']);?>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="id">Id User</label>
                    <input type="text" class="form-control" value="<?php echo $this->session->userdata('id'); ?>" disabled>
                  </div>
                  <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?php echo $user['nama']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="alamat">Alamat</label>
                      <textarea rows="3" class="form-control px-1" name="alamat" id="alamat" placeholder="Alamat"><?php echo $user['alamat']; ?></textarea>
                  </div>

                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="<?php echo $user['username']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $user['email']; ?>">
                  </div>
                  <div class="form-group mb-2">
                    <label for="profile">Foto Profile</label>
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="picture" name="picture">
                        <label class="custom-file-label" for="picture">Pilih foto profil...</label>
                      </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-10">
                      <button type="submit" class="btn btn-primary">Edit</button>
                      <button type="reset" class="btn btn-default">Reset</button>
                    </div>
                  </div>

                </div>
              </div>
              </form>
            </div>
            <!-- /.tab-pane -->

            <div class="tab-pane" id="password">
              <form class="form-horizontal pass" method="post" action="<?php echo base_url('profile/password'); ?>">
                <div class="form-group row">
                  <label for="curpass" class="col-sm-3 col-form-label">Password</label>
                  <div class="col-sm-9">
                    <input type="password" class="form-control" id="curpass" name="curpass" placeholder="Masukkan Password Lama">
                    <?php echo form_error('curpass', '<small class="text-danger">','</small>'); ?>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="newpass" class="col-sm-3 col-form-label">Password Baru</label>
                  <div class="col-sm-9">
                    <input type="password" class="form-control" id="newpass" name="newpass" placeholder="Masukkan Password Baru">
                    <?php echo form_error('newpass', '<small class="text-danger">','</small>'); ?>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="konfpass" class="col-sm-3 col-form-label">Konfirmasi Password</label>
                  <div class="col-sm-9">
                    <input type="password" class="form-control" id="confpass" name="confpass" placeholder="Masukkan kembali password baru">
                    <?php echo form_error('confpass', '<small class="text-danger">','</small>'); ?>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="offset-sm-3 col-sm-9">
                    <button type="submit" class="change-pass btn btn-primary">Edit</button>
                    <button type="reset" class="btn btn-default">Reset</button>
                  </div>
                </div>
              </form>
            </div>
            <!-- /.tab-pane -->
          </div>
          <!-- /.tab-content -->
        </div><!-- /.card-body -->
      </div>
      <!-- /.nav-tabs-custom -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</div>
<!-- bs-custom-file-input -->
<script src="<?php echo base_url('assets/'); ?>plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
  bsCustomFileInput.init();
  $('form.pass').submit(function (e) {

    e.preventDefault();
    Swal.fire({
      title: 'Password akan diubah!',
      text: "Klik 'OK' untuk mengubah password!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'OK',
      cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.value) {
          this.submit();
        }
    });
  });

  $('.reset-foto').click(function () {
    let jenisReset = $(this).data('reset');
    let kelas, param;
    if (jenisReset=="profile") {
      kelas=jenisReset;
      param='';
    } else {
      kelas="users";
      param=jenisReset;
    }
    Swal.fire({
      title: 'Profile akan direset!',
      text: "Yakin reset foto?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Reset',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.value) {
        document.location.href = '<?php echo base_url(); ?>'+kelas+'/reset_foto/'+param;
      }
    })
  });

  const reset = '<?php echo $this->session->flashdata('reset'); ?>';
  if (reset == "success") {
    Swal.fire({
      title: 'Berhasil!',
      text: 'Foto berhasil di reset',
      icon: reset,
      showConfirmButton: false,
      timer: 3000
    });
  } else if (reset == "error") {
    Swal.fire({
      title: 'Gagal!',
      text: 'Foto gagal di reset',
      icon: reset,
      showConfirmButton: false,
      timer: 3000
    });
  }

  const errorValidPass = `<?php echo $this->session->flashdata('errorValidPass'); ?>`;

  if (errorValidPass) {
    $(document).Toasts('create', {
        icon: 'fas fa-exclamation-circle fa-lg',
        position: 'topRight',
        class: 'bg-danger mr-3 mt-3',
        width: 500,
        body: errorValidPass
      });

      $('.toast').css('min-width',200)
  }

  const passProfile = '<?php echo $this->session->flashdata('passProfile'); ?>';

  if (passProfile) {
    if (passProfile == "fp1") {
      Swal.fire({
        title: 'Gunakan password yang berbeda!',
        icon: 'info',
        showConfirmButton: false,
        timer: 3000
      });     
    } else if (passProfile == "fp2") {
      Swal.fire({
        title: 'Password salah!',
        icon: 'warning',
        showConfirmButton: false,
        timer: 3000
      });
    } else if (passProfile == "fp3") {
      Swal.fire({
        title: 'Gagal mengubah password!',
        icon: 'danger',
        showConfirmButton: false,
        timer: 3000
      });
    } else {
      Swal.fire({
        title: 'Password berhasil diubah!',
        icon: 'success',
        showConfirmButton: false,
        timer: 3000
      });
    }

  }

});
</script>