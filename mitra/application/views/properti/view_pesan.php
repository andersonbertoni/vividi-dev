  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Pesanan Tamu
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Properti</a></li>
        <li class="active">Pesanan Tamu</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Pemesan</th>
                  <th>Check In</th>
                  <th>Check Out</th>
                  <th>Properti</th>
                  <th>Tipe Kamar</th>
                  <th>Jumlah</th>
                  <th>Harga</th>
                  <th>Tanggal Pesan</th>
                  <th>Status</th>
                  <th></th>
                </tr>
                </thead>
                <tbody>
                  <?php 
                    $no=1; 
                    foreach ($data as $row) { ?>
                    <tr>
                    <td><?php echo $row->id;?></td>
                    <td><?php echo $row->nama_awal;?> <?php echo $row->nama_akhir;?></td>
                    <td><?php echo $row->check_in;?></td>
                    <td><?php echo $row->check_out;?></td>
                    <td><?php echo $row->properti;?></td>
                    <td><?php echo $row->tipe_kamar;?></td>
                    <td><?php echo $row->jumlah;?></td>
                    <td><?php echo $row->harga;?></td>
                    <td><?php echo $row->pesan;?></td>
                    <td><?php echo $row->status;?></td>
                    <td><button class="btn btn-block" data-effect="mfp-zoomIn" id="<?php echo $row->id;?>" onclick="clickButton(<?php echo $row->id;?>)">Lihat</button></td>
                    </tr>
                  <?php } ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>ID</th>
                  <th>Pemesan</th>
                  <th>Check In</th>
                  <th>Check Out</th>
                  <th>Properti</th>
                  <th>Tipe Kamar</th>
                  <th>Jumlah</th>
                  <th>Harga</th>
                  <th>Tanggal Pesan</th>
                  <th>Status</th>
                  <th></th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
      <!-- Small boxes (Stat box) -->
    </section>
    <!-- /.content -->
  </div>