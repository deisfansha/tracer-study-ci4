<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelAdmin extends Model
{
    function TotalAlumni()
    {
        return $this->db->query("SELECT COUNT(LEVEL) AS total FROM user WHERE LEVEL = 2 and status = 'approved'")->getRowArray();
    }
    function TotalKuesioner()
    {
        return $this->db->query("SELECT COUNT(nama_kuesioner) AS total FROM tbl_kuesioner WHERE STATUS = 'publish' ")->getRowArray();
    }
    function TotalPending()
    {
        return $this->db->query("SELECT COUNT(nama_lengkap) AS total FROM user WHERE LEVEL = 2 and status = 'pending'")->getRowArray();
    }
    function TotalQuestion()
    {
        return $this->db->table('tbl_question')->countAll();
    }
    function TotalTahun()
    {
        return $this->db->query('SELECT tahun_lulus, COUNT(tahun_lulus) as total FROM user WHERE LEVEL = 2 GROUP BY tahun_lulus')->getResultArray();
    }
    function TotalTahunPerProdi($id_prodi)
    {
        return $this->db->query('SELECT tahun_lulus, COUNT(tahun_lulus) as total FROM user WHERE LEVEL = 2 && kode_prodi like "%' . $id_prodi . '%" GROUP BY tahun_lulus')->getResultArray();
    }
    function TotalResponden()
    {
        return $this->db->query('SELECT k.`nama_kuesioner`, COUNT(DISTINCT a.`kode_users`) AS total FROM tbl_answer a JOIN tbl_kuesioner k ON k.`id_kuesioner` = a.`kode_kuesioner` GROUP BY k.`nama_kuesioner`')->getResultArray();
    }
    function TotalRespondenPerProdi($id_prodi)
    {
        return $this->db->query('SELECT k.`nama_kuesioner`, s.`kode_prodi`, COUNT(DISTINCT a.`kode_users`) AS total FROM tbl_answer a JOIN tbl_kuesioner k ON k.`id_kuesioner` = a.`kode_kuesioner` JOIN user s ON s.`id_user` = a.`kode_users` where s.`kode_prodi` like "%' . $id_prodi . '%" GROUP BY k.`nama_kuesioner`')->getResultArray();
    }
    function GetProdi()
    {
        return $this->db->query('SELECT * FROM tbl_prodi ')->getResultArray();
    }
}
