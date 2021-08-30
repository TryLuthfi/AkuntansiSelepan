<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rincian extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('MRincian');
    }

    public function index()
    {
        $now = date('Y-m-d');

        $data['title'] = 'Rincian';
        $data['judul'] = 'Rincian Hari Ini';
        $data['rincian'] = $this->MRincian->getData();
        $data['kode_akun'] = $this->db->get('tb_kode')->result_array();

        $this->load->view('Templates/01_Header', $data);
        $this->load->view('Templates/02_Menu');
        $this->load->view('Rincian/Index', $data);
        $this->load->view('Templates/03_Footer');
        $this->load->view('Templates/99_JS');
    }

    public function add()
    {
        // echo ("<pre>");
        // print_r($_POST);
        // echo ("</pre>");

        $last_data = $this->db->query('SELECT id_rincian FROM tb_rincian order by id_rincian DESC LIMIT 1');
        foreach ($last_data->result() as $row) {
            $hasil_data =  $row->id_rincian;
        }
        $hasil_data = $hasil_data + 1;

        $tanggal = $_POST['tanggal'];
        $tanggal_baru = explode("-", $tanggal);
        $kode_rincian = $tanggal_baru[2] . $tanggal_baru[1] . $tanggal_baru[0] . $hasil_data;

        $nominal = filter_var($_POST['nominal'], FILTER_SANITIZE_NUMBER_INT);

        $hasil_data = array(
            'kode_rincian' => $kode_rincian,
            'tanggal_rincian' => $_POST['tanggal'],
            'debit_rincian' => $_POST['debit'],
            'keterangan_rincian' => $_POST['nama_barang'],
            'nominal_rincian' => $nominal,
            'kredit_rincian' => $_POST['kredit']
        );

        $res = $this->MRincian->addPengeluaran($hasil_data);

        if ($res >= 1) {
            $this->session->set_flashdata('status', 'sukses');
            redirect("Rincian");
        } else {
            $this->session->set_flashdata('status', 'gagal');
            redirect("Rincian");
        }
    }

    public function edit()
    {

        echo ("<pre>");
        print_r($_POST);
        echo ("</pre>");

        // $nominal = filter_var($_POST['nominal'], FILTER_SANITIZE_NUMBER_INT);

        // $data_array = array(
        //     'tanggal_rincian' => $_POST['tanggal'],
        //     'debit_rincian' => $_POST['debit'],
        //     'keterangan_rincian' => $_POST['nama_barang'],
        //     'nominal_rincian' => $nominal,
        //     'kredit_rincian' => $_POST['kredit']
        // );

        // $where = array('id_rincian' => $_POST['id_barang']);

        // $res = $this->MRincian->updateData($data_array, $where);

        // if ($res >= 1) {
        //     $this->session->set_flashdata('status', 'sukses');
        //     redirect("Rincian");
        // } else {
        //     $this->session->set_flashdata('status', 'gagal');
        //     redirect("Rincian");
        // }

    }

    public function delete($id)
    {
        $id_barang = array('id_rincian' => $id);
        $res = $this->MRincian->deleteData($id_barang);

        if ($res >= 1) {
            $this->session->set_flashdata('status', 'sukses');
            redirect("Rincian");
        } else {
            $this->session->set_flashdata('status', 'gagal');
            redirect("Rincian");
        }
    }

    public function search()
    {
        $tgl = $this->input->post('date');

        $tglpecah = explode(" - ", $tgl);
        $start = $tglpecah[0];
        $end = $tglpecah[1];
        $kalStart = implode("", array($start));
        $kalEnd = implode("", array($end));
        $awal = date('Y-m-d', strtotime($kalStart));
        $akhir = date('Y-m-d', strtotime($kalEnd));

        if ($awal == $akhir) {
            $data['rincian'] = $this->db->query('SELECT
	rincian.id_rincian as id_rincian,
    rincian.tanggal_rincian as tanggal_rincian,
    rincian.debit_rincian AS debit_rincian,
    kode1.nama_kode AS nama_debit,
    rincian.keterangan_rincian AS keterangan_rincian,
    rincian.nominal_rincian AS nominal_rincian,
    rincian.kredit_rincian AS kredit_rincian,
    kode2.nama_kode AS nama_kredit
FROM
    tb_rincian AS rincian
JOIN tb_kode AS kode1
ON
    rincian.debit_rincian = kode1.kode_akun AND rincian.debit_rincian = kode1.kode_akun
JOIN tb_kode AS kode2
ON
    rincian.kredit_rincian = kode2.kode_akun AND rincian.kredit_rincian = kode2.kode_akun 
    WHERE tanggal_rincian = "' . $awal . '" 
    ORDER BY id_rincian ASC')->result_array();
            $data['title'] = 'Pemasukan Tanggal ' . date("d M Y", strtotime($awal));
            $data['judul'] = 'Pemasukan Tanggal ' . date("d M Y", strtotime($awal));
            $data['kode_akun'] = $this->db->get('tb_kode')->result_array();
        } else {
            $data['rincian'] = $this->db->query('SELECT
	rincian.id_rincian as id_rincian,
    rincian.tanggal_rincian as tanggal_rincian,
    rincian.debit_rincian AS debit_rincian,
    kode1.nama_kode AS nama_debit,
    rincian.keterangan_rincian AS keterangan_rincian,
    rincian.nominal_rincian AS nominal_rincian,
    rincian.kredit_rincian AS kredit_rincian,
    kode2.nama_kode AS nama_kredit
FROM
    tb_rincian AS rincian
JOIN tb_kode AS kode1
ON
    rincian.debit_rincian = kode1.kode_akun AND rincian.debit_rincian = kode1.kode_akun
JOIN tb_kode AS kode2
ON
    rincian.kredit_rincian = kode2.kode_akun AND rincian.kredit_rincian = kode2.kode_akun 
    WHERE tanggal_rincian >= "' . $awal . '" && tanggal_rincian <= "' . $akhir . '" 
    ORDER BY id_rincian ASC')->result_array();
            $data['title'] = 'Pemasukan Tanggal ' . date("d M Y", strtotime($awal)) . " - " . date("d M Y", strtotime($akhir));
            $data['judul'] = 'Pemasukan Tanggal <br/>' . date("d M Y", strtotime($awal)) . " - " . date("d M Y", strtotime($akhir));
            $data['kode_akun'] = $this->db->get('tb_kode')->result_array();
        }

        $this->load->view('Templates/01_Header', $data);
        $this->load->view('Templates/02_Menu');
        $this->load->view('Rincian/Index', $data);
        $this->load->view('Templates/03_Footer');
        $this->load->view('Templates/99_JS');
    }
}
