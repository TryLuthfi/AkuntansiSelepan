<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rincian extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('MRincian');
        $this->load->model('MDetail');
    }

    public function index()
    {
        $now = date('Y-m-d');

        $data = [];

        $data['title'] = 'Rincian';
        $data['judul'] = 'Rincian Hari Ini';
        $data['kode_akun'] = $this->db->get('tb_kode')->result_array();

        $real = $this->MRincian->getData();

        $ids = array_column($real, 'kode_rincian');

        if (count($ids) !== 0) {
            $detail = $this->MDetail->findKode($ids);
        } else {
            $data['rincian'] = [];
        }

        foreach ($real as $map) {
            $filter = $this->filter($detail, $map['kode_rincian']);
            $data['rincian'][] = [
                'detail' => $filter,
                'kode_rincian' => $map['kode_rincian'],
                'id_rincian' => $map['id_rincian'],
                'tanggal_rincian' => $map['tanggal_rincian'],
                'keterangan_rincian' => $map['keterangan_rincian'],
                'nama_kode' => $map['nama_kode'],
                'debit_rincian' => $map['debit_rincian'],
                'nominal_rincian' => $map['nominal_rincian'],
                'kredit_rincian' => $map['kredit_rincian']
            ];
        }

        // var_dump($data);

        $this->load->view('Templates/01_Header', $data);
        $this->load->view('Templates/02_Menu');
        $this->load->view('Rincian/Index', $data);
        $this->load->view('Templates/03_Footer');
        $this->load->view('Templates/99_JS');
    }

    private function filter(array $data, $key)
    {
        return array_filter($data, function ($value) use ($key) {
            return $value['kode_rincian'] === $key;
        });
    }

    public function add()
    {
        // var_dump($_POST);
        $anyket = array_filter($_POST, function ($value) {
            return (strpos($value, 'keterangan_') !== false);
        }, ARRAY_FILTER_USE_KEY);

        $anykre = array_filter($_POST, function ($value) {
            return (strpos($value, 'kredit_') !== false);
        }, ARRAY_FILTER_USE_KEY);

        $jumlahKredit = 0;

        $countanykre = array_filter($_POST, function ($value) {
            return (strpos($value, 'nominal_d') !== false);
        }, ARRAY_FILTER_USE_KEY);

        foreach ($countanykre as $coun) {
            $jumlahKredit += (int) filter_var($coun, FILTER_SANITIZE_NUMBER_INT);
        }

        $anyket = join(',', $anyket);

        $last_data = $this->db->query('SELECT id_dr FROM tb_detail_rincian order by id_dr DESC LIMIT 1');

        foreach ($last_data->result() as $row) {
            $hasil_data =  $row->id_dr;
        }

        $hasil_data = $hasil_data + 1;

        $tanggal = $_POST['tanggal'];
        $tanggal_baru = explode("-", $tanggal);
        $kode_rincian = $tanggal_baru[2] . $tanggal_baru[1] . $tanggal_baru[0] . $hasil_data;

        $nominal = $jumlahKredit;

        $hasil_data = array(
            'kode_rincian' => $kode_rincian,
            'tanggal_rincian' => $_POST['tanggal'],
            'debit_rincian' => $_POST['debit'],
            'keterangan_rincian' => $anyket,
            'nominal_rincian' => $nominal,
            'kredit_rincian' => join(',', $anykre)
        );

        $listDetail = [];

        $count = 0;
        foreach ($anykre as $kre) {
            $count += 1;
            $listDetail[] = [
                'kode_rincian' => $kode_rincian,
                'tanggal_rincian' => $_POST['tanggal'],
                'kode' => $kre,
                'type_rincian' => 'K',
                'nominal' => (int) filter_var($_POST['nominal_d' . $count], FILTER_SANITIZE_NUMBER_INT),
                'keterangan' => $count
            ];
        }

        $res = $this->MRincian->addPengeluaran($hasil_data);
        $res = $this->MDetail->add($listDetail);

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
        // echo '<pre>';
        // print_r($_POST);
        // echo '</pre>';

        $anykre = array_filter($_POST, function ($value) {
            return (strpos($value, 'kredit_') !== false);
        }, ARRAY_FILTER_USE_KEY);

        $anynom = array_filter(
            $_POST,
            function ($value) {
                return (strpos($value, 'nominal_') !== false);
            },
            ARRAY_FILTER_USE_KEY
        );

        $jumlahKredit = 0;
        foreach ($anynom as $coun) {
            $jumlahKredit += (int) filter_var($coun, FILTER_SANITIZE_NUMBER_INT);
        }

        $data_array = array(
            'tanggal_rincian' => $_POST['tanggal'],
            'debit_rincian' => $_POST['debit'],
            'keterangan_rincian' => $_POST['keterangan'],
            'nominal_rincian' => $jumlahKredit,
            'kredit_rincian' => join(',', $anykre)
        );

        $where = array('id_rincian' => $_POST['id_rincian']);

        $res = $this->MRincian->updateData($data_array, $where);

        $listDetail = [];

        $id = explode(',', $_POST['id_detail']);

        $count = 0;
        foreach ($anykre as $kre) {
            $count += 1;
            $listDetail[] = [
                // 'tanggal_rincian' => $_POST['tanggal'],
                'id_dr' => $id[$count - 1],
                'kode' => $kre,
                'type_rincian' => 'K',
                'nominal' => (int) filter_var($_POST['nominal_' . $count], FILTER_SANITIZE_NUMBER_INT)
            ];
        }

        $res = $this->MRincian->updateDataDetail($listDetail);

        if ($res >= 1) {
            $this->session->set_flashdata('status', 'sukses');
            redirect("Rincian");
        } else {
            $this->session->set_flashdata('status', 'gagal');
            redirect("Rincian");
        }
    }

    public function delete($id)
    {
        $kode_rincian = array('kode_rincian' => $id);
        $res = $this->MRincian->deleteData($kode_rincian);
        $this->MRincian->deleteDataDetail($kode_rincian);

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
