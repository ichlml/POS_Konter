<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kasir extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if(!$this->session->has_userdata('level')){
            redirect('auth');
        }
        $this->load->model('m_kasir','kasir');
        $this->load->model('m_laporan_k','laporan');
    }

    public function index()
    {
        $data = array(
            'jumlah_transaksi' => $this->kasir->countTransaksi()->row('jumlah'),
            'terjual' => $this->kasir->countTerjual()->row('jumlah'),
            'top' => $this->kasir->terlarisH()->row('nama_b'),
            'stok' => $this->kasir->stok()->result()
        );
        $this->load->view('pegawai/header');
        $this->load->view('pegawai/dashboard');
        $this->load->view('pegawai/home', $data);
        $this->load->view('pegawai/footer');
    }

    public function transaksi()
    {
        
        $data = null;
        if(isset($_POST['beli'])){
            $data = $this->input->post();
            $add = $this->kasir->addTransaksi($data);
            if ($add)
            {
                $this->session->set_flashdata('success', 'Transaksi Berhasil');
                redirect('kasir/transaksi');
            }
        }
        $this->load->view('pegawai/header');
        $this->load->view('pegawai/dashboard');
        $this->load->view('pegawai/kasir/transaksi', $data);
        $this->load->view('pegawai/footer');      
    }

    public function get_nama_barang()
    {
        if (isset($_POST['data']))
        {
            $nm = $_POST['data'];
            $data = $this->kasir->getNamaBarang($nm)->result();
            echo json_encode($data);
        }
    }

    public function get_barang()
    {
        if (isset($_POST['data']))
        {
            $nm = $_POST['data'];
            $data = $this->kasir->getDataBarang($nm)->result();
            echo json_encode($data);
        }
    }

    public function edit_transaksi($id = null)
    {
        $data = array(
            'data' => $this->kasir->getDataTransaksi($id)->row()
        );
        $this->load->view('pegawai/header');
        $this->load->view('pegawai/dashboard');
        $this->load->view('pegawai/kasir/edit', $data);
        $this->load->view('pegawai/footer');    

    }

    public function update_transaksi($id = null)
    {   
        if (isset($_POST['edit']))
        {
            $data = $this->input->post();
            $e = $this->kasir->updateTransaksi($data);
            if ($e)
            {
                $this->session->set_flashdata('success', 'Update Data Berhasil');
                redirect('kasir/transaksi');
            }
            else
            {
                $this->session->set_flashdata('failed', 'Update Data Gagal');
                redirect('kasir/transaksi');
            }
        }
    }

    public function del_transaksi ($id = null)
    {
        $del = $this->kasir->delTransaksi($id);
        if ($del)
        {
            $this->session->set_flashdata('success', 'Delete Data Berhasil');
            redirect('kasir/transaksi');
        }
        else
        {
            $this->session->set_flashdata('failed', 'Delete Data Gagal');
            redirect('kasir/transaksi');
        }
    }

    public function ajaxTransaksi()
    {
        $list = $this->kasir->get_datatables();
        $data = array();
        $no = isset($_POST['start']) ? $_POST['start'] : null;
        foreach ($list as $barang) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $barang->id_transaksi;
            $row[] = $barang->kd_barang;
            $row[] = indo_date($barang->tgl_penjualan);
            $row[] = $barang->jumlah;
            $row[] = 'Rp. '.number_format($barang->sub_total);
            $row[] = $barang->id_transaksi;

    
            $data[] = $row;
        }
    
        $draw = isset($_POST['draw']) ? $_POST['draw'] : null;
        $output = array(
                        "draw" => $draw,
                        "recordsTotal" => $this->kasir->count_all(),
                        "recordsFiltered" => $this->kasir->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

        public function laporan()
        {
            $this->load->view('pegawai/header');
            $this->load->view('pegawai/dashboard');
            $this->load->view('pegawai/kasir/laporan');
            $this->load->view('pegawai/footer'); 
        }
}