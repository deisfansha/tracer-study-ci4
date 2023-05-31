<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelProfil extends Model
{
    protected $request;
    protected $session;

    function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->request = \Config\Services::request();
    }
    function tampildata($id_user)
    {
        return $this->db->table('user')->join(
            "tbl_fakultas",
            "tbl_fakultas.id_fakultas=user.kode_fakultas",
        )->join(
            "tbl_prodi",
            "tbl_prodi.id_prodi=user.kode_prodi",
        )->where('user.id_user', $id_user)->get()->getRowArray();
    }
    function edit_data($data, $id_user)
    {
        return $this->db->table('user')->update($data, array('id_user' => $id_user));
    }
}
