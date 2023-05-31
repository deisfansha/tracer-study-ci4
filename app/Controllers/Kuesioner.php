<?php

namespace App\Controllers;

use App\Models\ModelKuesioner;
use App\Models\ModelUsers;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Kuesioner extends BaseController
{
    public function __construct()
    {
        $this->m_kuesioner = new ModelKuesioner();
        $this->m_user = new ModelUsers();
        helper(['swal_helper']);
    }
    public function index()
    {
        $data = array(
            'menu' => 'survey',
            'submenu' => 'kuesioner',
            'head' => 'Halaman Kuesioner',
            'title' => 'Data Kuesioner',
            'isi' => 'main/admin/kuesioner/kuesioner_view',
            'tampil_kuesioner' => $this->m_kuesioner->tampildata_reject(),
            'tampil_kuesioner_publish' => $this->m_kuesioner->tampildata_publish()

        );
        return view('layout/admin/v_wrapper', $data);
    }
    public function add_kuesioner()
    {
        $validation = \Config\Services::validation();
        $valid = $this->validate([
            'nama_kuesioner' => [
                'label' => 'Nama Kuesioner',
                'rules' => 'is_unique[tbl_kuesioner.nama_kuesioner]',
                'errors' => [
                    'is_unique' => '{field} Sudah Ada'
                ]
            ],
            'kd_kuesioner' => [
                'label' => 'Kode Kuesioner',
                'rules' => 'is_unique[tbl_kuesioner.kd_kuesioner]|max_length[3]',
                'errors' => [
                    'is_unique' => '{field} Sudah Ada',
                    'max_length' => 'Terlalu Panjang',
                ]
            ]
        ]);

        if (!$valid) {
            $sessErorr = [
                'err_nama' => $validation->getError('nama_kuesioner'),
                'err_kd' => $validation->getError('kd_kuesioner')
            ];
            session()->setFlashdata($sessErorr);
            set_notifikasi('error', 'Tambah Kuesioner Gagal', session()->getFlashdata('err_nama') | session()->getFlashdata('err_kd'));
            return redirect()->to(base_url('kuesioner'));
        } else {
            $data = array(
                'nama_kuesioner' => $this->request->getPost('nama_kuesioner'),
                'kd_kuesioner' => $this->request->getPost('kd_kuesioner'),
                'keterangan' => $this->request->getPost('keterangan'),
                'status' => "reject"

            );
            $this->m_kuesioner->tambah_kuesioner($data);
            set_notifikasi('success', 'Data Kuesioner', 'Berhasil Ditambah!!!');
            return redirect()->to(base_url('kuesioner'));
        }
    }
    public function edit_kuesioner($id_kuesioner)
    {
        $data = array(
            'nama_kuesioner' => $this->request->getPost('nama_kuesioner'),
            'keterangan' => $this->request->getPost('keterangan')
        );
        $this->m_kuesioner->edit_kuesioner_data($data, $id_kuesioner);
        set_notifikasi('success', 'Data Kuesioner', 'Berhasil DiUpdate !!!!');
        return redirect()->to(base_url('kuesioner'));
    }
    public function delete_kuesioner($id_kuesioner)
    {
        $this->m_kuesioner->delete_kuesioner_data($id_kuesioner);
        set_notifikasi('success', 'Data Kuesioner', 'Berhasil DiHapus !!!!');
        return redirect()->to(base_url('kuesioner'));
    }


    // Tambah Pertanyaan
    public function add_question($id_kuesioner)
    {
        $nama = $this->m_kuesioner->detail($id_kuesioner);
        $data = array(
            'menu' => 'survey',
            'submenu' => 'kuesioner',
            'head' => $nama['nama_kuesioner'],
            'title' => 'Pilih Pertanyaan',
            'isi' => 'main/admin/kuesioner/kuesioner_add_quest',
            'kuesioner' => $this->m_kuesioner->detail($id_kuesioner),
            'question' => $this->m_kuesioner->lists_question($id_kuesioner),
        );
        return view('layout/admin/v_wrapper', $data);
    }
    public function add_question_aksi()
    {
        $id_kuesioner = $this->request->getPost('kode_kuesioner');
        $id_quest = $this->request->getPost('kode_quest');

        $data = array(
            'kode_kuesioner' => $id_kuesioner,
            'kode_quest' => $id_quest
        );

        $cek = $this->m_kuesioner->cekRule($id_kuesioner, $id_quest);
        if ($cek) {
            $del = $this->m_kuesioner->deleteQuest($data);
        } else {
            $add_quest = $this->m_kuesioner->addQuest($data);
            echo json_encode($add_quest);
            // if ($add_quest) {
            //     echo json_encode('berhasil');
            // } else {
            //     echo json_encode('gagal');
            // }
        }
    }
    public function detail_kuesioner($id_kuesioner)
    {
        $id_kuesioner = base64_decode(base64_decode($id_kuesioner));
        $data = array(
            'menu' => 'survey',
            'submenu' => 'kuesioner',
            'head' => 'Detail',
            'title' => 'Detail Kuesioner',
            'isi' => 'main/admin/kuesioner/kuesioner_detail',
            'tampil_question' => $this->m_kuesioner->detail_question($id_kuesioner),
            'detail' => $this->m_kuesioner->detail($id_kuesioner),
        );
        return view('layout/admin/v_wrapper', $data);
    }
    public function edit_publish($id_kuesioner)
    {
        $count = $this->m_kuesioner->total_quest($id_kuesioner);

        if ($count[0]['total'] == 0) {
            set_notifikasi('error', 'Kuesioner Gagal Di Publish', 'Pertanyaan Pada Kuesioner Masih Kosong');
            return redirect()->to(base_url('kuesioner'));
        } else {
            $data = array(
                'status' => "publish"
            );
            $this->m_kuesioner->edit_kuesioner_data($data, $id_kuesioner);
            set_notifikasi('success', 'Status Kuesioner', 'Berhasil Di Publish!!!!');
            return redirect()->to(base_url('kuesioner'));
        }
    }
}
