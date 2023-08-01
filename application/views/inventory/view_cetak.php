<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <form method="post" action="<?php echo base_url('cetak?k='.$ruangan); ?>">
        <div class="invoice p-3 mb-3">
          <?php if($laporan == NULL) { ?>
          <div class="row">
            <h5 class="col-12 text-center">
              Tidak ada data barang 
            </h5>
          </div>

          <?php }else{ ?>

          <div class="row">
            <div class="col-12 table-responsive">
              <table class="table table-bordered table-stripped table-sm" id="table">
                <thead>
                  <tr class="text-center">
                    <th rowspan="2" width="20px">No.</th>
                    <th rowspan="2">Nama Barang</th>
                    <th rowspan="2">Kode Barang</th>
                    <th rowspan="2">Jumlah</th>
                    <th colspan="3">Kondisi</th>
                    <th rowspan="2">Keterangan</th>
                  </tr>
                  <tr class="text-center">
                    <?php foreach ($kondisi as $k): ?>
                      <th width="110px"><?php echo $k['kondisi']; ?></th>
                    <?php endforeach; ?>
                  </tr>
                </thead>
                <tbody>
                  <?php $no=0; foreach($laporan as $n => $k ): $no++;  ?>
                    <tr>
                      <td class="text-center"><?php echo $no; ?></td>
                      
                      <td><?php echo $n; ?></td>
                      <?php foreach($k as $k => $j ):?>
                        <td class="text-center"><?php echo $j; ?></td>
                      <?php endforeach; ?>
                      <td>
                          <input class="form-control" name="keterangan[]" placeholder="Masukkan Keterangan" autocomplete="off" />
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
          <div class="row no-print">
            <div class="col-12">
              <button type="submit" class="btn btn-default float-right">
                <i class="fas fa-print"></i> Print
              </button>
            </div>
          </div>
          <?php } ?>

        </div>
      </form>
      <!-- /.invoice -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</div>


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
    $('#table').DataTable({
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