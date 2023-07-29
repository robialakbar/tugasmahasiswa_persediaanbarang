<div class="result" data-hasil="<?php echo $this->session->flashdata('h'); ?>" data-tindakan="<?php echo $this->session->flashdata('t'); ?>" data-jenis="<?php echo $this->uri->segment(1); ?>"></div>

<div class="container-fluid">  
  <!-- /.row -->
  <div class="row">
    <div class="col-lg-8">
      <div class="card card-outline card-primary">
        <div class="card-header">
          <h3 class="card-title p-1 font-weight-bold text-primary">Daftar kelas</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-default">
              <i class="fas fa-plus"></i> Tambah kelas
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
                <th>Nama kelas</th>
                <th>Tindakan</th>
              </tr>
            </thead>
            <tbody>

            <?php $i=1; 
              foreach ($kelas as $r) : ?>
                <tr>
                  <td width="50px"> <?php echo $i++; ?> </td>
                  <td> <?php echo $r['kd_kelas']; ?> </td>
                  <td> <?php echo $r['kelas']; ?> </td>
                  
                  <td width="40%">
                    <div class="btn-group">
                      <!-- <a href="<?php echo base_url('admin/kategori/informasi-kategori-barang?action=info&id='.$r['kd_kategori']); ?>">
                        <button type="button" class="btn btn-sm btn-info mr-1">
                          <i class="fas fa-info"> Info</i>
                        </button>
                      </a> -->
                      <a href="<?php echo base_url('kelas/ubah/'.$r['kd_kelas']); ?>">
                        <button type="button" class="btn btn-sm btn-primary mr-1">
                          <i class="fas fa-edit"> Edit</i>
                        </button>
                      </a>
                      <a class="hapus-kelas" data-jenis="kelas" data-id="<?php echo $r['kd_kelas']; ?>" >
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
        <h4 class="modal-title">Form Tambah Ruang Kelas</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-1">
        <form role="form" method="post" action="<?php echo base_url('kelas'); ?>">
          <div class="card-body">
            <div class="form-group">
              <label for="kode">Kode kelas</label>
              <input type="text" class="form-control" name="kode" id="kode" value="<?php echo $kode; ?>" readonly>
            </div>
            <div class="form-group">
              <label for="kelas">Nama kelas</label>
              <input type="text" class="form-control" name="kelas" id="kelas" placeholder="Masukkan kelas">
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
    $('.hapus-kelas').on('click', function () {
      var id = $(this).data('id');
      var ruang = $(this).data('jenis');
      
      Swal.fire({
        title: 'kelas akan dihapus!',
        text: " Anda yakin Akan Menghapus ?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus ',
        cancelButtonText: 'Batal'
      }).then((result) => {
        
        if (result.value) {
          document.location.href = '<?php echo base_url(''); ?>'+ruang+'/hapus/'+id;
        }
      });
    });
  });
</script>