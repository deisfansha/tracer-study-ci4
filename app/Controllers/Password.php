<?php

namespace App\Controllers;

use App\Models\ModelFakultas;
use App\Models\ModelUsers;
use CodeIgniter\Model;

class password extends BaseController
{
    public function __construct()
    {
        $this->m_user = new ModelUsers();
        helper(['swal_helper']);
    }
    public function index()
    {
        $nama = session()->get('nama_lengkap');
        $data = array(
            'head' => $nama,
            'menu' => '',
            'submenu' => '',
            'title' => 'Ubah Password',
            'validation' => \Config\Services::validation(),
            'isi' => 'main/change_pass'
        );
        return view('layout/admin/v_wrapper', $data);
    }
    public function ubah_password($id_user)
    {
        // if ($this->request->isAJAX()) {
        //     $passlama = $this->request->getPost('passlama');
        //     $passbaru = $this->request->getPost('passbaru');
        //     $passconfirm = $this->request->getPost('passconfirm');

        //     $validation = \Config\Services::validation();
        //     $valid = $this->validate([
        //         'passlama' => [
        //             'label' => 'Password Lama',
        //             'rules' => 'required',
        //             'erros' => [
        //                 'required' => '{fields} Tidak Boleh Kosong'
        //             ]
        //         ],
        //     ]);

        //     if (!$valid) {
        //         $error = [
        //             'passlama' => $validation->getError('passlama')
        //         ];

        //         $json = [
        //             'error' => $error
        //         ];
        //     }

        //     echo json_encode($json);
        // }

        $id_user = session()->get('id_user');
        $validation = \Config\Services::validation();
        if ($this->validate([
            'password_lama' => [
                'label' => 'Password Lama',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong'
                ]
            ],
            'password_baru' => [
                'label' => 'Password Baru',
                'rules' => 'required|max_length[15]|min_length[8]',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong',
                    'max_length' => 'Terlalu Panjang',
                    'min_length' => 'Terlalu Sedikit'
                ]
            ],
            'password_confirm' => [
                'label' => 'Password',
                'rules' => 'required|matches[password_baru]',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong',
                    'matches' => '{field} Tidak Cocok',
                ]
            ]
        ])) {
            $pass = $this->request->getPost('password_baru');
            $pass_ens = password_hash($pass, PASSWORD_BCRYPT);
            $data = array(
                'id_user' => $id_user,
                'password' => $pass_ens

            );
            $this->m_user->ubah_password($data, $id_user);
            set_notifikasi('success', 'Password', 'Berhasil DiUpdate !!!!');
            return redirect()->to('password');
        } else {
            $sessErorr = [
                'err_password_lama' => $validation->getError('password_lama'),
                'err_password_baru' => $validation->getError('password_baru'),
                'err_password_confirm' => $validation->getError('password_confirm')
            ];
            session()->setFlashdata($sessErorr);
            return redirect()->to('password');
        }
    }
}
