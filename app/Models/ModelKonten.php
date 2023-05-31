<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelKonten extends Model
{
    function tampil_data()
    {
        return $this->db->table('konten')->get()->getRowArray();
    }
    function edit_konten_data($data, $id_konten)
    {
        return $this->db->table('konten')->update($data, array('id_konten' => $id_konten));
    }
}
