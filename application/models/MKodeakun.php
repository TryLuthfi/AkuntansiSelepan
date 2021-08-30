<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MKodeakun extends CI_Model
{

    public function getData()
    {
        $this->db->from('tb_kode');
        $this->db->order_by("kode_akun", "asc");
        $data = $this->db->get();
        return $data->result_array();
    }

    public function addPengeluaran($data_array)
    {
        $res = $this->db->insert("tb_kode", $data_array);
        return $res;
    }

    public function deleteData($id)
    {
        $res = $this->db->delete("tb_kode", $id);
        return $res;
    }

    public function updateData($data_array, $id)
    {
        $res = $this->db->update("tb_kode", $data_array, $id);
        return $res;
    }
}
