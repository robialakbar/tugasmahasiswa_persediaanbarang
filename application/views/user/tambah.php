<div class="container-fluid">
  <!-- /.row -->
  <div class="row justify-content-center">
    <!-- left column -->
    <div class="col-md-8">
      <!-- Horizontal Form -->
      <div class="card card-outline card-primary">
        <div class="card-header">
          <h3 class="card-title font-weight-bold text-primary">Form Tambah User</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
          <form class="form-horizontal" method="post" action="<?php echo base_url('users?action=tambah'); ?>">
            <div class="card-body">
              <div class="form-group row">
                <label for="kode" class="col-sm-3 col-form-label text-right">Kode User</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="kode" id="kode" value="<?php echo $kode; ?>" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label for="username" class="col-sm-3 col-form-label text-right">Username</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="username" id="username" placeholder="Masukkan Username" value="<?php echo set_value('username'); ?>">
                </div>
              </div>
              <div class="form-group row">
                <label for="nama" class="col-sm-3 col-form-label text-right">Nama</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukkan Nama" value="<?php echo set_value('nama'); ?>">
                </div>
              </div>
              <div class="form-group row">
                <label for="email" class="col-sm-3 col-form-label text-right">Email</label>
                <div class="col-sm-9">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Masukkan Email" value="<?php echo set_value('email'); ?>">
                </div>
              </div>
              <div class="form-group row">
                <label for="role" class="col-sm-3 col-form-label text-right">Role</label>
                <div class="col-sm-9 input-group">
                  <select class="form-control" id="role" name="role">
                    <option value="" >--Role--</option>
                    <?php foreach ($role as $r) : ?>
                      <option value="<?php echo $r['kd_role'] ?>" <?php echo set_select('role', $r['kd_role']); ?> ><?php echo $r['role']; ?></option>
                    <?php endforeach; ?>
                  </select>
                  <span class="input-group-append">
                    <a class="btn btn-primary" href="<?php echo base_url('role'); ?>">
                      <i class="fas fa-plus"></i></a>
                  </span>
                </div>
              </div>
              <div class="form-group row">
                <label for="alamat" class="col-sm-3 col-form-label text-right">Alamat</label>
                <div class="col-sm-9">
                  <textarea class="form-control" name="alamat" id="alamat" placeholder="Alamat"><?php echo set_value('alamat'); ?></textarea>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-9 offset-md-3">
                  <button type="submit" class="btn btn-primary">Tambah</button>
                  <button type="reset" class="btn btn-default">Reset</button>
                  <a type="button" class="btn btn-default float-right" href="<?php echo base_url('users'); ?>">
                    Kembali
                  </a>
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