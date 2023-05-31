<?php

namespace App\Controllers;

use App\Models\ModelHasil;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class HasilUsers extends BaseController
{
    public function __construct()
    {
        $this->m_hasil = new ModelHasil();
    }
    public function index()
    {
        $kode_users = session()->get('id_user');
        $data = array(
            'menu' => 'hasilUsers',
            'submenu' => '',
            'head' => 'Hasil Kuesioner',
            'title' => 'Hasil Kuesioner',
            'isi' => 'main/user/hasil/hasil_view',
            'hasil' => $this->m_hasil->view_hasil_users($kode_users),
        );
        return view('layout/admin/v_wrapper', $data);
    }
    public function detail_hasil_users($id_kuesioner)
    {
        $kode_users = session()->get('id_user');
        $data = array(
            'menu' => 'hasilUsers',
            'submenu' => '',
            'head' => 'Hasil Kuesioner',
            'title' => 'Hasil Kuesioner',
            'isi' => 'main/user/hasil/hasil_detail',
            'nama' => $this->m_hasil->get_name_kuesioner($id_kuesioner),
            'hasil' => $this->m_hasil->detail_answer($kode_users, $id_kuesioner),
            'answer' =>  $this->m_hasil->answer_users($kode_users, $id_kuesioner),
        );
        return view('layout/admin/v_wrapper', $data);
    }
}
