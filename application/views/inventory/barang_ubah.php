<div class="result" data-hasil="<?php echo $this->session->flashdata('h'); ?>" data-tindakan="<?php echo $this->session->flashdata('t'); ?>" data-jenis="barang"></div>

<div class="container-fluid">
  <div class="row">
    <!-- left column -->
    <div class="col-md-6">
      <!-- Horizontal Form -->
      <div class="card card-outline card-primary">
        <div class="card-header">
          <h3 class="card-title font-weight-bold text-primary">Form Edit Barang<h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
          <form class="form-horizontal" method="post" action="<?php echo base_url('barang/ubah?id='.$barang['kd_barang']); ?>">
            <div class="card-body p-0">
              <table class="table">
                <tbody class="">
                  <tr>
                    <td width="150px">Id Barang</td>
                    <td>:</td>
                    <td><?php echo $barang['kd_barang']; ?></td>
                  </tr>
                  <tr>
                    <td>Barang</td>
                    <td>:</td>
                    <td><?php echo $barang['nama']; ?></td>
                  </tr>
                  <tr>
                    <td>Ruangan</td>
                    <td>:</td>
                    <td><?php echo $barang['ruang']; ?></td>
                  </tr>
                </tbody>
              </table>
              <hr class="mt-1">
              <div class="form-group row justify-content-between mr-2">
                <label for="kondisi" class="col-sm-3 col-form-label text-right">Kondisi Barang</label>
                <div class="col-sm-8 input-group">
                  <select class="form-control" id="kondisi" name="kondisi">
                    <option value="" selected>--Kondisi Barang--</option>
                    <?php foreach ($kondisi as $k) : ?>
                      <option value="<?php echo $k['kd_kondisi'] ?>" <?php echo $k['kd_kondisi']==$barang['kondisi_kd'] ? 'selected' : '';  ?> ><?php echo $k['kondisi']; ?></option>
                    <?php endforeach; ?>
                  </select> 
                </div>
              </div>
              <div class="form-group row justify-content-between mr-2">
                <label for="status" class="col-sm-3 col-form-label text-right">Status</label>
                <div class="col-sm-8 input-group">
                  <input class="form-control" id="status" name="status" placeholder="Masukkan Status" value="<?php echo $barang['status']; ?>" />
                </div>
              </div>
              <div class="form-group row mr-2">
                <div class="col-md-8 offset-md-4">
                  <button type="submit" class="btn btn-primary">Ubah</button>
                  <button type="reset" class="btn btn-default">Reset</button>
                  <a href="<?php echo base_url('info'); ?>" type="reset" class="btn btn-default float-right">Kembali</a>
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