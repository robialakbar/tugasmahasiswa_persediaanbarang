<div class="result" data-hasil="<?php echo $this->session->flashdata('h'); ?>" data-tindakan="<?php echo $this->session->flashdata('t'); ?>" data-jenis="jenis barang"></div>

<div class="container-fluid">  
  <!-- /.row -->
  <div class="row">
    <div class="col-lg-8">
      <div class="card card-outline card-primary">
        <div class="card-header">
          <h3 class="card-title p-1 font-weight-bold text-primary">Daftar jenis</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-default">
              <i class="fas fa-plus"></i> Tambah Jenis
            </button>            
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
          <table class="table table-hover">
            <thead >
              <tr>
                <th width="50px">No.</th>
                <th>Kode</th>
                <th>Jenis</th>
                <th>Inisial</th>
              </tr>
            </thead>
            <tbody>

            <?php $i=1; 
              foreach ($jenis as $r) : ?>
                <tr>
                  <td width="50px"> <?php echo $i++; ?> </td>
                  <td> <?php echo $r['kd_jenis']; ?> </td>
                  <td> <?php echo $r['jenis']; ?> </td>
                  <td> <?php echo $r['inisial']; ?> </td>
                  
                  <td width="40%">
                    <div class="btn-group">
                      <!-- <a href="<?php echo base_url('admin/kategori/informasi-kategori-barang?action=info&id='.$r['kd_kategori']); ?>">
                        <button type="button" class="btn btn-sm btn-info mr-1">
                          <i class="fas fa-info"> Info</i>
                        </button>
                      </a> -->
                      <a href="<?php echo base_url('jenis/ubah/'.$r['kd_jenis']); ?>">
                        <button type="button" class="btn btn-sm btn-primary mr-1">
                          <i class="fas fa-edit"> Edit</i>
                        </button>
                      </a>
                      <a class="hapus-jenis" data-jenis="jenis" data-id="<?php echo $r['kd_jenis']; ?>" >
                        <button type="button" class="btn btn-sm btn-danger">
                          <i class="fas fa-trash"> Hapus</i>
                        </button>
                      </a>
                    
                    </div>
                  </td>
                </tr>
              <?php endforeach; ?>
             
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>
</div><!-- /.container-fluid -->

<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Form Tambah jenis</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-1">
        <form role="form" method="post" action="<?php echo base_url('jenis'); ?>">
          <div class="card-body">
            <div class="form-group">
              <label for="kode">Kode jenis</label>
              <input type="text" class="form-control" name="kode" id="kode" value="<?php echo $kode; ?>" readonly>
            </div>
            <div class="form-group">
              <label for="jenis">Nama jenis</label>
              <input type="text" class="form-control" name="jenis" id="jenis" placeholder="Masukkan jenis">
            </div>
            <div class="form-group">
              <label for="jenis">Inisial</label>
              <input type="text" class="form-control" name="inisial" id="jenis" placeholder="Masukkan inisial">
            </div>
          </div>
          <!-- /.card-body -->

          <div class="card-footer text-right">
            <button type="submit" class="btn btn-primary">Tambah</button>
          </div>
        </form>
      </div>
      
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<script type="text/javascript">
  $(function () {
    $('.hapus-jenis').on('click', function () {
      var id = $(this).data('id');
      var jenis = $(this).data('jenis');
      
      Swal.fire({
        title: 'Jenis barang akan dihapus!',
        text: " Anda yakin Akan Menghapus ?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus ',
        cancelButtonText: 'Batal'
      }).then((result) => {
        
        if (result.value) {
          document.location.href = '<?php echo base_url(''); ?>'+jenis+'/hapus/'+id;
        }
      });
    });
  });
</script>