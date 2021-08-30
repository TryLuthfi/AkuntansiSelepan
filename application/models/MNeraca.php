<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MNeraca extends CI_Model
{

    public function getKas()
    {
        $now = date('Y-m-d');
        $kas = $this->db->query("SELECT 
            (SELECT COALESCE(SUM(nominal_rincian) ,0) as jumlah from tb_rincian WHERE debit_rincian = '01.01')-(SELECT COALESCE(SUM(nominal_rincian) , 0)as jumlah from tb_rincian WHERE kredit_rincian = '01.01') 
            as jumlah")->result_array();
        return $kas;
    }

    public function getPiutangGaji()
    {
        $now = date('Y-m-d');
        $piutanggaji = $this->db->query("SELECT 
            (SELECT COALESCE(SUM(nominal_rincian) ,0) as jumlah from tb_rincian WHERE debit_rincian = '01.09')-(SELECT COALESCE(SUM(nominal_rincian) , 0)as jumlah from tb_rincian WHERE kredit_rincian = '01.09') 
            as jumlah")->result_array();
        return $piutanggaji;
    }

    public function getPiutangPenjualan()
    {
        $now = date('Y-m-d');
        $piutangpenjualan = $this->db->query("SELECT 
            (SELECT COALESCE(SUM(nominal_rincian) ,0) as jumlah from tb_rincian WHERE debit_rincian = '01.02')-(SELECT COALESCE(SUM(nominal_rincian) , 0)as jumlah from tb_rincian WHERE kredit_rincian = '01.02') 
            as jumlah")->result_array();
        return $piutangpenjualan;
    }

    public function getPiutangInforment()
    {
        $now = date('Y-m-d');
        $piutanginforment = $this->db->query("SELECT 
            (SELECT COALESCE(SUM(nominal_rincian) ,0) as jumlah from tb_rincian WHERE debit_rincian = '01.03')-(SELECT COALESCE(SUM(nominal_rincian) , 0)as jumlah from tb_rincian WHERE kredit_rincian = '01.03') 
            as jumlah")->result_array();
        return $piutanginforment;
    }
}
