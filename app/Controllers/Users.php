<?php

namespace App\Controllers;

use App\Models\ModelUsers;
use App\Models\ModelProdi;
use App\Models\ModelFakultas;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Validation\Rules;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Users extends BaseController
{
    protected $request;
    public function __construct()
    {

        $this->m_user = new ModelUsers();
        $this->m_fakultas = new ModelFakultas();
        $this->pager = \Config\Services::pager();
        helper('form');
        helper(['swal_helper']);
    }
    public function index()
    {
        $current_page = $this->request->getVar('page_user') ? $this->request->getVar('page_user') : 1;
        $keyword = $this->request->getGet('keyword');
        // if ($keyword) {
        //     $users = $this->m_user->search($keyword);
        // } else {
        //     $users = $this->m_user;
        // }
        $data = $this->m_user->getPaginate(7, $keyword);
        $data['menu'] = 'users';
        $data['submenu'] = 'datauser';
        $data['head'] = 'Data Alumni';
        $data['title'] = 'Data Alumni';
        $data['isi'] = 'main/admin/users';
        $data['detail'] = $this->m_user->tampildata();
        $data['currentPage'] = $current_page;
        $data['tampilfakultas'] = $this->m_fakultas->orderBy('nama_fakultas', 'ASC')->findAll();
        return view('layout/admin/v_wrapper', $data);
    }
    public function viewstatus()
    {
        $data['menu'] = 'users';
        $data['submenu'] = 'datastatus';
        $data['head'] = 'Status Alumni';
        $data['title'] = 'Status Alumni';
        $data['isi'] = 'main/admin/view_status';
        $data['viewdata'] = $this->m_user->view_pending_data();
        $data['viewreject'] = $this->m_user->view_reject_data();
        $data['tampilfakultas'] = $this->m_fakultas->orderBy('nama_fakultas', 'ASC')->findAll();
        return view('layout/admin/v_wrapper', $data);
    }
    public function export()
    {
        $keyword = $this->request->getVar('keyword');
        $db = \Config\Database::connect();
        $builder = $db->table('user');
        $builder->join(
            "tbl_fakultas",
            "tbl_fakultas.id_fakultas=user.kode_fakultas",
        )->join(
            "tbl_prodi",
            "tbl_prodi.id_prodi=user.kode_prodi",
        )->where('status=', 'approved');

        if ($keyword != '') {
            $builder->like('nama_lengkap', $keyword);
            $builder->orlike('nim', $keyword);
            $builder->orlike('tahun_lulus', $keyword);
            $builder->orlike('nama_fakultas', $keyword);
            $builder->orlike('nama_prodi', $keyword);
        }

        $query = $builder->get();
        $users_search = $query->getResultArray();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Nomor');
        $sheet->setCellValue('B1', 'NIM');
        $sheet->setCellValue('C1', 'Nama Lengkap');
        $sheet->setCellValue('D1', 'Fakultas');
        $sheet->setCellValue('E1', 'Program Studi');
        $sheet->setCellValue('F1', 'Jenis Kelamin');
        $sheet->setCellValue('G1', 'Tahun Lulus');
        $sheet->setCellValue('H1', 'Email');
        $sheet->setCellValue('I1', 'Nomor Handphone');
        $sheet->setCellValue('J1', 'NIK');
        $sheet->setCellValue('K1', 'Tempat Lahir');
        $sheet->setCellValue('L1', 'Tanggal Lahir');
        $sheet->setCellValue('M1', 'Alamat Rumah');
        $column = 2;
        foreach ($users_search as $value) {
            $sheet->setCellValue('A' . $column, ($column - 1));
            $sheet->setCellValue('B' . $column, $value['nim']);
            $sheet->setCellValue('C' . $column, $value['nama_lengkap']);
            $sheet->setCellValue('D' . $column, $value['nama_fakultas']);
            $sheet->setCellValue('E' . $column, $value['nama_prodi']);
            $sheet->setCellValue('F' . $column, $value['jenis_klm']);
            $sheet->setCellValue('G' . $column, $value['tahun_lulus']);
            $sheet->setCellValue('H' . $column, $value['email']);
            $sheet->setCellValue('I' . $column, $value['no_hp']);
            $sheet->setCellValue('J' . $column, $value['nik']);
            $sheet->setCellValue('K' . $column, $value['tempat_lahir']);
            $sheet->setCellValue('L' . $column, $value['tgl_lahir']);
            $sheet->setCellValue('M' . $column, $value['alamat_rmh']);
            $column++;
        }
        $stylearray = [
            'borders' => [
                'allborders' => [
                    'borderstyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ],
            ],
        ];
        $sheet->getStyle('A1:M' . ($column - 1))->applyFromArray($stylearray);
        $sheet->getStyle('A1:M1')->getFont()->setBold(true);
        $sheet->getStyle('A1:M1')->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FFFFFF00');

        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $sheet->getColumnDimension('F')->setAutoSize(true);
        $sheet->getColumnDimension('G')->setAutoSize(true);
        $sheet->getColumnDimension('H')->setAutoSize(true);
        $sheet->getColumnDimension('I')->setAutoSize(true);
        $sheet->getColumnDimension('J')->setAutoSize(true);
        $sheet->getColumnDimension('K')->setAutoSize(true);
        $sheet->getColumnDimension('L')->setAutoSize(true);
        $sheet->getColumnDimension('M')->setAutoSize(true);

        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheet.html');
        header('Content-Disposition: attachment;filename=Data Alumni.xlsx');
        header('Chace-Control: max-age=0');
        $writer->save('php://output');
        exit();
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
    public function addUser()
    {
        $validation = \Config\Services::validation();
        $valid = $this->validate([
            'nama_lengkap' => [
                'label' => 'Nama',
                'rules' => 'is_unique[user.nama_lengkap]',
                'errors' => [
                    'is_unique' => '{field} Sudah Terdaftar'
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'min_length[7]|max_length[15]',
                'errors' => [
                    'min_length' => 'Too Short',
                    'max_length' => 'Too Long'
                ]
            ],
        ]);

        if (!$valid) {
            $sessErorr = [
                'err_namaLengkap' => $validation->getError('nama_lengkap'),
                'err_pass' => $validation->getError('password')
            ];
            session()->setFlashdata($sessErorr);
            set_notifikasi('error', 'Tambah User Gagal', '');
            return redirect()->to(base_url('users'));
        } else {
            $pass = $this->request->getPost('password');
            $pass_ens = password_hash($pass, PASSWORD_BCRYPT);
            $data = array(
                'nama_lengkap' => $this->request->getPost('nama_lengkap'),
                'username' => $this->request->getPost('username'),
                'jenis_klm' => $this->request->getPost('jenis_klm'),
                'kode_fakultas' => $this->request->getPost('fakultas'),
                'kode_prodi' => $this->request->getPost('prodi'),
                'tahun_lulus' => $this->request->getPost('tahun_lulus'),
                'email' => $this->request->getPost('email'),
                'no_hp' => $this->request->getPost('no_hp'),
                'password' => $pass_ens,
                'status' => 'approved',
                'level' => 2
            );
            $this->m_user->tambah($data);
            set_notifikasi('success', 'Data User', 'Berhasil Ditambah!!!');
            return redirect()->to(base_url('users'));
        }
    }
    public function multiple_edit_status()
    {
        $status = $this->request->getPost('pilihstatus');
        $check = $this->request->getPost('pilih');
        foreach ($check as $id_user) {

            $email = \Config\Services::email();
            $email_user = $this->m_user->get_user($id_user);
            $email->setTo($email_user['email']);
            $email->setFrom('admintracerstudy@unnur.com', 'Tracer Study Universitas Nurtanio Bandung');
            $email->setSubject('Status Login');
            $email->setMessage('Status Anda Berhasil Di Apporoved Oleh Admin, anda bisa login sekarang');
            $email->send();

            $data = array(
                'status' => $status
            );
            $update = $this->m_user->edit_data($data, $id_user);

            if (!$update) {
                set_notifikasi('error', 'Status User', 'Gagal Di Approved !!!!');
                return redirect()->to(base_url('users/viewstatus'));
            }
        }

        set_notifikasi('success', 'Status User', 'Berhasil Approved !!!!');
        return redirect()->to(base_url('users/viewstatus'));
    }
    public function edit_approved($id_user)
    {
        $email = \Config\Services::email();
        $email_user = $this->m_user->get_user($id_user);
        $email->setTo($email_user['email']);
        $email->setFrom('tracerstudy@unnur.ac.id', 'Tracer Study Universitas Nurtanio Bandung');
        $email->setSubject('Status Login');
        $email->setMessage('Status Anda Berhasil Di Apporoved Oleh Admin, anda bisa login sekarang');
        $email->send();

        $data = array(
            'status' => "approved"
        );

        $update = $this->m_user->edit_data($data, $id_user);

        if ($update) {
            set_notifikasi('success', 'Status User', 'Berhasil Approved !!!!');
            return redirect()->to(base_url('users/viewstatus'));
        } else {
            set_notifikasi('error', 'Status User', 'Gagal Di Approved !!!!');
            return redirect()->to(base_url('users/viewstatus'));
        }
    }
    public function edit_reject($id_user)
    {
        $data = array('status' => "reject");
        $this->m_user->edit_data($data, $id_user);
        set_notifikasi('success', 'Status User', 'Berhasil Reject !!!!');
        return redirect()->to(base_url('users/viewstatus'));
    }
    public function save_data()
    {
        $data['alm'] = $this->ModelUsers->insertdata();
        return redirect()->to('/Users');
    }
    public function detail($id_user)
    {
        $alm = new ModelUsers;
        $data = array(
            'title' => 'Detail User',
            'isi' => 'main/admin/users_detail',
            'detail' => $alm->detailalmn($id_user)->getRow()
        );
        return view('layout/admin/v_wrapper', $data);
    }
    public function delete($id_user)
    {
        $db = \Config\Database::connect();
        $user = $db->table('user')->where('id_user', $id_user)->get()->getRowArray();
        $alumni = $db->table('tbl_answer')->where('kode_users', $id_user)->get()->getRowArray();

        if ($user['foto'] != null) {
            unlink('assets/img/' .  $user['foto']);
        }

        if ($alumni) {
            set_notifikasi('error', 'Data Alumni', 'Tidak Bisa DiHapus !!!');
            return redirect()->to(base_url('users'));
        } else {
            $this->m_user->delete_data($id_user);
            set_notifikasi('success', 'Data Alumni', 'Berhasil DiHapus !!!');
            return redirect()->to(base_url('users'));
        }
    }
    public function upload()
    {
        $validation = \Config\Services::validation();
        $valid = $this->validate(
            [
                'fileimport' => [
                    'label' => 'Inputan File',
                    'rules' => 'uploaded[fileimport]|ext_in[fileimport,xls,xlsx]',
                    'errors' => [
                        'uploaded' => '{field} Wajib Diisi',
                        'ext_in' => '{field} Harus Ekstensi xls & xlsx'
                    ]
                ]
            ]
        );

        if (!$valid) {
            set_notifikasi('error', 'Import Data Gagal', $validation->getError('fileimport'));
            return redirect()->to(base_url('users'));
        } else {
            $file_excel = $this->request->getFile('fileimport');
            $ext = $file_excel->getClientExtension();

            if ($ext == 'xls') {
                $render = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
            } else {
                $render = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }

            $spreadsheet = $render->load($file_excel);
            $data = $spreadsheet->getActiveSheet()->toArray();
            $jmlerror = 0;
            $jmlsukses = 0;
            foreach ($data as $x => $row) {
                if ($x == 0) {
                    continue;
                }

                $nim = $row[1];
                $nama = $row[2];
                $fakultas = $row[3];
                $prodi = $row[4];
                $jenis_kelamin = $row[5];
                $tahun_lulus = $row[6];
                $email = $row[7];
                $nomorHP = $row[8];
                $nik = $row[9];
                $tempat_Lahir = $row[10];
                $TglLahir = $row[11];
                $alamat = $row[12];

                $db = \Config\Database::connect();

                $ceknim = $db->table('user')->getWhere(['nim' => $nim])->getResult();
                if (count($ceknim) > 0) {
                    $jmlerror++;
                } else {
                    $detail_prodi = $db->table('tbl_prodi')->getWhere(['nama_prodi' => $prodi])->getResultArray();
                    $pass_ens = password_hash($nim, PASSWORD_BCRYPT);
                    $datasimpan = [
                        'nim' => $nim,
                        'nama_lengkap' => $nama,
                        'kode_fakultas' => $detail_prodi[0]['kode_fakultas'],
                        'kode_prodi' => $detail_prodi[0]['id_prodi'],
                        'tahun_lulus' => $tahun_lulus,
                        'email' => $email,
                        'no_hp' => $nomorHP,
                        'password' => $pass_ens,
                        'username' => $nim,
                        'jenis_klm' => $jenis_kelamin,
                        'nik' => $nik,
                        'tempat_lahir' => $tempat_Lahir,
                        'tgl_lahir' => $TglLahir,
                        'alamat_rmh' => $alamat,
                        'status' => 'approved',
                        'level' => 2
                    ];


                    $db->table('user')->insert($datasimpan);
                    $jmlsukses++;
                }
            }
            if ($jmlerror == 0) {
                set_notifikasi('success', 'Data Import', '' . $jmlsukses . ' Data Berhasil Disimpan');
            } elseif ($jmlsukses == 0) {
                set_notifikasi('error', 'Data Import', '' . $jmlerror . ' Data Tidak Bisa Disimpan');
            } else {
                set_notifikasi('question', 'Data Import', '' . $jmlsukses . ' Data Berhasil Disimpan & ' . $jmlerror . ' Data Tidak Bisa Disimpan');
            }
            return redirect()->to(base_url('users'));
        }
    }

    public function resetPassword()
    {
        if ($this->request->isAJAX()) {
            $id_user = $this->request->getPost('id_user');
            $passRandom = rand(1, 99999);
            $passHashBaru = password_hash($passRandom, PASSWORD_DEFAULT);

            $data = array(
                'id_user' => $id_user,
                'password' => $passHashBaru

            );
            $this->m_user->ubah_password($data, $id_user);
            $json = [
                'sukses' => '',
                'passwordBaru' => $passRandom
            ];

            echo json_encode($json);
        }
        $email = \Config\Services::email();
        $email_user = $this->m_user->get_user($id_user);
        $email->setTo($email_user['email']);
        $email->setFrom('tracerstudy@unnur.ac.id', 'Tracer Study Universitas Nurtanio Bandung');
        $email->setSubject('Reset Password');
        $email->setMessage('Password baru anda adalah ' . $passRandom . '');
        $email->send();
    }
}
