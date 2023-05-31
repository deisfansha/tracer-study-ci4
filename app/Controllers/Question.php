<?php

namespace App\Controllers;

use App\Models\ModelQuestion;
use App\Models\ModelUsers;

class Question extends BaseController
{
    public function __construct()
    {
        $this->m_question = new ModelQuestion();
        $this->m_user = new ModelUsers();
        helper(['swal_helper']);
    }
    public function index()
    {
        $data = array(
            'menu' => 'survey',
            'submenu' => 'quest',
            'head' => 'Halaman Question',
            'title' => 'Data Pertanyaan',
            'isi' => 'main/admin/kuesioner/question_view',
            'tampil' => $this->m_question->tampildata(),
            'edit' => $this->m_question->tampil_edit(),
            'essay' => $this->m_question->tampil_essay()->getResult(),
            'option' => $this->m_question->tampil_option()->getResult(),

        );
        return view('layout/admin/v_wrapper', $data);
    }
    public function addQuest()
    {
        $validation = \Config\Services::validation();
        $valid = $this->validate([
            'nama_quest' => [
                'label' => 'Nama Question',
                'rules' => 'is_unique[tbl_question.nama_quest]',
                'errors' => [
                    'is_unique' => '{field} Sudah Ada'
                ]
            ],
            'kode_pertanyaan' => [
                'label' => 'Kode Pertanyaan',
                'rules' => 'is_unique[tbl_question.kode_pertanyaan]',
                'errors' => [
                    'is_unique' => '{field} Sudah Ada'
                ]
            ]
        ]);

        if (!$valid) {
            $sessErorr = [
                'err_nama' => $validation->getError('nama_quest'),
                'err_kd' => $validation->getError('kode_pertanyaan')
            ];
            session()->setFlashdata($sessErorr);
            set_notifikasi('error', 'Tambah Pertanyaan Gagal', '');
            return redirect()->to(base_url('question'));
        } else {

            $data = array(
                'nama_quest' => $this->request->getPost('nama_quest'),
                'kode_pertanyaan' => $this->request->getPost('kode_pertanyaan'),
                'tipe_pertanyaan' => $this->request->getPost('tipe_pertanyaan')
            );
            $this->m_question->tambah($data);
            set_notifikasi('success', 'Pertanyaan', 'Berhasil Ditambah!!!');
            return redirect()->to(base_url('question'));
        }
    }
    public function edit_quest($id_quest)
    {
        $validation = \Config\Services::validation();
        $valid = $this->validate([
            'nama_quest' => [
                'label' => 'Nama Question',
                'rules' => 'is_unique[tbl_question.nama_quest]',
                'errors' => [
                    'is_unique' => '{field} Sudah Ada'
                ]
            ],
            'kode_pertanyaan' => [
                'label' => 'Kode Pertanyaan',
                'rules' => 'is_unique[tbl_question.kode_pertanyaan]',
                'errors' => [
                    'is_unique' => '{field} Sudah Ada'
                ]
            ]
        ]);
        if (!$valid) {
            $sessErorr = [
                'err_nama' => $validation->getError('nama_quest'),
                'err_kd' => $validation->getError('kode_pertanyaan')
            ];
            session()->setFlashdata($sessErorr);
            set_notifikasi('error', 'Update Pertanyaan Gagal', session()->getFlashdata('err_nama') | session()->getFlashdata('err_kd'));
            return redirect()->to(base_url('question'));
        } else {
            $data = array(
                'kode_pertanyaan' => $this->request->getPost('kode_pertanyaan'),
                'nama_quest' => $this->request->getPost('nama_quest')
            );
            $this->m_question->edit_quest_data($data, $id_quest);
            set_notifikasi('success', 'Data Pertanyaan', 'Berhasil DiUpdate !!!!');
            return redirect()->to(base_url('question'));
        }
    }
    public function delete_quest($id_quest)
    {
        $db = \Config\Database::connect();
        $question = $db->table('tbl_answer')->where('kode_quest', $id_quest)->get()->getRowArray();

        if ($question == null) {
            $this->m_question->delete_show_quest($id_quest);
            $this->m_question->delete_quest_data($id_quest);
            set_notifikasi('success', 'Data Pertanyaan', 'Berhasil DiHapus !!!!');
            return redirect()->to(base_url('question'));
        }
    }


    public function add_option($id_quest)
    {
        $data = array(
            'menu' => 'survey',
            'submenu' => 'quest',
            'head' => 'Halaman question',
            'title' => 'Tambah Option',
            'isi' => 'main/admin/kuesioner/question_detail',
            'detail' => $this->m_question->detail($id_quest)->getRow(),
            'option' => $this->m_question->lists_option($id_quest)->getResult()
        );
        return view('layout/admin/v_wrapper', $data);
    }
    public function add($id_quest)
    {
        $validation = \Config\Services::validation();
        $valid = $this->validate([
            'nama' => [
                'label' => 'Nama Option',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong'
                ]
            ]
        ]);
        if (!$valid) {
            $sessErorr = [
                'err_nama_option' => $validation->getError('nama')
            ];
            session()->setFlashdata($sessErorr);
            set_notifikasi('error', 'Tambah Option Gagal', '');
            return redirect()->to(base_url('question/add_option/' . $id_quest));
        } else {
            $data = array(
                'kode_quest' => $id_quest,
                'nama' => $this->request->getPost('nama')
            );

            $this->m_question->tambah_option($data);
            set_notifikasi('success', 'Option', 'Berhasil Ditambah!!!');
            return redirect()->to(base_url('question/add_option/' . $id_quest));
        }
    }

    public function delete_option($kode_quest, $id_select)
    {
        $this->m_question->delete_option_data($id_select);
        set_notifikasi('success', 'Data Option', 'Berhasil DiHapus !!!!');
        return redirect()->to(base_url('question/add_option/' . $kode_quest));
    }
}
