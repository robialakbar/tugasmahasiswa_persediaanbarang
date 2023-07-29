<div class="container-fluid">
  <div class="row">
    <div class="col-12 card p-1">
      <section class="invoice">
        <div class="row">
          <div class="offset-1 col-10">
            <img width="100%" src="<?php echo base_url('assets/img/laporan/KOPUNU.png'); ?>" class="rounded mx-auto d-block" alt="kop">
          </div>
          <!-- /.col -->
        </div>

        <div class="row">
          <div class="col-12">
            <div class="text-center mb-0">DATA INVENTARIS RUANGAN <?php echo strtoupper($ruang); ?></div>
            <div class="text-center mt-0">UNIVERSITAS NAHDLATUL ULAMA LAMPUNG</div>
          </div>
          <!-- /.col -->
        </div>

        <div class="row">
          <div class="offset-1 col-10">
            <div class="font-weight-bold">T.A <?php echo date('Y / '); echo intval(date('Y'))+1; ?></div>
          </div>
          <!-- /.col -->
        </div>

        <div class="row">
          <div class="offset-1 col-10 table-responsive">
            <table class="table table-bordered table-sm">
              <thead>
                <tr class="text-center">
                  <th rowspan="2" width="20px">No.</th>
                  <th rowspan="2">Kode Barang</th>
                  <th rowspan="2">Nama Barang</th>
                  <th rowspan="2" width="10px">Jumlah</th>
                  <th colspan="3">Kondisi</th>
                  <th rowspan="2" width="30%">Keterangan</th>
                </tr>
                <tr class="text-center">
                  <?php foreach ($kondisi as $k): ?>
                    <th width="110px"><?php echo $k['kondisi']; ?></th>
                  <?php endforeach; ?>
                </tr>
              </thead>
              <tbody>
                <?php $no=0; foreach($laporan as $n => $k ): $no++;?>
                  <tr>
                    <td class="text-center"><?php echo $no; ?></td>
                    <td><?php echo $kd_barang; ?></td>
                    <td><?php echo $n; ?></td>
                    <?php foreach($k as $k => $j ):?>
                      <td class="text-center"><?php echo $j; ?></td>
                    <?php endforeach; ?>
                    <td><?php echo $keterangan[$no-1]; ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>

        <div class="row mt-5">
          <div class="col-md-3 offset-md-8 text-center">
            <p class="mb-5 pb-5">
              Mengetahui, <br>Ketua Sarana dan Prasarana
            </p>
            Surasa
          </div>
        </div>

      </section>
      <div class="row no-print">
        <div class="col-12 p-3">
          <button class="btn btn-default float-right" onclick="window.print();">
            <i class="fas fa-print"></i> Print
          </button>
        </div>
      </div>
      <!-- /.invoice -->
    </div>
  </div>
</div>
<!-- /.content-wrapper -->