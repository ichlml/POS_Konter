<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kasir extends CI_Model {

    // var $table = 'tb_transaksi';
    var $column_order = array('id_transaksi', 'tb_transaksi.id_barang','tgl_penjualan','jumlah','sub_total'); 
    var $column_search = array('id_transaksi', 'tb_transaksi.id_barang','tgl_penjualan','jumlah','sub_total'); 
    var $order = array('tgl_penjualan' => 'desc');

    public function _get_datatables_query()
    {
        
        // $this->db->from($this->table);
        $this->db->select('id_transaksi, tb_transaksi.id_barang, kd_barang, tgl_penjualan, jumlah, sub_total');
        $this->db->from('tb_barang');
        $this->db->join('tb_transaksi', 'tb_barang.id_barang = tb_transaksi.id_barang');

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
        $this->db->from('tb_barang');
        $this->db->join('tb_transaksi', 'tb_barang.id_barang = tb_transaksi.id_barang');
        return $this->db->count_all_results();
    }
    
    public function addTransaksi($data)
    {
        date_default_timezone_set('Asia/Jakarta');
        $param = array(
            'id_transaksi' => 'TRS-'.time(),
            'id_user' => $this->session->id_user,
            'id_barang' => $data['id'],
            'harga_awal_b' => $data['h_awal'],
            'harga_jual_b' => $data['harga'],
            'jumlah' => $data['qty'],
            'tgl_penjualan' => date('Y-m-d', time()),
            'sub_total' => $data['total']
        );

        return $this->db->insert('tb_transaksi', $param);
    }
public function getDataTransaksi ($id = null)
    {
        $this->db->select("b.id_transaksi, a.nama_b, b.harga_jual_b, b.tgl_penjualan, b.jumlah, b.sub_total");
        $this->db->from("tb_barang as a");
        $this->db->join("tb_transaksi as b", "a.id_barang=b.id_barang");
        $this->db->where("b.id_transaksi", $id);
        return $this->db->get();
    }

    public function updateTransaksi($data)
    {
        $param = array(
            'jumlah' => $data['qty'],
            'sub_total' => $data['total']
        );
        $this->db->where('id_transaksi', $data['id']);
        return $this->db->update('tb_transaksi', $param);
    }

    public function delTransaksi ($id = null)
    {
        $this->db->where('id_transaksi', $id);
        return $this->db->delete('tb_transaksi');
    }

    public function getNamaBarang($nm)
    {
        $this->db->select('id_barang, nama_b');
        $this->db->from('tb_barang');
        $this->db->limit(5);
        $this->db->like('nama_b', $nm);
        return $this->db->get();
    }

    public function getDataBarang($nm)
    {
        $this->db->select('id_barang, harga_awal_b, harga_jual_b, stok_b');
        $this->db->from('tb_barang');
        $this->db->limit(5);
        $this->db->like('nama_b', $nm);
        return $this->db->get();
    }

    public function countTransaksi()
    {
        return $this->db->query("Select count(jumlah) as jumlah from tb_transaksi where tgl_penjualan=curdate()");
    }

    public function countUntung()
    {
        return $this->db->query("select SUM(tb_barang.harga_jual_b * tb_transaksi.jumlah) - SUM(tb_barang.harga_awal_b * tb_transaksi.jumlah) as 'untung' from tb_barang inner join tb_transaksi on tb_barang.id_barang = tb_transaksi.id_barang");
    }

    public function countTerjual()
    {
      return $this->db->query("select sum(jumlah) as jumlah from tb_transaksi where tgl_penjualan=curdate() group by tgl_penjualan ");
    }

    public function terlarisH()
    {
        return $this->db->query("select a.nama_b from tb_transaksi as b inner join tb_barang as a on a.id_barang=b.id_barang where b.tgl_penjualan=curdate() group by a.nama_b limit 1");
    } 

    public function stok()
    {
        $this->db->select('nama_b, stok_b');
        $this->db->from('tb_barang');
        $this->db->order_by('stok_b','ASC');
        $this->db->limit(10);
        return $this->db->get();
    }
}