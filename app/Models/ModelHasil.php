<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelHasil extends Model
{
    function view_hasil_kuesioner()
    {
        return $this->db->query("SELECT k.`id_kuesioner`, k.`nama_kuesioner`, COUNT(DISTINCT a.`kode_users`) AS total FROM tbl_answer a JOIN tbl_kuesioner k ON k.`id_kuesioner` = a.`kode_kuesioner` 
        GROUP BY k.`nama_kuesioner`
        ")->getResultArray();
    }
    function detail_kuesioner($id_kuesioner)
    {
        return $this->db->table('tbl_kuesioner')->where('id_kuesioner', $id_kuesioner)->get()->getRowArray();
    }
    function get_name_kuesioner($kode_kuesioner)
    {
        return $this->db->table('tbl_kuesioner')->where('id_kuesioner', $kode_kuesioner)->get()->getRowArray();
    }
    function detail_user($kode_users)
    {
        return $this->db->table('user')->join(
            "tbl_fakultas",
            "tbl_fakultas.id_fakultas=user.kode_fakultas",
        )->join(
            "tbl_prodi",
            "tbl_prodi.id_prodi=user.kode_prodi",

        )->where('id_user', $kode_users)->get()->getRowArray();
    }
    function detail_hasil_by_user($id_kuesioner)
    {
        // return $this->db->query("SELECT DISTINCT u.`nama_lengkap`, f.`nama_fakultas`, p.`nama_prodi`, a.`kode_kuesioner`, a.`kode_users` FROM tbl_answer a
        // JOIN USER u ON u.`id_user` = a.`kode_users` 
        // JOIN tbl_fakultas f ON f.`id_fakultas` = u.`kode_fakultas`
        // JOIN tbl_prodi p ON p.`kode_fakultas` = f.`id_fakultas`
        // JOIN tbl_kuesioner k ON k.`id_kuesioner` = a.`kode_kuesioner`
        // WHERE  a.`kode_kuesioner` = '$id_kuesioner'
        // ")->getResultArray();

        return $this->db->query("SELECT DISTINCT u.nik,u.`nama_lengkap`, u.`jenis_klm`, u.tahun_lulus, p.`nama_prodi`, f.`nama_fakultas`,a.`kode_users`, k.`id_kuesioner`, a.`kode_kuesioner` FROM tbl_answer a
        JOIN USER u ON u.`id_user` = a.`kode_users`
        JOIN tbl_kuesioner k ON k.`id_kuesioner` = a.`kode_kuesioner`
        JOIN tbl_fakultas f ON f.`id_fakultas` = u.`kode_fakultas`
        JOIN tbl_prodi p ON p.`id_prodi` = u.`kode_prodi`
        JOIN tbl_question q ON q.`id_quest` = a.`kode_quest`
        WHERE a.`kode_kuesioner` = '$id_kuesioner'")->getResultArray();
    }
    function answer_by_name($kode_users, $kode_kuesioner)
    {
        return $this->db->query("SELECT DISTINCT a.`kode_users`, k.`id_kuesioner`, q.`nama_quest`, a.`answer`FROM tbl_answer a
        JOIN user u ON u.`id_user` = a.`kode_users`
        JOIN tbl_kuesioner k ON k.`id_kuesioner` = a.`kode_kuesioner`
        JOIN tbl_question q ON q.`id_quest` = a.`kode_quest`
        WHERE  a.`kode_users` = '$kode_users' AND  a.`kode_kuesioner` = '$kode_kuesioner' ")->getResultArray();
    }

    function view_hasil_users($kode_users)
    {
        return $this->db->query("SELECT DISTINCT k.`id_kuesioner`, k.`kd_kuesioner`, k.`nama_kuesioner` FROM tbl_kuesioner k
        JOIN tbl_answer a ON k.`id_kuesioner` = a.`kode_kuesioner` WHERE a.kode_users = '$kode_users'")->getResultArray();
    }
    function detail_answer($kode_users, $id_kuesioner)
    {
        return $this->db->query("SELECT DISTINCT a.`kode_users`, k.`id_kuesioner`, q.`nama_quest`, a.`answer`FROM tbl_answer a
        JOIN USER u ON u.`id_user` = a.`kode_users`
        JOIN tbl_kuesioner k ON k.`id_kuesioner` = a.`kode_kuesioner`
        JOIN tbl_question q ON q.`id_quest` = a.`kode_quest`
        WHERE  a.`kode_users` = '$kode_users' AND  a.`kode_kuesioner` = '$id_kuesioner' ")->getResultArray();
    }
    function answer_users($kode_users, $id_kuesioner)
    {
        return $this->db->query("SELECT DISTINCT a.`kode_users`, k.`id_kuesioner`, q.`nama_quest`, a.`answer`FROM tbl_answer a
        JOIN user u ON u.`id_user` = a.`kode_users`
        JOIN tbl_kuesioner k ON k.`id_kuesioner` = a.`kode_kuesioner`
        JOIN tbl_question q ON q.`id_quest` = a.`kode_quest`
        WHERE  a.`kode_users` = '$kode_users' AND  a.`kode_kuesioner` = '$id_kuesioner' ")->getResultArray();
    }
}
