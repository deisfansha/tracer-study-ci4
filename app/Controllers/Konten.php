<?php

namespace App\Controllers;

use App\Models\ModelKonten;
use App\Models\ModelUsers;

class Konten extends BaseController
{
    public function __construct()
    {
        helper(['swal_helper']);
        $this->m_konten = new ModelKonten();
    }
    public function index()
    {

        $data = array(
            'menu' => 'konten',
            'submenu' => '',
            'head' => 'Pengaturan Konten',
            'title' => 'Pengaturan Konten',
            'isi' => 'main/admin/pengaturan/kontrol_page',
            'tampil' => $this->m_konten->tampil_data()
        );
        return view('layout/admin/v_wrapper', $data);
    }
    public function edit_konten()
    {
        $data = array(
            'menu' => 'konten',
            'submenu' => '',
            'head' => 'Pengaturan Konten',
            'title' => 'Pengaturan Konten',
            'isi' => 'main/admin/pengaturan/konten_edit',
            'tampil' => $this->m_konten->tampil_data()
        );
        return view('layout/admin/v_wrapper', $data);
    }
    public function edit_konten_aksi($id_konten)
    {
        $data = array(
            'nama_konten' => $this->request->getPost('nama_konten'),
            'no_telp' => $this->request->getPost('no_telp'),
            'alamat' => $this->request->getPost('alamat'),
            'email' => $this->request->getPost('email'),
            'isi_konten' => $this->request->getPost('isi_konten')
        );
        $this->m_konten->edit_konten_data($data, $id_konten);
        set_notifikasi('success', 'Konten', 'Berhasil DiUpdate !!!!');
        return redirect()->to(base_url('konten'));
    }
}
