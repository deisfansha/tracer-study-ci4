<?php

namespace App\Controllers;

use App\Models\ModelHasil;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Hasil extends BaseController
{
    public function __construct()
    {
        $this->m_hasil = new ModelHasil();
    }
    public function index()
    {
        $data = array(
            'menu' => 'hasil',
            'submenu' => '',
            'head' => 'Data Hasil Kuesioner',
            'title' => 'Hasil Kuesioner',
            'isi' => 'main/admin/kuesioner/hasil_tracer',
            'view_hasil' => $this->m_hasil->view_hasil_kuesioner(),
        );
        return view('layout/admin/v_wrapper', $data);
    }
    public function detail_hasil($id_kuesioner)
    {
        $kuesioner = $this->m_hasil->detail_kuesioner($id_kuesioner);
        $data['menu'] = 'hasil';
        $data['submenu'] = '';
        $data['detail'] = $this->m_hasil->detail_kuesioner($id_kuesioner);
        $data['head'] = $kuesioner['nama_kuesioner'];
        $data['title'] = $kuesioner['nama_kuesioner'];
        $data['user'] = $this->m_hasil->detail_hasil_by_user($id_kuesioner);
        $data['isi'] = 'main/admin/kuesioner/detail_hasil';
        return view('layout/admin/v_wrapper', $data);
    }
    public function detail_jawaban($kode_kuesioner, $kode_users)
    {
        $kuesioner = $this->m_hasil->get_name_kuesioner($kode_kuesioner);
        $data = array(
            'menu' => 'hasil',
            'submenu' => '',
            'head' =>  $kuesioner['nama_kuesioner'],
            'title' =>  $kuesioner['nama_kuesioner'],
            'nama' => $this->m_hasil->get_name_kuesioner($kode_kuesioner),
            'user_data' => $this->m_hasil->detail_user($kode_users),
            'answer' =>  $this->m_hasil->answer_by_name($kode_users, $kode_kuesioner),
            'isi' => 'main/admin/kuesioner/detail_answer',
        );
        return view('layout/admin/v_wrapper', $data);
    }
    public function exportKuesioner($id_kuesioner)
    {
        $db = \Config\Database::connect();
        // $builder = $db->table('user');
        // $builder->select('user.id_user, tbl_alumni.nik, user.nama_lengkap, user.jenis_klm, tbl_fakultas.nama_fakultas, tbl_prodi.nama_prodi, tbl_answer.kode_kuesioner,user.tahun_lulus')
        //     ->distinct('tbl_alumni.nik, user.nama_lengkap, user.jenis_klm, tbl_fakultas.nama_fakultas, tbl_prodi.nama_prodi, tbl_answer.kode_kuesioner,user.tahun_lulus')->join(
        //         "tbl_alumni",
        //         "tbl_alumni.id_alumni=user.id_user"
        //     )->join(
        //         "tbl_fakultas",
        //         "tbl_fakultas.id_fakultas=user.kode_fakultas",
        //     )->join(
        //         "tbl_prodi",
        //         "tbl_prodi.id_prodi=user.kode_prodi",
        //     )->join(
        //         "tbl_answer",
        //         "tbl_answer.kode_users=user.id_user",
        //     )->join(
        //         "tbl_kuesioner",
        //         "tbl_kuesioner.id_kuesioner=tbl_answer.kode_kuesioner",
        //     )->where('tbl_answer.kode_kuesioner=', $id_kuesioner);

        $kuesioner = $db->query("SELECT * FROM tbl_kuesioner WHERE id_kuesioner = '$id_kuesioner'")->getRowArray();
        $namaFile = $kuesioner['nama_kuesioner'];
        $hasil = $db->query("SELECT DISTINCT u.id_user, u.nik,u.`nama_lengkap`, u.`jenis_klm`, u.tahun_lulus, p.`nama_prodi`, f.`nama_fakultas`,a.`kode_users`, k.`id_kuesioner` FROM tbl_answer a
        JOIN user u ON u.`id_user` = a.`kode_users`
        JOIN tbl_kuesioner k ON k.`id_kuesioner` = a.`kode_kuesioner`
        JOIN tbl_fakultas f ON f.`id_fakultas` = u.`kode_fakultas`
        JOIN tbl_prodi p ON p.`id_prodi` = u.`kode_prodi`
        JOIN tbl_question q ON q.`id_quest` = a.`kode_quest`
        WHERE a.`kode_kuesioner` = '$id_kuesioner'")->getResultArray();


        $queryQuestion = $db->query("Select b.`kode_pertanyaan` from tbl_group_kuesioner a
                                        join tbl_question b on a.`kode_quest` = b.`id_quest`
                                        where kode_kuesioner = '$id_kuesioner'")->getResultArray();



        $question = array();
        foreach ($queryQuestion as $q) {
            array_push($question, $q['kode_pertanyaan']);
        }



        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Nomor');
        $sheet->setCellValue('B1', 'NIK');
        $sheet->setCellValue('C1', 'Nama Lengkap');
        $sheet->setCellValue('D1', 'Jenis Kelamin');
        $sheet->setCellValue('E1', 'Fakultas');
        $sheet->setCellValue('F1', 'Program Studi');
        $sheet->setCellValue('G1', 'Tahun Lulus');
        $sheet->fromArray($question, NULL, 'H1');


        $column = 2;
        foreach ($hasil as $value) {
            $sheet->setCellValue('A' . $column, ($column - 1));
            $sheet->setCellValue('B' . $column, $value['nik']);
            $sheet->setCellValue('C' . $column, $value['nama_lengkap']);
            $sheet->setCellValue('D' . $column, $value['jenis_klm']);
            $sheet->setCellValue('E' . $column, $value['nama_fakultas']);
            $sheet->setCellValue('F' . $column, $value['nama_prodi']);
            $sheet->setCellValue('G' . $column, $value['tahun_lulus']);

            $queryAnswer = $db->query("SELECT a.`answer`, u.`id_user` FROM tbl_answer a JOIN USER u ON u.`id_user` = a.`kode_users`
            WHERE kode_kuesioner = '$id_kuesioner' AND u.id_user='" . $value['id_user'] . "'")->getResultArray();
            $answer = array();
            foreach ($queryAnswer as $a) {
                array_push($answer, $a['answer']);
            }
            $sheet->fromArray($answer, NULL, 'H' . $column);
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
        $sheet->getStyle('A1:G' . ($column - 1))->applyFromArray($stylearray);
        $sheet->getStyle('A1:G1')->getFont()->setBold(true);
        $sheet->getStyle('A1:G1')->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FFFFFF00');

        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $sheet->getColumnDimension('F')->setAutoSize(true);
        $sheet->getColumnDimension('G')->setAutoSize(true);

        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheet.html');
        header("Content-Disposition: attachment;filename=$namaFile.xlsx");
        header('Chace-Control: max-age=0');
        $writer->save('php://output');
        exit();
    }
}
