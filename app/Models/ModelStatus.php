<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelStatus extends Model
{

    protected $table = 'user';
    public function getStatus($id_user = false)
    {
        if ($id_user == false) {
            return $this->findAll();
        } else {
            return $this->getWhere(['id_user' => $id_user]);
        }
    }
}
