<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelFakultas;
use App\Models\ModelLogin;
use App\Models\ModelProdi;

class Login extends BaseController
{
    public function __construct()
    {
        helper(['swal_helper']);
        $this->ModelLogin = new ModelLogin();
    }
    public function index()
    {
        if (session('id_user')) {
            return redirect()->to(site_url('home'));
        }
        return view('login/index');
    }
    public function register()
    {
        $fk = new ModelFakultas();
        $data = array(
            'head' => 'Admin',
            'title' => 'Halaman Register',
            'tampilfakultas' => $fk->orderBy('nama_fakultas', 'ASC')->findAll()
        );
        return view('login/register', $data);
    }

    public function verif_email()
    {
        $data = array(
            'title' => 'Verifikasi Email'
        );
        return view('login/verif_email', $data);
    }
    public function get_Password()
    {
        $email = $this->request->getPost('email');
        $validation = \Config\Services::validation();

        $valid = $this->validate([
            'email' => [
                'label' => 'Email',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong'
                ]
            ]

        ]);

        if (!$valid) {
            $sessErorr = [
                'errEmail' => $validation->getError('email')
            ];

            session()->setFlashdata($sessErorr);
            return redirect()->to('/login/verif_email');
        } else {
            $db = \Config\Database::connect();
            $builder = $db->table('user');
            if ($email != '') {
                $builder->like('email', $email);
            }
            $query = $builder->get();
            $cekemail = $query->getResultArray();
            if ($cekemail == null) {
                $sessErorr = [
                    'errEmail' => 'Belum Terdaftar'
                ];
                set_notifikasi('error', 'Verification Email', 'Email Tidak Ditemukan');
                session()->setFlashdata($sessErorr);
                return redirect()->to('/login/verif_email');
            } else {
                $email = \Config\Services::email();
                $email_user = $this->request->getPost('email');
                $email->setTo($email_user);
                $email->setFrom('tracerstudy@unnur.ac.id', 'Tracer Study Universitas Nurtanio Bandung');
                $email->setSubject('Lupa Password');
                $email->setMessage('Klik link untuk mengupdate password <a href=' . base_url("login/change_pass/" . base64_encode($email_user)) . '> Click Here <a>');
                $email->send();

                set_notifikasi('success', 'Verifikasi Email', 'Berhasil Terkirim, Cek Email Untuk Mengganti Password Anda');
                return redirect()->to(base_url('login/verif_email'));
            }
        }
    }
    function change_pass($email)
    {
        $data = array(
            'title' => 'Ubah Password',
            'email' => $email
        );
        return view('login/pass_confirm', $data);
    }
    function ubah_pass($email)
    {
        $validation = \Config\Services::validation();
        if ($this->validate([
            'pass' => [
                'label' => 'Password',
                'rules' => 'required|min_length[7]|max_length[15]',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong',
                    'min_length' => 'Too Short',
                    'max_length' => 'Too Long'
                ]
            ],
            'confirm_pass' => [
                'label' => 'Ulangi Password',
                'rules' => 'required|matches[pass]',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong',
                    'matches' => 'Password Tidak Sama'
                ]
            ]
        ])) {

            $pass = $this->request->getPost('pass');
            $pass_ens = password_hash($pass, PASSWORD_BCRYPT);

            $data = array(
                'password' => $pass_ens,
            );
            $this->ModelLogin->update_pass($data, base64_decode($email));
            set_notifikasi('success', 'Update Password', 'Berhasil!!!');
            return redirect()->to('/login/index');
        } else {
            $sessErorr = [
                'errPass' => $validation->getError('pass'),
                'errRePass' => $validation->getError('confim_pass')
            ];

            set_notifikasi('error', 'Ubah Password', 'Gagal!! Coba Perhatikan Lagi');
            session()->setFlashdata($sessErorr);
            return redirect()->to('/login/change_pass/' . base64_decode($email));
        }
    }
    function action()
    {
        if ($this->request->getVar('action')) {
            $action = $this->request->getVar('action');

            if ($action == 'get_prodi') {
                $prd = new ModelProdi();

                $prodi = $prd->where('kode_fakultas', $this->request->getVar('id_fakultas'))->findAll();

                echo json_encode($prodi);
            }
        }
    }
    public function save_register()
    {
        $validation = \Config\Services::validation();
        if ($this->validate([
            'nama_lengkap' => [
                'label' => 'Nama',
                'rules' => 'required|is_unique[user.nama_lengkap]',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong',
                    'is_unique' => '{field} Sudah Terdaftar'
                ]
            ],
            'nim' => [
                'label' => 'NIM',
                'rules' => 'required|is_unique[user.nim]',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong',
                    'is_unique' => '{field} Sudah Terdaftar'
                ]
            ],
            'foto' => [
                'label' => 'Foto',
                'rules' => 'is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'is_image' => '{field} Yang anda pilih bukan foto',
                    'mime_in' => '{field} Yang anda pilih bukan foto'
                ]
            ],
            'username' => [
                'label' => 'Username',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong'
                ]
            ],
            'email' => [
                'label' => 'E-mail',
                'rules' => 'required|valid_email|is_unique[user.email]',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong',
                    'is_unique' => '{field} Sudah Terdaftar'
                ]
            ],
            'no_handphone' => [
                'label' => 'No Handphone',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong'
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required|min_length[7]|max_length[15]',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong',
                    'min_length' => 'Too Short',
                    'max_length' => 'Too Long'
                ]
            ],
            'repassword' => [
                'label' => 'Ulangi Password',
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong',
                    'matches' => 'Password Tidak Sama'
                ]
            ]
        ])) {

            // Ambil Foto
            $filefoto = $this->request->getFile('foto');

            //kondisi jika tidak upload foto
            if ($filefoto->getError() == 4) {
                $namafoto = null;
            } else {

                // Ambil Nama Foto
                $namafoto = $filefoto->getRandomName();

                // Pindahkan Foto
                $filefoto->move('assets/img', $namafoto);
            }

            $pass = $this->request->getPost('password');
            $pass_ens = password_hash($pass, PASSWORD_BCRYPT);

            $data = array(
                'nama_lengkap' => $this->request->getPost('nama_lengkap'),
                'nim' => $this->request->getPost('nim'),
                'username' => $this->request->getPost('username'),
                'jenis_klm' => $this->request->getPost('jenis_klm'),
                'kode_fakultas' => $this->request->getPost('fakultas'),
                'kode_prodi' => $this->request->getPost('prodi'),
                'tahun_lulus' => $this->request->getPost('tahun_lulus'),
                'email' => $this->request->getPost('email'),
                'no_hp' => $this->request->getPost('no_handphone'),
                'password' => $pass_ens,
                'foto' => $namafoto,
                'status' => 'pending',
                'level' => 2
            );
            $this->ModelLogin->save_register($data);
            set_notifikasi('success', 'Registrasi Berhasil', 'Anda Bisa Login Setelah Mendapatkan Persetujuan Dari Admin');
            return redirect()->to('/login/index');
        } else {
            $sessErorr = [
                'errNamaLengkap' => $validation->getError('nama_lengkap'),
                'errnim' => $validation->getError('nim'),
                'errUsername' => $validation->getError('username'),
                'errEmail' => $validation->getError('email'),
                'errNoHp' => $validation->getError('no_handphone'),
                'errPass' => $validation->getError('password'),
                'errRePass' => $validation->getError('repassword'),
                'errFoto' => $validation->getError('foto'),
            ];

            set_notifikasi('error', 'Registrasi Gagal', 'Coba Perhatikan Lagi');
            session()->setFlashdata($sessErorr);
            return redirect()->to('/login/register');
        }
    }
    public function cekUser()
    {
        $user = $this->request->getPost('user');
        $pass = $this->request->getPost('pass');

        $validation = \Config\Services::validation();

        $valid = $this->validate([
            'user' => [
                'label' => 'Username',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong'
                ]
            ],
            'pass' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong'
                ]
            ]

        ]);

        if (!$valid) {
            $sessErorr = [
                'errUsername' => $validation->getError('user'),
                'errPassword' => $validation->getError('pass')
            ];

            session()->setFlashdata($sessErorr);
            return redirect()->to('/login/index');
        } else {
            // $modelLogin = new ModelLogin();
            // $cekUserLogin = $modelLogin->find($user);
            $db = \Config\Database::connect();
            $builder = $db->table('user');
            if ($user != '') {
                $builder->like('username', $user);
                $builder->orlike('nim', $user);
            }
            $query = $builder->get();
            $cekUserLogin = $query->getResultArray();

            if ($cekUserLogin == null) {
                $sessErorr = [
                    'errUsername' => 'Belum Terdaftar'
                ];
                set_notifikasi('error', 'Login Gagal', 'User Tidak Ditemukan');
                session()->setFlashdata($sessErorr);
                return redirect()->to('/login/index');
            } else {

                $passwordUser = $cekUserLogin[0]['password'];
                $status = $cekUserLogin[0]['status'];
                if (password_verify($pass, $passwordUser)) {
                    if ($status == 'approved') {
                        $idlevel = $cekUserLogin[0]['level'];
                        $simpan_session = [
                            'login' => true,
                            'username' => $user,
                            'nama_lengkap' => $cekUserLogin[0]['nama_lengkap'],
                            'id_user' => $cekUserLogin[0]['id_user'],
                            'foto' => $cekUserLogin[0]['foto'],
                            'idlevel' => $idlevel
                        ];
                        session()->set($simpan_session);
                        if (session()->idlevel == 1) {
                            set_notifikasi('success', 'LOGIN BERHASIL', 'Sebagai Admin');
                            return redirect()->to('home');
                        } else {
                            set_notifikasi('success', 'LOGIN BERHASIL', 'Sebagai Alumni');
                            return redirect()->to('homeusers');
                        }
                    } else {
                        $sessError = [
                            'errStatus' => 'Login Ditolak',
                        ];
                        set_notifikasi('error', 'Login Ditolak', 'Belum Disetujui Oleh Admin');
                        return redirect()->to(site_url('login/index'));
                    }
                } else {
                    $sessError = [
                        'errPassword' => 'Password Anda Salah',
                    ];

                    session()->setFlashdata($sessError);
                    return redirect()->to(site_url('login/index'));
                }
            }
        }
    }
    public function keluar()
    {
        session()->destroy();
        set_notifikasi('success', 'Logout Berhasil!!!', 'Anda telah Logout');
        return redirect()->to('/login/index');
    }
}
