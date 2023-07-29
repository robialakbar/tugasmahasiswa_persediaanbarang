<div class="container-fluid">
  <div class="row">
    <!-- left column -->
    <div class="col-md-6">
      <!-- Horizontal Form -->
      <div class="card card-outline card-primary">
        <div class="card-header">
          <h3 class="card-title">Ubah Ruangan</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form class="form-horizontal" method="post" action="<?php base_url('ruangan/ubah/'.$ruangan['kd_ruang']); ?>">
          <div class="card-body">
            <div class="form-group row">
              <label for="kode" class="col-sm-2 col-form-label">Kode</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="kode" id="kode" placeholder="<?php echo $ruangan['kd_ruang']; ?>" readonly>
              </div>
            </div>
            <div class="form-group row">
              <label for="ruangan" class="col-sm-2 col-form-label">Ruangan</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="ruangan" id="ruangan" placeholder="Masukkan Ruangan" value="<?php echo $ruangan['ruang']; ?>">
                
              </div>
            </div>
            
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <a type="button" class="btn btn-outline-primary" href="<?php echo base_url('ruangan'); ?>">
              Kembali
            </a>
            <button type="submit" class="btn btn-primary float-right">Ubah</button>
          </div>
          <!-- /.card-footer -->
        </form>
      </div>
      <!-- /.card -->

    </div>
  </div>
</div>
