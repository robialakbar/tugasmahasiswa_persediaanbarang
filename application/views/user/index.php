<div class="result" data-hasil="<?php echo $this->session->flashdata('h'); ?>" data-tindakan="<?php echo $this->session->flashdata('t'); ?>" data-jenis="user"></div>


<div class="container-fluid">
  <!-- /.row -->
  <div class="row">
    <div class="col-lg-12">
      <div class="card card-outline card-primary">
        <div class="card-header">
          <h3 class="card-title p-1 font-weight-bold text-primary">Daftar User</h3>

          <div class="card-tools">
            <a href="<?php echo base_url('users?action=tambah'); ?>" type="button" class="btn btn-sm btn-primary">
              <i class="fas fa-plus"></i> Tambah User
            </a>
            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-default">
              <i class="fas fa-undo"></i> Reset Password
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
                <th>Username</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Akses</th>
                <th>Status</th>
                <th>Tindakan</th>
              </tr>
            </thead>
            <tbody>

            <?php $i=1; 
              foreach ($users as $u) : ?>
                <tr>
                  <td width="50px"> <?php echo $i++; ?> </td>
                  <td> <?php echo $u['kd_user']; ?> </td>
                  <td> <?php echo $u['username']; ?> </td>
                  <td> <?php echo $u['nama']; ?> </td>
                  <td> <?php echo $u['email']; ?> </td>
                  <td> <?php echo $u['namarole']; ?> </td>
                  <td> 
                    <?php 
                      $name=$u['username'];
                      if ($u['aktif']<1) {
                        $value = 'unactive';
                        $checked='';
                        $label = 'Tidak aktif';
                      } else {
                        $value = 'active';
                        $checked='checked';
                        $label = 'Aktif';
                      }

                      echo $label;
                    ?>
                    <!-- <div class="custom-control custom-switch">
                      <input type="checkbox" 
                        class="custom-control-input status-aktif" 
                        value="<?php echo $value; ?>"
                        data-id="<?php echo $u['kd_user']; ?>" 
                        name="<?php echo $name; ?>" 
                        id="<?php echo $name ?>" 
                        <?php echo $checked; ?>
                        />
                      <label class="custom-control-label label-status" for="<?php echo $name; ?>"><?php echo $label; ?></label>
                    </div> -->
              
                  </td>
                  
                  <td width="20%">
                    <div class="btn-group">
                      <!-- <a href="<?php echo base_url('admin/users/informasi-user?action=info&id='.$u['kd_user']); ?>">
                        <button type="button" class="btn btn-sm btn-info mr-1">
                          <i class="fas fa-info"> Info</i>
                        </button>
                      </a> -->
                      <a href="<?php echo base_url('users/ubah/'.$u['kd_user']); ?>">
                        <button type="button" class="btn btn-sm btn-primary mr-1">
                          <i class="fas fa-edit"> Edit</i>
                        </button>
                      </a>
                      <a class="hapus-user" data-jenis="users" data-id="<?php echo $u['kd_user']; ?>" >
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
        <h4 class="modal-title">Reset Password</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-1">
        <form role="form" method="post" action="<?php echo base_url('users'); ?>">
          <div class="card-body">
            <div class="form-group">
              <label for="kode">Kode user</label>
              <input type="text" class="form-control" name="kode" id="kode" placeholder="Masukkan Kode User">
            </div>
          </div>
          <!-- /.card-body -->

          <div class="card-footer text-right">
            <button type="submit" class="btn btn-primary">Reset</button>
          </div>
        </form>
      </div>
      
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<!-- bs-custom-file-input -->
<script src="<?php echo base_url('assets/'); ?>plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
  bsCustomFileInput.init();

  $(".status-aktif").click(function () {
    const status = $(this).val();
    const id = $(this).data('id');
    document.location.href = '<?php echo base_url('users/ubah_status?user='); ?>'+id+'&status='+status;
  });

  const ubahStatus = `<?php echo $this->session->flashdata('ubah_status'); ?>`;
  if (ubahStatus) {
    let title, text, icon;
    if (ubahStatus=="successaktif" || ubahStatus=="successunaktif") {
      title = 'Berhasil!';
      text="User berhasil diaktifkan!";
      icon="success";
      if (ubahStatus=='successunaktif') {
        text = "User berhasil di non-aktifkan!";
        icon= "error";
      }
    } else {
      title = 'Gagal!';
      text="User gagal diaktifkan!";
      icon="success";
      if (ubahStatus=='errorunaktif') {
        text = "User gagal di non-aktifkan!";
        icon= "error";
      }
    }
    Swal.fire({
      title: title,
      text: text,
      icon: icon,
      showConfirmButton: true,
    });   
  }

  const resetPass = `<?php echo $this->session->flashdata('reset_password'); ?>`;
  if (resetPass) {
    let title, text;
    if (resetPass=="success") {
      title = "Berhasil!";
      text = "Password behasil direset!";
    } else {
      title = "Gagal!";
      text = "Password gagal direset!";
    }
    Swal.fire({
      title: title,
      text: text,
      icon: resetPass,
      showConfirmButton: true,
    });    
  }

});

$(function () {
    $('.hapus-user').on('click', function () {
      var id = $(this).data('id');
      var jenis = $(this).data('jenis');
      
      Swal.fire({
        title: 'Nama barang akan dihapus!',
        text: "Menghapus nama barang akan menghapus stok yang ada. Anda yakin?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus',
        cancelButtonText: 'Batal'
      }).then((result) => {
        
        if (result.value) {
          document.location.href = '<?php echo base_url(''); ?>'+jenis+'/hapus/'+id;
        }
      });
    });
  });
</script>
