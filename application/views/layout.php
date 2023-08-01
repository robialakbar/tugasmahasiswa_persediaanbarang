<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Invetory Barang</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('assets/'); ?>plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo base_url('assets/'); ?>dist/css/adminlte.min.css">
  
  <?php if ($this->uri->segment(1)=="barang" || $this->uri->segment(1)=="info") : ?>
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url('assets/'); ?>plugins/datatables/datatables.min.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/'); ?>plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/'); ?>plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <?php endif; ?>

  <!-- daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url('assets/'); ?>plugins/daterangepicker/daterangepicker.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/'); ?>plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- jQuery -->
  <script src="<?php echo base_url('assets/'); ?>plugins/jquery/jquery.min.js"></script>
  <!-- SweetAlert2 -->
  <script src="<?php echo base_url('assets/'); ?>plugins/sweetalert2/sweetalert2.min.js"></script>
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark navbar-primary">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>   
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-user"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-xl dropdown-menu-right">
          <!-- Widget: user widget style 1 -->
          <div class="card-widget widget-user">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-primary">
              <h3 class="widget-user-username"> <?php echo $user['nama']; ?> </h3>
              <h5 class="widget-user-desc"> <?php echo $user['namarole'] ?> </h5>
            </div>
            <div class="widget-user-image">
              <img class="img-circle elevation-2" src="<?php echo base_url('assets/img/user/'.$user['image']); ?>" alt="User Avatar">
            </div>
            <div class="card-footer">
              <a href="<?php echo base_url('profile'); ?>" class="btn btn-primary btn-flat">Profile</a>
              <a href="<?php echo base_url('logout'); ?>" class="btn btn-primary btn-flat float-right">Logout</a>
              <!-- /.row -->
            </div>
          </div>
          <!-- /.widget-user -->
        </div>
      </li>
 
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar elevation-4 sidebar-light-navy">
    <!-- Brand Logo -->
    <a href="<?php echo base_url('admin'); ?>" class="brand-link ">
      <!-- <img src="<?php echo base_url('assets/'); ?>dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
      <span class="brand-text font-weight-light">UNU LAMPUNG</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column text-sm nav-compact nav-flat nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <?php if ($this->session->userdata('role') != "Petugas") : ?>
          <li class="nav-header" style="padding: 1.7rem 1rem 0.5rem ">Inventory</li>
          <li class="nav-item">
            <a href="<?php echo base_url('info'); ?>" class="nav-link">
              <i class="nav-icon fas fa-boxes"></i>
              <p>
                Data Barang
              </p>
            </a>
          </li>
          <?php endif;?>
          <?php if ($this->session->userdata('role') == "Petugas") : ?>
          <li class="nav-header" style="padding: 1.7rem 1rem 0.5rem ">ADMINISTRATOR</li>
          <li class="nav-item ">
            <a href="<?php echo base_url('dashboard'); ?>" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-header">INVENTORY</li>
          <li class="nav-item">
            <a href="<?php echo base_url('info'); ?>" class="nav-link">
              <i class="nav-icon fas fa-boxes"></i>
              <p>
                Data Barang
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url('transaksi_masuk'); ?>" class="nav-link">
              <i class="nav-icon fas fa-download"></i>
              <p>Transaksi Barang Masuk</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url('laporan'); ?>" class="nav-link">
              <i class="nav-icon fas fa-print"></i>
              <p>Cetak Laporan Barang</p>
            </a>
          </li>
         
          <li class="nav-header">Proses</li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tasks"></i>
              <p>
                Data Master
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item ">
            <a href="<?php echo base_url('nama'); ?>" class="nav-link">
              <i class="nav-icon far fa-circle"></i>
              <p>
                Nama Barang
              </p>
            </a>
          </li>
          <li class="nav-item ">
            <a href="<?php echo base_url('ruangan'); ?>" class="nav-link">
              <i class="nav-icon far fa-circle"></i>
              <p>
                Ruangan
              </p>
            </a>
          </li>
          

          <!--<li class="nav-item has-treeview">
          <a href="#" class="nav-link">
              <i class="nav-icon far fa-circle"></i>
              <p>
                Daftar Ruang Kelas
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item ">
            <a href="<?php echo base_url('ruangan1'); ?>" class="nav-link">
              <i class="nav-icon far fa-circle"></i>
              <p>
                Lantai 1
              </p>
            </a>
          </li>

          <li class="nav-item ">
            <a href="<?php echo base_url('sumber'); ?>" class="nav-link">
              <i class="nav-icon far fa-circle"></i>
              <p>
                Lantai 2
              </p>
            </a>
          </li>

          <li class="nav-item ">
            <a href="<?php echo base_url('sumber'); ?>" class="nav-link">
              <i class="nav-icon far fa-circle"></i>
              <p>
                Lantai 3
              </p>
            </a>
          </li>
          </ul>
        </li>
          </li>-->

          <li class="nav-item ">
            <a href="<?php echo base_url('sumber'); ?>" class="nav-link">
              <i class="nav-icon far fa-circle"></i>
              <p>
                Sumber
              </p>
            </a>
          </li>

          <li class="nav-item ">
            <a href="<?php echo base_url('jenis'); ?>" class="nav-link">
              <i class="nav-icon far fa-circle"></i>
              <p>
                Jenis Barang
              </p>
            </a>
          </li>

          <li class="nav-item ">
            <a href="<?php echo base_url('tahun'); ?>" class="nav-link">
              <i class="nav-icon far fa-circle"></i>
              <p>
                Tahun Perolehan
              </p>
            </a>
          </li>

          <!-- <li class="nav-item ">
            <a href="<?php echo base_url('lokasi'); ?>" class="nav-link">
              <i class="nav-icon fas fa-map-marker-alt"></i>
              <p>
                Lokasi
              </p>
            </a>
          </li> -->
          <li class="nav-item">
            <a href="<?php echo base_url('kondisi') ?>" class="nav-link">
              <i class="nav-icon far fa-circle"></i>
              <p>Kondisi</p>
            </a>
          </li>
            </ul>
          </li>


          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Users
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url('users'); ?>" class="nav-link">
                  <i class="nav-icon far fa-circle"></i>
                  <p>Data User</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('role'); ?>" class="nav-link">
                  <i class="nav-icon far fa-circle"></i>
                  <p>Role</p>
                </a>
              </li>
            </ul>
          </li>
        <?php endif; ?>


          <li class="nav-header">OPTIONS</li>
          <li class="nav-item ">
            <a href="<?php echo base_url('logout'); ?>" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Logout
              </p>
            </a>
          </li>

          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">    
            <h1 class="m-0 text-dark"><?php echo $title; ?></h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <?php $this->load->view($content); ?>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer no-print">
    <div class="float-right d-none d-sm-block">
      
    </div>
    
		
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- Bootstrap 4 -->
<script src="<?php echo base_url('assets/'); ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/'); ?>dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url('assets/'); ?>dist/js/demo.js"></script>
<!-- date-range-picker -->
<script src="<?php echo base_url('assets/'); ?>plugins/daterangepicker/daterangepicker.js"></script>

<script src="<?php echo base_url('assets/'); ?>dist/js/sky.js"></script>


<script src="<?php echo base_url('assets/'); ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url('assets/'); ?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url('assets/'); ?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url('assets/'); ?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo base_url('assets/'); ?>plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url('assets/'); ?>plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url('assets/'); ?>plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?php echo base_url('assets/'); ?>plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?php echo base_url('assets/'); ?>plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?php echo base_url('assets/'); ?>plugins/jszip/jszip.min.js"></script>

<script type="text/javascript">

  $(function () {
    let formError = 0;
    <?php if($this->uri->segment(1)=="profile" && $this->uri->segment(2)=="password") : ?>
      formError = <?php echo $password_form; ?>;
    <?php endif; ?>

    const validError = `<?php echo validation_errors(); ?>`;
    if (formError==0) {
      if (validError) {
        $(document).Toasts('create', {
          icon: 'fas fa-exclamation-circle fa-lg',
          position: 'topRight',
          class: 'bg-danger mr-3 mt-3',
          width: 500,
          body: validError
        });

        $('.toast').css('min-width',200)
      }
    }

      $(function () {
        $('#table').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "responsive": true,
          dom: 'Bfrtip',
          buttons: [
              'copyHtml5',
              'excelHtml5',
              'csvHtml5',
              'pdfHtml5'
          ]
        });
      });
    
    // $('.ubah-kategori').on('click', function () {
    //   const id = $(this).data('id');

    //   $('.form-ubah-kategori form').removeAttr('action');
    //   $('.form-ubah-kategori form').attr('action', 'http://localhost/inventory-system2/admin/kategori/ubah?action=edit&id='+id);
    // });
    
      
  });

</script>
</body>
</html>
