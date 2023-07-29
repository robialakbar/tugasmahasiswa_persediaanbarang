<div class="container-fluid">
  <!-- /.row -->
  <div class="row">
    <!-- left column -->
    <div class="col-md-3">
      

      <!-- Profile Image -->
      <div class="card card-primary card-outline">
        <div class="card-body box-profile">
          <div class="text-center">
            <img class="profile-user-img img-fluid img-circle" width="200" height="100"
                 src="<?php echo base_url('assets/img/user/'.$users['image']); ?>"
                 alt="User profile picture">
          </div>

          <h3 class="profile-username text-center">UNU Lampung</h3>

          <p class="text-muted text-center">Petugas</p>

          <!-- <div class="text-center">
            <a href="#"> 
              <small class="reset-foto text-primary text-center" data-reset="<?php echo $users['kd_user']; ?>">Reset Foto
              </small> 
            </a>
          </div> -->
          <hr>
          
          <!-- <button class="reset-foto btn btn-sm btn-primary float-right" data-reset="<?php echo $users['kd_user']; ?>">Reset Foto</button> -->
        </div>
        <!-- /.card-body -->
      </div>

      <!-- /.card -->
    </div>
    <div class="col-md-9">
      <!-- Horizontal Form -->
      <div class="card card-outline card-primary">
        <div class="card-header">
          <h3 class="card-title font-weight-bold text-primary">Form Ubah User</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
          <form class="form-horizontal" method="post" action="<?php echo base_url('users/ubah/'.$users['kd_user']); ?>">
            <div class="card-body row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="kode">Id User</label>
                  <input type="text" class="form-control" name="kode" id="kode" value="<?php echo $users['kd_user']; ?>" readonly>
                </div>
                <div class="form-group">
                  <label for="nama">Nama</label>
                  <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukkan Nama" value="<?php echo $users['nama']; ?>">
                </div>
                <div class="form-group">
                  <label for="alamat">Alamat</label>
                  <textarea rows="3" class="form-control px-1" name="alamat" id="alamat" placeholder="Alamat"><?php echo $users['alamat']; ?></textarea>
                </div>
              </div>
              
              <div class="col-md-6">
                <div class="form-group">
                  <label for="username">Username</label>
                  <input type="text" class="form-control" name="username" id="username" placeholder="Masukkan Username" value="<?php echo $users['username']; ?>" readonly>
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" name="email" id="email" placeholder="Masukkan Email" value="<?php echo $users['email']; ?>">
                </div>
                <div class="form-group mb-2 row">
                  <div class="col-md-6">
                    <label for="role">Role</label>
                    <div class="input-group">
                      <select class="form-control" id="role" name="role">
                        <option value="" >--Role--</option>
                        <?php foreach ($role as $r) : ?>
                          <option value="<?php echo $r['kd_role'] ?>" <?php echo $users['role'] == $r['kd_role'] ? 'selected' : ''; ?> ><?php echo $r['role']; ?></option>
                        <?php endforeach; ?>
                      </select>
                      <span class="input-group-append">
                        <a class="btn btn-primary" href="<?php echo base_url('role'); ?>">
                          <i class="fas fa-plus"></i></a>
                      </span>
                    </div>
                    
                  </div>
                  <div class="col-md-6">
                    <label>Status User</label>
                    <div class="input-group">
                      <select class="form-control" id="status" name="status">
                        <option value="">--Status User--</option>
                        <?php 
                          $aktif = 0; 
                          if ($users['aktif']==1) {
                            $aktif = 1;
                          }
                        ?>
                        <option value="1" <?php echo $aktif > 0 ? 'selected' : ''; ?>>Aktif</option>
                        <option value="0" <?php echo $aktif == 0 ? 'selected' : ''; ?>>Non-Aktif</option>
                      </select>
                    </div>
                  </div>


                </div>
                <div class="form-group row">
                  <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Ubah</button>
                    <button type="reset" class="btn btn-default">Reset</button>
                    <a type="button" class="btn btn-default float-right" href="<?php echo base_url('users'); ?>">
                      Kembali
                    </a>
                  </div>
                </div>
              </div>
              
            </div>
            <!-- /.card-body -->
            <div class="card-footer ">
              
            </div>
            <!-- /.card-footer -->
          </form>

      </div>
      <!-- /.card -->

    </div>
  </div>
</div><!-- /.container-fluid -->
<script type="text/javascript">
  $(document).ready(function () {
    const reset = '<?php echo $this->session->flashdata('reset'); ?>';
    if (reset == "success") {
      Swal.fire({
        title: 'Berhasil!',
        text: 'Foto berhasil di reset',
        icon: reset,
        showConfirmButton: true
      });
    } else if (reset == "danger") {
      Swal.fire({
        title: 'Gagal!',
        text: 'Foto gagal di reset',
        icon: reset,
        showConfirmButton: true
      });
    }
  });
</script>