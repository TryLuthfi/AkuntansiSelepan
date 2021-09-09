<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MDetail extends CI_Model
{
    protected $table = 'tb_detail_rincian';

    public function add(array $input)
    {
        return $this->db->insert_batch('tb_detail_rincian', $input);
    }

    public function findKode(array $kode)
    {
        $new = implode(',', $kode);
        return $this->db->query("SELECT * FROM tb_detail_rincian JOIN tb_kode ON tb_detail_rincian.kode = tb_kode.kode_akun WHERE kode_rincian IN ({$new})  AND type_rincian = 'K'")->result_array();
    }
}
