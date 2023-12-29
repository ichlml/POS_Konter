<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_transaksi extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('pdf_report');
        $this->load->model('m_laporan_k','lapkasir');
    }

    public function index()
    {
        $query = $this->lapkasir->report_transaksi();
        $data = array(
            'data' => $query->result()
        );
        $this->load->view('pegawai/kasir/laporan/v_transaksi', $data);
    }

    public function detail($tgl = null)
    {
        $data = array(
            'data' => $this->lapkasir->laporan_transaksi($tgl)->result()
        );
        $this->load->view('pegawai/kasir/laporan/v_detail', $data);
    }
}