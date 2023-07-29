<div class="container-fluid">
  
  <div class="row">
    <div class="col-12 col-sm-6 col-md-3">
      <div class="info-box">
        <a href="<?php echo base_url('info'); ?>" class="info-box-icon bg-info elevation-1"><i class="fas fa-boxes"></i></a>

        <div class="info-box-content">
          <span class="info-box-text">Barang</span>
          <span class="info-box-number"><?php echo $barang; ?></span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-12 col-sm-6 col-md-3">
      <div class="info-box mb-3">
        <a href="<?php echo base_url('nama'); ?>" class="info-box-icon bg-danger elevation-1"><i class="fas fa-bookmark"></i></a>

        <div class="info-box-content">
          <span class="info-box-text">Nama Barang</span>
          <span class="info-box-number"><?php echo $nama; ?></span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->

    <!-- fix for small devices only -->
    <div class="clearfix hidden-md-up"></div>

    <div class="col-12 col-sm-6 col-md-3">
      <div class="info-box mb-3">
        <a href="<?php echo base_url('kondisi'); ?>" class="info-box-icon bg-success elevation-1"><i class="fas fa-tasks"></i></a>

        <div class="info-box-content">
          <span class="info-box-text">Kondisi</span>
          <span class="info-box-number"><?php echo $kondisi; ?></span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-12 col-sm-6 col-md-3">
      <div class="info-box mb-3">
        <a href="<?php echo base_url('users'); ?>" class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></a>

        <div class="info-box-content">
          <span class="info-box-text">Users</span>
          <span class="info-box-number"><?php echo $users; ?></span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
  </div>
  
</div>