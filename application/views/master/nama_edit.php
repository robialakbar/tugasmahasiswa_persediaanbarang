<div class="container-fluid">
  <div class="row">
    <!-- left column -->
    <div class="col-md-6">
      <!-- Horizontal Form -->
      <div class="card card-outline card-primary">
        <div class="card-header">
          <h3 class="card-title">Ubah Nama Barang</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form class="form-horizontal" method="post" action="<?php base_url('nama/ubah/'.$nama['kd_nama']); ?>">
          <div class="card-body">
            <div class="form-group row">
              <label for="kode" class="col-sm-3 col-form-label">Kode</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="kode" id="kode" placeholder="<?php echo $nama['kd_nama']; ?>" readonly>
              </div>
            </div>
            <div class="form-group row">
              <label for="nama" class="col-sm-3 col-form-label">Nama Barang</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Barang" value="<?php echo $nama['nama']; ?>">
              </div>
            </div>
            <div class="form-group row">
              <label for="nama" class="col-sm-3 col-form-label">Harga Perolehan Barang</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="harga_perolehan" id="harga_perolehan" placeholder="Harga Perolehan Barang" value="<?php echo $nama['harga_perolehan']; ?>">
                
              </div>
            
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <a type="button" class="btn btn-outline-primary" href="<?php echo base_url('nama'); ?>">
              Kembali
            </a>
            <button type="submit" data-id="<?php echo $nama['kd_nama']; ?>" class="btn btn-primary float-right">Ubah</button>
          </div>
          <!-- /.card-footer -->
        </form>
      </div>
      <!-- /.card -->

    </div>
  </div>
</div>
