<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelFakultas extends Model
{

    protected $table = 'tbl_fakultas';
    protected $primaryKey = 'id_fakultas';
    protected $allowedFields = ['nama_fakultas'];

    function tampil_data()
    {
        return $this->db->table('tbl_fakultas')->get()->getResultArray();
    }
    function tambah_fakultas($data)
    {
        return $this->db->table('tbl_fakultas')->insert($data);
    }
    function update_fakultas($data, $id_fakultas)
    {
        return $this->db->table('tbl_fakultas')->update($data, array('id_fakultas' => $id_fakultas));
    }
    function detail_fakultas($id_fakultas)
    {
        return $this->db->table('tbl_fakultas')->where("id_fakultas= $id_fakultas")->get()->getRowArray();
    }
    function delete_fakultas_data($id_fakultas)
    {
        return $this->db->table('tbl_fakultas')->delete(array('id_fakultas' => $id_fakultas));
    }
    function delete_prodi_data($id_fakultas)
    {
        return $this->db->table('tbl_prodi')->delete(array('id_fakultas' => $id_fakultas));
    }
    function tampil_prodi($id_fakultas)
    {
        return $this->db->query("SELECT * FROM tbl_fakultas f JOIN tbl_prodi p ON p.`kode_fakultas` = f.`id_fakultas` WHERE p.`kode_fakultas` = '$id_fakultas'")->getResultArray();
    }
    function tambah_prodi_data($data)
    {
        return $this->db->table('tbl_prodi')->insert($data);
    }
    function update_prodi($data, $id_prodi)
    {
        return $this->db->table('tbl_prodi')->update($data, array('id_prodi' => $id_prodi));
    }
    function delete_program_studi_data($id_prodi)
    {
        return $this->db->table('tbl_prodi')->delete(array('id_prodi' => $id_prodi));
    }
    function get_data($id_fakultas)
    {
        return $this->db->query("SELECT * FROM tbl_fakultas f JOIN tbl_prodi p ON p.`kode_fakultas` = f.`id_fakultas` WHERE p.`kode_fakultas` = '$id_fakultas'")->getRowArray();
    }
}
