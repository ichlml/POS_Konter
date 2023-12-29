<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_laporan_a extends CI_Model {
    
    public function lap_bulan()
    {
        $this->db->select("MONTH(tgl_penjualan) as bulan, YEAR(tgl_penjualan) as tahun, SUM(jumlah) as terjual, SUM(jumlah) as jumlah, SUM(sub_total) as total, SUM((harga_jual_b*jumlah)-(harga_awal_b*jumlah)) as keuntungan");
        $this->db->from('tb_transaksi');
        $this->db->group_by('MONTH(tgl_penjualan)');
        $this->db->order_by('tgl_penjualan', 'DESC');
        return $this->db->get();
    }

    public function lap_bulanan_detail($bulan, $tahun)
    {
        $this->db->select("nama_b, tb_transaksi.harga_awal_b, tb_transaksi.harga_jual_b, SUM(jumlah) as jumlah, SUM(sub_total) as total, SUM(sub_total - (tb_transaksi.harga_awal_b * jumlah)) as keuntungan");
        $this->db->from('tb_transaksi');
        $this->db->join('tb_barang', 'tb_transaksi.id_barang = tb_barang.id_barang');
        $this->db->where('MONTH(tgl_penjualan)', $bulan);
        $this->db->where('YEAR(tgl_penjualan)', $tahun);
        $this->db->group_by('nama_b');
        $this->db->order_by('tgl_penjualan');
        return $this->db->get();
    }

    public function countTransaksi()
    {
        date_default_timezone_set('Asia/Jakarta');
        $bulan = date('m', time());
        $tahun = date('Y', time());

        $this->db->select('id_transaksi');
        $this->db->from('tb_transaksi');
        $this->db->where('MONTH(tgl_penjualan)', $bulan);
        $this->db->where('YEAR(tgl_penjualan)', $tahun);
        return $this->db->count_all_results();
    }

    public function countBrgTerjual()
    {
        date_default_timezone_set('Asia/Jakarta');
        $bulan = date('m', time());
        $tahun = date('Y', time());
        
        $this->db->select_sum('jumlah');
        $this->db->from('tb_transaksi');
        $this->db->where('MONTH(tgl_penjualan)', $bulan);
        $this->db->where('YEAR(tgl_penjualan)', $tahun);
        return $this->db->get()->row();
    }
    
    public function labaRugiBulan()
    {
        date_default_timezone_set('Asia/Jakarta');
        $bulan = date('m', time());
        $tahun = date('Y', time());

        $this->db->select("SUM(sub_total-(harga_awal_b*jumlah)) as keuntungan");
        $this->db->from('tb_transaksi');
        $this->db->where('MONTH(tgl_penjualan)', $bulan);
        $this->db->where('YEAR(tgl_penjualan)', $tahun);
        return $this->db->get()->row();
    }

    public function countTransaksiTgl($tgl)
    {
        $this->db->select("id_transaksi");
        $this->db->from("tb_transaksi");
        $this->db->where("tgl_penjualan", $tgl);
        return $this->db->count_all_results();
    }

    public function countBrgTerjualTgl($tgl)
    {
        $this->db->select("SUM(jumlah) as jumlah");
        $this->db->from("tb_transaksi");
        $this->db->where("tgl_penjualan", $tgl);
        return $this->db->get();
    }

    public function labaRugiTgl($tgl)
    {
        $this->db->select("SUM(sub_total-(harga_awal_b*jumlah)) as keuntungan");
        $this->db->from("tb_transaksi");
        $this->db->where("tgl_penjualan", $tgl);
        return $this->db->get();
    }
}
