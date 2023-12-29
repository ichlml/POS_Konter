<div class="container">
    <h3>Edit Transaksi</h3>
    <br>
        <div class="row">
            <div class="col-lg-3 col-md-4">
                <?= form_open(base_url('kasir/update_transaksi')); ?>
                    <div class="form-group">
                        <label for="id">ID Transaksi</label>
                        <input type="text" name="id" value="<?=isset($data) ? $data->id_transaksi : null?>" id="id" class="form-control" placeholder="ID Transaksi" readonly>
                    </div>
                    <div class="form-group">
                        <label for="nama_barang">Nama Barang</label>
                        <input type="text" name="nama_barang" value="<?=isset($data) ? $data->nama_b : null?>" id="nama_barang" class="form-control" placeholder="Nama Barang" readonly>
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga Barang</label>
                        <input type="text" name="harga" id="harga" value="<?=isset($data) ? $data->harga_jual_b : null?>" class="form-control" readonly placeholder="Harga">
                    </div>
                    <div class="form-group">
                        <label for="qty">Qty</label>
                        <input type="number" name="qty" id="qty" value="<?=isset($data) ? $data->jumlah : null?>" class="form-control" placeholder="qty">
                    </div>
                    <div class="form-group">
                        <label for="total">Total Harga</label>
                        <input type="number" name="total" id="total" value="<?=isset($data) ? $data->sub_total : null?>" class="form-control" placeholder="Jumlah Barang" readonly>
                    </div>
                    <br>
                    <input type="hidden" name="id" value="<?=isset($data) ? $data->id_transaksi : null?>" id="id">
                    <?=form_submit(array(
                        'name' => 'edit',
                        'value' => 'UPDATE',
                        'class' => 'btn btn-primary btn-sm'
                    ))?>
                    <a href="<?=base_url('kasir/transaksi')?>" class="btn btn-danger btn-sm">BATAL</a>
            </div>
                <?= form_close(); ?>
        </div>
</div>

<script>
    $('#qty').on('keyup', function(){
        var qty = $(this).val();
        var harga = $('#harga').val();
        var total = qty * harga;

        $('#total').val(total);
    })

    $('#qty').on('click', function(){
        var qty = $(this).val();
        var harga = $('#harga').val();
        var total = qty * harga;

        $('#total').val(total);
    })
</script>