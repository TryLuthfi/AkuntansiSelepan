<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('MAuth');
    }

    public function index()
    {
        if ($this->session->userdata('kode') != null) {
            redirect('Dashboard');
        } else {
            $this->form_validation->set_rules('username', 'Username', 'required|trim');
            $this->form_validation->set_rules('pass', 'Password', 'required|trim');

            if ($this->form_validation->run() == false) {
                $this->load->view('Auth/Login');
            } else {
                $this->MAuth->login();
            }
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('Auth');
    }
}
