<?php if($this->session->userdata('role')=="Petugas") : ?>
  <div class="result" data-hasil="<?php echo $this->session->flashdata('h'); ?>" data-tindakan="<?php echo $this->session->flashdata('t'); ?>" data-jenis="barang"></div>
<?php endif; ?>

<div class="container-fluid">
  <div class="row">
    <div class="col-md-6">
      <div class="card card-outline card-primary form-ubah-kategori collapsed-card">
        <div class="card-header">
          <h3 class="card-title font-weight-bold text-primary">Filter Ruangan</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-block btn-xs btn-primary" data-card-widget="collapse"><i class="fas fa-plus"></i>
            </button>
          </div>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
          <div class="card-body">            
            <form class="form-horizontal" method="post" action="<?php base_url('barang'); ?>">
            <div class="form-group row">
              <label for="ruangan" class="col-sm-2 col-form-label">Kondisi</label>
              <div class="col-sm-10">
                <select class="form-control" id="ruangan" name="ruangan">
                  <option value="" selected>--Pilih ruangan--</option>
                  <?php foreach ($ruang as $r) : ?>
                    <option value="<?php echo $r['no_ruang'] ?>" ><?php echo $r['ruang']; ?></option>
                  <?php endforeach; ?>
                </select>                 
              </div>
            </div>
            
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <a type="button" class="btn btn-outline-primary" href="<?php echo base_url('kondisi'); ?>">
              Kembali
            </a>
            <input type="submit" class="btn btn-primary float-right" name="submitfilter" value="Filter" />
          </div>
          <!-- /.card-footer -->
        </form>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <div class="card card-outline card-primary">
        <div class="card-header">
          <h3 class="card-title p-1 font-weight-bold text-primary">Data Barang</h3>

        <?php if($this->session->userdata('role')=="Petugas") : ?>
          <div class="card-tools">
            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-default">
              <i class="fas fa-trash"></i>Hapus
            </button>  
          </div>
        <?php endif; ?>


        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>Id Barang</th>
              <th>Barang</th>
              <th>Kondisi</th>
              <th>Ruangan</th>
              <th>Sumber</th>
              <th>Jenis Barang</th>
              <th>Jumlah Barang</th>
              <th>Tahun</th>
              <th>Harga Perolehan</th>
              <th>User</th>
              <th>Tindakan</th>
            </tr>
            </thead>
            <tbody>

            <?php foreach($barang as $b) : ?>
              <tr>
                <td><?php echo $b['kd_barang']; ?></td>
                <td><?php echo $b['nama']; ?></td>
                <td><?php echo $b['kondisi']; ?></td>
                <td><?php echo $b['ruang']; ?></td>
                <td><?php echo $b['sumber']; ?></td>
                <td><?php echo $b['jenis']; ?></td>
                <td><?php echo $b['stok']; ?></td>
                <td><?php echo $b['tahun']; ?></td>
                <td><?php echo 'Rp. '.number_format($b['harga_perolehan'],0, ",", "."); ?></td>
                <td><?php echo $b['username']; ?></td>
                <td>                  
                  <?php if($this->session->userdata('role')=="Petugas") { ?>
                    <a href="<?php echo base_url('info/detail?id='.$b['kd_barang']); ?>" class="badge bg-info">Detail</a>
                    <a href="<?php echo base_url('barang/ubah?id='.$b['kd_barang']); ?>" class="badge bg-primary">Edit</a>
                    <!-- <a href="<?php echo base_url('barang/hapus?id='.$b['kd_barang']); ?>" class="badge bg-danger">Hapus</a> -->
                  <?php } else { ?>
                    <a href="<?php echo base_url('info/detail?id='.$b['kd_barang']); ?>" class="btn btn-info btn-sm font-weight-bold">Detail</a>
                  <?php } ?>
                </td>
              </tr>

            <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer"></div>
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</div>

<?php if($this->session->userdata('role')=="Petugas") : ?>
<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Hapus Barang</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-1">
        <form role="form" class="delete-barang" method="post" action="<?php echo base_url('barang/hapus'); ?>">
          <div class="card-body">
            <div class="form-group">
              <label for="kode">Id Barang</label>
              <input type="text" class="form-control" name="id_brg" id="id_brg" placeholder="Masukkan Id Barang">
            </div>
          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Hapus</button>
            <button type="button" class="btn btn-default float-right" data-dismiss="modal" aria-label="Close">Batal</button>
          </div>
        </form>
      </div>
      
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<?php endif; ?>

<script type="text/javascript">
  $(function () {
    $('form.delete-barang').submit(function (e) {

      e.preventDefault();
      Swal.fire({
        title: 'Barang akan dihapus!',
        text: "Klik 'Hapus' untuk menghapus barang!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus',
        cancelButtonText: 'Batal'
      }).then((result) => {
          if (result.value) {
            this.submit();
          }
      });
    });

    const hapusBarang = `<?php echo $this->session->flashdata('hapusBarang'); ?>`;
    if (hapusBarang) {
      $(document).Toasts('create', {
        icon: 'fas fa-exclamation-circle fa-lg',
        position: 'topRight',
        class: 'bg-danger mr-3 mt-3',
        width: 500,
        body: hapusBarang
      });

      $('.toast').css('min-width',200);      
    }

  });
</script>

<!-- DataTables -->
<script src="<?php echo base_url('assets/'); ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url('assets/'); ?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url('assets/'); ?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url('assets/'); ?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>