<div class="container-fluid">
  <div class="row justify-content-center">
    <!-- left column -->
    <div class="col-md-7">
      <!-- Horizontal Form -->
      <div class="card card-outline card-primary">
        <div class="card-header">
          <h3 class="card-title font-weight-bold text-primary">Pilih Ruangan</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
          <form class="form-horizontal" method="post" action="<?php echo base_url($this->uri->segment(1)) ?>">
            <div class="card-body">
              
              <div class="form-group row">
                <label for="kategori" class="col-sm-3 col-form-label text-right">Kategori</label>
                <div class="col-sm-9 input-group">
                  <select class="form-control" id="ruangan" name="ruangan">
                    <option value="" selected>--Pilih Ruangan--</option>
                    <?php foreach ($ruang as $r) : ?>
                      <option value="<?php echo $r['no_ruang'] ?>" ><?php echo $r['ruang']; ?></option>
                    <?php endforeach; ?>
                  </select> 
                </div>
              </div>
              
              
              <div class="form-group row">
                <div class="col-md-9 offset-md-3">
                  <button type="submit" class="btn btn-primary">Proses</button>
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
</div>