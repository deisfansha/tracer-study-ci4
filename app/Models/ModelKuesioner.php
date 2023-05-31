<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelKuesioner extends Model
{
    protected $request;

    function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->request = \Config\Services::request();
    }

    // Model Kuesioner 
    function tampildata_reject()
    {
        return $this->db->query("SELECT * FROM tbl_kuesioner WHERE STATUS='reject' ")->getResultArray();
    }
    function tampildata_publish()
    {
        return $this->db->query("SELECT k.`nama_kuesioner`, k.`id_kuesioner`, COUNT(DISTINCT g.`kode_quest`) AS total FROM tbl_group_kuesioner g JOIN tbl_kuesioner k ON k.`id_kuesioner` = g.`kode_kuesioner` 
        WHERE k.`status` = 'publish'        
                GROUP BY k.`nama_kuesioner` ")->getResultArray();
    }
    function tambah_kuesioner($data)
    {
        return $this->db->table('tbl_kuesioner')->insert($data);
    }
    function edit_kuesioner_data($data, $id_kuesioner)
    {
        return $this->db->table('tbl_kuesioner')->update($data, array('id_kuesioner' => $id_kuesioner));
    }
    function delete_kuesioner_data($id_kuesioner)
    {
        return $this->db->table('tbl_kuesioner')->delete(array('id_kuesioner' => $id_kuesioner));
    }
    function detail($id_kuesioner)
    {
        return $this->db->table('tbl_kuesioner')->where("id_kuesioner= $id_kuesioner")->get()->getRowArray();
    }
    function lists_question($id_kuesioner)
    {
        return $this->db->query('SELECT a.id_grup, a.kode_kuesioner, tbl_question.id_quest, tbl_question.tipe_pertanyaan, tbl_question.nama_quest, tbl_question.kode_pertanyaan FROM (SELECT * FROM tbl_group_kuesioner WHERE kode_kuesioner = "' . $id_kuesioner . '") a
        RIGHT JOIN tbl_question ON tbl_question.id_quest = a.kode_quest
        ORDER BY tbl_question.id_quest')->getResultArray();
    }
    public function cekRule($id_kuesioner, $id_quest)
    {
        return $this->db->table('tbl_group_kuesioner')
            ->where('kode_kuesioner="' . $id_kuesioner . '" AND kode_quest="' . $id_quest . '"')
            ->get()->getRowArray();
    }
    public function addQuest($data)
    {
        return $this->db->table('tbl_group_kuesioner')->insert($data);
        // $add = $this->db->table('tbl_group_kuesioner')->insert($data);
        // if ($add) {
        //     return true;
        // } else {
        //     return false;
        // }
    }

    public function deleteQuest($data)
    {
        $this->db->table('tbl_group_kuesioner')
            ->where($data)
            ->delete();
    }
    function count_question($id_kuesioner)
    {
        return $this->db->query("SELECT *, (SELECT GROUP_CONCAT(nama) FROM tbl_option WHERE kode_quest = id_quest GROUP BY kode_quest) AS 'option' FROM tbl_question q 
        JOIN tbl_group_kuesioner g ON g.`kode_quest` = q.`id_quest` JOIN tbl_kuesioner k ON k.`id_kuesioner` = g.`kode_kuesioner` where kode_kuesioner = '$id_kuesioner'")->getResultArray();
    }
    function detail_question($id_kuesioner)
    {
        return $this->db->query("SELECT *, (SELECT GROUP_CONCAT(nama) FROM tbl_option WHERE kode_quest = id_quest GROUP BY kode_quest) AS 'option' FROM tbl_question q 
        JOIN tbl_group_kuesioner g ON g.`kode_quest` = q.`id_quest` JOIN tbl_kuesioner k ON k.`id_kuesioner` = g.`kode_kuesioner` where kode_kuesioner = '$id_kuesioner'")->getResultArray();
    }
    function tampil_option()
    {
        return $this->db->table('tbl_option')->get();
    }
    function user_kuesioner()
    {
        return $this->db->table('tbl_kuesioner')->where("status", "publish")->get();
    }
    function user_kuesioner_part2($id_user)
    {
        return $this->db->query("SELECT * FROM (SELECT k.`id_kuesioner`, k.`nama_kuesioner`, k.`kd_kuesioner`, 'sudah' AS 'status_pengisian' FROM tbl_kuesioner k
        WHERE k.`id_kuesioner` IN (SELECT a.kode_kuesioner FROM tbl_answer a WHERE kode_users = $id_user) AND k.`status` = 'publish'
        UNION
        SELECT k.`id_kuesioner`, k.`nama_kuesioner`, k.`kd_kuesioner`, 'belum' AS 'status_pengisian' FROM tbl_kuesioner k
        WHERE k.`id_kuesioner` NOT IN (SELECT a.kode_kuesioner FROM tbl_answer a WHERE kode_users = $id_user) AND k.`status` = 'publish') z ORDER BY status_pengisian ASC")->getResult();
    }
    function tambah_answer($answer)
    {
        return $this->db->table('tbl_answer')->insert($answer);
    }
    function get_answer($id_kuesioner, $id_user)
    {
        return $this->db->query("SELECT * FROM tbl_answer  WHERE kode_kuesioner = '$id_kuesioner' AND kode_users = '$id_user' ")->getRowArray();
    }
    function total_quest($id_kuesioner)
    {
        return $this->db->query('SELECT COUNT(kode_quest) AS total FROM tbl_group_kuesioner JOIN tbl_kuesioner ON tbl_kuesioner.id_kuesioner = tbl_group_kuesioner.kode_kuesioner WHERE tbl_group_kuesioner.kode_kuesioner = ' . $id_kuesioner . ' ')->getResultArray();
    }
    function total_kuesioner_belum_terjawab($id_user)
    {
        return $this->db->query("SELECT k.`id_kuesioner`, k.`nama_kuesioner`, k.`kd_kuesioner`, COUNT(k.`nama_kuesioner`) AS total FROM tbl_kuesioner k
        WHERE k.`id_kuesioner` NOT IN (SELECT a.kode_kuesioner FROM tbl_answer a WHERE kode_users = '$id_user') AND k.`status` = 'publish'")->getRowArray();
    }
    function total_kuesioner_sudah_terjawab($id_user)
    {
        return $this->db->query("SELECT k.`id_kuesioner`, k.`nama_kuesioner`, k.`kd_kuesioner`, COUNT(k.`nama_kuesioner`) AS total FROM tbl_kuesioner k
        WHERE k.`id_kuesioner` IN (SELECT a.kode_kuesioner FROM tbl_answer a WHERE kode_users = '$id_user') AND k.`status` = 'publish'")->getRowArray();
    }
}
