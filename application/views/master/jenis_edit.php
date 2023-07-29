<div class="container-fluid">
  <div class="row">
    <!-- left column -->
    <div class="col-md-6">
      <!-- Horizontal Form -->
      <div class="card card-outline card-primary">
        <div class="card-header">
          <h3 class="card-title">Ubah Jenis Barang</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form class="form-horizontal" method="post" action="<?php base_url('jenis/ubah/'.$jenis['kd_jenis']); ?>">
          <div class="card-body">
            <div class="form-group row">
              <label for="kode" class="col-sm-2 col-form-label">Kode</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="kode" id="kode" placeholder="<?php echo $jenis['kd_jenis']; ?>" readonly>
              </div>
            </div>
            <div class="form-group row">
              <label for="jenis" class="col-sm-2 col-form-label">Jenis Barang</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="jenis" id="jenis" placeholder="Masukkan jenis" value="<?php echo $jenis['jenis']; ?>">
                
              </div>
            </div>
            <div class="form-group row">
              <label for="jenis" class="col-sm-2 col-form-label">Inisial</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="inisial" id="inisial" placeholder="Masukkan inisial" value="<?php echo $jenis['inisial']; ?>">
                
              </div>
            </div>
            
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <a type="button" class="btn btn-outline-primary" href="<?php echo base_url('jenis'); ?>">
              Kembali
            </a>
            <button type="submit" data-id="<?php echo $jenis['kd_jenis']; ?>" class="btn btn-primary float-right">Ubah</button>
          </div>
          <!-- /.card-footer -->
        </form>
      </div>
      <!-- /.card -->

    </div>
  </div>
</div>
