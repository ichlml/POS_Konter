<h3>Laporan Harian</h3>
<br>
<div class="box box-warning">
    <div class="box-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered" id="laporan">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal Penjualan </th>
                        <th>Barang Terjual</th>
                        <th>Total Penjualan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script type="text/javascript">
 var table;
 $(document).ready(function() {
  
     table = $('#laporan').DataTable({ 
  
        processing : true,
        serverSide : true,
        order: [],
  
        ajax: {
             "url": "<?php echo site_url('laporan/laporanhari')?>",
             "type": "POST"
         },
         //kolom 1 - no
         "columnDefs": [
         { 
             "targets": [ 0 ],
             "orderable": false,
         },
         ],
         
        //kolom action
        "columnDefs": [
            {
                "orderable" : false,
                "targets": [ 4 ],
                "render": function(data, type, row){
                        var btn;
                        btn = "<a href=\"<?=base_url('laporan/detail_laporan/')?>"+data+"\" class=\"btn btn-warning btn-sm\"><span class=\"fa fa-edit\"></span><span> Detail</span></a> <a href=\"<?=base_url('report_transaksi/detail/')?>"+data+"\" class=\"btn btn-primary btn-sm\"><span class=\"fa fa-file-pdf\"></span><span> Export PDF</span></a>";

                        return btn;
                    }   
                }
            ],
  
     });
  
 });
 </script>