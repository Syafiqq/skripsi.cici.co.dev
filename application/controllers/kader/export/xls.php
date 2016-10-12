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

    public function pasien() {
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
