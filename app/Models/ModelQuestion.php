<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelQuestion extends Model
{
    protected $request;

    function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->request = \Config\Services::request();
    }

    // Model Pertanyaan 
    function tampildata()
    {
        return $this->db->query("SELECT *, (SELECT GROUP_CONCAT(nama) FROM tbl_option WHERE kode_quest = id_quest GROUP BY kode_quest) as 'option' FROM tbl_question WHERE tipe_pertanyaan = 'multiple'")->getResult();
        // return $this->db->table('tbl_question')
        //     ->join("tbl_option", "tbl_question.id_quest=tbl_option.kode_quest", "LEFT")->get();
    }
    function tampil_edit()
    {
        return $this->db->query("SELECT *, (SELECT GROUP_CONCAT(nama) FROM tbl_option WHERE kode_quest = id_quest GROUP BY kode_quest) as 'option' FROM tbl_question")->getResult();
        // return $this->db->table('tbl_question')
        //     ->join("tbl_option", "tbl_question.id_quest=tbl_option.kode_quest", "LEFT")->get();
    }
    function tampil_essay()
    {
        return $this->db->table('tbl_question')->where('tipe_pertanyaan', 'essay')->get();
    }
    function tambah($data)
    {
        return $this->db->table('tbl_question')->insert($data);
    }
    function detail($id_quest)
    {
        return $this->db->table('tbl_question')->where("id_quest= $id_quest")->get();
    }
    function delete_quest_data($id_quest)
    {
        return $this->db->table('tbl_question')->delete(array('id_quest' => $id_quest));
    }
    function delete_show_quest($id_quest)
    {
        return $this->db->table('tbl_group_kuesioner')->delete(array('kode_quest' => $id_quest));
    }
    function edit_quest_data($data, $id_quest)
    {
        return $this->db->table('tbl_question')->update($data, array('id_quest' => $id_quest));
    }

    // Model Option
    function tampil_option()
    {
        return $this->db->table('tbl_option')->get();
    }
    function tambah_option($data)
    {
        return $this->db->table('tbl_option')->insert($data);
    }
    function lists_option($id_quest)
    {
        return $this->db->table('tbl_option')
            ->where('kode_quest', $id_quest)
            ->orderBy('nilai', SORT_DESC)
            ->get();
    }
    function delete_option_data($id_select)
    {
        return $this->db->table('tbl_option')->delete(array('id_select' => $id_select));
    }
    function edit_option_data($data, $id_select)
    {
        return $this->db->table('tbl_option')->update($data, array('id_select' => $id_select));
    }
}
