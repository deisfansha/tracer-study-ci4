<?php

namespace App\Models;

use CodeIgniter\Model;
use JetBrains\PhpStorm\Internal\ReturnTypeContract;

class ModelUsers extends Model
{
    protected $table = 'user';

    function tampildata()
    {
        return $this->db->table('user')->join(
            "tbl_fakultas",
            "tbl_fakultas.id_fakultas=user.kode_fakultas",
        )->join(
            "tbl_prodi",
            "tbl_prodi.id_prodi=user.kode_prodi",
        )->where('status=', 'approved')->orderBy('tahun_lulus', SORT_DESC)->get()->getResultArray();
    }
    function view_pending_data()
    {
        return $this->db->table('user')->join(
            "tbl_fakultas",
            "tbl_fakultas.id_fakultas=user.kode_fakultas",
        )->join(
            "tbl_prodi",
            "tbl_prodi.id_prodi=user.kode_prodi",
        )->where('status=', 'pending')->orderBy('id_user', SORT_DESC)->get()->getResultArray();
    }
    function view_reject_data()
    {
        return $this->db->table('user')->join(
            "tbl_fakultas",
            "tbl_fakultas.id_fakultas=user.kode_fakultas",
        )->join(
            "tbl_prodi",
            "tbl_prodi.id_prodi=user.kode_prodi",
        )->where('status=', 'reject')->get()->getResultArray();
    }

    function getPaginate($num, $keyword = null)
    {
        $builder = $this->builder();
        $builder->join(
            "tbl_fakultas",
            "tbl_fakultas.id_fakultas=user.kode_fakultas",
        )->join(
            "tbl_prodi",
            "tbl_prodi.id_prodi=user.kode_prodi",
        )->where('status=', 'approved')->where('level=', '2')->orderBy('tahun_lulus', SORT_ASC);
        if ($keyword != '') {
            $builder->like('nama_lengkap', $keyword);
            $builder->orlike('nim', $keyword);
            $builder->orlike('tahun_lulus', $keyword);
            $builder->orlike('nama_fakultas', $keyword);
            $builder->orlike('nama_prodi', $keyword);
        }
        return [
            'datauser' => $this->paginate($num, 'user'),
            'pager' => $this->pager
        ];
    }

    function search($keyword)
    {
        // return $this->table('user')->like('nama_lengkap', $keyword)->orlike('email', $keyword)->orlike('tahun_lulus', $keyword);
        $builder = $this->table('user');
        $builder->where('level=', '2')->join(
            "tbl_fakultas",
            "tbl_fakultas.id_fakultas=user.kode_fakultas",
        )->join(
            "tbl_prodi",
            "tbl_prodi.id_prodi=user.kode_prodi",
        )->orderBy('tahun_lulus', SORT_DESC);

        if ($keyword != '') {
            $builder->like('nama_lengkap', $keyword);
            $builder->orlike('nim', $keyword);
            $builder->orlike('tahun_lulus', $keyword);
            $builder->orlike('nama_fakultas', $keyword);
            $builder->orlike('nama_prodi', $keyword);
        };
    }
    function tambah($data)
    {
        return $this->db->table('user')->insert($data);
    }
    function tambahalm($dataalm)
    {
        return $this->db->table('tbl_alumni')->insert($dataalm);
    }
    function detailalmn($id_user)
    {
        return $this->db->table('user')->join(
            "tbl_alumni",
            "tbl_alumni.kode_user=user.id_user"
        )->where("id_user= $id_user")->get();
    }
    function delete_data($id_user)
    {
        return $this->db->table('user')->delete(array('id_user' => $id_user));
    }
    function get_email($id_user)
    {
        return $this->db->table('user')->where("id_user= $id_user")->get()->getRowArray();
    }
    function edit_data($data, $id_user)
    {
        return $this->db->table('user')->update($data, array('id_user' => $id_user));
    }
    function ubah_password($data, $id_user)
    {
        return $this->db->table('user')->update($data, array('id_user' => $id_user));
    }
    function get_user($id_user)
    {
        return $this->db->table('user')->where("id_user= $id_user")->get()->getRowArray();
    }
    public function setTable($table)
    {
        $this->table = $table;
        return $this;
    }
}
