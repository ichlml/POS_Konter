<h3>Detail Laporan Perhari</h3>
<br>
<!-- <a href="<?=base_url('report_transaksi/detail/'.$detail[0]->tgl_penjualan)?>" type="submit" class="btn btn-danger btn-md">
    <span class="fa fa-file-pdf"></span>
    <span> Export PDF</span>
</a> -->

<br><br>
<div class="box box-success">
    <div class="box-body">
        <table class="table table-striped table-bordered" id="detailLaporan">
            <thead>
                <tr>
                    <th>No </th>
                    <th>Kode Barang </th>
                    <th>Nama </th>
                    <th>Tanggal </th>
                    <th>Harga</th>
                    <th>Terjual </th>
                    <th>Total </th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if ($detail == null)
                    {
                        echo "<tr>";
                        echo "<td class=\"text-center\" colspan=\"6\">Data Kosong</td>";
                        echo "</tr>";
                    }
                    $no=1;
                    foreach($detail as $dt){
                ?>
                <tr>
                    <td><?=$no?></td>
                    <td><?=$dt->kd_barang?></td>
                    <td><?=$dt->nama_b?></td>
                    <td><?=indo_date($dt->tgl_penjualan)?></td>
                    <td><?='Rp. '.number_format($dt->harga_jual_b)?></td>
                    <td><?=$dt->jumlah?></td>
                    <td><?='Rp. '.number_format($dt->sub_total)?></td>
                <?php
                    $no++;
                    }
                ?>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<script>
    $(window).ready(function(){
        $('#detailLaporan').DataTable({
        });
    })
</script>
