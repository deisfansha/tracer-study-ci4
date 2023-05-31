<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelLogin extends Model
{
    protected $table            = 'user';
    protected $primaryKey       = 'nim';
    protected $allowedFields    = [
        'nim', 'password', 'username'
    ];

    public function CekUsername($user)
    {
        return $this->db->table('user')->like('username', $user)->orLike('nim', $user);
    }
    public function save_register($data)
    {
        return $this->db->table('user')->insert($data);
    }
    public function update_pass($data, $email)
    {
        return $this->db->table('user')->update($data, array('email' => $email));
    }
}
