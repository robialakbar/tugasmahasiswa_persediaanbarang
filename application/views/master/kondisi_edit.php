<div class="container-fluid">
  <div class="row">
    <!-- left column -->
    <div class="col-md-6">
      <!-- Horizontal Form -->
      <div class="card card-outline card-primary form-ubah-kategori">
        <div class="card-header">
          <h3 class="card-title font-weight-bold text-primary">Ubah Kondisi</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form class="form-horizontal" method="post" action="<?php base_url('kondisi/ubah/'.$kondisi['kd_kondisi']); ?>">
          <div class="card-body">            
            <div class="form-group row">
              <label for="lokasi" class="col-sm-2 col-form-label">Kondisi</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="kondisi" id="kondisi" placeholder="Kondisi" value="<?php echo $kondisi['kondisi']; ?>">
                <!-- <?php echo form_error('lokasi','<small class="pt-2 text-danger">', '</small>'); ?> -->
              </div>
            </div>
            
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <a type="button" class="btn btn-outline-primary" href="<?php echo base_url('kondisi'); ?>">
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
