<?php

namespace App\Controllers;

use App\Models\ModelUsers;
use App\Models\ModelAdmin;

class Home extends BaseController
{
    public function __construct()
    {
        helper(['swal_helper']);
        $this->m_user = new ModelUsers();
        $this->m_admin = new ModelAdmin();
    }
    public function index()
    {
        $data = array(
            'menu' => 'dashboard',
            'submenu' => '',
            'head' => 'Halaman Dashboard',
            'title' => 'Dashboard',
            'total_alumni' => $this->m_admin->TotalAlumni(),
            'total_kuesioner' => $this->m_admin->TotalKuesioner(),
            'total_pending' => $this->m_admin->TotalPending(),
            'total_question' => $this->m_admin->TotalQuestion(),
            'thn_lulus' => $this->m_admin->TotalTahun(),
            'responden' => $this->m_admin->TotalResponden(),
            'getprodi' => $this->m_admin->GetProdi(),
            'isi' => 'main/admin/dashboard'
        );
        return view('layout/admin/v_wrapper', $data);
    }

    public function getTahunLulusByProdi()
    {
        $prodi = $this->request->getPost('prodi');
        $hasil = $this->m_admin->TotalTahunPerProdi($prodi);
        echo json_encode($hasil);
    }
    public function getKuesionerByProdi()
    {
        $prodi = $this->request->getPost('prodi');
        $hasil2 = $this->m_admin->TotalRespondenPerProdi($prodi);
        echo json_encode($hasil2);
    }
}
