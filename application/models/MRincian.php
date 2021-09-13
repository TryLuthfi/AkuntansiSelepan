<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MRincian extends CI_Model
{

    // public function getData()
    // {
    //     $now = date('Y-m-d');
    //     $data = $this->db->query("SELECT
    // 	rincian.id_rincian as id_rincian,
    //     rincian.tanggal_rincian as tanggal_rincian,
    //     rincian.debit_rincian AS debit_rincian,
    //     kode1.nama_kode AS nama_debit,
    //     rincian.keterangan_rincian AS keterangan_rincian,
    //     rincian.nominal_rincian AS nominal_rincian,
    //     rincian.kredit_rincian AS kredit_rincian,
    //     kode2.nama_kode AS nama_kredit
    // FROM
    //     tb_rincian AS rincian
    // JOIN tb_kode AS kode1
    // ON
    //     rincian.debit_rincian = kode1.kode_akun AND rincian.debit_rincian = kode1.kode_akun
    // JOIN tb_kode AS kode2
    // ON
    //     rincian.kredit_rincian = kode2.kode_akun AND rincian.kredit_rincian = kode2.kode_akun 
    //     WHERE tanggal_rincian >= '$now'
    //     ORDER BY id_rincian ASC")->result_array();
    //     return $data;
    // }

    public function getData()
    {
        $data = $this->db->query('SELECT * FROM tb_rincian JOIN tb_kode ON tb_rincian.debit_rincian = tb_kode.kode_akun ORDER BY id_rincian DESC')->result_array();
        return $data;
    }

    public function addPengeluaran($data_array)
    {
        $res = $this->db->insert("tb_rincian", $data_array);
        return $res;
    }

    public function deleteData($id)
    {
        $res = $this->db->delete("tb_rincian", $id);
        return $res;
    }

    public function deleteDataDetail($id)
    {
        $res = $this->db->delete("tb_detail_rincian", $id);
        return $res;
    }

    public function updateData($data_array, $id)
    {
        $res = $this->db->update("tb_rincian", $data_array, $id);
        return $res;
    }

    public function updateDataDetail($data_array)
    {
        $res = $this->db->update_batch('tb_detail_rincian', $data_array, 'id_dr');
        return $res;
    }
}
