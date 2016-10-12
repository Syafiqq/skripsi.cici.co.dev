<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Xls extends CI_Controller {

    public function __construct() {
        parent::__construct();
        @session_start();
        $this->load->library('session');
        if (($this->session->userdata('iduser') == null) || ($this->session->userdata('role') != 'dinkes')) {
            redirect('Main_controller/login');
        }
    }

    public function pegawaiDinkes() {
        $query = $this->m_dinkes->getListPegawai();
        $this->load->library('excel');
        $this->excel->setActiveSheetIndex(0);
        $this->excel->getActiveSheet()->setTitle('Pegawai Dinkes');
        $this->excel->getActiveSheet()->setCellValue('A1', 'NIP');
        $this->excel->getActiveSheet()->setCellValue('B1', 'Nama Lengkap');
        $this->excel->getActiveSheet()->setCellValue('C1', 'Tempat, Tanggal Lahir');
        $this->excel->getActiveSheet()->setCellValue('D1', 'Alamat');
        $this->excel->getActiveSheet()->setCellValue('E1', 'Nomor Telepon');
        $this->excel->getActiveSheet()->setCellValue('F1', 'Email');
        $this->excel->getActiveSheet()->setCellValue('G1', 'Whatsapp');
        $this->excel->getActiveSheet()->setCellValue('H1', 'Twitter');
        $this->excel->getActiveSheet()->setCellValue('I1', 'BBM');
        $no = 2;
        foreach ($query->result() as $baris) :
            $this->excel->getActiveSheet()->setCellValueExplicit('A' . $no, $baris->NIP, PHPExcel_Cell_DataType::TYPE_STRING);
            $this->excel->getActiveSheet()->setCellValue('B' . $no, $baris->nama);
            $this->excel->getActiveSheet()->setCellValue('C' . $no, $baris->tempat_lahir . ', ' . $baris->tanggal_lahir);
            $this->excel->getActiveSheet()->setCellValue('D' . $no, $baris->alamat . ' Kecamatan ' . $this->m_index->getNamaKecamatan($baris->id_kecamatan) . ' Kelurahan ' . $this->m_index->getNamaKelurahan($baris->id_kelurahan) . ' RT ' . $baris->rt . ' RW ' . $baris->rw);
            $this->excel->getActiveSheet()->setCellValueExplicit('E' . $no, $baris->hp, PHPExcel_Cell_DataType::TYPE_STRING);
            $this->excel->getActiveSheet()->setCellValue('F' . $no, $baris->email);
            $this->excel->getActiveSheet()->setCellValueExplicit('G' . $no, $baris->sosmed1, PHPExcel_Cell_DataType::TYPE_STRING);
            $this->excel->getActiveSheet()->setCellValue('H' . $no, $baris->sosmed2);
            $this->excel->getActiveSheet()->setCellValueExplicit('I' . $no, $baris->sosmed3, PHPExcel_Cell_DataType::TYPE_STRING);
            $no++;
        endforeach;
        $filename = 'daftar-pegawai-dinkes-per-' . date("Y-m-d"); //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '.xls"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        $objWriter->save('php://output');
    }

    public function puskesmas() {
        $query = $this->m_dinkes->getListPuskesmas();
        $this->load->library('excel');
        $this->excel->setActiveSheetIndex(0);
        $this->excel->getActiveSheet()->setTitle('Puskesmas');
        $this->excel->getActiveSheet()->setCellValue('A1', 'Kode Puskesmas');
        $this->excel->getActiveSheet()->setCellValue('B1', 'Nama Puskesmas');
        $this->excel->getActiveSheet()->setCellValue('C1', 'Alamat Puskesmas');
        $this->excel->getActiveSheet()->setCellValue('D1', 'Jenis Puskesmas');
        $no = 2;
        foreach ($query->result() as $baris) :
            $this->excel->getActiveSheet()->setCellValueExplicit('A' . $no, $baris->kode_puskesmas, PHPExcel_Cell_DataType::TYPE_STRING);
            $this->excel->getActiveSheet()->setCellValue('B' . $no, $baris->nama_puskesmas);
            $this->excel->getActiveSheet()->setCellValue('C' . $no, $baris->alamat . ' Kecamatan ' . $this->m_index->getNamaKecamatan($baris->id_kecamatan) . ' Kelurahan ' . $this->m_index->getNamaKelurahan($baris->id_kelurahan) . ' RT ' . $baris->rt . ' RW ' . $baris->rw);
            if ($baris->jenis_puskesmas == 0) {
                $this->excel->getActiveSheet()->setCellValueExplicit('D' . $no, 'Rawat Inap', PHPExcel_Cell_DataType::TYPE_STRING);
            } else {
                $this->excel->getActiveSheet()->setCellValueExplicit('D' . $no, 'Non-Rawat Inap', PHPExcel_Cell_DataType::TYPE_STRING);
            }
            $no++;
        endforeach;
        $filename = 'daftar-puskesmas-per-' . date("Y-m-d"); //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '.xls"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        $objWriter->save('php://output');
    }

    public function pegawaiPuskesmas() {
        $query = $this->m_puskesmas->getListPegawai($this->m_puskesmas->idpuskesmas());
        $this->load->library('excel');
        $this->excel->setActiveSheetIndex(0);
        $this->excel->getActiveSheet()->setTitle('Pegawai Puskesmas');
        $this->excel->getActiveSheet()->setCellValue('A1', 'NIP');
        $this->excel->getActiveSheet()->setCellValue('B1', 'Nama Lengkap');
        $this->excel->getActiveSheet()->setCellValue('C1', 'Tempat, Tanggal Lahir');
        $this->excel->getActiveSheet()->setCellValue('D1', 'Alamat');
        $this->excel->getActiveSheet()->setCellValue('E1', 'Nomor Telepon');
        $this->excel->getActiveSheet()->setCellValue('F1', 'Email');
        $this->excel->getActiveSheet()->setCellValue('G1', 'Whatsapp');
        $this->excel->getActiveSheet()->setCellValue('H1', 'Twitter');
        $this->excel->getActiveSheet()->setCellValue('I1', 'BBM');
        $no = 2;
        foreach ($query->result() as $baris) :
            $this->excel->getActiveSheet()->setCellValueExplicit('A' . $no, $baris->NIP, PHPExcel_Cell_DataType::TYPE_STRING);
            $this->excel->getActiveSheet()->setCellValue('B' . $no, $baris->nama);
            $this->excel->getActiveSheet()->setCellValue('C' . $no, $baris->tempat_lahir . ', ' . $baris->tanggal_lahir);
            $this->excel->getActiveSheet()->setCellValue('D' . $no, $baris->alamat . ' Kecamatan ' . $this->m_index->getNamaKecamatan($baris->id_kecamatan) . ' Kelurahan ' . $this->m_index->getNamaKelurahan($baris->id_kelurahan) . ' RT ' . $baris->rt . ' RW ' . $baris->rw);
            $this->excel->getActiveSheet()->setCellValueExplicit('E' . $no, $baris->hp, PHPExcel_Cell_DataType::TYPE_STRING);
            $this->excel->getActiveSheet()->setCellValue('F' . $no, $baris->email);
            $this->excel->getActiveSheet()->setCellValueExplicit('G' . $no, $baris->sosmed1, PHPExcel_Cell_DataType::TYPE_STRING);
            $this->excel->getActiveSheet()->setCellValue('H' . $no, $baris->sosmed2);
            $this->excel->getActiveSheet()->setCellValueExplicit('I' . $no, $baris->sosmed3, PHPExcel_Cell_DataType::TYPE_STRING);
            $no++;
        endforeach;
        $filename = 'daftar-pegawai-dinkes-per-' . date("Y-m-d"); //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '.xls"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        $objWriter->save('php://output');
    }

    public function posbindu() {
        $query = $this->m_dinkes->getListPosbindu();
        $this->load->library('excel');
        $this->excel->setActiveSheetIndex(0);
        $this->excel->getActiveSheet()->setTitle('Posbindu');
        $this->excel->getActiveSheet()->setCellValue('A1', 'Nama Posbindu');
        $this->excel->getActiveSheet()->setCellValue('B1', 'Alamat Posbindu');
        $no = 2;
        foreach ($query->result() as $baris) :
            $this->excel->getActiveSheet()->setCellValue('A' . $no, $baris->nama_posbindu);
            $this->excel->getActiveSheet()->setCellValue('B' . $no, $baris->alamat . ' Kecamatan ' . $this->m_index->getNamaKecamatan($baris->id_kecamatan) . ' Kelurahan ' . $this->m_index->getNamaKelurahan($baris->id_kelurahan) . ' RT ' . $baris->rt . ' RW ' . $baris->rw);
            $no++;
        endforeach;
        $filename = 'daftar-posbindu-per-' . date("Y-m-d"); //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '.xls"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        $objWriter->save('php://output');
    }

    public function posbinduByIdPuskesmas() {
        $query = $this->m_puskesmas->getListPosbindu($this->m_puskesmas->idpuskesmas());
        $this->load->library('excel');
        $this->excel->setActiveSheetIndex(0);
        $this->excel->getActiveSheet()->setTitle('Posbindu');
        $this->excel->getActiveSheet()->setCellValue('A1', 'Nama Posbindu');
        $this->excel->getActiveSheet()->setCellValue('B1', 'Alamat Posbindu');
        $no = 2;
        foreach ($query->result() as $baris) :
            $this->excel->getActiveSheet()->setCellValue('A' . $no, $baris->nama_posbindu);
            $this->excel->getActiveSheet()->setCellValue('B' . $no, $baris->alamat . ' Kecamatan ' . $this->m_index->getNamaKecamatan($baris->id_kecamatan) . ' Kelurahan ' . $this->m_index->getNamaKelurahan($baris->id_kelurahan) . ' RT ' . $baris->rt . ' RW ' . $baris->rw);
            $no++;
        endforeach;
        $filename = 'daftar-posbindu-per-' . date("Y-m-d"); //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '.xls"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        $objWriter->save('php://output');
    }

    public function kader() {
        $query = $this->m_dinkes->getListKader();
        $this->load->library('excel');
        $this->excel->setActiveSheetIndex(0);
        $this->excel->getActiveSheet()->setTitle('Kader');
        $this->excel->getActiveSheet()->setCellValue('A1', 'Nama Lengkap');
        $this->excel->getActiveSheet()->setCellValue('B1', 'Tempat, Tanggal Lahir');
        $this->excel->getActiveSheet()->setCellValue('C1', 'Alamat');
        $this->excel->getActiveSheet()->setCellValue('D1', 'Nomor Telepon');
        $this->excel->getActiveSheet()->setCellValue('E1', 'Email');
        $this->excel->getActiveSheet()->setCellValue('F1', 'Whatsapp');
        $this->excel->getActiveSheet()->setCellValue('G1', 'Twitter');
        $this->excel->getActiveSheet()->setCellValue('H1', 'BBM');
        $no = 2;
        foreach ($query->result() as $baris) :
            $this->excel->getActiveSheet()->setCellValue('A' . $no, $baris->nama);
            $this->excel->getActiveSheet()->setCellValue('B' . $no, $baris->tempat_lahir . ', ' . $baris->tanggal_lahir);
            $this->excel->getActiveSheet()->setCellValue('C' . $no, $baris->alamat . ' Kecamatan ' . $this->m_index->getNamaKecamatan($baris->id_kecamatan) . ' Kelurahan ' . $this->m_index->getNamaKelurahan($baris->id_kelurahan) . ' RT ' . $baris->rt . ' RW ' . $baris->rw);
            $this->excel->getActiveSheet()->setCellValueExplicit('D' . $no, $baris->hp, PHPExcel_Cell_DataType::TYPE_STRING);
            $this->excel->getActiveSheet()->setCellValue('E' . $no, $baris->email);
            $this->excel->getActiveSheet()->setCellValueExplicit('F' . $no, $baris->sosmed1, PHPExcel_Cell_DataType::TYPE_STRING);
            $this->excel->getActiveSheet()->setCellValue('G' . $no, $baris->sosmed2);
            $this->excel->getActiveSheet()->setCellValueExplicit('H' . $no, $baris->sosmed3, PHPExcel_Cell_DataType::TYPE_STRING);
            $no++;
        endforeach;
        $filename = 'daftar-kader-per-' . date("Y-m-d"); //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '.xls"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        $objWriter->save('php://output');
    }

    public function kaderByIdPuskesmas() {
        $query = $this->m_puskesmas->getListKader($this->m_puskesmas->idpuskesmas());
        $this->load->library('excel');
        $this->excel->setActiveSheetIndex(0);
        $this->excel->getActiveSheet()->setTitle('Kader');
        $this->excel->getActiveSheet()->setCellValue('A1', 'Nama Lengkap');
        $this->excel->getActiveSheet()->setCellValue('B1', 'Tempat, Tanggal Lahir');
        $this->excel->getActiveSheet()->setCellValue('C1', 'Alamat');
        $this->excel->getActiveSheet()->setCellValue('D1', 'Nomor Telepon');
        $this->excel->getActiveSheet()->setCellValue('E1', 'Email');
        $this->excel->getActiveSheet()->setCellValue('F1', 'Whatsapp');
        $this->excel->getActiveSheet()->setCellValue('G1', 'Twitter');
        $this->excel->getActiveSheet()->setCellValue('H1', 'BBM');
        $no = 2;
        foreach ($query->result() as $baris) :
            $this->excel->getActiveSheet()->setCellValue('A' . $no, $baris->nama);
            $this->excel->getActiveSheet()->setCellValue('B' . $no, $baris->tempat_lahir . ', ' . $baris->tanggal_lahir);
            $this->excel->getActiveSheet()->setCellValue('C' . $no, $baris->alamat . ' Kecamatan ' . $this->m_index->getNamaKecamatan($baris->id_kecamatan) . ' Kelurahan ' . $this->m_index->getNamaKelurahan($baris->id_kelurahan) . ' RT ' . $baris->rt . ' RW ' . $baris->rw);
            $this->excel->getActiveSheet()->setCellValueExplicit('D' . $no, $baris->hp, PHPExcel_Cell_DataType::TYPE_STRING);
            $this->excel->getActiveSheet()->setCellValue('E' . $no, $baris->email);
            $this->excel->getActiveSheet()->setCellValueExplicit('F' . $no, $baris->sosmed1, PHPExcel_Cell_DataType::TYPE_STRING);
            $this->excel->getActiveSheet()->setCellValue('G' . $no, $baris->sosmed2);
            $this->excel->getActiveSheet()->setCellValueExplicit('H' . $no, $baris->sosmed3, PHPExcel_Cell_DataType::TYPE_STRING);
            $no++;
        endforeach;
        $filename = 'daftar-kader-per-' . date("Y-m-d"); //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '.xls"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        $objWriter->save('php://output');
    }

    public function kaderByIdPosbindu() {
        $query = $this->m_posbindu->getListKader();
        $this->load->library('excel');
        $this->excel->setActiveSheetIndex(0);
        $this->excel->getActiveSheet()->setTitle('Kader');
        $this->excel->getActiveSheet()->setCellValue('A1', 'Nama Lengkap');
        $this->excel->getActiveSheet()->setCellValue('B1', 'Tempat, Tanggal Lahir');
        $this->excel->getActiveSheet()->setCellValue('C1', 'Alamat');
        $this->excel->getActiveSheet()->setCellValue('D1', 'Nomor Telepon');
        $this->excel->getActiveSheet()->setCellValue('E1', 'Email');
        $this->excel->getActiveSheet()->setCellValue('F1', 'Whatsapp');
        $this->excel->getActiveSheet()->setCellValue('G1', 'Twitter');
        $this->excel->getActiveSheet()->setCellValue('H1', 'BBM');
        $no = 2;
        foreach ($query->result() as $baris) :
            $this->excel->getActiveSheet()->setCellValue('A' . $no, $baris->nama);
            $this->excel->getActiveSheet()->setCellValue('B' . $no, $baris->tempat_lahir . ', ' . $baris->tanggal_lahir);
            $this->excel->getActiveSheet()->setCellValue('C' . $no, $baris->alamat . ' Kecamatan ' . $this->m_index->getNamaKecamatan($baris->id_kecamatan) . ' Kelurahan ' . $this->m_index->getNamaKelurahan($baris->id_kelurahan) . ' RT ' . $baris->rt . ' RW ' . $baris->rw);
            $this->excel->getActiveSheet()->setCellValueExplicit('D' . $no, $baris->hp, PHPExcel_Cell_DataType::TYPE_STRING);
            $this->excel->getActiveSheet()->setCellValue('E' . $no, $baris->email);
            $this->excel->getActiveSheet()->setCellValueExplicit('F' . $no, $baris->sosmed1, PHPExcel_Cell_DataType::TYPE_STRING);
            $this->excel->getActiveSheet()->setCellValue('G' . $no, $baris->sosmed2);
            $this->excel->getActiveSheet()->setCellValueExplicit('H' . $no, $baris->sosmed3, PHPExcel_Cell_DataType::TYPE_STRING);
            $no++;
        endforeach;
        $filename = 'daftar-kader-per-' . date("Y-m-d"); //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '.xls"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        $objWriter->save('php://output');
    }

    public function pasien() {
        $query = $this->m_dinkes->getListPasien();
        $this->load->library('excel');
        $this->excel->setActiveSheetIndex(0);
        $this->excel->getActiveSheet()->setTitle('Pasien');
        $this->excel->getActiveSheet()->setCellValue('A1', 'KTP');
        $this->excel->getActiveSheet()->setCellValue('B1', 'Nama Lengkap');
        $this->excel->getActiveSheet()->setCellValue('C1', 'Jenis Kelamin');
        $this->excel->getActiveSheet()->setCellValue('D1', 'Tempat, Tanggal Lahir');
        $this->excel->getActiveSheet()->setCellValue('E1', 'Alamat');
        $this->excel->getActiveSheet()->setCellValue('F1', 'Nomor Telepon');
        $no = 2;
        foreach ($query->result() as $baris) :
            $this->excel->getActiveSheet()->setCellValueExplicit('A' . $no, $baris->ktp, PHPExcel_Cell_DataType::TYPE_STRING);
            $this->excel->getActiveSheet()->setCellValue('B' . $no, $baris->nama);
            $this->excel->getActiveSheet()->setCellValue('C' . $no, $baris->jenis_kelamin);
            $this->excel->getActiveSheet()->setCellValue('D' . $no, $baris->tempat_lahir . ', ' . $baris->tgl_lahir);
            $this->excel->getActiveSheet()->setCellValue('E' . $no, $baris->alamat . ' Kecamatan ' . $this->m_index->getNamaKecamatan($baris->id_kecamatan) . ' Kelurahan ' . $this->m_index->getNamaKelurahan($baris->id_kelurahan) . ' RT ' . $baris->rt . ' RW ' . $baris->rw);
            $this->excel->getActiveSheet()->setCellValueExplicit('F' . $no, $baris->hp, PHPExcel_Cell_DataType::TYPE_STRING);
            $no++;
        endforeach;
        $filename = 'daftar-pasien-per-' . date("Y-m-d"); //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '.xls"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        $objWriter->save('php://output');
    }

    public function pasienByIdPuskesmas() {
        $query = $this->m_puskesmas->getListPasien($this->m_index->getIdPuskesmasByPegawaiPuskesmas($this->session->userdata('id_users')));
        $this->load->library('excel');
        $this->excel->setActiveSheetIndex(0);
        $this->excel->getActiveSheet()->setTitle('Pasien');
        $this->excel->getActiveSheet()->setCellValue('A1', 'KTP');
        $this->excel->getActiveSheet()->setCellValue('B1', 'Nama Lengkap');
        $this->excel->getActiveSheet()->setCellValue('C1', 'Jenis Kelamin');
        $this->excel->getActiveSheet()->setCellValue('D1', 'Tempat, Tanggal Lahir');
        $this->excel->getActiveSheet()->setCellValue('E1', 'Alamat');
        $this->excel->getActiveSheet()->setCellValue('F1', 'Nomor Telepon');
        $no = 2;
        foreach ($query->result() as $baris) :
            $this->excel->getActiveSheet()->setCellValueExplicit('A' . $no, $baris->ktp, PHPExcel_Cell_DataType::TYPE_STRING);
            $this->excel->getActiveSheet()->setCellValue('B' . $no, $baris->nama);
            $this->excel->getActiveSheet()->setCellValue('C' . $no, $baris->jenis_kelamin);
            $this->excel->getActiveSheet()->setCellValue('D' . $no, $baris->tempat_lahir . ', ' . $baris->tgl_lahir);
            $this->excel->getActiveSheet()->setCellValue('E' . $no, $baris->alamat . ' Kecamatan ' . $this->m_index->getNamaKecamatan($baris->id_kecamatan) . ' Kelurahan ' . $this->m_index->getNamaKelurahan($baris->id_kelurahan) . ' RT ' . $baris->rt . ' RW ' . $baris->rw);
            $this->excel->getActiveSheet()->setCellValueExplicit('F' . $no, $baris->hp, PHPExcel_Cell_DataType::TYPE_STRING);
            $no++;
        endforeach;
        $filename = 'daftar-pasien-per-' . date("Y-m-d"); //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '.xls"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        $objWriter->save('php://output');
    }

    public function pasienByIdKader() {
        $query = $this->m_kader->getListPasien($this->session->userdata('id_users'));
        $this->load->library('excel');
        $this->excel->setActiveSheetIndex(0);
        $this->excel->getActiveSheet()->setTitle('Pasien');
        $this->excel->getActiveSheet()->setCellValue('A1', 'KTP');
        $this->excel->getActiveSheet()->setCellValue('B1', 'Nama Lengkap');
        $this->excel->getActiveSheet()->setCellValue('C1', 'Jenis Kelamin');
        $this->excel->getActiveSheet()->setCellValue('D1', 'Tempat, Tanggal Lahir');
        $this->excel->getActiveSheet()->setCellValue('E1', 'Alamat');
        $this->excel->getActiveSheet()->setCellValue('F1', 'Nomor Telepon');
        $no = 2;
        foreach ($query->result() as $baris) :
            $this->excel->getActiveSheet()->setCellValueExplicit('A' . $no, $baris->ktp, PHPExcel_Cell_DataType::TYPE_STRING);
            $this->excel->getActiveSheet()->setCellValue('B' . $no, $baris->nama);
            $this->excel->getActiveSheet()->setCellValue('C' . $no, $baris->jenis_kelamin);
            $this->excel->getActiveSheet()->setCellValue('D' . $no, $baris->tempat_lahir . ', ' . $baris->tgl_lahir);
            $this->excel->getActiveSheet()->setCellValue('E' . $no, $baris->alamat . ' Kecamatan ' . $this->m_index->getNamaKecamatan($baris->id_kecamatan) . ' Kelurahan ' . $this->m_index->getNamaKelurahan($baris->id_kelurahan) . ' RT ' . $baris->rt . ' RW ' . $baris->rw);
            $this->excel->getActiveSheet()->setCellValueExplicit('F' . $no, $baris->hp, PHPExcel_Cell_DataType::TYPE_STRING);
            $no++;
        endforeach;
        $filename = 'daftar-pasien-per-' . date("Y-m-d"); //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '.xls"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        $objWriter->save('php://output');
    }

    public function riwayat($id) {
        $riwayat = $this->m_dinkes->getListRiwayatPasien($id);
        $this->load->library('excel');
        $this->excel->setActiveSheetIndex(0);
        $this->excel->getActiveSheet()->setTitle($this->m_index->namaPasien($id));
        $this->excel->getActiveSheet()->setCellValue('A1', 'Tanggal');
        $this->excel->getActiveSheet()->setCellValue('B1', 'Anggota Keluarga');
        $this->excel->getActiveSheet()->setCellValue('C1', 'Tekanan Darah');
        $this->excel->getActiveSheet()->setCellValue('D1', 'Irama Denyut');
        $this->excel->getActiveSheet()->setCellValue('E1', 'Merokok (Batang/hari)');
        $this->excel->getActiveSheet()->setCellValue('F1', 'Kolesterol');
        $this->excel->getActiveSheet()->setCellValue('G1', 'Diabetes');
        $this->excel->getActiveSheet()->setCellValue('H1', 'Olahraga');
        $this->excel->getActiveSheet()->setCellValue('I1', 'Tinggi Badan');
        $this->excel->getActiveSheet()->setCellValue('J1', 'Berat Badan');
        $this->excel->getActiveSheet()->setCellValue('K1', 'Riwayat Sakit');
        $this->excel->getActiveSheet()->setCellValue('L1', 'Riwayat Keluarga');
        $this->excel->getActiveSheet()->setCellValue('M1', 'Diagnosa');
        $no = 2;
        foreach ($riwayat->result() as $baris) :
            $this->excel->getActiveSheet()->setCellValueExplicit('A' . $no, $baris->tanggal, PHPExcel_Cell_DataType::TYPE_STRING);
            $this->excel->getActiveSheet()->setCellValue('B' . $no, $baris->anggota_keluarga);
            $this->excel->getActiveSheet()->setCellValueExplicit('C' . $no, $baris->td_sistole . "/" . $baris->td_diastole, PHPExcel_Cell_DataType::TYPE_STRING);
            $this->excel->getActiveSheet()->setCellValue('D' . $no, $baris->irama_denyut);
            $this->excel->getActiveSheet()->setCellValue('E' . $no, $baris->merokok);
            if ($baris->kolesterol == 0) {
                $this->excel->getActiveSheet()->setCellValue('F' . $no, 'Tidak');
            } else {
                $this->excel->getActiveSheet()->setCellValue('F' . $no, 'Ya');
            }
            if ($baris->diabetes == 0) {
                $this->excel->getActiveSheet()->setCellValue('G' . $no, 'Tidak');
            } else {
                $this->excel->getActiveSheet()->setCellValue('G' . $no, 'Ya');
            }
            if ($baris->olahraga == 0) {
                $this->excel->getActiveSheet()->setCellValue('H' . $no, 'Tidak');
            } else if (0 < $baris->olahraga && $baris->olahraga < 1) {
                $this->excel->getActiveSheet()->setCellValue('H' . $no, 'Jarang');
            } else if ($baris->diabetes == 1) {
                $this->excel->getActiveSheet()->setCellValue('H' . $no, 'Ya');
            }
            $this->excel->getActiveSheet()->setCellValue('I' . $no, $baris->tinggi_badan);
            $this->excel->getActiveSheet()->setCellValue('J' . $no, $baris->berat_badan);
            if ($baris->riwayat_sakit == 0) {
                $this->excel->getActiveSheet()->setCellValue('K' . $no, 'Tidak');
            } else {
                $this->excel->getActiveSheet()->setCellValue('K' . $no, 'Ya');
            }
            if ($baris->riwayat_keluarga == 0) {
                $this->excel->getActiveSheet()->setCellValue('L' . $no, 'Tidak');
            } else {
                $this->excel->getActiveSheet()->setCellValue('L' . $no, 'Ya');
            }
            $this->excel->getActiveSheet()->setCellValue('M' . $no, $baris->diagnosa);
            $no++;
        endforeach;
        $filename = 'daftar-riwayat-' . $this->m_index->namaPasien($id) . '-per-' . date("Y-m-d"); //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '.xls"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        $objWriter->save('php://output');
    }

}
