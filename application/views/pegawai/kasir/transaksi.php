<h3>Panel Transaksi</h3>
<br>
<div class="box box-success">
    <br>
    <div class="box-body">
        <div class="row">
            <?= form_open(base_url('kasir/transaksi')); ?>
            <div class="form-group col-md-3">
                <label for="namaBrg">Nama Barang</label>
                <select name="nama_barang" id="namaBrg" class="form-control"></select>
            </div>
            <div class="form-group col-md-1">
                <label for="stok">Stok</label>
                <input type="text" id="stok" class="form-control" readonly>
            </div>
            <div class="form-group col-md-2">
                <label for="harga">Harga Barang</label>
                <input type="text" name="harga" id="harga" value="" class="form-control" readonly placeholder="Harga">
            </div>
            <div class="form-group col-md-2">
                <label for="qty">Qty</label>
                <input type="number" name="qty" id="qty" value="" min="0" class="form-control" placeholder="qty">
            </div>
            <div class="form-group col-md-2">
                <label for="total">Total Harga</label>
                <input type="number" name="total" id="total" value="" class="form-control" placeholder="Total" readonly>
            </div>
            <input type="hidden" name="id" id="id">
            <input type="hidden" name="h_awal" id="h_awal">
        </div>

        <div class="form-group">
            <?=form_submit(array(
                'name' => 'beli',
                'value' => 'BELI',
                'id' => 'beli',
                'class' => 'btn btn-primary btn-sm'
            ))?>
            <button type="reset" class="btn btn-danger btn-sm">RESET</button>
        </div>
        <?= form_close(); ?>
    </div>
</div>

<div class="box box-warning">
    <div class="box-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered" id="dataTransaksi">
                <thead>
                    <tr>
                        <th>No </th>
                        <th>ID Transaksi </th>
                        <th>Kode Barang </th>
                        <th>Tanggal </th>
                        <th>Qty </th>
                        <th>Sub Total </th>
                        <th>Aksi </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th></th>
                        <th></th>
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


<script>
 var table;
 $(document).ready(function() {

    $('#namaBrg').select2({
        ajax : {
            url : '<?=base_url('kasir/get_nama_barang')?>',
            type : 'POST',
            dataType : 'JSON',
            data : function(params){
                return{
                    data : params.term
                };
            },
            processResults : function(data){
                var results = [];

                $.each(data, function(index, item){
                    results.push({
                        id : item.id_barang,
                        text : item.nama_b
                    })
                });
                return {
                    results : results
                };
            }
        }
    }).on('select2:select', function (evt) {
         var nm = $("#namaBrg option:selected").text();
         $.ajax({
            type : 'POST',
            url : '<?=base_url('kasir/get_barang')?>',
            data : {data : nm},
            dataType : 'JSON',
            success : function(res){
                $('#id').val(res[0].id_barang);
                $('#h_awal').val(res[0].harga_awal_b);
                $('#harga').val(res[0].harga_jual_b);
                $('#stok').val(res[0].stok_b);
            }
        })
    });

    $('#qty').on('keyup', function(){
        var harga = $('#harga').val();
        var qty = parseInt($('#qty').val());
        var stok = parseInt($('#stok').val());
        var total = harga * qty;

        $('#total').val(total);

        if (qty > stok)
        {
            $('#beli').prop('disabled', true);
        }
        else
        {
            $('#beli').prop('disabled', false);
        }
    })

    $('#qty').on('click', function(){
        var harga = $('#harga').val();
        var qty = parseInt($('#qty').val());
        var stok = parseInt($('#stok').val());
        var total = harga * qty;

        $('#total').val(total);

        if (qty > stok)
        {
            $('#beli').prop('disabled', true);
        }
        else
        {
            $('#beli').prop('disabled', false);
        }
    })
  
    table = $('#dataTransaksi').DataTable({ 
  
        processing : true,
        serverSide : true,
        order: [],
  
        ajax: {
             "url": "<?php echo site_url('kasir/ajaxTransaksi')?>",
             "type": "POST"
        },
        //kolom action
        "columnDefs": [
            {
                "orderable" : false,
                "targets": [ 6 ],
                "render": function(data, type, row){
                    var btn;
                    btn = "<a href=\"<?=base_url('kasir/edit_transaksi/')?>"+data+"\" class=\"btn btn-warning btn-sm\"><span class=\"fa fa-edit\"></span><span> Edit</span></a>&nbsp;<a href=\"<?=base_url('kasir/del_transaksi/')?>"+data+"\" class=\"btn btn-danger btn-sm\" onClick=\"return confirm('Yakin ingin menghapus ?')\"><span class=\"fa fa-trash\"></span><span> Hapus</span>";
                    return btn;
                }   
            }
        ]
    });
 });
</script>