<div class="result" data-hasil="<?php echo $this->session->flashdata('h'); ?>" data-tindakan="<?php echo $this->session->flashdata('t'); ?>" data-jenis="<?php echo $this->uri->segment(1); ?>"></div>

<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12">
			<div class="card card-outline card-primary" id="konten">
        <div class="card-header">
          <h3 class="card-title p-1 font-weight-bold text-primary">Daftar Barang</h3>
          <div class="card-tools">
		          <a href="<?php echo base_url('barang/tambah'); ?>">
		            <button type="button" class="btn btn-block btn-primary btn-sm">
		            	<i class="fas fa-plus"></i> Tambah Barang
		            </button>
		          </a>
          </div>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        
        <div id="bodyDataBarang" class="table-responsive table table-striped p-0">
          <table class="table table-hover">
            <thead >
              <tr>
                <th width="50px">No.</th>
                <th>Kode</th>
                <th>Nama Barang</th>
                <th>Stok</th>
                <th>Tindakan</th>
              </tr>
            </thead>
            <tbody>
              <?php $no=0; ?>
              <?php foreach ($barang as $b) : $no++?>
                <tr>
                  <td width="50px"><?php echo $no; ?></td>
	                <td><?php echo $b['kd_barang']; ?></td>
	                <td><?php echo $b['nama']; ?></td>
	                <td><?php echo $b['stok']; ?></td>
	                <td>
	                	<div class="btn-group">
                      <a href="<?php echo base_url('barang/ubah/'.$b['kd_barang']); ?>">
                        <button type="button" class="btn btn-sm btn-primary mr-1">
                          <i class="fas fa-edit"> Edit</i>
                        </button>
                      </a>
                      <a class="hapus-barang" data-jenis="barang" data-id="<?php echo $b['kd_barang']; ?>" >
                        <button type="button" class="btn btn-sm btn-danger">
                          <i class="fas fa-trash"> Hapus</i>
                        </button>
                      </a>
                    
                    </div>

	                </td>
                </tr>
              <?php endforeach ; ?>
            </tbody>
          </table>
        </div>



      </div>
		</div>
	</div>
</div>

<script type="text/javascript">
  $(function () {
    $('.hapus-barang').on('click', function () {
      var id = $(this).data('id');
      var jenis = $(this).data('jenis');
      
      Swal.fire({
        title: 'Barang akan dihapus!',
        text: "Menghapus barang akan menghapus stok yang ada. Anda yakin?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus Barang',
        cancelButtonText: 'Batal'
      }).then((result) => {
        
        if (result.value) {
          document.location.href = '<?php echo base_url(''); ?>'+jenis+'/hapus/'+id;
        }
      });
    });
  });
</script>