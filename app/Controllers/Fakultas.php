<?php

namespace App\Controllers;

use App\Models\ModelFakultas;
use CodeIgniter\Model;

class Fakultas extends BaseController
{
    public function __construct()
    {
        $this->m_fakultas = new ModelFakultas();
        helper(['swal_helper']);
    }
    public function index()
    {
        $data = array(
            'menu' => 'fakultas',
            'submenu' => '',
            'title' => 'Data Fakultas',
            'head' => 'Data Fakultas',
            'isi' => 'main/admin/pengaturan/fakultas_view',
            'tampil' =>  $this->m_fakultas->tampil_data()
        );
        return view('layout/admin/v_wrapper', $data);
    }
    public function add_fakultas()
    {
        $validation = \Config\Services::validation();
        $valid = $this->validate([
            'nama_fakultas' => [
                'label' => 'Nama Fakultas',
                'rules' => 'is_unique[tbl_fakultas.nama_fakultas]',
                'erros' => [
                    'is_unique' => '{fields} Sudah Ada'
                ]
            ]
        ]);

        if (!$valid) {
            $sessErorr = [
                'err_nama' => $validation->getError('nama_fakultas')
            ];
            session()->setFlashdata($sessErorr);
            set_notifikasi('error', 'Tambah Fakultas Gagal', '');
            return redirect()->to(base_url('fakultas'));
        } else {
            $data = array(
                'nama_fakultas' => $this->request->getPost('nama_fakultas')
            );
            $this->m_fakultas->tambah_fakultas($data);
            set_notifikasi('success', 'Data Fakultas', 'Berhasil Ditambah!!!');
            return redirect()->to(base_url('fakultas'));
        }
    }

    public function edit_fakultas($id_fakultas)
    {
        $validation = \Config\Services::validation();
        $valid = $this->validate([
            'nama_fakultas' => [
                'label' => 'Nama Fakultas',
                'rules' => 'is_unique[tbl_fakultas.nama_fakultas]',
                'erros' => [
                    'is_unique' => '{fields} Sudah Ada'
                ]
            ]
        ]);

        if (!$valid) {
            $sessErorr = [
                'err_nama' => $validation->getError('nama_fakultas')
            ];
            session()->setFlashdata($sessErorr);
            set_notifikasi('error', 'Tambah Fakultas Gagal', '');
            return redirect()->to(base_url('fakultas'));
        } else {
            $data = array(
                'nama_fakultas' => $this->request->getPost('nama_fakultas')
            );
            $this->m_fakultas->update_fakultas($data, $id_fakultas);
            set_notifikasi('success', 'Data Fakultas', 'Berhasil Diedit!!!');
            return redirect()->to(base_url('fakultas'));
        }
    }
    public function delete_fakultas($id_fakultas)
    {
        $this->m_fakultas->delete_fakultas_data($id_fakultas);
        //$this->m_fakultas->delete_prodi_data($id_fakultas);
        set_notifikasi('success', 'Data Fakultas & Program Studi', 'Berhasil DiHapus !!!!');
        return redirect()->to(base_url('fakultas'));
    }
    public function add_prodi($id_fakultas)
    {
        $fakultas = $this->m_fakultas->get_data($id_fakultas);
        $data = array(
            'menu' => 'fakultas',
            'submenu' => '',
            'head' => $fakultas['nama_fakultas'],
            'isi' => 'main/admin/pengaturan/prodi_view',
            'tampil' =>  $this->m_fakultas->tampil_prodi($id_fakultas),
            'detail' => $this->m_fakultas->detail_fakultas($id_fakultas)
        );
        return view('layout/admin/v_wrapper', $data);
    }
    public function tambah_prodi($id_fakultas)
    {
        $validation = \Config\Services::validation();
        $valid = $this->validate([
            'nama_prodi' => [
                'label' => 'Nama prodi',
                'rules' => 'is_unique[tbl_prodi.nama_prodi]',
                'erros' => [
                    'is_unique' => '{fields} Sudah Ada'
                ]
            ]
        ]);

        if (!$valid) {
            $sessErorr = [
                'err_nama' => $validation->getError('nama_prodi')
            ];
            session()->setFlashdata($sessErorr);
            set_notifikasi('error', 'Tambah Program Studi Gagal', '');
            return redirect()->to(base_url('fakultas/add_prodi/' . $id_fakultas));
        } else {
            $data = array(
                'kode_fakultas' => $id_fakultas,
                'nama_prodi' => $this->request->getPost('nama_prodi')
            );
            $this->m_fakultas->tambah_prodi_data($data);
            set_notifikasi('success', 'Data Program Studi', 'Berhasil Ditambah!!!');
            return redirect()->to(base_url('fakultas/add_prodi/' . $id_fakultas));
        }
    }
    public function edit_prodi($kode_fakultas, $id_prodi)
    {
        $valid = $this->validate([
            'nama_prodi' => [
                'label' => 'Nama Program Studi',
                'rules' => 'is_unique[tbl_prodi.nama_prodi]',
                'erros' => [
                    'is_unique' => '{fields} Sudah Ada'
                ]
            ]
        ]);

        if (!$valid) {
            $sessError = \Config\Services::validation()->listErrors();
            set_notifikasi('error', 'Edit Program Studi Gagal', $sessError);
            return redirect()->to(base_url('fakultas/add_prodi/' . $kode_fakultas));
        } else {
            $data = array(
                'nama_prodi' => $this->request->getPost('nama_prodi')
            );
            $this->m_fakultas->update_prodi($data, $id_prodi);
            set_notifikasi('success', 'Data Program Studi', 'Berhasil Diedit!!!');
            return redirect()->to(base_url('fakultas/add_prodi/' . $kode_fakultas));
        }
    }
    public function delete_prodi($kode_fakultas, $id_prodi)
    {
        $this->m_fakultas->delete_program_studi_data($id_prodi);
        set_notifikasi('success', 'Data Program Studi', 'Berhasil DiHapus !!!!');
        return redirect()->to(base_url('fakultas/add_prodi/' . $kode_fakultas));
    }
}
