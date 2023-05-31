<?php

namespace App\Controllers;

use App\Models\ModelKonten;
use App\Models\ModelKuesioner;
use App\Models\ModelUsers;

class HomeUsers extends BaseController
{
    public function __construct()
    {
        helper(['swal_helper']);
        $this->m_user = new ModelUsers();
        $this->m_kuesioner = new ModelKuesioner();
        $this->m_konten = new ModelKonten();
    }
    public function index()
    {
        $id_user = session()->get('id_user');
        $data = array(
            'menu' => 'dashboard',
            'submenu' => '',
            'head' => 'Halaman Dashboard',
            'title' => 'Dashboard',
            'isi' => 'main/user/home_user',
            'count' => $this->m_kuesioner->total_kuesioner_belum_terjawab($id_user),
            'count1' => $this->m_kuesioner->total_kuesioner_sudah_terjawab($id_user),
            'konten' => $this->m_konten->tampil_data()
        );
        return view('layout/admin/v_wrapper', $data);
    }
    public function detail()
    {
        $data = array(
            'menu' => 'dashboard',
            'submenu' => '',
            'head' => 'Keterangan',
            'title' => 'Keterangan Kuesioner',
            'isi' => 'main/user/kuesioner/kuesioner_detail'
        );
        return view('layout/admin/v_wrapper', $data);
    }
}
