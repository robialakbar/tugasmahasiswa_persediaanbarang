<div class="container-fluid">
  <div class="row">
    <div class="col-md-7">      

      <!-- Profile Image -->
      <div class="card card-primary card-outline ml-4">
        <div class="card-header">
          <h3 class="card-title font-weight-bold text-primary">Detail Barang</h3>
        </div>
        <!-- <div class="card-body">
          <dl class="">
            <dt class="col-sm-4">Kode Barang</dt>
            <dd class="col-sm-8"><?php echo $barang['kd_barang']; ?></dd>
            
            <dt class="col-sm-4">Nama Barang</dt>
            <dd class="col-sm-8"><?php echo $barang['nama']; ?></dd>
            
            <dt class="col-sm-4">Kondisi Barang</dt>
            <dd class="col-sm-8"><?php echo $barang['kondisi']; ?></dd>
            
            <dt class="col-sm-4">Ruangan</dt>
            <dd class="col-sm-8"><?php echo $barang['ruang']; ?></dd>
            
            <dt class="col-sm-4">Tanggal Masuk</dt>
            <dd class="col-sm-8"><?php echo date('d F Y', strtotime($barang['tgl_masuk'])); ?></dd>
            
            <dt class="col-sm-4">Status</dt>
            <dd class="col-sm-8"><?php echo $barang['status']; ?></dd>
            
            <dt class="col-sm-4">Username</dt>
            <dd class="col-sm-8"><?php echo $barang['username']; ?></dd>
          </dl>
        </div> -->
        <div class="card-body">
          <table class="table">
            <thead class="bg-primary">
              <tr>
                <th width="30px">No.</th>
                <th>Item</th>
                <th width="30px"></th>
                <th>Keterangan</th>
              </tr>
            </thead>
            <tbody class="table-info">
              <tr>
                <td>1</td>
                <td>Kode Barang</td>
                <td>:</td>
                <td><?php echo $barang['kd_barang']; ?></td>
              </tr>
              <tr>
                <td>2</td>
                <td>Nama Barang</td>
                <td>:</td>
                <td><?php echo $barang['nama']; ?></td>
              </tr>
              <tr>
                <td>3</td>
                <td>Kondisi Barang</td>
                <td>:</td>
                <td><?php echo $barang['kondisi']; ?></td>
              </tr>
              <tr>
                <td>4</td>
                <td>Ruangan</td>
                <td>:</td>
                <td><?php echo $barang['ruang']; ?></td>
              </tr>
              <tr>
                <td>5</td>
                <td>Sumber</td>
                <td>:</td>
                <td><?php echo $barang['sumber']; ?></td>
              </tr>
              <tr>
                <td>6</td>
                <td>Jenis Barang</td>
                <td>:</td>
                <td><?php echo $barang['jenis']; ?></td>
              </tr>
              <tr>
                <td>7</td>
                <td>Tahun Perolehan</td>
                <td>:</td>
                <td><?php echo $barang['tahun']; ?></td>
              </tr>
              <tr>
                <td>8</td>
                <td>Status Barang</td>
                <td>:</td>
                <td><?php echo $barang['status']; ?></td>
              </tr>
              <tr>
                <td>9</td>
                <td>User</td>
                <td>:</td>
                <td><?php echo $barang['username']; ?></td>
              </tr>
            </tbody>
          </table>
        </div> 
        <!-- /.card-body -->
        
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->
    <!-- /.col -->
  </div>
  <!-- /.row -->
</div>
<!-- bs-custom-file-input -->
<script src="<?php echo base_url('assets/'); ?>plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>