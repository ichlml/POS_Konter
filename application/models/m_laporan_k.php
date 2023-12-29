<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_laporan_k extends CI_Model {

    var $column_order = array('b.id_transaksi', 'a.id_barang','b.tgl_penjualan','b.jumlah','b.sub_total'); 
    var $column_search = array('b.id_transaksi', 'a.nama_b', 'a.id_barang','b.tgl_penjualan','b.jumlah'); 
    var $order = array('b.tgl_penjualan' => 'desc');
    

    public function laporan_transaksi($tgl = null)
    {
        $this->db->select("a.kd_barang , a.nama_b, b.tgl_penjualan, b.harga_awal_b, b.harga_jual_b, b.jumlah,b.sub_total, b.sub_total-(b.jumlah * a.harga_awal_b) as 'keuntungan'");
        $this->db->from('tb_barang as a');
        $this->db->join('tb_transaksi as b', 'a.id_barang = b.id_barang');
        $this->db->where('b.tgl_penjualan', $tgl);
        return $this->db->get();
    }

    public function report_transaksi()
    {
        $this->db->select("b.tgl_penjualan, SUM(b.jumlah) as 'jumlah', b.sub_total, SUM(b.sub_total-(b.jumlah * b.harga_awal_b)) as 'keuntungan', SUM((b.harga_jual_b - b.harga_awal_b)/b.harga_jual_b) as 'selisih'");
        $this->db->from('tb_barang as a');
        $this->db->join('tb_transaksi as b', ' b.id_barang = a.id_barang');
        $this->db->group_by('b.tgl_penjualan');
        $query = $this->db->get();
        return $query;
        }

    public function _get_datatables_query()
    {
        
        $this->db->select("b.tgl_penjualan, SUM(b.jumlah) as 'jumlah', b.sub_total, SUM(b.sub_total-(b.jumlah * b.harga_awal_b)) as 'keuntungan', SUM((b.harga_jual_b - b.harga_awal_b)/b.harga_jual_b) as 'selisih'");
        $this->db->from('tb_barang as a');
        $this->db->join('tb_transaksi as b', ' b.id_barang = a.id_barang');
        // $this->db->where('b.id_user',$this->sesion->id_user);
        $this->db->group_by('b.tgl_penjualan');

        // $this->db->query("SELECT b.tgl_penjualan, SUM(b.jumlah) as 'jumlah', b.sub_total, SUM(b.sub_total-(b.jumlah * a.harga_awal_b)) as 'keuntungan' from tb_transaksi as b inner join tb_barang as a on b.id_barang = a.id_barang group by b.tgl_penjualan");

        $i = 0;
    
        foreach ($this->column_search as $item) // loop column 
        {
            if(isset($_POST['search']['value'])) // if datatable send POST for search
            {
                
                if ($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
        
        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if (isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        $length = isset($_POST['length']) ? $_POST['length'] : null;
        $start = isset($_POST['start']) ? $_POST['start'] : null;
        
        if  ($length != -1)
        {
            $this->db->limit($length, $start);
            $query = $this->db->get();
            return $query->result();
        }
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from('tb_barang as a');
        $this->db->join('tb_transaksi as b', ' b.id_barang = a.id_barang');
        return $this->db->count_all_results();
    }
    
    public function delLapHari($id = null)
    {
        $this->db->where('tgl_penjualan', $id);
        return $this->db->delete('tb_transaksi');
    }
}