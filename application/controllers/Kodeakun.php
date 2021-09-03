<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kodeakun extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('MKodeakun');
    }

    public function index()
    {
        $now = date('Y-m-d');

        $data['title'] = 'Kode Akun';
        $data['judul'] = 'Kode Akun';
        $data['rincian'] = $this->MKodeakun->getData();
        $data['kode_akun'] = $this->db->get('tb_kode')->result_array();

        $this->load->view('Templates/01_Header', $data);
        $this->load->view('Templates/02_Menu');
        $this->load->view('Kodeakun/Index', $data);
        $this->load->view('Templates/03_Footer');
        $this->load->view('Templates/99_JS');
    }

    public function add()
    {
        // echo ("<pre>");
        // print_r($_POST);
        // echo ("</pre>");

        $hasil_data = array(
            'kode_akun' => $_POST['kode_akun'],
            'nama_kode' => $_POST['nama_kode']
        );

        $kode = $this->db->get_where('tb_kode', ['kode_akun' => $_POST['kode_akun']])->row_array();
        if ($_POST['kode_akun'] == $kode['kode_akun']) {
            $this->session->set_flashdata('error_log', 'kode_ada');
            redirect('Kodeakun');
        } else if ($_POST['nama_kode'] == $kode['nama_kode']) {
            $this->session->set_flashdata('error_log', 'nama_ada');
            redirect('Kodeakun');
        } else {
            $res = $this->MKodeakun->addPengeluaran($hasil_data);

            if ($res >= 1) {
                $this->session->set_flashdata('status', 'sukses');
                redirect("Kodeakun");
            } else {
                $this->session->set_flashdata('status', 'gagal');
                redirect("Kodeakun");
            }
        }
    }

    public function edit()
    {

        $data_array = array(
            'kode_akun' => $_POST['kode_akun'],
            'nama_kode' => $_POST['nama_kode']
        );

        $where = array('kode_akun' => $_POST['kode_akun']);

        $res = $this->MKodeakun->updateData($data_array, $where);

        if ($res >= 1) {
            $this->session->set_flashdata('status', 'sukses');
            redirect("Kodeakun");
        } else {
            $this->session->set_flashdata('status', 'gagal');
            redirect("Kodeakun");
        }
    }

    public function delete($id)
    {
        $id_kode = array('id_kode' => $id);
        $res = $this->MKodeakun->deleteData($id_kode);

        if ($res >= 1) {
            $this->session->set_flashdata('status', 'sukses');
            redirect("Kodeakun");
        } else {
            $this->session->set_flashdata('status', 'gagal');
            redirect("Kodeakun");
        }
    }
}
