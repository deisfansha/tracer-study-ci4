<?php

namespace App\Controllers;

use App\Models\ModelKuesioner;
use App\Models\ModelUsers;

class KuesionerUsers extends BaseController
{
    public function __construct()
    {
        $this->m_kuesioner = new ModelKuesioner();
        $this->m_user = new ModelUsers();
        helper(['swal_helper']);
    }
    public function index()
    {
        $id_user = session()->get('id_user');
        $data = array(
            'menu' => 'kuesionerUser',
            'submenu' => '',
            'head' => 'Halaman Kuesioner',
            'title' => 'Data Kuesioner',
            'isi' => 'main/user/kuesioner/kuesioner_view',
            'tampil' => $this->m_kuesioner->user_kuesioner_part2($id_user)
        );
        return view('layout/admin/v_wrapper', $data);
    }
    public function detail($id_kuesioner)
    {
        $id_user = session()->get('id_user');
        $check = $this->m_kuesioner->get_answer($id_kuesioner, $id_user);
        if ($check) {
            $sudah_mengisi = true;
        } else {
            $sudah_mengisi = false;
        }
        $data = array(
            'menu' => 'kuesionerUser',
            'submenu' => '',
            'head' => 'Keterangan',
            'title' => 'Keterangan',
            'isi' => 'main/user/kuesioner/kuesioner_detail',
            'details' => $this->m_kuesioner->detail($id_kuesioner),
            'check' => $sudah_mengisi
        );
        return view('layout/admin/v_wrapper', $data);
    }
    public function form_kuesioner($id_kuesioner)
    {
        $id_user = session()->get('id_user');
        $data = array(
            'menu' => 'kuesionerUser',
            'submenu' => '',
            'head' => 'Kuesioner',
            'title' => 'Form Kuesioner',
            'isi' => 'main/user/kuesioner/kuesioner_form',
            'user' => $this->m_user->get_user($id_user),
            'detail' => $this->m_kuesioner->detail($id_kuesioner),
            'details' => $this->m_kuesioner->detail_question($id_kuesioner)
        );
        return view('layout/admin/v_wrapper', $data);
    }
    public function insert_answer($id_kuesioner)
    {
        if ($this->request->getVar('data')) {
            $data = $this->request->getVar('data');
            //echo json_encode($data);
            foreach ($data as $d) {
                // $d = json_decode($d);
                $answer = array(
                    'kode_users' => session()->get('id_user'),
                    'kode_kuesioner' => $id_kuesioner,
                    'kode_quest' => $d['kode_quest'],
                    'answer' => $d['answer'],

                );
                $this->m_kuesioner->tambah_answer($answer);
                // echo json_encode($d);
            }
            echo json_encode($data);
            set_notifikasi('success', 'Terimakasih', 'Berhasil Ditambah!!!');
        }
    }
}
