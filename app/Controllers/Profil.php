<?php

namespace App\Controllers;

use App\Models\ModelProfil;
use App\Models\ModelFakultas;
use App\Models\ModelUsers;

class Profil extends BaseController
{
    public function __construct()
    {
        $this->m_profil = new ModelProfil();
        $this->m_user = new ModelUsers();
        helper('form');
        helper(['swal_helper']);
    }
    public function index()
    {
        $fk = new ModelFakultas();
        $nama = session()->get('nama_lengkap');
        $id_user = session()->get('id_user');
        $data = array(
            'head' => $nama,
            'title' => 'Halaman Profil',
            'isi' => 'main/user/profil',
            'menu' => 'profil',
            'submenu' => '',
            'tampilfakultas' => $fk->orderBy('nama_fakultas', 'ASC')->findAll(),
            'profil' => $this->m_profil->tampildata($id_user)
        );
        return view('layout/admin/v_wrapper', $data);
    }
    public function edit($id_user)
    {
        $detail = $this->m_profil->tampildata($id_user);
        $foto = $this->request->getFile('foto');

        if ($foto->getError() == 4) {
            $data = array(
                'email' => $this->request->getPost('email'),
                'no_hp' => $this->request->getPost('no_hp'),
                'tempat_lahir' => $this->request->getPost('tempat_lahir'),
                'tgl_lahir' => $this->request->getPost('tgl_lahir'),
                'nik' => $this->request->getPost('nik'),
                'alamat_rmh' => $this->request->getPost('alamat')
            );
        } else {

            // Ambil Nama Foto
            $namafoto = $foto->getRandomName();

            if ($detail['foto'] == null) {
                // Pindahkan Foto
                $foto->move('assets/img', $namafoto);
            } else {
                unlink('assets/img/' . $detail['foto']);
            }
            $data = array(
                'email' => $this->request->getPost('email'),
                'no_hp' => $this->request->getPost('no_hp'),
                'foto' => $namafoto,
                'tempat_lahir' => $this->request->getPost('tempat_lahir'),
                'tgl_lahir' => $this->request->getPost('tgl_lahir'),
                'nik' => $this->request->getPost('nik'),
                'alamat_rmh' => $this->request->getPost('alamat')
            );
        }

        $this->m_profil->edit_data($data, $id_user);
        set_notifikasi('success', 'Data Profil', 'Berhasil DiUpdate !!!!');
        return redirect()->to(base_url('profil'));
    }
}
