<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MAuth extends CI_Model
{
    private $_table = 'tb_akun';
    // public $username_acc;
    // public $password_acc;

    public function login()
    {
        $_POST = $this->input->post();

        $username = $_POST['username'];
        $pass = $_POST['pass'];

        $akun = $this->db->get_where($this->_table, ['username' => $username])->row_array();
        if ($akun) {
            if ($akun['password'] == $pass) {
                $data =
                    [
                        'id_akun' => $akun['id_akun'],
                        'username' => $akun['username'],
                        'level' => $akun['level'],
                        'nama' => $akun['Nama']
                    ];
                $this->session->set_userdata($data);
                redirect('Dashboard');
            } else {
                $this->session->set_flashdata('error_log', 'salah');
                redirect('Auth');
            }
        } else {
            $this->session->set_flashdata('error_log', 'tidak_ada');
            redirect('Auth');
        }
    }
}
