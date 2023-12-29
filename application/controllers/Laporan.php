<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('level')!='kasir')
        {
            redirect('auth');
        }
        $this->load->model('m_laporan_k', 'lapkasir');
    }
    public function index()
    {
        $this->load->view('pegawai/header');
        $this->load->view('pegawai/dashboard');
        $this->load->view('pegawai/kasir/laporan');
		$this->load->view('pegawai/footer');
    }

    public function laporanhari()
    {
        $list = $this->lapkasir->get_datatables();
        $data = array();
        $no = isset($_POST['start']) ? $_POST['start'] : null;
        foreach ($list as $barang) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = indo_date($barang->tgl_penjualan);
            $row[] = $barang->jumlah;
            $row[] = 'Rp. '.number_format($barang->sub_total);
            $row[] = $barang->tgl_penjualan;
            
            $data[] = $row;
        }
 
        $draw = isset($_POST['draw']) ? $_POST['draw'] : null;
        $output = array(
                        "draw" => $draw,
                        "recordsTotal" => $this->lapkasir->count_all(),
                        "recordsFiltered" => $this->lapkasir->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function detail_laporan($tgl = null)
    {
        $data = array(
            'detail' => $this->lapkasir->laporan_transaksi($tgl)->result()
        );
        $this->load->view('pegawai/header');
        $this->load->view('pegawai/dashboard');
        $this->load->view('pegawai/kasir/detail_laporan', $data);
        $this->load->view('pegawai/footer');
    }
    
    public function del($id)
    {
        $del = $this->lapkasir->delLapHari($id);
    
    $this->load->view('pegawai/header');
    $this->load->view('pegawai/dashboard');
    $this->load->view('pegawai/kasir/laporan');
    $this->load->view('pegawai/footer');
    }
}