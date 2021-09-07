<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MDetail extends CI_Model
{
    public function inssert(array $input): array
    {
        return $this->db->insert('tb_detail_rincian', $input);
    }

    public function findKode(string $kode): array
    {
        return $this->db->get_where('tb_detail_rincian', $kode)->result_array();
    }
}
