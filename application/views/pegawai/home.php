
<div class="row">
<div class="col-lg-4 col-xs-6">
  <!-- small box -->
  <div class="small-box bg-aqua">
    <div class="inner">
      <h3><?=$jumlah_transaksi?></h3>

      <p>Jumlah Transaksi</p>
    </div>
    <div class="icon">
      <i class="ion ion-arrow-swap"></i>
    </div>
  </div>
</div>
<div class="col-lg-4 col-xs-6">
  <!-- small box -->
  <div class="small-box bg-yellow">
    <div class="inner">
      <h3><?=$terjual?></h3>

      <p>Barang Terjual</p>
    </div>
    <div class="icon">
      <i class="ion ion-bag"></i>
    </div>
  </div>
</div>
<div class="col-lg-4 col-xs-6">
  <!-- small box -->
  <div class="small-box bg-green">
    <div class="inner">
      <h3>Barang Terlaris</h3>

      <p><?=$top?></p>
    </div>
    <div class="icon">
      <i class="ion ion-pie-graph"></i>
    </div>
  </div>
</div>
</div>
<div class="box box-warning">
  <div class="box-header"><h3>Panel Stok</h3></div>
    <div class="box-body">
            <table class="table table-striped">
              <thead>
                <th>No.</th>
                <th>Nama Barang</th>
                <th>Stok</th>
              </thead>
                          <?php
                                $no=1;
                                foreach($stok as $a){ 
                            ?>
              <tbody>
                <td><?=$no?></td>
                <td><?=$a->nama_b?></td>
                <td><?=$a->stok_b?></td>
              </tbody>
              <?php
                $no++;
                  }
              ?>
            </table>
    </div>
</div>
