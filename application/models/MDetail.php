<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MDetail extends CI_Model
{
    public function add(array $input)
    {
        return $this->db->insert_batch('tb_detail_rincian', $input);
    }

    public function findKode(string $kode): array
    {
        return $this->db->get_where('tb_detail_rincian', $kode)->result_array();
    }
}
