<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelProdi extends Model
{

    protected $table = 'tbl_prodi';

    protected $primaryKey = 'id_prodi';

    protected $allowedFields = ['kode_fakultas', 'nama_prodi'];
}
