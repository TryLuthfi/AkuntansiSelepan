<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Neraca extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('MNeraca');
    }

    public function index()
    {
        $now = date('Y-m-d');

        $data['title'] = 'Neraca';
        $data['judul'] = 'Neraca hari ini';
        $kas = $this->MNeraca->getKas();
        foreach ($kas as $row) {
            $data['kas'] =  $row['jumlah'];
        }
        $piutanggaji = $this->MNeraca->getPiutangGaji();
        foreach ($piutanggaji as $row) {
            $data['piutanggaji'] = $row['jumlah'];
        }
        $piutangpenjualan = $this->MNeraca->getPiutangPenjualan();
        foreach ($piutangpenjualan as $row) {
            $data['piutangpenjualan'] =  $row['jumlah'];
        }
        $piutanginforment = $this->MNeraca->getPiutangInforment();
        foreach ($piutanginforment as $row) {
            $data['piutanginforment'] =  $row['jumlah'];
        }

        $this->load->view('Templates/01_Header', $data);
        $this->load->view('Templates/02_Menu');
        $this->load->view('Neraca/Index', $data);
        $this->load->view('Templates/03_Footer');
        $this->load->view('Templates/99_JS');
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
            $data['neraca'] = $this->db->query('SELECT
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
            $data['title'] = 'Neraca Tanggal ' . date("d M Y", strtotime($awal));
            $data['judul'] = 'Neraca Tanggal ' . date("d M Y", strtotime($awal));
            $data['kode_akun'] = $this->db->get('tb_kode')->result_array();
        } else {
            $data['neraca'] = $this->db->query('SELECT
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
            $data['title'] = 'Neraca Tanggal ' . date("d M Y", strtotime($awal)) . " - " . date("d M Y", strtotime($akhir));
            $data['judul'] = 'Neraca Tanggal <br/>' . date("d M Y", strtotime($awal)) . " - " . date("d M Y", strtotime($akhir));
            $data['kode_akun'] = $this->db->get('tb_kode')->result_array();
        }

        $this->load->view('Templates/01_Header', $data);
        $this->load->view('Templates/02_Menu');
        $this->load->view('Neraca/Index', $data);
        $this->load->view('Templates/03_Footer');
        $this->load->view('Templates/99_JS');
    }
}
